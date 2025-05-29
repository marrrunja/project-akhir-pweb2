@extends('layout.layout-admin')
@section('title', 'Login')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('resources/css/style.css') }}">
@endpush

@section('body')
<div class="login-container">
    <!-- Tab -->
    <div class="d-flex justify-content-center">
        <div class="register-wrapper">
            <ul class="nav nav-tabs justify-content-evenly mb-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/register/index') }}">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/login-view') }}">Log In</a>
                </li>
            </ul>

        </div>
    </div>

    <!-- Form -->
    <div class="tab-content">
        <div class="tab-pane fade show active">
            <form method="POST" action="/login/index/post" class="text-center">
                @csrf
                @if(Session::has('status'))
                    <div class="alert alert-danger">{{ Session::get('status') }}</div>
                @endif
                <div class="mb-2">
                    <label for="username" class="text-start w-100 ps-3">Username</label>
                    <input type="text" id="username" name="username" placeholder="Masukkan Username Anda" required>
                </div>
                <div class="mb-2">
                    <label for="password" class="text-start w-100 ps-3">Password</label>
                    <input type="password" name="password" id="password" placeholder="Masukkan Password Anda" required>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="w-50" type="submit">Login</button>
                </div>
                <p class="mt-2 text-center">Belum punya akun? <a href="/register">Register</a></p>
            </form>
        </div>
    </div>
</div>
@endsection
