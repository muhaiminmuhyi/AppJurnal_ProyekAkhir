<?php
namespace App\Controllers;

use App\Models\CoaModel;

class Coa extends BaseController
{
	public function __construct()
    {
        //load kelas CoaModel
        $session = session();
        $this->CoaModel = new CoaModel();
    }

    //form input akan diakses dari index
    public function index()
	{
        //di cek dulu, agar validasi tidak terpicu pada saat awal method ini diakses
        if( !isset($_POST['kode_coa']) and !isset($_POST['nama_coa']) ){
            //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Coa/InputCoa');
            echo view('FooterBootstrap');
        }
        else{
            $validation =  \Config\Services::validation();
            //di cek dulu apakah data isian memenuhi rules validasi yang dibuat
            if (! $this->validate(
                [
                    'kode_coa' => 'required|is_natural|is_unique[Coa.kode_coa]',
                    'nama_coa' => 'required|min_length[3]'
                ],
                        [   // Errors
                            'kode_coa' => [
                                'required' => 'kode tidak boleh kosong',   
                                'is_natural' => 'kode harus dalam angka  (0 s/d 9)',
                                'is_unique'=> 'kode coa tidak boleh sama'
                            ],
                            
                            'nama_coa' => [
                                'required' => 'Nama coa tidak boleh kosong',
                                'min_length' => 'panjang karakter harus lebih besar dari 3'
                            ]
                        ]
                )
                ){
                //kirim data error ke views, karena ada isian yang tidak sesuai rules
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Coa/InputCoa',[
                    'validation' => $this->validator,
                ]);
                echo view('FooterBootstrap');

            }else{
                //blok ini adalah blok jika sukses, yaitu panggil method insertData()
                //panggil metod dari kosan model untuk diinputkan datanya
                
                $hasil = $this->CoaModel->insertData();
                if($hasil == true){
                    ?>
                    <script type="text/javascript">
                        alert("Data berhasil ditambahkan");
                    </script>
                    <?php	
                }
                $data['coa'] = $this->CoaModel->getAll();
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Coa/ListCoa', $data);
                echo view('FooterBootstrap');
            }
        }
	}

    public function editCoa($kode_coa){


        $data['coa'] = $this->CoaModel->editData($kode_coa);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Coa/EditCoa', $data);
        echo view('FooterBootstrap');
    }

    public function editCoaproses(){

        $kode_coa = $_POST['kode_coa'];
        $nama_coa = $_POST['nama_coa'];

        $validation =  \Config\Services::validation();

        if (! $this->validate(
            [
                'nama_coa' => 'required|min_length[3]'
            ],
                    [   // Errors
                        
                        'nama_coa' => [
                            'required' => 'Nama coa tidak boleh kosong',
                            'min_length' => 'panjang karakter harus lebih besar dari 3'
                        ]
                    ]
        ))
        {                
            
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Coa/EditCoa',[
                'validation' => $this->validator,
                'coa' => $this->CoaModel->editData($kode_coa)
            ]);
            echo view('FooterBootstrap');

        }
        else
        {
            //panggil metod dari Coa model untuk diinputkan datanya
            $hasil = $this->CoaModel->updateData();
            if($hasil == true){
                ?>
                <script type="text/javascript">
                    alert("Berhasil mengubah data");
                </script>
                <?php	
            }
            $data['Coa'] = $this->CoaModel->getAll();
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Coa/ListCoa', $data);
            echo view('FooterBootstrap');
        }    
    }

    public function deleteCoa($kode_coa){
        
		$this->CoaModel->deleteData($kode_coa);

		return redirect()->to(base_url('Coa/ListCoa')); 
	}

    public function ListCoa()
    {
        $data['coa'] = $this->CoaModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Coa/ListCoa', $data);
        echo view('FooterBootstrap');
    }
}