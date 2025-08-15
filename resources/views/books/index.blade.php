@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <div class='card'>
                <div class='card-header'>{{ __('Available Books') }}</div>

                <div class='card-body'>
                    <div class='row'>
                        @forelse ($books as $book)
                            <div class='col-md-4 mb-4'>
                                <div class='card h-100'>
                                    @if($book->cover_url)
                                        <img src="{{ $book->cover_url }}" class='card-img-top' alt='{{ $book->title }}' style='height: 200px; object-fit: cover;'>
                                    @else
                                        <img src='https://via.placeholder.com/150' class='card-img-top' alt='No Image' style='height: 200px; object-fit: cover;'>
                                    @endif
                                    <div class='card-body d-flex flex-column'>
                                        <h5 class='card-title'>{{ $book->title }}</h5>
                                        <p class='card-text'><strong>Author:</strong> {{ $book->author }}</p>
                                        <p class='card-text'><strong>Category:</strong> {{ $book->category }}</p>
                                        <p class='card-text'><strong>Available Copies:</strong> {{ $book->copies - $book->borrowed_count }}</p>
                                        <div class='mt-auto'>
                                            <a href='{{ route('books.show', $book->id) }}' class='btn btn-primary btn-sm'>View Details</a>
                                            @if($book->copies - $book->borrowed_count > 0)
                                                <form action='{{ route('books.borrow', $book->id) }}' method='POST' style='display:inline-block;'>
                                                    @csrf
                                                    <button type='submit' class='btn btn-success btn-sm'>Borrow</button>
                                                </form>
                                            @else
                                                <button class='btn btn-secondary btn-sm' disabled>Out of Stock</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class='col-md-12'>
                                <p>No books found.</p>
                            </div>
                        @endforelse
                    </div>
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

