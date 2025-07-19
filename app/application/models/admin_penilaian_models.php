<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Admin_penilaian_models extends CI_Model{
		
		function __construct(){
			parent::__construct();			
		}		
		
		function nilai_mahasiswa($id_praktikum){
			return $this->db->query("SELECT id_registrasi, registrasi_praktikum.id_praktikum, mahasiswa.npm, mahasiswa.nama, registrasi_praktikum.tugas, registrasi_praktikum.ujian FROM registrasi_praktikum,  mahasiswa WHERE registrasi_praktikum.npm=mahasiswa.npm AND registrasi_praktikum.id_praktikum='$id_praktikum' and byr_status='1' ORDER BY mahasiswa.nama ASC")->result();	
		}
		
		function kehadiran($id_praktikum,$npm){
			return $this->db->query("SELECT COUNT(npm) AS kehadiran  FROM absensi WHERE id_praktikum='$id_praktikum' AND npm='$npm'")->row();	
		}
	}
?>