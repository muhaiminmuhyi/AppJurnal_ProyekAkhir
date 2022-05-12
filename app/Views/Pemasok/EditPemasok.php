<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Data Pemasok</h1>
      </div>

      <?php
        if(isset($validation)){
          echo $validation->listErrors();
        }

        //dapatkan data dari koskosan dan simpan ke variabel lokal
        foreach($pemasok as $row):
          $id_pemasok = $row->id_pemasok;
          $nm_pemasok = $row->nm_pemasok;
          $alamat = $row->alamat;
          $no_telp = $row->no_telp;
          $email = $row->email;

        endforeach;
      ?>
        <div class="row">
        <?= form_open('pemasok/editpemasokproses') ?>
            
            <div class="mb-3">
            <input type="hidden" id="id_pemasok" name="id_pemasok" readonly value="<?= $id_pemasok?>">
                    <label for="id_pemasok" class="form-label">ID Pemasok</label>
                    <?php
                        //jika set value namakosan tidak kosong maka isi $kode diganti dengan isian dari user
                        if(strlen(set_value('id_pemasok'))>0){
                          $nama = set_value('id_pemasok');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="id_pemasok" name="id_pemasok" readonly value="<?= $id_pemasok?>">
                </div>      
                <div class="mb-3">
                    <label for="nm_pemasok" class="form-label">Nama Pemasok</label>
                    <?php
                        //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                        if(strlen(set_value('nm_pemasok'))>0){
                          $nama = set_value('nm_pemasok');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="nm_pemasok" name="nm_pemasok" value="<?= $nm_pemasok?>">
                </div>  
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <?php
                        //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                        if(strlen(set_value('alamat'))>0){
                          $nama = set_value('alamat');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $alamat?>">
                </div>
                <div class="mb-3">
                    <label for="no_telp" class="form-label">No Telepon</label>
                    <?php
                        //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                        if(strlen(set_value('no_telp'))>0){
                          $nama = set_value('no_telp');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= $no_telp?>">
                </div>  
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <?php
                        //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                        if(strlen(set_value('email'))>0){
                          $nama = set_value('email');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="email" name="email" value="<?= $email?>">
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
