<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Data Chart of Account</h1>
      </div>

      <?php
        if(isset($validation)){
          echo $validation->listErrors();
        }
      ?>
        <div class="row">
        <?= form_open('coa') ?>
                <div class="mb-3">
                    <label for="ktp" class="form-label">Kode COA</label>
                    <input type="text" class="form-control" id="kode_coa" name="kode_coa" value="<?= set_value('kode_coa')?>" placeholder="Diisi dengan Kode COA">
                </div>
                <div class="mb-3">
                    <label for="ktp" class="form-label">Nama COA</label>
                    <input type="text" class="form-control" id="nama_coa" name="nama_coa" value="<?= set_value('nama_coa')?>" placeholder="Diisi dengan Nama COA">
                </div>
                <div class="mb-3">
                    <label for="ktp" class="form-label">Header Akun</label>
                    <input type="text" class="form-control" id="header_akun" name="header_akun" value="<?= set_value('header_akun')?>" placeholder="Diisi dengan Header Akun">
                </div>
                <div class="mb-3">
                    <label for="ktp" class="form-label">Posisi</label>
                    <input type="text" class="form-control" id="posisi" name="posisi" value="<?= set_value('posisi')?>" placeholder="Diisi dengan Posisi" >
                </div>
                <button type="submit" class="btn btn-warning">Submit</button>
            </form>
        </div>

     
    </main>
  </div>
</div>

    <!-- Bootstrap JS -->
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="<?= base_url('dashboard/dashboard.js') ?>"></script>
  </body>
</html>
