<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_kelas extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models'));
		$this->load->helper(array('url','form'));
		session_start();
		if(!isset($_SESSION['password'])||($_SESSION['jabatan']!='adminsistem')){
			redirect(base_url());
		}
	}
	
	function index($mulai=0){
		//utk mengatut tabel, link dan jumlah halaman 
		/*
		$jml = $this->db->get('kelas');
 		$config['base_url'] = base_url().'index.php/admin_kelas/index/';
		$config['total_rows'] = $jml->num_rows();
 		$config['per_page'] = '10'; 
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
		
		$this->db->limit($config['per_page'], $mulai); */
		$data['kelas'] = $this->db->query("select * from kelas order by kls_status desc  , kelas asc")->result();
		$data['view'] = 'admin/kelas/kelas';
		$this->load->view('admin/template',$data);
	}
	
	function tambah_kelas(){
		$data['view'] = 'admin/kelas/kelas-tambah';
		$this->load->view('admin/template',$data);
	}
	
	function edit_kelas($id_k){
		$data['kelas'] = $this->models->where1('kelas','id_kelas',$id_k);
		$data['view'] = 'admin/kelas/kelas-edit';
		$this->load->view('admin/template',$data);			
	}
	
	//proses
	function post_kelas(){
		$kelas = $this->input->post('kelas');
		$kls = explode(' ',$kelas);	
		$data = array(
			'id_kelas'=>strtolower($kls[0].$kls[1].$kls[2]),
			'kelas'=>strtoupper($kelas)
			);
		$this->db->insert('kelas',$data);
		redirect('admin_kelas');
	}
	
	function update_kelas(){
		$id_kelas = $this->input->post('id_kelas');
		$kelas = $this->input->post('kelas');
		$kls = explode(' ',$kelas);	
		$data = array(
			'id_kelas'=>strtolower($kls[0].$kls[1].$kls[2]),
			'kelas'=>strtoupper($kelas)
			);
		$this->models->update('kelas','id_kelas',$id_kelas,$data);
		redirect('admin_kelas');
	}

	function status_kelas(){
		$id = $this->input->post('id');
		$respon = $this->input->post('status');
		
		if($respon=='Aktif'){
			$data = array('kls_status'=>1);
			$this->models->update('kelas','id_kelas',$id,$data);
		}
		else{ //if($respon=='Belum Lunas'){
			$data = array('kls_status'=>0);
			$this->models->update('kelas','id_kelas',$id,$data);
		}
		echo $respon;
	}
	
	function hapus_kelas($idk){
		$this->models->hapus('kelas','id_kelas',$idk);	
		redirect('admin_kelas');
	}
}