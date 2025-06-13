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

@section('body')
<main class="main">


    <!-- Best Sellers Section -->
    <section id="best-sellers" class="best-sellers section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2></h2>
            <p></p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row g-4">
                <!-- Product 1 -->
                <div class="col-6 col-lg-3">
                    <div class="product-card" data-aos="zoom-in">
                        <div class="product-image">
                            <img src="/assets/img/product/product-f-1.webp" class="main-image img-fluid"
                                alt="Product">
                            <img src="/assets/img/product/product-f-2.webp" class="hover-image img-fluid"
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
                        </div>
                        <div class="product-details">
                            <div class="product-category">Women's Fashion</div>
                            <h4 class="product-title"><a href="product-details.html">Tempor Incididunt</a></h4>
                            <div class="product-meta">
                                <div class="product-price">$129.00</div>
                                <div class="product-rating">
                                    <i class="bi bi-star-fill"></i>
                                    4.8 <span>(42)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="col-6 col-lg-3">
                    <div class="product-card" data-aos="zoom-in" data-aos-delay="100">
                        <div class="product-image">
                            <img src="/assets/img/product/product-m-1.webp" class="main-image img-fluid"
                                alt="Product">
                            <img src="/assets/img/product/product-m-2.webp" class="hover-image img-fluid"
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
                            <div class="product-category">Men's Collection</div>
                            <h4 class="product-title"><a href="product-details.html">Elit Consectetur</a></h4>
                            <div class="product-meta">
                                <div class="product-price">$95.00</div>
                                <div class="product-rating">
                                    <i class="bi bi-star-fill"></i>
                                    4.6 <span>(28)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="col-6 col-lg-3">
                    <div class="product-card" data-aos="zoom-in" data-aos-delay="200">
                        <div class="product-image">
                            <img src="/assets/img/product/product-f-3.webp" class="main-image img-fluid"
                                alt="Product">
                            <img src="/assets/img/product/product-f-4.webp" class="hover-image img-fluid"
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
                            <div class="product-badge sale">-25%</div>
                        </div>
                        <div class="product-details">
                            <div class="product-category">Accessories</div>
                            <h4 class="product-title"><a href="product-details.html">Adipiscing Magna</a></h4>
                            <div class="product-meta">
                                <div class="product-price">
                                    $75.00
                                    <span class="original-price">$99.00</span>
                                </div>
                                <div class="product-rating">
                                    <i class="bi bi-star-fill"></i>
                                    4.9 <span>(56)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="col-6 col-lg-3">
                    <div class="product-card" data-aos="zoom-in" data-aos-delay="300">
                        <div class="product-image">
                            <img src="/assets/img/product/product-m-3.webp" class="main-image img-fluid"
                                alt="Product">
                            <img src="/assets/img/product/product-m-4.webp" class="hover-image img-fluid"
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
                        </div>
                        <div class="product-details">
                            <div class="product-category">Footwear</div>
                            <h4 class="product-title"><a href="product-details.html">Labore Dolore</a></h4>
                            <div class="product-meta">
                                <div class="product-price">$145.00</div>
                                <div class="product-rating">
                                    <i class="bi bi-star-fill"></i>
                                    4.7 <span>(35)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product 5 -->
                <div class="col-6 col-lg-3">
                    <div class="product-card" data-aos="zoom-in" data-aos-delay="400">
                        <div class="product-image">
                            <img src="/assets/img/product/product-f-5.webp" class="main-image img-fluid"
                                alt="Product">
                            <img src="/assets/img/product/product-f-6.webp" class="hover-image img-fluid"
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
                        </div>
                        <div class="product-details">
                            <div class="product-category">Men's Fashion</div>
                            <h4 class="product-title"><a href="product-details.html">Magna Aliqua</a></h4>
                            <div class="product-meta">
                                <div class="product-price">$89.00</div>
                                <div class="product-rating">
                                    <i class="bi bi-star-fill"></i>
                                    4.5 <span>(23)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product 6 -->
                <div class="col-6 col-lg-3">
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
                </div>

                <!-- Product 7 -->
                <div class="col-6 col-lg-3">
                    <div class="product-card" data-aos="zoom-in" data-aos-delay="600">
                        <div class="product-image">
                            <img src="/assets/img/product/product-f-7.webp" class="main-image img-fluid"
                                alt="Product">
                            <img src="/assets/img/product/product-f-8.webp" class="hover-image img-fluid"
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
                        </div>
                        <div class="product-details">
                            <div class="product-category">Accessories</div>
                            <h4 class="product-title"><a href="product-details.html">Incididunt Labore</a></h4>
                            <div class="product-meta">
                                <div class="product-price">$55.00</div>
                                <div class="product-rating">
                                    <i class="bi bi-star-fill"></i>
                                    4.6 <span>(31)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product 8 -->
                <div class="col-6 col-lg-3">
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
                </div>

            </div>

        </div>

    </section><!-- /Best Sellers Section -->

    <!-- Product List Section -->
    <section id="product-list" class="product-list section">

        <div class="container isotope-layout" data-aos="fade-up" data-aos-delay="100" data-default-filter="*"
            data-layout="masonry" data-sort="original-order">

            <div class="row">
                <div class="col-12">
                    <div class="product-filters isotope-filters mb-5 d-flex justify-content-center"
                        data-aos="fade-up">
                        <ul class="d-flex flex-wrap gap-2 list-unstyled">
                            <li class="filter-active" data-filter="*">All</li>
                            <li data-filter=".filter-clothing">Clothing</li>
                            <li data-filter=".filter-accessories">Accessories</li>
                            <li data-filter=".filter-electronics">Electronics</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row product-container isotope-container" data-aos="fade-up" data-aos-delay="200">

                <!-- Product Item 1 -->
                <div class="col-md-6 col-lg-3 product-item isotope-item filter-clothing">
                    <div class="product-card">
                        <div class="product-image">
                            <span class="badge">Sale</span>
                            <img src="/assets/img/product/product-1.webp" alt="Product" class="img-fluid main-img">
                            <img src="/assets/img/product/product-1-variant.webp" alt="Product Hover"
                                class="img-fluid hover-img">
                            <div class="product-overlay">
                                <a href="cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                                <div class="product-actions">
                                    <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>
                                    <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>
                                    <a href="#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <h5 class="product-title"><a href="product-details.html">Lorem ipsum dolor sit amet</a>
                            </h5>
                            <div class="product-price">
                                <span class="current-price">$89.99</span>
                                <span class="old-price">$129.99</span>
                            </div>
                            <div class="product-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                                <span>(24)</span>
                            </div>
                        </div>
                    </div>
                </div><!-- End Product Item -->

                <!-- Product Item 2 -->
                <div class="col-md-6 col-lg-3 product-item isotope-item filter-electronics">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="/assets/img/product/product-2.webp" alt="Product" class="img-fluid main-img">
                            <img src="/assets/img/product/product-2-variant.webp" alt="Product Hover"
                                class="img-fluid hover-img">
                            <div class="product-overlay">
                                <a href="cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                                <div class="product-actions">
                                    <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>
                                    <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>
                                    <a href="#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <h5 class="product-title"><a href="product-details.html">Consectetur adipiscing elit</a>
                            </h5>
                            <div class="product-price">
                                <span class="current-price">$249.99</span>
                            </div>
                            <div class="product-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                <span>(18)</span>
                            </div>
                        </div>
                    </div>
                </div><!-- End Product Item -->

                <!-- Product Item 3 -->
                <div class="col-md-6 col-lg-3 product-item isotope-item filter-accessories">
                    <div class="product-card">
                        <div class="product-image">
                            <span class="badge">New</span>
                            <img src="/assets/img/product/product-3.webp" alt="Product" class="img-fluid main-img">
                            <img src="/assets/img/product/product-3-variant.webp" alt="Product Hover"
                                class="img-fluid hover-img">
                            <div class="product-overlay">
                                <a href="cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                                <div class="product-actions">
                                    <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>
                                    <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>
                                    <a href="#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <h5 class="product-title"><a href="product-details.html">Sed do eiusmod tempor</a></h5>
                            <div class="product-price">
                                <span class="current-price">$59.99</span>
                            </div>
                            <div class="product-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                <i class="bi bi-star"></i>
                                <span>(7)</span>
                            </div>
                        </div>
                    </div>
                </div><!-- End Product Item -->

                <!-- Product Item 4 -->
                <div class="col-md-6 col-lg-3 product-item isotope-item filter-clothing">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="/assets/img/product/product-4.webp" alt="Product" class="img-fluid main-img">
                            <img src="/assets/img/product/product-4-variant.webp" alt="Product Hover"
                                class="img-fluid hover-img">
                            <div class="product-overlay">
                                <a href="cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                                <div class="product-actions">
                                    <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>
                                    <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>
                                    <a href="#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <h5 class="product-title"><a href="product-details.html">Incididunt ut labore et
                                    dolore</a></h5>
                            <div class="product-price">
                                <span class="current-price">$79.99</span>
                                <span class="old-price">$99.99</span>
                            </div>
                            <div class="product-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <span>(32)</span>
                            </div>
                        </div>
                    </div>
                </div><!-- End Product Item -->

                <!-- Product Item 5 -->
                <div class="col-md-6 col-lg-3 product-item isotope-item filter-electronics">
                    <div class="product-card">
                        <div class="product-image">
                            <span class="badge">Sale</span>
                            <img src="/assets/img/product/product-5.webp" alt="Product" class="img-fluid main-img">
                            <img src="/assets/img/product/product-5-variant.webp" alt="Product Hover"
                                class="img-fluid hover-img">
                            <div class="product-overlay">
                                <a href="cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                                <div class="product-actions">
                                    <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>
                                    <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>
                                    <a href="#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <h5 class="product-title"><a href="product-details.html">Magna aliqua ut enim ad
                                    minim</a></h5>
                            <div class="product-price">
                                <span class="current-price">$199.99</span>
                                <span class="old-price">$249.99</span>
                            </div>
                            <div class="product-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                                <i class="bi bi-star"></i>
                                <span>(15)</span>
                            </div>
                        </div>
                    </div>
                </div><!-- End Product Item -->

                <!-- Product Item 6 -->
                <div class="col-md-6 col-lg-3 product-item isotope-item filter-accessories">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="/assets/img/product/product-6.webp" alt="Product" class="img-fluid main-img">
                            <img src="/assets/img/product/product-6-variant.webp" alt="Product Hover"
                                class="img-fluid hover-img">
                            <div class="product-overlay">
                                <a href="cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                                <div class="product-actions">
                                    <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>
                                    <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>
                                    <a href="#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <h5 class="product-title"><a href="product-details.html">Veniam quis nostrud
                                    exercitation</a></h5>
                            <div class="product-price">
                                <span class="current-price">$45.99</span>
                            </div>
                            <div class="product-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                <span>(21)</span>
                            </div>
                        </div>
                    </div>
                </div><!-- End Product Item -->

                <!-- Product Item 7 -->
                <div class="col-md-6 col-lg-3 product-item isotope-item filter-clothing">
                    <div class="product-card">
                        <div class="product-image">
                            <span class="badge">New</span>
                            <img src="/assets/img/product/product-7.webp" alt="Product" class="img-fluid main-img">
                            <img src="/assets/img/product/product-7-variant.webp" alt="Product Hover"
                                class="img-fluid hover-img">
                            <div class="product-overlay">
                                <a href="cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                                <div class="product-actions">
                                    <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>
                                    <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>
                                    <a href="#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <h5 class="product-title"><a href="product-details.html">Ullamco laboris nisi ut
                                    aliquip</a></h5>
                            <div class="product-price">
                                <span class="current-price">$69.99</span>
                            </div>
                            <div class="product-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                                <i class="bi bi-star"></i>
                                <span>(11)</span>
                            </div>
                        </div>
                    </div>
                </div><!-- End Product Item -->

                <!-- Product Item 8 -->
                <div class="col-md-6 col-lg-3 product-item isotope-item filter-electronics">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="/assets/img/product/product-8.webp" alt="Product" class="img-fluid main-img">
                            <img src="/assets/img/product/product-8-variant.webp" alt="Product Hover"
                                class="img-fluid hover-img">
                            <div class="product-overlay">
                                <a href="cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                                <div class="product-actions">
                                    <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>
                                    <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>
                                    <a href="#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <h5 class="product-title"><a href="product-details.html">Ex ea commodo consequat</a>
                            </h5>
                            <div class="product-price">
                                <span class="current-price">$159.99</span>
                            </div>
                            <div class="product-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <span>(29)</span>
                            </div>
                        </div>
                    </div>
                </div><!-- End Product Item -->

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

@endpush
