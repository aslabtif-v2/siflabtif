<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_asisten extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models','admin_asisten_models'));
		$this->load->helper(array('url','form'));
		$this->load->library('encrypt');
		session_start();
		if(!isset($_SESSION['password'])||($_SESSION['jabatan']!='adminsistem')){
			redirect(base_url());
		}
	}
	
	function index($mulai=0){
		//utk mengatut tabel, link dan jumlah halaman
		$jml = $this->db->get('asisten');
 		$config['base_url'] = base_url().'index.php/admin_asisten/index/';
		$config['total_rows'] = $jml->num_rows();
 		$config['per_page'] = '20'; 
		//tag paling utama
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		//tag utk ke awal
		$config['first_link'] = '&larr; Awal';
		$config['first_tag_open'] = '<li class="previous">';
		$config['first_tag_close'] = '</li>';
 		//tag utk ke akhir
		$config['last_link'] = 'Akhir &rarr;';
		$config['last_tag_open'] = '<li class="next">';
		$config['last_tag_close'] = '</li>';
 		//tag utk next page/halaman
		$config['next_page'] = '&laquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		//tag utk kembali ke page/halaman sebelumnya
		$config['prev_page'] = '&raquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		//tag utk nomor page/halaman yg aktif
		$config['cur_tag_open'] = '<li class="active"><span>';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
		//tag utk no halaman yg lainnya
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		//inisialisasi pagginationnya
 		$this->pagination->initialize($config);
 		$data['halaman'] = $this->pagination->create_links();
		
		$data['asisten'] = $this->admin_asisten_models->asisten($mulai,$config['per_page']);
		$data['view'] = 'admin/asisten/asisten';
		$this->load->view('admin/template',$data);
	}
	
	function tambah_asisten(){
		$data['jabatan'] = $this->models->lihat_menurun('jabatan','ASC','jabatan');
		$data['view'] = 'admin/asisten/asisten-tambah';
		$this->load->view('admin/template',$data);
	}
	
	function edit_asisten($id_asisten){
		$data['asisten'] = $this->admin_asisten_models->lihat_asisten($id_asisten);
		$data['jabatan'] = $this->models->lihat_menurun('jabatan','ASC','jabatan');
		$data['view'] = 'admin/asisten/asisten-edit';
		$this->load->view('admin/template',$data);
	}
	
	function lihat_asisten($id_asisten){
		$data['asisten'] = $this->admin_asisten_models->lihat_asisten($id_asisten);
		$data['view'] = 'admin/asisten/asisten-lihat';
		$this->load->view('admin/template',$data);
	}
	//proses
	function status_asisten(){
		$id_asisten = $this->input->post('id');
		$respon = $this->input->post('status');
		$cek = $this->models->where1('asisten','id_asisten',$id_asisten);
		$c = 0;
		foreach($cek as $rz){$c = $rz->status;}
		if($respon=='Aktif'&&$c==0){
			$data = array('status'=>1);
			$this->models->update('asisten','id_asisten',$id_asisten,$data);
			echo 'Aktif';
		}
		else{
			$data = array('status'=>0);
			$this->models->update('asisten','id_asisten',$id_asisten,$data);
			echo 'Tidak Aktif';
		}
	}
	
	function post_asisten(){
		$username = $this->input->post('username');
		$pass = $this->input->post('password');
		$namaAsisten = $this->input->post('nama');
		$jabatan = $this->input->post('jabatan');
		$tanggal = $this->input->post('tanggal');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$alamat = $this->input->post('alamat');
		$email = $this->input->post('email');
		$Tmasuk = $this->input->post('tmasuk');
		$Tkeluar = $this->input->post('tkeluar');
		$namaFoto = $_FILES['foto']['name'];	
		$fotosize = getimagesize($_FILES["foto"]["tmp_name"]);
		//echo 'lebar : '.$fotosize[0];
		//echo '<br> tinggi : '.$fotosize[1];
		
		if($namaFoto==''){
			$namaFoto = 'foto.png';	
			copy($FileFoto, "image/asisten/$namaFoto");
			$data = array(
					'id_asisten'=>'',
					'username'=>$username,
					'password'=>$this->encrypt->encode($pass),
					'nama'=>$namaAsisten,
					'id_jabatan'=>$jabatan,
					'tgl_lhr'=>"$tahun-$bulan-$tanggal",
					'alamat'=>$alamat,
					'email'=>$email,
					'masuk'=>$Tmasuk,
					'keluar'=>$Tkeluar,
					'status'=>1,
					'foto'=>$namaFoto
				);
			$this->db->insert('asisten',$data);
			redirect('admin_asisten');
		}	
		else{	
			if($fotosize[0]<$fotosize[1]){
				$FileFoto = $_FILES['foto']['tmp_name'];
				copy($FileFoto, "image/asisten/$namaFoto");
				$data = array(
						'id_asisten'=>'',
						'username'=>$username,
						'password'=>$this->encrypt->encode($pass),
						'nama'=>$namaAsisten,
						'id_jabatan'=>$jabatan,
						'tgl_lhr'=>"$tahun-$bulan-$tanggal",
						'alamat'=>$alamat,
						'email'=>$email,
						'masuk'=>$Tmasuk,
						'keluar'=>$Tkeluar,
						'status'=>1,
						'foto'=>$namaFoto
					);
				$this->db->insert('asisten',$data);
				redirect('admin_asisten');
			}
			else{
				$namaFoto = 'foto.png';
				$data = array(
						'id_asisten'=>'',
						'username'=>$username,
						'password'=>$this->encrypt->encode($pass),
						'nama'=>$namaAsisten,
						'id_jabatan'=>$jabatan,
						'tgl_lhr'=>"$tahun-$bulan-$tanggal",
						'alamat'=>$alamat,
						'email'=>$email,
						'masuk'=>$Tmasuk,
						'keluar'=>$Tkeluar,
						'status'=>1,
						'foto'=>$namaFoto
					);
				$this->db->insert('asisten',$data);
				echo "<script>alert('Resolusi Foto, Lebar foto harus lebih kecil di banding dengan tinggi foto. Foto tidak disimpan.')</script>";
				echo "<meta http-equiv=\"refresh\"content=\"0; url=../admin_asisten\">";	
			}	
		}
	}
	
	function update_asisten(){
		$id_asisten = $this->input->post('id_asisten');
		$foto_lama = $this->input->post('foto_lama');
		$username = $this->input->post('username');
		$pass = $this->input->post('password');
		$namaAsisten = $this->input->post('nama');
		$jabatan = $this->input->post('jabatan');
		$tanggal = $this->input->post('tanggal');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$alamat = $this->input->post('alamat');
		$email = $this->input->post('email');
		$Tmasuk = $this->input->post('tmasuk');
		$Tkeluar = $this->input->post('tkeluar');
		$namaFoto = $_FILES['foto']['name'];	
		$fotosize = getimagesize($_FILES["foto"]["tmp_name"]);
		//echo 'lebar : '.$fotosize[0];
		//echo '<br> tinggi : '.$fotosize[1];
		
		if($namaFoto==''){
			$data = array(
					'username'=>$username,
					'password'=>$this->encrypt->encode($pass),
					'nama'=>$namaAsisten,
					'id_jabatan'=>$jabatan,
					'tgl_lhr'=>"$tahun-$bulan-$tanggal",
					'alamat'=>$alamat,
					'email'=>$email,
					'masuk'=>$Tmasuk,
					'keluar'=>$Tkeluar
				);
			$this->models->update('asisten','id_asisten',$id_asisten,$data);
			redirect("admin_asisten/lihat_asisten/$id_asisten");
		}	
		else{	
			if($fotosize[0]<$fotosize[1]){
				$FileFoto = $_FILES['foto']['tmp_name'];
				copy($FileFoto, "image/asisten/$namaFoto");
				$data = array(
						'username'=>$username,
						'password'=>$this->encrypt->encode($pass),
						'nama'=>$namaAsisten,
						'id_jabatan'=>$jabatan,
						'tgl_lhr'=>"$tahun-$bulan-$tanggal",
						'alamat'=>$alamat,
						'email'=>$email,
						'masuk'=>$Tmasuk,
						'keluar'=>$Tkeluar,
						'foto'=>$namaFoto
					);
				if($foto_lama!='foto.png'){
					unlink("image/asisten/$foto_lama");	
				}
				$this->models->update('asisten','id_asisten',$id_asisten,$data);
				redirect("admin_asisten/lihat_asisten/$id_asisten");
			}
			else{
				$data = array(
						'username'=>$username,
						'password'=>$this->encrypt->encode($pass),
						'nama'=>$namaAsisten,
						'id_jabatan'=>$jabatan,
						'tgl_lhr'=>"$tahun-$bulan-$tanggal",
						'alamat'=>$alamat,
						'email'=>$email,
						'masuk'=>$Tmasuk,
						'keluar'=>$Tkeluar
					);
				$this->models->update('asisten','id_asisten',$id_asisten,$data);
				echo "<script>alert('Resolusi Foto, Lebar foto harus lebih kecil di banding dengan tinggi foto. Foto tidak disimpan.')</script>";
				echo "<meta http-equiv=\"refresh\"content=\"0; url=../admin_asisten/lihat_asisten/$id_asisten\">";	
			}	
		}
	}
	
	function update_foto_asisten(){
		$id_asisten = $this->input->post('id_asisten');
		$foto_lama = $this->input->post('nama_foto');
		$namaFoto = $_FILES['foto']['name'];	
		$fotosize = getimagesize($_FILES["foto"]["tmp_name"]);
		if($namaFoto==''){
			redirect("admin_asisten/lihat_asisten/$id_asisten");
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
				redirect("admin_asisten/lihat_asisten/$id_asisten");
			}
			else{
				echo "<script>alert('Resolusi Foto, Lebar foto harus lebih kecil di banding dengan tinggi foto. Foto tidak disimpan.')</script>";
				echo "<meta http-equiv=\"refresh\"content=\"0; url=../admin_asisten/lihat_asisten/$id_asisten\">";
				
			}
		}
	}
	
	function hapus_asisten($id_asisten){
		$asisiten = $this->models->where1Row('asisten','id_asisten',$id_asisten);
		if($asisiten->foto!='foto.png'){
			unlink("image/asisten/$asisiten->foto");
		}
		$this->models->hapus('asisten','id_asisten',$id_asisten);	
		redirect('admin_asisten');
	}
}
?>