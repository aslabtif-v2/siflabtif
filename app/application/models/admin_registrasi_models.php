<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Admin_registrasi_models extends CI_Model{
		
		function __construct(){
			parent::__construct();			
		}		
		
		function mahasiswa(){
			return $this->db->query("SELECT * FROM mahasiswa,kelas WHERE mahasiswa.id_kelas=kelas.id_kelas AND RIGHT(REPLACE(kelas,' ',''),4)>=(".date('Y')."-5) ORDER BY mahasiswa.id_kelas, nama ASC")->result();	
		}
	}
?>