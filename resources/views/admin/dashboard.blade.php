@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-header">Total Books</div>
                                <div class="card-body">
                                    <h4 class="card-title">{{ $totalBooks ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-header">Total Users</div>
                                <div class="card-body">
                                    <h4 class="card-title">{{ $totalUsers ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-warning mb-3">
                                <div class="card-header">Borrowed Books</div>
                                <div class="card-body">
                                    <h4 class="card-title">{{ $borrowedBooks ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-danger mb-3">
                                <div class="card-header">Overdue Books</div>
                                <div class="card-body">
                                    <h4 class="card-title">{{ $overdueBooks ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">Recent Books</div>
                                <div class="card-body">
                                    @if(isset($recentBooks) && count($recentBooks) > 0)
                                        <ul class="list-group">
                                            @foreach($recentBooks as $book)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    {{ $book->title }}
                                                    <span class="badge badge-primary badge-pill">{{ $book->author }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>No recent books found.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">Recent Users</div>
                                <div class="card-body">
                                    @if(isset($recentUsers) && count($recentUsers) > 0)
                                        <ul class="list-group">
                                            @foreach($recentUsers as $user)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    {{ $user->name }}
                                                    <span class="badge badge-secondary badge-pill">{{ $user->email }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>No recent users found.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

