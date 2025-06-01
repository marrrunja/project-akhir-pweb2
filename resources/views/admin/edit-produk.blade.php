@extends('layout.layout-admin')
@section('title', 'Halaman edit data admin')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
@endpush
@section('body')
<section class="pt-5 pb-5">
    <div class="container">
        <form method="post" action="{{ route('produk.doEdit', $produk->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12 col-md-8 col-xl-5">
                    @if(Session::has('status') && Session::has('alert'))
                        <div class="alert alert-{{ Session::get('alert') }}">{{ Session::get('status') }}</div>
                    @endif
                    <div class="card">
                        <img src="{{ asset('storage/images/'.$produk->foto) }}" class="card-img-top" alt="">
                        <div class="card-body">
                            <div class="mb-3">
                                
                                <input type="text" name="nama" class="form-control" value="{{ $produk->nama }}">
                            </div>
                            <div class="mb-3">
                                 <input type="text" name="detail" class="form-control" value="{{ $produk->detail }}">
                            </div>
                            <div class="mb-3">
                                <select class="form-select" name="kategori">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $produk->kategori_id ? 'selected' : '' }}>{{ $category->kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <small class="text-primary fw-semibold mb-2">Kosongkan jika tidak ingin diganti</small>
                                <input type="file" name="gambar" class="form-control mt-2">
                                <input type="hidden" name="gambarLama" value="{{ $produk->foto }}">
                            </div>
                            <div class="mb-3 d-flex gap-3">
                                <button type="submit" class="btn btn-primary">Ubah</button>
                                <a href="/admin/produk" class="btn btn-danger">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
@endpush