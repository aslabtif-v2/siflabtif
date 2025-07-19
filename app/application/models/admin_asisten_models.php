<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Admin_asisten_models extends CI_Model{
		
		function __construct(){
			parent::__construct();			
		}		
		
		function asisten($tampil,$mulai){
			return $this->db->query("SELECT id_asisten,username,nama,jabatan,foto,asisten.status FROM asisten,jabatan WHERE asisten.id_jabatan=jabatan.id_jabatan ORDER BY asisten.status DESC, nama ASC LIMIT $tampil, $mulai")->result();	
		}
		
		function lihat_asisten($id_asisten){
			return $this->db->query("SELECT * FROM asisten,jabatan WHERE asisten.id_jabatan=jabatan.id_jabatan AND id_asisten='$id_asisten'")->result();	
		}
	}
?>