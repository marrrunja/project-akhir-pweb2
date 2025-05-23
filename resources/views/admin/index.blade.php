@extends('layout.layout')
@section('title', 'Halaman home admin')


@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
@endpush

@section('body')
<section class="pt-5 pb-5">
    <div class="container">
        <h1>Halaman utama admin</h1>
        <div class="row">
            <div class="col-12 col-md-10 col-xl-5">
                <ul class="list-group">
                    <li class="list-group-item"> 
                        <a href="{{ route('admin.tambah') }}">Tambah data</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('admin.manage') }}">Lihat produk</a>
                    </li>
                </ul>
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
@endpush