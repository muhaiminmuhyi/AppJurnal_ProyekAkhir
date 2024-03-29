<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penjualan</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../../../public/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../public/adminlte/dist/css/adminlte.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>
<body>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div>

      <canvas class="my-4 w-100" id="myChart" width="900" height="380" hidden></canvas>

      <div class="card-body">
                        <div class="text-center"><b>Laporan Penjualan</b></div>
                        <div class="text-center"><b>Mitra Unggas Sonofera Farm</b></div>
                        <div class="text-center"><b>Tahun <?=$tahun;?></b></div>
                        <div class="text-center"><b>Bulan <?= $bulan;?></b></div>
      </div>

      <div class="row">
              <div class="col">
              </div>
            </div> 
      <p>
      <div class="table-responsive">
        <table class="table table-bordered" table-sm border="1">
          <thead>
            <tr class="table-info"> 
              <th>ID Penjualan</th>
              <th>Tanggal</th>
              <th>Pelanggan</th>
              <th>Total Transaksi</th>
            </tr>
          </thead>
          <tbody>
            
                <?php
                $jumlah=0;
                    foreach($penjualan as $row):
                        ?>
                            <tr>
                                <td><?= $row->id_transaksi;?></td>
                                <td><?= $row->tanggal;?></td>
                                <td><?= $row->nm_pelanggan;?></td>
                                <td><?= rupiah($row->total);?></td>
                            </tr>
                        <?php
                    endforeach;    
                ?>
          </tbody>
          
        </table>
      </div>
    </main>
  </div>
</div>
<!-- jQuery -->
<script src="../../../public/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<!-- Bootstrap -->
<script src="../../../public/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="../../../public/adminlte/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="../../../public/adminlte/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../../public/adminlte/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../../public/adminlte/dist/js/pages/dashboard3.js"></script>

<script src="../../../public/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="<?= base_url('dashboard/dashboard.js') ?>"></script>

</body>
</html>