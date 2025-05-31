@extends('layout.layout')
@section('title', 'Keranjang Belanja')


@section('meta')
<meta name="_token" content="{{ csrf_token() }}">
<meta name="_appurl" content="{{ env('BASE_URL') }}">
@endsection

@push('styles')
<!-- Favicon & Apple Touch Icon -->
<link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
<link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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

@section('meta')
<meta name="_token" content="{{ csrf_token() }}">
@endsection


@section('body')
 <main class="main">
    <div class="page-title light-background">
      <div class="container">
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Cart</li>
          </ol>
        </nav>
        <h1>Cart</h1>
      </div>
    </div>
    <section id="cart" class="cart section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row">
          <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
            <div class="cart-items">
              <div class="cart-header d-none d-lg-block">
                <div class="row align-items-center">
                  <div class="col-lg-6">
                    <h5>Product</h5>
                  </div>
                  <div class="col-lg-2 text-center">
                    <h5>Price</h5>
                  </div>
                  <div class="col-lg-2 text-center">
                    <h5>Quantity</h5>
                  </div>
                  <div class="col-lg-2 text-center">
                    <h5>Total</h5>
                  </div>
                </div>
              </div>
              <!-- Cart Item  -->
              @foreach($carts as $item)
              <div class="cart-item" id="cart-item">
                <div class="row align-items-center">
                  <div class="col-lg-6 col-12 mt-3 mt-lg-0 mb-lg-0 mb-3">
                    <div class="product-info d-flex align-items-center">
                      <div class="product-image">
                        <img src="assets/img/product/product-1.webp" alt="Product" class="img-fluid" loading="lazy">
                      </div>
                      <div class="product-details">
                        <h6 class="product-title">{{ $item->variant->produk->nama}}</h6>
                        <div class="product-meta">
                          <span class="product-color">{{ $item->variant->variant ?? 'Variant' }}</span>
                        </div>
                        <button class="hilangkan-item" data-id="{{ $item->id }}" data-user="{{ Session::get('user_id') }}" type="button">
                          <i class="bi bi-trash"></i> Remove
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-12 mt-3 mt-lg-0 text-center">
                    <div class="price-tag">
                      <span class="current-price">Rp{{ number_format($item->variant->harga ?? 0) }}</span>
                    </div>
                  </div>
                  <div class="col-lg-2 col-12 mt-3 mt-lg-0 text-center">
                    <div class="quantity-selector">
                      <button class="quantity-btn decrease" data-id="{{ $item->id }}" data-stock="{{ $item->variant->stok->jumlah }}">
                        <i class="bi bi-dash"></i>
                      </button>
                      <input disabled type="number" class="quantity-input" value="{{ $item->qty }}" min="1" max="{{ $item->variant->stok->jumlah }}">
                      <button class="quantity-btn increase" data-id="{{ $item->id }}" data-stock="{{ $item->variant->stok->jumlah }}">
                        <i class="bi bi-plus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="col-lg-2 col-12 mt-3 mt-lg-0 text-center">
                    <div class="item-total">
                      <span>Rp{{ number_format(($item->variant->harga ?? 0) * $item->qty) }}</span>
                    </div>
                  </div>
                </div>
              </div><!-- End Cart Item -->
              @endforeach

              <div class="cart-actions">
                <div class="row">
                  <div class="col-lg-6 mb-3 mb-lg-0">
                    <div class="coupon-form">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Coupon code">
                        <button class="btn btn-outline-accent" type="button">Apply Coupon</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 text-md-end">
                    <button class="btn btn-outline-remove">
                      <i class="bi bi-trash"></i> Clear Cart
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
            <div class="cart-summary">
              <h4 class="summary-title">Order Summary</h4>

              <div class="summary-item">
                <span class="summary-label">Subtotal</span>
                <span class="summary-value">Rp{{ number_format($carts->sum(fn($item) => ($item->variant->harga ?? 0) * $item->qty)) }} </span>
              </div>

              <div class="summary-item shipping-item">
                <span class="summary-label">Shipping</span>
                <div class="shipping-options">
                  <div class="form-check text-end">
                    <input class="form-check-input" type="radio" name="shipping" id="express">
                    <label class="form-check-label" for="express">
                      Express Delivery - Free
                    </label>
                  </div>
                  <div class="form-check text-end">
                    <input class="form-check-input" type="radio" name="shipping" id="free">
                    <label class="form-check-label" for="free">
                      Free Shipping (Orders over $300)
                    </label>
                  </div>
                </div>
              </div>

              <div class="summary-total">
                <span class="summary-label">Total</span>
                <span class="summary-value">Rp{{ number_format($carts->sum(fn($item) => ($item->variant->harga ?? 0) * $item->qty)) }} </span>
              </div>

              <div class="checkout-button">
                <a href="/" class="btn btn-accent w-100">
                  Proceed to Checkout <i class="bi bi-arrow-right"></i>
                </a>
              </div>

              <div class="continue-shopping">
                <a href="/produk/index" class="btn btn-link w-100">
                  <i class="bi bi-arrow-left"></i> Continue Shopping
                </a>
              </div>

              <div class="payment-methods">
                <p class="payment-title">We Accept</p>
                <div class="payment-icons">
                  <i class="bi bi-credit-card"></i>
                  <i class="bi bi-paypal"></i>
                  <i class="bi bi-wallet2"></i>
                  <i class="bi bi-bank"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section>

  </main>
@endsection


@push('scripts')
<!-- sweet alert -->
 

<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/drift-zoom/Drift.min.js') }}"></script>
<script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>

<!-- Main JS File -->
<script src="{{ asset('resources/js/cart.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
@endpush
