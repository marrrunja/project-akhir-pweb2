@extends('layout.layout-admin')
@section('title', 'Daftar Produk')

@section('meta')
<meta name="_appurl" content="{{ env('BASE_URL') }}">
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{ env('TYPE_URL') == 'http' ? asset('resources/css/admin.css') : secure_asset('resources/css/admin.css') }}">

@endpush


@section('body')
<section class="pt-5 pb-5">
    <div class="container">
        <h1>Daftar Order User</h1>
        <div class="row mb-3 mt-3">
            <div class="col-12 col-xl-3" id="kontent">
                <select class="form-select" id="urutkan">
                    <option value="2">Urutkan</option>
                    <option value="0">Terbaru</option>
                    <option value="1">Terlama</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-12" id="konten">
                <table class="table">
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
                            <td><a href="{{ route('admin.detailOrder', $order->id) }}">Detail Order</a></td>
                        </tr>
                        @endforeach
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
<script src="{{ env('TYPE_URL') == 'http' ? asset('resources/js/api.js') : secure_asset('resources/js/api.js') }}"></script>
@endpush
