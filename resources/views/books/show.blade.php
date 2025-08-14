@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Book Details') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if($book->cover_image)
                                <img src="{{ asset('storage/'. $book->cover_image) }}" class="img-fluid"
                                     alt="{{ $book->title }}" style="max-width: 100%; height: auto;">
                            @else
                                <img src="https://via.placeholder.com/200"
                                     class="img-fluid"
                                     alt="No Image"
                                     style="max-width: 100%; height: auto;">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h3>{{ $book->title }}</h3>
                            <p><strong>Author:</strong> {{ $book->author }}</p>
                            <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
                            <p><strong>Category:</strong> {{ $book->category }}</p>
                            <p><strong>Publication Year:</strong> {{ $book->publication_year }}</p>
                            <p><strong>Description:</strong> {{ $book->description }}</p>
                            <p><strong>Available Copies:</strong> {{ $book->copies - $book->borrowed_count }}</p>

                            <div class="mt-4">
                                @if($book->copies - $book->borrowed_count > 0)
                                    <form action="{{ route('books.borrow', $book->id) }}" method="POST"
                                          style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Borrow Book</button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary" disabled>Out of Stock</button>
                                @endif
                                <a href="{{ route('books.index') }}" class="btn btn-primary ml-2">Back to Books</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

