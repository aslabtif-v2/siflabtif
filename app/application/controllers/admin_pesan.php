<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_pesan extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models','admin_pesan_models'));
		$this->load->helper(array('url','form','smiley'));
		date_default_timezone_set('Asia/Jakarta');
		session_start();
		if(!isset($_SESSION['password'])||($_SESSION['jabatan']!='adminsistem')){
			redirect(base_url());
		}
	}
	
	function index($user1,$user2){
		$data['user1'] = $user1;
		$data['user2'] = $user2;
		$data2 = array('status'=>0);
		$cek = $this->admin_pesan_models->update_pesan($user1,$user2);
		foreach($cek as $update){
			$this->models->update('pesan_balasan','id_pesan',$update->id_pesan,$data2);
		}
		$data['namaAsisten'] = $this->models->where1Row('asisten','id_asisten',$user2);
		$data['asisten'] = $this->models->where1menurun('asisten','status',1,'nama','ASC');
		$data['pesan'] = $this->admin_pesan_models->pesan($user1,$user2);
		$data['view'] = 'admin/pesan/pesan';
		$this->load->view('admin/template',$data);
	}
	
	function inbox(){
		$data['asisten'] = $this->models->where1menurun('asisten','status',1,'nama','ASC');
		$data['pesan'] = $this->admin_pesan_models->inbox($_SESSION['id_asisten']);
		$data['view'] = 'admin/pesan/pesan-daftar';
		$this->load->view('admin/template',$data);
	}
	
	function pesan(){
		$user1 = $this->input->post('user1');
		$user2 = $this->input->post('user2');
		$pesan = $this->input->post('pesan');
		if($user2!='all' && $user2!=0){
				$data = array(
					'id_pesan'=>'',
					'user_satu'=>$user1,
					'user_dua'=>$user2,
					'tanggal'=>date('Y-m-d')
				);
				$this->db->insert('pesan',$data);
				$max = $this->models->maxx('pesan','id_pesan');
				$data2 = array(
						'id_balasan'=>'',
						'pesan'=>$pesan,
						'id_user'=>$user1,
						'tanggal'=>date('Y-m-d'),
						'id_pesan'=>$max->id_pesan
					);
				$this->db->insert('pesan_balasan',$data2);
				echo 'sukses';
		}
		else if($user2=='all'){
			$all = $this->models->where1('asisten','status',1);
			foreach($all as $semua){
				$data = array(
					'id_pesan'=>'',
					'user_satu'=>$user1,
					'user_dua'=>$semua->id_asisten,
					'tanggal'=>date('Y-m-d')
				);
				$this->db->insert('pesan',$data);
				$max = $this->models->maxx('pesan','id_pesan');
				$data2 = array(
						'id_balasan'=>'',
						'pesan'=>$pesan,
						'id_user'=>$user1,
						'tanggal'=>date('Y-m-d'),
						'id_pesan'=>$max->id_pesan
					);
				$this->db->insert('pesan_balasan',$data2);
			}
			echo 'sukses';
		}
		else{
			echo 'gagal';
		}
	}
	
	function refresh_pesan($user1,$user2){
		$data3['asisten'] = $this->models->where1menurun('asisten','status',1,'nama','ASC');
		$data3['pesan'] = $this->admin_pesan_models->pesan($user1,$user2);
		$data3['user1'] = $user1;
		$data3['user2'] = $user2;
		//status
		$data2 = array('status'=>0);
		$cek = $this->admin_pesan_models->update_pesan($user1,$user2);
		foreach($cek as $update){
			$this->models->update('pesan_balasan','id_pesan',$update->id_pesan,$data2);
		}
		$this->load->view('admin/pesan/load/pesan-load',$data3);
	}
	
	function refresh_jumlah_pesan(){
		$this->load->view('admin/pesan/load/jumlah-pesan-load');
	}
	
	function kosongkan($tabel,$tabel2){
		$this->models->KosongkanTabel2($tabel,$tabel2);
		redirect("admin_pesan/index/".$_SESSION['id_asisten']."/0");
	}
}
?>