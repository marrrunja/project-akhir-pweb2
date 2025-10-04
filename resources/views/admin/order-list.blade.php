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
                <div class="card text mb-4">
                    <!-- Cards Header -->
                    <div class="card-header text-primary text-center" style="font-weight:bold;">
                        Berikut Merupakan Laporan Penjualan Anda
                    </div>
                    <!-- Cards Body -->
                    <div class="card-body ">

                        <div class="row mb-4">
                            <div class="col-12 mb-3 mb-md-3 mb-xl-0 col-xl-3" id="kontent">
                                <select class="form-control" id="urutkan">
                                    <option value="2">Urutkan</option>
                                    <option value="0">Terbaru</option>
                                    <option value="1">Terlama</option>
                                </select>
                            </div>
                            <div class="col">
                                <a href="/cetak/order-list" class="btn btn-primary" target="_blank">Cetak</a>
                            </div>
                        </div>
                        <div class="table-responsive" id="konten">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <th>#</th>
                                    <th>Tanggal transaksi</th>
                                    <th>Nama Pengguna</th>
                                    <th>Dibayar</th>
                                    <th>Detail</th>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $order->tanggal_transaksi }}</td>
                                        <td>{{ $order->username }}</td>
                                        <td>{{ $order->is_dibayar === 0 ? 'Belum' : 'Sudah dibayar' }}</td>
                                        <td><a href="{{ route('admin.detailOrder', $order->id) }}">Detail
                                                Order</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
<script type="module" src="{{ custom_asset('resources/js/logout.js') }}"></script>

@endpush
