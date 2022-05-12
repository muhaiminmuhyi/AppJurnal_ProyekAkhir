<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Data Pemasok</h1>
      </div>

      <?php
        if(isset($validation)){
          echo $validation->listErrors();
        }
      ?>
        <div class="row">
        <?= form_open('pemasok') ?>
                <div class="mb-3">
                    <label for="ktp" class="form-label">ID Pemasok</label>
                    <input type="text" class="form-control" id="id_pemasok" name="id_pemasok" value="<?= set_value('id_pemasok')?>" placeholder="Diisi dengan ID Pemasok">
                </div>
                <div class="mb-3">
                    <label for="ktp" class="form-label">Nama Pemasok</label>
                    <input type="text" class="form-control" id="nm_pemasok" name="nm_pemasok" value="<?= set_value('nm_pemasok')?>" placeholder="Diisi dengan Nama Pemasok">
                </div>
                <div class="mb-3">
                    <label for="ktp" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= set_value('alamat')?>" placeholder="Diisi dengan Alamat">
                </div>
                <div class="mb-3">
                    <label for="ktp" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= set_value('no_telp')?>" placeholder="Diisi dengan Nomor Telepon" >
                </div>
                <div class="mb-3">
                    <label for="ktp" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?= set_value('email')?>" placeholder="Diisi dengan Email" >
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
