<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard Admin</title>

    <!-- Font Awesome -->
    <link href="../../../../templatesbadmin2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700,900" rel="stylesheet">

    <!-- Custom styles -->
    <link href="../../../../templatesbadmin2/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        /* Hover effect untuk card */
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
        }

        /* Hover effect tombol */
        .btn-hover {
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-hover:hover {
            filter: brightness(110%);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .me-2 {
            margin-right: 0.5rem;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Welcome Text -->
                    <div class="d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0">
                        <span class="small text-gray-800 fw-bold">
                            Selamat Datang di <strong>Dashboard Admin</strong>
                        </span>
                    </div>

                    <!-- Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- User Info -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle"
                                    src="../../../../templatesbadmin2/img/undraw_profile.svg">
                            </a>
                        </li>
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid min-vh-80">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 fw-bold">Silahkan Pilih Menu Yang Tersedia</h1>
                        <a href="logout.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm btn-hover">
                            <i class="fas fa-sign-out-alt fa-sm text-white-50 me-2"></i> Logout
                        </a>
                    </div>

                    <!-- Menu Cards -->
                    <div class="row gx-4 gy-4">

                        <!-- Tambah Produk -->
                        <div class="col-12 col-md-4 mb-4">
                            <div class="card border-left-primary shadow-sm h-100 d-flex flex-column">
                                <div class="card-body d-flex flex-column justify-content-between text-center">
                                    <div class="flex-grow-1">
                                        <h6 class="text-xs font-weight-bold text-primary text-uppercase mb-3">
                                            Tambah Produk
                                        </h6>
                                        <p class="mb-4 text-gray-700 fw-semibold">
                                            Klik tombol di bawah untuk menambah produk baru.
                                        </p>
                                    </div>
                                    <div class="mt-auto">
                                        <a href="{{ route('admin.tambah') }}"
                                            class="btn btn-primary btn-lg shadow-sm w-100">
                                            <i class="fas fa-plus fa-sm me-2"></i> Tambah Produk
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Lihat Produk -->
                        <div class="col-12 col-md-4 mb-4">
                            <div class="card border-left-success shadow-sm h-100 d-flex flex-column">
                                <div class="card-body d-flex flex-column justify-content-between text-center">
                                    <div class="flex-grow-1">
                                        <h6 class="text-xs font-weight-bold text-success text-uppercase mb-3">
                                            Lihat Produk
                                        </h6>
                                        <p class="mb-4 text-gray-700 fw-semibold">
                                            Klik tombol di bawah untuk melihat daftar produk.
                                        </p>
                                    </div>
                                    <div class="mt-auto">
                                        <a href="{{ route('admin.manage') }}"
                                            class="btn btn-success btn-lg shadow-sm w-100">
                                            <i class="fas fa-box-open fa-sm me-2"></i> Lihat Produk
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Laporan Penjualan -->
                        <div class="col-12 col-md-4 mb-4">
                            <div class="card border-left-warning shadow-sm h-100 d-flex flex-column">
                                <div class="card-body d-flex flex-column justify-content-between text-center">
                                    <div class="flex-grow-1">
                                        <h6 class="text-xs font-weight-bold text-warning text-uppercase mb-3">
                                            Lihat Laporan Penjualan
                                        </h6>
                                        <p class="mb-4 text-gray-700 fw-semibold">
                                            Klik tombol di bawah untuk melihat laporan penjualan.
                                        </p>
                                    </div>
                                    <div class="mt-auto">
                                        <a href="{{ route('admin.order') }}"
                                            class="btn btn-warning btn-lg shadow-sm w-100">
                                            <i class="fas fa-chart-line fa-sm me-2"></i> Lihat Laporan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- End Row -->

                </div>
                <!-- /.container-fluid -->

                @extends('layout.layout-admin')
                @section('title', 'Halaman home admin')


                @push('styles')
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
                        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT"
                        crossorigin="anonymous">
                    <link rel="stylesheet" type="text/css" href="{{ asset('resources/css/admin.css') }}">
                @endpush

                @section('body')

                <!-- End of Page Wrapper -->

                <!-- Scroll to Top Button-->
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>

                <!-- Scripts -->
                <script src="vendor/jquery/jquery.min.js"></script>
                <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
                <script src="js/sb-admin-2.min.js"></script>

</body>

</html>