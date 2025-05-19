<style>
    .brown{
        color:#A23C33;
    }
    .btn-outline-success{
        border-color: #A23C33;
        color: #A23C33;
    }
    .btn-outline-success:hover{
        border-color: #A23C33;
        background-color: #A23C33;
        color: #fff;
    }
    .btn-success{
        border-color: #A23C33;
        background-color: #A23C33;
        color: #fff;
    }
    .btn-success:hover{
        border-color: #A23C33;
        background-color: #fff;
        color: #A23C33;
    }
</style>

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand brown fw-bold" href="#">OlehAe</a>
        
        <!-- Toggle button for mobile view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar items -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link btn btn-category" href="#">Beranda</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link btn btn-category active" href="#">Produk</a>
                </li>
            </ul>

            <!-- Search bar -->
            <form class="d-flex me-2" role="search">
                <input class="form-control me-2" type="search" placeholder="Cari produk..." aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

            <!-- Icon keranjang -->
            <a href="#" class="btn btn-outline-success me-5">
                <i class="bi bi-cart"></i>
            </a>

            <!-- Masuk dan Daftar -->
            <a href="#" class="btn btn-outline-success me-2">Masuk</a>
            <a href="#" class="btn btn-success">Daftar</a>
        </div>
    </div>
</nav>
