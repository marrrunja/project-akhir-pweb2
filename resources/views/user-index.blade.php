@extends('layout.layout')
@section('title', 'Halaman Index User')

@section('body')
@if(Session::has('status'))
    {{ Session::get('status') }}
@endif
<h1>Selamat datang user</h1>
@endsection