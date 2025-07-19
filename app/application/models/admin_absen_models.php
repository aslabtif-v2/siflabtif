<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Admin_absen_models extends CI_Model{
		
		function __construct(){
			parent::__construct();			
		}		
		
		function mahasiswa($id_praktikum){
			return $this->db->query("SELECT id_registrasi,id_praktikum,mahasiswa.npm,mahasiswa.nama,kelas.id_kelas,kelas.kelas FROM registrasi_praktikum,mahasiswa,kelas WHERE registrasi_praktikum.npm=mahasiswa.npm AND mahasiswa.id_kelas=kelas.id_kelas AND id_praktikum='$id_praktikum' and byr_status='1' ORDER BY nama ASC")->result();	
		}
		
		function cek($tabel,$id_praktikum,$npm,$pertemuan){
			return $this->db->query("SELECT COUNT(id_absensi) AS hadir FROM $tabel WHERE id_praktikum='$id_praktikum' AND npm='$npm' AND pertemuan='$pertemuan'")->row();
		}
		
		function cek_asisten($tabel,$id_praktikum,$username,$pertemuan){
			return $this->db->query("SELECT COUNT(id_absensi_asisten) AS hadir FROM $tabel WHERE id_praktikum='$id_praktikum' AND id_asisten='$username' AND pertemuan='$pertemuan'")->row();
		}
		
		function keterangan_praktikum($id_praktikum){
			return $this->db->query("SELECT id_praktikum, pengajar1,pengajar2,mata_praktikum.mata_praktikum,hari, jam, ruangan.ruangan, kelas.kelas FROM penjadwalan,mata_praktikum,kelas,ruangan WHERE penjadwalan.id_matkum=mata_praktikum.id_matkum AND penjadwalan.id_kelas=kelas.id_kelas AND penjadwalan.id_ruangan=ruangan.id_ruangan AND penjadwalan.id_praktikum='$id_praktikum'")->result();	
		}
		
		//asisten
		function id_praktikum($id_asisten){
			return $this->db->query("SELECT id_praktikum FROM penjadwalan WHERE  penjadwalan.status='1' AND pengajar1='$id_asisten' OR  pengajar2='$id_asisten' AND penjadwalan.status='1' ORDER BY id_praktikum ASC")->result();	
		}
		
		function pertemuan($id_praktikum){
			return $this->db->query("SELECT MAX(pertemuan) AS pertemuan FROM absensi WHERE id_praktikum='$id_praktikum'")->row();	
		}
	}
?>