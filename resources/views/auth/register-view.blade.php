@extends('layout.layout-admin')
@section('title', 'Register')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('resources/css/style.css') }}">
@endpush

@section('body')
    <div class="login-container">
    <!-- Bagian Tab -->
    <div class="d-flex justify-content-center">
        <div class="register-wrapper">
            <ul class="nav nav-tabs justify-content-evenly mb-3">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/register/index') }}">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/login/index') }}">Log In</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Form -->
    <div class="tab-content">
        <div class="tab-pane fade show active">
            <form method="POST" action="/register/index" class="text-center">
                @csrf
                @foreach (['username', 'desa', 'jalan'] as $field)
                    @error($field)
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                @endforeach

                <div>
                    <label class="text-start w-100 ps-3">Username</label>
                    <input type="text" name="username" placeholder="Masukkan Username Anda" required>
                </div>
                <div>
                    <label class="text-start w-100 ps-3">Password</label>
                    <input type="password" name="password" placeholder="Masukkan Password Anda" required>
                </div>
                <div>
                    <label class="text-start w-100 ps-3">Kecamatan</label>
                    <select name="kecamatan" id="kecamatan">
                        <option value="">Pilih Kecamatan</option>
                    </select>
                </div>
                <div>
                    <label class="text-start w-100 ps-3">Desa</label>
                    <select name="desa" id="desa">
                        <option value="">Pilih Desa</option>
                    </select>
                </div>
                <div>
                    <label class="text-start w-100 ps-3">Alamat</label>
                    <input type="text" name="alamat" placeholder="Masukkan Jalan/Alamat Spesifik">
                </div>
                <div class="d-flex justify-content-center">
                    <button class="w-50" type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('resources/js/alamat.js') }}"></script>
@endpush
