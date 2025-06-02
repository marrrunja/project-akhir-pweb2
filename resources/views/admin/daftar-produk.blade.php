@extends('layout.layout-admin')
@section('title', 'Daftar Produk')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('resources/css/admin.css') }}">
@endpush

@section('meta')
<meta name="_appurl" content="{{ env('BASE_URL') }}">
@endsection

@section('body')
<section class="pt-5 pb-5">
    <div class="container">
        <h1>Daftar produk</h1>
        <div class="row">
            <div class="col-12 col-md-10 col-xl-5">
                <div class="input-group mb-3 mt-2">
                  <input type="text" name="keyword" id="inputCari" class="form-control border-primary border-2" placeholder="Cari nama produk atau kategori...." aria-label="Cari nama produk atau kategori...." aria-describedby="button-addon2">
                  <button class="btn btn-primary border-primary border-2" type="button" id="btnCari"><i class="bi bi-search"></i></button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12" id="content-produk">
                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Detail</th>
                        <th>Kategori</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $product->nama }}</td>
                            <td>{{ $product->detail }}</td>
                            <td>{{ $product->kategori }}</td>
                            <td><img src="{{ asset('storage/images/' . $product->foto) }}" width="100"></td>
                            <td class="d-flex gap-3">
                                <a href="{{ route('admin.detailProduk', $product->id) }}" class="btn btn-primary">Lihat variant produk</a>
                                <a href="{{ route('produk.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
             <a href="/admin/index" class="hover">&laquo;Kembali ke halaman utama</a>
        </div>
    </div>
</section>
@endsection


@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/45.1.0/ckeditor5.umd.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
</script>
<script src="{{ env('TYPE_URL') == 'http' ? asset('resources/js/api.js') : secure_asset('resources/js/api.js') }}"></script>
@endpush