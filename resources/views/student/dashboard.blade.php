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

                    <div class='row'>
                        <div class='col-md-4'>
                            <div class='card text-white bg-info mb-3'>
                                <div class='card-header'>Books Borrowed</div>
                                <div class='card-body'>
                                    <h4 class='card-title'>{{ $borrowedBooksCount ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-4'>
                            <div class='card text-white bg-warning mb-3'>
                                <div class='card-header'>Overdue Books</div>
                                <div class='card-body'>
                                    <h4 class='card-title'>{{ $overdueBooksCount ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-4'>
                            <div class='card text-white bg-success mb-3'>
                                <div class='card-header'>Available Books</div>
                                <div class='card-body'>
                                    <h4 class='card-title'>{{ $availableBooksCount ?? 0 }}</h4>
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
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($borrowedBooks as $borrow)
                                            <tr>
                                                <td>{{ $borrow->book->title }}</td>
                                                <td>{{ $borrow->book->author }}</td>
                                                <td>{{ $borrow->borrowed_at->format('M d, Y') }}</td>
                                                <td>{{ $borrow->due_at->format('M d, Y') }}</td>
                                                <td>
                                                    @if($borrow->returned_at)
                                                        <span class='badge badge-success'>Returned</span>
                                                    @elseif($borrow->due_at->isPast())
                                                        <span class='badge badge-danger'>Overdue</span>
                                                    @else
                                                        <span class='badge badge-info'>Borrowed</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>You have not borrowed any books yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>