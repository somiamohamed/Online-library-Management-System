@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    <div class="row justify-content-center text-center">
                        <div class="col-md-3">
                            <div class="card mb-3 border-primary">
                                <div class="card-header bg-primary text-white">Total Books</div>
                                <div class="card-body bg-white">
                                    <h4 class="card-title">{{ $totalBooks ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card mb-3 border-success">
                                <div class="card-header bg-success text-white">Total Users</div>
                                <div class="card-body bg-white">
                                    <h4 class="card-title">{{ $totalUsers ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card mb-3 border-warning">
                                <div class="card-header bg-warning text-white">Borrowed Books</div>
                                <div class="card-body bg-white">
                                    <h4 class="card-title">{{ $borrowedBooks ?? 0 }}</h4>
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

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="card border-primary mb-3">
                                    <div class="card-header bg-primary text-white">Manage Books</div>
                                    <div class="card-body">
                                        <a href="{{ route('admin.books.index') }}" class="btn btn-outline-primary w-100 mb-2">View All Books</a>
                                        <a href="{{ route('admin.books.create') }}" class="btn btn-outline-success w-100 mb-2">Add New Book</a>
                                        <a href="{{ route('admin.books.borrowed') }}" class="btn btn-outline-warning w-100">Borrowed Books</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card border-secondary mb-3">
                                    <div class="card-header bg-secondary text-white">Manage Users</div>
                                    <div class="card-body">
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary w-100 mb-2">View All Students</a>                                        
                                        <form action="{{ route('admin.users.search') }}" method="GET" class="d-flex mb-3" onsubmit="return validateForm()">
                                            <input type="text" id="student_id" name="student_id" class="form-control me-2" placeholder="Search by Student ID" required>
                                            <button type="submit" class="btn btn-outline-dark">Search</button>
                                        </form>

                                        @if (session('error'))
                                            <div class="alert alert-danger" role="alert">
                                                {{ session('error') }}
                                            </div>
                                        @endif

                                        <script>
                                            function validateForm() {
                                                const input = document.getElementById('student_id');
                                                if (input.value.trim() === '') {
                                                    alert('Please enter a Student ID before searching.');
                                                    return false;
                                                }
                                                return true;
                                            }
                                        </script>
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

