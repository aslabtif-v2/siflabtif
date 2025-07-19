<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class m_kuisioner extends CI_Model{
		
		function __construct(){
			parent::__construct();			
		}

		function getAllData($table, $where = null, $order = null)
        {
            if ($where !== null) {
                foreach ($where as $key => $value) {
                    $this->db->where($key, $value);
                }
            }

            if ($order !== null) {
                foreach ($order as $key => $value) {
                    $this->db->order_by($key, $value);
                }
            }

            $query = $this->db->get($table);

            return $query;
        }

        function getRataPraktikum(){
            $sql = "SELECT kode_praktikum, AVG(nilai) AS nilai FROM `penilaian_mahasiswa` GROUP BY kode_praktikum";
            
            $query = $this->db->query($sql);

		    return $query->result_array();
        }

        function getDetailRataPraktikum($kd_praktikum){
            $sql = "SELECT penilaian_mahasiswa.kode_penilaian, aspek_penilaian.uraian, kategori_penilaian.kategori, AVG(penilaian_mahasiswa.nilai) AS nilai FROM `penilaian_mahasiswa` LEFT JOIN aspek_penilaian ON penilaian_mahasiswa.kode_penilaian = aspek_penilaian.id LEFT JOIN kategori_penilaian ON aspek_penilaian.id_kategori = kategori_penilaian.id WHERE kode_praktikum = '".$kd_praktikum."' GROUP BY kode_penilaian";

            $query = $this->db->query($sql);

		    return $query->result_array();
        }

        function getDetailRataAsisten($kd_asisten){
            $sql = "SELECT penilaian_asisten.kode_penilaian, aspek_penilaian.uraian, kategori_penilaian.kategori, AVG(penilaian_asisten.nilai) AS nilai FROM `penilaian_asisten` LEFT JOIN aspek_penilaian ON penilaian_asisten.kode_penilaian = aspek_penilaian.id LEFT JOIN kategori_penilaian ON aspek_penilaian.id_kategori = kategori_penilaian.id WHERE menilai = '".$kd_asisten."' GROUP BY kode_penilaian";

            $query = $this->db->query($sql);

		    return $query->result_array();
        }

        function getNilaiAsisten($kd_asisten){
            $sql = "SELECT kode_asisten, AVG(nilai) as nilai FROM `penilaian_asisten` WHERE menilai = '".$kd_asisten."' GROUP BY kode_asisten";

            $query = $this->db->query($sql);

		    return $query->result_array();
        }

        function getUraian($tipe){
            $sql = "SELECT aspek_penilaian.*, kategori_penilaian.kategori FROM `aspek_penilaian` LEFT JOIN kategori_penilaian ON kategori_penilaian.id = aspek_penilaian.id_kategori WHERE aspek_penilaian.tipe_penilaian = '".$tipe."' AND aspek_penilaian.status = '1'";
            
            $query = $this->db->query($sql);

		    return $query->result_array();
        }

        function getAllAsisten(){
            $sql = "SELECT asisten.username, asisten.nama, MAX(penilaian_asisten.avg) AS `nilai`
            FROM asisten
            LEFT JOIN (SELECT kode_asisten, menilai, semester, AVG(nilai) AS `avg` FROM penilaian_asisten GROUP BY menilai) penilaian_asisten ON penilaian_asisten.menilai = asisten.username
            WHERE asisten.status = '1'
            GROUP BY asisten.username
            ORDER BY MAX(penilaian_asisten.avg) DESC";

            $query = $this->db->query($sql);

            return $query->result_array();
        }

        function getAllMenilaiAsisten($kd_asisten){
            $sql = "SELECT asisten.username, asisten.nama, status_penilaian_asisten.status FROM asisten LEFT JOIN status_penilaian_asisten ON status_penilaian_asisten.menilai = asisten.username AND status_penilaian_asisten.kode_asisten = '".$kd_asisten."' WHERE asisten.status = '1'";

            $query = $this->db->query($sql);

            return $query->result_array();
        }

        function insertData($table, $data)
        {
            $this->db->insert($table, $data);
        }

        function insertAllData($table, $data)
        {
            $this->db->insert_batch($table, $data);
        }
	}
