<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Admin_penggajian_models extends CI_Model{
		
		function __construct(){
			parent::__construct();			
		}		
		
		function asisten(){
			return $this->db->query("SELECT id_asisten, asisten.id_jabatan, nama,jabatan, honor_pertemuan, honor_perbulan FROM asisten, jabatan WHERE asisten.id_jabatan=jabatan.id_jabatan and status='1' order by nama ASC")->result();	
		}
		
		function shif($id_asisten){
			return $this->db->query("SELECT * FROM penjadwalan WHERE pengajar1='$id_asisten' OR pengajar2='$id_asisten'")->result();	
		}
		
		function pertemuan($id_praktikum,$id_asisten,$dari,$sampai){
			return $this->db->query("SELECT count(pertemuan) AS pertemuan FROM absensi_asisten WHERE id_praktikum='$id_praktikum' and id_asisten='$id_asisten' AND pertemuan>='$dari' AND pertemuan<='$sampai' and status='1'")->result();	
		}
	}
?>