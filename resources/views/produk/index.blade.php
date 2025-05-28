<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Blog - FashionStore Bootstrap Template</title>

    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="/assets/img/favicon.png" rel="icon">
    <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/assets/vendor/drift-zoom/drift-basic.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="/assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: FashionStore
  * Template URL: https://bootstrapmade.com/fashion-store-bootstrap-template/
  * Updated: Apr 26 2025 with Bootstrap v5.3.5
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="blog-page">
    <header id="header" class="header position-relative">
        <!-- Top Bar -->
        <div class="top-bar py-2 d-none d-lg-block">
            <div class="container-fluid container-xl">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="d-flex align-items-center">
                            <div class="top-bar-item me-4">
                                <i class="bi bi-telephone-fill me-2"></i>
                                <span>Customer Support: </span>
                                <a href="tel:+1234567890">+1 (234) 567-890</a>
                            </div>
                            <div class="top-bar-item">
                                <i class="bi bi-envelope-fill me-2"></i>
                                <a href="mailto:support@example.com">support@example.com</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex justify-content-end">
                            <div class="top-bar-item me-4">
                                <a href="track-order.html">
                                    <i class="bi bi-truck me-2"></i>Track Order
                                </a>
                            </div>
                            <div class="top-bar-item dropdown me-4">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="bi bi-translate me-2"></i>English
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i
                                                class="bi bi-check2 me-2 selected-icon"></i>English</a></li>
                                    <li><a class="dropdown-item" href="#">Español</a></li>
                                    <li><a class="dropdown-item" href="#">Français</a></li>
                                    <li><a class="dropdown-item" href="#">Deutsch</a></li>
                                </ul>
                            </div>
                            <div class="top-bar-item dropdown">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="bi bi-currency-dollar me-2"></i>USD
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i
                                                class="bi bi-check2 me-2 selected-icon"></i>USD</a></li>
                                    <li><a class="dropdown-item" href="#">EUR</a></li>
                                    <li><a class="dropdown-item" href="#">GBP</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Header -->
        <div class="main-header">
            <div class="container-fluid container-xl">
                <div class="d-flex py-3 align-items-center justify-content-between">

                    <!-- Logo -->
                    <a href="index.html" class="logo d-flex align-items-center">
                        <!-- Uncomment the line below if you also wish to use an image logo -->
                        <!-- <img src="/assets/img/logo.webp" alt=""> -->
                        <h1 class="sitename">Adila<span>Snack</span></h1>
                    </a>

                    <!-- Search -->
                    <form class="search-form desktop-search-form">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for products...">
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
                                    <a href="login.html" class="btn btn-primary w-100 mb-2">Sign In</a>
                                    <a href="register.html" class="btn btn-outline-primary w-100">Register</a>
                                </div>
                            </div>
                        </div>

                        <!-- Wishlist -->
                        <a href="wishlist.html" class="header-action-btn d-none d-md-flex">
                            <i class="bi bi-heart"></i>
                            <span class="action-text d-none d-md-inline-block">Wishlist</span>
                            <span class="badge">0</span>
                        </a>

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
                                        <div class="cart-item">
                                            <div class="cart-item-image">
                                                <img src="/assets/img/product/product-1.webp" alt="Product"
                                                    class="img-fluid">
                                            </div>
                                            <div class="cart-item-content">
                                                <h6 class="cart-item-title">Wireless Headphones</h6>
                                                <div class="cart-item-meta"> 1 × $89.99</div>
                                            </div>
                                            <button class="cart-item-remove">
                                                <i class="bi bi-x"></i>
                                            </button>
