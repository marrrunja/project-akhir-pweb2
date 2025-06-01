@extends('layout.layout-admin')
@section('title', 'Register')

@push('styles')

@endpush

@section('body')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Register - FashionStore Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="/assets/img/favicon.png" rel="icon">
    <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/assets/vendor/drift-zoom/drift-basic.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="/assets/css/main.css" rel="stylesheet">

</head>

<body class="register-page">

    <header id="header" class="header position-relative">


        <!-- Main Header -->
        <div class="main-header">
            <div class="container-fluid container-xl">
                <div class="d-flex py-3 align-items-center justify-content-between">

                    <!-- Logo -->
                    <a href="index.html" class="logo d-flex align-items-center">
                        <!-- Uncomment the line below if you also wish to use an image logo -->
                        <!-- <img src="/assets/img/logo.webp" alt=""> -->
                        <h1 class="sitename">Adila<span>Snack</span></h1>
                    </a>
                </div>
            </div>
        </div>

        <!-- Announcement Bar -->
        <div class="announcement-bar py-2">
            <div class="container-fluid container-xl">
                <div class="announcement-slider swiper init-swiper">
                    <script type="application/json" class="swiper-config">
                        {
                            "loop": true,
                            "speed": 600,
                            "autoplay": {
                                "delay": 5000
                            },
                            "slidesPerView": 1,
                            "effect": "slide",
                            "direction": "vertical"
                        }

                    </script>
                    <div class="swiper-wrapper">
                        <!-- <div class="swiper-slide">🚚 Free shipping on orders over $50</div>
                        <div class="swiper-slide">💰 30 days money back guarantee</div>
                        <div class="swiper-slide">🎁 20% off on your first order - Use code: FIRST20</div>
                        <div class="swiper-slide">⚡ Flash Sale! Up to 70% off on selected items</div> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Search Form -->
        <div class="collapse" id="mobileSearch">
            <div class="container">
                <form class="search-form">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products...">
                        <button class="btn search-btn" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </header>

    <main class="main">

        <!-- Page Title -->
        <div class="page-title light-background">
            <div class="container">
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li class="current">Register</li>
                    </ol>
                </nav>
                <h1>Register</h1>
            </div>
        </div><!-- End Page Title -->

        <!-- Register Section -->
        <section id="register" class="register section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row justify-content-center">
                    <div class="col-lg-6">

                        <div class="registration-form-wrapper" data-aos="zoom-in" data-aos-delay="200">

                            <div class="section-header mb-4 text-center">
                                <h2>Buat Akun Anda</h2>
                                <p>Daftar untuk belanja dan nikmati penawarannya</p>
                            </div>

                            <form action="/register/index" method="POST">
                                @csrf
                                @foreach (['username', 'desa', 'jalan'] as $field)
                                @error($field)
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @endforeach

                                <div class="form-group mb-3">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" name="email" id="email" required=""
                                        placeholder="you@example.com">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <div class="password-input">
                                        <input type="password" class="form-control" name="password" id="password"
                                            required="" minlength="8" placeholder="At least 8 characters">
                                    </div>
                                    <!-- <small class="password-requirements">
                                        Must be at least 8 characters long and include uppercase, lowercase, number, and
                                        special character
                                    </small> -->
                                </div>
                                <div>
                                    <label class="form-group mb-3">Kecamatan</label>
                                    <select name="kecamatan" id="kecamatan" class="form-control">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-group mb-3">Desa</label>
                                    <select name="desa" id="desa" class="form-control">
                                        <option value="">Pilih Desa</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-group mb-3">Alamat</label>
                                    <input type="text" name="alamat" placeholder="Masukkan Jalan/Alamat Spesifik"
                                        class="form-control">
                                </div>
                                <!-- <div class="form-group mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="newsletter"
                                            id="newsletter">
                                        <label class="form-check-label" for="newsletter">
                                            Subscribe to our newsletter for exclusive offers and updates
                                        </label>
                                    </div>
                                </div> -->
                                <br><br>
                                <!-- <div class="form-group mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="terms" id="terms"
                                            required="">
                                        <label class="form-check-label" for="terms">
                                            I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy
                                                Policy</a>
                                        </label>
                                    </div>
                                </div> -->
                                <div class="text-center mb-4">
                                    <button type="submit" class="btn btn-primary w-100">Buat Akun Anda</button>
                                </div>

                                <div class="text-center">
                                    <p class="mb-0">Sudah memiliki akun sebelumnya? <a
                                            href="{{ url('/login/index') }}">Login</a></p>
                                </div>

                            </form>

                        </div>

                    </div>
                </div>

            </div>

        </section><!-- /Register Section -->

    </main>

    <footer id="footer" class="footer light-background">
        <div class="footer-main">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-widget footer-about">
                            <a href="index.html" class="logo">
                                <span class="sitename">AdilaSnack</span>
                            </a>
                            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in nibh vehicula,
                                facilisis magna ut, consectetur lorem. Proin eget tortor risus.</p> -->

                            <div class="social-links mt-4">
                                <h5>Ikuti kami</h5>
                                <div class="social-icons">
                                    <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                                    <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                                    <a href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                                    <a href="#" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>
                                    <a href="#" aria-label="Pinterest"><i class="bi bi-pinterest"></i></a>
                                    <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="footer-widget">
                            <h4>Shop</h4>
                            <ul class="footer-links">
                                <li><a href="category.html">New Arrivals</a></li>
                                <li><a href="category.html">Bestsellers</a></li>
                                <li><a href="category.html">Women's Clothing</a></li>
                                <li><a href="category.html">Men's Clothing</a></li>
                                <li><a href="category.html">Accessories</a></li>
                                <li><a href="category.html">Sale</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="footer-widget">
                            <h4>Support</h4>
                            <ul class="footer-links">
                                <li><a href="support.html">Help Center</a></li>
                                <li><a href="account.html">Order Status</a></li>
                                <li><a href="shiping-info.html">Shipping Info</a></li>
                                <li><a href="return-policy.html">Returns &amp; Exchanges</a></li>
                                <li><a href="#">Size Guide</a></li>
                                <li><a href="contact.html">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="footer-widget">
                            <h4>Contact Information</h4>
                            <div class="footer-contact">
                                <div class="contact-item">
                                    <i class="bi bi-geo-alt"></i>
                                    <span>123 Fashion Street, New York, NY 10001</span>
                                </div>
                                <div class="contact-item">
                                    <i class="bi bi-telephone"></i>
                                    <span>+1 (555) 123-4567</span>
                                </div>
                                <div class="contact-item">
                                    <i class="bi bi-envelope"></i>
                                    <span>hello@example.com</span>
                                </div>
                                <div class="contact-item">
                                    <i class="bi bi-clock"></i>
                                    <span>Monday-Friday: 9am-6pm<br>Saturday: 10am-4pm<br>Sunday: Closed</span>
                                </div>
                            </div>

                            <div class="app-buttons mt-4">
                                <a href="#" class="app-btn">
                                    <i class="bi bi-apple"></i>
                                    <span>App Store</span>
                                </a>
                                <a href="#" class="app-btn">
                                    <i class="bi bi-google-play"></i>
                                    <span>Google Play</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row gy-3 align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="copyright">
                            <p>© <span>Copyright</span> <strong class="sitename">MyWebsite</strong>. All Rights
                                Reserved.</p>
                        </div>
                        <div class="credits mt-1">
                            <!-- All the links in the footer should remain intact. -->
                            <!-- You can delete the links only if you've purchased the pro version. -->
                            <!-- Licensing information: https://bootstrapmade.com/license/ -->
                            <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div
                            class="d-flex flex-wrap justify-content-lg-end justify-content-center align-items-center gap-4">
                            <div class="payment-methods">
                                <div class="payment-icons">
                                    <i class="bi bi-credit-card" aria-label="Credit Card"></i>
                                    <i class="bi bi-paypal" aria-label="PayPal"></i>
                                    <i class="bi bi-apple" aria-label="Apple Pay"></i>
                                    <i class="bi bi-google" aria-label="Google Pay"></i>
                                    <i class="bi bi-shop" aria-label="Shop Pay"></i>
                                    <i class="bi bi-cash" aria-label="Cash on Delivery"></i>
                                </div>
                            </div>

                            <div class="legal-links">
                                <a href="tos.html">Terms</a>
                                <a href="privacy.html">Privacy</a>
                                <a href="tos.html">Cookies</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>
</body>

</html>
@endsection

@push('scripts')
<!-- Vendor JS Files -->
<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendor/php-email-form/validate.js"></script>
<script src="/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="/assets/vendor/aos/aos.js"></script>
<script src="/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="/assets/vendor/drift-zoom/Drift.min.js"></script>
<script src="/assets/vendor/purecounter/purecounter_vanilla.js"></script>

<!-- Main JS File -->
<script src="/assets/js/main.js"></script>

<script src="{{ asset('resources/js/alamat.js') }}"></script>
@endpush
<!-- <div class="login-container"> -->
<!-- Bagian Tab -->
<!-- <div class="d-flex justify-content-center">
        <div class="register-wrapper">
            <ul class="nav nav-tabs justify-content-evenly mb-3">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/register/index') }}">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/login/index') }}">Log In</a>
                </li>
            </ul>
        </div>
    </div> -->

<!-- Form -->
<!-- <div class="tab-content">
        <div class="tab-pane fade show active">
            <form method="POST" action="/register/index" class="text-center">
                @csrf
                @foreach (['username', 'desa', 'jalan'] as $field)
                @error($field)
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @endforeach

                <div>
                    <label class="text-start w-100 ps-3">Username</label>
                    <input type="text" name="username" placeholder="Masukkan Username Anda" required>
                </div>
                <div>
                    <label class="text-start w-100 ps-3">Password</label>
                    <input type="password" name="password" placeholder="Masukkan Password Anda" required>
                </div>
                <div>
                    <label class="text-start w-100 ps-3">Kecamatan</label>
                    <select name="kecamatan" id="kecamatan">
                        <option value="">Pilih Kecamatan</option>
                    </select>
                </div>
                <div>
                    <label class="text-start w-100 ps-3">Desa</label>
                    <select name="desa" id="desa">
                        <option value="">Pilih Desa</option>
                    </select>
                </div>
                <div>
                    <label class="text-start w-100 ps-3">Alamat</label>
                    <input type="text" name="alamat" placeholder="Masukkan Jalan/Alamat Spesifik">
                </div>
                <div class="d-flex justify-content-center">
                    <button class="w-50" type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>
</div> -->
