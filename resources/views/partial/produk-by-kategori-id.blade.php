  <!-- Product Item 1 -->
  @foreach($products as $product)
  <div class="col-md-6 col-lg-3 product-item isotope-item filter-clothing">
      <div class="product-card">
          <div class="">
              <span class="badge">{{ $product->kategori }}</span>
              <a href="/variant/{{ $product->id }}">
              <img src="{{ asset('storage/images/'.$product->foto) }}" alt="Product" class="img-fluid main-img">
              <!-- <img src="{{ asset('storage/images/'.$product->foto) }}" alt="Product Hover" class="img-fluid"> -->
              </a>
          </div>
          <div class="product-info">
              <h5 class="product-title"><a href="{{ route('produk.variant', $product->idProduk) }}">{{ $product->nama }}</a>
              </h5>
              <div class="product-price">
                  <span class="">{{ Str::limit($product->detail, 25) }}</span>
              </div>
              <div class="product-price">
                  <a href="/produk/detail/{{ $product->idProduk }}" class="current-price btn-modal"
                      data-id="{{ $product->idProduk }}" data-bs-toggle="modal" data-bs-target="#exampleModal">Detail produk
                      </a>
              </div>
          </div>
      </div>
  </div><!-- End Product Item -->
  @endforeach
