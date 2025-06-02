@extends('layout.layout-admin')
@section('title', 'Variant produk')


@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{ env('TYPE_URL') == 'http' ? asset('resources/css/admin.css') : secure_asset('resources/css/admin.css') }}">

@endpush

@section('meta')
<meta name="_token" content="{{ csrf_token() }}">
<meta name="_appurl" content="{{ env('BASE_URL') }}">
@endsection

@section('body')
<section class="pt-5 pb-5">
    <div class="container">
        <h1 class="mb-3">Daftar variant {{ $nama }}</h1>
        <button class="btn btn-primary mb-3 mt-2" data-id="{{ $id }}" id="btnTambahProdukVariant">[+] Tambah Variant</button>
        <div class="row">
            <div class="col-12 col-xl-5">  
                @if($errors->any())
                <div class="alert alert-danger">
                    Semua inputan harus diisi dengan benar
                </div>
                @endif
                <form id="form-tambah" method="post" enctype="multipart/form-data">
                    
                </form>
            </div>
        </div>
        <form action="" id="formUbah" method="post">
            <div class="row" id="rowKonten">
                <div class="col-12 col-md-12 col-xl-12">
                    @if(Session::has('status') && Session::has('alert'))
                        <div class="alert alert-{{ Session::get('alert') }}">{{ Session::get('status') }}</div>
                    @endif
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Variant</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach($variants as $index => $variant)
                            <tr>
                                <th>{{ $variants->firstItem() + $index }}</th>
                                <td>{{ $variant->nama }}</td>
                                <td>{{ $variant->variant }}</td>
                                <td>{{ $variant->harga }}</td>
                                <td>{{ $variant->jumlah }}</td>
                                <td><img src="{{ asset('storage/image-variant/'.$variant->foto) }}" width="100"></td>
                                <td class="d-flex gap-3">
                                <button type="button" data-id="{{ $variant->id }}" class="btn btn-info btnEdit">Edit</button>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="7">{{ $variants->links() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
        <div class="row">
             <a href="{{ route('admin.manage') }}" class="hover">&laquo;Kembali ke halaman sebelumnya</a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/45.1.0/ckeditor5.umd.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
</script>
<script src="{{ env('TYPE_URL') == 'http' ? asset('resources/js/admin.js') : secure_asset('resources/js/admin.js') }}"></script>
@endpush
