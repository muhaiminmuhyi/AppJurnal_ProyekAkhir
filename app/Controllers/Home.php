<?php

namespace App\Controllers;
use App\Models\AkunModel;

class Home extends BaseController
{
	public function __construct()
    {
		session_start();
        //load kelas AkunModel
        $this->akunmodel = new AkunModel();
    }
	public function index()
	{
		return view('login');
	//	return view('welcome_message');
	}
	public function ceklogin()
	{
		
		$hasil = $this->akunmodel->cekUsernamePwd();

		//iterasi hasil query
		foreach ($hasil as $row)
		{
			$jml = $row->jml;
		}
		
		//nilai jml adalah 1 menunjukkan bahwa pasangan username dan password cocok
		if($jml>0){	
			//dapatkan waktu last login
			$hasil = $this->akunmodel->getlastlogin($_POST['inputUsername']);

			//kembalikan hasil last_login yang tercatat di database
			foreach ($hasil as $row)
			{
				$lastlogin = $row->last_login;
			}
			//ciptakan sesi untuk user
			$_SESSION['nama'] = $_POST['inputUsername'];
			$_SESSION['lastlogin'] = $lastlogin;
			echo view('HeaderBootstrap');
			echo view('SidebarBootstrap');
			echo view('BodyBootstrap');
		}else{
			//jika tidak sama maka dikembalikan ke ceklogin
			$data['pesan'] = 'Pasangan username dan password tidak tepat';
			
return view('login', $data);
		}
	} 
	//destroy session ketika logout
	public function logout()
	{
        //$this->session->destroy();
		session_destroy();
		return redirect()->to(base_url('home')); 
	}
}