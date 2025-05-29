@extends('layout.layout')

@section('title', 'Halaman Produk varian')


@push('styles')
<!-- Favicon & Apple Touch Icon -->
<link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
<link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

<!-- Google Fonts -->
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
@endpush

@section('meta')
<meta name="_token" content="{{ csrf_token() }}">
@endsection

@section('body')
<div class="container">
	<h1>Halaman Produk Variant</h1>

	<div class="row">
		@foreach($variants as $variant)
		<div class="col-12 col-md-6 col-xl-4">
			<form method="post" action="{{ route('transaksi.order', $variant->id) }}">
				@csrf
				@method('POST')
				<div class="card">
				<div class="card-body">
					@error('jumlah') <div class="fw-semibold text-danger">{{ $message }}</div> @enderror
					@error('harga') <div class="fw-semibold text-danger">{{ $message }}</div> @enderror
					<h5 class="card-title">{{ $variant->variant }}</h5>
					<h6 class="card-subtitle mb-2 text-body-secondary">{{ $variant->produk->nama }}</h6>
					<p class="card-text">{{ $variant->produk->detail }}</p>
					<div class="card-subtitle text-secondary">Sisa: {{ $variant->stok->jumlah }}</div>
					<div class="mt-3 mb-3">
						<button type="button" class="btn btn-success btnTambah">+</button>
						<input type="hidden" name="jumlah" id="jumlah" data-max="{{ $variant->stok->jumlah }}" value="0">
						<button type="button" class="btn btn-primary btnHasil">0</button>
						<button type="button" class="btn btn-success btnKurang">-</button>
						<div class="text-secondary text-danger mt-2 pesan d-none fw-semibold"></div>
					</div>
					<button type="submit" class="btn btn-primary">Rp. {{ number_format($variant->harga, 0, ",", ".") }}</button>
				</div>
				</div>
			</form>
		</div>
		@endforeach
	</div>
</div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('resources/js/order.js') }}"></script>
@endpush

