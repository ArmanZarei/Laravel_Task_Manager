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
    <form action="{{ route('password.request') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="email">
        <input type="submit" value="Submit">
    </form>
@endsection

