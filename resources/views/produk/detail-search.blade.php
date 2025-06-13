@extends('layout.layout')

@section('title', 'Detail pencarian')

@push('styles')
<!-- Favicons -->
<!-- Favicon -->
<link href="{{ custom_asset('assets/img/favicon.png') }}" rel="icon">
<link href="{{ custom_asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

<!-- Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Quicksand:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="{{ custom_asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ custom_asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ custom_asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
<link href="{{ custom_asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
<link href="{{ custom_asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<link href="{{ custom_asset('assets/vendor/drift-zoom/drift-basic.css') }}" rel="stylesheet">

<!-- Main CSS File -->
<link href="{{ custom_asset('assets/css/main.css') }}" rel="stylesheet">

@endpush

@section('meta')
<meta name="_appurl" content="{{ env('BASE_URL') }}">
<meta name="_token" content="{{ csrf_token() }}">
@endsection

@section('body')
@if(count($products) > 0)
<section id="starter-section" class="starter-section section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Hasil pencarian</h2>
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
        <div class="row gy-3 gy-md-0">
            @foreach($products as $variant)
            <div class="col-12 col-md-6 col-xl-3">
                <form method="post" action="{{ route('transaksi.order', $variant->id) }}">
                    @csrf
                    @method('POST')
                    <div class="card">
                        <img src="{{ asset('storage/image-variant/'.$variant->foto) }}" class="card-img-top">
                        <div class="card-body">
                            @error('jumlah') <div class="fw-semibold text-danger">{{ $message }}</div> @enderror
                            @error('harga') <div class="fw-semibold text-danger">{{ $message }}</div> @enderror
                            <h5 class="card-title">{{ $variant->variant }}</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">{{ $variant->nama }}</h6>

                            <div class="card-subtitle text-secondary">Sisa: {{ $variant->jumlah }}</div>
                            <div class="mt-3 mb-3">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btnTambah">+</button>
                                    <input type="hidden" name="jumlah" id="jumlah" data-max="{{ $variant->jumlah }}"
                                        value="0">
                                    <button type="button" disabled class="btn btn-outline-success btnHasil">0</button>
                                    <button type="button" class="btn btn-success btnKurang">-</button>

                                </div>
                                <div class="text-secondary text-danger mt-2 pesan d-none fw-semibold"></div>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-outline-success">Rp.
                                    {{ number_format($variant->harga, 0, ",", ".") }}</button>
                                <button type="button" data-id="{{ $variant->id }}"
                                    class="btn btn-outline-success btnCart">
                                    <i class="bi bi-cart-fill me-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</section>
@else
<section class="pt-5 pb-5">
    <div class="container">
        <h3>Ups...  produk yang kamu cari tidak ditemukan <i class="bi bi-emoji-frown"></i></h3>
    </div>
</section>
@endif
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
<script src="{{ custom_asset('resources/js/order.js') }}"></script>

@endpush
