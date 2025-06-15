@extends('layout.layout')

@section('title', 'About us')

@push('styles')
<!-- Favicons -->
<!-- Favicons -->
<link href="{{ custom_asset('assets/img/favicon.png') }}" rel="icon">
<link href="{{ custom_asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

<!-- Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Quicksand:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=info" />

<!-- Vendor CSS Files -->
<link href="{{ custom_asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ custom_asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ custom_asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
<link href="{{ custom_asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
<link href="{{ custom_asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<link href="{{ custom_asset('assets/vendor/drift-zoom/drift-basic.css') }}" rel="stylesheet">
<!-- Main CSS File -->
<link href="{{ custom_asset('assets/css/main.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ custom_asset('resources/css/user.css') }}">

<style>
    h2 {
        text-align: center;
        margin-bottom: 3rem;
        font-size: 2rem;
        color: #1a1a1a;
    }

    .cards {
        font-family: 'Segoe UI', 'sans-serif';
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
    }

    .card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
    }

    .card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-title {
        font-size: 1.3rem;
        font-weight: bold;
        margin: 0 0 0.5rem 0;
        color: #8c0d4f;
    }

    .card-text {
        font-size: 1rem;
        line-height: 2;
        color: #555;
    }

    .social-icons {
        margin-top: 1rem;
    }

    .social-icons a {
        margin-right: 0.5rem;
        text-decoration: none;
        font-size: 1.2rem;
        color: #8c0d4f;
        transition: color 0.2s ease;
    }

    .social-icons a:hover {
        color: #8c0d4f;
    }

</style>

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
                    <li><a href="/">Home</a></li>
                    <li class="current">About</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>About us</h2>
            <p>Follow Ig Kami</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center mb-5 gap-4">
                <div class="col-8 col-md-5 col-xl-3">
                    <div class="card">
                        <img src="{{ asset('storage/about/arfun.jpg') }}" alt="Foto Rizky">
                        <div class="card-body">
                            <h3 class="card-title">Arfun Ali Yafie</h3>
                            <p class="card-text"><strong>Front-End Developer</strong> yang ahli dalam membuat UI modern dan responsif
                                dengan JavaScript & Bootstrap.</p>
                            <div class="social-icons">
                                <a href="https://github.com/username" title="GitHub">
                                    <i class="fab fa-github fa-lg me-1 text-dark"></i>
                                </a>
                                <a href="https://instagram.com/username" target="_blank" title="Instagram"
                                    style="color: #e4405f;">
                                    <i class="fab fa-instagram fa-lg"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8 col-xl-3">
                    <div class="card">
                        <img src="{{ asset('storage/about/arfun.jpg') }}" alt="Foto Rizky">
                        <div class="card-body">
                            <h3 class="card-title">Bintang Aliqa</h3>
                            <p class="card-text"><strong>Front-End Developer</strong> yang ahli dalam membuat UI modern dan responsif
                                dengan React & Tailwind CSS.</p>
                            <div class="social-icons">
                                <a href="https://github.com/username" title="GitHub">
                                    <i class="fab fa-github fa-lg me-1 text-dark"></i>
                                </a>
                                <a href="https://instagram.com/username" target="_blank" title="Instagram"
                                    style="color: #e4405f;">
                                    <i class="fab fa-instagram fa-lg"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8 col-xl-3">
                    <div class="card">
                        <img src="{{ asset('storage/about/eka.jpg') }}" alt="Foto Rizky">
                        <div class="card-body">
                            <h3 class="card-title">Eka Putra</h3>
                            <p class="card-text"><strong>Front-End Developer</strong> yang ahli dalam membuat UI modern dan responsif
                                dengan React & Tailwind CSS.</p>
                            <div class="social-icons">
                                <a href="https://github.com/username" title="GitHub">
                                    <i class="fab fa-github fa-lg me-1 text-dark"></i>
                                </a>
                                <a href="https://instagram.com/username" target="_blank" title="Instagram"
                                    style="color: #e4405f;">
                                    <i class="fab fa-instagram fa-lg"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center gap-4">
                <div class="col-8 col-xl-3">
                    <div class="card">
                        <img src="{{ asset('storage/about/irfan2.jpg') }}" alt="Foto Rizky">
                        <div class="card-body">
                            <h3 class="card-title">Muammar Irfan</h3>
                            <p class="card-text"><strong>Back-End Developer</strong> yang bertanggung jawab membangun logika aplikasi, manajemen database, dan integrasi API.</p>
                            <div class="social-icons">
                                <a href="https://github.com/marrrunja" title="GitHub">
                                    <i class="fab fa-github fa-lg me-1 text-dark"></i>
                                </a>
                                <a href="https://instagram.com/marrmr04" target="_blank" title="Instagram"
                                    style="color: #e4405f;">
                                    <i class="fab fa-instagram fa-lg"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8 col-xl-3">
                    <div class="card">
                        <img src="{{ asset('storage/about/griyo.jpg') }}" alt="Foto Rizky">
                        <div class="card-body">
                            <h3 class="card-title">Griyo Sihnugroho</h3>
                            <p class="card-text"><strong>Front-End Developer</strong> yang bikin sistem yang bisa kerja keras biar user tinggal pencet tombol doang. Membuat sistem Database</p>
                            <div class="social-icons">
                                <a href="https://github.com/griyo1009" title="GitHub">
                                    <i class="fab fa-github fa-lg me-1 text-dark"></i>
                                </a>
                                <a href="https://instagram.com/griyo_1009" target="_blank" title="Instagram"
                                    style="color: #e4405f;">
                                    <i class="fab fa-instagram fa-lg"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Starter Section Section -->
</main>
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
<script src="{{ custom_asset('resources/js/api.js') }}"></script>

@endpush
