@extends('layout.layout-admin')
@section('title', 'homeAdmin')

@push('styles')

    <link href="{{ custom_asset('templatesbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700,900" rel="stylesheet">
    <link href="{{ custom_asset('templatesbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
@endpush

@section('meta')
    <meta name="_appurl" content="{{ env('BASE_URL') }}">
    <meta name="_token" content="{{ csrf_token() }}">
@endsection

@section('body')
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layout.navbar_admin')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <h3 class="pt-2">Halaman Admin</h3>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Muammar Irfan</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Cards -->
                    <div class="card text w-100">
                        <!-- Cards Header -->
                        <div class="card-header text-primary text-center" style="font-weight:bold;">
                            Berikut Merupakan Produk Yang Anda Jual
                        </div>
                        <!-- Cards Body -->
                        <div class="card-body">

                            <div class="col-12 col-md-10 col-xl-5">
                                <input type="search" name="keyword" id="inputCari"
                                    class="form-control mb-3 border-primary border-2 py-4 ps-4"
                                    placeholder="Cari nama produk atau kategori...."
                                    aria-label="Cari nama produk atau kategori...." aria-describedby="button-addon2">
                                <!-- <button class="btn btn-primary border-primary border-2" type="button" id="btnCari"><i
                                                                                                                                                            class="bi bi-search"></i></button> -->


                            </div>
                            <div class="table-responsive" id="content-produk">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr></tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Detail</th>
                                        <th class="text-center">Kategori</th>
                                        <th class="text-center">Foto</th>
                                        <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                                <th class="text-center align-middle">{{ $loop->iteration }}</th>
                                                <td class="text-center align-middle px-5">{{ $product->nama }}</td>
                                                <td class="text-center align-middle px-5">{{ $product->detail }}</td>
                                                <td class="text-center align-middle px-5">{{ $product->kategori }}</td>
                                                <td class="text-center align-middle px-5"><img
                                                        src="{{ asset('storage/images/' . $product->foto) }}" width="100">
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div class="mb-3">
                                                        <a href="{{ route('admin.detailProduk', $product->id) }}"
                                                            class="btn btn-primary">Lihat variant produk</a>
                                                    </div>
                                                    <div class="">
                                                        <a href="{{ route('produk.edit', $product->id) }}"
                                                            class="btn btn-warning">Edit</a>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Cards Footer -->
                        {{-- <div class="card-footer text-muted">
                            <button class="btn btn-primary">Done</button>
                            <button class="btn btn-danger">Cancel</button>
                        </div> --}}

                    </div>
                    <!-- End of cards -->
                </div>
            </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website
                            2021</span>
                    </div>
                </div>
            </footer>

        </div>
        <!-- /.container-fluid -->

    </div>
@endsection

@push('scripts')
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ env('TYPE_URL') == 'http' ? asset('resources/js/api.js') : secure_asset('resources/js/api.js') }}">
                                                                                                                                >

    </script>
    <script src="{{ custom_asset('templatesbadmin2/js/sb-admin-2.min.js') }}"></script>

@endpush