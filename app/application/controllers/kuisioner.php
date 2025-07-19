<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kuisioner extends CI_Controller {
	
	function __construct(){
		parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('m_kuisioner');
        $this->load->helper(array('url','form'));
        $this->load->library('session');
        $this->load->library('parser');

        if ($this->session->userdata('signin') == null) {
            redirect('mhs/signin');
        }
    }
    
    function index(){
        $kategori = $this->m_kuisioner->getAllData('kategori_penilaian', array('tipe_penilaian' => '1'))->result_array();
        $status = $this->m_kuisioner->getAllData('status_penilaian_mahasiswa', array('npm' => $this->session->userdata('npm'), 'kode_praktikum' => $this->session->userdata('kd_praktikum')))->result_array();
        $uraian = $this->m_kuisioner->getUraian('1');

        $data['breadcrumb'] = array(
            array(
            'link' => 'mhs/kuisioner',
            'name' => 'Kuisioner'
            )
        );

        $data['npm'] = $this->session->userdata('npm');
        $data['kd_praktikum'] = $this->session->userdata('kd_praktikum');
        $data['uraian'] = $uraian;
        $data['kategori'] = $kategori;
        $data['status'] = $status;
        
        $data['title'] = 'Kuisioner';
        $data['header'] = 'Kuisioner Mahasiswa';
        $data['view'] = 'kuisioner/kuisioner';
        
        $this->parser->parse('kuisioner/template', $data);
    }

    function store(){
        $penilaian = array();
        $token = sha1($this->session->userdata('npm').'_'.$this->session->userdata('kd_praktikum'));
        $now = date('Y-m-d H:i:s');
        $kode_penilaian = $this->input->post('id_uraian');
        $nilai = $this->input->post('nilai');
        
        for ($i=0; $i < count($this->input->post('id_uraian')); $i++) { 
            $penilaian[$i] = array(
                'token' => $token,
                'npm' => sha1($this->session->userdata('npm')),
                'kode_praktikum' => $this->session->userdata('kd_praktikum'),
                'kode_penilaian' => $kode_penilaian[$i],
                'semester' => $this->session->userdata('semester'),
                'nilai' => $nilai[$i],
                'created_at' => $now
            );
        }

        $komentar = array(
            'token' => $token,
            'komentar' => $this->input->post('komentar'),
            'created_at' => $now
        );

        $status = array(
            'npm' => $this->session->userdata('npm'),
            'kode_praktikum' => $this->session->userdata('kd_praktikum'),
            'status' => 1,
            'created_at' => $now
        );

        $this->m_kuisioner->insertAllData('penilaian_mahasiswa', $penilaian);
        $this->m_kuisioner->insertData('penilaian_komentar', $komentar);
        $this->m_kuisioner->insertData('status_penilaian_mahasiswa', $status);

        redirect('mhs/kuisioner');
    }
	
	
}
