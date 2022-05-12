<?php
namespace App\Controllers;

use App\Models\PelangganModel;

class Pelanggan extends BaseController
{
	public function __construct()
    {
        //load kelas PelangganModel
        $this->PelangganModel = new PelangganModel();
    }

    //form input akan diakses dari index
    public function index()
	{
        //di cek dulu, agar validasi tidak terpicu pada saat awal method ini diakses
        if( !isset($_POST['id_pelanggan']) and
            !isset($_POST['nm_pelanggan']) and !isset($_POST['alamat']) and 
            !isset($_POST['no_telp']) and !isset($_POST['email']) ){
            //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Pelanggan/InputPelanggan');
        }
        else{
            $validation =  \Config\Services::validation();
            //di cek dulu apakah data isian memenuhi rules validasi yang dibuat
            if (! $this->validate(
                [
                    'id_pelanggan' => 'required|is_unique[Pelanggan.id_pelanggan]',
                    'nm_pelanggan' => 'required',
                    'alamat' => 'required',
                    'no_telp' => 'required',
                    'email' => 'required'
                ],
                        [   // Errors
                            'id_pelanggan' => [
                                'required' => 'ID Pelanggan tidak boleh kosong',   
                                'is_unique'=> 'ID Pelanggan tidak boleh sama'
                            ],
                            'nm_pelanggan' => [
                                'required' => 'Nama Pelanggan tidak boleh kosong',   
                            ],
                            
                            'alamat' => [
                                'required' => 'Alamat tidak boleh kosong',
                            ],
                            'no_telp' => [
                                'required' => 'Nomor telepon tidak boleh kosong',
                            ],
                            'email' => [
                                'required' => 'Email tidak boleh kosong',
                            ]
                        ]
                )
                ){
                //kirim data error ke views, karena ada isian yang tidak sesuai rules
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Pelanggan/InputPelanggan',[
                    'validation' => $this->validator,
                ]);

            }else{
                //blok ini adalah blok jika sukses, yaitu panggil method insertData()
                //panggil metod dari kosan model untuk diinputkan datanya
                
                $hasil = $this->PelangganModel->insertData();
                if($hasil->connID->affected_rows>0){
                    ?>
                    <script type="text/javascript">
                        alert("Data berhasil ditambahkan");
                    </script>
                    <?php	
                }
                $data['pelanggan'] = $this->PelangganModel->getAll();
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Pelanggan/ListPelanggan', $data);
            }
        }
	}

    public function editPelanggan($id_pelanggan){

        $data['pelanggan'] = $this->PelangganModel->editData($id_pelanggan);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pelanggan/EditPelanggan', $data);
    }

    public function editPelangganproses(){

        $id_pelanggan = $_POST['id_pelanggan'];
        $nm_pelanggan = $_POST['nm_pelanggan'];
        $alamat = $_POST['alamat'];
        $no_telp = $_POST['no_telp'];
        $email = $_POST['email'];

        $validation =  \Config\Services::validation();

        if (! $this->validate(
            [
                    'nm_pelanggan' => 'required',
                    'alamat' => 'required',
                    'no_telp' => 'required',
                    'email' => 'required'
            ],
                    [   // Errors
                            'nm_pelanggan' => [
                                'required' => 'Nama Pelanggan tidak boleh kosong',   
                            ],
                            
                            'alamat' => [
                                'required' => 'Alamat tidak boleh kosong',
                            ],
                            'no_telp' => [
                                'required' => 'Nomor telepon tidak boleh kosong',
                            ],
                            'email' => [
                                'required' => 'Email tidak boleh kosong',
                            ]
                    ]
        ))
        {                
            
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Pelanggan/EditPelanggan',[
                'validation' => $this->validator,
                'Pelanggan' => $this->PelangganModel->editData($id_pelanggan)
            ]);

        }
        else
        {
            //panggil metod dari Pelanggan model untuk diinputkan datanya
            $hasil = $this->PelangganModel->updateData();
            if($hasil->connID->affected_rows>0){
                ?>
                <script type="text/javascript">
                    alert("Berhasil mengubah data");
                </script>
                <?php	
            }
            $data['pelanggan'] = $this->PelangganModel->getAll();
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Pelanggan/ListPelanggan', $data);
        }    
    }

    public function deletePelanggan($id_pelanggan){
        
		$this->PelangganModel->deleteData($id_pelanggan);

		return redirect()->to(base_url('Pelanggan/ListPelanggan')); 
	}

    public function ListPelanggan()
    {
        $data['pelanggan'] = $this->PelangganModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pelanggan/ListPelanggan', $data);
    }
}