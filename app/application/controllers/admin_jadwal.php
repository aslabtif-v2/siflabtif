<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_jadwal extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models','admin_jadwal_models'));
		$this->load->helper(array('url','form'));
		date_default_timezone_set('Asia/Jakarta');
		session_start();
		if(!isset($_SESSION['password'])||($_SESSION['jabatan']!='adminsistem')){
			redirect(base_url());
		}
	}
	
	function index($mulai=0){
		//utk mengatut tabel, link dan jumlah halaman
		$jml = $this->db->get('penjadwalan');
 		$config['base_url'] = base_url().'index.php/admin_jadwal/index/';
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
		//$data['mhs'] = $this->admin_jadwal_models->jadwal($mulai,$config['per_page']);
		
		//
		$data['jadwal'] = $this->admin_jadwal_models->jadwal($mulai,$config['per_page']);
		$data['view'] = 'admin/jadwal/jadwal';
		$this->load->view('admin/template',$data);
	} 

	function periode($pr_id){
		$data['jadwal'] = $this->admin_jadwal_models->jadwalperiode($pr_id);
		$data['view'] = 'admin/jadwal/jadwal';
		$this->load->view('admin/template',$data);
	}
	
	function tambah_jadwal(){
		$data['asisten'] = $this->models->where1menurun('asisten','status',1,'nama','ASC');
		$data['kelas'] = $this->models->where1menurun('kelas','kls_status',1,'kelas','asc');
		$data['matkum'] = $this->models->lihat_menurun('mata_praktikum','ASC','mata_praktikum');
		$data['ruangan'] = $this->models->lihat_menurun('ruangan','ASC','ruangan');
		$data['view'] = 'admin/jadwal/jadwal-tambah';
		$this->load->view('admin/template',$data);
	}
	
	function edit_jadwal($id_praktikum){
		$data['praktikum'] = $this->admin_jadwal_models->edit_jadwal($id_praktikum);
		$data['asisten'] = $this->models->where1menurun('asisten','status',1,'nama','ASC'); 
		$data['kelas'] = $this->models->where1menurun('kelas','kls_status',1,'kelas','asc'); //lihat_menurun('kelas','ASC','kelas');
		$data['matkum'] = $this->models->lihat_menurun('mata_praktikum','ASC','mata_praktikum');
		$data['ruangan'] = $this->models->lihat_menurun('ruangan','ASC','ruangan');
		$data['view'] = 'admin/jadwal/jadwal-edit';
		$this->load->view('admin/template',$data);
	}
	
	function hari_ini(){
		$namaBulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$namaHari = array("Minggu","Senin", "Selasa", "Rabu", "Kamis", "Jumat","Sabtu");
		$data['hari'] = $namaHari[date('w')];
		$data['bulan'] = $namaBulan[(date('n')-1)];
		$data['penjadwalan'] = $this->admin_jadwal_models->praktikum($namaHari[date('w')]);
		$data['view'] = 'admin/jadwal/jadwal-hari-ini';
		$this->load->view('admin/template',$data);
	}
	
	function pilih_hari($hari){
		$namaBulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$data['namaHari'] = array("Minggu","Senin", "Selasa", "Rabu", "Kamis", "Jumat","Sabtu");
		$data['hari'] = $hari;
		$data['bulan'] = $namaBulan[(date('n')-1)];
		$data['penjadwalan'] = $this->admin_jadwal_models->praktikum($hari);
		$data['view'] = 'admin/jadwal/jadwal-pilih-hari';
		$this->load->view('admin/template',$data);
	}
	
	//proses
	function status_jadwal(){
		$id_jadwal = $this->input->post('id');
		$respon = $this->input->post('status');
		$cek = $this->models->where1('penjadwalan','id_praktikum',$id_jadwal);
		$c = 0;
		foreach($cek as $rz){$c = $rz->status;}
		if($respon=='Aktif'&&$c==0){
			$data = array('status'=>1);
			$this->models->update('penjadwalan','id_praktikum',$id_jadwal,$data);
			$data2 = array('status'=>1);
			$this->models->update('absensi_asisten','id_praktikum',$id_jadwal,$data2);
			echo 'Aktif';
		}
		else{
			$data = array('status'=>0);
			$this->models->update('penjadwalan','id_praktikum',$id_jadwal,$data);
			$data2 = array('status'=>0);
			$this->models->update('absensi_asisten','id_praktikum',$id_jadwal,$data2);
			echo 'Tidak Aktif';
		}
	}
	
	function post_jadwal($pr_id){
		$id_praktikum = $this->input->post('id_praktikum');
		$pengajar1 = $this->input->post('pengajar1');
		$pengajar2 = $this->input->post('pengajar2');
		$kelas = $this->input->post('kelas');
		$matkum = $this->input->post('matkum');
		$hari = $this->input->post('hari');
		$jam = $this->input->post('jam');	
		$ruangan = $this->input->post('ruangan');
		$data = array(
				'id_praktikum'=>$id_praktikum,
				'pengajar1'=>$pengajar1,
				'pengajar2'=>$pengajar2,
				'pr_id'=>$pr_id,
				'id_matkum'=>$matkum,
				'id_kelas'=>$kelas,
				'hari'=>$hari,
				'jam'=>$jam,
				'id_ruangan'=>$ruangan,
				'kehadiran'=>30,
				'tugas'=>30,
				'ujian'=>40,
				'status'=>1
			);
		$c=0;
		$cek = $this->models->where1('penjadwalan','id_praktikum',$id_praktikum);
		foreach($cek as $rz){$c++;}
		if($c==0){
			$this->db->insert('penjadwalan',$data);
			echo "sukses|Data penjadwalan praktikum dengan :<br>ID Praktikum : $id_praktikum <br>Tersimpan.";	
		}
		else{
			echo "gagal|<font color='red'>Maaf, data penjadwalan praktikum dengan :<br>ID Praktikum : $id_praktikum <br>Sudah tersimpan sebelumnya.<br>Data gagal tersimpan.</font>";
		}
	}
	
	function update_jadwal(){
		$id = $this->input->post('id');
		$id_praktikum = $this->input->post('id_praktikum');
		$pengajar1 = $this->input->post('pengajar1');
		$pengajar2 = $this->input->post('pengajar2');
		$pr_id = $this->input->post('pr_id');
		$kelas = $this->input->post('kelas');
		$matkum = $this->input->post('matkum');
		$hari = $this->input->post('hari');
		$jam = $this->input->post('jam');	
		$ruangan = $this->input->post('ruangan');
		$kehadiran = $this->input->post('kehadiran');
		$tugas = $this->input->post('tugas');
		$ujian = $this->input->post('ujian');
		$data = array(
				'id_praktikum'=>$id_praktikum,
				'pengajar1'=>$pengajar1,
				'pengajar2'=>$pengajar2,
				'id_matkum'=>$matkum,
				'id_kelas'=>$kelas,
				'hari'=>$hari,
				'jam'=>$jam,
				'id_ruangan'=>$ruangan,
				'kehadiran'=>$kehadiran,
				'tugas'=>$tugas,
				'ujian'=>$ujian
			);
		$this->models->update('penjadwalan','id_praktikum',$id,$data);
		redirect('admin_jadwal/periode/'.$pr_id);
	}
	
	function hapus_jadwal($id_jadwal){
		$pr_id = $this->models->where1Row('penjadwalan','id_praktikum',$id_jadwal)->pr_id;
		$this->models->hapus('penjadwalan','id_praktikum',$id_jadwal);
		$this->models->hapus('registrasi_praktikum','id_praktikum',$id_jadwal);
		redirect('admin_jadwal/periode/'.$pr_id);
	}
}
?>