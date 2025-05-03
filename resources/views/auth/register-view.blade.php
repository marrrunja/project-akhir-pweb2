@extends('layout.layout')
@section('title', 'Halaman Register')

@push('styles')
<link rel="stylesheet" href="{{ asset('resources/css/style.css') }}">  
@endpush

@section('body')
<div class="login-container">
    @error('username')
    {{ $message }}
    @enderror
    @error('desa')
    {{ $message }}
    @enderror
    @error('jalan')
    {{ $message }}
    @enderror
    <h2 style="text-align: center;">Halaman Register</h2>
    <form method="POST" action="{{ route('register-proses') }}">
        @csrf
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="kecamatan" id="kecamatan">
            <option value="">Pilih Kecamatan</option>
        </select>
        <select name="desa" id="desa">
            <option value="">Pilih desa</option>
        </select>
        <input type="text" name="alamat" placeholder="Masukkan jalan/alamat spesifik">
        <button role="button" type="submit">Register</button>
        <button><a href="/" role="button" style="text-decoration: none;">Kembali</a></button>
    </form>
</div>
@endsection

@push('scripts')
<script src="{{ asset('resources/js/alamat.js') }}"></script>
@endpush
