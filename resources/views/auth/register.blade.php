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
    <form action="{{ route('register.action') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="email">
        <input type="text" name="firstname" placeholder="firstname">
        <input type="text" name="lastname" placeholder="lastname">
        <input type="password" name="password" placeholder="password">
        <input type="password" name="password_confirmation" placeholder="password">
        <input type="tel" name="mobile">
        <input type="submit" value="Submit">
    </form>
@endsection
