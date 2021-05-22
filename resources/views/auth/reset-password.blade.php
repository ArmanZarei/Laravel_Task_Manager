@extends('base')

@section('body')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="password" name="password" placeholder="password">
        <input type="password" name="password_confirmation" placeholder="password">
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="submit" value="Submit">
    </form>
@endsection
