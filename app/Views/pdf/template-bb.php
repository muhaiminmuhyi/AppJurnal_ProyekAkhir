<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Buku Besar</title>
</head>
<body>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Buku Besar</h1>
  </div>

  <canvas class="my-4 w-100" id="myChart" width="900" height="380" hidden></canvas>

  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <div class="text-center"><b>Buku Besar <?= $namaakun; ?></b></div>
          <div class="text-center"><b>Mitra Unggas Sonofera Farm</b></div>
          <div class="text-center">Periode <b><?= $bulan; ?> <?= $tahun; ?></b></div>
        </div>
      </div>
    </div>
  </div>
  <p>
  <div class="table-responsive">
    <table class="table table-bordered" table-sm" border="1">
      <thead>
        <tr class="table-primary">
          <th colspan="3"><?= $namaakun ?></th>
          <th colspan="4" style="text-align:right"><?= $kodeakun ?></th>
        </tr>
        <tr class="table-primary">
          <th rowspan="2">Tanggal</th>
          <th rowspan="2">Keterangan</th>
          <th rowspan="2" style="text-align:center">Ref</th>
          <th rowspan="2" style="text-align:center">Debet</th>
          <th rowspan="2" style="text-align:center">Kredit</th>
          <th colspan="2" style="text-align:center">Saldo</th>
        </tr>
        <tr class="table-primary">
          <th style="text-align:center">Debet</th>
          <th style="text-align:center">Kredit</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php
          $waktu = $tahun . "-" . $bulan . "-01"; //tgl 1 di awal bulan untuk saldo awal
          $db = 0;
          $kr = 0;
          ?>
          <td><?= $waktu ?></td>
          <td style='background-color: #eee'>Saldo Awal</td>
          <td style="text-align:right">-</td>
          <?php
          if (strcmp($posisisaldonormal, 'd') == 0) {
            echo "<td style='text-align:right'>-</td>";
            echo "<td style='text-align:right'>-</td>";
            echo "<td style='text-align:right;background-color: #eee'>" . rupiah($saldoawal) . "</td>";
            echo "<td style='text-align:right'>-</td>";
            $saldo_debet = $saldoawal;
            $saldo_kredit = 0;
          } else {
            echo "<td style='text-align:right'>-</td>";
            echo "<td style='text-align:right'>-</td>";
            echo "<td style='text-align:right'>-</td>";
            echo "<td style='text-align:right;background-color: #eee'>" . rupiah($saldoawal) . "</td>";
            $saldo_debet = 0;
            $saldo_kredit = $saldoawal;
          }
          ?>
        </tr>
        <?php
        //saldoawal
        foreach ($bukubesar as $row) :
        ?>
          <tr>
            <td><?= $row->tgl_jurnal ?></td>
            <td><?= $row->nama_coa ?></td>
            <td style="text-align:right"><?= $row->id_transaksi ?></td>
            <?php
            if ($row->posisi_d_c == 'd') {
              $db = $db + $row->nominal;
            ?>
              <td style="text-align:right"><?= rupiah($row->nominal) ?></td>
              <td style="text-align:right">-</td>
              <?php
              //jika posisi saldo normal ada di debet, maka di tambah dan ditampilkan ke posisi debet
              if ($posisisaldonormal == 'd') {
                $saldo_debet = $saldo_debet  - $row->nominal;
                echo "<td style='text-align:right'>" . rupiah($saldo_kredit) . "</td>";
                echo "<td style='text-align:right'>" . rupiah($saldo_debet) . "</td>";
              } else {
                $saldo_kredit = $saldo_kredit  + $row->nominal;
                echo "<td style='text-align:right'>" . rupiah($saldo_debet) . "</td>";
                echo "<td style='text-align:right'>" . rupiah($saldo_kredit) . "</td>";
              }
            } else {
              $kr = $kr + $row->nominal;
              ?>
              <td style="text-align:right">-</td>
              <td style="text-align:right"><?= rupiah($row->nominal) ?></td>
            <?php
              if ($posisisaldonormal == 'd') {
                $saldo_debet = $saldo_debet  - $row->nominal;
                echo "<td style='text-align:right'>" . rupiah($saldo_debet) . "</td>";
                echo "<td style='text-align:right'>" . rupiah($saldo_kredit) . "</td>";
              } else {
                $saldo_kredit = $saldo_kredit  + $row->nominal;
                echo "<td style='text-align:right'>" . rupiah($saldo_kredit) . "</td>";
                echo "<td style='text-align:right'>" . rupiah($saldo_debet) . "</td>";
              }
            }
            ?>
          </tr>
        <?php
        endforeach;
        ?>
        <tr>
          <td colspan="3" style='background-color: #eee'><b>Total</b></td>
          <td style='text-align:right;background-color: #eee'><b><?= rupiah($db) ?></b></td>
          <td style='text-align:right;background-color: #eee'><b><?= rupiah($kr) ?></b></td>
          <td style='text-align:right;background-color: #eee'><b><?= rupiah($saldo_debet) ?></b></td>
          <td style='text-align:right;background-color: #eee'><b><?= rupiah($saldo_kredit) ?></b></td>

        </tr>
      </tbody>
    </table>
  </div>

  <p>


</main>
</div>
</div>


<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
<script src="<?= base_url('dashboard/dashboard.js') ?>"></script>
</body>
</html>