<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_shutdown extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models','admin_mhs_models'));
		$this->load->helper(array('url','form'));
		session_start();
		if(!isset($_SESSION['password'])||($_SESSION['jabatan']!='adminsistem')&&($_SESSION['jabatan']!='koordinatorlab')){
			redirect(base_url());
		}
	}
	
	function setting(){
		$data['s'] = $this->models->where1Row('timer','tmr_jenis','shutdown');
		$data['hari'] = array("Senin", "Selasa", "Rabu", "Kamis", "Jumat","Sabtu","Minggu");
		$data['view'] = 'admin/shutdown/shutdown';
		$this->load->view('admin/template',$data);
	}
	
	function post(){
		$tipe = $this->input->post('tipe');
		$hari = $this->input->post('hari');
		$jam = $this->input->post('jam');
		
		$data = array(
				'tmr_tipe'=>$tipe,
				'tmr_hari'=>$hari,
				'tmr_jam'=>$jam
			);
		$this->models->update('timer','tmr_jenis','shutdown',$data);
		redirect('admin_shutdown/setting/ok');
	}
}
?>