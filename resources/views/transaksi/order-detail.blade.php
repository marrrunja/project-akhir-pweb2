@extends('layout.layout-admin')

@section('title', 'Halaman Produk varian')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
@endpush

@section('meta')
<meta name="_token" content="{{ csrf_token() }}">
<meta name="_appurl" content="{{ env('BASE_URL') }}">
@endsection


@section('body')
<section class="pt-5 pb-5">
    <div class="container">
        <h1>Halaman order detail</h1>
        <div class="row">
            <div class="col-12 col-md-8 col-xl-7">
                <div class="card">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $produkVariant->produk->nama }}</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">{{ $produkVariant->variant }}</h6>
                            <p class="card-text" >Jumlah Beli <span id="jumlah">{{ $jumlah }}</span></p>
                            <div class="card-text">Harga Satuan Rp <span id="hargaSatuan">{{ number_format($produkVariant->harga, 0, ",", ".") }}</span></div>
                            <div class="card-text">Total Rp <span id="hargaTotal">{{ number_format($total, 0, ",", ".") }}</span></div>
                            <button type="button" id="btnBayar" data-id="{{ $produkVariant->id }}" class="btn btn-primary mt-3 mb-3">Bayar Rp {{ number_format($total, 0, ",", ".") }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('resources/js/checkout.js') }}"></script>
@endpush
