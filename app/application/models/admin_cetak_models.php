<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Admin_cetak_models extends CI_Model{
		
		function __construct(){
			parent::__construct();			
		}		
		function keterangan_praktikum($id_praktikum){
			return $this->db->query("SELECT id_praktikum, pengajar1,pengajar2,mata_praktikum.mata_praktikum,hari, jam, ruangan.ruangan, kelas.kelas FROM penjadwalan,mata_praktikum,kelas,ruangan WHERE penjadwalan.id_matkum=mata_praktikum.id_matkum AND penjadwalan.id_kelas=kelas.id_kelas AND penjadwalan.id_ruangan=ruangan.id_ruangan AND penjadwalan.id_praktikum='$id_praktikum'")->result();	
		}
		
		function tanggal_cetak($tabel,$att1,$att2,$isi1,$isi2){
			return $this->db->query("SELECT * FROM $tabel WHERE $att1='$isi1' AND $att2='$isi2' LIMIT 0,1")->result();	
		}
		
		function mahasiswa($id_praktikum){
			return $this->db->query("SELECT * FROM registrasi_praktikum, mahasiswa, kelas WHERE id_praktikum='$id_praktikum' and byr_status='1' AND registrasi_praktikum.npm=mahasiswa.npm AND mahasiswa.id_kelas=kelas.id_kelas ORDER BY mahasiswa.nama")->result();	
		}
		
		function asisten($id_praktikum){
			return $this->db->query("SELECT * FROM registrasi_praktikum WHERE id_praktikum='$id_praktikum'")->result();	
		}
		
		function cek_cetak($id_praktikum,$pertemuan,$npm){
			return $this->db->query("SELECT * FROM absensi WHERE id_praktikum='$id_praktikum' AND pertemuan='$pertemuan' AND npm='$npm'")->num_rows();	
		}
		
		function cek_cetak_asisten($id_praktikum,$pertemuan,$id_asisten){
			return $this->db->query("SELECT * FROM absensi_asisten WHERE id_praktikum='$id_praktikum' AND pertemuan='$pertemuan' AND id_asisten='$id_asisten'")->num_rows();	
		}
		
		function mhskelas($npm){
			return $this->db->query("SELECT * FROM mahasiswa, kelas WHERE mahasiswa.id_kelas=kelas.id_kelas AND mahasiswa.npm='$npm'")->result();
		}
		
		function mhs_matkum($id_praktikum){
			return $this->db->query("SELECT mata_praktikum.mata_praktikum FROM penjadwalan, mata_praktikum WHERE penjadwalan.id_matkum=mata_praktikum.id_matkum AND penjadwalan.id_praktikum='$id_praktikum'")->row();	
		}
		function berita_acara($where){
			$this->db->where($where);
			$query =  $this->db->get('berita_acara');
			return $query->result();
		}
	}
?>