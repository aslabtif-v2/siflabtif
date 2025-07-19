<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asisten_informasi extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models','admin_penilaian_models','admin_absen_models'));
		$this->load->helper(array('url','form'));
		session_start();
		if(!isset($_SESSION['password'])||($_SESSION['jabatan']!='koordinatorlab')){
			redirect(base_url());
		}
	}
	
	function index(){
		$data['namaBulan'] = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$data['informasi'] = $this->models->lihat_menurun('informasi','DESC','id_informasi');
		$data['view'] = 'asisten/informasi/informasi';
		$this->load->view('asisten/template',$data);
	}
	
	
	function tambah_informasi(){
		$data['view'] = 'asisten/informasi/informasi-tambah';
		$this->load->view('asisten/template',$data);
	}
	
	function edit_informasi($id){
		$data['informasi'] = $this->models->where1('informasi','id_informasi',$id);
		$data['view'] = 'asisten/informasi/informasi-edit';
		$this->load->view('asisten/template',$data);
	}
	
	function post_informasi(){
		$info = $this->input->post('informasi');
		$data = array(
				'id_informasi'=>'',
				'informasi'=>$info,
				'tanggal'=>date('Y-m-d'),
				'jabatan'=>$_SESSION['namajabatan'],
				'status'=>1
			);
		$this->db->insert('informasi',$data);
		redirect('asisten_informasi');
	}
	
	function status_informasi(){
		$id_info = $this->input->post('id');
		$respon = $this->input->post('status');
		$cek = $this->models->where1('informasi','id_informasi',$id_info);
		$c = 0;
		foreach($cek as $rz){$c = $rz->status;}
		if($respon=='Ditampilkan'&&$c==0){
			$data = array('status'=>1);
			$this->models->update('informasi','id_informasi',$id_info,$data);
			echo 'Ditampilkan';
		}
		else if($respon=='Tidak Ditampilkan'&&$c==1){
			$data = array('status'=>0);
			$this->models->update('informasi','id_informasi',$id_info,$data);
			echo 'Tidak Ditampilkan';
		}
	}
	
	function update_informasi(){
		$id = $this->input->post('id_info');
		$info = $this->input->post('informasi');
		$data = array(
				'informasi'=>$info
			);
		$this->models->update('informasi','id_informasi',$id,$data);
		redirect('asisten_informasi');
	}
	
	function hapus_informasi($id_info){
		$this->models->hapus('informasi','id_informasi',$id_info);
		redirect('asisten_informasi');
	}
}
?>