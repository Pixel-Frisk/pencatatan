<div id="app">
    <div class="main-wrapper">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                </ul>
            </form>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <div class="d-sm-none d-lg-inline-block">Hi, Ujang Maman</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="main-sidebar">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="<?= base_url('/dashboard'); ?>">Stisla</a>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="<?= base_url('/dashboard'); ?>">St</a>
                </div>
                <ul class="sidebar-menu">
                    <li><a class="nav-link" href="<?= base_url('/dashboard'); ?>"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
                    <li><a class="nav-link" href="<?= base_url('/user'); ?>"><i class="far fa-user"></i><span>User</span></a></li>
                    <li><a class="nav-link" href="<?= base_url('/barang'); ?>"><i class="fas fa-th-large"></i><span>Barang</span></a></li>
                    <li><a class="nav-link" href="<?= base_url('/masuk'); ?>"><i class="fas fa-bicycle"></i><span>Barang Masuk</span></a></li>
                    <li><a class="nav-link" href="<?= base_url('/keluar'); ?>"><i class="fas fa-bicycle"></i><span>Peminjaman Barang</span></a></li>
                </ul>
            </aside>
        </div>