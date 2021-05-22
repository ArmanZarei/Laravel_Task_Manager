@extends('base')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-5 m-auto">
                <div class="card mt-4">
                    <div class="card-header">
                        <i class="fal fa-user-plus"></i> Register
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">
                                    <i class="fal fa-engine-warning"></i> {{ $error }}
                                </div>
                            @endforeach
                        @endif
                        <form action="{{ route('register.action') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                            </div>
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Firstname</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname') }}">
                            </div>
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Lastname</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') }}">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="passwordConfirmation" class="form-label">Password Confirmation</label>
                                <input type="password" class="form-control" id="passwordConfirmation" name="password_confirmation">
                            </div>
                            <div class="mb-3">
                                <label for="mobile" class="form-label">Telephone</label>
                                <input type="tel" class="form-control" id="mobile" name="mobile" value="{{ old('mobile') }}">
                            </div>
                            <button type="submit" class="btn btn-outline-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
