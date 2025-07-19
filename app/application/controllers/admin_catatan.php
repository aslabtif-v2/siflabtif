<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_catatan extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models','admin_registrasi_models','admin_penilaian_models'));
		$this->load->helper(array('url','form'));
		session_start();
		if(!isset($_SESSION['password'])||($_SESSION['jabatan']!='adminsistem')){
			redirect(base_url());
		}
	}
	
	function index(){
		$data['asisten'] = $this->models->where1menurun('asisten','status',1,'nama','ASC');
		$data['view'] = 'admin/catatan/catatan';
		$this->load->view('admin/template',$data);
	}
	
	function listt($id_as){
		$data['namaBulan'] = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$data['asisten'] = $this->models->where1menurun('asisten','status',1,'nama','ASC');
		$data['catatan'] = $this->models->where1menurun('catatan','id_asisten',$id_as,'tanggal','desc');
		$data['view'] = 'admin/catatan/catatan';
		$this->load->view('admin/template',$data);
	}
	
	function lihat($id_cat){
		$data['asisten'] = $this->models->where1menurun('asisten','status',1,'nama','ASC');
		$data['catatan'] = $this->models->where1Row('catatan','id_cat',$id_cat);
		$data['view'] = 'admin/catatan/catatan-lihat';
		$this->load->view('admin/template',$data);
	}
	
	function hapus($id,$id_asisten){
		$this->models->hapus('catatan','id_cat',$id);
		redirect('admin_catatan/listt/'.$id_asisten);	
	}
}
?>