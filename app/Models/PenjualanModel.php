<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table = 'penjualan';

    //untuk menginputkan Penjualan dan penjurnalan

    public function save_penjualan($id_transaksi, $kode_akun, $tgl_jurnal, $posisi_d_c, $nominal, $kelompok, $transaksi){
        $tgl_jurnal  = date('Y-m-d');
        
        $hasil = $this->db->query("INSERT INTO jurnal SET id_transaksi=?, kode_akun=?, tgl_jurnal=?, posisi_d_c=?, nominal=?, kelompok=?, transaksi=?", array($id_transaksi, $kode_akun, $tgl_jurnal, $posisi_d_c, $nominal, $kelompok, $transaksi));
        return $hasil;    
    }
    
   //untuk mendapatkan data kode Jual
    public function getJualData(){
    $dbResult = $this->db->query("SELECT * FROM pakan WHERE id_pakan LIKE 'PKN%' AND length(id_pakan)>1");
    return $dbResult->getResult();
}

 //untuk mendapatkan data list Jual
 public function getListJual(){
    $dbResult = $this->db->query("SELECT * FROM penjualan");
    return $dbResult->getResult();
}

//untuk data list tahun
public function getPeriodeTahun(){
    $dbResult = $this->db->query("SELECT DISTINCT(YEAR(tanggal)) as tahun FROM `penjualan` UNION SELECT 2020 as tahun ORDER BY 1");
    return $dbResult->getResult();
}
//untuk data list tahun
public function getPeriodeBulan($tahun){
    $sql = "SELECT DATE_FORMAT(tanggal,'%M') as bulan, DATE_FORMAT(tanggal,'%m') as bulan_angka 
            FROM `penjualan` WHERE YEAR(tanggal) = ?
            GROUP BY DATE_FORMAT(tanggal,'%M'), DATE_FORMAT(tanggal,'%m') ORDER BY 2";
    $dbResult = $this->db->query($sql, array($tahun));
    //dikembalikan dalam bentuk array
    return $dbResult->getResult('array');
}
public function getPenjualan($tahun, $bulan){
    $sql = "SELECT a.*, nm_pelanggan
    FROM penjualan a
    JOIN pelanggan b ON a.id_pelanggan = b.id_pelanggan
    WHERE  year(a.tanggal) = ? AND DATE_FORMAT(a.tanggal,'%m') = ?";
    $dbResult = $this->db->query($sql, array($tahun, $bulan));
    return $dbResult->getResult();
}

}