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
  <style>
    :root {
      --maroon: #9E3B32;
    }

    .navbar-brand {
      font-weight: bold;
      color: var(--maroon) !important;
    }

    .btn-maroon {
      background-color: var(--maroon);
      color: white;
      border: none;
    }

    .btn-maroon-outline {
      color: var(--maroon);
      border: 1px solid var(--maroon);
    }

    .btn-maroon:hover {
      background-color: #7b2e27;
    }

    .card {
      border: none;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .profile-pic {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 50%;
      border: 3px solid var(--maroon);
    }

    body {
      background-color: #f8f9fa;
    }
  </style>

@endpush

@section('body')
  
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
@endpush
