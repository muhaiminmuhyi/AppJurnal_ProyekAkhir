<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
class Dashboard extends BaseController 
{
    public function index(){
        $session = session();
        echo view('HeaderBootstrap');
		echo view('SidebarBootstrap');
		echo view('BodyBootstrap');
        echo view('FooterBootstrap');
    }
}
?>