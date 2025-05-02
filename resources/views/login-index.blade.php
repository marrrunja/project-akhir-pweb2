@extends('layout.layout')

@section('title', 'Halaman Login')

@section('body')
<h1>Halaman Login</h1>
<form action="/login/index" method="post">
    <div>
        <label for="email">Username</label>
        <input type="text" name="email">
    </div>
    <div>
        <label for="password">Password</label>
    </div>
</form>
@endsection