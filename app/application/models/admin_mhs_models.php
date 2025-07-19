<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Admin_mhs_models extends CI_Model{
		
		function __construct(){
			parent::__construct();			
		}		
		
		function mahasiswa($carikan,$mulai,$tampil){
			return $this->db->query("SELECT * FROM mahasiswa,kelas WHERE mahasiswa.id_kelas=kelas.id_kelas $carikan ORDER BY mahasiswa.id_kelas, nama ASC LIMIT $mulai, $tampil")->result();	
		}
		
		function where1mhs($npm){
			return $this->db->query("SELECT * FROM mahasiswa,kelas WHERE mahasiswa.id_kelas=kelas.id_kelas AND npm='$npm'")->result();	
		}
		
		//function cari_mhs($carikan){
		//		return $this->db->query("SELECT * FROM mahasiswa,kelas WHERE mahasiswa.id_kelas=kelas.id_kelas $carikan ORDER BY mahasiswa.id_kelas, nama ASC")->result();	
		//}
	}
?>