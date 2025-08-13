<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Online Library</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        
        <style>
            body {
                background-color: #f8f9fa;
            }
            header {
                background: linear-gradient(135deg, #2193b0, #6dd5ed);
                color: white;
                padding: 3rem 0;
                text-align: center;
                box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            }
            header h1 {
                font-weight: 700;
                margin-bottom: 0.5rem;
            }
            header p {
                font-size: 1.1rem;
                opacity: 0.9;
            }
            .card {
                border: none;
                border-radius: 12px;
                overflow: hidden;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }
            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0,0,0,0.15);
            }
            .card-img-top {
                height: 300px;
                object-fit: cover;
            }
        </style>
        
    </head>



    <body class="antialiased bg-light">
        <header class="w-100 mb-5" color: white; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
            <div class="container py-3">
                @if (Route::has('login'))
                    <nav class="d-flex d-flex justify-content-center align-items-center gap-3 mb-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-light btn-sm px-4">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm px-4">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-warning btn-sm px-4">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif

                <div class="text-center pb-4">
                    <h1 class="fw-bold mb-2">📚 Welcome to Our Library</h1>
                    <p class="mb-0">Discover, borrow, and enjoy your favorite books anytime.</p>
                </div>
            </div>
        </header>

        

        
        <!-- Books Section -->
        <div class="container py-5">
            <div class="row">
                @forelse($books as $book)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ $book->cover_url ?? 'https://via.placeholder.com/300x400' }}" 
                                class="card-img-top" alt="{{ $book->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text text-muted mb-1">Author: {{ $book->author }}</p>
                                <p class="card-text">{{ Str::limit($book->description, 100, '...') }}</p>
                            </div>
                            <div class="card-footer bg-white border-0 text-center">
                                @auth
                                    <form action="{{ route('books.borrow', $book->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-info w-100">Borrow</button>
                                    </form>                                
                                @else
                                    <a href="{{ route('login') }}" onclick="alert('Please log in to borrow a book');" class="btn btn-info w-100">Borrow</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">No books available at the moment.</p>
                @endforelse
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
        
        
        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>
