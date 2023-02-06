<!-- <div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-warning sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span data-feather="database"></span>
            Master Data
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?= base_url('coa/listcoa') ?>">Chart of Account</a></li>
            <li><a class="dropdown-item" href="<?= base_url('ayam/listayam') ?>">Ayam</a></li>
            <li><a class="dropdown-item" href="<?= base_url('pakan/listpakan') ?>">Pakan</a></li>
            <li><a class="dropdown-item" href="<?= base_url('kandang/listkandang') ?>">Kandang Ayam</a></li>
            <li><a class="dropdown-item" href="<?= base_url('pelanggan/listpelanggan') ?>">Pelanggan</a></li>
            <li><a class="dropdown-item" href="<?= base_url('pemasok/listpemasok') ?>">Pemasok</a></li>
            </ul>
          </li>  
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span data-feather="shopping-cart"></span>
            Transaksi
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?= base_url('penjualan/ListJual') ?>">Penjualan</a></li>
            <li><a class="dropdown-item" href="<?= base_url('pembelian/ListBeli') ?>">Pembelian</a></li>
            <li><a class="dropdown-item" href="<?= base_url('pembebanan/ListBeban') ?>">Pembebanan</a></li>
            </ul>
          </li>  
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span data-feather="clipboard"></span>
            Laporan
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?= base_url('penjualan/laporanpnj') ?>">Penjualan</a></li>
            <li><a class="dropdown-item" href="<?= base_url('pembelian/laporanpmb') ?>">Pembelian</a></li>
            <li><a class="dropdown-item" href="<?= base_url('pembebanan/laporanbeban') ?>">Pembebanan</a></li>
            <li><a class="dropdown-item" href="<?= base_url('laporan/jurnalumum') ?>">Jurnal Umum</a></li>
            <li><a class="dropdown-item" href="<?= base_url('laporan/bukubesar') ?>">Buku Besar</a></li>
            <li><a class="dropdown-item" href="<?= base_url('laporan/labarugi') ?>">Laba Rugi</a></li>
        </li>
            </ul>
         </li>
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span data-feather="archive"></span>
            Pemakaian Pakan Ayam
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?= base_url('pakai/listpakai') ?>">Pakai</a></li>
            </ul>
         </li>
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span data-feather="bar-chart-2"></span>
            Grafik
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            </ul>
         </li>      
        </ul>
       </div>
     </nav>
   </div>
 </div> -->

 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <center>
      <span class="brand-text font-weight-light">KuyBerkebun</span>
      </center>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('adminlte/dist/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= strtoupper($_SESSION['nama']) ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?= base_url('dashboard/index') ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-server"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('coa/listcoa') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Chart Of Account</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('ayam/listayam') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ayam</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('pakan/listpakan') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pakan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('kandang/listkandang') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kandang Ayam</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('pelanggan/listpelanggan') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pelanggan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('pemasok/listpemasok') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pemasok</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-credit-card"></i>
              <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('penjualan/ListJual') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('pembelian/ListBeli') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pembelian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('pembebanan/ListBeban') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pembebanan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-archive"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('penjualan/laporanpnj') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('pembelian/laporanpmb') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pembelian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('pembebanan/laporanbeban') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pembebanan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('laporan/jurnalumum') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jurnal Umum</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('laporan/bukubesar') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buku Besar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('laporan/labarugi') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laba Rugi</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('pakai/listpakai') ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Pemakaian Pakan Ayam
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper">
