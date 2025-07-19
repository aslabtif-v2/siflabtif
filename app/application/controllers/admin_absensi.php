<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_absensi extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models','admin_absen_models'));
		$this->load->helper(array('url','form'));
		date_default_timezone_set('Asia/Jakarta');
		session_start();
		if(!isset($_SESSION['password'])||($_SESSION['jabatan']!='adminsistem')){
			redirect(base_url());
		}
	}
	
	function index(){
		$namabulan = array("","Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$data['praktikum'] = $this->models->where1menurun('penjadwalan','status',1,'id_praktikum','ASC');
		$data['tanggal'] = date('d').' '.$namabulan[date('m')-1].' '.date('Y');
		$data['view'] = 'admin/absensi/kosong';
		$this->load->view('admin/template',$data);
	}
	
	function absensi($id_praktikum,$pertemuan){
		$data['praktikum'] = $this->models->where1menurun('penjadwalan','status',1,'id_praktikum','ASC');
		$data['id_praktikum'] = $id_praktikum;
		$data['mahasiswa'] = $this->admin_absen_models->mahasiswa($id_praktikum);
		$data['pertemuan'] = $pertemuan;
		$data['tanggal'] = $this->models->where2Row('absensi','id_praktikum','pertemuan',$id_praktikum,$pertemuan);
		$data['keterangan'] = $this->admin_absen_models->keterangan_praktikum($id_praktikum);
		$data['view'] = 'admin/absensi/absensi';
		$this->load->view('admin/template',$data);
	}
	
	function mengabsen(){
		$id_praktikum = $this->input->post('id_praktikum');
		$npm = $this->input->post('npm');
		$respon = $this->input->post('respon');
		$pertemuan = $this->input->post('pertemuan');
		$tanggal = $this->input->post('tanggal');
		$cek = $this->admin_absen_models->cek('absensi',$id_praktikum,$npm,$pertemuan);
		if($respon=='Hadir'&&$cek->hadir==0){
			$data = array(
					'id_absensi'=>'',
					'id_praktikum'=>$id_praktikum,
					'pertemuan'=>$pertemuan,
					'npm'=>$npm,
					'tanggal'=>$tanggal,
				);
			$this->db->insert('absensi',$data);
			echo 'Hadir';
		}
		else if($respon=='Tidak Hadir'&&$cek->hadir==1){
			$this->models->hapus3('absensi','id_praktikum','npm','pertemuan',$id_praktikum,$npm,$pertemuan);
			echo 'Tidak Hadir';
		}
		else{
			if($cek->hadir==0){
				echo 'Tidak Hadir';	
			}
			else{
				echo 'Hadir';
			}
		}
	}
	
	function absen_asisten(){
		$id_praktikum = $this->input->post('id_praktikum');
		$asisten = $this->input->post('asisten');
		$respon = $this->input->post('respon');
		$pertemuan = $this->input->post('pertemuan');
		$tanggal = $this->input->post('tanggal');
		$cek = $this->admin_absen_models->cek_asisten('absensi_asisten',$id_praktikum,$asisten,$pertemuan);
		if($respon=='Hadir'&&$cek->hadir==0){
			$data = array(
					'id_absensi_asisten'=>'',
					'id_praktikum'=>$id_praktikum,
					'pertemuan'=>$pertemuan,
					'id_asisten'=>$asisten,
					'tanggal'=>$tanggal,
				);
			$this->db->insert('absensi_asisten',$data);
			echo 'Hadir';
		}
		else if($respon=='Tidak Hadir'&&$cek->hadir==1){
			$this->models->hapus3('absensi_asisten','id_praktikum','id_asisten','pertemuan',$id_praktikum,$asisten,$pertemuan);
			echo 'Tidak Hadir';
		}
		else{
			if($cek->hadir==0){
				echo 'Tidak Hadir';	
			}
			else{
				echo 'Hadir';
			}
		}
	}
}
?>