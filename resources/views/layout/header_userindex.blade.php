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
                <form class="search-form desktop-search-form" method="post"
                    action="{{ env('BASE_URL') }}/variant/search">
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
                    <button class="header-action-btn mobile-search-toggle d-xl-none" type="button"
                        data-bs-toggle="collapse" data-bs-target="#mobileSearch" aria-expanded="false"
                        aria-controls="mobileSearch">
                        <i class="bi bi-search"></i>
                    </button>

                    <!-- Account -->
                    <div class="dropdown account-dropdown">
                        <button class="header-action-btn" data-bs-toggle="dropdown">
                            <i class="bi bi-person"></i>
                            <span class="action-text d-none d-md-inline-block">Masuk</span>
                        </button>
                        <div class="dropdown-menu">
                            <div class="dropdown-header">
                                <h6>Selamat datang di <span class="sitename">AdilaSnack</span></h6>
                                <!-- <p class="mb-0">Access account &amp; manage orders</p> -->
                            </div>
                            <div class="dropdown-footer">
                                @if(!Session::has('user_id'))
                                <a href="/login/index" class="btn btn-primary w-100 mb-2">Login</a>
                                <a href="/register/index" class="btn btn-outline-primary w-100">Register</a>
                                @else
                                <form method="post" action="/login/logout">
                                    @csrf
                                    <button type="submit" class="btn btn-primary w-100">Logout</button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Wishlist -->
                    <!-- Cart -->
                    <div class="dropdown cart-dropdown">
                        <button class="header-action-btn" data-bs-toggle="dropdown">
                            <i class="bi bi-cart3"></i>
                            <span class="action-text d-none d-md-inline-block">Keranjang</span>
                            <!-- <span class="badge">3</span> -->
                        </button>
                        <div class="dropdown-menu cart-dropdown-menu">
                            <div class="dropdown-header">
                                <h6>Keranjang</h6>
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
                                <button class="hilangkan-item" data-id="{{ $item->id }}"
                                    data-user="{{ Session::get('user_id') }}" type="button">
                                    <i class="bi bi-trash"></i> Remove
                                </button>
                            </div>
                            @endforeach --}}
                        </div>
                    </div>
                    <div class="dropdown-footer">
                        <div class="cart-total">
                            <span>Total:</span>
                            <span class="cart-total-price">Rp.0</span>
                        </div>
                        <div class="cart-actions">
                            <a href="{{ url('/cart') }}" class="btn btn-outline-primary">Lihat Keranjang</a>
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
                    <li><a href="about.html">Produk</a></li>
                    <li><a href="category.html">Category</a></li>
                    <li><a href="checkout.html">History Pembelian</a></li>
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
