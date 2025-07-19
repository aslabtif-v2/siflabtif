<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models'));
		$this->load->helper(array('url'));
		$this->load->library('encrypt');
		date_default_timezone_set('Asia/Jakarta');
	}
	
	function index(){
		$this->load->view('login');
	}
	
	function proses_login(){
		session_start();
		$username=$this->input->post('username');
		$password = $this->input->post('password');
		$data=$this->models->where2('asisten','username','status',$username,1);
		$jabatan = '';
		$i=0;	
		foreach($data as $item){
			if($this->encrypt->decode($item->password)==$password){
				$i++;
				$_SESSION['namajabatan'] = $this->models->where1Row('jabatan','id_jabatan',$item->id_jabatan)->jabatan;
				$_SESSION['jabatan'] = $item->id_jabatan;
				$jabatan = $item->id_jabatan;
				$_SESSION['nama'] = $item->nama;
				$_SESSION['id_asisten'] = $item->id_asisten;
				$_SESSION['username']=$username;
				$_SESSION['password']=$password;
			}
		}
		if($i==1){
			if($jabatan!='adminsistem'){
				echo 'sukses| |index.php/asisten_beranda';				
			}
			else{
				echo 'sukses| |index.php/admin_beranda';	
			}	
		}
		else{
			echo 'gagal|Maaf, username atau password anda salah, silahkan coba lagi.';
		}
	}
	
	function logout(){
		session_start();	
		unset($_SESSION['username']);
		unset($_SESSION['password']);
		unset($_SESSION['jabatan']);
		unset($_SESSION['namajabatan']);
		unset($_SESSION['nama']);		
		unset($_SESSION['id_asisten']);
		redirect('');	
	}
}