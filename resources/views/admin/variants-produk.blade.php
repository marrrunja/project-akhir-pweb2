@extends('layout.layout')
@section('title', 'Variant produk')


@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{ asset('resources/css/admin.css') }}">
@endpush

@section('meta')
<meta name="_token" content="{{ csrf_token() }}">
@endsection

@section('body')
<section class="pt-5 pb-5">
    <div class="container">
        <h1>Daftar produk</h1>
        <form action="" id="formUbah" method="post">
            <div class="row" id="rowKonten">
                <div class="col-12 col-md-12 col-xl-10">
                    @if(Session::has('status') && Session::has('alert'))
                        <div class="alert alert-{{ Session::get('alert') }}">{{ Session::get('status') }}</div>
                    @endif
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Variant</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach($variants as $index => $variant)
                            <tr>
                                <th>{{ $variants->firstItem() + $index }}</th>
                                <td>{{ $variant->nama }}</td>
                                <td>{{ $variant->variant }}</td>
                                <td>{{ $variant->harga }}</td>
                                <td>{{ $variant->jumlah }}</td>
                                <td class="d-flex gap-3">
                                <button type="button" data-id="{{ $variant->id }}" class="btn btn-info btnEdit">Edit</button>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="6">{{ $variants->links() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
        <div class="row">
             <a href="{{ \Illuminate\Support\Facades\URL::previous() }}" class="hover">&laquo;Kembali ke halaman sebelumnya</a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/45.1.0/ckeditor5.umd.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
</script>
<script src="{{ asset('resources/js/admin.js') }}"></script>
@endpush
