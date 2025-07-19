<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asisten_catatan extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models'));
		$this->load->helper(array('url','form'));
		date_default_timezone_set('Asia/Jakarta');
		session_start();
		if(!isset($_SESSION['password'])){
			redirect(base_url());
		}
	}
	
	function index(){
		$data['catatan'] = $this->models->where1menurun('catatan','id_asisten',$_SESSION['id_asisten'],'tanggal','DESC');
		$data['namaBulan'] = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$data['view'] = 'asisten/catatan/catatan';
		$this->load->view('asisten/template',$data);
	}
	
	function tambah_catatan(){
		$data['view'] = 'asisten/catatan/catatan-tambah';
		$this->load->view('asisten/template',$data);
	}
	
	function edit($id){
		$data['catatan'] = $this->models->where1Row('catatan','id_cat',$id);
		$data['view'] = 'asisten/catatan/catatan-edit';
		$this->load->view('asisten/template',$data);
	}
	
	function lihat($id){
		$data['catatan'] = $this->models->where1Row('catatan','id_cat',$id);
		$data['view'] = 'asisten/catatan/catatan-lihat';
		$this->load->view('asisten/template',$data);
	}
	
	//proses
	function simpan(){
		$nama = $this->input->post('namacat');
		$catatan = $this->input->post('catatan');	
		$data = array(
				'id_cat'=>'',
				'id_asisten'=>$_SESSION['id_asisten'],
				'nama_cat'=>$nama,
				'catatan'=>$catatan,
				'tanggal'=>date('Ymd')
			);
		$this->db->insert('catatan',$data);
		redirect('asisten_catatan');	
	}
	
	function update(){
		$id = $this->input->post('id_cat');
		$nama = $this->input->post('namacat');
		$catatan = $this->input->post('catatan');	
		$data = array(
				'nama_cat'=>$nama,
				'catatan'=>$catatan,
				'tanggal'=>date('Ymd')
			);
		$this->models->update('catatan','id_cat',$id,$data);
		redirect('asisten_catatan');	
	}
	
	function hapus($id){
		$this->models->hapus('catatan','id_cat',$id);
		redirect('asisten_catatan');	
	}
}