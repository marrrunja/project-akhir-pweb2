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

@section('body')

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
@endpush
