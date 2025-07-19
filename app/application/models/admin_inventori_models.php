<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Admin_inventori_models extends CI_Model{
		
		function __construct(){
			parent::__construct();			
		}		
		
		function pc_laporan($id_ruangan){	
			$query = "
				SELECT pc.*, rows, c0.code_desc AS pc,c1.code_desc AS barang,c2.code_desc AS merek FROM inv_pc pc
				LEFT JOIN codexd c0 ON pc.code_pclb=c0.code_id AND c0.code_kate='CODE_PCLB'
				LEFT JOIN inv_barang b ON pc.brg_id=b.brg_id
				LEFT JOIN codexd c1 ON b.jnis_brng=c1.code_id AND c1.code_kate='JNIS_BRNG'
				LEFT JOIN codexd c2 ON b.code_merk=c2.code_id AND c2.code_kate='CODE_MERK'
				LEFT JOIN (
					SELECT id_ruangan, code_pclb, COUNT(code_pclb) AS ROWS FROM inv_pc
					GROUP BY id_ruangan, code_pclb
				) AS C ON pc.id_ruangan=C.id_ruangan AND pc.code_pclb=C.code_pclb
				WHERE pc.id_ruangan='$id_ruangan'
				ORDER BY c0.code_sort, c1.code_sort ASC
			";
			return $this->db->query($query)->result();
		}
		
		function pc($id_ruangan){
			$where = '';
			if($id_ruangan!=''){
				$where = "WHERE pc.id_ruangan='$id_ruangan'";
			}
			$query = "
				SELECT pc.id_ruangan, code_pclb, ruangan, code_desc FROM  ( 
					SELECT id_ruangan, code_pclb FROM inv_pc
					GROUP BY id_ruangan, code_pclb
				) AS pc
				LEFT JOIN ruangan r ON pc.id_ruangan=r.id_ruangan
				LEFT JOIN codexd ON code_pclb=code_id AND code_kate='CODE_PCLB'
				$where
				ORDER BY pc.id_ruangan, code_sort
			";
			return $this->db->query($query)->result();
		}
		
		function barang(){
			return $this->db->query("SELECT b.*,c1.code_desc merek,c2.code_desc barang FROM inv_barang b LEFT JOIN codexd c1 ON b.code_merk=c1.code_id LEFT JOIN codexd c2 ON b.jnis_brng=c2.code_id order by jnis_brng, code_merk")->result();	
		}
		
		function histori($id_ruangan){
			$where='';
			if($id_ruangan!=''){
				$where = "where t1.id_ruangan='$id_ruangan'";
			}
			$query = "
				SELECT allo_id, allo_qtty, t1.id_ruangan, ruangan,t4.nama AS asisten, B.*, t3.code_desc kondisi, allo_tanggal FROM inv_alokasi t1
				LEFT JOIN ruangan t2 ON t1.id_ruangan=t2.id_ruangan
				LEFT JOIN asisten t4 ON t1.id_asisten=t4.id_asisten
				LEFT JOIN (
					SELECT t1.*, t2.code_desc merek, t3.code_desc barang FROM inv_barang t1
					LEFT JOIN codexd t2 ON t1.code_merk=t2.code_id
					LEFT JOIN codexd t3 ON t1.jnis_brng=t3.code_id
				) B
				ON t1.brg_id=B.brg_id
				LEFT JOIN codexd t3 ON t1.knds_brng=t3.code_id
				$where
				ORDER BY allo_id desc
			";
			return $this->db->query($query)->result();
		}
		function laporan_inv($id_ruangan){
			$where = "";
			if($id_ruangan!=''){
				$where = "WHERE rp.id_ruangan='$id_ruangan'";
			}
			$sql = "SELECT rp.*, r.ruangan, a.nama AS asisten FROM inv_report rp LEFT JOIN ruangan r ON rp.id_ruangan=r.id_ruangan LEFT JOIN asisten a ON rp.id_asisten=a.id_asisten $where ORDER BY rpt_id DESC";
			return $this->db->query($sql)->result();
		}
		function laporan($date, $lab){
			$ceklab = "";
			if($lab!=''){
				$ceklab ="WHERE bagus_qtty IS NOT NULL";
			}
			
			if($date!=''){
				$date = "AND allo_tanggal <= '$date'";
			}
			
			$query = "
				SELECT A.brg_id, 
					barang, 
					merek,
					IFNULL(baru_qtty,0) baru_ori,
					IFNULL(baru_qtty,0)-IFNULL(bagus_qtty,0)baru_qtty, 
					IFNULL(bagus_qtty,0)-(IFNULL(rusak_qtty,0)-IFNULL(hilang_qtty,0))bagus_qtty, 
					IFNULL(rusak_qtty,0)rusak_qtty, 
					IFNULL(hilang_qtty,0)hilang_qtty
				FROM (	
					SELECT SUM(allo_qtty)baru_qtty, B.*, t3.code_desc kondisi FROM inv_alokasi t1
					LEFT JOIN (
						SELECT t1.brg_id, t2.code_desc merek, t3.code_desc barang FROM inv_barang t1
						LEFT JOIN codexd t2 ON t1.code_merk=t2.code_id
						LEFT JOIN codexd t3 ON t1.jnis_brng=t3.code_id
					) B ON t1.brg_id=B.brg_id
					LEFT JOIN codexd t3 ON t1.knds_brng=t3.code_id
					WHERE t3.code_desc='Baru'
					$date
					GROUP BY brg_id, merek, barang, kondisi
				) A
				LEFT JOIN (
					SELECT SUM(allo_qtty)bagus_qtty, brg_id, t3.code_desc kondisi FROM inv_alokasi t1
					LEFT JOIN codexd t3 ON t1.knds_brng=t3.code_id	
					WHERE t3.code_desc='Bagus'
					$lab
					$date
					GROUP BY brg_id, t3.code_desc	
				) B ON A.brg_id=B.brg_id 
				LEFT JOIN (
					SELECT SUM(allo_qtty)hilang_qtty, brg_id, t3.code_desc kondisi FROM inv_alokasi t1
					LEFT JOIN codexd t3 ON t1.knds_brng=t3.code_id	
					WHERE t3.code_desc='Hilang'
					$lab
					$date
					GROUP BY brg_id, t3.code_desc	
				) C ON A.brg_id=C.brg_id 
				LEFT JOIN (
					SELECT SUM(allo_qtty)rusak_qtty, brg_id, t3.code_desc kondisi FROM inv_alokasi t1
					LEFT JOIN codexd t3 ON t1.knds_brng=t3.code_id	
					WHERE t3.code_desc='Rusak'
					$lab
					$date
					GROUP BY brg_id, t3.code_desc	
				) D ON A.brg_id=D.brg_id
				$ceklab
				ORDER BY barang, merek
			";
			return $this->db->query($query)->result();
		}
	}
?>
