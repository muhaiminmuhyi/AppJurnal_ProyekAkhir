<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Data Ayam</h1>
      </div>

      <?php
        if(isset($validation)){
          echo $validation->listErrors();
        }

        //dapatkan data dari koskosan dan simpan ke variabel lokal
        foreach($ayam as $row):
          $id_ayam = $row->id_ayam;
          $nama_ayam = $row->nama_ayam;
          $jenis_ayam = $row->jenis_ayam;
          $usia_ayam = $row->usia_ayam;

        endforeach;
      ?>
        <div class="row">
        <?= form_open('ayam/editayamproses') ?>
            
            <div class="mb-3">
            <input type="hidden" id="id_ayam" name="id_ayam" readonly value="<?= $id_ayam?>">
                    <label for="id_ayam" class="form-label">ID Ayam</label>
                    <?php
                        //jika set value namakosan tidak kosong maka isi $kode diganti dengan isian dari user
                        if(strlen(set_value('id_ayam'))>0){
                          $nama = set_value('id_ayam');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="id_ayam" name="id_ayam" readonly value="<?= $id_ayam?>">
                </div>      
                <div class="mb-3">
                    <label for="nama_ayam" class="form-label">Nama Ayam</label>
                    <?php
                        //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                        if(strlen(set_value('nama_ayam'))>0){
                          $nama = set_value('nama_ayam');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="nama_ayam" name="nama_ayam" value="<?= $nama_ayam?>">
                </div>  
                <div class="mb-3">
                    <label for="jenis_ayam" class="form-label">Jenis Ayam</label>
                    <?php
                        //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                        if(strlen(set_value('jenis_ayam'))>0){
                          $nama = set_value('jenis_ayam');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="jenis_ayam" name="jenis_ayam" value="<?= $jenis_ayam?>">
                </div>
                <div class="mb-3">
                    <label for="usia_ayam" class="form-label">Usia Ayam</label>
                    <?php
                        //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                        if(strlen(set_value('usia_ayam'))>0){
                          $nama = set_value('usia_ayam');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="usia_ayam" name="usia_ayam" value="<?= $usia_ayam?>">
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
