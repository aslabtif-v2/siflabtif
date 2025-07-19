<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class asistenkuisioner extends CI_Controller {
	
	function __construct(){
		parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model(array('models','admin_mhs_models','m_kuisioner'));
        $this->load->helper(array('url','form'));
        $this->load->library('session');
        $this->load->library('parser');
        $this->load->library('encrypt');

        session_start();
		if(!isset($_SESSION['password'])){
			redirect(base_url());
		}
    }

    function penilaianAsisten(){
        $data['menilai'] = $this->m_kuisioner->getAllMenilaiAsisten($_SESSION['username']);
        $data['view'] = 'asisten/kuisioner/penilaianAsisten';
		$this->load->view('asisten/template',$data);
    }

    function formPenilaianAsisten($kd_asisten){
        $data['kategori'] = $this->m_kuisioner->getAllData('kategori_penilaian', array('tipe_penilaian' => '2'))->result_array();
        $data['uraian'] = $this->m_kuisioner->getUraian('2');
        $data['asisten'] = $this->m_kuisioner->getAllData('asisten', array('username' => $kd_asisten))->result_array();
        $data['view'] = 'asisten/kuisioner/formPenilaianAsisten';
		$this->load->view('asisten/template',$data);
    }

    function storePenilaianAsisten(){
        $penilaian = array();
        $token = sha1($_SESSION['username'].'_'.$this->input->post('kd_asisten').'_20182');
        $now = date('Y-m-d H:i:s');
		$kode_penilaian = $this->input->post('id_uraian');
		$nilai = $this->input->post('nilai');
        
        for ($i=0; $i < count($this->input->post('id_uraian')); $i++) { 
            $penilaian[$i] = array(
                'token' => $token,
                'kode_asisten' => sha1($_SESSION['username']),
                'menilai' => $this->input->post('kd_asisten'),
                'kode_penilaian' => $kode_penilaian[$i],
                'semester' => '20182',
                'nilai' => $nilai[$i],
                'created_at' => $now
            );
        }

        $komentar = array(
            'token' => $token,
            'untuk' => sha1($this->input->post('kd_asisten')),
            'komentar' => $this->input->post('komentar'),
            'created_at' => $now
        );

        $status = array(
            'kode_asisten' => $_SESSION['username'],
            'menilai' => $this->input->post('kd_asisten'),
            'status' => 1,
            'created_at' => $now
        );

        $this->m_kuisioner->insertAllData('penilaian_asisten', $penilaian);
        $this->m_kuisioner->insertData('penilaian_komentar', $komentar);
        $this->m_kuisioner->insertData('status_penilaian_asisten', $status);

        redirect('asisten/penilaian_asisten');
    }

    function penilaianDiri(){
        $data['status'] = $this->m_kuisioner->getAllData('status_penilaian_asisten', array('kode_asisten' => $_SESSION['username'], 'menilai' => $_SESSION['username']))->result_array();
        $data['view'] = 'asisten/kuisioner/penilaianDiri';
		$this->load->view('asisten/template',$data);
    }

    function storePenilaianDiri(){
        $penilaian = array();
        $token = sha1($_SESSION['username'].'_'.$_SESSION['username'].'_20182');
        $now = date('Y-m-d H:i:s');

        $penilaian = array(
            'token' => $token,
            'kode_asisten' => sha1($_SESSION['username']),
            'semester' => '20182',
            'deskripsi1' => $this->input->post('deskripsi1'),
            'deskripsi2' => $this->input->post('deskripsi2'),
            'deskripsi3' => $this->input->post('deskripsi3'),
            'created_at' => $now
        );

        $status = array(
            'kode_asisten' => $_SESSION['username'],
            'menilai' => $_SESSION['username'],
            'status' => 1,
            'created_at' => $now
        );

        $this->m_kuisioner->insertData('penilaian_diri', $penilaian);
        $this->m_kuisioner->insertData('status_penilaian_asisten', $status);

        redirect('asisten/penilaian_diri');
    }
    
    
	
	
}
