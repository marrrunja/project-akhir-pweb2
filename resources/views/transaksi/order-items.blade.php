@extends('layout.layout')

@section('title', 'History pembelian')

@push('styles')
<!-- Favicons -->
<!-- Favicons -->
<link href="{{ custom_asset('assets/img/favicon.png') }}" rel="icon">
<link href="{{ custom_asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

<!-- Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Quicksand:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=info" />

<!-- Vendor CSS Files -->
<link href="{{ custom_asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ custom_asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ custom_asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
<link href="{{ custom_asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
<link href="{{ custom_asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<link href="{{ custom_asset('assets/vendor/drift-zoom/drift-basic.css') }}" rel="stylesheet">
<!-- Main CSS File -->
<link href="{{ custom_asset('assets/css/main.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ custom_asset('resources/css/user.css') }}">
@endpush

@section('meta')
<meta name="_appurl" content="{{ env('BASE_URL') }}">
<meta name="_token" content="{{ csrf_token() }}">
@endsection

@section('body')
<main class="main">
    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="/">Home</a></li>
                    <li><a href="/order/index">Order History</a></li>
                    <li class="current">Detail Order</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Daftar Pesanan anda</h2>
            <p>Klik lihat detail untuk melihat detail setiap pesanan</p>
        </div><!-- End Section Title -->
        <div class="container" data-aos="fade-up" id="content">
            <!-- Header untuk perangkat menengah ke atas -->
            <div class="row mb-2 px-3 py-2 bg-ungu text-white rounded shadow-sm fw-semibold text-center d-none d-md-flex">
                <div class="col-md-3">Foto</div>
                <div class="col-md-2">Nama Produk</div>
                <div class="col-md-2">Jumlah</div>
                <div class="col-md-2">Harga Satuan</div>
                <div class="col-md-2">Total Harga</div>
            </div>
            @foreach($items as $item)
            <!-- Card responsive untuk tiap item -->
            <div id="row-{{ $item->id }}" class="row justify-content-center px-3 py-3 mb-3 bg-white border rounded shadow-sm align-items-center">
                <!-- Mobile View -->
                <div class="d-block d-md-none">
                    <div class="d-flex mb-2">
                        <div class="me-3">
                            <img src="{{ asset('storage/image-variant/'.$item->foto) }}" alt="Foto Produk"
                                class="img-fluid rounded" style="max-width: 100px;">
                        </div>
                        <div>
                            <div><strong>{{ $item->nama }}</strong> <br><small
                                    class="text-muted">{{ $item->variant }}</small></div>
                            <div>Jumlah: <strong>{{ $item->jumlah }}</strong></div>
                            <div>Harga: Rp{{ number_format($item->harga, 0, ',', '.') }}</div>
                            <div>Total: Rp{{ number_format($item->total_harga, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Desktop View -->
                <div class="d-none d-md-flex text-center align-items-center">
                    <div class="col-md-3">
                        <img src="{{ asset('storage/image-variant/'.$item->foto) }}" alt="Foto Produk"
                            class="img-fluid rounded" style="max-width: 100px;">
                    </div>
                    <div class="col-md-2">
                        <strong>{{ $item->nama }}</strong><br><small class="text-muted">{{ $item->variant }}</small>
                    </div>
                    <div class="col-md-2">
                        {{ $item->jumlah }}
                    </div>
                    <div class="col-md-2">
                        Rp{{ number_format($item->harga, 0, ',', '.') }}
                    </div>
                    <div class="col-md-2">
                        Rp{{ number_format($item->total_harga, 0, ',', '.') }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <!-- /Starter Section Section -->
</main>
@endsection

@push('scripts')
<!-- Vendor JS Files -->
<script src="{{ custom_asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ custom_asset('assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ custom_asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ custom_asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ custom_asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ custom_asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ custom_asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ custom_asset('assets/vendor/drift-zoom/Drift.min.js') }}"></script>
<script src="{{ custom_asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<!-- Main JS File -->
<script src="{{ custom_asset('assets/js/main.js') }}"></script>
<script src="{{ custom_asset('resources/js/api.js') }}"></script>

@endpush
