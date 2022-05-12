<div class="container-fluid">
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
 </div>
