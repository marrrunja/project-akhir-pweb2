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
            @include('layout.nav-admin')
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Cards -->
                <div class="card text w-100 mb-5">
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
                                    <tr>
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
                                        <td class="text-center align-middle px-4">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                    Klik
                                                </button>
                                                <div class="dropdown-menu">
                                                   <a href="{{ route('admin.detailProduk', $product->id) }}"
                                                    class="dropdown-item fs-1">Lihat variant produk</a>
                                                     <a href="{{ route('produk.edit', $product->id) }}"
                                                            class="dropdown-item">Edit</a>
                                                </div>
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

                <!-- Spacer untuk gap antara card dan footer -->
                <div class="pb-4"></div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2021</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
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
