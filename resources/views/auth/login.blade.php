@extends('layouts.auth', ['title' => 'Login'])

@push('header')
<p class="login-box-msg">
    Login untuk masuk aplikasi
</p>
@endpush

@section('content')
<form action="{{ route('login.store') }}" method="post">
    @csrf
    <div class="input-group mb-3">
        <input type="text" name="nik_username" class="form-control @error('nik_username') is-invalid @enderror" value="{{ @old('nik_username') }}" autofocus placeholder="NIK/Username..">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-address-card"></span>
            </div>
        </div>
        @error('nik_username')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="input-group mb-3">
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password..">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt mr-2"></i> Login</button>
        </div>
    </div>
</form>
@endsection
