<!DOCTYPE html>
<html>
 <head>
  <title>Sonofera Farm</title>
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
  <style>
  #card {
        background: #F5F5F5;
        border-radius: 8px;
        box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.65);
        height: 410px;
        margin: 6rem auto 8.1rem auto;
        width: 329px;
        }
        body {
       background: -webkit-linear-gradient(bottom, #FF4500, #FFA500);
       background-repeat: no-repeat;
        }
        #card-content {
      padding: 12px 44px;
}
#card-title {
      font-family: "Raleway Thin", sans-serif;
      letter-spacing: 5px;
      padding-bottom: 25px;
      padding-top: 15px;
      text-align: center;
}
.underline-title {
      background: -webkit-linear-gradient(right, #FF4500, #FFA500);
      height: 2px;
      margin: -1.1rem auto 0 auto;
      width: 89px;
}
 </style>
 </head>
 <body>
 <div id="card">
 <div id="card-content">
  <div id="card-title">
    <h2>Mitra Unggas Sonofera Farm</h2>
    <div class="underline-title"></div>
    <?php
            if(isset($pesan)){
                ?>
                     <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $pesan;?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            }
        ?>
            <form action="<?= base_url('home/ceklogin') ?>" method="post">
            <p>
            <label for="inputUsername" class="visually-hidden">Username</label>
            <input type="text" id="inputUsername" name="inputUsername" class="form-control" placeholder="Masukkan Username" required autofocus>
            </p>
            <p>
            <label for="inputPassword" class="visually-hidden">Password</label>
            <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Masukkan Password" required>
            </p>
            <button>LOG IN</button>
            <p class="mt-5 mb-3 text-muted">&copy; Marifah</p>
        </form>
  </div>
</div>
 </div>
 </body>
</html>