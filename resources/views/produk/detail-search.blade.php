@extends('layout.layout')

@section('title', 'Detail pencarian')

@push('styles')
<!-- Favicons -->
<link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
<link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

<!-- Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/drift-zoom/drift-basic.css') }}" rel="stylesheet">

<!-- Main CSS File -->
<link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

@endpush

@section('body')

<section class="pt-5 pb-5">    
    <div class="container">
        <div class="row gy-2">
            @if(count($products) > 0)
                @foreach($products as $row)
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="card">
                          <img class="card-img-top" src="{{ asset('storage/image-variant/'.$row->foto) }}" alt="Card image cap">
                          <div class="card-body">
                            <form method="post" {{ route('transaksi.order', $row->id) }}>
                                @csrf
                                <h5 class="card-title">{{ $row->nama }}</h5>
                                <small class="card-subtitle mb-2">{{ $row->variant }}</small>
                                <p class="card-text">{{ $row->detail }}</p>
                                <button class="btn btn-primary" type="submit">Beli {{ $row->harga }}</button>
                            </form>
                          </div>
                        </div>
                    </div>
                @endforeach
            @else
            <div class="col-12 col-md-10 col-xl-8">
                <h1 class="mt-2 mb-2">Uupsss... produk yang dicari tidak ada</h1>  
            </div>
            @endif
        </div>
    </div>
</section>
@endsection


@push('scripts')
<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/drift-zoom/Drift.min.js') }}"></script>
<script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>

<!-- Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<script src="{{ asset('resources/js/order.js') }}"></script>
@endpush

