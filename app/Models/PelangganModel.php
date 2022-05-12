<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table = 'pelanggan';

    //untuk memasukkan data
    public function insertData(){
        
        $id_pelanggan = $_POST['id_pelanggan'];
        $nm_pelanggan = $_POST['nm_pelanggan'];
        $alamat = $_POST['alamat'];
        $no_telp = $_POST['no_telp'];
        $email = $_POST['email'];
     
        $hasil = $this->db->query("INSERT INTO pelanggan SET id_pelanggan=?, nm_pelanggan=?, alamat=?, no_telp=?, email=?", array($id_pelanggan, $nm_pelanggan, $alamat, $no_telp, $email));
        return $hasil;
    }

    public function editData($id_pelanggan){
        $dbResult = $this->db->query("SELECT * FROM pelanggan WHERE id_pelanggan= ?", array($id_pelanggan));
        return $dbResult->getResult();
    }

    //untuk mendapatkan data kos sesuai dengan ID untuk diedit
    public function updateData(){
        $id_pelanggan = $_POST['id_pelanggan'];
        $nm_pelanggan = $_POST['nm_pelanggan'];
        $alamat = $_POST['alamat'];
        $no_telp = $_POST['no_telp'];
        $email = $_POST['email'];
     
        $hasil = $this->db->query("UPDATE pelanggan SET nm_pelanggan=?, alamat=?, no_telp=?, email=? WHERE id_pelanggan=? ", array($nm_pelanggan, $alamat, $no_telp, $email, $id_pelanggan));
        return $hasil;
    }

    //untuk menghapus data kos sesuai ID yang dipilih
    public function deleteData($id_pelanggan){
        $hasil = $this->db->query("DELETE FROM pelanggan WHERE id_pelanggan =? ", array($id_pelanggan));
        return $hasil;
    }

    //untuk mendapatkan data seluruh tabel 
    public function getAll(){
        return $this->findAll();
    }
   
}