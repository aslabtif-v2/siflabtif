<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_kehadiran_asisten extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models','admin_absen_models'));
		$this->load->helper(array('url','form'));
		session_start();
		if(!isset($_SESSION['password'])||($_SESSION['jabatan']!='adminsistem')&&($_SESSION['jabatan']!='koordinatorlab')){
			redirect(base_url());
		}
	}
	
	function cek($id_asisten=null){
		$data['asisten'] = $this->models->where1menurun('asisten','status',1,'nama','ASC');
		$data['id_asisten'] = $id_asisten;
		
		if($id_asisten!=null){
			$data['jadwal'] = $this->db->query("SELECT id_praktikum FROM penjadwalan WHERE (pengajar1='".$id_asisten."' OR pengajar2='".$id_asisten."') AND STATUS='1'")->result();
		}
		else{
			$data['jadwal'] = array();
		}
		$data['view'] = 'admin/kehadiran/kehadiran';
		
		if($_SESSION['jabatan']=='adminsistem'){
			$halaman = "admin";
		}
		else if($_SESSION['jabatan']=='koordinatorlab'){
			$halaman = "asisten";
		}
		$data['halaman'] = $halaman;
		$this->load->view($halaman.'/template',$data);
	}
}
?>