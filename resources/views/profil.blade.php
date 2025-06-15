@extends('layout.layout')
@section('title', 'Halaman Index User')


@section('title', 'Home')
@push('styles')
<!-- Favicons -->
<link href="assets/img/favicon.png" rel="icon">
<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

<!-- Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Quicksand:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
<link href="assets/vendor/aos/aos.css" rel="stylesheet">
<link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
<link href="assets/vendor/drift-zoom/drift-basic.css" rel="stylesheet">

<!-- Main CSS File -->
<link href="assets/css/main.css" rel="stylesheet">
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
                    <li><a href="index.html">Home</a></li>
                    <li class="current">Account</li>
                </ol>
            </nav>
            <h1>Account</h1>
        </div>
    </div><!-- End Page Title -->

    <!-- Account Section -->
    <section id="account" class="account section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <!-- Mobile Sidebar Toggle Button -->
            <div class="sidebar-toggle d-lg-none mb-3">
                <button class="btn btn-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#profileSidebar"
                    aria-expanded="false" aria-controls="profileSidebar">
                    <i class="bi bi-list me-2"></i> Profile Menu
                </button>
            </div>

            <div class="row">
                <!-- Profile Sidebar -->
                <div class="col-lg-3 profile-sidebar collapse d-lg-block" id="profileSidebar" data-aos="fade-right"
                    data-aos-delay="200">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <span>S</span>
                        </div>
                        <div class="profile-info">
                            <h4>{{Session::get('username')}}</h4>
                            <div class="profile-bonus">
                                <!-- <i class="bi bi-gift"></i>
                                <span>100 bonuses available</span> -->
                            </div>
                        </div>
                    </div>

                    <div class="profile-nav">
                        <ul class="nav flex-column" id="profileTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="orders-tab" data-bs-toggle="tab"
                                    data-bs-target="#orders" type="button" role="tab" aria-controls="orders"
                                    aria-selected="true">
                                    <i class="bi bi-box-seam"></i>
                                    <span>Orders</span>
                                    <span class="badge">1</span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="personal-tab" data-bs-toggle="tab"
                                    data-bs-target="#personal" type="button" role="tab" aria-controls="personal"
                                    aria-selected="false">
                                    <i class="bi bi-person"></i>
                                    <span>Personal info</span>
                                </button>
                            </li>
                        </ul>

                        <h6 class="nav-section-title">Customer service</h6>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <form method="post" id="form-logout" action="/login/logout">
                                    @csrf
                                    <button type="submit" class="nav-link logout"> <i
                                            class="bi bi-box-arrow-right"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Profile Content -->
                <div class="col-lg-9 profile-content" data-aos="fade-left" data-aos-delay="300">
                    <div class="tab-content" id="profileTabsContent">
                        <!-- Orders Tab -->
                        <div class="tab-pane fade show active" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                            <div class="tab-header">
                                <h2>Orders</h2>
                                <div class="tab-filters">
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle" type="button" id="statusFilter"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <span>Select status</span>
                                                    <i class="bi bi-chevron-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="statusFilter">
                                                    <li><a class="dropdown-item" href="#">All statuses</a></li>
                                                    <li><a class="dropdown-item" href="#">In progress</a></li>
                                                    <li><a class="dropdown-item" href="#">Delivered</a></li>
                                                    <li><a class="dropdown-item" href="#">Canceled</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle" type="button" id="timeFilter"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <span>For all time</span>
                                                    <i class="bi bi-chevron-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="timeFilter">
                                                    <li><a class="dropdown-item" href="#">For all time</a></li>
                                                    <li><a class="dropdown-item" href="#">Last 30 days</a></li>
                                                    <li><a class="dropdown-item" href="#">Last 6 months</a></li>
                                                    <li><a class="dropdown-item" href="#">Last year</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="orders-table">
                                <div class="table-header">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="sort-header">
                                                Order #
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="sort-header">
                                                Order date
                                                <i class="bi bi-arrow-down-up"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="sort-header">
                                                Status
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="sort-header">
                                                Total
                                                <i class="bi bi-arrow-down-up"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="order-items">

                                    <!-- Order Item 6 -->
                                    <div class="order-item">
                                        <div class="row align-items-center">
                                            <div class="col-md-3">
                                                <div class="order-id">28BA67U0981</div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="order-date">04/03/2024</div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="order-status canceled">
                                                    <span class="status-dot"></span>
                                                    <span>Canceled</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="order-total">$1,029.50</div>
                                            </div>
                                        </div>
                                        <div class="order-products">
                                            <div class="product-thumbnails">
                                                <img src="assets/img/product/product-11.webp" alt="Product"
                                                    class="product-thumb" loading="lazy">
                                                <img src="assets/img/product/product-1-variant.webp" alt="Product"
                                                    class="product-thumb" loading="lazy">
                                            </div>
                                            <button type="button" class="order-details-link" data-bs-toggle="collapse"
                                                data-bs-target="#orderDetails6" aria-expanded="false"
                                                aria-controls="orderDetails6">
                                                <i class="bi bi-chevron-down"></i>
                                            </button>
                                        </div>
                                        <div class="collapse order-details" id="orderDetails6">
                                            <div class="order-details-content">
                                                <div class="order-details-header">
                                                    <h5>Order Details</h5>
                                                    <div class="order-info">
                                                        <div class="info-item">
                                                            <span class="info-label">Order Date:</span>
                                                            <span class="info-value">04/03/2024</span>
                                                        </div>
                                                        <div class="info-item">
                                                            <span class="info-label">Payment Method:</span>
                                                            <span class="info-value">Credit Card (**** 7821)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="order-items-list">
                                                    <div class="order-item-detail">
                                                        <div class="item-image">
                                                            <img src="assets/img/product/product-11.webp" alt="Product"
                                                                loading="lazy">
                                                        </div>
                                                        <div class="item-info">
                                                            <h6>Excepteur sint occaecat</h6>
                                                            <div class="item-meta">
                                                                <span class="item-sku">SKU: PRD-011</span>
                                                                <span class="item-qty">Qty: 1</span>
                                                            </div>
                                                        </div>
                                                        <div class="item-price">$599.99</div>
                                                    </div>
                                                    <div class="order-item-detail">
                                                        <div class="item-image">
                                                            <img src="assets/img/product/product-1-variant.webp"
                                                                alt="Product" loading="lazy">
                                                        </div>
                                                        <div class="item-info">
                                                            <h6>Cupidatat non proident</h6>
                                                            <div class="item-meta">
                                                                <span class="item-sku">SKU: PRD-001-V</span>
                                                                <span class="item-qty">Qty: 1</span>
                                                            </div>
                                                        </div>
                                                        <div class="item-price">$349.99</div>
                                                    </div>
                                                </div>
                                                <div class="order-summary">
                                                    <div class="summary-row">
                                                        <span>Subtotal:</span>
                                                        <span>$949.98</span>
                                                    </div>
                                                    <div class="summary-row">
                                                        <span>Shipping:</span>
                                                        <span>$0.00</span>
                                                    </div>
                                                    <div class="summary-row">
                                                        <span>Tax:</span>
                                                        <span>$79.52</span>
                                                    </div>
                                                    <div class="summary-row total">
                                                        <span>Total:</span>
                                                        <span>$1,029.50</span>
                                                    </div>
                                                </div>
                                                <div class="shipping-info">
                                                    <div class="shipping-address">
                                                        <h6>Shipping Address</h6>
                                                        <p>456 Business Ave<br>Suite 200<br>San Francisco, CA
                                                            94107<br>United States</p>
                                                    </div>
                                                    <div class="shipping-method">
                                                        <h6>Shipping Method</h6>
                                                        <p>Free Express Shipping (1-2 business days)</p>
                                                    </div>
                                                </div>
                                                <div class="cancellation-info mt-3">
                                                    <h6>Cancellation Reason</h6>
                                                    <p>Order was canceled at customer's request. Items were not in stock
                                                        at the time of processing.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End Order Item -->
                                </div>

                                <div class="pagination-container">
                                    <nav aria-label="Orders pagination">
                                        <ul class="pagination">
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>


                        <!-- Personal Info Tab -->
                        <div class="tab-pane fade" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                            <div class="tab-header">
                                <h2>Personal Information</h2>
                            </div>
                            <div class="personal-info-form" data-aos="fade-up" data-aos-delay="100">
                                <form method="post" action="/profil/update/{{ Session::get('user_id') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            @error('email')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        @if(Session::has('status') && Session::has('pesan'))
                                        <script>
                                            Swal.fire({
                                            title: "Update data",
                                            text: "{{ Session::get('pesan') }}",
                                            icon: "{{ Session::get('status') }}"
                                            });
                                        </script>
                                        @endif
                                        <div class="col-md-6 mb-3">
                                            <label for="firstName" class="form-label">Username</label>
                                            <input type="text" disabled class="form-control" id="firstName"
                                                name="username" value="{{ old('username') ?? $pembeli->username }}"
                                                required="">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="lastName" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="lastName" name="email"
                                                value="{{ old('email') ?? $pembeli->email }}" required="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            @error('kecamatan')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                              @error('desa')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                       
                                            <label for="email" class="form-label">Kecamatan</label>
                                            <select name="kecamatan" id="kecamatan" class="form-control">
                                                <option value="">Pilih Kecamatan</option>
                                                @foreach($kecamatans as $kecamatan)
                                                <option value="{{ $kecamatan->kode_kecamatan }}"
                                                    {{ $pembeli->kode_kecamatan == $kecamatan->kode_kecamatan ? 'selected':'' }}>
                                                    {{ $kecamatan->nama_kecamatan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                            
                                            <label class="form-label">Desa</label>
                                            <select name="desa" id="desa" class="form-control">
                                                <option value="">Pilih Desa</option>
                                                @foreach($desas as $desa)
                                                <option value="{{ $desa->kode_desa }}"
                                                    {{ $pembeli->kode_desa == $desa->kode_desa ? 'selected':'' }}>
                                                    {{ $desa->nama_desa }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        @error('alamat')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <label for="birthdate" class="form-label">Alamat Spesifik</label>
                                        <input type="text" class="form-control" id="birthdate" name="alamat"
                                            value="{{ $pembeli->jalan }}">
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-save">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section><!-- /Account Section -->

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
<script src="{{ custom_asset('resources/js/profil.js') }}"></script>
@endpush
