@extends('layout.layout')
@section('title', 'Halaman Index User')

@section('')
@if(Session::has('status'))
    {{ Session::get('status') }}
@endif
@section('title', 'Home')

@push('styles')
<!-- Favicon & Apple Touch Icon -->
<link href="{{ env('TYPE_URL') == 'http' ? asset('assets/img/favicon.png') : secure_asset('assets/img/favicon.png') }}" rel="icon">
<link href="{{ env('TYPE_URL') == 'http' ? asset('assets/img/apple-touch-icon.png') : secure_asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Quicksand:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/bootstrap/css/bootstrap.min.css') : secure_asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') : secure_asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/swiper/swiper-bundle.min.css') : secure_asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
<link href="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/aos/aos.css') : secure_asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
<link href="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/glightbox/css/glightbox.min.css') : secure_asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<link href="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/drift-zoom/drift-basic.css') : secure_asset('assets/vendor/drift-zoom/drift-basic.css') }}" rel="stylesheet">

<!-- Main CSS File -->
<link href="{{ env('TYPE_URL') == 'http' ? asset('assets/css/main.css') : secure_asset('assets/css/main.css') }}" rel="stylesheet">

@endpush

@section('meta')
<meta name="_token" content="{{ csrf_token() }}">
<meta name="_appurl" content="{{ env('BASE_URL') }}">
@endsection

@section('body')
<main class="main">


    <!-- Best Sellers Section -->
    {{-- <section id="best-sellers" class="best-sellers section"> --}}

        <!-- Section Title -->
        {{-- <div class="container section-title" data-aos="fade-up">
            <h2></h2>
            <p></p>
        </div><!-- End Section Title --> --}}
                <!-- Product 1 -->
                
                {{-- <div class="col-6 col-lg-3">
                    <div class="product-card" data-aos="zoom-in" data-aos-delay="500">
                        <div class="product-image">
                            <img src="/assets/img/product/product-m-5.webp" class="main-image img-fluid"
                                alt="Product">
                            <img src="/assets/img/product/product-m-6.webp" class="hover-image img-fluid"
                                alt="Product Variant">
                            <div class="product-overlay">
                                <div class="product-actions">
                                    <button type="button" class="action-btn" data-bs-toggle="tooltip"
                                        title="Quick View">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button type="button" class="action-btn" data-bs-toggle="tooltip"
                                        title="Add to Cart">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="product-badge sale">-15%</div>
                        </div>
                        <div class="product-details">
                            <div class="product-category">Women's Fashion</div>
                            <h4 class="product-title"><a href="product-details.html">Eiusmod Tempor</a></h4>
                            <div class="product-meta">
                                <div class="product-price">
                                    $110.00
                                    <span class="original-price">$129.00</span>
                                </div>
                                <div class="product-rating">
                                    <i class="bi bi-star-fill"></i>
                                    4.8 <span>(47)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
        

                <!-- Product 8 -->
                {{-- <div class="col-6 col-lg-3">
                    <div class="product-card" data-aos="zoom-in" data-aos-delay="700">
                        <div class="product-image">
                            <img src="/assets/img/product/product-m-7.webp" class="main-image img-fluid"
                                alt="Product">
                            <img src="/assets/img/product/product-m-8.webp" class="hover-image img-fluid"
                                alt="Product Variant">
                            <div class="product-overlay">
                                <div class="product-actions">
                                    <button type="button" class="action-btn" data-bs-toggle="tooltip"
                                        title="Quick View">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button type="button" class="action-btn" data-bs-toggle="tooltip"
                                        title="Add to Cart">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="product-badge new">New</div>
                        </div>
                        <div class="product-details">
                            <div class="product-category">Men's Fashion</div>
                            <h4 class="product-title"><a href="product-details.html">Aliqua Magna</a></h4>
                            <div class="product-meta">
                                <div class="product-price">$79.00</div>
                                <div class="product-rating">
                                    <i class="bi bi-star-fill"></i>
                                    4.7 <span>(39)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

        {{-- </div> --}}

    </section><!-- /Best Sellers Section -->

    <!-- Product List Section -->
    <section id="product-list" class="product-list section">

        
        <div class="container isotope-layout" data-aos="fade-up" data-aos-delay="100" data-default-filter="*"
            data-layout="masonry" data-sort="original-order">
            <h2 class="mb-3">Best Sellers !!</h2>
            <div class="row product-container isotope-container" id="list-produk"  data-aos="fade-up" data-aos-delay="200">

                <!-- Product Item 1 -->
                @foreach($products as $product)
                <div class="col-md-6 col-lg-3 product-item isotope-item filter-clothing">
                    <div class="product-card">
                        <div class="product-image">
                            <span class="badge">{{ $product->kategori }}</span>
                            <img src="{{ asset('storage/images/'.$product->foto) }}" alt="Product" class="img-fluid main-img">
                            <img src="{{ asset('storage/images/'.$product->foto) }}" alt="Product Hover"
                                class="img-fluid hover-img">
                            <div class="product-overlay">
                                <a href="/variant/{{ $product->idProduk }}" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                                <a href="/produk/detail/{{ $product->idProduk }}" class="btn-cart btn-modal"
                                    data-id="{{ $product->idProduk }}" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Detail produk 
                                </a>
                            </div>
                        </div>
                        <div class="product-info">
                            <h5 class="product-title"><a><h4>{{ $product->nama }}</h4></a>
                            </h5>
                            <span>
                                Deskripsi Singkat:
                                <br>{{ Str::limit($product->detail, 25) }}
                            </span>
                            <div class="product-info">

                            </div>
                            <div class="product-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <span>(1k)</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
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
                <!-- End Product Item -->

                <!-- End Product Item -->

            </div>

            <div class="text-center mt-5" data-aos="fade-up">
                <a href="/produk/index" class="view-all-btn">View All Products <i class="bi bi-arrow-right"></i></a>
            </div>

        </div>

    </section><!-- /Product List Section -->

</main>
@endsection

@push('scripts')
<!-- Vendor JS Files -->
<script src="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') : secure_asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/php-email-form/validate.js') : secure_asset('assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/swiper/swiper-bundle.min.js') : secure_asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/aos/aos.js') : secure_asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') : secure_asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') : secure_asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/glightbox/js/glightbox.min.js') : secure_asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/drift-zoom/Drift.min.js') : secure_asset('assets/vendor/drift-zoom/Drift.min.js') }}"></script>
<script src="{{ env('TYPE_URL') == 'http' ? asset('assets/vendor/purecounter/purecounter_vanilla.js') : secure_asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>

<!-- Main JS File -->
<script src="{{ env('TYPE_URL') == 'http' ? asset('assets/js/main.js') : secure_asset('assets/js/main.js') }}"></script>
<script src="{{ custom_asset('resources/js/api.js') }}"></script>
@endpush
