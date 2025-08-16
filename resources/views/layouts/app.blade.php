<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @yield('head') 
</head>
<body>
    <div class="min-vh-100 bg-light">

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Library System') }}</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('books.index') }}">Books</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">Users</a></li>
                            @else
                                <li class="nav-item"><a class="nav-link" href="{{ route('student.dashboard') }}">Dashboard</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('books.index') }}">Books</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('student.borrows') }}">My Borrows</a></li>
                            @endif

                            <li class="nav-item"><a class="nav-link" href="{{ route('student.profile.edit') }}">Profile</a></li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link nav-link">Logout</button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            @if(Route::has('register'))
                                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                            @endif
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Flash Messages -->
        <div class="container mt-3">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
        </div>

        <!-- Page Content -->
        <main class="container py-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')  
</body>
</html>