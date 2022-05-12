<?php
namespace App\Controllers;

use App\Models\PakanModel;

class Pakan extends BaseController
{
	public function __construct()
    {
        //load kelas PakanModel
        $this->PakanModel = new PakanModel();
        helper('rupiah');
    }

    //form input akan diakses dari index
    public function index()
	{
        //di cek dulu, agar validasi tidak terpicu pada saat awal method ini diakses
        if( !isset($_POST['id_pakan']) and
            !isset($_POST['nama_pakan']) and !isset($_POST['harga_jual']) and 
            !isset($_POST['harga_beli']) and
            !isset($_POST['jenis_pakan'])){
            //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Pakan/InputPakan');
        }
        else{
            $validation =  \Config\Services::validation();
            //di cek dulu apakah data isian memenuhi rules validasi yang dibuat
            if (! $this->validate(
                [
                    'id_pakan' => 'required|is_unique[Pakan.id_pakan]',
                    'nama_pakan' => 'required',
                    'harga_jual' => 'required',
                    'harga_beli' => 'required',
                    'jenis_pakan' => 'required'
                ],
                        [   // Errors
                            'id_pakan' => [
                                'required' => 'ID Pakan tidak boleh kosong',   
                                'is_unique'=> 'ID Pakan tidak boleh sama'
                            ],
                            'nama_pakan' => [
                                'required' => 'Nama Pakan tidak boleh kosong',   
                            ],
                            'harga_jual' => [
                                'required' => 'Harga Jual tidak boleh kosong',
                            ],
                            'harga_beli' => [
                                'required' => 'Harga Beli tidak boleh kosong',
                            ],
                            'jenis_pakan' => [
                                'required' => 'Jenis Pakan tidak boleh kosong',
                            ]
                        ]
                )
                ){
                //kirim data error ke views, karena ada isian yang tidak sesuai rules
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Pakan/InputPakan',[
                    'validation' => $this->validator,
                ]);

            }else{
                //blok ini adalah blok jika sukses, yaitu panggil method insertData()
                //panggil metod dari kosan model untuk diinputkan datanya
                
                $hasil = $this->PakanModel->insertData();
                if($hasil->connID->affected_rows>0){
                    ?>
                    <script type="text/javascript">
                        alert("Data berhasil ditambahkan");
                    </script>
                    <?php	
                }
                $data['pakan'] = $this->PakanModel->getAll();
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Pakan/ListPakan', $data);
            }
        }
	}

    public function editPakan($id_pakan){

        $data['pakan'] = $this->PakanModel->editData($id_pakan);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pakan/EditPakan', $data);
    }

    public function editPakanproses(){

        $id_pakan = $_POST['id_pakan'];
        $nama_pakan = $_POST['nama_pakan'];
        $harga_jual = $_POST['harga_jual'];
        $harga_beli = $_POST['harga_beli'];
        $jenis_pakan = $_POST['jenis_pakan'];
        $satuan = $_POST['satuan'];

        $validation =  \Config\Services::validation();

        if (! $this->validate(
            [
                    'nama_pakan' => 'required',
                    'harga_jual' => 'required',
                    'harga_beli' => 'required',
                    'jenis_pakan' => 'required'
            ],
                    [   // Errors
                            'nama_pakan' => [
                                'required' => 'Nama Pakan tidak boleh kosong',   
                            ],
                            'harga_jual' => [
                                'required' => 'Harga Jual tidak boleh kosong',
                            ],
                            'harga_beli' => [
                                'required' => 'Harga Beli tidak boleh kosong',
                            ],
                            'jenis_pakan' => [
                                'required' => 'Jenis Pakan tidak boleh kosong',
                            ]
                    ]
        ))
        {                
            
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Pakan/EditPakan',[
                'validation' => $this->validator,
                'pakan' => $this->PakanModel->editData($id_pakan)
            ]);

        }
        else
        {
            //panggil metod dari Pakan model untuk diinputkan datanya
            $hasil = $this->PakanModel->updateData();
            if($hasil->connID->affected_rows>0){
                ?>
                <script type="text/javascript">
                    alert("Berhasil mengubah data");
                </script>
                <?php	
            }
            $data['pakan'] = $this->PakanModel->getAll();
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Pakan/ListPakan', $data);
        }    
    }

    public function deletePakan($id_pakan){
        
		$this->PakanModel->deleteData($id_pakan);

		return redirect()->to(base_url('Pakan/ListPakan')); 
	}

    public function ListPakan()
    {
        $data['pakan'] = $this->PakanModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pakan/ListPakan', $data);
    }
}