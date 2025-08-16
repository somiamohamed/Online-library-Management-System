@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <div class='card'>
                <div class='card-header'>{{ ('Student Dashboard') }}</div>

                <div class='card-body'>
                    @if (session('status'))
                        <div class='alert alert-success' role='alert'>
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row justify-content-center text-center">
                        <div class="col-md-4">
                            <div class="card mb-3 border-info">
                                <div class="card-header bg-info text-white">Books Borrowed</div>
                                <div class="card-body bg-white">
                                    <h4 class="card-title">{{ $borrowedBooksCount ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mb-3 border-success">
                                <div class="card-header bg-success text-white">Available Books</div>
                                <div class="card-body bg-white">
                                    <h4 class="card-title">{{ $availableBooksCount ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='card mt-4'>
                        <div class='card-header'>{{ ('Your Borrowed Books') }}</div>
                        <div class='card-body'>
                            @if(isset($borrowedBooks) && count($borrowedBooks) > 0)
                                <table class='table table-bordered'>
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Borrowed Date</th>
                                            <th>Due Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($borrowedBooks as $borrow)
                                            <tr>
                                                <td>{{ $borrow->book->title }}</td>
                                                <td>{{ $borrow->book->author }}</td>
                                                <td>{{ $borrow->borrowed_at ? $borrow->borrowed_at->format('M d, Y') : '-' }}</td>
                                                <td>{{ $borrow->return_by ? $borrow->return_by->format('M d, Y') : '-' }}</td>
                                                <td>
                                                    <form action="{{ route('books.return', $borrow->book->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-warning btn-sm">
                                                            Return
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{ $borrowedBooks->links() }}
                            @else
                                <p>You have not borrowed any books yet.</p>
                            @endif
                        </div>
                    </div>

                    <div class='card mt-4'>
                        <div class='card-header'>{{ ('Borrow History') }}</div>
                        <div class='card-body'>
                            @if(isset($borrowHistory) && count($borrowHistory) > 0)
                                <table class='table table-bordered'>
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Borrowed Date</th>
                                            <th>Returned Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($borrowHistory as $history)
                                            <tr>
                                                <td>{{ $history->book->title }}</td>
                                                <td>{{ $history->book->author }}</td>
                                                <td>{{ $history->borrowed_at ? $history->borrowed_at->format('M d, Y') : '-' }}</td>
                                                <td>{{ $history->returned_at ? $history->returned_at->format('M d, Y') : '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{ $borrowHistory->links() }}
                            @else
                                <p>You have not returned any books yet.</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
