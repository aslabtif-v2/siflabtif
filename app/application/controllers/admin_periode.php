<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_periode extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models'));
		$this->load->helper(array('url','form'));
		date_default_timezone_set('Asia/Jakarta');
		session_start();
		if(!isset($_SESSION['password'])||($_SESSION['jabatan']!='adminsistem')){
			redirect(base_url());
		}
	}
	
	function index($mulai=0){
		//utk mengatut tabel, link dan jumlah halaman
		$jml = $this->db->get('periode');
 		$config['base_url'] = base_url().'index.php/admin_periode/index/';
		$config['total_rows'] = $jml->num_rows();
 		$config['per_page'] = '15'; 
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
		//$data['mhs'] = $this->admin_jadwal_models->jadwal($mulai,$config['per_page']);
		
		
		//$data['jadwal'] = $this->admin_jadwal_models->jadwal($mulai,$config['per_page']);
			
 		$data['periode'] = $this->db->query("SELECT * FROM periode ORDER BY pr_periode DESC LIMIT $mulai, ".$config['per_page']."")->result();
		$data['view'] = 'admin/periode/periode';
		$this->load->view('admin/template',$data);
	}

	function tambah(){
		$data['view'] = 'admin/periode/periode-tambah';
		$this->load->view('admin/template',$data);
	}

	function edit($pr_id){
		$data['pr'] = $this->models->where1Row('periode','pr_id',$pr_id);
		$data['view'] = 'admin/periode/periode-edit';
		$this->load->view('admin/template',$data);
	}

	function post(){
		$periode = $this->input->post('periode');
		$data = array(
			'pr_periode'=>strtoupper($periode)
			);
		$this->db->insert('periode',$data);
		redirect('admin_periode');
	}

	function update($pr_id){
		$periode = $this->input->post('periode');
		$data = array(
			'pr_periode'=>strtoupper($periode)
			);
		$this->models->update('periode','pr_id',$pr_id,$data);
		redirect('admin_periode');
	}

	function hapus($pr_id){
		$this->models->hapus('periode','pr_id',$pr_id);
		redirect('admin_periode');
	}
	
}
?>