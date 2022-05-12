<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Data Kandang</h1>
      </div>

      <?php
        if(isset($validation)){
          echo $validation->listErrors();
        }
      ?>
        <div class="row">
        <?= form_open('kandang') ?>
                <div class="mb-3">
                    <label for="ktp" class="form-label">ID Kandang</label>
                    <input type="text" class="form-control" id="id_kandang" name="id_kandang" value="<?= set_value('id_kandang')?>" placeholder="Diisi dengan ID Kandang">
                </div>
                <div class="mb-3">
                    <label for="ktp" class="form-label">Nama Kandang</label>
                    <input type="text" class="form-control" id="nama_kandang" name="nama_kandang" value="<?= set_value('nama_kandang')?>" placeholder="Diisi dengan Nama Kandang">
                </div>
                <div class="mb-3">
                <label for="jenis_kandang" class="form-label">Jenis Kandang</label>
                <input type="text" class="form-control" id="jenis_kandang" name="jenis_kandang" value="<?= set_value('jenis_kandang')?>" placeholder="Diisi dengan Jenis Kandang">
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
			$('#harga').mask('0.000.000.000.000.000', {reverse: true});		
			
		})
	  </script> 

    <!-- Bootstrap JS -->
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="<?= base_url('dashboard/dashboard.js') ?>"></script>
  </body>
</html>
