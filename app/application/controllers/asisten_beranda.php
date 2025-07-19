<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asisten_beranda extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models'));
		$this->load->helper(array('url'));
		date_default_timezone_set('Asia/Jakarta');
		session_start();
		if(!isset($_SESSION['password'])){
			redirect(base_url());
		}
	}
	
	function index(){
		$data['informasi'] = $this->models->where1menurun('informasi','status',1,'id_informasi','DESC');
		$namaHari = array("  ", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu","Minggu");
		$namaBulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$data['namaBulan'] = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$data['hari'] = $namaHari[date('N')];
		$data['bulan'] = $namaBulan[(date('n')-1)];
		$data['semua_asisten'] = $this->models->where1menurun('asisten','status',1,'nama','ASC');
		$data['asisten'] = $this->models->where1Row('asisten','id_asisten',$_SESSION['id_asisten']);
		$data['view'] = 'asisten/beranda/beranda';
		$this->load->view('asisten/template',$data);
	}
}