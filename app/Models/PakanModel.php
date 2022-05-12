<?php

namespace App\Models;

use CodeIgniter\Model;

class PakanModel extends Model
{
    protected $table = 'pakan';

    //untuk memasukkan data
    public function insertData(){
        
        $id_pakan = $_POST['id_pakan'];
        $nama_pakan = $_POST['nama_pakan'];
        $harga_jual = $_POST['harga_jual'];
        $harga_beli = $_POST['harga_beli'];
        $jenis_pakan = $_POST['jenis_pakan'];
        $satuan = $_POST['satuan'];

        $harga_jual = preg_replace( '/[^0-9 ]/i', '', $harga_jual);
        $harga_beli = preg_replace( '/[^0-9 ]/i', '', $harga_beli);
     
        $hasil = $this->db->query("INSERT INTO pakan SET id_pakan=?, nama_pakan=?, harga_jual=?, harga_beli=?, jenis_pakan=?, satuan=?", array($id_pakan, $nama_pakan, $harga_jual, $harga_beli, $jenis_pakan, $satuan));
        return $hasil;
    }

    public function editData($id_pakan){
        $dbResult = $this->db->query("SELECT * FROM pakan WHERE id_pakan= ?", array($id_pakan));
        return $dbResult->getResult();
    }

    //untuk mendapatkan data kos sesuai dengan ID untuk diedit
    public function updateData(){
        $id_pakan = $_POST['id_pakan'];
        $nama_pakan = $_POST['nama_pakan'];
        $harga_jual = $_POST['harga_jual'];
        $harga_beli = $_POST['harga_beli'];
        $jenis_pakan = $_POST['jenis_pakan'];
        $satuan = $_POST['satuan'];
     
        $hasil = $this->db->query("UPDATE pakan SET nama_pakan=?, harga_jual=?, harga_beli=?, jenis_pakan=?, satuan=? WHERE id_pakan=? ", array($nama_pakan, $harga_jual, $harga_beli, $jenis_pakan, $satuan, $id_pakan));
        return $hasil;
    }

    //untuk menghapus data kos sesuai ID yang dipilih
    public function deleteData($id_pakan){
        $hasil = $this->db->query("DELETE FROM pakan WHERE id_pakan =? ", array($id_pakan));
        return $hasil;
    }

    //untuk mendapatkan data seluruh tabel 
    public function getAll(){
        return $this->findAll();
    }
   
}