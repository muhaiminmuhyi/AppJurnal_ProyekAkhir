<?php

namespace App\Models;

use CodeIgniter\Model;

class AyamModel extends Model
{
    protected $table = 'ayam';

    //untuk memasukkan data
    public function insertData(){
        
        $id_ayam = $_POST['id_ayam'];
        $nama_ayam = $_POST['nama_ayam'];
        $jenis_ayam = $_POST['jenis_ayam'];
        $usia_ayam = $_POST['usia_ayam'];
     
        $hasil = $this->db->query("INSERT INTO ayam SET id_ayam=?, nama_ayam=?, jenis_ayam=?, usia_ayam=?", array($id_ayam, $nama_ayam, $jenis_ayam, $usia_ayam));
        return $hasil;
    }

    public function editData($id_ayam){
        $dbResult = $this->db->query("SELECT * FROM ayam WHERE id_ayam= ?", array($id_ayam));
        return $dbResult->getResult();
    }

    //untuk mendapatkan data kos sesuai dengan ID untuk diedit
    public function updateData(){
        $id_ayam = $_POST['id_ayam'];
        $nama_ayam = $_POST['nama_ayam'];
        $jenis_ayam = $_POST['jenis_ayam'];
        $usia_ayam = $_POST['usia_ayam'];
     
        $hasil = $this->db->query("UPDATE ayam SET nama_ayam=?, jenis_ayam=?, usia_ayam=? WHERE id_ayam=? ", array($nama_ayam, $jenis_ayam, $usia_ayam, $id_ayam));
        return $hasil;
    }

    //untuk menghapus data kos sesuai ID yang dipilih
    public function deleteData($id_ayam){
        $hasil = $this->db->query("DELETE FROM ayam WHERE id_ayam =? ", array($id_ayam));
        return $hasil;
    }

    //untuk mendapatkan data seluruh tabel 
    public function getAll(){
        return $this->findAll();
    }
   
}