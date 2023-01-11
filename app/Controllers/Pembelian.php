<?php
namespace App\Controllers;

use App\Models\PembelianModel;

class Pembelian extends BaseController
{
    public function __construct()
    {
        $session = session();
        $this->PembelianModel = new PembelianModel();
        helper('rupiah');
        $this->db = db_connect();
    }

	public function inputBeli()
	{
        // //tambahkan pengecekan login
        // if(!isset($_SESSION['nama'])){
        //     return redirect()->to(base_url('home')); 
        // }

        if(!isset($_POST['harga_beli']) and !isset($_POST['tanggal'])) {
            //tidak perlu divalidasi
            $kode = $this->kode();
            $dtl = $this->db->query('SELECT a.*, nama_pakan, c.status 
            FROM detail_pembelian a 
            join pakan b on a.id_pakan = b.id_pakan 
            join pembelian c on c.id_transaksi = a.id_transaksi
            where c.status = "proses"
            ')->getResult();
            $cek_detil = $this->db->query("SELECT * from detail_pembelian where id_transaksi = '$kode' ");
            $total = $this->db->query("SELECT SUM(total) AS total FROM detail_pembelian WHERE id_transaksi = '$kode'")->getRow()->total;
            $pemasok = $this->db->table('pemasok')->get()->getResult();

            $data['pembelian'] = $this->PembelianModel->getBeliData();
            $data['kode'] = $kode;
            $data['pakan'] = $this->db->table('pakan')->get()->getResult();
            $data['list_detail'] = $dtl;
            $data['detil'] = $cek_detil;
            $data['total1'] = $total;
            $data['pemasok'] = $pemasok;
            // print_r($data['kode']);exit;
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Pembelian/inputBeli', $data);
            echo view('FooterBootstrap');
        }else{
            $validation =  \Config\Services::validation();
            if (! $this->validate(
                    [
                        'harga_beli' => 'required',
                        'tanggal' => 'required'
                    ],
                    [   // Errors
                        'harga_beli' => [
                            'required' => 'harga_beli bahan_baku tidak boleh kosong'
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
                echo view('pembelian/inputBeli',[
                    'validation' => $this->validator,
                    'pembelian' => $this->PembelianModel->getBeliData()
                ]);
                echo view('FooterBootstrap');
            }else{
                //maka input database
                $hasil = $this->PembelianModel->inputBeli();
                var_dump($hasil);
                die;
                if($hasil == true){
                    ?>
                    <script type="text/javascript">
                        alert("Sukses menambahkan Pembelian");
                    </script>
                    <?php	
                }
                $data['pembelian'] = $this->PembelianModel->getListBeli();
                //maka kembalikan ke awal
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Pembelian/ListBeli', $data);
                echo view('FooterBootstrap');
            }
        }

	}

    public function ListBeli()
    {
        // $data['pembelian'] = $this->PembelianModel->getListBeli();
        $list = $this->db->query("SELECT a.*, nm_pemasok
        FROM pembelian a
        JOIN pemasok b ON a.id_pemasok = b.id_pemasok
        ")->getResult();
        $data['pembelian'] = $list;
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pembelian/ListBeli', $data);
        echo view('FooterBootstrap');
    }

    public function detail_pmb()
	{
        $kode = $this->kode();
        $id_pmb = $this->request->getPost('id_pmb');
        $id_produk = $this->request->getPost('produk');

        $cek_pmb = $this->db->query("SELECT * FROM pembelian WHERE status = 'proses' AND id_transaksi = '$id_pmb'");

        $produk = $this->db->query("SELECT * FROM pakan WHERE id_pakan = '$id_produk'")->getRow();
        $subtotal = $produk->harga_beli * $this->request->getPost('qty');
        
        $cek_detil = $this->db->query("SELECT * from detail_pembelian where id_pakan ='$id_produk' AND id_transaksi = '$id_pmb' ")->getRow();
        // print_r($cek_detil);exit;
        if ($cek_pmb->getNumRows() == 0) {
			$pmb = [
				'id_transaksi' => $id_pmb,
                'tanggal' => $this->request->getPost('tanggal'),
                'status' => 'proses',
			];
			$this->db->table('pembelian')->insert($pmb);

			$detil = [
				'id_transaksi' => $id_pmb,
                'id_pakan' => $id_produk,
                'qty' => $this->request->getPost('qty'),
                'harga_beli' => $produk->harga_beli,
                'total' => $subtotal,
			];
			$this->db->table('detail_pembelian')->insert($detil);
        } 
        else {
            if (empty($cek_detil->id_pakan)) {
                $detil = [
                    'id_transaksi' => $id_pmb,
                    'id_pakan' => $id_produk,
                    'qty' => $this->request->getPost('qty'),
                    'harga_beli' => $produk->harga_beli,
                    'total' => $subtotal,
                ];
				$this->db->table('detail_pembelian')->insert($detil);
            } 
            else {
                # code...
                $hasil = $cek_detil->qty + $this->request->getPost('qty');
                $update_harga_beli = $hasil * $cek_detil->harga_beli;

                $this->db->query("UPDATE detail_pembelian SET qty = '$hasil', total = '$update_harga_beli' WHERE id_transaksi = '$id_pmb' AND id_pakan = '$id_produk'");
            }
        }
        return redirect()->to(base_url('Pembelian/inputBeli'));
	}

    public function save_pembelian()
    {
        $id = $this->request->getPost('id');
        $tanggal = $this->request->getPost('tgl_jurnal');
        $pemasok = $this->request->getPost('pemasok');
        $total = $this->request->getPost('total');
		$data = [
			'id_pemasok' => $pemasok,
            'total' => $total,
            'status' => 'selesai',
		];
        // $this->db->where('id_transaksi', $id);

        $this->PembelianModel->save_pembelian($id, '112', $tanggal, 'd', $total, 3, 'pembelian');
		$this->PembelianModel->save_pembelian($id, '111', $tanggal, 'c', $total, 3, 'pembelian');

        $update = $this->db->table('pembelian')
		->where('id_transaksi', $id)
		->update($data);

		if ($update) {
			# code...
			return redirect()->to(base_url('Pembelian/ListBeli'));
		}
    }

    public function kode()
    {
        $builder = $this->db->table('pembelian')
        ->select('MAX(RIGHT(pembelian.id_transaksi,3)) as kode')
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
        $kd = "PMB-".$kodemax;
        // print_r($kd);exit;
        return $kd;
    }

    public function laporanpmb(){
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
        $data['tahun'] = $this->PembelianModel->getPeriodeTahun();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pembelian/Pembelian', $data);
        echo view('FooterBootstrap');
    }

    //json encode untuk list bulan
    public function listbulan($tahun){
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
        //encode
        echo json_encode($this->PembelianModel->getPeriodeBulan($tahun));
    }

    //proses lihat jurnal umum
    public function lihatpmb(){
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
        $data['pembelian'] = $this->PembelianModel->getPembelian($_POST['tahun'], $_POST['bulan']);
        $data['bulan'] = $_POST['bulan'];
        $data['tahun'] = $_POST['tahun'];
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pembelian/LihatPembelian', $data);
        echo view('FooterBootstrap');
    }
}