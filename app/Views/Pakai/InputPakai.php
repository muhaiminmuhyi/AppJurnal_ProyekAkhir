<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Pemakaian Pakan Ayam</h1>
      </div>

      <?php
        if(isset($validation)){
          echo $validation->listErrors();
        }
      ?>
        <div class="row">
        <?= form_open('pakai') ?>
                <div class="mb-3">
                    <label for="ktp" class="form-label">Nomor Pakai</label>
                    <input type="text" class="form-control" id="no_pakai" name="no_pakai" value="<?= set_value('no_pakai')?>">
                </div>
                <div class="mb-3">
                    <label for="ktp" class="form-label">Nama Kandang</label>
                    <input type="text" class="form-control" id="nama_kandang" name="nama_kandang" value="<?= set_value('nama_kandang')?>">
                </div>
                <div class="mb-3">
                    <label for="ktp" class="form-label">Nama Ayam</label>
                    <input type="text" class="form-control" id="nama_ayam" name="nama_ayam" value="<?= set_value('nama_ayam')?>">
                </div>
                <div class="mb-3">
                    <label for="ktp" class="form-label">Nama Pakan</label>
                    <input type="text" class="form-control" id="nama_pakan" name="nama_pakan" value="<?= set_value('nama_pakan')?>">
                </div>
                <div class="mb-3">
                    <label for="ktp" class="form-label">Jumlah</label>
                    <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= set_value('jumlah')?>">
                </div>
                <button type="submit" class="btn btn-warning">Submit</button>
            </form>
        </div>  
    </main>
  </div>
</div>
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="<?= base_url('dashboard/dashboard.js') ?>"></script>


    <!-- Bootstrap JS -->
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="<?= base_url('dashboard/dashboard.js') ?>"></script>
  </body>
</html>
