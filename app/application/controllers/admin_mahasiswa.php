<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_mahasiswa extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models','admin_mhs_models'));
		$this->load->helper(array('url','form'));
		session_start();
		if(!isset($_SESSION['password'])||($_SESSION['jabatan']!='adminsistem')&&($_SESSION['jabatan']!='koordinatorlab')){
			redirect(base_url());
		}
	}
	
	function index($mulai=0){
		//utk mengatut tabel, link dan jumlah halaman
		$jml = $this->db->get('mahasiswa');
 		$config['base_url'] = base_url().'index.php/admin_mahasiswa/index/';
		$config['total_rows'] = $jml->num_rows();
 		$config['per_page'] = '50'; 
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
		
		$data['mhs'] = $this->admin_mhs_models->mahasiswa('',$mulai,$config['per_page']);
		$data['view'] = 'admin/mahasiswa/mahasiswa';
		$this->load->view('admin/template',$data);
	}
	
	function tambah_mhs(){
		$data['kelas'] = $this->models->lihat_menurun('kelas','ASC','kelas');
		$data['view'] = 'admin/mahasiswa/mahasiswa-tambah';
		$this->load->view('admin/template',$data);
	}
	
	function edit_mhs($npm){
		$data['mhs'] = $this->admin_mhs_models->where1mhs($npm);
		$data['kelas'] = $this->models->lihat_menurun('kelas','ASC','kelas');
		$data['view'] = 'admin/mahasiswa/mahasiswa-edit';
		$this->load->view('admin/template',$data);	
	}
	
	function cari(){
		$cari = $this->input->post('cari');
		$kat = $this->input->post('berdasarkan');
		$mhs = $this->models->cari1('mahasiswa',$kat,$cari);
		$carikan = "AND $kat LIKE '%$cari%'";
		$data['mhs'] = $this->admin_mhs_models->mahasiswa($carikan,0,10);
		$this->load->view('admin/mahasiswa/load/mahasiswa-cari',$data);
	}
	
	//proses
	function post_mhs(){
		$npm = $this->input->post('npm');
		$nama = $this->input->post('nama');	
		$kelas = $this->input->post('kelas');
		
		$cek = $this->models->where1('mahasiswa','npm',$npm);
		$i=0;
		foreach($cek as $rz){$i++;}
		if($i==0){
			$data = array(
				'npm'=>$npm,
				'nama'=>$nama,
				'id_kelas'=>$kelas
				);
			$this->db->insert('mahasiswa',$data);
			echo "sukses|NPM : $npm <br>Nama : $nama<br>Data tersimpan";	
		}
		else{
			echo 'gagal|<font color="red">Data sudah ada, data tidak tersimpan</font>';
		}
	}
	
	function update_mhs(){
		$id_npm = $this->input->post('id_npm');
		$npm = $this->input->post('npm');
		$nama = $this->input->post('nama');	
		$kelas = $this->input->post('kelas');
		
		/*$cek = $this->models->where1('mahasiswa','npm',$npm);
		$i=0;
		foreach($cek as $rz){$i++;}
		if($i==0){*/
			$data = array(
				'npm'=>$npm,
				'nama'=>$nama,
				'id_kelas'=>$kelas
				);
			$this->models->update('mahasiswa','npm',$id_npm,$data);
			echo "sukses| ";	
		/*}
		else{
			echo 'gagal|<font color="red">Data sudah ada, data tidak tersimpan</font>';
		}*/	
	}
	
	function hapus_mhs($npm){
		$this->models->hapus('registrasi_praktikum','npm',$npm);
		$this->models->hapus('absensi','npm',$npm);
		$this->models->hapus('mahasiswa','npm',$npm);
		redirect('admin_mahasiswa');	
	}
}
?>