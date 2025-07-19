<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Admin_pesan_models extends CI_Model{
		
		function __construct(){
			parent::__construct();			
		}		
		
		function pesan($user1,$user2){
			return $this->db->query("SELECT pesan_balasan.id_balasan, pesan_balasan.id_pesan, pesan.user_satu, pesan.user_dua, pesan_balasan.pesan, pesan_balasan.tanggal, pesan_balasan.status FROM pesan, pesan_balasan WHERE CASE WHEN pesan.user_satu='$user1' THEN pesan.user_dua='$user2' WHEN pesan.user_dua='$user1' THEN pesan.user_satu='$user2' END AND pesan.id_pesan=pesan_balasan.id_pesan ORDER BY pesan_balasan.id_pesan ASC")->result();	
		}

		function jumlah_pesan($user){
			return $this->db->query("SELECT pesan_balasan.id_pesan, pesan.user_satu, COUNT(pesan_balasan.status) AS jumlah, MAX(pesan_balasan.pesan) AS pesan FROM pesan_balasan, pesan WHERE pesan_balasan.id_pesan=pesan.id_pesan AND pesan.user_dua='$user' AND pesan_balasan.status='1' GROUP BY pesan.user_satu")->result();	
		}
		
		function update_pesan($ke,$dari){
			return $this->db->query("SELECT pesan_balasan.id_pesan, pesan.user_satu, pesan.user_dua FROM pesan_balasan, pesan WHERE pesan_balasan.id_pesan=pesan.id_pesan AND pesan.user_dua='$ke' AND pesan.user_satu='$dari' AND pesan_balasan.status='1'")->result();	
		}
		
		function inbox($user){
			return $this->db->query("SELECT pesan_balasan.id_pesan, MAX(pesan_balasan.pesan) AS pesan, pesan_balasan.tanggal, pesan_balasan.status, user_satu, user_dua FROM pesan_balasan, pesan WHERE pesan.id_pesan=pesan_balasan.id_pesan AND user_satu='$user' OR user_dua='$user' GROUP BY user_dua order by id_balasan DESC")->result();	
		}
	}
?>