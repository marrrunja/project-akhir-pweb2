@extends('layout.layout-admin')
@section('title', 'homeAdmin')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
        href="{{ env('TYPE_URL') == 'http' ? asset('resources/css/admin.css') : secure_asset('resources/css/admin.css') }}">
    <link href="../../../../templatesbadmin2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700,900" rel="stylesheet">
    <link href="../../../../templatesbadmin2/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        @media (max-width: 768px) {
            .responsive-heading {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .responsive-heading {
                font-size: 1.25rem;
            }
        }
    </style>

@endpush

@section('meta')
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="_appurl" content="{{ env('BASE_URL') }}">
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
                    <div class="card text w-100">
                        <!-- Cards Header -->
                        <div class="card-header text-primary text-center" style="font-weight:bold;">
                            Berikut Merupakan Varian Dari Produk {{ $nama }}
                        </div>
                        <!-- Cards Body -->
                        <div class="card-body">
                            <div class="container">
                                <div>
                                    <button class="btn btn-primary mb-3 mt-2" data-id="{{ $id }}"
                                        id="btnTambahProdukVariant"><i class="bi bi-plus-circle fw-bold me-1"></i>
                                        Tambah Variant</button>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-xl-5">
                                        @if(Session::has('status') && Session::has('alert'))
                                            <div class="alert alert-{{ Session::get('alert') }}">{{ Session::get('status') }}
                                            </div>
                                        @endif
                                        <form id="form-tambah" method="post" enctype="multipart/form-data">

                                        </form>
                                    </div>
                                </div>
                                <form action="" id="formUbah" method="post">
                                    <div class="row" id="rowKonten">
                                        <div class="table-responsive" id="content-row">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No</th>
                                                        <th class="text-center">Nama</th>
                                                        <th class="text-center">Varian</th>
                                                        <th class="text-center">Harga</th>
                                                        <th class="text-center">Jumlah</th>
                                                        <th class="text-center">Foto</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($variants as $index => $variant)
                                                        <tr>
                                                            <td class="text-center align-middle px-5">
                                                                {{ $variants->firstItem() + $index }}
                                                            </td>
                                                            <td class="text-center align-middle px-5">{{ $variant->nama }}</td>
                                                            <td class="text-center align-middle px-5">{{ $variant->variant }}
                                                            </td>
                                                            <td class="text-center align-middle px-5">{{ $variant->harga }}</td>
                                                            <td class="text-center align-middle px-5">{{ $variant->jumlah }}
                                                            </td>
                                                            <td class="text-center align-middle px-5">
                                                                <img src="{{ asset('storage/image-variant/' . $variant->foto) }}"
                                                                    width="100">
                                                            </td>
                                                            <td class="text-center align-middle px-5">
                                                                <button type="button" data-id="{{ $variant->id }}"
                                                                    class="btn btn-info btn-sm btnEdit">Edit</button>
                                                            </td>
                                                        </tr>


                                                    @endforeach
                                                    <tr>
                                                        <td colspan="7">{{ $variants->links() }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </form>
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
    <script src="{{ custom_asset('resources/js/admin.js') }}"></script>
    <script src="{{ env('TYPE_URL') == 'http' ? asset('resources/js/api.js') : secure_asset('resources/js/api.js') }}">
    </script>

    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ custom_asset('templatesbadmin2/js/sb-admin-2.min.js') }}"></script>
@endpush