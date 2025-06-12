@extends('layout.layout')

@section('title', 'Halaman Produk varian')


@push('styles')
<!-- Favicon & Apple Touch Icon -->
<link href="{{ env('TYPE_URL') == 'http' ? asset('assets/img/favicon.png') : secure_asset('assets/img/favicon.png') }}"
    rel="icon">
<link
    href="{{ env('TYPE_URL') == 'http' ? asset('assets/img/apple-touch-icon.png') : secure_asset('assets/img/apple-touch-icon.png') }}"
    rel="apple-touch-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Quicksand:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

<!-- Vendor CSS Files -->
<link
    href="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/bootstrap/css/bootstrap.min.css') : secure_asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}"
    rel="stylesheet">
<link
    href="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') : secure_asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}"
    rel="stylesheet">
<link
    href="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/swiper/swiper-bundle.min.css') : secure_asset('assets/vendor/swiper/swiper-bundle.min.css') }}"
    rel="stylesheet">
<link
    href="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/aos/aos.css') : secure_asset('assets/vendor/aos/aos.css') }}"
    rel="stylesheet">
<link
    href="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/glightbox/css/glightbox.min.css') : secure_asset('assets/vendor/glightbox/css/glightbox.min.css') }}"
    rel="stylesheet">
<link
    href="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/drift-zoom/drift-basic.css') : secure_asset('assets/vendor/drift-zoom/drift-basic.css') }}"
    rel="stylesheet">

<!-- Main CSS File -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<link href="{{ env('TYPE_URL') == 'http' ? asset('assets/css/main.css') : secure_asset('assets/css/main.css') }}"
    rel="stylesheet">
<link rel="stylesheet" href="{{ custom_asset('resources/css/user.css') }}">
<!-- {{-- <link rel="stylesheet" type="text/css" href="{{ asset('resources/css/style.css') }}"> --}} -->
@endpush

@section('meta')
<meta name="_token" content="{{ csrf_token() }}">
<meta name="_appurl" content="{{ env('BASE_URL') }}">
@endsection

@section('body')
<main class="main">
    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="/">Home</a></li>
                    <li><a href="/produk/index">Produk</a></li>
                    <li class="current">Produk Variant</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Daftar Produk variant</h2>
            <p>Klik lihat detail untuk melihat detail setiap pesanan</p>
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
                @foreach($variants as $variant)
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
                                <h6 class="card-subtitle mb-2 text-body-secondary">{{ $variant->produk->nama }}</h6>

                                <div class="card-subtitle text-secondary">Sisa: {{ $variant->stok->jumlah }}</div>
                                <div class="mt-3 mb-3">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success btnTambah">+</button>
                                        <input type="hidden" name="jumlah" id="jumlah"
                                            data-max="{{ $variant->stok->jumlah }}" value="0">
                                            <button type="button" disabled class="btn btn-outline-success btnHasil">0</button>
                                            <button type="button" class="btn btn-success btnKurang">-</button>
                                        
                                    </div>
                                    <div class="text-secondary text-danger mt-2 pesan d-none fw-semibold"></div>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-outline-success">Rp.
                                        {{ number_format($variant->harga, 0, ",", ".") }}</button>
                                    <button type="button" data-id="{{ $variant->id }}" class="btn btn-outline-success btnCart">
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
    <!-- /Starter Section Section -->
</main>
@endsection


@push('scripts')
<!-- Vendor JS Files -->
<script
    src="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') : secure_asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}">
</script>
<script
    src="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/php-email-form/validate.js') : secure_asset('assets/vendor/php-email-form/validate.js') }}">
</script>
<script
    src="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/swiper/swiper-bundle.min.js') : secure_asset('assets/vendor/swiper/swiper-bundle.min.js') }}">
</script>
<script
    src="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/aos/aos.js') : secure_asset('assets/vendor/aos/aos.js') }}">
</script>
<script
    src="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') : secure_asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}">
</script>
<script
    src="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') : secure_asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}">
</script>
<script
    src="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/glightbox/js/glightbox.min.js') : secure_asset('assets/vendor/glightbox/js/glightbox.min.js') }}">
</script>
<script
    src="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/drift-zoom/Drift.min.js') : secure_asset('assets/vendor/drift-zoom/Drift.min.js') }}">
</script>
<script
    src="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/purecounter/purecounter_vanilla.js') : secure_asset('assets/vendor/purecounter/purecounter_vanilla.js') }}">
</script>

<!-- Main JS File -->
<script src="{{ env('TYPE_URL') == 'http' ? asset('assets/js/main.js') : secure_asset('assets/js/main.js') }}"></script>
<script src="{{ env('TYPE_URL') == 'http' ? asset('resources/js/order.js') : secure_asset('resources/js/order.js') }}">
</script>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script> -->
@endpush
