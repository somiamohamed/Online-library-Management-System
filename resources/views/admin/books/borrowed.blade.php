@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Borrowed Books</h2>

    @if($books->count() > 0)
        <ul class="list-group">
            @foreach($books as $book)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $book->title }}
                    <span class="badge bg-warning text-dark">{{ $book->author }}</span>
                </li>
            @endforeach
        </ul>
    @else
        <p>No borrowed books found.</p>
    @endif
</div>
@endsection
