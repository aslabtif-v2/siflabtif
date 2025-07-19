<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asisten_kehadiran extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models','admin_absen_models'));
		$this->load->helper(array('url','form'));
		$this->load->library('encrypt');
		session_start();
		if(!isset($_SESSION['password'])){
			redirect(base_url());
		}
	}
	
	function index(){
		$data['asisten'] = $this->models->where1Row('asisten','id_asisten',$_SESSION['id_asisten']);
		$data['jadwal'] = $this->db->query("SELECT id_praktikum FROM penjadwalan WHERE (pengajar1='".$_SESSION['id_asisten']."' OR pengajar2='".$_SESSION['id_asisten']."') AND STATUS='1'")->result();
		$data['view'] = 'asisten/kehadiran/kehadiran';
		$this->load->view('asisten/template',$data);
	}
}
?>