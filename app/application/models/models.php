<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class models extends CI_Model{
		
		function __construct(){
			parent::__construct();			
		}

		function jumlah($tbl,$att,$isi){
			return $this->db->query("SELECT COUNT($att) AS jumlah FROM $tbl WHERE $att='$isi'")->row()->jumlah;
		}

		function cekdata($tbl,$att,$isi){
			return $this->db->query("SELECT COUNT($att) AS jumlah FROM (SELECT * FROM $tbl WHERE $att='$isi' LIMIT 1) tabel")->row()->jumlah;
		}

		function tabel2where2order($tbl1,$tbl2,$att,$att1,$isi1,$att2,$isi2,$atto,$aksi){
			return $this->db->query("SELECT * FROM $tbl1 LEFT JOIN $tbl2  ON $tbl1.$att=$tbl2.$att WHERE $att1='$isi1' AND $att2='$isi2' ORDER BY $atto $aksi")->result();			
		}
		
		function where3($tbl,$att1,$att2,$att3,$isi1,$isi2,$isi3){
			$this->db->where($att1,$isi1)->where($att2,$isi2)->where($att3,$isi3);
			return $this->db->get($tbl)->result();
		}
		
		function where2($tbl,$att1,$att2,$isi1,$isi2){
			$this->db->where($att1,$isi1)->where($att2,$isi2);
			return $this->db->get($tbl)->result();
		}
		
		function where1($tbl,$att1,$isi1){
			$this->db->where($att1,$isi1);
			return $this->db->get($tbl)->result();
		}
		
		function where3Row($tbl,$att1,$att2,$att3,$isi1,$isi2,$isi3){
			$this->db->where($att1,$isi1)->where($att2,$isi2)->where($att3,$isi3);
			return $this->db->get($tbl)->row();
		}
		
		function where2Row($tbl,$att1,$att2,$isi1,$isi2){
			$this->db->where($att1,$isi1)->where($att2,$isi2);
			return $this->db->get($tbl)->row();
		}
		
		function where1Row($tbl,$att1,$isi1){
			$this->db->where($att1,$isi1);
			return $this->db->get($tbl)->row();
		}
		
		function where1menurun($tbl,$att1,$isi1,$att2,$aksi){
			$this->db->order_by($att2,$aksi);
			$this->db->where($att1,$isi1);
			return $this->db->get($tbl)->result();
		}
		
		function maxx($tabel,$att){
			$this->db->select_max($att);
			return $this->db->get($tabel)->row();	
		}
		
		function maxwhere($tabel,$att1,$isi,$att2){
			return $this->db->where($att1,$isi)->select_max($att2)->get($tabel)->row();
			//$this->db;	
		}
		
		function lihat_menurun($tabel,$aksi,$att){
			$this->db->order_by($att,$aksi);
			return $this->db->get($tabel)->result();	
		}
		
		function cari1($tabel,$att,$cari){
			$this->db->like($att,$cari);
			return $this->db->get($tabel)->result();
		}
		
		function update($tabel,$att,$isi,$data){
			$this->db->where($att, $isi);
			$this->db->update($tabel, $data); 	
		}
		
		function update2($tabel,$att,$isi,$att2,$isi2,$data){
			$this->db->where($att, $isi)->where($att2,$isi2);
			$this->db->update($tabel, $data); 	
		}
		
		function hapus($tabel,$att,$isi){
			$this->db->delete($tabel, array($att => $isi));	
		}		
		
		function hapus2($tabel,$att1,$att2,$isi1,$isi2){
			$this->db->where($att1,$isi1)->where($att2,$isi2);
			$this->db->delete($tabel); 	
		}

		function hapus3($tabel,$att1,$att2,$att3,$isi1,$isi2,$isi3){
			$this->db->where($att1,$isi1)->where($att2,$isi2)->where($att3,$isi3);
			$this->db->delete($tabel); 	
		}
		
		function hapus4($tabel,$att1,$att2,$att3,$att4,$isi1,$isi2,$isi3,$isi4){
			$this->db->where($att1,$isi1)->where($att2,$isi2)->where($att3,$isi3)->where($att4,$isi4);
			$this->db->delete($tabel); 	
		}
		function KosongkanTabel2($tabel1,$tabel2){
			$this->db->truncate($tabel1); 
			$this->db->truncate($tabel2); 
		}
	}
?>