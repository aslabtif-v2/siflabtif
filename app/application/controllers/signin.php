<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signin extends CI_Controller {
	
	function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper(array('url','form'));
        $this->load->library('session');
        $this->load->library('parser');
        $this->load->model('m_kuisioner');
        // $this->session->sess_destroy();
	}
	
	function index(){
        if ($this->session->userdata('signin') == true) {
            redirect('mhs/dashboard');
        } else {
            $data['id_praktikum'] = $this->m_kuisioner->getAllData('penjadwalan', array('status' => '1'))->result_array();
            $this->load->view('kuisioner/signin', $data);
        }
    }

    public function store(){
        $this->session->set_userdata('npm', $this->input->post('npm'));
        $this->session->set_userdata('kd_praktikum', $this->input->post('kd_praktikum'));
        $this->session->set_userdata('semester', '20182');
        $this->session->set_userdata('signin', true);

        redirect('mhs/dashboard');
    }

    public function dashboard(){
        if ($this->session->userdata('signin') == null) {
            redirect('mhs/signin');
        }

        $data['breadcrumb'] = array(
            array(
                'link' => 'mhs/dashboard',
                'name' => 'Dasboard'
            )
        );

        $data['npm'] = $this->session->userdata('npm');
        $data['title'] = 'Dashboard';
        $data['header'] = 'Selamat datang, '.$this->session->userdata('npm');
        $data['view'] = 'kuisioner/dashboard';
        
        $this->parser->parse('kuisioner/template', $data);
    }

    public function signout(){
        $this->session->sess_destroy();
        redirect('mhs/signin');
    }
}
