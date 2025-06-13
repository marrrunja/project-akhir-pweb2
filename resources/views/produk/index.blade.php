@extends('layout.layout')


@section('title', 'Halaman produk index')
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
<link href="{{ env('TYPE_URL') == 'http' ? asset('assets/css/main.css') : secure_asset('assets/css/main.css') }}"
    rel="stylesheet">

@endpush

@section('meta')
<meta name="_appurl" content="{{ env('BASE_URL') }}">
<meta name="_token" content="{{ csrf_token() }}">
@endsection

@section('body')
<main class="main">
    <!-- Product List Section -->
    <section id="product-list" class="product-list section">
        <div class="container isotope-layout" data-aos="fade-up" data-aos-delay="100" data-default-filter="*"
            data-layout="masonry" data-sort="original-order">
            <div class="row">
                <div class="col-12">
                    <div class="product-filters isotope-filters mb-5 d-flex justify-content-center" data-aos="fade-up">
                        <ul class="d-flex flex-wrap gap-2 list-unstyled">
                            <li class="filter-active kategori" data-filter="*">All</li>
                            <li class="kategori">Makanan</li>
                            <li class="kategori">Minuman</li>
                            <li class="kategori">Souvenir</li>
                        </ul>
                    </div>
                </div>

            </div>
            <!-- <div class="row">
                 <div class="col-12 text-center d-flex justify-content-center" id="kolom-filter">
                    <ul class="d-flex">
                        <li class="filter kategori acri">All</li>
                        <li class="filter kategori">Makanan</li>
                        <li class="filter kategori">Minuman</li>
                        <li class="filter kategori">Souvenir</li>
                    </ul>
                </div>
            </div> -->
            <div class="row mb-4">
                <div class="col-12">
                    <h1 class="fw-bold">Daftar <span id="judul-kategori">produk</span> yang tersedia</h1>
                </div>
                @if(Session::has('status'))
                <div class="col-12 col-md-10 col-xl-6">
                    <div class="alert alert-danger">
                        {{ Session::get('status') }}
                    </div>
                </div>
                @endif
            </div>
            <div class="row product-container isotope-container" id="list-produk" data-aos="fade-up"
                data-aos-delay="200">
                <!-- Product Item 1 -->
                @foreach($products as $product)
                <div class="col-md-6 col-lg-3 product-item isotope-item filter-clothing">
                    <div class="product-card">
                        <div class="product-image">
                            <span class="badge">{{ $product->kategori }}</span>
                            <img src="{{ asset('storage/images/'.$product->foto) }}" alt="Product"
                                class="img-fluid main-img">
                            <img src="{{ asset('storage/images/'.$product->foto) }}" alt="Product Hover"
                                class="img-fluid">
                        </div>
                        <div class="product-info">
                            <h5 class="product-title"><a
                                    href="/variant/{{ $product->idProduk }}">{{ $product->nama }}</a></h5>
                            <div class="product-price">
                                <span class="">{{ Str::limit($product->detail, 25) }}</span>
                            </div>
                            <div class="product-price">
                                <a href="/produk/detail/{{ $product->idProduk }}" class="current-price btn-modal"
                                    data-id="{{ $product->idProduk }}" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Detail produk
                                    &raquo;</a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Product Item -->
                @endforeach

            </div>
        </div>
    </section><!-- /Product List Section -->
</main>
<!-- <section class="pb-5">
    <div class="container">
        <div class="row gap-2">
            @foreach($products as $product)
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card border-0 shadow position-relative card-produk">
                    <span class="badge position-absolute">{{ $product->kategori }}</span>
                    <img src="{{ asset('storage/images/'.$product->foto) }}" class="card-img-top" alt="">
                    <div class="card-body">
                       <h5><a
                                    href="{{ route('produk.variant', $product->id) }}">{{ $product->nama }}</a></h5>
                        
                    </div>
                </div>

            </div>
            @endforeach
        </div>
    </div>
</section> -->
<!-- modal -->
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row" id="modal-body">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
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
<script src="{{ custom_asset('resources/js/api.js') }}"></script>
@endpush
