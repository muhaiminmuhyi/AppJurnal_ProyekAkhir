<?php

namespace App\Controllers;

use App\Models\ExportModel;
use App\Models\PenjualanModel;
use App\Models\PembelianModel;
use App\Models\PembebananModel;
use App\Models\LaporanModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

class Export extends BaseController
{
    public function __construct()
    {
        $session = session();
        $this->ExportModel = new ExportModel();
        $this->PenjualanModel = new PenjualanModel();
        $this->PembelianModel = new PembelianModel();
        $this->PembebananModel = new PembebananModel();
        $this->LaporanModel = new LaporanModel();
        helper('rupiah');
        helper('waktu');
    }

    public function laporanbb()
    {
        if (!isset($_SESSION['nama'])) {
            return redirect()->to(base_url('login'));
        }
        $data['jurnal'] = $this->ExportModel->getJurnalUmum($_POST['tahun'], $_POST['bulan']);

        $akun = $_POST['akun'];
        //explode untuk mendapatkan kode akun dan nama akun kode_akun|nama_akun 
        $akuncacah = explode("|", $akun);
        // print_r($akuncacah);


        $bulan = $_POST['bulan'];
        $tahun = $_POST['tahun'];
        // $kodeakun = $akuncacah[0];
        // $namaakun = $akuncacah[1];
        $bukubesar = $this->ExportModel->getBukuBesar($tahun, $bulan, $akun);
        $saldoawal = $this->ExportModel->getSaldoAwal($bulan, $tahun, $akun);
        $posisisaldonormal = $this->ExportModel->getPosisiSaldoNormal($akun);
        $waktu = $tahun . '-' . $bulan . "-1";
        $db = 0;
        $kr = 0;

        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Tanggal')
            ->setCellValue('B1', 'Keterangan')
            ->setCellValue('C1', 'Ref')
            ->setCellValue('D1', 'Debet')
            ->setCellValue('E1', 'Kredit')
            ->setCellValue('F1', 'Debet')
            ->setCellValue('G1', 'Kredit');


        $column = 2;
        // tulis data mobil ke cell

        $saldo_debet = $saldoawal;
        $saldo_kredit = 0;
        // pisah
        $saldo_debet = 0;
        $saldo_kredit = $saldoawal;
        foreach ($bukubesar as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $waktu)
                ->setCellValue('B' . $column, $data->nama_coa)
                ->setCellValue('C' . $column, $data->id_transaksi);
            if (strcmp($posisisaldonormal, 'd') == 0) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('D' . $column, rupiah($saldoawal));
            } else {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('E' . $column, rupiah($saldoawal));
            }
            if ($data->posisi_d_c == 'd') {
                if ($posisisaldonormal == 'd') {
                    $saldo_debet = $saldo_debet - $data->nominal;
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('G' . $column, rupiah($saldo_kredit))
                        ->setCellValue('G' . $column, rupiah($saldo_debet));
                } else {
                    $saldo_kredit = $saldo_kredit + $data->nominal;
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('F' . $column, rupiah($saldo_debet))
                        ->setCellValue('F' . $column, rupiah($saldo_kredit));
                }
            } else {
                if ($posisisaldonormal == 'd') {
                    $saldo_debet = $saldo_debet - $data->nominal;
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('G' . $column, rupiah($saldo_kredit))
                        ->setCellValue('G' . $column, rupiah($saldo_debet));
                } else {
                    $saldo_kredit = $saldo_kredit + $data->nominal;
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('G' . $column, rupiah($saldo_debet))
                        ->setCellValue('G' . $column, rupiah($saldo_kredit));
                }
            }
            $column++;
        }
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Laporan';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function laporanpnj()
    {
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('login')); 
        }
        $penjualan = $this->PenjualanModel->getPenjualan($_POST['tahun'], $_POST['bulan']);
        $data['bulan'] = $_POST['bulan'];
        $data['tahun'] = $_POST['tahun'];
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID Penjualan')
            ->setCellValue('B1', 'Tanggal')
            ->setCellValue('C1', 'Pelanggan')
            ->setCellValue('D1', 'Total Transaksi');

        $column = 2;

        foreach ($penjualan as $row) {
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A'.$column, $row->id_transaksi)
            ->setCellValue('B'.$column, $row->tanggal)
            ->setCellValue('C'.$column, $row->nm_pelanggan)
            ->setCellValue('D'.$column, rupiah($row->total));

            $column++;
        }
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Penjualan';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function laporanpmb()
    {
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('login')); 
        }
        $pembelian = $this->PembelianModel->getPembelian($_POST['tahun'], $_POST['bulan']);
        $data['bulan'] = $_POST['bulan'];
        $data['tahun'] = $_POST['tahun'];
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID Penjualan')
            ->setCellValue('B1', 'Tanggal')
            ->setCellValue('C1', 'Pemasok')
            ->setCellValue('D1', 'Total Transaksi');

        $column = 2;
        foreach ($pembelian as $row) {
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A'.$column,$row->id_transaksi)
            ->setCellValue('B'.$column,$row->tanggal)
            ->setCellValue('C'.$column,$row->nm_pemasok)
            ->setCellValue('D'.$column,rupiah($row->total));

            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Pembelian';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function laporanbeban()
    {
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('login')); 
        }
        $pembebanan = $this->PembebananModel->getPembebanan($_POST['tahun'], $_POST['bulan']);
        $data['bulan'] = $_POST['bulan'];
        $data['tahun'] = $_POST['tahun'];
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID Pembebanan')
            ->setCellValue('B1', 'Keterangan')
            ->setCellValue('C1', 'Tanggal')
            ->setCellValue('D1', 'Biaya');
        
        $column = 2;

        foreach ($pembebanan as $row) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'.$column,$row->id_transaksi)
                ->setCellValue('B'.$column,$row->nama)
                ->setCellValue('C'.$column,substr($row->waktu,0,10))
                ->setCellValue('D'.$column,rupiah($row->biaya));
            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Pembebanan';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function laporanjurnal()
    {
        if (!isset($_SESSION['nama'])) {
            return redirect()->to(base_url('login'));
        }
        $jurnal = $this->LaporanModel->getJurnalUmum($_POST['tahun'], $_POST['bulan']);
        $data['bulan'] = $_POST['bulan'];
        $data['tahun'] = $_POST['tahun'];
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'Tanggal')
            ->setCellValue('C1', 'Keterangan')
            ->setCellValue('D1', 'Ref')
            ->setCellValue('E1', 'Debet')
            ->setCellValue('F1', 'Kredit');
        
        $column = 2;

        foreach ($jurnal as $row) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'.$column,$row->id_transaksi)
                ->setCellValue('B'.$column,$row->tgl_jurnal);
                if ($row->posisi_d_c == 'd') {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('C'.$column,$row->nama_coa);
                } else {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('C'.$column,$row->nama_coa);
                }
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('D'.$column,$row->kode_akun);
                if ($row->posisi_d_c == 'd') {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('E'.$column,rupiah($row->nominal));
                } else {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('F'.$column,rupiah($row->nominal));
                }
            
            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Jurnal';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        
    }

    public function laporanlr()
    {
        if (!isset($_SESSION['nama'])) {
            return redirect()->to(base_url('login'));
        }

        $data['bulan'] = $_POST['bulan'];
        $data['tahun'] = $_POST['tahun'];
        $penjualan = $this->LaporanModel->getPenjualan($data['bulan'], $data['tahun']);
        $pembebanan = $this->LaporanModel->getBeban($data['bulan'], $data['tahun']);
        $total = 0;
        $total = $total + $penjualan;
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1','Pendapatan')
            ->setCellValue('B1','Penjualan')
            ->setCellValue('C1','Beban')
            ->setCellValue('D1','Laba Bersih');
        $column = 2;
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B'.$column,rupiah($penjualan));
        foreach ($pembebanan as $row) :
            if (strlen($row->kode_coa)) {
                $i = 0;
            
            $total = $total - $row->total;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('C'.$column,rupiah($row->total));

            foreach ($pembebanan as $row) : {
                $i++;    
            }
            endforeach;
            }
            $column++;
        endforeach;
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('D'.$column,rupiah($total));

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Laba Rugi';
    
        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');
    
        $writer->save('php://output');
    }

    public function pdfbb()
    {
        if (!isset($_SESSION['nama'])) {
            return redirect()->to(base_url('login'));
        }
        $data['jurnal'] = $this->ExportModel->getJurnalUmum($_POST['tahun'], $_POST['bulan']);

        $akun = $_POST['akun'];
        //explode untuk mendapatkan kode akun dan nama akun kode_akun|nama_akun 
        $akuncacah = explode("|", $akun);
        // print_r($akuncacah);
        // var_dump($akun);
        // die;

        $data['bulan'] = $_POST['bulan'];
        $data['tahun'] = $_POST['tahun'];
        $data['kodeakun'] = $akuncacah[0];
        $data['namaakun'] = $akuncacah[1];
        $data['bukubesar'] = $this->ExportModel->getBukuBesar($data['tahun'], $data['bulan'], $data['kodeakun']);
        $data['saldoawal'] = $this->ExportModel->getSaldoAwal($data['bulan'], $data['tahun'], $data['kodeakun']);
        $data['posisisaldonormal'] = $this->ExportModel->getPosisiSaldoNormal($data['kodeakun']);
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('pdf/template-bb', $data));
        $dompdf->setPaper('A4', 'portrait'); //ukuran kertas dan orientasi
        $dompdf->render();
        $dompdf->stream("laporan-bukubesar"); //nama file pdf
 
        return redirect()->to(base_url('Laporan/BukuBesar'));
    }

    public function pdfpnj()
    {
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('login')); 
        }
        $data['penjualan'] = $this->PenjualanModel->getPenjualan($_POST['tahun'], $_POST['bulan']);
        $data['bulan'] = $_POST['bulan'];
        $data['tahun'] = $_POST['tahun'];
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('pdf/template-pnj', $data));
        $dompdf->setPaper('A4', 'portrait'); //ukuran kertas dan orientasi
        $dompdf->render();
        $dompdf->stream("laporan-pnj"); //nama file pdf
 
        return redirect()->to(base_url('Penjualan/lihatpnj'));
    }

    public function pdfpmb()
    {
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('login')); 
        }
        $data['pembelian'] = $this->PembelianModel->getPembelian($_POST['tahun'], $_POST['bulan']);
        $data['bulan'] = $_POST['bulan'];
        $data['tahun'] = $_POST['tahun'];
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('pdf/template-pmb', $data));
        $dompdf->setPaper('A4', 'portrait'); //ukuran kertas dan orientasi
        $dompdf->render();
        $dompdf->stream("laporan-pmb"); //nama file pdf
 
        return redirect()->to(base_url('Pembelian/lihatpmb'));
    }

    public function pdfbeban()
    {
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('login')); 
        }
        $data['pembebanan'] = $this->PembebananModel->getPembebanan($_POST['tahun'], $_POST['bulan']);
        $data['bulan'] = $_POST['bulan'];
        $data['tahun'] = $_POST['tahun'];
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('pdf/template-beban', $data));
        $dompdf->setPaper('A4', 'portrait'); //ukuran kertas dan orientasi
        $dompdf->render();
        $dompdf->stream("laporan-pembebanan"); //nama file pdf
 
        return redirect()->to(base_url('Pembelian/lihatpmb'));
    }

    public function pdfjurnal()
    {
        if (!isset($_SESSION['nama'])) {
            return redirect()->to(base_url('login'));
        }
        $data['jurnal'] = $this->LaporanModel->getJurnalUmum($_POST['tahun'], $_POST['bulan']);
        $data['bulan'] = $_POST['bulan'];
        $data['tahun'] = $_POST['tahun'];
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('pdf/template-jurnal', $data));
        $dompdf->setPaper('A4', 'portrait'); //ukuran kertas dan orientasi
        $dompdf->render();
        $dompdf->stream("laporan-jurnal"); //nama file pdf

        return redirect()->to(base_url('Laporan/lihatjurnal'));
    }

    public function pdflr()
    {
        if (!isset($_SESSION['nama'])) {
            return redirect()->to(base_url('login'));
        }

        $data['bulan'] = $_POST['bulan'];
        $data['tahun'] = $_POST['tahun'];
        $data['penjualan'] = $this->LaporanModel->getPenjualan($data['bulan'], $data['tahun']);
        $data['pembebanan'] = $this->LaporanModel->getBeban($data['bulan'], $data['tahun']);
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('pdf/template-lr', $data));
        $dompdf->setPaper('A4', 'portrait'); //ukuran kertas dan orientasi
        $dompdf->render();
        $dompdf->stream("laporan-laba-rugi"); //nama file pdf

        return redirect()->to(base_url('Laporan/lihatlabarugi'));
    }
}
