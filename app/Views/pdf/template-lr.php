<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Laba Rugi</title>
</head>
<body>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Laba Rugi</h1>
      </div>

      <canvas class="my-4 w-100" id="myChart" width="900" height="380" hidden></canvas>

      <div class="row">
                        
                        <div class="text-center"><b>Laporan Laba Rugi</b></div>
                        <div class="text-center"><b>Mitra Unggas Sonofera Farm</b></div>
                        <div class="text-center">Periode <b><?=$bulan;?> <?=$tahun;?></b></div>
      </div> 
      <p>

      <div class="table-responsive">
        <table class="table table-bordered" border="1">
          <thead>
            <tr> 
              <th colspan="7">Pendapatan</th>
            </tr>
          </thead>
          <tbody>  
            <?php
                $total = 0;
            ?>
            <tr> 
              <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;Penjualan</td>
              <td></td>
              <td style='text-align:right'><?=rupiah($penjualan);?></td> <?php $total = $total + $penjualan; ?>
              <td></td>
            </tr>   
            <tr>
              <td colspan="7"><br></td>
            </tr>
            <tr> 
              <th colspan="7">Beban</th>
            </tr>
            <?php
              //looping untuk beban
              foreach($pembebanan as $row):
                //jika panjang = 2 maka beri tab 1 x
                if(strlen($row->kode_coa)){
                        //kode 51
                        $i=0;
                  ?>
                    <tr> 
                        <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;<?=$row->nama_coa?></td>
                        <td></td>
                        <td style='text-align:right'>(<?=rupiah($row->total);?>)</td> <?php $total = $total - $row->total; ?>
                        <td></td>
                    </tr>
                  <?php
                        //cari kodenya yang memenuhi kriteria kepala atasnya 51 cth 511
                        foreach($pembebanan as $row):{
                                $i++;
                            }
                        endforeach; 
                }
              endforeach;
            ?>
            <tr>
              <td colspan="7"><br></td>
            </tr>
            <tr>
              <th colspan="4">Laba Bersih</th>
              <th></th>
              <th></th>
              <th style='text-align:right'>
                <?=rupiah($total);?>
              </th>
            </tr>
          </tbody>
        </table>
      </div>

      <p>
           

    </main>
  </div>
</div>

<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="<?= base_url('dashboard/dashboard.js') ?>"></script>

</body>
</html>