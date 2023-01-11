<?php
namespace App\Controllers;

use App\Models\PemasokModel;

class Pemasok extends BaseController
{
	public function __construct()
    {
        $session = session();
        //load kelas PemasokModel
        $this->PemasokModel = new PemasokModel();
    }

    //form input akan diakses dari index
    public function index()
	{
        //di cek dulu, agar validasi tidak terpicu pada saat awal method ini diakses
        if( !isset($_POST['id_pemasok']) and
            !isset($_POST['nm_pemasok']) and !isset($_POST['alamat']) and 
            !isset($_POST['no_telp']) and !isset($_POST['email']) ){
            //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Pemasok/InputPemasok');
            echo view('FooterBootstrap');
        }
        else{
            $validation =  \Config\Services::validation();
            //di cek dulu apakah data isian memenuhi rules validasi yang dibuat
            if (! $this->validate(
                [
                    'id_pemasok' => 'required|is_unique[Pemasok.id_pemasok]',
                    'nm_pemasok' => 'required',
                    'alamat' => 'required',
                    'no_telp' => 'required',
                    'email' => 'required'
                ],
                        [   // Errors
                            'id_pemasok' => [
                                'required' => 'ID Pemasok tidak boleh kosong',   
                                'is_unique'=> 'ID Pemasok tidak boleh sama'
                            ],
                            'nm_pemasok' => [
                                'required' => 'Nama Pemasok tidak boleh kosong',   
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
                echo view('Pemasok/InputPemasok',[
                    'validation' => $this->validator,
                ]);
                echo view('FooterBootstrap');


            }else{
                //blok ini adalah blok jika sukses, yaitu panggil method insertData()
                //panggil metod dari kosan model untuk diinputkan datanya
                
                $hasil = $this->PemasokModel->insertData();
                if($hasil == true){
                    ?>
                    <script type="text/javascript">
                        alert("Data berhasil ditambahkan");
                    </script>
                    <?php	
                }
                $data['pemasok'] = $this->PemasokModel->getAll();
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Pemasok/ListPemasok', $data);
                echo view('FooterBootstrap');
            }
        }
	}

    public function editPemasok($id_pemasok){

        $data['pemasok'] = $this->PemasokModel->editData($id_pemasok);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pemasok/EditPemasok', $data);
        echo view('FooterBootstrap');
    }

    public function editPemasokproses(){

        $id_pemasok = $_POST['id_pemasok'];
        $nm_pemasok = $_POST['nm_pemasok'];
        $alamat = $_POST['alamat'];
        $no_telp = $_POST['no_telp'];
        $email = $_POST['email'];

        $validation =  \Config\Services::validation();

        if (! $this->validate(
            [
                    'nm_pemasok' => 'required',
                    'alamat' => 'required',
                    'no_telp' => 'required',
                    'email' => 'required'
            ],
                    [   // Errors
                            'nm_pemasok' => [
                                'required' => 'Nama Pemasok tidak boleh kosong',   
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
            echo view('Pemasok/EditPemasok',[
                'validation' => $this->validator,
                'pemasok' => $this->PemasokModel->editData($id_pemasok)
            ]);
            echo view('FooterBootstrap');
        }
        else
        {
            //panggil metod dari Pemasok model untuk diinputkan datanya
            $hasil = $this->PemasokModel->updateData();
            if($hasil == true){
                ?>
                <script type="text/javascript">
                    alert("Berhasil mengubah data");
                </script>
                <?php	
            }
            $data['pemasok'] = $this->PemasokModel->getAll();
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Pemasok/ListPemasok', $data);
            echo view('FooterBootstrap');
        }    
    }

    public function deletePemasok($id_pemasok){
        
		$this->PemasokModel->deleteData($id_pemasok);

		return redirect()->to(base_url('Pemasok/ListPemasok')); 
	}

    public function ListPemasok()
    {
        $data['pemasok'] = $this->PemasokModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pemasok/ListPemasok', $data);
        echo view('FooterBootstrap');
    }
}