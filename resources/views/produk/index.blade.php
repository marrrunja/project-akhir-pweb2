@extends('layout.layout')


@section('title', 'Halaman produk index')
@push('styles')
<!-- Favicon & Apple Touch Icon -->
<link href="{{ env('TYPE_URL') == 'http' ? asset('assets/img/favicon.png') : secure_asset('assets/img/favicon.png') }}" rel="icon">
<link href="{{ env('TYPE_URL') == 'http' ? asset('assets/img/apple-touch-icon.png') : secure_asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
    <!-- Product List Section -->
    <section id="product-list" class="product-list section">
      <div class="container isotope-layout" data-aos="fade-up" data-aos-delay="100" data-default-filter="*" data-layout="masonry" data-sort="original-order">
        <div class="row">
          <div class="col-12">
            <div class="product-filters isotope-filters mb-5 d-flex justify-content-center" data-aos="fade-up">
              <ul class="d-flex flex-wrap gap-2 list-unstyled">
                <li class="filter-active" data-filter="*">All</li>
                <li data-filter=".filter-clothing">Clothing</li>
                <li data-filter=".filter-accessories">Accessories</li>
                <li data-filter=".filter-electronics">Electronics</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row mb-4">
          <div class="col-12">
             <h1 class="fw-bold">Daftar produk yang tersedia</h1>
          </div>
          @if(Session::has('status'))
          <div class="col-12 col-md-10 col-xl-6">
            <div class="alert alert-danger">
              {{ Session::get('status') }}
            </div>
          </div>
          @endif
        </div>
        <div class="row product-container isotope-container" data-aos="fade-up" data-aos-delay="200">
         
          <!-- Product Item 1 -->
          @foreach($products as $product)
          <div class="col-md-6 col-lg-3 product-item isotope-item filter-clothing">
            <div class="product-card">
              <div class="product-image">
                <span class="badge">Sale</span>
                <img src="{{ asset('storage/images/'.$product->foto) }}" alt="Product" class="img-fluid main-img">
                <img src="{{ asset('storage/images/'.$product->foto) }}" alt="Product Hover" class="img-fluid">
              </div>
              <div class="product-info">
                <h5 class="product-title"><a href="{{ route('produk.variant', $product->id) }}">{{ $product->nama }}</a></h5>
               <div class="product-price">
                  <span class="current-price">{{ Str::limit($product->detail, 10) }}</span>
                </div>
                <div class="product-price">
                  <a href="/produk/detail/{{ $product->id }}" class="current-price">Detail &raquo;</a>
                </div>
              </div>
            </div>
          </div><!-- End Product Item --> 
          @endforeach        
        </div>
        <div class="text-center mt-5" data-aos="fade-up">
          <a href="category.html" class="view-all-btn">View All Products <i class="bi bi-arrow-right"></i></a>
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
