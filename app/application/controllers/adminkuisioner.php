<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminKuisioner extends CI_Controller {
	
	function __construct(){
		parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('m_kuisioner');
        $this->load->helper(array('url','form'));
        $this->load->library('session');
        $this->load->library('parser');
        $this->load->library('encrypt');

        session_start();
		if(!isset($_SESSION['password'])||($_SESSION['jabatan']!='adminsistem')){
			redirect(base_url());
		}
    }

    function mahasiswa(){
        $data['result'] = $this->m_kuisioner->getRataPraktikum();
		$data['view'] = 'admin/kuisioner/mahasiswa';
		$this->load->view('admin/template',$data);
    }

    function detailPenilaianMahasiswa($kd_praktikum)
    {
        $data['kd_praktikum'] = $kd_praktikum;
        $data['uraian'] = $this->m_kuisioner->getDetailRataPraktikum($kd_praktikum);
        $data['kategori'] = $this->m_kuisioner->getAllData('kategori_penilaian', array('tipe_penilaian' => '1'))->result_array();
        $data['komentar'] = $this->m_kuisioner->getAllData('penilaian_komentar', array('untuk' => sha1($kd_praktikum)), array('created_at' => 'DESC'))->result_array();
        $data['view'] = 'admin/kuisioner/detailMahasiswa';
		$this->load->view('admin/template',$data);
    }

    function asisten(){
        $data['asisten'] = $this->m_kuisioner->getAllAsisten();
        $data['view'] = 'admin/kuisioner/asisten';
        $this->load->view('admin/template',$data);
    }

    function detailPenilaianAsisten($kd_asisten)
    {
        // $data['uraian'] = $this->m_kuisioner->getDetailRataPraktikum($kd_praktikum);
        $data['asisten'] = $this->m_kuisioner->getAllData('asisten', array('username' => $kd_asisten, 'status' => 1))->result_array();
        $data['menilai'] = $this->m_kuisioner->getAllMenilaiAsisten($kd_asisten);
        $data['uraian'] = $this->m_kuisioner->getDetailRataAsisten($kd_asisten);
        $data['kategori'] = $this->m_kuisioner->getAllData('kategori_penilaian', array('tipe_penilaian' => '2'))->result_array();
        $data['komentar'] = $this->m_kuisioner->getAllData('penilaian_komentar', array('untuk' => sha1($kd_asisten)), array('created_at' => 'DESC'))->result_array();
        $data['nilai'] = $this->m_kuisioner->getNilaiAsisten($kd_asisten);
        $data['diri'] = $this->m_kuisioner->getAllData('penilaian_diri', array('kode_asisten' => sha1($kd_asisten)))->result_array();
        $data['view'] = 'admin/kuisioner/detailAsisten';
		$this->load->view('admin/template',$data);
    }
    
    
	
	
}
