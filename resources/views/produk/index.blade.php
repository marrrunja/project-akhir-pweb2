@extends('layout.layout')
@section('title', 'Halaman produk')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
@endpush

@section('body')
<div class="container pt-4 pb-4">
    <h1>Halaman produk</h1>
    <div class="d-flex gap-5 flex-md-wrap">
        @foreach($products as $produk)
        <div class="card" style="width: 18rem;">
        <img src="{{ asset('storage/images/' . $produk->foto) }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ $produk->name }}</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">{{ $produk->kategori->kategori }}</h6>
                <p class="card-text">{{ $produk->detail }}</p>
                <ul>
                    @php
                    $i = 0;
                    @endphp
                    @foreach($produk->variant as $variant)
                    <li>{{ $variant->variant }} Sisa: {{ $variant->stok->count() }}</li>
                    @endforeach
                </ul>
                <a href="#" class="btn btn-primary mb-2">Beli Produk</a>    
                <a href="#" class="btn btn-success">Masukkan ke keranjang</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
</script>
@endpush
