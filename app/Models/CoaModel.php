<?php

namespace App\Models;

use CodeIgniter\Model;

class CoaModel extends Model
{
    protected $table = 'coa';

    //untuk memasukkan data
    public function insertData(){
        
        $kode_coa = $_POST['kode_coa'];
        $nama_coa = $_POST['nama_coa'];
        $header_akun = $_POST['header_akun'];
        $posisi = $_POST['posisi'];
     
        $hasil = $this->db->query("INSERT INTO coa SET kode_coa=?, nama_coa=?, header_akun=?, posisi=?", array($kode_coa, $nama_coa, $header_akun, $posisi));
        return $hasil;
    }

    public function editData($kode_coa){
        $dbResult = $this->db->query("SELECT * FROM coa WHERE kode_coa= ?", array($kode_coa));
        return $dbResult->getResult();
    }

    //untuk mendapatkan data kos sesuai dengan ID untuk diedit
    public function updateData(){
        $kode_coa = $_POST['kode_coa'];
        $nama_coa = $_POST['nama_coa'];
        $header_akun = $_POST['header_akun'];
     
        $hasil = $this->db->query("UPDATE coa SET nama_coa=?, header_akun=? WHERE kode_coa=? ", array($nama_coa, $header_akun, $kode_coa));
        return $hasil;
    }

    //untuk menghapus data kos sesuai ID yang dipilih
    public function deleteData($kode_coa){
        $hasil = $this->db->query("DELETE FROM coa WHERE kode_coa =? ", array($kode_coa));
        return $hasil;
    }

    //untuk mendapatkan data seluruh tabel 
    public function getAll(){
        return $this->findAll();
    }
   
}