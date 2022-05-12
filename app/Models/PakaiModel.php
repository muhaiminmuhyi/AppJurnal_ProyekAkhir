<?php

namespace App\Models;

use CodeIgniter\Model;

class PakaiModel extends Model
{
    protected $table = 'pakai';

    //untuk memasukkan data
    public function insertData(){
        
        $no_pakai = $_POST['no_pakai'];
        $nama_kandang = $_POST['nama_kandang'];
        $nama_ayam = $_POST['nama_ayam'];
        $nama_pakan = $_POST['nama_pakan'];
        $jumlah = $_POST['jumlah'];
     
        $hasil = $this->db->query("INSERT INTO pakai SET no_pakai=?, nama_kandang=?, nama_ayam=?, nama_pakan=?, jumlah=?", array($no_pakai, $nama_kandang, $nama_ayam, $nama_pakan, $jumlah));
        return $hasil;
    }

    public function editData($no_pakai){
        $dbResult = $this->db->query("SELECT * FROM pakai WHERE no_pakai= ?", array($no_pakai));
        return $dbResult->getResult();
    }

    //untuk mendapatkan data kos sesuai dengan ID untuk diedit
    public function updateData(){
        $no_pakai = $_POST['no_pakai'];
        $nama_kandang = $_POST['nama_kandang'];
        $nama_ayam = $_POST['nama_ayam'];
        $nama_pakan = $_POST['nama_pakan'];
        $jumlah = $_POST['jumlah'];
     
        $hasil = $this->db->query("UPDATE pakai SET nama_kandang=?, nama_ayam=?, nama_pakan=?, jumlah=? WHERE no_pakai=? ", array($nama_kandang, $nama_ayam, $nama_pakan, $jumlah, $satuan
    ));
        return $hasil;
    }

    //untuk menghapus data kos sesuai ID yang dipilih
    public function deleteData($no_pakai){
        $hasil = $this->db->query("DELETE FROM pakai WHERE no_pakai =? ", array($no_pakai));
        return $hasil;
    }

    //untuk mendapatkan data seluruh tabel 
    public function getAll(){
        return $this->findAll();
    }
   
}