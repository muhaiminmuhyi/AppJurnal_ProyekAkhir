<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Chart of Account</h1>
      </div>

      <?php
        if(isset($validation)){
          echo $validation->listErrors();
        }

        //dapatkan data dari koskosan dan simpan ke variabel lokal
        foreach($coa as $row):
          $kode_coa = $row->kode_coa;
          $nama_coa = $row->nama_coa;
          $header_akun = $row->header_akun;
        endforeach;
      ?>
        <div class="row">
        <?= form_open('coa/editcoaproses') ?>
            
            <div class="mb-3">
            <input type="hidden" id="kode_coa" name="kode_coa" value="<?= $kode_coa?>">
                    <label for="kode_coa" class="form-label">Kode Coa</label>
                    <?php
                        //jika set value namakosan tidak kosong maka isi $kode diganti dengan isian dari user
                        if(strlen(set_value('kode_coa'))>0){
                          $nama = set_value('kode_coa');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="kode_coa" name="kode_coa" value="<?= $kode_coa?>" placeholder="Diisi dengan Kode coa">
                </div>      
                <div class="mb-3">
                    <label for="nama_coa" class="form-label">Nama Coa</label>
                    <?php
                        //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                        if(strlen(set_value('nama_coa'))>0){
                          $nama = set_value('nama_coa');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="nama_coa" name="nama_coa" value="<?= $nama_coa?>" placeholder="Diisi dengan Nama coa">
                </div>  
                <div class="mb-3">
                    <label for="header_akun" class="form-label">Header Akun</label>
                    <?php
                        //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                        if(strlen(set_value('header_akun'))>0){
                          $nama = set_value('header_akun');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="header_akun" name="header_akun" value="<?= $header_akun?>" placeholder="Diisi dengan Header akun">
                </div>  
                <button type="submit" class="btn btn-info">Update</button>    
    </main>
  </div>
</div>

    <!-- Bootstrap JS -->
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="<?= base_url('dashboard/dashboard.js') ?>"></script>
  </body>
</html>
