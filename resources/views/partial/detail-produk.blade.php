<div class="col-12 mb-3 text-center">
    <img src="{{ asset('storage/images/'.$produk->foto) }}" alt="{{ $produk->nama }}"
        class="img-fluid p-2 img-thumbnail" style="max-height: 300px; max-width:300px; object-fit: cover;">
</div>
<div class="col-12">    
    <!-- Text Content Inside List Group -->
    <ul class="list-group list-group-flush">
        <!-- Product Name -->
        <li class="list-group-item px-0 pt-0 border-top-0">
            <h2 class="fw-bold mb-2">{{ $produk->nama }}</h2>
        </li>

        <!-- Category -->
        <li class="list-group-item px-0">
            <span
                class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 rounded-pill px-3 py-1">
                <i class="fas fa-tag me-1 fs-6"></i> {{ $produk->kategori }}
            </span>
        </li>

        <!-- Product Details -->
        <li class="list-group-item px-0 pb-0 border-bottom-0">
            <div class="mt-3">
                <h6 class="text-uppercase text-muted small mb-3">Deskripsi</h6>
                <div class="text-muted" style="line-height: 1.7;">
                    {{ $produk->detail }}
                </div>
            </div>
        </li>
    </ul>
</div>
