<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table = 'coa';

    public function getAll()
    {
        $dbResult = $this->db->query("SELECT * FROM coa ORDER BY kode_coa");
        return $dbResult->getResult();
    }

    //untuk list buku besar
    public function getNamaAkun()
    {
        $sql = "SELECT b.kode_akun, a.nama_coa
                FROM coa a
                JOIN jurnal b on (a.kode_coa=b.kode_akun)
                GROUP BY b.kode_akun, a.nama_coa
                ORDER BY 2";
        $dbResult = $this->db->query($sql);
        return $dbResult->getResult();
    }

    //untuk data jurnal
    public function getJurnalUmum($tahun, $bulan)
    {
        $sql = "SELECT a.*,b.nama_coa  
                FROM jurnal a
		        JOIN coa b ON (a.kode_akun=b.kode_coa)
                WHERE  year(a.tgl_jurnal) = ? AND DATE_FORMAT(a.tgl_jurnal,'%m') = ?
                ORDER BY a.tgl_jurnal, a.id, a.id_transaksi,a.posisi_d_c DESC";
        $dbResult = $this->db->query($sql, array($tahun, $bulan));
        return $dbResult->getResult();
    }

    //untuk data list tahun
    public function getPeriodeTahun()
    {
        $dbResult = $this->db->query("SELECT DISTINCT(YEAR(tgl_jurnal)) as tahun FROM `jurnal` UNION SELECT 2020 as tahun ORDER BY 1");
        return $dbResult->getResult();
    }

    //untuk data list tahun
    public function getPeriodeBulan($tahun)
    {
        $sql = "SELECT DATE_FORMAT(tgl_jurnal,'%M') as bulan, DATE_FORMAT(tgl_jurnal,'%m') as bulan_angka 
                FROM `jurnal` WHERE YEAR(tgl_jurnal) = ?
                GROUP BY DATE_FORMAT(tgl_jurnal,'%M'), DATE_FORMAT(tgl_jurnal,'%m') ORDER BY 2";
        $dbResult = $this->db->query($sql, array($tahun));
        //dikembalikan dalam bentuk array
        return $dbResult->getResult('array');
    }

    //untuk data buku besar
    public function getBukuBesar($tahun, $bulan, $kodecoa)
    {
        $sql = "
                    SELECT a.*,b.nama_coa  
                    FROM jurnal a
                    JOIN coa b ON (a.kode_akun=b.kode_coa)
                    WHERE  year(a.tgl_jurnal) = ? AND DATE_FORMAT(a.tgl_jurnal,'%m') = ?
                    AND b.kode_coa = ?
                    ORDER BY a.tgl_jurnal, a.id, a.id_transaksi, a.kelompok,a.posisi_d_c DESC
                ";
        $dbResult = $this->db->query($sql, array($tahun, $bulan, $kodecoa));
        return $dbResult->getResult();
    }

    //get data posisi saldo normal
    public function getPosisiSaldoNormal($akun)
    {
        //lihat posisi saldo awal normal
        $sql = "SELECT posisi_d_c
                FROM jurnal";

        $dbResult = $this->db->query($sql, array($akun));
        $hasil = $dbResult->getResult('array');
        foreach ($hasil as $cacah) :
            $posisi_saldo_normal = $cacah['posisi_d_c'];
        endforeach;
        return $posisi_saldo_normal;
    }

    //untuk mengetahui saldo awal buku besar
    public function getSaldoAwal($bulan, $tahun, $akun)
    {
        $posisi_saldo_normal = $this->getPosisiSaldoNormal($akun);
        $bulan = str_pad($bulan, 2, "0", STR_PAD_LEFT);
        $waktu = $tahun . "-" . $bulan;
        $sql = "
                    SELECT tbl1.posisi_d_c,ifnull(tbl2.total,0) as nominal FROM
                    (
                        SELECT 'c' posisi_d_c
                        UNION
                        SELECT 'd' posisi_d_c
                    ) tbl1
                    LEFT OUTER JOIN
                    (
                        Select a.posisi_d_c,sum(a.nominal) as total
                        FROM jurnal a
                        JOIN coa b ON (a.kode_akun=b.kode_coa)
                        WHERE a.kode_akun = ? 
                        AND date_format(a.tgl_jurnal,'%Y-%m') < ?
                        GROUP BY  a.posisi_d_c
                    ) tbl2
                    ON (tbl1.posisi_d_c = tbl2.posisi_d_c)
        
        ";
        $dbResult = $this->db->query($sql, array($akun, $waktu));
        $hasil = $dbResult->getResult('array');
        $saldo_debet = 0;
        $saldo_kredit = 0;
        foreach ($hasil as $cacah) :
            if (strcmp($cacah['posisi_d_c'], 'd') == 0) {
                $saldo_debet = $saldo_debet + $cacah['nominal'];
            } else {
                $saldo_kredit = $saldo_kredit + $cacah['nominal'];
            }
        endforeach;

        if (strcmp($posisi_saldo_normal, 'd') == 0) {
            $saldo = $saldo_debet - $saldo_kredit;
        } else {
            $saldo =  $saldo_kredit - $saldo_debet;
        }
        return $saldo;
    }

    public function getPenjualan($bulan, $tahun)
    {
        $bulan = str_pad($bulan, 2, "0", STR_PAD_LEFT);
        $waktu = $bulan . "-" . $tahun;
        $sql = "
                Select ifnull(sum(a.nominal),0) as total
                FROM jurnal a
                JOIN penjualan b 
                ON (a.id_transaksi=b.id_transaksi)
                WHERE a.kode_akun = '111'
                AND date_format(a.tgl_jurnal,'%m-%Y')   
        ";
        $query = $this->db->query($sql, array($bulan));
        foreach ($query->getResult() as $row) :
            $total = $row->total;
        endforeach;
        return $total;
    }

    public function getBeban($bulan, $tahun)
    {
        $bulan = str_pad($bulan, 2, "0", STR_PAD_LEFT);
        $waktu = $bulan . "-" . $tahun;
        $sql = "SELECT a.kode_coa,a.nama_coa,SUM(nominal) as total
                FROM coa a
                JOIN jurnal b ON (a.kode_coa=b.kode_akun)
                JOIN pembebanan c ON (b.id_transaksi=c.id_transaksi)
                WHERE a.kode_coa LIKE '5%' and length(a.kode_coa)>1
                AND date_format(b.tgl_jurnal,'%m-%Y')
                GROUP BY a.kode_coa,a.nama_coa
                ORDER BY length(a.kode_coa) ASC, a.kode_coa
                ";
        $dbResult = $this->db->query($sql, array($waktu));
        return $dbResult->getResult();
    }
}
