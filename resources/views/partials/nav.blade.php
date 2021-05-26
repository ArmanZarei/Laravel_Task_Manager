<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('tasks.index') }}">Task Manager</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('tasks.index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-warning" aria-current="page" href="#">{{ $menuComposerTest }}</a>
                </li>
            </ul>
            <div>
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-primary"><i class="fal fa-sign-in me-1"></i> Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-success"><i class="fal fa-user-plus me-1"></i> Register</a>
                @else
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->fullname }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a href="#" class="dropdown-item"><i class="fal fa-user me-1"></i> Profile</a></li>
                            <li><a href="{{ route('logout') }}" class="dropdown-item text-danger"><i class="fal fa-sign-out me-1"></i> Logout</a></li>
                        </ul>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>
