<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task Manager</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>

<div class="container">
    <div class="text-center mt-5">
        <h2 class="text-success">
            <i class="fad fa-tasks"></i> Tasks
        </h2>
    </div>

    <div class="row justify-content-center mt-3">
        <div class="col-4">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    A list item
                    <i class="fal fa-check-circle task-check completed-task"></i>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    A second list item
                    <i class="fal fa-check-circle task-check pending-task"></i>
                </li>
            </ul>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
