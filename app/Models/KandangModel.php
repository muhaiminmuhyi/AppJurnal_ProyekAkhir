<?php

namespace App\Models;

use CodeIgniter\Model;

class KandangModel extends Model
{
    protected $table = 'kandang';

    //untuk memasukkan data
    public function insertData(){
        
        $id_kandang = $_POST['id_kandang'];
        $nama_kandang = $_POST['nama_kandang'];
        $jenis_kandang = $_POST['jenis_kandang'];
     
        $hasil = $this->db->query("INSERT INTO kandang SET id_kandang=?, nama_kandang=?, jenis_kandang=?", array($id_kandang, $nama_kandang, $jenis_kandang));
        return $hasil;
    }

    public function editData($id_kandang){
        $dbResult = $this->db->query("SELECT * FROM kandang WHERE id_kandang= ?", array($id_kandang));
        return $dbResult->getResult();
    }

    //untuk mendapatkan data kos sesuai dengan ID untuk diedit
    public function updateData(){
        $id_kandang = $_POST['id_kandang'];
        $nama_kandang = $_POST['nama_kandang'];
        $jenis_kandang = $_POST['jenis_kandang'];
     
        $hasil = $this->db->query("UPDATE kandang SET nama_kandang=?, jenis_kandang=? WHERE id_kandang=?", array($nama_kandang, $jenis_kandang, $id_kandang));
        return $hasil;
    }

    //untuk menghapus data kos sesuai ID yang dipilih
    public function deleteData($id_kandang){
        $hasil = $this->db->query("DELETE FROM kandang WHERE id_kandang =? ", array($id_kandang));
        return $hasil;
    }

    //untuk mendapatkan data seluruh tabel 
    public function getAll(){
        return $this->findAll();
    }
   
}