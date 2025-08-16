@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Book') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.books.update', $book->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $book->title) }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="author" class="col-md-4 col-form-label text-md-right">{{ __('Author') }}</label>

                            <div class="col-md-6">
                                <input id="author" type="text" class="form-control @error('author') is-invalid @enderror" name="author" value="{{ old('author', $book->author) }}" required autocomplete="author">

                                @error('author')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="4">{{ old('description', $book->description) }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Number of Copies') }}</label>
                            <div class="col-md-6">
                                <input id="quantity" type="number" 
                                    class="form-control @error('quantity') is-invalid @enderror" 
                                    name="quantity" value="{{ old('quantity', $book->quantity) }}" min="1" required>
                                @error('quantity')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cover_url" class="col-md-4 col-form-label text-md-right">{{ __('Cover URL') }}</label>
                            <div class="col-md-6">
                                <input id="cover_url" type="url" 
                                    class="form-control @error('cover_url') is-invalid @enderror" 
                                    name="cover_url" value="{{ old('cover_url', $book->cover_url) }}" placeholder="https://example.com/cover.jpg">
                                @error('cover_url')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        @if($book->cover_url)
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Current Cover Preview') }}</label>
                            <div class="col-md-6">
                                <img src="{{ $book->cover_url }}" alt="Current cover" class="img-thumbnail" style="max-width: 150px;">
                            </div>
                        </div>
                        @endif

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                            <div class="col-md-6">
                                <select id="status" 
                                        class="form-control @error('status') is-invalid @enderror" 
                                        name="status" required>
                                    <option value="available" {{ old('status', $book->status) == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="borrowed" {{ old('status', $book->status) == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Book') }}
                                </button>
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary ml-2">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

