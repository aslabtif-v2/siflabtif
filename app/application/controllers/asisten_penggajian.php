<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asisten_penggajian extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models','admin_penggajian_models'));
		$this->load->helper(array('url','form'));
		session_start();
		if(!isset($_SESSION['password'])||($_SESSION['jabatan']!='sekretaris')&&($_SESSION['jabatan']!='bendahara')&&($_SESSION['jabatan']!='koordinatorlab')){
			redirect(base_url());
		}
	}
	
	function gaji($dari,$sampai,$bulan){
		$data['asisten'] = $this->admin_penggajian_models->asisten();
		$data['dari'] = $dari;
		$data['sampai'] = $sampai;
		$data['bulan'] = $bulan;
		$data['view'] = 'asisten/penggajian/penggajian';
		$this->load->view('asisten/template',$data);
	}
	
	function cetak($dari,$sampai,$bulan){
		$namabulan = array("","Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$this->fpdf->FPDF('P','mm','A4');
		$this->fpdf->AddPage();
		$this->fpdf->Image("image/logo-teknik.png", 11, 10, 20, 19);
		$this->fpdf->SetFont('Arial', 'B', 10);
		$this->fpdf->Cell(23, 5, '');
		$this->fpdf->Cell(100, 5, 'Program Studi Teknik Informatika', 0, 1);	
		$this->fpdf->Cell(23, 5, '');
		$this->fpdf->Cell(80, 5, 'Fakultas Teknik', 0, 1);
		$this->fpdf->Cell(23, 5, '');
		$this->fpdf->Cell(80, 5, 'Universitas Suryakancana Cianjur', 0, 1);
		$this->fpdf->SetFont('Arial', '', '7');
		$this->fpdf->Cell(23, 5, '');
		$this->fpdf->Cell(80,5, 'Jln. Pasir Gede Raya (BLK RSU) Telp. (0263) 5019915 - Cianjur 43216', 0, 1);
		$this->fpdf->SetLineWidth(0.5);
		$this->fpdf->Line(10, 31, 200, 31);
		$this->fpdf->SetLineWidth(0);
		$this->fpdf->Line(10, 32, 200, 32);
		$this->fpdf->Ln();
		$this->fpdf->SetFillColor(190, 190, 190);
		$this->fpdf->Cell(10, 5, 'No', 1, 0, 'C', true);
		$this->fpdf->Cell(40, 5, 'Nama', 1, 0, 'C', true);
		$this->fpdf->Cell(35, 5, 'Jabatan', 1, 0, 'C', true);
		$this->fpdf->Cell(25, 5, 'Jumlah', 1, 0, 'C', true);
		$this->fpdf->Cell(25, 5, 'Honor/Pertemnuan', 1, 0, 'C', true);
		$this->fpdf->Cell(25, 5, 'Honor/Jabat', 1, 0, 'C', true);
		$this->fpdf->Cell(25, 5, 'Total', 1, 1, 'C', true);
		$namaKorlab ='';
		$total_pertemuan=0;
		$total_honor=0;
		$total_jabatan=0;
		$total_total=0;
		$no = 0;
		$asisten = $this->admin_penggajian_models->asisten();
		foreach($asisten as $asistens){
			$korlab = $this->models->where2Row('asisten','id_jabatan','status',$asistens->id_jabatan,1);
			if($korlab->id_jabatan=='koordinatorlab'){
				$namaKorlab = $asistens->nama;	
			}
			$no++;
			$this->fpdf->Cell(10, 5, $no, 1, 0, 'C');
			$this->fpdf->Cell(40, 5, $asistens->nama, 1, 0, 'C');
			$this->fpdf->Cell(35, 5, $asistens->jabatan, 1, 0, 'C');
			$jshif = 0;
			$shif = $this->admin_penggajian_models->shif($asistens->id_asisten);
			foreach($shif as $shifs){
				$pertemuan = $this->admin_penggajian_models->pertemuan($shifs->id_praktikum,$asistens->id_asisten,$dari,$sampai);
				foreach($pertemuan as $pertemuans){
					$jshif = $jshif+$pertemuans->pertemuan;
				}
			}
			$honorp = $jshif*$asistens->honor_pertemuan;
			$honorj = $bulan*$asistens->honor_perbulan;
			$total = $honorj+$honorp;
			$this->fpdf->Cell(25, 5, $jshif, 1, 0, 'C');
			$this->fpdf->Cell(25, 5, ' Rp.'.number_format($honorp,0,'','.'), 1);
			$this->fpdf->Cell(25, 5, ' Rp.'.number_format($honorj,0,'','.'), 1);
			$this->fpdf->Cell(25, 5, ' Rp.'.number_format($total,0,'','.'), 1, 1);
			$total_pertemuan=$jshif+$total_pertemuan;
			$total_honor=$honorp+$total_honor;
			$total_jabatan=$honorj+$total_jabatan;
			$total_total=$total+$total_total;
		}
		$this->fpdf->Cell(85, 5, 'Total', 1, 0, 'C');
		$this->fpdf->Cell(25, 5, $total_pertemuan, 1, 0, 'C');
		$tampil=array($total_honor, $total_jabatan, $total_total);
		for($i=0; $i<3; $i++)
		{
			$this->fpdf->Cell(25, 5, ' Rp.'.number_format($tampil[$i],0,'','.'), 1);				
		}
		$this->fpdf->Ln();
		$this->fpdf->Ln();
		$this->fpdf->Cell(150, 2, 'Cianjur, '.date('d').' '.$namabulan[date('m')-1].' '.date('Y'), 0, 1, 'R');
		$this->fpdf->Cell(150, 5, 'Koordinator Laboratorium', 0, 1, 'R');
		$this->fpdf->Ln();
		$this->fpdf->Ln();
		$this->fpdf->Cell(150, 5, $namaKorlab, 0, 0, 'R');
		$this->fpdf->output();
	}
}
?>