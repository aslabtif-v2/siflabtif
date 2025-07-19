<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_pembayaran extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models'));
		$this->load->helper(array('url','form'));
		session_start();
		if(!isset($_SESSION['password'])||($_SESSION['jabatan']!='adminsistem')){
			redirect(base_url());
		}
	}
	
	function index(){
		$data['kelas'] = $this->models->where1menurun('kelas','kls_status',1,'kelas','asc');
		$data['view'] = 'admin/pembayaran/pembayaran';
		$this->load->view('admin/template',$data);
	}
	
	function kelas($id_kelas){
		$data['kelas'] = $this->models->where1menurun('kelas','kls_status',1,'kelas','asc');
		$data['mhs'] = $this->models->tabel2where2order('mahasiswa','kelas','id_kelas','mahasiswa.id_kelas',$id_kelas,'kls_status',1,'nama','asc');
		$data['view'] = 'admin/pembayaran/pembayaran';
		$this->load->view('admin/template',$data);
	}
	
	function status_bayaran(){
		$npm = $this->input->post('npm');
		$respon = $this->input->post('status');
		
		if($respon=='Lunas'){
			$data = array('byr_status'=>1);
			$this->models->update('mahasiswa','npm',$npm,$data);
		}
		else{ //if($respon=='Belum Lunas'){
			$data = array('byr_status'=>0);
			$this->models->update('mahasiswa','npm',$npm,$data);
		}
		echo $respon;
	}
}
?>