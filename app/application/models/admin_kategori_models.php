<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Admin_kategori_models extends CI_Model{
		
		function __construct(){
			parent::__construct();			
		}		
		
		function kategori(){
			/*$jenis = array(
				'CODE_MERK'=>'Merek',
				'KATE_BRNG'=>'Jenis Barang',
				'KNDS_BRNG'=>'Kondisi Barang'
			);
			return $jenis; */
			
			return $this->db->order_by('codd_desc','ASC')->get('code')->result();
		}
	}
?>