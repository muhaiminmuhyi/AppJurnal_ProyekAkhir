<?php
namespace App\Controllers;

use App\Models\AyamModel;

class Ayam extends BaseController
{
	public function __construct()
    {
        //load kelas AyamModel
        $this->AyamModel = new AyamModel();
    }

    //form input akan diakses dari index
    public function index()
	{
        //di cek dulu, agar validasi tidak terpicu pada saat awal method ini diakses
        if( !isset($_POST['id_ayam']) and
            !isset($_POST['nama_ayam']) and !isset($_POST['jenis_ayam']) and 
            !isset($_POST['usia_ayam']) ){
            //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Ayam/InputAyam');
        }
        else{
            $validation =  \Config\Services::validation();
            //di cek dulu apakah data isian memenuhi rules validasi yang dibuat
            if (! $this->validate(
                [
                    'id_ayam' => 'required|is_unique[Ayam.id_ayam]',
                    'nama_ayam' => 'required',
                    'jenis_ayam' => 'required',
                    'usia_ayam' => 'required'
                ],
                        [   // Errors
                            'id_ayam' => [
                                'required' => 'ID Ayam tidak boleh kosong',   
                                'is_unique'=> 'ID Ayam tidak boleh sama'
                            ],
                            'nama_ayam' => [
                                'required' => 'Nama Ayam tidak boleh kosong',   
                            ],
                            
                            'jenis_ayam' => [
                                'required' => 'Jenis Ayam tidak boleh kosong',
                            ],
                            'usia_ayam' => [
                                'required' => 'Usia Ayam tidak boleh kosong',
                            ]
                        ]
                )
                ){
                //kirim data error ke views, karena ada isian yang tidak sesuai rules
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Ayam/InputAyam',[
                    'validation' => $this->validator,
                ]);

            }else{
                //blok ini adalah blok jika sukses, yaitu panggil method insertData()
                //panggil metod dari kosan model untuk diinputkan datanya
                
                $hasil = $this->AyamModel->insertData();
                if($hasil->connID->affected_rows>0){
                    ?>
                    <script type="text/javascript">
                        alert("Data berhasil ditambahkan");
                    </script>
                    <?php	
                }
                $data['ayam'] = $this->AyamModel->getAll();
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Ayam/ListAyam', $data);
            }
        }
	}

    public function editAyam($id_ayam){

        $data['ayam'] = $this->AyamModel->editData($id_ayam);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Ayam/EditAyam', $data);
    }

    public function editAyamproses(){

        $id_ayam = $_POST['id_ayam'];
        $nama_ayam = $_POST['nama_ayam'];
        $jenis_ayam = $_POST['jenis_ayam'];
        $usia_ayam = $_POST['usia_ayam'];

        $validation =  \Config\Services::validation();

        if (! $this->validate(
            [
                    'nama_ayam' => 'required',
                    'jenis_ayam' => 'required',
                    'usia_ayam' => 'required'
            ],
                    [   // Errors
                            'nama_ayam' => [
                                'required' => 'Nama Ayam tidak boleh kosong',   
                            ],
                            
                            'jenis_ayam' => [
                                'required' => 'jenis Ayam tidak boleh kosong',
                            ],
                            'usia_ayam' => [
                                'required' => 'Usia Ayam tidak boleh kosong',
                            ]
                    ]
        ))
        {                
            
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Ayam/EditAyam',[
                'validation' => $this->validator,
                'ayam' => $this->AyamModel->editData($id_ayam)
            ]);

        }
        else
        {
            //panggil metod dari Ayam model untuk diinputkan datanya
            $hasil = $this->AyamModel->updateData();
            if($hasil->connID->affected_rows>0){
                ?>
                <script type="text/javascript">
                    alert("Berhasil mengubah data");
                </script>
                <?php	
            }
            $data['ayam'] = $this->AyamModel->getAll();
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Ayam/ListAyam', $data);
        }    
    }

    public function deleteAyam($id_ayam){
        
		$this->AyamModel->deleteData($id_ayam);

		return redirect()->to(base_url('Ayam/ListAyam')); 
	}

    public function ListAyam()
    {
        $data['ayam'] = $this->AyamModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Ayam/ListAyam', $data);
    }
}