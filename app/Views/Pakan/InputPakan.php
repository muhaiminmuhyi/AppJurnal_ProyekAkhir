<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Data Pakan</h1>
      </div>

      <?php
        if(isset($validation)){
          echo $validation->listErrors();
        }
      ?>
        <div class="row">
        <?= form_open('pakan') ?>
                <div class="mb-3">
                    <label for="ktp" class="form-label">ID Pakan</label>
                    <input type="text" class="form-control" id="id_pakan" name="id_pakan" value="<?= set_value('id_pakan')?>" placeholder="Diisi dengan ID Pakan">
                </div>
                <div class="mb-3">
                    <label for="ktp" class="form-label">Nama Pakan</label>
                    <input type="text" class="form-control" id="nama_pakan" name="nama_pakan" value="<?= set_value('nama_pakan')?>" placeholder="Diisi dengan Nama Pakan">
                </div>
                <div class="mb-3">
                    <label for="harga_jual">Harga Penjualan</label>
                    <input type="text" class="form-control" id="harga_jual" name="harga_jual" value="<?= set_value('harga_jual')?>" placeholder="Diisi dengan Harga Penjualan">
                </div>
                <div class="mb-3">
                    <label for="harga_beli">Harga Pembelian</label>
                    <input type="text" class="form-control" id="harga_beli" name="harga_beli" value="<?= set_value('harga_beli')?>" placeholder="Diisi dengan Harga Pembelian">
                </div>
                <div class="mb-3">
                    <label for="ktp" class="form-label">Jenis Pakan</label>
                    <input type="text" class="form-control" id="jenis_pakan" name="jenis_pakan" value="<?= set_value('jenis_pakan')?>" placeholder="Diisi dengan Jenis Pakan" >
                </div>
                <div class="mb-3">
                    <label for="ktp" class="form-label">Satuan</label>
                    <input type="text" class="form-control" id="satuan" name="satuan" value="<?= set_value('satuan')?>" placeholder="Diisi dengan Satuan" >
                </div>
                <button type="submit" class="btn btn-warning">Submit</button>
            </form>
        </div>  
    </main>
  </div>
</div>
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="<?= base_url('dashboard/dashboard.js') ?>"></script>
    <script>
		$(document).ready(function(){
			// Format mata uang.
			$('#harga_jual').mask('0.000.000.000.000.000', {reverse: true});		
			
		})
    $(document).ready(function(){
			// Format mata uang.
			$('#harga_beli').mask('0.000.000.000.000.000', {reverse: true});		
			
		})
	  </script> 

    <!-- Bootstrap JS -->
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="<?= base_url('dashboard/dashboard.js') ?>"></script>
  </body>
</html>
