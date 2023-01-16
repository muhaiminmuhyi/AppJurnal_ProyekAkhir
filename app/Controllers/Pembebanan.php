<?php
namespace App\Controllers;

use App\Models\PembebananModel;

class Pembebanan extends BaseController
{
    public function __construct()
    {
        $session = session();
        $this->PembebananModel = new PembebananModel();
        helper('rupiah');
    }

	public function inputBeban()
	{
        // //tambahkan pengecekan login
        // if(!isset($_SESSION['nama'])){
        //     return redirect()->to(base_url('login')); 
        // }

        if( !isset($_POST['nama']) and !isset($_POST['biaya']) and !isset($_POST['waktu']) ) {
            //tidak perlu divalidasi
            $data['pembebanan'] = $this->PembebananModel->getBebanData();
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Pembebanan/inputBeban', $data);
            echo view('FooterBootstrap');
        }else{
            $validation =  \Config\Services::validation();
            if (! $this->validate(
                    [
                        'nama' => 'required',
                        'biaya' => 'required',
                        'waktu' => 'required'
                    ],
                    [   // Errors
                        'nama' => [
                            'required' => 'Nama beban tidak boleh kosong'
                        ],
                        'biaya' => [
                            'required' => 'Besar biaya beban tidak boleh kosong'
                        ],
                        'waktu' => [
                            'required' => 'Tanggal beban tidak boleh kosong'
                        ]
                    ]
                )
            ){
                //maka kembalikan ke awal
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Pembebanan/inputBeban',[
                    'validation' => $this->validator,
                    'pembebanan' => $this->PembebananModel->getBebanData()
                ]);
                echo view('FooterBootstrap');
            }else{
                //maka input database
                $hasil = $this->PembebananModel->inputBeban();
                if($hasil == true){
                    ?>
                    <script type="text/javascript">
                        alert("Sukses menambahkan beban");
                    </script>
                    <?php	
                }
                $data['pembebanan'] = $this->PembebananModel->getListBeban();
                //maka kembalikan ke awal
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Pembebanan/ListBeban', $data);
                echo view('FooterBootstrap');
            }
        }

	}

    public function ListBeban()
    {
        $data['pembebanan'] = $this->PembebananModel->getListBeban();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('pembebanan/ListBeban', $data);
        echo view('FooterBootstrap');
    }

    public function laporanbeban(){
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('login')); 
        }
        $data['tahun'] = $this->PembebananModel->getPeriodeTahun();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pembebanan/Pembebanan', $data);
        echo view('FooterBootstrap');
    }

    //json encode untuk list bulan
    public function listbulan($tahun){
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('login')); 
        }
        //encode
        echo json_encode($this->PembebananModel->getPeriodeBulan($tahun));
    }

    //proses lihat jurnal umum
    public function lihatbeban(){
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('login')); 
        }
        $data['pembebanan'] = $this->PembebananModel->getPembebanan($_POST['tahun'], $_POST['bulan']);
        $data['bulan'] = $_POST['bulan'];
        $data['tahun'] = $_POST['tahun'];
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pembebanan/LihatPembebanan', $data);
        echo view('FooterBootstrap');
    }
}