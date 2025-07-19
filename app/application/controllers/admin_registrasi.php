<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_registrasi extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models','admin_registrasi_models','admin_penilaian_models'));
		$this->load->helper(array('url','form'));
		session_start();
		if(!isset($_SESSION['password'])||($_SESSION['jabatan']!='adminsistem')){
			redirect(base_url());
		}
	}
	
	function index(){
		$data['praktikum'] = $this->models->where1menurun('penjadwalan','status',1,'id_praktikum','ASC');
		$data['view'] = 'admin/registrasi/registrasi';
		$this->load->view('admin/template',$data);
	}
	
	function praktikum($id_praktikum){
		$data['praktikum'] = $this->models->where1menurun('penjadwalan','status',1,'id_praktikum','ASC');
		$data['mahasiswa'] = $this->admin_registrasi_models->mahasiswa();
		$data['view'] = 'admin/registrasi/registrasi';
		$this->load->view('admin/template',$data);
	}
	
	function simpan_registrasi(){
		$pilih = $this->input->post('pilih');
		$id_praktikum = $this->input->post('id_praktikum');
		
		$mhsreg = $this->models->where1('registrasi_praktikum','id_praktikum',$id_praktikum);
		
		$this->models->hapus('registrasi_praktikum','id_praktikum',$id_praktikum);
		foreach($pilih as $npm){
			
			$data = array(
					'id_registrasi'=>'',
					'id_praktikum'=>$id_praktikum,
					'npm'=>$npm,
					'tugas'=>0,
					'ujian'=>0
				);
			$this->db->insert('registrasi_praktikum',$data);
		}
		
		foreach($pilih as $npm){	
			$byr_status = $this->models->where1Row('mahasiswa','npm',$npm)->byr_status;
			$temp[$npm] = $byr_status;
			
			$data1 = array('byr_status'=>0);
			$this->models->update('mahasiswa','npm',$npm,$data1);
						
			foreach($mhsreg as $mhs){
				if($mhs->npm==$npm ){
					//update status pembayaran
					$data1 = array('byr_status'=>$temp[$mhs->npm]);
					$this->models->update('mahasiswa','npm',$mhs->npm,$data1);
					
					//update nilai mahasiswa
					$data2 = array('tugas'=>$mhs->tugas,'ujian'=>$mhs->ujian);
					$this->models->update2('registrasi_praktikum','id_praktikum',$id_praktikum,'npm',$npm,$data2);
					break;
				}
			}
		}
		
		redirect('admin_registrasi/praktikum/'.$id_praktikum.'/ok');
	}
	
	function simpan_pindah_praktikum(){
		$pilih = $this->input->post('pilih');
		$id_praktikum = $this->input->post('praktikum_dari');
		$id_praktikum_ke = $this->input->post('praktikum_ke');
		$praktikum1 = $this->models->maxwhere('absensi','id_praktikum',$id_praktikum,'pertemuan')->pertemuan;
		$praktikum2 = $this->models->maxwhere('absensi','id_praktikum',$id_praktikum_ke,'pertemuan')->pertemuan;
		
		if($praktikum1==$praktikum2){
			foreach($pilih as $npm){
				$data = array(
						'id_praktikum'=>$id_praktikum_ke,
						'npm'=>$npm
					);
				$this->models->update2('registrasi_praktikum','id_praktikum',$id_praktikum,'npm',$npm,$data);
				$this->models->update2('absensi','id_praktikum',$id_praktikum,'npm',$npm,$data);
			}
			redirect("admin_registrasi/pindah_praktikum/$id_praktikum/ok");
		}
		else{
			redirect("admin_registrasi/pindah_praktikum/$id_praktikum/$id_praktikum_ke");	
		}
	}
	
	function pindah_praktikum($id_praktikum){
		$data['praktikum'] = $this->models->where1menurun('penjadwalan','status',1,'id_praktikum','ASC');
		$data['id_praktikum'] = $id_praktikum;
		$data['mahasiswa'] = $this->admin_penilaian_models->nilai_mahasiswa($id_praktikum);
		$data['view'] = 'admin/registrasi/registrasi-pindah-praktikum';
		$this->load->view('admin/template',$data);
	}
	
	function pindah(){
		$data['praktikum'] = $this->models->where1menurun('penjadwalan','status',1,'id_praktikum','ASC');
		$data['view'] = 'admin/registrasi/registrasi-pindah-praktikum-kosong';
		$this->load->view('admin/template',$data);
	}

	function hapus($shift, $npm){
		$this->models->hapus2('absensi','npm','id_praktikum',$npm,$shift);
		$this->models->hapus2('registrasi_praktikum','npm','id_praktikum',$npm,$shift);
		redirect('admin_registrasi/pindah_praktikum/'.$shift);	
	}
}
?>