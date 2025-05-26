@extends('layout.layout')
@section('title', 'Daftar Produk')


@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{ asset('resources/css/admin.css') }}">
@endpush

@section('body')
<section class="pt-5 pb-5">
    <div class="container">
        <div class="row">
            
            @foreach($orderItems as $orderItem)
            <div class="col-12 col-md-8 col-xl-5">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Tanggal Transaksi: {{ $orderItem->tanggal_transaksi }}</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Produk yang dibeli {{ $orderItem->nama }} Variant {{ $orderItem->variant }}</h6>
                    <p>Harga satuan: {{ $orderItem->harga }}</p>
                    <p class="card-text">Jumlah beli {{ $orderItem->jumlah }}</p>
                    <div class="card-text">Harga total {{ $orderItem->total_harga }}</div>
                  </div>
                </div>
            </div>
            @endforeach
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
