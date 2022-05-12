<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Data Pakan</h1>
      </div>

      <?php
        if(isset($validation)){
          echo $validation->listErrors();
        }

        //dapatkan data dari koskosan dan simpan ke variabel lokal
        foreach($pakan as $row):
          $id_pakan = $row->id_pakan;
          $nama_pakan = $row->nama_pakan;
          $harga_jual = $row->harga_jual;
          $harga_beli = $row->harga_beli;
          $jenis_pakan = $row->jenis_pakan;
          $satuan = $row->satuan;

        endforeach;
      ?>
        <div class="row">
        <?= form_open('pakan/editpakanproses') ?>
            
            <div class="mb-3">
            <input type="hidden" id="id_pakan" name="id_pakan" readonly value="<?= $id_pakan?>">
                    <label for="id_pakan" class="form-label">ID Pakan</label>
                    <?php
                        //jika set value namakosan tidak kosong maka isi $kode diganti dengan isian dari user
                        if(strlen(set_value('id_pakan'))>0){
                          $nama = set_value('id_pakan');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="id_pakan" name="id_pakan" readonly value="<?= $id_pakan?>">
                </div>      
                <div class="mb-3">
                    <label for="nama_pakan" class="form-label">Nama Pakan</label>
                    <?php
                        //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                        if(strlen(set_value('nama_pakan'))>0){
                          $nama = set_value('nama_pakan');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="nama_pakan" name="nama_pakan" value="<?= $nama_pakan?>">
                </div>  
                <div class="mb-3">
                    <label for="harga_jual" class="form-label">Harga Penjualan</label>
                    <?php
                        //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                        if(strlen(set_value('harga_jual'))>0){
                          $nama = set_value('harga_jual');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="harga_jual" name="harga_jual" value="<?= $harga_jual?>">
                </div>
                <div class="mb-3">
                    <label for="harga_beli" class="form-label">Harga Pembelian</label>
                    <?php
                        //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                        if(strlen(set_value('harga_beli'))>0){
                          $nama = set_value('harga_beli');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="harga_beli" name="harga_beli" value="<?= $harga_beli?>">
                </div>
                <div class="mb-3">
                    <label for="jenis_pakan" class="form-label">Jenis Pakan</label>
                    <?php
                        //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                        if(strlen(set_value('jenis_pakan'))>0){
                          $nama = set_value('jenis_pakan');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="jenis_pakan" name="jenis_pakan" value="<?= $jenis_pakan?>">
                </div>
                <div class="mb-3">
                    <label for="satuan" class="form-label">Satuan</label>
                    <?php
                        //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                        if(strlen(set_value('satuan'))>0){
                          $nama = set_value('satuan');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="satuan" name="satuan" value="<?= $satuan?>">
                </div> 
                <button type="submit" class="btn btn-warning">Submit</button>    
    </main>
  </div>
</div>

    <!-- Bootstrap JS -->
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="<?= base_url('dashboard/dashboard.js') ?>"></script>
  </body>
</html>
