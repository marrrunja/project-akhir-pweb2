@extends('layout.layout')
@section('title', 'Variant produk')


@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
@endpush
@section('body')
<section class="pt-5">
    <div class="container">
        <h1>Daftar produk</h1>
        <div class="row">
            <div class="col-12 col-md-12 col-xl-10">
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
                               <a class="btn btn-info" href="{{ route('admin.editProduk', $variant->id) }}">Edit</a>
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
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/45.1.0/ckeditor5.umd.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
</script>
@endpush
