<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        </div>
      </div>

      <canvas class="my-4 w-100" id="myChart" width="900" height="380" hidden></canvas>
      
      <div class="row">
      
        <div class="col-sm">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Selamat Datang <b><?=strtoupper($_SESSION['nama'])?></b></h5>
            </div>
          </div>
        </div>

      </div> 
      
      <br>
      <br>
      <!-- Awal Tambahan Card Album -->
      

    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="<?= base_url('dashboard/dashboard.js') ?>"></script>
  </body>
</html>