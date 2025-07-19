<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_beranda extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models'));
		$this->load->helper(array('url'));
		date_default_timezone_set('Asia/Jakarta');
		session_start();
		if(!isset($_SESSION['password'])||($_SESSION['jabatan']!='adminsistem')){
			redirect(base_url());
		}
	}
	
	function index(){
		$data['view'] = 'admin/beranda/beranda';
		$this->load->view('admin/template',$data);
	}
}