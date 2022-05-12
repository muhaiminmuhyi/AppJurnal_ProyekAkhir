<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
    </div>

    <canvas class="my-4 w-100" id="myChart" width="900" height="380" hidden></canvas>

    <h2>Tambah Penjualan</h2>
    <div class="card">
        <div class="card-body">
                <div class="col-sm-7">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?= base_url('penjualan/detail_pnj')?>" method="POST">
                                <div class="form-group row">
                                    <label for="id_pnj" class="col-sm-2 col-form-label">ID Penjualan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="id_pnj" name="id_pnj" value="<?= $kode ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d')?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="produk" class="col-sm-2 col-form-label">Pakan</label>
                                    <div class="col-sm-8">
                                        <select name="produk" id="produk" class="form-control" required>
                                            <option value="">-</option>
                                            <?php foreach ($pakan as $key => $value) { ?>
                                            <option value="<?= $value->id_pakan?>"><?= $value->nama_pakan?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" name="qty" id="" min="1" value="1">
                                    </div>
                                </div>
                                <hr>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-sm btn-warning">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <hr>
                <hr>
                <div class="col-sm-8">
                    <!-- <div class="table-responsive"> -->
                        <div class="card">
                            <div class="card-body">
                                <h3>Detail Penjualan</h3>
                                <br>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Pakan</th>
                                            <th>Nama Pakan</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $no=1;
                                    $total = 0;
                                    $subtotal = 0;
                                    $grandtot = 0;
                                    foreach ($list_detail as $item) { ?>
                                        <?php $subtotal += $item->harga_jual * $item->qty; 
                                        $grandtot = $subtotal + $total?>
                                        <tr>
                                            <td><?= $no++?></td>
                                            <td><?= $item->id_pakan?></td>
                                            <td><?= $item->nama_pakan?></td>
                                            <td><?= rupiah($item->harga_jual)?></td>
                                            <td><?= $item->qty?></td>
                                            <td><?= rupiah($item->harga_jual * $item->qty)?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <th>Total</th>
                                        <th colspan="6" class="text-right"><?= rupiah($grandtot)?></th>
                                    </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <?php if ($detil->getNumRows() != 0) { ?>
                                    <form action="<?= base_url('penjualan/save_penjualan')?>" method="POST">
                                    <input type="hidden" name="id" value="<?= $kode ?>">
                                    <input type="hidden" name="total" value="<?= $total1 ?>">
                                    <div class="form-group row">
                                        <label for="pelanggan" class="col-sm-3 col-form-label">Pelanggan</label>
                                        <div class="col-sm">
                                            <select name="pelanggan" id="pelanggan" class="form-control" required>
                                                <option value="">-</option>
                                                <?php foreach ($pelanggan as $value) { ?>
                                                <option value="<?= $value->id_pelanggan?>"><?= $value->nm_pelanggan?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- <a href="" class="btn btn-success">Selesai</a> -->
                                    <button type="submit" class="btn btn-warning">Selesai</button>
                                    </form>
                                <?php }?>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
        </div>
    </div>
</main>
<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="<?= base_url('dashboard/dashboard.js') ?>"></script>