<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asisten_biodata extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models','admin_asisten_models'));
		$this->load->helper(array('url','form'));
		$this->load->library('encrypt');
		session_start();
		if(!isset($_SESSION['password'])){
			redirect(base_url());
		}
	}
	
	function edit_asisten($id_asisten){
		$data['asisten'] = $this->admin_asisten_models->lihat_asisten($id_asisten);
		$data['jabatan'] = $this->models->lihat_menurun('jabatan','ASC','jabatan');
		$data['view'] = 'asisten/asisten/asisten-edit';
		$this->load->view('asisten/template',$data);
	}
	
	function lihat_asisten($id_asisten){
		$data['asisten'] = $this->admin_asisten_models->lihat_asisten($id_asisten);
		$data['view'] = 'asisten/asisten/asisten-lihat';
		$this->load->view('asisten/template',$data);
	}
	//proses
	function update_asisten(){
		$id_asisten = $this->input->post('id_asisten');
		$foto_lama = $this->input->post('foto_lama');
		$pass = $this->input->post('password');
		$namaAsisten = $this->input->post('nama');
		$tanggal = $this->input->post('tanggal');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$alamat = $this->input->post('alamat');
		$email = $this->input->post('email');
		$namaFoto = $_FILES['foto']['name'];	
		$fotosize = getimagesize($_FILES["foto"]["tmp_name"]);
		
		if($namaFoto==''){
			$data = array(
					'password'=>$this->encrypt->encode($pass),
					'nama'=>$namaAsisten,
					'tgl_lhr'=>"$tahun-$bulan-$tanggal",
					'alamat'=>$alamat,
					'email'=>$email
				);
			$this->models->update('asisten','id_asisten',$id_asisten,$data);
			redirect("asisten_biodata/lihat_asisten/$id_asisten");
		}	
		else{	
			if($fotosize[0]<$fotosize[1]){
				$FileFoto = $_FILES['foto']['tmp_name'];
				copy($FileFoto, "image/asisten/$namaFoto");
				$data = array(
						'password'=>$this->encrypt->encode($pass),
						'nama'=>$namaAsisten,
						'tgl_lhr'=>"$tahun-$bulan-$tanggal",
						'alamat'=>$alamat,
						'email'=>$email,
						'foto'=>$namaFoto
					);
				if($foto_lama!='foto.png'){
					unlink("image/asisten/$foto_lama");	
				}
				$this->models->update('asisten','id_asisten',$id_asisten,$data);
				redirect("asisten_biodata/lihat_asisten/$id_asisten");
			}
			else{
				$data = array(
						'password'=>$this->encrypt->encode($pass),
						'nama'=>$namaAsisten,
						'tgl_lhr'=>"$tahun-$bulan-$tanggal",
						'alamat'=>$alamat,
						'email'=>$email
					);
				$this->models->update('asisten','id_asisten',$id_asisten,$data);
				echo "<script>alert('Resolusi Foto, Lebar foto harus lebih kecil di banding dengan tinggi foto. Foto tidak disimpan.')</script>";
				echo "<meta http-equiv=\"refresh\"content=\"0; url=../asisten_biodata/lihat_asisten/$id_asisten\">";	
			}	
		}
	}
	
	function update_foto_asisten(){
		$id_asisten = $this->input->post('id_asisten');
		$foto_lama = $this->input->post('nama_foto');
		$namaFoto = $_FILES['foto']['name'];	
		$fotosize = getimagesize($_FILES["foto"]["tmp_name"]);
		if($namaFoto==''){
			redirect("asisten_biodata/lihat_asisten/$id_asisten");
		}
		else{
			if($fotosize[0]<$fotosize[1]){
				$FileFoto = $_FILES['foto']['tmp_name'];
				copy($FileFoto, "image/asisten/$namaFoto");
				$data = array(
						'foto'=>$namaFoto
					);
				if($foto_lama!='foto.png'){
					unlink("image/asisten/$foto_lama");	
				}
				$this->models->update('asisten','id_asisten',$id_asisten,$data);
				redirect("asisten_biodata/lihat_asisten/$id_asisten");
			}
			else{
				echo "<script>alert('Resolusi Foto, Lebar foto harus lebih kecil di banding dengan tinggi foto. Foto tidak disimpan.')</script>";
				echo "<meta http-equiv=\"refresh\"content=\"0; url=../asisten_biodata/lihat_asisten/$id_asisten\">";
				
			}
		}
	}
}
?>