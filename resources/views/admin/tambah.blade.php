@extends('layout.layout-admin')

@section('title', 'tambahData')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/45.1.0/ckeditor5.css" />
<link rel="stylesheet" href="{{ asset('resources/css/ck.css') }}">
@endpush

@section('body')

<section class="pt-5 pb-5">
    <div class="container">
        <h1>Halaman admin</h1>
        <form action="{{ route('produk.tambah') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12 col-xl-5">
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
                    <div class="mb-3">
                        @error('namaProduk') <div class="text-danger fw-semibold">{{ $message }}</div>@enderror
                        <label for="nama" class="form-label">Nama Produk</label>
                        <input type="text" name="namaProduk" class="form-control" placeholder="Nama Produk" id="nama">
                    </div>
                    <div class="mb-3">
                        @error('kategori') <div class="text-danger fw-semibold">{{ $message }}</div>@enderror
                        <label for="kategori" class="form-label">Kategori</label>
                        <select name="kategori" id="kategori" class="form-select">
                            <option value="">Pilih</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        @error('foto') <div class="text-danger fw-semibold">{{ $message }}</div>@enderror
                        <label for="foto">Foto produk</label>
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                    <div class="mb-3">
                        @error('deskripsi') <div class="text-danger fw-semibold">{{ $message }}</div>@enderror
                        <label for="editor" class="form-label">Deskripsi Produk</label>
                        <textarea name="deskripsi" class="form-control"></textarea>
                        <input type="hidden" id="jumlahVariant" name="jumlahVariant" value="1">
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
                    <div class="mb-3">

                        <fieldset class="shadow rounded p-3">
                            <legend>Varian 1</legend>
                            @error('variant') <div class="text-danger fw-semibold">{{ $message }}</div>@enderror
                            <div class="mb-3">
                                <label for="variant" class="form-label">Nama varian</label>
                                <input type="text" id="variant" name="variant[]" class="form-control"
                                    placeholder="Contoh, original">
                            </div>
                            <div class="mb-3">
                                @error('harga') <div class="text-danger fw-semibold">{{ $message }}</div>@enderror
                                <label for="harga" class="form-label">Harga</label>
                                <input type="number" name="harga[]" class="form-control" id="harga"
                                    placeholder="Contoh, 5000">
                            </div>
                            <div class="mb-3">
                                @error('stok') <div class="text-danger fw-semibold">{{ $message }}</div>@enderror
                                <label for="stok" class="form-label">Stok</label>
                                <input type="number" name="stok[]" class="form-control" id="stok"
                                    placeholder="Contoh, 10">
                            </div>
                            <div class="mb-3">
                                <label for="gambar1">Foto produk</label>
                                <input type="file" name="gambar[]" id="gambar1" class="form-control" multiple>
                            </div>
                        </fieldset>
                    </div>
                    <div id="gaada"></div>
                    <div id="pesan"></div>
                    <div class="d-flex gap-3 mb-3">
                        <button type="button" id="tambahVariant" class="btn btn-primary mb-2 mt-2">Tambah
                            variant</button>
                        <button type="button" id="kurangiVariant" class="mt-2 mb-2 btn btn-danger">Kurangi</button>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">Tambah data</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col">
                <a href="{{ \Illuminate\Support\Facades\URL::previous() }}">&laquo;Kembali ke halaman utama</a>
            </div>
        </div>
    </div>
</section>


@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/45.1.0/ckeditor5.umd.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
</script>
<script src="{{ env('TYPE_URL') == 'http' ? asset('resources/js/tambahData.js') : secure_asset('resources/js/tambahData.js') }}"></script>

</script>
@endpush
