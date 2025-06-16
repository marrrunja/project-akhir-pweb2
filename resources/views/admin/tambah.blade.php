@extends('layout.layout-admin')
@section('title', 'Tambah Data')
@push('styles')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/45.1.0/ckeditor5.css" />
    <link rel="stylesheet" href="{{ asset('resources/css/ck.css') }}">

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
                    <div class="row">

                        <div class="col-12">
                            <div class="card px-4 py-4 mb-5">
                                <div class="container">
                                    <form action="{{ route('produk.tambah') }}" method="post" enctype="multipart/form-data"
                                        class="">
                                        <div class="row justify-content-center">
                                            <div class="col-12 col-xl-8 col-md-8">
                                                @csrf
                                                @if(Session::has('status'))
                                                    <div class="alert alert-primary" role="alert">
                                                        {{ Session::get('status') }}
                                                    </div>
                                                @endif
                                                @if(Session::has('gagal'))
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ Session::get('gagal') }}
                                                    </div>
                                                @endif
                                                <h1 class="text-center">Tambah Produk</h1>
                                                <h5 class="text-center mb-4">Silahkan Tambahkan Produk Yang Ingin Anda Jual
                                                </h5>
                                                <div class="mb-3">
                                                    @error('namaProduk') <div class="text-danger fw-semibold">{{ $message }}
                                                        </div>
                                                    @enderror
                                                    <label for="nama" class="form-label">Nama Produk</label>
                                                    <input type="text" name="namaProduk" class="form-control"
                                                        placeholder="Nama Produk" id="nama">
                                                </div>
                                                <div class="mb-3">
                                                    @error('kategori') <div class="text-danger fw-semibold">{{ $message }}
                                                        </div>
                                                    @enderror
                                                    <label for="kategori" class="form-label">Kategori</label>
                                                    <select name="kategori" id="kategori" class="form-select">
                                                        <option value="">Pilih</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->kategori }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    @error('foto') <div class="text-danger fw-semibold">{{ $message }}</div>
                                                    @enderror
                                                    <label for="foto">Foto produk</label>
                                                    <input type="file" name="foto" id="foto" class="form-control">
                                                </div>
                                                <div class="mb-5">
                                                    @error('deskripsi') <div class="text-danger fw-semibold">{{ $message }}
                                                        </div>
                                                    @enderror
                                                    <label for="editor" class="form-label">Deskripsi Produk</label>
                                                    <textarea name="deskripsi" class="form-control"></textarea>
                                                    <input type="hidden" id="jumlahVariant" name="jumlahVariant" value="1"
                                                        placeholder="Deskripsi">
                                                </div>
                                                <div class="error">
                                                    @if($errors->has('gambar.*'))
                                                        <h1>There is an error in your input array</h1>
                                                        <ul>
                                                            @foreach($errors->get('gambar.*') as $errors)
                                                                @foreach($errors as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row justify-content-center" id="gaada">
                                            <div class="col-12 col-md col-xl-6 mb-4">
                                                <div class="card px-4 py-4">
                                                    <div class="body">
                                                        <h3 class="card-title text-center">Variant 1</h3>
                                                        <h5 class="card-subtitle text-center mb-4">Silahkan Masukkan Varian
                                                            Produk Anda</h5>
                                                    
                                                        <div class="mb-3">
                                                            <label for="variant" class="form-label">Nama varian</label>
                                                            <input type="text" id="variant" name="variant[]"
                                                                class="form-control" placeholder="Contoh, original">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="harga" class="form-label">Harga</label>
                                                            <input type="number" name="harga[]" class="form-control"
                                                                id="harga" placeholder="Contoh, 5000">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="stok" class="form-label">Stok</label>
                                                            <input type="number" name="stok[]" class="form-control"
                                                                id="stok" placeholder="Contoh, 10">
                                                        </div>
                                                        <div class="">
                                                            <label for="gambar1" class="form-label">Foto produk</label>
                                                            <input type="file" name="gambar[]" id="gambar1"
                                                                class="form-control" multiple>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="pesan"></div>
                                        <div class="d-flex gap-3 mb-3 justify-content-center">
                                            <button type="button" id="tambahVariant"
                                                class="btn btn-primary mb-2 mt-2">Tambah
                                                variant</button>
                                            <button type="button" id="kurangiVariant"
                                                class="mt-2 mb-2 btn btn-danger">Kurangi</button>
                                            <button type="submit" class="mt-2 mb-2 btn btn-success">Tambah
                                                data</button>
                                            <a href="/admin/index" class="mt-2 mb-2 btn btn-secondary">Kembali</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Spacer untuk gap antara card dan footer -->
                    <div class="pb-1"></div>
                    
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
    <script src="https://cdn.ckeditor.com/ckeditor5/45.1.0/ckeditor5.umd.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ custom_asset('templatesbadmin2/js/sb-admin-2.min.js') }}"></script>
    <script
        src="{{ env('TYPE_URL') == 'http' ? asset('resources/js/tambahData.js') : secure_asset('resources/js/tambahData.js') }}"></script>

@endpush