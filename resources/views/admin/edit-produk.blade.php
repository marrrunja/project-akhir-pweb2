@extends('layout.layout-admin')
@section('title', 'Daftar Produk')

@push('styles')
<link href="../../../../templatesbadmin2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700,900" rel="stylesheet">
<link href="../../../../templatesbadmin2/css/sb-admin-2.min.css" rel="stylesheet">
@endpush

@section('meta')
<meta name="_token" content="{{ csrf_token() }}">
<meta name="_appurl" content="{{ env('BASE_URL') }}">
@endsection

@section('body')
<div id="wrapper">

    <!-- side bar -->
    @include('layout.navbar_admin')
    <!-- end of side bar -->

    <div id="content">

        <!-- Topbar -->
        @include('layout.nav-admin')
        <!-- End of Topbar -->
        <div class="container-fluid">
            <div class="row">
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Silahkan Masukkan Perubahan Yang Ingin Anda
                                Buat</h6>
                        </div>

                        <div class="card-body">
                            @if(Session::has('status') && Session::has('alert'))
                            <div class="alert alert-{{ Session::get('alert') }}">
                                {{ Session::get('status') }}
                            </div>
                            @endif

                            <form method="post" action="{{ route('produk.doEdit', $produk->id) }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-12 col-md-12 col-xl-4 text-center">
                                        <img src="{{ asset('storage/images/' . $produk->foto) }}"
                                            class="img-fluid img-thumbnail mb-3 mb-md-3 mb-xl-0 mt-md-2 w-100 w-md-50"
                                            alt="{{ $produk->nama }}">
                                    </div>
                                    <div class="col-12 col-md-12 col-xl-8">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Produk</label>
                                            <input type="text" id="nama" name="nama"
                                                class="form-control @error('nama') is-invalid @enderror"
                                                value="{{ $produk->nama }}">
                                            @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="detail" class="form-label">Detail Produk</label>
                                            <input type="text" id="detail" name="detail"
                                                class="form-control @error('detail') is-invalid @enderror"
                                                value="{{ $produk->detail }}">
                                            @error('detail')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="kategori" class="form-label">Kategori</label>
                                            <select id="kategori"
                                                class="form-control @error('kategori') is-invalid @enderror"
                                                name="kategori">
                                                @foreach($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == $produk->kategori_id ? 'selected' : '' }}>
                                                    {{ $category->kategori }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('kategori')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <small class="text-primary d-block mb-1">Kosongkan jika tidak ingin
                                                diganti</small>
                                            <label for="gambar" class="form-label btn btn-primary">Ganti Gambar
                                                (opsional)</label>
                                            <input type="file" id="gambar" name="gambar" class="form-control d-none @error('gambar') is-invalid @enderror">
                                            <input type="hidden" name="gambarLama" value="{{ $produk->foto }}">
                                            @error('gambar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="d-flex justify-content-center align-items-center">
                                            <button type="submit" class="btn btn-warning mr-2">Ubah</button>
                                            <a href="/admin/produk" class="btn btn-danger">Kembali</a>
                                        </div>


                                    </div>

                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>




</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/45.1.0/ckeditor5.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
</script>
<script src="{{ env('TYPE_URL') == 'http' ? asset('resources/js/api.js') : secure_asset('resources/js/api.js') }}">
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../../../templatesbadmin2/js/sb-admin-2.min.js"></script>
   <script type="module" src="{{ custom_asset('resources/js/logout.js') }}"></script>
@endpush
