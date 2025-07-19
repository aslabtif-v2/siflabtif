<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asisten_penilaian extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models','admin_penilaian_models','admin_absen_models'));
		$this->load->helper(array('url','form'));
		session_start();
		if(!isset($_SESSION['password'])){
			redirect(base_url());
		}
	}
	
	function index(){
		$data['praktikum'] = $this->admin_absen_models->id_praktikum($_SESSION['id_asisten']);
		$data['view'] = 'asisten/penilaian/kosong';
		$this->load->view('asisten/template',$data);
	}
	
	function penilaian($id_praktikum){
		$data['praktikum'] = $this->admin_absen_models->id_praktikum($_SESSION['id_asisten']);
		$data['id_praktikum'] = $id_praktikum;
		$data['persentase'] = $this->models->where1Row('penjadwalan','id_praktikum',$id_praktikum);
		$data['mahasiswa'] = $this->admin_penilaian_models->nilai_mahasiswa($id_praktikum);
		$data['view'] = 'asisten/penilaian/penilaian';
		$this->load->view('asisten/template',$data);
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
		$data['view'] = 'asisten/penilaian/penilaian-edit-persentase';
		$this->load->view('asisten/template',$data);
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
		redirect('asisten_penilaian/penilaian/'.$id_praktikum);
	}
}
?>