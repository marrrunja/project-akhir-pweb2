@extends('layout.layout')

@section('title', 'Halaman Produk varian')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('resources/js/order.js') }}"></script>
@endpush
