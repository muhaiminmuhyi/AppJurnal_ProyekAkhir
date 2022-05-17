<?php

namespace App\Controllers;

use App\Models\ExportModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export extends BaseController
{
    public function __construct()
    {
        session_start();
        $this->ExportModel = new ExportModel();
        helper('rupiah');
        helper('waktu');
    }

    public function laporanbb()
    {
        if (!isset($_SESSION['nama'])) {
            return redirect()->to(base_url('home'));
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
}
