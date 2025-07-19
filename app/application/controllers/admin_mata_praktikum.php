<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_mata_praktikum extends CI_Controller {
	
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
		$data['matkum'] = $this->models->lihat_menurun('mata_praktikum','ASC','mata_praktikum');
		$data['view'] = 'admin/mata_praktikum/mata_praktikum';
		$this->load->view('admin/template',$data);
	}
	
	function tambah_matkum(){
		$data['view'] = 'admin/mata_praktikum/mata_praktikum-tambah';
		$this->load->view('admin/template',$data);
	}
	
	function edit_matkum($id_matkum){
		$data['matkum'] = $this->models->where1('mata_praktikum','id_matkum',$id_matkum);
		$data['view'] = 'admin/mata_praktikum/mata_praktikum-edit';
		$this->load->view('admin/template',$data);
	}
	
	//proses
	function post_matkum(){
		$matkum = $this->input->post('matkum');
		$data = array(
				'id_matkum'=>'',
				'mata_praktikum'=>$matkum
			);	
		$this->db->insert('mata_praktikum',$data);
		redirect('admin_mata_praktikum');
	}
	
	function update_matkum(){
		$id_matkum = $this->input->post('id_matkum');
		$matkum = $this->input->post('matkum');
		$data = array(
				'mata_praktikum'=>$matkum
			);	
		$this->models->update('mata_praktikum','id_matkum',$id_matkum,$data);
		redirect('admin_mata_praktikum');
	}
	
	function hapus_matkum($id_matkum){
		$this->models->hapus('mata_praktikum','id_matkum',$id_matkum);
		redirect('admin_mata_praktikum');
	}
}
?>