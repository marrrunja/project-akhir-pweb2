<header id="header" class="header position-relative">
    <!-- Main Header -->
    <div class="main-header">
      <div class="container-fluid container-xl">
        <div class="d-flex py-3 align-items-center justify-content-between">
          <!-- Logo -->
          <a href="" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.webp" alt=""> -->
            <h1 class="sitename">Adila<span>Snack</span></h1>
          </a>
          <!-- Search -->
          <form class="search-form desktop-search-form" method="post" action="{{ env('BASE_URL') }}/variant/search">
            @csrf
            <div class="input-group">
              <input type="text" name="keyword" class="form-control" placeholder="Search for products...">
              <button class="btn search-btn" type="submit">
                <i class="bi bi-search"></i>
              </button>
            </div>
          </form>
          <!-- Actions -->
          <div class="header-actions d-flex align-items-center justify-content-end">

            <!-- Mobile Search Toggle -->
            <button class="header-action-btn mobile-search-toggle d-xl-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobileSearch" aria-expanded="false" aria-controls="mobileSearch">
              <i class="bi bi-search"></i>
            </button>

            <!-- Account -->
            <div class="dropdown account-dropdown">
              <button class="header-action-btn" data-bs-toggle="dropdown">
                <i class="bi bi-person"></i>
                <span class="action-text d-none d-md-inline-block">Account</span>
              </button>
              <div class="dropdown-menu">
                <div class="dropdown-header">
                  <h6>Welcome to <span class="sitename">FashionStore</span></h6>
                  <p class="mb-0">Access account &amp; manage orders</p>
                </div>
                <div class="dropdown-body">
                  <a class="dropdown-item d-flex align-items-center" href="account.html">
                    <i class="bi bi-person-circle me-2"></i>
                    <span>My Profile</span>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="orders.html">
                    <i class="bi bi-bag-check me-2"></i>
                    <span>My Orders</span>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="wishlist.html">
                    <i class="bi bi-heart me-2"></i>
                    <span>My Wishlist</span>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="returns.html">
                    <i class="bi bi-arrow-return-left me-2"></i>
                    <span>Returns &amp; Refunds</span>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="settings.html">
                    <i class="bi bi-gear me-2"></i>
                    <span>Settings</span>
                  </a>
                </div>
                <div class="dropdown-footer">
                  <a href="/login/index" class="btn btn-primary w-100 mb-2">Sign In</a>
                  <a href="/register/index" class="btn btn-outline-primary w-100">Register</a>
                </div>
              </div>
            </div>

            <!-- Wishlist -->
            <!-- Cart -->
            <div class="dropdown cart-dropdown">
              <button class="header-action-btn" data-bs-toggle="dropdown">
                <i class="bi bi-cart3"></i>
                <span class="action-text d-none d-md-inline-block">Cart</span>
                <span class="badge">3</span>
              </button>
              <div class="dropdown-menu cart-dropdown-menu">
                <div class="dropdown-header">
                  <h6>Shopping Cart (3)</h6>
                </div>
                <div class="dropdown-body">
                  <div class="cart-items">
                    <!-- Cart Item 1 -->
                     {{-- @foreach($carts as $item)
                    <div class="cart-item">
                      <div class="cart-item-image">
                        <img src="assets/img/product/product-1.webp" alt="Product" class="img-fluid">
                      </div>
                      <div class="cart-item-content">
                        <h6 class="cart-item-title">{{ $item->variant->produk->nama}}</h6>
                        <div class="product-meta">
                          <span class="product-color">{{ $item->variant->variant ?? 'Variant' }}</span>
                        </div>
                        <div class="cart-item-meta">
                          <span class="current-price">
                           {{ $item->qty }}
                        </span> ×
                        <span class="item-total">
                          Rp{{ number_format(($item->variant->harga ?? 0) * $item->qty) }}
                        </span> 
                      </div>
                      </div>
                      <button class="hilangkan-item" data-id="{{ $item->id }}" data-user="{{ Session::get('user_id') }}" type="button">
                          <i class="bi bi-trash"></i> Remove
                      </button>
                    </div>
                    @endforeach --}}
                  </div>
                </div>
                <div class="dropdown-footer">
                  <div class="cart-total">
                    <span>Total:</span>
                    <span class="cart-total-price">$279.97</span>
                  </div>
                  <div class="cart-actions">
                    <a href="{{ url('/cart') }}" class="btn btn-outline-primary">View Cart</a>
                    <a href="checkout.html" class="btn btn-primary">Checkout</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- Mobile Navigation Toggle -->
            <i class="mobile-nav-toggle d-xl-none bi bi-list me-0"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Navigation -->
    <div class="header-nav">
      <div class="container-fluid container-xl position-relative">
        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="/produk/index" class="{{ request()->is('produk/index') ? 'active':'' }}">Home</a></li>
            <li><a href="about.html" >About</a></li>
            <li><a href="category.html">Category</a></li>
            <li><a href="product-details.html">Product Details</a></li>
            <li><a href="/cart" class="{{ request()->is('cart') ? 'active':'' }}">Cart</a></li>
            <li><a href="checkout.html">Checkout</a></li>
          </ul>
        </nav>
      </div>
    </div>

    <!-- Announcement Bar -->
    <div class="announcement-bar py-2">
      <div class="container-fluid container-xl">
        <div class="announcement-slider swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": 1,
              "effect": "slide",
              "direction": "vertical"
            }
          </script>
          <div class="swiper-wrapper">
            <div class="swiper-slide">🚚 Free shipping on orders over $50</div>
            <div class="swiper-slide">💰 30 days money back guarantee</div>
            <div class="swiper-slide">🎁 20% off on your first order - Use code: FIRST20</div>
            <div class="swiper-slide">⚡ Flash Sale! Up to 70% off on selected items</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Mobile Search Form -->
    <div class="collapse" id="mobileSearch">
      <div class="container">
        <form class="search-form" method="post" action="{{ env('BASE_URL') }}/variant/search">
          @csrf
          <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="Search for products...">
            <button class="btn search-btn" type="submit">
              <i class="bi bi-search"></i>
            </button>
          </div>
        </form>
      </div>
    </div>
  </header>