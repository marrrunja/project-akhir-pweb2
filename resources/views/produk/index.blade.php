@extends('layout.layout')

@section('title', 'Halaman Produk')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<style>
    body {
        background-color: #f8f9fa;
    }

    .product-card {
        border-radius: 15px;
        overflow: hidden;
        height: 100%;
    }

    .category-btn {
        border-radius: 20px;
    }

    .category-btn.active {
        background-color: #ff7f50;
        color: #fff;
    }

    .product-card img {
        height: 250px;
        width: 100%;
        object-fit: cover;
        aspect-ratio: 1 / 1;
    }

    .product-card .card-body {
        padding: 1rem;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

</style>
@endpush

@section('meta')
<meta name="_token" content="{{ csrf_token() }}">
@endsection

@section('body')
<div class="container py-4">
    <h1 class="mb-4">Halaman Produk</h1>
    <div class="mb-3 mt-3">
        <form action="/login/logout" method="post">
            @csrf
            <button class="btn btn-danger" type="submit">Logout</button>
        </form>

    </div>

    <div class="d-flex gap-2 mb-4">
        <button class="btn category-btn active">All</button>
        <button class="btn category-btn">Makanan</button>
        <button class="btn category-btn">Minuman</button>
        <button class="btn category-btn">Souvenir</button>
    </div>

    <div class="row g-3">
        @if(Session::has('status'))
            <div class="alert alert-primary" role="alert">
                {{ Session::get('status') }}
            </div>
        @endif
        @foreach($products as $produk)
        <div class="col-md-3">
            <div class="card product-card h-100">
                <a href="{{route('cart.index')}}"><img src="{{ asset('storage/images/' . $produk->foto) }}" class="card-img-top" alt="..."></a>
                <div class="card-body text-center">
                    <h5 class="card-title"><a href="{{ route('produk.variant') }}?id={{ $produk->id }}">{{ $produk->nama }}</a></h5>
                    <p class="text-muted">{{ $produk->kategori->kategori }}</p>
                    <ul class="list-unstyled">
                        @foreach($produk->variant as $variant)

                        <li>{{ $variant->variant }} - Rp{{ number_format($variant->harga ?? 0, 0, ',', '.') }} - Stok: {{ $variant->stok ? $variant->stok->jumlah : 0 }}</li>
                        @endforeach
                    </ul>
                    <button style="background-color: #A23C33;" class="btn btn-primary add-to-cart-btn w-100" data-bs-toggle="modal" data-bs-target="#addToCartModal{{$produk->id}}">Add to Cart <i class="bi bi-cart4 ms-2"></i></button>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Beli</button>
                    </ul>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addToCartModal{{$produk->id}}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih Variant dan Jumlah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <label>Pilih Variant:</label>
                            <select class="form-select" name="variant_id" required>
                                @foreach($produk->variant as $variant)
                                <option value="{{ $variant->id }}">{{ $variant->variant }} -
                                    Rp{{ number_format($variant->harga ?? 0, 0, ',', '.') }} - Sisa:
                                    {{ $variant->stok ? $variant->stok->count() : 0 }}</option>
                                @endforeach
                            </select>
                            <div class="mt-3">
                                <label>Jumlah:</label>
                                <input type="number" class="form-control" name="qty" value="1" min="1" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Tambahkan ke Keranjang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('resources/js/order.js') }}"></script>
@endpush
