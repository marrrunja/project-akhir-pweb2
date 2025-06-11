@extends('layout.layout-admin')
@section('title', 'Variant produk')


@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
        href="{{ env('TYPE_URL') == 'http' ? asset('resources/css/admin.css') : secure_asset('resources/css/admin.css') }}">
    <link href="../../../../templatesbadmin2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700,900" rel="stylesheet">
    <link href="../../../../templatesbadmin2/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        @media (max-width: 768px) {
            .responsive-heading {
                font-size: 1.5rem;
                /* contoh untuk tablet */
            }
        }

        @media (max-width: 576px) {
            .responsive-heading {
                font-size: 1.25rem;
                /* contoh untuk HP */
            }
        }
    </style>

@endpush

@section('meta')
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="_appurl" content="{{ env('BASE_URL') }}">
@endsection

@section('body')
    <div id="wrapper" class="d-flex">
        <div class="d-none d-md-block">
            @include('layout.navbar_admin')
        </div>
        <div class="container">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center">
                    <!-- tolong ngab amar, pas mode tablet/andro, di klik ngg muncul navbar -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <h3 class="responsive-heading text-center mt-2">Daftar variant {{ $nama }}</h3>
                </div>

                <div class="card-body">
                    <div class="container">
                        <div>
                            <button class="btn btn-primary mb-3 mt-2" data-id="{{ $id }}" id="btnTambahProdukVariant">[+]
                                Tambah Variant</button>
                        </div>
                        <form action="" id="formUbah" method="post">
                            <div class="row" id="rowKonten">
                                <div class="table-responsive" id="content-row">

                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Varian</th>
                                                <th class="text-center">Harga</th>
                                                <th class="text-center">Jumlah</th>
                                                <th class="text-center">Foto</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($variants as $index => $variant)
                                                <tr>
                                                    <td class="text-center align-middle px-5">
                                                        {{ $variants->firstItem() + $index }}
                                                    </td>
                                                    <td class="text-center align-middle px-5">{{ $variant->nama }}</td>
                                                    <td class="text-center align-middle px-5">{{ $variant->variant }}</td>
                                                    <td class="text-center align-middle px-5">{{ $variant->harga }}</td>
                                                    <td class="text-center align-middle px-5">{{ $variant->jumlah }}</td>
                                                    <td class="text-center align-middle px-5">
                                                        <img src="{{ asset('storage/image-variant/' . $variant->foto) }}"
                                                            width="100">
                                                    </td>
                                                    <td class="text-center align-middle px-5">
                                                        <button type="button" data-id="{{ $variant->id }}"
                                                            class="btn btn-info btn-sm btnEdit">Edit</button>
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
    <script src="{{ custom_asset('resources/js/admin.js') }}"></script>
    <script src="{{ env('TYPE_URL') == 'http' ? asset('resources/js/api.js') : secure_asset('resources/js/api.js') }}">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../templatesbadmin2/js/sb-admin-2.min.js"></script>
@endpush















{{-- <!-- @extends('layout.layout-admin')

@section('title', 'Variant produk')


@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
        href="{{ env('TYPE_URL') == 'http' ? asset('resources/css/admin.css') : secure_asset('resources/css/admin.css') }}">

@endpush

@section('meta')
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="_appurl" content="{{ env('BASE_URL') }}">
@endsection

@section('body')
    <section class="pt-5 pb-5">
        <div class="container">
            <h1 class="mb-3">Daftar variant {{ $nama }}</h1>
            <button class="btn btn-primary mb-3 mt-2" data-id="{{ $id }}" id="btnTambahProdukVariant">[+] Tambah
                Variant</button>
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
                                        <td><img src="{{ asset('storage/image-variant/' . $variant->foto) }}" width="100"></td>
                                        <td class="d-flex gap-3">
                                            <button type="button" data-id="{{ $variant->id }}"
                                                class="btn btn-info btnEdit">Edit</button>
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
    <script src="{{ custom_asset('resources/js/admin.js') }}"></script>
@endpush -->

--}}