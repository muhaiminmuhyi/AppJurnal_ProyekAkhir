<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Data Kandang</h1>
      </div>

      <?php
        if(isset($validation)){
          echo $validation->listErrors();
        }

        //dapatkan data dari koskosan dan simpan ke variabel lokal
        foreach($kandang as $row):
          $id_kandang = $row->id_kandang;
          $nama_kandang = $row->nama_kandang;
          $jenis_kandang = $row->jenis_kandang;
        endforeach;
      ?>
        <div class="row">
        <?= form_open('kandang/editkandangproses') ?>
            
            <div class="mb-3">
            <input type="hidden" id="id_kandang" name="id_kandang" readonly value="<?= $id_kandang?>">
                    <label for="id_kandang" class="form-label">ID Kandang</label>
                    <?php
                        //jika set value namakosan tidak kosong maka isi $kode diganti dengan isian dari user
                        if(strlen(set_value('id_kandang'))>0){
                          $nama = set_value('id_kandang');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="id_kandang" name="id_kandang" readonly value="<?= $id_kandang?>">
                </div>      
                <div class="mb-3">
                    <label for="nama_kandang" class="form-label">Nama Kandang</label>
                    <?php
                        //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                        if(strlen(set_value('nama_kandang'))>0){
                          $nama = set_value('nama_kandang');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="nama_kandang" name="nama_kandang" value="<?= $nama_kandang?>">
                </div>  
                <div class="mb-3">
                    <label for="jenis_kandang" class="form-label">Jenis Kandang</label>
                    <?php
                        //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                        if(strlen(set_value('jenis_kandang'))>0){
                          $nama = set_value('jenis_kandang');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="jenis_kandang" name="jenis_kandang" value="<?= $jenis_kandang?>">
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
