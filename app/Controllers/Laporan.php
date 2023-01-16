<?php

namespace App\Controllers;

use App\Models\PembebananModel;
use App\Models\LaporanModel;
use App\Models\Penjualan;

class Laporan extends BaseController
{
    public function __construct()
    {
        $session = session();
        $this->PembebananModel = new PembebananModel();
        $this->LaporanModel = new LaporanModel();
        helper('rupiah');
        helper('waktu');
    }

    //lihat beban
    public function lihatbeban()
    {
        if (!isset($_SESSION['nama'])) {
            return redirect()->to(base_url('login'));
        }

        $data['beban'] = $this->PembebananModel->getListBeban();
        //maka kembalikan ke awal
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pembebanan/LihatBeban', $data);
    }

    //jurnal umum
    public function jurnalumum()
    {
        if (!isset($_SESSION['nama'])) {
            return redirect()->to(base_url('login'));
        }
        $data['tahun'] = $this->LaporanModel->getPeriodeTahun();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Laporan/Jurnal', $data);
        echo view('FooterBootstrap');
    }

    //json encode untuk list bulan
    public function listbulan($tahun)
    {
        if (!isset($_SESSION['nama'])) {
            return redirect()->to(base_url('login'));
        }
        //encode
        echo json_encode($this->LaporanModel->getPeriodeBulan($tahun));
    }

    //proses lihat jurnal umum
    public function lihatjurnalumum()
    {
        if (!isset($_SESSION['nama'])) {
            return redirect()->to(base_url('login'));
        }
        $data['jurnal'] = $this->LaporanModel->getJurnalUmum($_POST['tahun'], $_POST['bulan']);
        $data['bulan'] = $_POST['bulan'];
        $data['tahun'] = $_POST['tahun'];
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Laporan/LihatJurnal', $data);
        echo view('FooterBootstrap');
    }

    //buku besar
    public function bukubesar()
    {
        if (!isset($_SESSION['nama'])) {
            return redirect()->to(base_url('login'));
        }
        $data['tahun'] = $this->LaporanModel->getPeriodeTahun();
        $data['namaakun'] = $this->LaporanModel->getNamaAkun();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Laporan/BukuBesar', $data);
        echo view('FooterBootstrap');
    }

    //proses lihat buku besar
    public function lihatbukubesar()
    {
        if (!isset($_SESSION['nama'])) {
            return redirect()->to(base_url('login'));
        }
        $data['jurnal'] = $this->LaporanModel->getJurnalUmum($_POST['tahun'], $_POST['bulan']);

        $akun = $_POST['akun'];
        //explode untuk mendapatkan kode akun dan nama akun kode_akun|nama_akun 
        $akuncacah = explode("|", $akun);
        // print_r($akuncacah);


        $data['bulan'] = $_POST['bulan'];
        $data['tahun'] = $_POST['tahun'];
        $data['kodeakun'] = $akuncacah[0];
        $data['namaakun'] = $akuncacah[1];
        $data['bukubesar'] = $this->LaporanModel->getBukuBesar($data['tahun'], $data['bulan'], $data['kodeakun']);
        $data['saldoawal'] = $this->LaporanModel->getSaldoAwal($data['bulan'], $data['tahun'], $data['kodeakun']);
        $data['posisisaldonormal'] = $this->LaporanModel->getPosisiSaldoNormal($data['kodeakun']);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Laporan/LihatBukuBesar', $data);
        echo view('FooterBootstrap');
    }

    public function labarugi()
    {
        if (!isset($_SESSION['nama'])) {
            return redirect()->to(base_url('login'));
        }
        $data['tahun'] = $this->LaporanModel->getPeriodeTahun();

        //eksekusi pencatatan akrual jurnal


        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Laporan/LabaRugi', $data);
        echo view('FooterBootstrap');

    }

    //proses lihat laba rugi
    public function lihatlabarugi()
    {
        if (!isset($_SESSION['nama'])) {
            return redirect()->to(base_url('login'));
        }

        $data['bulan'] = $_POST['bulan'];
        $data['tahun'] = $_POST['tahun'];
        $data['penjualan'] = $this->LaporanModel->getPenjualan($data['bulan'], $data['tahun']);
        $data['pembebanan'] = $this->LaporanModel->getBeban($data['bulan'], $data['tahun']);

        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Laporan/LihatLabaRugi', $data);
        echo view('FooterBootstrap');

    }
    public function laba_rugi()
    {
        $penjualan  = new penjualan();
        $pembebanan = new pembebanan();

        $penjualan = $penjualan->selectSum('total')->first();
        $pembebanan = $pembebanan->selectSum('nominal')->select('nama')->groupBy('nama')->findAll();

        $data['penjualan'] = $penjualan['total'];

        return view('laporan/laba-rugi', $data);
    }
}
