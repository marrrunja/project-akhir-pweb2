@extends('layout.layout')
@section('title', 'Halaman Login')

@push('styles')
<link rel="stylesheet" href="{{ asset('resources/css/style.css') }}">  
@endpush
@section('body')
<div class="login-container">
    @if(Session::has('status'))
        {{ Session::get('status') }}
    @endif
    <h2 style="text-align: center;">Halaman Login</h2>
    <form method="POST" action="/login/index/post">
        @csrf
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button role="button" type="submit">Login</button>
        <!-- <button><a href="home.html" role="button" style="text-decoration: none;">Login</a></button> -->
    </form>
</div>
@endsection
