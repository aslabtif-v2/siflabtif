<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_jabatan extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models'));
		$this->load->helper(array('url','form'));
		session_start();
		if(!isset($_SESSION['password'])||($_SESSION['jabatan']!='adminsistem')){
			redirect(base_url());
		}
	}
	
	function index(){
		$data['jabatan'] = $this->models->lihat_menurun('jabatan','ASC','jabatan');
		$data['view'] = 'admin/jabatan/jabatan';
		$this->load->view('admin/template',$data);
	}
	
	function tambah_jabatan(){
		$data['view'] = 'admin/jabatan/jabatan-tambah';
		$this->load->view('admin/template',$data);
	}
	
	function edit_jabatan($id_jabatan){
		$data['jabatan'] = $this->models->where1('jabatan','id_jabatan',$id_jabatan);
		$data['view'] = 'admin/jabatan/jabatan-edit';
		$this->load->view('admin/template',$data);
	}
	
	//proses
	function post_jabatan(){
		$jabatan = ucwords($this->input->post('jabatan'));
		$pertemuan = $this->input->post('honor_pertemuan');
		$bulan = $this->input->post('honor_perbulan');
		$j = explode(' ',$jabatan);
		$id_jab = strtolower($j[0].$j[1]);
		$data = array(
				'id_jabatan'=>$id_jab,
				'jabatan'=>$jabatan,
				'honor_pertemuan'=>$pertemuan,
				'honor_perbulan'=>$bulan
			);
		$c=0;
		$cek = $this->models->where1('jabatan','id_jabatan',$id_jab);
		foreach($cek as $rz){$c++;}
		if($c==0){
			$this->db->insert('jabatan',$data);
			echo "sukses|Jabatan : $jabatan <br>Honor/Pertemuan : $pertemuan <br>Honor/Bulan : $bulan <br>Data tersimpan.";
		}
		else{
			echo 'gagal|<font color="red">Maaf data sudah tersimpan sebelumnya. Data tidak tersimpan</font>';
		}
	}

	function update_jabatan(){
		$id_jabatan = $this->input->post('id_jabatan');
		$jabatan = ucwords($this->input->post('jabatan'));
		$pertemuan = $this->input->post('honor_pertemuan');
		$bulan = $this->input->post('honor_perbulan');
		$j = explode(' ',$jabatan);
		$id_jab = strtolower($j[0].$j[1]);
		$data = array(
				'id_jabatan'=>$id_jab,
				'jabatan'=>$jabatan,
				'honor_pertemuan'=>$pertemuan,
				'honor_perbulan'=>$bulan
			);
		$this->models->update('jabatan','id_jabatan',$id_jabatan,$data);
		redirect('admin_jabatan');
	}
	
	function hapus_jabatan($id_jabatan){
		$this->models->hapus('jabatan','id_jabatan',$id_jabatan);
		redirect('admin_jabatan');
	}
}
?>