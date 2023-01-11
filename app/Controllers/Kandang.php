<?php
namespace App\Controllers;

use App\Models\KandangModel;

class Kandang extends BaseController
{
	public function __construct()
    {
        $session = session();
        //load kelas KandangModel
        $this->KandangModel = new KandangModel();
    }

    //form input akan diakses dari index
    public function index()
	{
        //di cek dulu, agar validasi tidak terpicu pada saat awal method ini diakses
        if( !isset($_POST['id_kandang']) and
            !isset($_POST['nama_kandang']) ){
            //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Kandang/InputKandang');
            echo view('FooterBootstrap');
        }
        else{
            $validation =  \Config\Services::validation();
            //di cek dulu apakah data isian memenuhi rules validasi yang dibuat
            if (! $this->validate(
                [
                    'id_kandang' => 'required|is_unique[Kandang.id_kandang]',
                    'nama_kandang' => 'required'
                ],
                        [   // Errors
                            'id_kandang' => [
                                'required' => 'ID Kandang tidak boleh kosong',   
                                'is_unique'=> 'ID Kandang tidak boleh sama'
                            ],
                            'nama_kandang' => [
                                'required' => 'Nama Kandang tidak boleh kosong',   
                            ]
                        ]
                )
                ){
                //kirim data error ke views, karena ada isian yang tidak sesuai rules
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Kandang/InputKandang',[
                    'validation' => $this->validator,
                ]);
                echo view('FooterBootstrap');

            }else{
                //blok ini adalah blok jika sukses, yaitu panggil method insertData()
                //panggil metod dari kosan model untuk diinputkan datanya
                
                $hasil = $this->KandangModel->insertData();
                if($hasil == true){
                    ?>
                    <script type="text/javascript">
                        alert("Data berhasil ditambahkan");
                    </script>
                    <?php	
                }
                $data['kandang'] = $this->KandangModel->getAll();
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Kandang/ListKandang', $data);
                echo view('FooterBootstrap');
            }
        }
	}

    public function editKandang($id_kandang){

        $data['kandang'] = $this->KandangModel->editData($id_kandang);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Kandang/EditKandang', $data);
        echo view('FooterBootstrap');
    }

    public function editKandangproses(){

        $id_kandang = $_POST['id_kandang'];
        $nama_kandang = $_POST['nama_kandang'];
        $jenis_kandang = $_POST['jenis_kandang'];

        $validation =  \Config\Services::validation();

        if (! $this->validate(
            [
                    'nama_kandang' => 'required'
            ],
                    [   // Errors
                            'nama_kandang' => [
                                'required' => 'Nama Kandang tidak boleh kosong',   
                            ]
                    ]
        ))
        {                
            
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Kandang/EditKandang',[
                'validation' => $this->validator,
                'kandang' => $this->KandangModel->editData($id_kandang)
            ]);
            echo view('FooterBootstrap');


        }
        else
        {
            //panggil metod dari Kandang model untuk diinputkan datanya
            $hasil = $this->KandangModel->updateData();
            if($hasil == true){
                ?>
                <script type="text/javascript">
                    alert("Berhasil mengubah data");
                </script>
                <?php	
            }
            $data['kandang'] = $this->KandangModel->getAll();
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Kandang/ListKandang', $data);
            echo view('FooterBootstrap');

        }    
    }

    public function deleteKandang($id_kandang){
        
		$this->KandangModel->deleteData($id_kandang);

		return redirect()->to(base_url('Kandang/ListKandang')); 
	}

    public function ListKandang()
    {
        $data['kandang'] = $this->KandangModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Kandang/ListKandang', $data);
        echo view('FooterBootstrap');
    }
}