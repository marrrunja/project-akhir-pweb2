{{-- Sidebar --}}
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="">
            <!-- link nya di isi route yang mana -->
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item - tambah produk -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.tambah') }}">
            <i class="fas fa-fw fa-plus"></i>
            <span>Tambah Produk</span>
        </a>
    </li>


    <!-- Nav Item - lihat produk -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.manage') }}">
            <i class="fas fa-box-open fa-sm me-2"></i>
            <span>Lihat Produk</span>
        </a>
    </li>

    <!-- Nav Item - Lihat Laporan penjualan -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.order') }}">
            <i class="fas fa-chart-line fa-sm me-2"></i>
            <span>Lihat Laporan Penjualan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Sidebar Toggler (Sidebar) -->
    <!-- Sidebar Toggler (Centered Vertically) -->
    <div class="d-flex justify-content-center">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../templatesbadmin2/js/sb-admin-2.min.js"></script>

</ul>