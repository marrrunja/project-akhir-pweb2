@extends('layout.layout')

@section('title', 'History pembelian')

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
<link rel="stylesheet" href="{{ custom_asset('resources/css/user.css') }}">
@endpush

@section('body')
<main class="main">
    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="/">Home</a></li>
                    <li class="current">History Pembelian</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Daftar Pesanan anda</h2>
            <p>Klik lihat detail untuk melihat detail setiap pesanan</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th class="text-center py-4">#</th>
                        <th class="text-center py-4">Order Id</th>
                        <th class="text-center py-4">Tanggal Transaksi</th>
                        <th class="text-center py-4">Total Harga</th>
                        <th class="text-center py-4">Status</th>
                        <th class="text-center py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <th class="p-4 text-center">{{ $loop->iteration }}</th>
                        <td class="p-4 text-center">{{ $order->order_id }}</td>
                        <td class="p-4 text-center">{{ $order->tanggal_transaksi }}</td>
                        <td class="p-4 text-center">Rp {{ $order->total_harga }}</td>
                        <td class="p-4 text-center">{{ $order->is_dibayar == 1 ? "Sudah dibayar" : "Belum dibayar" }}
                        </td>
                        <td class="p-4 text-center" class="dropdown">
                            <i class="bi bi-three-dots-vertical text-ungu-utama fw-bold" class="dropdown"
                                data-bs-toggle="dropdown" style="cursor:pointer;"></i>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item hover" href="/transaksi/user/detail/{{ $order->id }}">
                                        Lihat detail
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item hover" href="{{ $order->link_bayar }}">
                                        Link pembayaran
                                    </a>
                                </li>
                                <li>
                                    <span class="dropdown-item hover">Batalkan pesanan</span>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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

@endpush
