<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asisten_jadwal_praktikum extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models','admin_jadwal_models'));
		$this->load->helper(array('url'));
		date_default_timezone_set('Asia/Jakarta');
		session_start();
		if(!isset($_SESSION['password'])||($_SESSION['jabatan']!='koordinatorlab')){
			redirect(base_url());
		}
	}
	
	function index(){
		$namaBulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$namaHari = array("Minggu","Senin", "Selasa", "Rabu", "Kamis", "Jumat","Sabtu");
		$data['hari'] = $namaHari[date('w')];
		$data['bulan'] = $namaBulan[(date('n')-1)];
		$data['penjadwalan'] = $this->admin_jadwal_models->praktikum($namaHari[date('w')]);
		$data['view'] = 'asisten/jadwal/jadwal';
		$this->load->view('asisten/template',$data);
	}
	
	function hari($hari){
		$namaBulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$data['namaHari'] = array("Minggu","Senin", "Selasa", "Rabu", "Kamis", "Jumat","Sabtu");
		$data['hari'] = $hari;
		$data['bulan'] = $namaBulan[(date('n')-1)];
		$data['penjadwalan'] = $this->admin_jadwal_models->praktikum($hari);
		$data['view'] = 'asisten/jadwal/jadwal-pilih';
		$this->load->view('asisten/template',$data);
	}
}