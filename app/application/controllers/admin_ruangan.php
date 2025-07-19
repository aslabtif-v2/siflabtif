<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_ruangan extends CI_Controller {
	
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
		$data['ruangan'] = $this->models->lihat_menurun('ruangan','ASC','ruangan');
		$data['view'] = 'admin/ruangan/ruangan';
		$this->load->view('admin/template',$data);
	}
	
	function tambah_ruangan(){
		$data['view'] = 'admin/ruangan/ruangan-tambah';
		$this->load->view('admin/template',$data);
	}
	
	function edit_ruangan($id_ruangan){
		$data['ruangan'] = $this->models->where1('ruangan','id_ruangan',$id_ruangan);
		$data['view'] = 'admin/ruangan/ruangan-edit';
		$this->load->view('admin/template',$data);
	}
	
	//proses
	function post_ruangan(){
		$ruangan = $this->input->post('ruangan');
		$data =  array(
				'id_ruangan'=>'',
				'ruangan'=>$ruangan
			);		
		$this->db->insert('ruangan',$data);
		redirect('admin_ruangan');
	}
	
	function update_ruangan(){
		$id_ruangan = $this->input->post('id_ruangan');
		$ruangan = $this->input->post('ruangan');
		$data =  array(
				'ruangan'=>$ruangan
			);		
		$this->models->update('ruangan','id_ruangan',$id_ruangan,$data);
		redirect('admin_ruangan');
	}
	
	function hapus_ruangan($id_ruangan){
		$this->models->hapus('ruangan','id_ruangan',$id_ruangan);
		redirect('admin_ruangan');
	}
}
?>