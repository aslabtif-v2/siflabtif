<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Admin_jadwal_models extends CI_Model{
		
		function __construct(){
			parent::__construct();			
		}		
		
		function jadwal($mulai, $tampil){
			return $this->db->query("SELECT penjadwalan.id_praktikum, penjadwalan.pengajar1, penjadwalan.pengajar2, mata_praktikum.mata_praktikum, kelas.kelas, hari, jam, ruangan.ruangan, penjadwalan.status FROM penjadwalan, mata_praktikum, kelas, ruangan WHERE penjadwalan.id_kelas=kelas.id_kelas AND penjadwalan.id_matkum=mata_praktikum.id_matkum AND penjadwalan.id_ruangan=ruangan.id_ruangan ORDER BY penjadwalan.status DESC, id_praktikum ASC LIMIT $mulai, $tampil")->result(); 	
		}

		function jadwalperiode($pr_id){
			return $this->db->query("SELECT penjadwalan.id_praktikum, penjadwalan.pengajar1, penjadwalan.pengajar2, periode.pr_id, periode.pr_periode, mata_praktikum.mata_praktikum, kelas.kelas, hari, jam, ruangan.ruangan, penjadwalan.status FROM penjadwalan, periode, mata_praktikum, kelas, ruangan WHERE penjadwalan.id_kelas=kelas.id_kelas AND penjadwalan.id_matkum=mata_praktikum.id_matkum AND penjadwalan.id_ruangan=ruangan.id_ruangan AND penjadwalan.pr_id=periode.pr_id AND periode.pr_id=$pr_id ORDER BY penjadwalan.status DESC, id_praktikum ASC ")->result(); 	
		}
		
		function edit_jadwal($id_praktikum){
			return $this->db->query("SELECT penjadwalan.id_praktikum, penjadwalan.pengajar1, penjadwalan.pengajar2, periode.pr_id, mata_praktikum.id_matkum, mata_praktikum.mata_praktikum,kelas.id_kelas, kelas.kelas, hari, jam,ruangan.id_ruangan, ruangan.ruangan,kehadiran,tugas,ujian, penjadwalan.status FROM penjadwalan, periode, mata_praktikum, kelas, ruangan WHERE penjadwalan.id_kelas=kelas.id_kelas AND penjadwalan.id_matkum=mata_praktikum.id_matkum AND penjadwalan.id_ruangan=ruangan.id_ruangan AND penjadwalan.pr_id=periode.pr_id AND penjadwalan.id_praktikum='$id_praktikum'")->result();
		}
		
		//lihat jadwal
		function praktikum($hari){
			return $this->db->query("SELECT id_praktikum, pengajar1,pengajar2,mata_praktikum.mata_praktikum,hari, jam, ruangan.ruangan, ruangan.id_ruangan, kelas.kelas FROM penjadwalan,mata_praktikum,kelas,ruangan WHERE penjadwalan.id_matkum=mata_praktikum.id_matkum AND penjadwalan.id_kelas=kelas.id_kelas AND penjadwalan.id_ruangan=ruangan.id_ruangan AND penjadwalan.status='1' AND hari='$hari' ORDER BY jam ASC")->result();	
		}
		
		function pertemuan($id_praktikum){
			return $this->db->query("SELECT MAX(pertemuan) AS pertemuan FROM absensi WHERE id_praktikum='$id_praktikum'")->row();	
		}
	}
?>