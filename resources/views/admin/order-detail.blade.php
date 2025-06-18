@extends('layout.layout-admin')
@section('title', 'homeAdmin')

@push('styles')
<link href="{{ custom_asset('templatesbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet"
    type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700,900" rel="stylesheet">
<link href="{{ custom_asset('templatesbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ custom_asset('resources/css/admin.css') }}">

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
                <h1 class="text-center mb-3">Detail Order</h1>
                <div class="row justify-content-center">
                    @foreach ($orderItems as $orderItem)
                    <div class="col-10 col-md-6 col-xl-3 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/image-variant/' . $orderItem->foto) }}" class="card-img-top">
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td style="font-weight:bold; font-size:1.2rem;"> {{ $orderItem->nama }} Variant
                                            {{ $orderItem->variant }}</td>
                                    </tr>
                                </table>
                                <table>
                                    <tr>
                                        <td>Harga</td>
                                        <td>:</td>
                                        <td>{{ number_format($orderItem->harga,0,',','.') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah</td>
                                        <td>:</td>
                                        <td>{{ $orderItem->jumlah }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td>:</td>
                                        <td>{{ number_format($orderItem->total_harga, 0,',','.') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
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
<script src="https://cdn.ckeditor.com/ckeditor5/45.1.0/ckeditor5.umd.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ custom_asset('templatesbadmin2/js/sb-admin-2.min.js') }}"></script>
<script type="module" src="{{ custom_asset('resources/js/logout.js') }}"></script>
@endpush
