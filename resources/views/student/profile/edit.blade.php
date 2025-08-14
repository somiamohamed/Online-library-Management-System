@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-8'>
            <div class='card'>
                <div class='card-header'>{{ __('Edit Profile') }}</div>

                <div class='card-body'>
                    <form method='POST' action='{{ route('student.profile.update') }}' enctype='multipart/form-data'>
                        @csrf
                        @method('PUT')

                        <div class='form-group row'>
                            <label for='name' class='col-md-4 col-form-label text-md-right'>{{ __('Name') }}</label>

                            <div class='col-md-6'>
                                <input id='name' type='text' class='form-control @error('name') is-invalid @enderror' name='name' value='{{ old('name', $user->name) }}' required autocomplete='name' autofocus>

                                @error('name')
                                    <span class='invalid-feedback' role='alert'>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class='form-group row'>
                            <label for='email' class='col-md-4 col-form-label text-md-right'>{{ __('Email') }}</label>

                            <div class='col-md-6'>
                                <input id='email' type='email' class='form-control @error('email') is-invalid @enderror' name='email' value='{{ old('email', $user->email) }}' required autocomplete='email'>

                                @error('email')
                                    <span class='invalid-feedback' role='alert'>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class='form-group row'>
                            <label for='phone' class='col-md-4 col-form-label text-md-right'>{{ __('Phone') }}</label>

                            <div class='col-md-6'>
                                <input id='phone' type='text' class='form-control @error('phone') is-invalid @enderror' name='phone' value='{{ old('phone', $user->phone) }}'>

                                @error('phone')
                                    <span class='invalid-feedback' role='alert'>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class='form-group row'>
                            <label for='address' class='col-md-4 col-form-label text-md-right'>{{ __('Address') }}</label>

                            <div class='col-md-6'>
                                <textarea id='address' class='form-control @error('address') is-invalid @enderror' name='address' rows='3'>{{ old('address', $user->address) }}</textarea>

                                @error('address')
                                    <span class='invalid-feedback' role='alert'>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class='form-group row mb-0'>
                            <div class='col-md-6 offset-md-4'>
                                <button type='submit' class='btn btn-primary'>
                                    {{ __('Update Profile') }}
                                </button>
                                <a href='{{ route('student.dashboard') }}' class='btn btn-secondary ml-2'>
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

