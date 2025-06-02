@extends('layout.layout')
@section('title', 'Halaman Index User')

@section('')
@if(Session::has('status'))
{{ Session::get('status') }}
@endif
@section('title', 'Home')
@push('styles')
<!-- Favicon & Apple Touch Icon -->
<link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
<link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Quicksand:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/drift-zoom/drift-basic.css') }}" rel="stylesheet">

<!-- Main CSS File -->
<link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
@endpush
@section('body')
<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li class="current">Product Details</li>
                </ol>
            </nav>
            <h1>Product Details</h1>
        </div>
    </div><!-- End Page Title -->

    <!-- Product Details Section -->
    <section id="product-details" class="product-details section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row g-5">
                <!-- Product Images Column -->
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right" data-aos-delay="200">
                    <div class="product-gallery">
                        <!-- Vertical Thumbnails -->
                        <div class="thumbnails-vertical">
                            <div class="thumbnails-container">
                                <div class="thumbnail-item active"
                                    data-image="assets/img/product/product-details-1.webp">
                                    <img src="assets/img/product/product-details-1.webp" alt="Product Thumbnail"
                                        class="img-fluid">
                                </div>
                                <div class="thumbnail-item" data-image="assets/img/product/product-details-2.webp">
                                    <img src="assets/img/product/product-details-2.webp" alt="Product Thumbnail"
                                        class="img-fluid">
                                </div>
                                <div class="thumbnail-item" data-image="assets/img/product/product-details-3.webp">
                                    <img src="assets/img/product/product-details-3.webp" alt="Product Thumbnail"
                                        class="img-fluid">
                                </div>
                                <div class="thumbnail-item" data-image="assets/img/product/product-details-4.webp">
                                    <img src="assets/img/product/product-details-4.webp" alt="Product Thumbnail"
                                        class="img-fluid">
                                </div>
                                <div class="thumbnail-item" data-image="assets/img/product/product-details-5.webp">
                                    <img src="assets/img/product/product-details-5.webp" alt="Product Thumbnail"
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>

                        <!-- Main Image -->
                        <div class="main-image-wrapper">
                            <div class="image-zoom-container">
                                <a href="assets/img/product/product-details-1.webp" class="glightbox"
                                    data-gallery="product-gallery">
                                    <img src="assets/img/product/product-details-1.webp" alt="Product Image"
                                        class="img-fluid main-image drift-zoom" id="main-product-image"
                                        data-zoom="assets/img/product/product-details-1.webp">
                                    <div class="zoom-overlay">
                                        <i class="bi bi-zoom-in"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="image-nav">
                                <button class="image-nav-btn prev-image">
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                                <button class="image-nav-btn next-image">
                                    <i class="bi bi-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Info Column -->
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="product-info-wrapper" id="product-info-sticky">
                        <!-- Product Meta -->
                        <div class="product-meta">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="product-category">Headphones</span>
                                <div class="product-share">
                                    <button class="share-btn" aria-label="Share product">
                                        <i class="bi bi-share"></i>
                                    </button>
                                    <div class="share-dropdown">
                                        <a href="#" aria-label="Share on Facebook"><i class="bi bi-facebook"></i></a>
                                        <a href="#" aria-label="Share on Twitter"><i class="bi bi-twitter-x"></i></a>
                                        <a href="#" aria-label="Share on Pinterest"><i class="bi bi-pinterest"></i></a>
                                        <a href="#" aria-label="Share via Email"><i class="bi bi-envelope"></i></a>
                                    </div>
                                </div>
                            </div>

                            <h1 class="product-title">Lorem Ipsum Wireless Noise Cancelling Headphones</h1>

                            <!-- <div class="product-rating">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                    <span class="rating-value">4.5</span>
                                </div>
                                <a href="#reviews" class="rating-count">42 Reviews</a>
                            </div> -->
                        </div>

                        <!-- Product Price -->
                        <div class="product-price-container">
                            <div class="price-wrapper">
                                <span class="current-price">$249.99</span>
                                <span class="original-price">$299.99</span>
                            </div>
                            <span class="discount-badge">Save 17%</span>
                            <div class="stock-info">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>In Stock</span>
                                <span class="stock-count">(24 items left)</span>
                            </div>
                        </div>

                        <!-- Product Description -->
                        <div class="product-short-description">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum at lacus congue,
                                suscipit elit nec, tincidunt orci. Phasellus egestas nisi vitae lectus imperdiet
                                venenatis.</p>
                        </div>

                        <!-- Product Options -->
                        <div class="product-options">
                            <!-- Color Options -->
                            <div class="option-group">
                                <div class="option-header">
                                    <h6 class="option-title">Color</h6>
                                    <span class="selected-option">Black</span>
                                </div>
                                <div class="color-options">
                                    <div class="color-option active" data-color="Black" style="background-color: #222;">
                                        <i class="bi bi-check"></i>
                                    </div>
                                    <div class="color-option" data-color="Silver" style="background-color: #C0C0C0;">
                                        <i class="bi bi-check"></i>
                                    </div>
                                    <div class="color-option" data-color="Blue" style="background-color: #1E3A8A;">
                                        <i class="bi bi-check"></i>
                                    </div>
                                    <div class="color-option" data-color="Rose Gold" style="background-color: #B76E79;">
                                        <i class="bi bi-check"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Size Options -->
                            <div class="option-group">
                                <div class="option-header">
                                    <h6 class="option-title">Size</h6>
                                    <span class="selected-option">M</span>
                                </div>
                                <div class="size-options">
                                    <div class="size-option" data-size="S">S</div>
                                    <div class="size-option active" data-size="M">M</div>
                                    <div class="size-option" data-size="L">L</div>
                                </div>
                            </div>

                            <!-- Quantity Selector -->
                            <div class="option-group">
                                <h6 class="option-title">Quantity</h6>
                                <div class="quantity-selector">
                                    <button class="quantity-btn decrease">
                                        <i class="bi bi-dash"></i>
                                    </button>
                                    <input type="number" class="quantity-input" value="1" min="1" max="24">
                                    <button class="quantity-btn increase">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="product-actions">
                            <button class="btn btn-primary add-to-cart-btn">
                                <i class="bi bi-cart-plus"></i> Add to Cart
                            </button>
                            <button class="btn btn-outline-primary buy-now-btn">
                                <i class="bi bi-lightning-fill"></i> Buy Now
                            </button>
                            <button class="btn btn-outline-secondary wishlist-btn" aria-label="Add to wishlist">
                                <i class="bi bi-heart"></i>
                            </button>
                        </div>

                        <!-- Delivery Options -->
                        <div class="delivery-options">
                            <div class="delivery-option">
                                <i class="bi bi-truck"></i>
                                <div>
                                    <h6>Free Shipping</h6>
                                    <p>On orders over $50</p>
                                </div>
                            </div>
                            <div class="delivery-option">
                                <i class="bi bi-arrow-repeat"></i>
                                <div>
                                    <h6>30-Day Returns</h6>
                                    <p>Hassle-free returns</p>
                                </div>
                            </div>
                            <div class="delivery-option">
                                <i class="bi bi-shield-check"></i>
                                <div>
                                    <h6>2-Year Warranty</h6>
                                    <p>Full coverage</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sticky Add to Cart Bar (appears on scroll) -->
            <div class="sticky-add-to-cart">
                <div class="container">
                    <div class="sticky-content">
                        <div class="product-preview">
                            <img src="assets/img/product/product-details-1.webp" alt="Product"
                                class="product-thumbnail">
                            <div class="product-info">
                                <h5 class="product-title">Lorem Ipsum Wireless Headphones</h5>
                                <div class="product-price">$249.99</div>
                            </div>
                        </div>
                        <div class="sticky-actions">
                            <div class="quantity-selector">
                                <button class="quantity-btn decrease">
                                    <i class="bi bi-dash"></i>
                                </button>
                                <input type="number" class="quantity-input" value="1" min="1" max="24">
                                <button class="quantity-btn increase">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                            <button class="btn btn-primary add-to-cart-btn">
                                <i class="bi bi-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Details Accordion -->
            <div class="row mt-5" data-aos="fade-up">
                <div class="col-12">
                    <div class="product-details-accordion">
                        <!-- Description Accordion -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#description" aria-expanded="true" aria-controls="description">
                                    Product Description
                                </button>
                            </h2>
                            <div id="description" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <div class="product-description">
                                        <h4>Product Overview</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum at lacus
                                            congue, suscipit elit nec, tincidunt orci. Phasellus egestas nisi vitae
                                            lectus imperdiet venenatis. Suspendisse vulputate quam diam, et consectetur
                                            augue condimentum in. Aenean dapibus urna eget nisi pharetra, in iaculis
                                            nulla blandit. Praesent at consectetur sem, sed sollicitudin nibh. Ut
                                            interdum risus ac nulla placerat aliquet.</p>

                                        <div class="row mt-4">
                                            <div class="col-md-6">
                                                <h4>Key Features</h4>
                                                <ul class="feature-list">
                                                    <li><i class="bi bi-check-circle"></i> Lorem ipsum dolor sit amet,
                                                        consectetur adipiscing elit</li>
                                                    <li><i class="bi bi-check-circle"></i> Vestibulum at lacus congue,
                                                        suscipit elit nec, tincidunt orci</li>
                                                    <li><i class="bi bi-check-circle"></i> Phasellus egestas nisi vitae
                                                        lectus imperdiet venenatis</li>
                                                    <li><i class="bi bi-check-circle"></i> Suspendisse vulputate quam
                                                        diam, et consectetur augue</li>
                                                    <li><i class="bi bi-check-circle"></i> Aenean dapibus urna eget nisi
                                                        pharetra, in iaculis nulla</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <h4>What's in the Box</h4>
                                                <ul class="feature-list">
                                                    <li><i class="bi bi-box"></i> Lorem Ipsum Wireless Headphones</li>
                                                    <li><i class="bi bi-box"></i> Carrying Case</li>
                                                    <li><i class="bi bi-box"></i> USB-C Charging Cable</li>
                                                    <li><i class="bi bi-box"></i> 3.5mm Audio Cable</li>
                                                    <li><i class="bi bi-box"></i> User Manual</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
</main>
@endsection
@push('scripts')
<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/drift-zoom/Drift.min.js"></script>
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>
@endpush
