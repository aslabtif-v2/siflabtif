<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_kategori extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models','admin_kategori_models'));
		$this->load->helper(array('url','form'));
		date_default_timezone_set('Asia/Jakarta');
		session_start();
		if(!isset($_SESSION['password'])||($_SESSION['jabatan']!='adminsistem')){
			redirect(base_url());
		}
	}
	
	function view($jenis=null){
		$data['jenis'] = $this->admin_kategori_models->kategori();
		$data['kategori'] = $this->models->where1menurun('codexd','code_kate',$jenis,'code_desc','ASC');
		$data['view'] = 'admin/kategori/kategori';
		$this->load->view('admin/template',$data);
	}
	
	function tambah(){
		$data['uri3'] = $this->uri->segment(3);
		$data['jenis'] = $this->admin_kategori_models->kategori();
		$data['view'] = 'admin/kategori/kategori-tambah';
		$this->load->view('admin/template',$data);
	}
	
	function edit($code_id){
		$data['code'] = $this->models->where1Row('codexd','code_id',$code_id);
		$data['jenis'] = $this->admin_kategori_models->kategori();
		$data['view'] = 'admin/kategori/kategori-edit';
		$this->load->view('admin/template',$data);
	}
	
	function post(){
		$jenis = $this->input->post('jenis');
		$kategori = $this->input->post('kategori');
		
		$data = array(
				'code_kate'=>$jenis,
				'code_desc'=>$kategori
			);
		$this->db->insert('codexd',$data);
		redirect('admin_kategori/view/'.$jenis);
	}
	
	function update($code_id){
		$jenis = $this->input->post('jenis');
		$kategori = $this->input->post('kategori');
		
		$data = array(
				'code_kate'=>$jenis,
				'code_desc'=>$kategori
			);
		$this->models->update('codexd','code_id',$code_id,$data);
		redirect('admin_kategori/view/'.$jenis);
	}
	
	function hapus($code_id){
		$code = $this->models->where1Row('codexd','code_id',$code_id);
		$this->models->hapus('codexd','code_id',$code_id);	
		redirect('admin_kategori/view/'.$code->code_kate);
	}
}