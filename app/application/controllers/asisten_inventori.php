<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asisten_inventori extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models','admin_penggajian_models'));
		$this->load->helper(array('url','form'));
		session_start();
		if(!isset($_SESSION['password'])||($_SESSION['jabatan']!='pjdasar')&&($_SESSION['jabatan']!='pjmulti')&&($_SESSION['jabatan']!='pjjarkom')&&($_SESSION['jabatan']!='teknisilab')&&($_SESSION['jabatan']!='pjjarkom')&&($_SESSION['jabatan']!='koordinatorlab')){
			redirect(base_url());
		}
	}
	
	function index(){
		$data['view'] = 'asisten/inventori/inventori';
		$this->load->view('asisten/template',$data);
	}
}
?>