<?php
namespace App\Controllers;

use App\Models\PenjualanModel;

class Penjualan extends BaseController
{
    public function __construct()
    {
        session_start();
        $this->PenjualanModel = new PenjualanModel();
        helper('rupiah');
        $this->db = db_connect();
    }

	public function inputJual()
	{
        // //tambahkan pengecekan login
        // if(!isset($_SESSION['nama'])){
        //     return redirect()->to(base_url('home')); 
        // }

        if(!isset($_POST['harga_jual']) and !isset($_POST['tanggal'])) {
            //tidak perlu divalidasi
            $kode = $this->kode();
            $dtl = $this->db->query('SELECT a.*, nama_pakan, c.status 
            FROM detail_penjualan a 
            join pakan b on a.id_pakan = b.id_pakan 
            join penjualan c on c.id_transaksi = a.id_transaksi
            where c.status = "proses"
            ')->getResult();
            $cek_detil = $this->db->query("SELECT * from detail_penjualan where id_transaksi = '$kode' ");
            $total = $this->db->query("SELECT SUM(total) AS total FROM detail_penjualan WHERE id_transaksi = '$kode'")->getRow()->total;
            $pelanggan = $this->db->table('pelanggan')->get()->getResult();

            $data['penjualan'] = $this->PenjualanModel->getJualData();
            $data['kode'] = $kode;
            $data['pakan'] = $this->db->table('pakan')->get()->getResult();
            $data['list_detail'] = $dtl;
            $data['detil'] = $cek_detil;
            $data['total1'] = $total;
            $data['pelanggan'] = $pelanggan;
            // print_r($data['kode']);exit;
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Penjualan/inputJual', $data);
        }else{
            $validation =  \Config\Services::validation();
            if (! $this->validate(
                    [
                        'harga_jual' => 'required',
                        'tanggal' => 'required'
                    ],
                    [   // Errors
                        'harga_jual' => [
                            'required' => 'Harga Jual pakan tidak boleh kosong'
                        ],
                        'tanggal' => [
                            'required' => 'Tanggal tidak boleh kosong'
                        ]
                    ]
                )
            ){
                //maka kembalikan ke awal
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Penjualan/inputJual',[
                    'validation' => $this->validator,
                    'penjualan' => $this->PenjualanModel->getJualData()
                ]);
            }else{
                //maka input database
                $hasil = $this->PenjualanModel->inputJual();
                if($hasil->connID->affected_rows>0){
                    ?>
                    <script type="text/javascript">
                        alert("Sukses menambahkan Penjualan");
                    </script>
                    <?php	
                }
                $data['penjualan'] = $this->PenjualanModel->getListJual();
                //maka kembalikan ke awal
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Penjualan/ListJual', $data);
            }
        }

	}

    public function ListJual()
    {
        // $data['penjualan'] = $this->PenjualanModel->getListJual();
        $list = $this->db->query("SELECT a.*, nm_pelanggan
        FROM penjualan a
        JOIN pelanggan b ON a.id_pelanggan = b.id_pelanggan
        ")->getResult();
        $data['penjualan'] = $list;
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Penjualan/ListJual', $data);
    }

    public function detail_pnj()
	{
        $kode = $this->kode();
        $id_pnj = $this->request->getPost('id_pnj');
        $id_produk = $this->request->getPost('produk');

        $cek_pnj = $this->db->query("SELECT * FROM penjualan WHERE status = 'proses' AND id_transaksi = '$id_pnj'");

        $produk = $this->db->query("SELECT * FROM pakan WHERE id_pakan = '$id_produk'")->getRow();
        $subtotal = $produk->harga_jual * $this->request->getPost('qty');
        
        $cek_detil = $this->db->query("SELECT * from detail_penjualan where id_pakan ='$id_produk' AND id_transaksi = '$id_pnj' ")->getRow();
        // print_r($cek_detil);exit;
        if ($cek_pnj->getNumRows() == 0) {
			$pnj = [
				'id_transaksi' => $id_pnj,
                'tanggal' => $this->request->getPost('tanggal'),
                'status' => 'proses',
			];
			$this->db->table('penjualan')->insert($pnj);

			$detil = [
				'id_transaksi' => $id_pnj,
                'id_pakan' => $id_produk,
                'qty' => $this->request->getPost('qty'),
                'harga_jual' => $produk->harga_jual,
                'total' => $subtotal,
			];
			$this->db->table('detail_penjualan')->insert($detil);
        } 
        else {
            if (empty($cek_detil->id_pakan)) {
                $detil = [
                    'id_transaksi' => $id_pnj,
                    'id_pakan' => $id_produk,
                    'qty' => $this->request->getPost('qty'),
                    'harga_jual' => $produk->harga_jual,
                    'total' => $subtotal,
                ];
				$this->db->table('detail_penjualan')->insert($detil);
            } 
            else {
                # code...
                $hasil = $cek_detil->qty + $this->request->getPost('qty');
                $update_harga_jual = $hasil * $cek_detil->harga_jual;

                $this->db->query("UPDATE detail_penjualan SET qty = '$hasil', total = '$update_harga_jual' WHERE id_transaksi = '$id_pnj' AND id_pakan = '$id_produk'");
            }
        }
        return redirect()->to(base_url('penjualan/inputJual'));
	}

    public function save_penjualan()
    {
        $id = $this->request->getPost('id');
        $tanggal = $this->request->getPost('tgl_jurnal');
        $pelanggan = $this->request->getPost('pelanggan');
        $total = $this->request->getPost('total');
		$data = [
			'id_pelanggan' => $pelanggan,
            'total' => $total,
            'status' => 'selesai',
		];
        // $this->db->where('id_transaksi', $id);

        $this->PenjualanModel->save_penjualan($id, '111', $tanggal, 'd', $total, 2, 'penjualan');
		$this->PenjualanModel->save_penjualan($id, '411', $tanggal, 'c', $total, 2, 'penjualan');

        $update = $this->db->table('penjualan')
		->where('id_transaksi', $id)
		->update($data);

		if ($update) {
			# code...
			return redirect()->to(base_url('penjualan/ListJual'));
		}
    }

    public function kode()
    {
        $builder = $this->db->table('penjualan')
        ->select('MAX(RIGHT(penjualan.id_transaksi,3)) as kode')
        ->where('status !=', 'proses')
        ->limit(1)
        ->get();
        if ($builder->getNumRows() <> 0 ) {
            # code... 
            $data = $builder->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = '001';
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kd = "PNJ-".$kodemax;
        // print_r($kd);exit;
        return $kd;
    }

    public function laporanpnj(){
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
        $data['tahun'] = $this->PenjualanModel->getPeriodeTahun();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Penjualan/Penjualan', $data);
    }

    //json encode untuk list bulan
    public function listbulan($tahun){
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
        //encode
        echo json_encode($this->PenjualanModel->getPeriodeBulan($tahun));
    }

    //proses lihat jurnal umum
    public function lihatpnj(){
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
        $data['penjualan'] = $this->PenjualanModel->getPenjualan($_POST['tahun'], $_POST['bulan']);
        $data['bulan'] = $_POST['bulan'];
        $data['tahun'] = $_POST['tahun'];
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Penjualan/LihatPenjualan', $data);
    }

}