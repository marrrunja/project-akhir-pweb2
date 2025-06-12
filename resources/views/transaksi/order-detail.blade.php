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
                    <li><a href="/variant/{{ $produkVariant->produk->id }}">Produk Variant</a></li>
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
            <h2>Detail Pesanan</h2>
            <p>Klik Konfirmasi untuk melakukan pembayaran</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up">
            @if(Session::has('status'))
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-xl-6">
                    <div class="alert alert-primary">
                        {{ Session::get('status') }}
                    </div>
                </div>
            </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-xl-5">
                <div class="card">
                    <div class="card">
                        <img src="{{ asset('storage/image-variant/'.$produkVariant->foto) }}" alt="{{ $produkVariant->nama }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $produkVariant->produk->nama }}</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">{{ $produkVariant->variant }}</h6>
                            <p class="card-text" >Jumlah Beli <span id="jumlah">{{ $jumlah }}</span></p>
                            <div class="card-text">Harga Satuan Rp <span id="hargaSatuan">{{ number_format($produkVariant->harga, 0, ",", ".") }}</span></div>
                            <div class="card-text">Total Rp <span id="hargaTotal">{{ number_format($total, 0, ",", ".") }}</span></div>
                            <button type="button" id="btnBayar" data-id="{{ $produkVariant->id }}" class="btn btn-primary mt-3 mb-3">Konfirmasi</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

<script src="{{ env('TYPE_URL') == 'http' ? asset('resources/js/checkout.js') : secure_asset('resources/js/checkout.js') }}"></script>
@endpush
