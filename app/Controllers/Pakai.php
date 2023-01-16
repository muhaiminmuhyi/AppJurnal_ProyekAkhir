<?php
namespace App\Controllers;

use App\Models\PakaiModel;

class Pakai extends BaseController
{
	public function __construct()
    {
        $session = session();
        //load kelas PakaiModel
        $this->PakaiModel = new PakaiModel();
    }

    //form input akan diakses dari index
    public function index()
	{
        //di cek dulu, agar validasi tidak terpicu pada saat awal method ini diakses
        if( !isset($_POST['no_pakai']) and
            !isset($_POST['nama_kandang']) and 
            !isset($_POST['nama_ayam']) and 
            !isset($_POST['nama_pakan']) and
            !isset($_POST['jumlah'])){
            //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Pakai/InputPakai');
        }
        else{
            $validation =  \Config\Services::validation();
            //di cek dulu apakah data isian memenuhi rules validasi yang dibuat
            if (! $this->validate(
                [
                    'no_pakai' => 'required|is_unique[Pakai.no_pakai]',
                    'nama_kandang' => 'required',
                    'nama_ayam' => 'required',
                    'nama_pakan' => 'required',
                    'jumlah' => 'required'
                ],
                        [   // Errors
                            'no_pakai' => [
                                'required' => 'No Pakai tidak boleh kosong',   
                                'is_unique'=> 'No Pakai tidak boleh sama'
                            ],
                            'nama_kandang' => [
                                'required' => 'Nama Kandang tidak boleh kosong',   
                            ],
                            'nama_ayam' => [
                                'required' => 'Nama Ayam tidak boleh kosong',
                            ],
                            'nama_pakan' => [
                                'required' => 'Nama Pakan tidak boleh kosong',
                            ],
                            'jumlah' => [
                                'required' => 'Jumlah tidak boleh kosong',
                            ]
                        ]
                )
                ){
                //kirim data error ke views, karena ada isian yang tidak sesuai rules
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Pakai/InputPakai',[
                    'validation' => $this->validator,
                ]);
                echo view('FooterBootstrap');


            }else{
                //blok ini adalah blok jika sukses, yaitu panggil method insertData()
                //panggil metod dari kosan model untuk diinputkan datanya
                
                $hasil = $this->PakaiModel->insertData();
                if($hasil->connID->affected_rows>0){
                    ?>
                    <script type="text/javascript">
                        alert("Data berhasil ditambahkan");
                    </script>
                    <?php	
                }
                $data['pakai'] = $this->PakaiModel->getAll();
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Pakai/ListPakai', $data);
                echo view('FooterBootstrap');

            }
        }
	}

    public function editPakai($no_pakai){

        $data['pakai'] = $this->PakaiModel->editData($no_pakai);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pakai/EditPakai', $data);
        echo view('FooterBootstrap');

    }

    public function editPakaiproses(){

        $no_pakai = $_POST['no_pakai'];
        $nama_kandang = $_POST['nama_kandang'];
        $nama_ayam = $_POST['nama_ayam'];
        $nama_pakan = $_POST['nama_pakan'];
        $jumlah = $_POST['jumlah'];

        $validation =  \Config\Services::validation();

        if (! $this->validate(
            [
                    'nama_kandang' => 'required',
                    'nama_ayam' => 'required',
                    'nama_pakan' => 'required',
                    'jumlah' => 'required'
            ],
                    [   // Errors
                        'nama_kandang' => [
                            'required' => 'Nama Kandang tidak boleh kosong',   
                        ],
                        'nama_ayam' => [
                            'required' => 'Nama Ayam tidak boleh kosong',
                        ],
                        'nama_pakan' => [
                            'required' => 'Nama Pakan tidak boleh kosong',
                        ],
                        'jumlah' => [
                            'required' => 'Jumlah tidak boleh kosong',
                        ]
                    ]
        ))
        {                
            
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Pakai/EditPakai',[
                'validation' => $this->validator,
                'pakai' => $this->PakaiModel->editData($no_pakai)
            ]);
            echo view('FooterBootstrap');


        }
        else
        {
            //panggil metod dari Pakai model untuk diinputkan datanya
            $hasil = $this->PakaiModel->updateData();
            if($hasil->connID->affected_rows>0){
                ?>
                <script type="text/javascript">
                    alert("Berhasil mengubah data");
                </script>
                <?php	
            }
            $data['pakai'] = $this->PakaiModel->getAll();
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Pakai/ListPakai', $data);
            echo view('FooterBootstrap');

        }    
    }

    public function deletePakai($no_pakai){
        
		$this->PakaiModel->deleteData($no_pakai);

		return redirect()->to(base_url('Pakai/ListPakai')); 
	}

    public function ListPakai()
    {
        $data['pakai'] = $this->PakaiModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pakai/ListPakai', $data);
        echo view('FooterBootstrap');

    }
}