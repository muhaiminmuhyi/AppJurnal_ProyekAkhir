<?php

namespace App\Models;

use CodeIgniter\Model;

class PemasokModel extends Model
{
    protected $table = 'pemasok';

    //untuk memasukkan data
    public function insertData(){
        
        $id_pemasok = $_POST['id_pemasok'];
        $nm_pemasok = $_POST['nm_pemasok'];
        $alamat = $_POST['alamat'];
        $no_telp = $_POST['no_telp'];
        $email = $_POST['email'];
     
        $hasil = $this->db->query("INSERT INTO pemasok SET id_pemasok=?, nm_pemasok=?, alamat=?, no_telp=?, email=?", array($id_pemasok, $nm_pemasok, $alamat, $no_telp, $email));
        return $hasil;
    }

    public function editData($id_pemasok){
        $dbResult = $this->db->query("SELECT * FROM pemasok WHERE id_pemasok= ?", array($id_pemasok));
        return $dbResult->getResult();
    }

    //untuk mendapatkan data kos sesuai dengan ID untuk diedit
    public function updateData(){
        $id_pemasok = $_POST['id_pemasok'];
        $nm_pemasok = $_POST['nm_pemasok'];
        $alamat = $_POST['alamat'];
        $no_telp = $_POST['no_telp'];
        $email = $_POST['email'];
     
        $hasil = $this->db->query("UPDATE pemasok SET nm_pemasok=?, alamat=?, no_telp=?, email=? WHERE id_Pemasok=? ", array($nm_pemasok, $alamat, $no_telp, $email, $id_pemasok));
        return $hasil;
    }

    //untuk menghapus data kos sesuai ID yang dipilih
    public function deleteData($id_pemasok){
        $hasil = $this->db->query("DELETE FROM pemasok WHERE id_pemasok =? ", array($id_pemasok));
        return $hasil;
    }

    //untuk mendapatkan data seluruh tabel 
    public function getAll(){
        return $this->findAll();
    }
   
}