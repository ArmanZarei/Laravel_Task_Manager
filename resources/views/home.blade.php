<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Task Manager</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-4">
            <div class="text-center position-relative">
                @auth('web')
                    Hello {{ Auth::user()->fullname }}
                    <a href="{{ route('logout') }}">logout</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                @endauth
                <h2 class="text-success">
                    <i class="fad fa-tasks"></i> Tasks
                </h2>
                <div class="tasks-manager-icons position-absolute d-flex align-middle">
                    <i class="fad fa-sync text-success" id="reload-tasks" onclick="location.reload()"></i>
                    <i class="far fa-plus-circle text-primary" id="add-task"></i>
                </div>
            </div>
            <hr class="bg-secondary">
            <ul class="list-group">
                @foreach($tasks as $task)
                    <li class="list-group-item d-flex justify-content-between align-items-center single-task">
                        <div class="d-flex align-middle">
                            <span>{{ $task->title }}</span>
                            <i class="fal fa-edit edit-task task-action-btn text-secondary" data-tid="{{ $task->id }}"></i>
                            <i class="far fa-trash-alt task-action-btn delete-task" data-tid="{{ $task->id }}"></i>
                        </div>
                        <i class="fal fa-check-circle task-check {{ $task->done ? 'completed-task' : 'pending-task' }}" data-tid="{{ $task->id }}"></i>
                    </li>
                @endforeach
            </ul>
            <p class="alert alert-danger p-2 text-center {{ sizeof($tasks) ? 'inactive-no-task' : 'active-no-task' }}" id="no-tasks">No Tasks</p>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="mainModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success"><i class="fal fa-clipboard-check modal-title-icon"></i> <span id="modal-title-txt"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="modalForm">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Title:</label>
                        <input type="text" class="form-control" id="task-title">
                    </div>
                    <button type="submit" class="btn btn-outline-success"><i class="fal fa-paper-plane"></i> Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function () {
        const modal = new bootstrap.Modal(document.getElementById('mainModal'), {
            keyboard: false
        });
        const taskManager = {
            taskAPI: "{{ route('tasks.store') }}",
            taskDone(taskId, isDone, elemToToggle) {
                $.ajax({
                    url: this.taskAPI + "/" + taskId,
                    method: 'PUT',
                    data: {
                        done: isDone ? 1 : 0,
                    },
                    success: function (data) {
                        elemToToggle.toggleClass('completed-task pending-task');
                    },
                    error: function () {
                        swal("Error", "Something went wrong!", "error");
                    }
                });
            },
            deleteTask(taskId, taskContainer) {
                $.ajax({
                    url: this.taskAPI + "/" + taskId,
                    method: 'DELETE',
                    success: function (data) {
                        taskContainer.slideUp(300, function(){
                            $(this).remove();
                            if ($(".single-task").length == 0)
                                $("#no-tasks").removeClass('inactive-no-task').addClass('active-no-task');
                        });
                    },
                    error: function () {
                        swal("Error", "Something went wrong!", "error");
                    }
                });
            }
        };
        const modalManager = {
            form: document.getElementById('modalForm'),
            modalTitle: document.getElementById('modal-title-txt'),
            prepareTaskCreation() {
                this.modalTitle.innerHTML = 'Create a new task';
                this.form.setAttribute('method', 'POST');
                this.form.setAttribute('action', taskManager.taskAPI);
                document.getElementById('task-title').value = "";
            },
            prepareTaskEdit(task_id, task_title) {
                this.modalTitle.innerHTML = 'Edit your task ';
                this.form.setAttribute('method', 'PUT');
                this.form.setAttribute('action', `${taskManager.taskAPI}/${task_id}`);
                document.getElementById('task-title').value = task_title;
            }
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#modalForm").on('submit', function (e) {
            const form = $(this);
            e.preventDefault();
            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                dataType: "json",
                data: {
                    title: form.find("#task-title").val(),
                }
            }).done(function (data) {
                swal("Success", "Task created successfully!", "success").then((value) => {
                    location.reload();
                });
            }).fail(function (xhr, status, error) {
                swal("Hello world!");
                swal("Error", JSON.parse(xhr.responseText).message, "error");
            })
        });

        $("#add-task").on('click', function (e) {
            modalManager.prepareTaskCreation();
            modal.show();
        });

        $(".task-check").on('click', function (e) {
            const $this = $(this);
            taskManager.taskDone($this.data("tid"), !$this.hasClass('completed-task'), $this);
        });

        $(".edit-task").on('click', function (e) {
            const $this = $(this);
            modalManager.prepareTaskEdit($this.data("tid"), $this.siblings('span').text());
            modal.show();
        });

        $(".delete-task").on('click', function (e) {
            const $this = $(this);
            taskManager.deleteTask($this.data("tid"), $this.closest('.single-task'));
        });
    });
</script>
</body>
</html>
