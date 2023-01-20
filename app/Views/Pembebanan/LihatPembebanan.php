<main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div>

      <canvas class="my-4 w-100" id="myChart" width="900" height="380" hidden></canvas>

      <div class="card-body">
                        <div class="text-center"><b>Laporan Pembebanan</b></div>
                        <div class="text-center"><b>Mitra Unggas Sonofera Farm</b></div>
                        <div class="text-center"><b>Tahun <?=$tahun;?></b></div>
                        <div class="text-center"><b>Bulan <?= $bulan;?></b></div>
      </div>

      <div class="row">
              <div class="col">
              </div>
            </div> 
      <p>

      <form action="<?= base_url('Export/laporanbeban') ?>" method="post">
      <input type="hidden" name="bulan" value="<?= $bulan; ?>">
      <input type="hidden" name="tahun" value="<?= $tahun; ?>">
      <button type="submit" class="btn btn-success">Export Excel</button>
      <br><br>
      </form>
      <form action="<?= base_url('Export/pdfbeban') ?>" method="post">
        <input type="hidden" name="bulan" value="<?= $bulan; ?>">
        <input type="hidden" name="tahun" value="<?= $tahun; ?>">
        <button type="submit" class="btn btn-danger">Export PDF</button>
        <br><br>
      </form>

      <div class="table-responsive">
        <table class="table table-bordered" table-sm>
          <thead>
            <tr class="table-info"> 
              <th>#IdBeban</th>
              <th>Keterangan</th>
              <th>Tanggal</th>
              <th>Biaya</th>
            </tr>
          </thead>
          <tbody>
            
                <?php
                $jumlah=0;
                    foreach($pembebanan as $row):
                        ?>
                            <tr>
                                <td><?= $row->id_transaksi?></td>
                                <td><?= $row->nama?></td>
                                <td><?= substr($row->waktu,0,10)?></td>
                                <td><?= rupiah($row->biaya)?></td>
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


    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="<?= base_url('dashboard/dashboard.js') ?>"></script>
  </body>
</html>
