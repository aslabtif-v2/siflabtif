<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_penilaian extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models','admin_penilaian_models'));
		$this->load->helper(array('url','form'));
		session_start();
		if(!isset($_SESSION['password'])||($_SESSION['jabatan']!='adminsistem')){
			redirect(base_url());
		}
	}
	
	function index(){
		$data['praktikum'] = $this->models->where1menurun('penjadwalan','status',1,'id_praktikum','ASC');
		$data['view'] = 'admin/penilaian/kosong';
		$this->load->view('admin/template',$data);
	}
	
	function penilaian($id_praktikum){
		$data['praktikum'] = $this->models->where1menurun('penjadwalan','status',1,'id_praktikum','ASC');
		$data['id_praktikum'] = $id_praktikum;
		$data['persentase'] = $this->models->where1Row('penjadwalan','id_praktikum',$id_praktikum);
		$data['mahasiswa'] = $this->admin_penilaian_models->nilai_mahasiswa($id_praktikum);
		$data['view'] = 'admin/penilaian/penilaian';
		$this->load->view('admin/template',$data);
	}
	
	function nilai(){
		$id_praktikum = $this->input->post('id_praktikum');
		$id_regis = $this->input->post('id_regis');
		$tugas = $this->input->post('tugas');
		$ujian = $this->input->post('ujian');
		$data = array(
				'tugas'=>$tugas,
				'ujian'=>$ujian
			);
		$this->models->update('registrasi_praktikum','id_registrasi',$id_regis,$data);	
	}
	
	function edit_persentase($id_praktikum){
		$data['persentase'] = $this->models->where1Row('penjadwalan','id_praktikum',$id_praktikum);
		$data['view'] = 'admin/penilaian/penilaian-edit-persentase';
		$this->load->view('admin/template',$data);
	}
	
	function update_persentase(){
		$id_praktikum = $this->input->post('id_praktikum');
		$kehadiran = $this->input->post('kehadiran');
		$tugas = $this->input->post('tugas');
		$ujian = $this->input->post('ujian');	
		$data = array(
				'kehadiran'=>$kehadiran,
				'tugas'=>$tugas,
				'ujian'=>$ujian
			);
		$this->models->update('penjadwalan','id_praktikum',$id_praktikum,$data);
		redirect('admin_penilaian/penilaian/'.$id_praktikum);
	}
}
?>