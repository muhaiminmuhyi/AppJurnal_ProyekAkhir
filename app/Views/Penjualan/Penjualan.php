<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Periode Penjualan</h1>
      </div>

      <canvas class="my-4 w-100" id="myChart" width="900" height="380" hidden></canvas>

      <?php
        if(isset($validation)){
          echo $validation->listErrors();
        }
        //echo $idkos;
      ?>
        <div class="row">
        <form action="<?= base_url('penjualan/lihatpnj') ?>" method="post">
            
                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun</label>
                        <select class="form-select" aria-label="Default select example" name="tahun" id="tahun">
                            <?php
                                foreach($tahun as $row):
                                    $tahun = $row->tahun;
                                    ?>
                                        <option value="<?=$tahun?>"><?=$tahun?></option>
                                    <?php
                                endforeach;
                            ?>
                        </select>
                </div>
                <div id="x"></div>

                <button type="submit" class="btn btn-warning">Submit</button>
            </form>
        </div>

     
    </main>
  </div>
</div>
     <!-- untuk jquery AJAX -->
     <script>
            $(document).ready(function() {
                $('#tahun').change(function(){
                var tahun = document.getElementById("tahun").value;
                //jadinya akses json ke alamat url http://localhost:8080/laporan/listbulan/2021
                var var_url = "<?=base_url('laporan/listbulan')?>"+"/"+tahun; 
                $.ajax({
                    url: var_url,
                    dataType: "json",
                    async : true,
                    success: function(data){
                    try{  
                        var teks = '<div class="mb-3">';
                        teks += '<label for="bulan" class="form-label">Bulan</label>';
                        teks += '<select class="form-select" aria-label="Default select example" name="bulan" id="bulan">';
                        for(i=0; i<data.length; i++){
                            teks += "<option value='"+data[i].bulan_angka+"'>"+data[i].bulan+"</option>";
                        }
                        teks = teks + "</div>";
                        document.getElementById("x").innerHTML = teks;
                    }catch(e) {  
                        alert('Exception while request..');
                    }   
                    }
                });
                });
            });
    </script>
