<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class asisten_absensi extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models','admin_absen_models'));
		$this->load->helper(array('url','form'));
		$this->load->library('encrypt');
		date_default_timezone_set('Asia/Jakarta');
		session_start();
		if(!isset($_SESSION['password'])){
			redirect(base_url());
		}
	}
	
	function index(){
		$namabulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$data['praktikum'] = $this->admin_absen_models->id_praktikum($_SESSION['id_asisten']);
		$data['tanggal'] = date('d').' '.$namabulan[date('m')-1].' '.date('Y');
		$data['view'] = 'asisten/absensi/kosong';
		$this->load->view('asisten/template',$data);
	}
	
	function absensi($id_praktikum){
		$namabulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$data['absendate'] = $this->models->maxx('absensi','absen_tanggal');
		$data['tanggal'] = date('d').' '.$namabulan[date('m')-0].' '.date('Y');
		$data['praktikum'] = $this->admin_absen_models->id_praktikum($_SESSION['id_asisten']);
		$data['id_praktikum'] = $id_praktikum;
		$data['mahasiswa'] = $this->admin_absen_models->mahasiswa($id_praktikum);
		$data['pertemuan'] = $this->admin_absen_models->pertemuan($id_praktikum);
		$data['keterangan'] = $this->admin_absen_models->keterangan_praktikum($id_praktikum);
		$data['view'] = 'asisten/absensi/absensi';
		$this->load->view('asisten/template',$data);
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
					'absen_tanggal'=>date('Ymd')
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
		$pass = $this->input->post('pass');
		$id_praktikum = $this->input->post('id_praktikum');
		$asisten = $this->input->post('asisten');
		$respon = $this->input->post('respon');
		$pertemuan = $this->input->post('pertemuan');
		$tanggal = $this->input->post('tanggal');
		$cek = $this->admin_absen_models->cek_asisten('absensi_asisten',$id_praktikum,$asisten,$pertemuan);
		$cek_asisten = $this->models->where1Row('asisten','id_asisten',$asisten);
		
		if($this->encrypt->decode($cek_asisten->password) == $pass){			
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
		else{
			echo 'PasswordSalah';	
		}
	}
}
?>