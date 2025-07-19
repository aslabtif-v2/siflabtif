<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_cetak extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models','admin_cetak_models','admin_penilaian_models'));
		$this->load->helper(array('url'));
		date_default_timezone_set('Asia/Jakarta');
		session_start();
		if(!isset($_SESSION['password'])||($_SESSION['jabatan']!='sekretaris')&&($_SESSION['jabatan']!='bendahara')&&($_SESSION['jabatan']!='adminsistem')&&($_SESSION['jabatan']!='koordinatorlab')){
			redirect(base_url());
		}
	}
	
	function absensi_asisten(){
		$id_praktikum = $this->models->where1menurun('penjadwalan','status',1,'id_praktikum','ASC');
		foreach($id_praktikum as $praktikum){
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
			$this->fpdf->Cell(110,5, 'Jln. Pasir Gede Raya (BLK RSU) Telp. (0263) 5019915 - Cianjur 43216', 0);
			$this->fpdf->Cell(13, 5, 'Tanggal :');
			$this->fpdf->Cell(7, 5, date('d'), 1);
			$this->fpdf->Cell(4, 5, ' / ');
			$this->fpdf->Cell(7, 5, date('m'), 1);
			$this->fpdf->Cell(4, 5, ' / ');
			$this->fpdf->Cell(15, 5, date('Y'), 1, 1);
			$this->fpdf->SetLineWidth(0.5);
			$this->fpdf->Line(10, 31, 200, 31);
			$this->fpdf->SetLineWidth(0);
			$this->fpdf->Line(10, 32, 200, 32);
			$this->fpdf->Ln();				
			$this->fpdf->SetFont('Arial', 'B', 10);
			$this->fpdf->Cell(0, 5, 'Absensi Asisten', 0, 1, 'C');
			$this->fpdf->SetFont('Arial', '', 7);
			$this->fpdf->Cell(75, 5, '');
			$this->fpdf->Cell(20, 5, 'ID Praktikum');
			$this->fpdf->Cell(0, 5, ': '.strtoupper($praktikum->id_praktikum), 0, 1);
			$kePraktikum = $this->admin_cetak_models->keterangan_praktikum($praktikum->id_praktikum);
			foreach($kePraktikum as $kePraktikums){
				$ass = $this->models->where1Row('asisten','id_asisten',$kePraktikums->pengajar1);
				$ass2 = $this->models->where1Row('asisten','id_asisten',$kePraktikums->pengajar2);
				$id_asisten = $ass->id_asisten;
				$id_asisten2 = $ass2->id_asisten;
				$asisten1 = $ass->nama;
				$asisten2 = $ass2->nama;
				$kata=array('Kelas', 'Mata Praktikum', 'Jadwal', 'Ruang');
				$isi=array($kePraktikums->kelas, $kePraktikums->mata_praktikum, $kePraktikums->hari.', '.$kePraktikums->jam, $kePraktikums->ruangan);
				for($i=0; $i<4; $i++)
				{
					$this->fpdf->Cell(75, 5, '');
					$this->fpdf->Cell(20, 5, $kata[$i]);
					$this->fpdf->Cell(0, 5, ': '.$isi[$i], 0, 1);							
				}
			}
			$this->fpdf->Ln();
			$this->fpdf->SetFillColor(190, 190, 190);
			$this->fpdf->Cell(10, 15, 'No', 1, 0, 'C', true);
			$this->fpdf->Cell(30, 15, 'ID Asisten', 1, 0, 'C', true);
			$this->fpdf->Cell(40, 15, 'Nama Asisten', 1, 0, 'C', true);
			$this->fpdf->Cell(100, 5, 'Tanggal & Kehadiran', 1, 0, 'C', true);
			$this->fpdf->Cell(10, 15, 'Total', 1, 1, 'C', true);
			$this->fpdf->SetXY(10,75);
			$this->fpdf->Cell(80, 5, '', 0, 0);
			$n=0;
			for($pertemuan=1; $pertemuan<=10; $pertemuan++){
				$tanggals = $this->admin_cetak_models->tanggal_cetak('absensi_asisten','id_praktikum','pertemuan',$praktikum->id_praktikum,$pertemuan);
				foreach($tanggals as $tanggal){
					$pertemuan == 10 ? $ln=1 : $ln=0;
					$data=$this->tanggal($tanggal->tanggal);
					$this->fpdf->Cell(10, 5, $data, 1, $ln, 'C', true);
					$n++;
				}
			}
			for($pertemuan=$n; $pertemuan<10; $pertemuan++)
			{
				$pertemuan == 9 ? $ln=1 : $ln=0;
				$this->fpdf->Cell(10, 5, '0/0', 1, $ln, 'C', true);					
			}
			$this->fpdf->Cell(80, 5, '', 0, 0);
			for($pertemuan=1; $pertemuan<=10; $pertemuan++)
			{
				$pertemuan == 10 ? $ln=1 : $ln=0;
				$this->fpdf->Cell(10, 5, $pertemuan, 1, $ln, 'C', true);					
			}	
			$dataid = array($id_asisten,$id_asisten2);
			$dataas = array($asisten1,$asisten2);
			$nomor=1;
			for($a=0;$a<2;$a++){
				$this->fpdf->Cell(10, 5, $nomor, 1, 0, 'C');
				$this->fpdf->Cell(30, 5, $dataid[$a], 1, 0, 'C');
				$this->fpdf->Cell(40, 5, $dataas[$a], 1);
				$total = 0;
				for($pertemuan=1; $pertemuan<=10; $pertemuan++)
				{
					$kehadiran=$this->admin_cetak_models->cek_cetak_asisten($praktikum->id_praktikum, $pertemuan, $dataid[$a]);
					if($pertemuan == 10){$ln=1;}else{ $ln=0;}
					$this->fpdf->Cell(10, 5, $kehadiran, 1, 0, 'C');
					$total = $total+$kehadiran;				
				}
				$this->fpdf->Cell(10, 5, $total, 1, 1, 'C');	
				$nomor++;
			}
			$this->fpdf->Cell(1, 10, '', 0, 1);
			$this->fpdf->Cell(200, 5, 'Mengetahui', 0, 1, 'C');
			$this->fpdf->Cell(200, 5, 'Koordinator Labtif', 0, 1, 'C');
			$this->fpdf->Cell(1, 10, '', 0, 1);
			$korlab = $this->models->where2Row('asisten','id_jabatan','status','koordinatorlab',1);
			$this->fpdf->Cell(200, 5, $korlab->nama, 0, 0, 'C');
		}
		$this->fpdf->output();
	}
	
	function absen_ujian(){
		$id_praktikum = $this->models->where1menurun('penjadwalan','status',1,'id_praktikum','ASC');
		foreach($id_praktikum as $praktikum){
			$this->fpdf->SetMargins(10,10,0);
			$this->fpdf->Ln();				
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
			$this->fpdf->Cell(110,5, 'Jln. Pasir Gede Raya (BLK RSU) Telp. (0263) 5019915 - Cianjur 43216', 0);
			$this->fpdf->Cell(13, 5, 'Tanggal :');
			$this->fpdf->Cell(7, 5, date('d'), 1);
			$this->fpdf->Cell(4, 5, ' / ');
			$this->fpdf->Cell(7, 5, date('m'), 1);
			$this->fpdf->Cell(4, 5, ' / ');
			$this->fpdf->Cell(15, 5, date('Y'), 1, 1);
			$this->fpdf->SetLineWidth(0.5);
			$this->fpdf->Line(10, 31, 200, 31);
			$this->fpdf->SetLineWidth(0);
			$this->fpdf->Line(10, 32, 200, 32);
			$this->fpdf->Ln();				
			$this->fpdf->SetFont('Arial', 'B', 10);
			$this->fpdf->Cell(0, 5, 'Absensi Ujian Praktikum', 0, 1, 'C');
			$this->fpdf->SetFont('Arial', '', 7);
			$this->fpdf->Cell(75, 5, '');
			$this->fpdf->Cell(20, 5, 'ID Praktikum');
			$this->fpdf->Cell(0, 5, ': '.strtoupper($praktikum->id_praktikum), 0, 1);
			$kePraktikum = $this->admin_cetak_models->keterangan_praktikum($praktikum->id_praktikum);
			foreach($kePraktikum as $kePraktikums){
				$ass = $this->models->where1Row('asisten','id_asisten',$kePraktikums->pengajar1);
				$ass2 = $this->models->where1Row('asisten','id_asisten',$kePraktikums->pengajar2);
				$this->fpdf->Cell(75, 5, '');
				$this->fpdf->Cell(20, 5, 'Pengajar 1');
				$this->fpdf->Cell(0, 5, ': '.$ass->nama, 0, 1);
				$ttdpengajar1 = $ass->nama;
				$this->fpdf->Cell(75, 5, '');
				$this->fpdf->Cell(20, 5, 'Pengajar 2');
				$this->fpdf->Cell(0, 5, ': '.$ass2->nama, 0, 1);
				$ttdpengajar2 = $ass2->nama;
				$kata=array('Kelas', 'Mata Praktikum', 'Jadwal', 'Ruang');
				$isi=array($kePraktikums->kelas, $kePraktikums->mata_praktikum, $kePraktikums->hari.', '.$kePraktikums->jam, $kePraktikums->ruangan);
				for($i=0; $i<4; $i++)
				{
					$this->fpdf->Cell(75, 5, '');
					$this->fpdf->Cell(20, 5, $kata[$i]);
					$this->fpdf->Cell(0, 5, ': '.$isi[$i], 0, 1);							
				}
			}
			$this->fpdf->SetMargins(30,0,20);
			$this->fpdf->Ln();
			$this->fpdf->SetFillColor(190, 190, 190);
			$this->fpdf->Cell(10, 5, 'No', 1, 0, 'C', true);
			$this->fpdf->Cell(30, 5, 'NIM', 1, 0, 'C', true);
			$this->fpdf->Cell(70, 5, 'Nama', 1, 0, 'C', true);
			$this->fpdf->Cell(40, 5, 'Tanda Tangan', 1, 1, 'C', true);
			$no=1;
			$mahasiswas=$this->admin_cetak_models->mahasiswa($praktikum->id_praktikum);
			foreach($mahasiswas as $mahasiswa)
			{
				$this->fpdf->Cell(10, 5, $no++, 1, 0, 'C');
				$this->fpdf->Cell(30, 5, $mahasiswa->npm, 1, 0, 'C');
				$this->fpdf->Cell(70, 5, $mahasiswa->nama, 1);
				$this->fpdf->Cell(40, 5, '', 1, 1);
			}
			$this->fpdf->Ln();
			$this->fpdf->Ln();
			if($ttdpengajar2=="-")
			{
				$this->fpdf->Cell(140, 5, 'Pengajar 1', 0, 0, 'C');
				$this->fpdf->Ln();
				$this->fpdf->Ln();
				$this->fpdf->Ln();
				$this->fpdf->Cell(140, 5, $ttdpengajar1, 0, 0, 'C');
			}
			else
			{
				$this->fpdf->Cell(125, 5, 'Pengajar 1');
				$this->fpdf->Cell(20, 5, 'Pengajar 2');
				$this->fpdf->Ln();
				$this->fpdf->Ln();
				$this->fpdf->Ln();
				$this->fpdf->Cell(125, 5, $ttdpengajar1);
				$this->fpdf->Cell(20, 5, $ttdpengajar2);
			}
		}
		$this->fpdf->output();
	}
	
	function absensi_mahasiswa(){
		$id_praktikum = $this->models->where1menurun('penjadwalan','status',1,'id_praktikum','ASC');
		foreach($id_praktikum as $praktikum){
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
			$this->fpdf->Cell(110,5, 'Jln. Pasir Gede Raya (BLK RSU) Telp. (0263) 5019915 - Cianjur 43216', 0);
			$this->fpdf->Cell(13, 5, 'Tanggal :');
			$this->fpdf->Cell(7, 5, date('d'), 1);
			$this->fpdf->Cell(4, 5, ' / ');
			$this->fpdf->Cell(7, 5, date('m'), 1);
			$this->fpdf->Cell(4, 5, ' / ');
			$this->fpdf->Cell(15, 5, date('Y'), 1, 1);
			$this->fpdf->SetLineWidth(0.5);
			$this->fpdf->Line(10, 31, 200, 31);
			$this->fpdf->SetLineWidth(0);
			$this->fpdf->Line(10, 32, 200, 32);
			$this->fpdf->Ln();				
			$this->fpdf->SetFont('Arial', 'B', 10);
			$this->fpdf->Cell(0, 5, 'Absensi Praktikum', 0, 1, 'C');
			$this->fpdf->SetFont('Arial', '', 7);
			$this->fpdf->Cell(75, 5, '');
			$this->fpdf->Cell(20, 5, 'ID Praktikum');
			$this->fpdf->Cell(0, 5, ': '.strtoupper($praktikum->id_praktikum), 0, 1);
			$kePraktikum = $this->admin_cetak_models->keterangan_praktikum($praktikum->id_praktikum);
			foreach($kePraktikum as $kePraktikums){
				$ass = $this->models->where1Row('asisten','id_asisten',$kePraktikums->pengajar1);
				$ass2 = $this->models->where1Row('asisten','id_asisten',$kePraktikums->pengajar2);
				$this->fpdf->Cell(75, 5, '');
				$this->fpdf->Cell(20, 5, 'Pengajar 1');
				$this->fpdf->Cell(0, 5, ': '.$ass->nama, 0, 1);
				$this->fpdf->Cell(75, 5, '');
				$this->fpdf->Cell(20, 5, 'Pengajar 2');
				$this->fpdf->Cell(0, 5, ': '.$ass2->nama, 0, 1);
				$kata=array('Kelas', 'Mata Praktikum', 'Jadwal', 'Ruang');
				$isi=array($kePraktikums->kelas, $kePraktikums->mata_praktikum, $kePraktikums->hari.', '.$kePraktikums->jam, $kePraktikums->ruangan);
				for($i=0; $i<4; $i++)
				{
					$this->fpdf->Cell(75, 5, '');
					$this->fpdf->Cell(20, 5, $kata[$i]);
					$this->fpdf->Cell(0, 5, ': '.$isi[$i], 0, 1);							
				}
			}
			$this->fpdf->Ln();
			$this->fpdf->SetFillColor(190, 190, 190);
			$this->fpdf->Cell(10, 15, 'No', 1, 0, 'C', true);
			$this->fpdf->Cell(30, 15, 'NIM', 1, 0, 'C', true);
			$this->fpdf->Cell(40, 15, 'Nama Mahasiswa', 1, 0, 'C', true);
			$this->fpdf->Cell(100, 5, 'Tanggal & Kehadiran', 1, 0, 'C', true);
			$this->fpdf->Cell(10, 15, 'Total', 1, 1, 'C', true);
			$this->fpdf->SetXY(10,85);
			$this->fpdf->Cell(80, 5, '', 0, 0);
			$n=0;
			for($pertemuan=1; $pertemuan<=10; $pertemuan++){
				$tanggals = $this->admin_cetak_models->tanggal_cetak('absensi','id_praktikum','pertemuan',$praktikum->id_praktikum,$pertemuan);	
				foreach($tanggals as $tanggal){
					$pertemuan == 10 ? $ln=1 : $ln=0;
					$data=$this->tanggal($tanggal->tanggal);
					$this->fpdf->Cell(10, 5, $data, 1, $ln, 'C', true);
					$n++;
				}
			}
			for($pertemuan=$n; $pertemuan<10; $pertemuan++)
			{
				$pertemuan == 9 ? $ln=1 : $ln=0;
				$this->fpdf->Cell(10, 5, '0/0', 1, $ln, 'C', true);					
			}
			$this->fpdf->Cell(80, 5, '', 0, 0);
			for($pertemuan=1; $pertemuan<=10; $pertemuan++)
			{
				$pertemuan == 10 ? $ln=1 : $ln=0;
				$this->fpdf->Cell(10, 5, $pertemuan, 1, $ln, 'C', true);					
			}	
			$mahasiswas=$this->admin_cetak_models->mahasiswa($praktikum->id_praktikum);
			$no=1;
			foreach($mahasiswas as $mahasiswa)
			{
				$this->fpdf->Cell(10, 5, $no, 1, 0, 'C');
				$this->fpdf->Cell(30, 5, $mahasiswa->npm, 1, 0, 'C');
				$this->fpdf->Cell(40, 5, $mahasiswa->nama, 1);
				$total = 0;
				for($pertemuan=1; $pertemuan<=10; $pertemuan++)
				{
					$kehadiran=$this->admin_cetak_models->cek_cetak($praktikum->id_praktikum, $pertemuan, $mahasiswa->npm);
					if($pertemuan == 10){$ln=1;}else{ $ln=0;}
					$this->fpdf->Cell(10, 5, $kehadiran, 1, 0, 'C');
					$total = $total+$kehadiran;				
				}
				$this->fpdf->Cell(10, 5, $total, 1, 1, 'C');
				$no++;				
			}
			$this->fpdf->Cell(1, 10, '', 0, 1);
			$this->fpdf->Cell(200, 5, 'Mengetahui', 0, 1, 'C');
			$this->fpdf->Cell(200, 5, 'Koordinator Labtif', 0, 1, 'C');
			$this->fpdf->Cell(1, 10, '', 0, 1);
			$korlab = $this->models->where2Row('asisten','id_jabatan','status','koordinatorlab',1);
			$this->fpdf->Cell(200, 5, $korlab->nama, 0, 0, 'C');
		}
		$this->fpdf->output();
	}
	
	function nilai_mahasiswa($npm){
		$ta = 140;
		$tta = 6;
		$tta2 = 7;
		$ls = 190;
		$tab = 20;
		$this->fpdf->AddPage();
		$this->fpdf->Image("image/logo-teknik.png", 10, 10, 20, 19);
		$this->fpdf->SetFont('Arial', 'B', 14);
		$this->fpdf->Cell(23, $tta, '');
		$this->fpdf->Cell($ta, $tta, 'Program Studi Teknik Informatika', 0, 1,'C');
		$this->fpdf->Cell(23, $tta, '');
		$this->fpdf->Cell($ta, $tta, 'Fakultas Teknik',0, 1,'C');
		$this->fpdf->Cell(23, $tta, '');
		$this->fpdf->Cell($ta, $tta, 'Universitas Suryakancana', 0, 1,'C');
		$this->fpdf->SetFont('Arial', '', '12');
		$this->fpdf->Cell(23, $tta, '');
		$this->fpdf->Cell($ta,$tta, 'Jln. Pasir Gede Raya (BLK RSU) Telp. (0263) 5019915 - Cianjur 43216', 0,0,'C');
		$this->fpdf->SetLineWidth(0.5);
		$this->fpdf->Line(10, 35, 200, 35);
		$this->fpdf->SetLineWidth(0);
		$this->fpdf->Line(10, 36, 200, 36);
		$this->fpdf->Ln(20);			
		$this->fpdf->SetFont('Arial', 'B', '12');	
		$this->fpdf->Cell($ls, 5, 'NILAI PRAKTIKUM', 0, 0,'C');
		$this->fpdf->SetLineWidth(0.5);
		$this->fpdf->Line(86, 53, 124, 53);	
		$this->fpdf->ln(15);
		$this->fpdf->SetFont('Arial', '', '11');
		$this->fpdf->Write(5,'Berikut adalah nilai praktikum mahasiswa dengan data sebagai berikut :');
		$this->fpdf->ln(10);
		$mhs = $this->admin_cetak_models->mhskelas($npm);
		foreach($mhs as $mhr){
			$this->fpdf->Cell($tab); $this->fpdf->Cell($tab, $tta2, 'Nama');
			$this->fpdf->Cell($tab); $this->fpdf->Cell($tab, $tta2, ': '.$mhr->nama, 0, 1);
			$this->fpdf->Cell($tab); $this->fpdf->Cell($tab, $tta2, 'NPM');
			$this->fpdf->Cell($tab); $this->fpdf->Cell($tab, $tta2, ': '.$mhr->npm, 0, 1);
			$this->fpdf->Cell($tab); $this->fpdf->Cell($tab, $tta2, 'Kelas');
			$this->fpdf->Cell($tab); $this->fpdf->Cell($tab, $tta2, ': '.$mhr->kelas);
		}
		$this->fpdf->ln(10);
		$this->fpdf->SetFillColor(190, 190, 190);
		$this->fpdf->Cell(15, $tta2, 'No', 1, 0, 'C', true);
		$this->fpdf->Cell(60, $tta2, 'Matakuliah', 1, 0, 'C', true);
		$this->fpdf->Cell(30, $tta2, 'Kehadiran', 1, 0, 'C', true);
		$this->fpdf->Cell(25, $tta2, 'Tugas', 1, 0, 'C', true);
		$this->fpdf->Cell(30, $tta2, 'Ujian', 1, 0, 'C', true);
		$this->fpdf->Cell(30, $tta2, 'Total', 1, 1, 'C', true);
		$registrasi = $this->models->where1('registrasi_praktikum','npm',$npm);
		$no =0;
		foreach($registrasi as $nilai){
			$matkum = $this->admin_cetak_models->mhs_matkum($nilai->id_praktikum);
			$hadir = $this->admin_penilaian_models->kehadiran($nilai->id_praktikum,$npm);
			$persentase = $this->models->where1Row('penjadwalan','id_praktikum',$nilai->id_praktikum);
			$kehadiran = $hadir->kehadiran * 10;
			//persentase
			$total = ($kehadiran*$persentase->kehadiran/100)+($nilai->tugas*$persentase->tugas/100)+($nilai->ujian*$persentase->ujian/100);
			$no++;
			$this->fpdf->Cell(15, $tta2, $no, 1, 0, 'C');
			$this->fpdf->Cell(60, $tta2, $matkum->mata_praktikum, 1, 0, 'C');
			$this->fpdf->Cell(30, $tta2, $kehadiran, 1, 0, 'C');
			$this->fpdf->Cell(25, $tta2, $nilai->tugas, 1, 0, 'C');
			$this->fpdf->Cell(30, $tta2, $nilai->ujian, 1, 0, 'C');
			$this->fpdf->Cell(30, $tta2, $total, 1, 1, 'C');
		}
		$this->fpdf->ln(20);
		$this->fpdf->Cell(1, 10, '', 0, 1);
		$this->fpdf->Cell($ls, 5, 'Mengetahui', 0, 1, 'C');
		$this->fpdf->Cell($ls, 5, 'Koordinator Labtif', 0, 1, 'C');
		$this->fpdf->Cell(1, 17, '', 0, 1);
		$korlab = $this->models->where2Row('asisten','id_jabatan','status','koordinatorlab',1);
		$this->fpdf->Cell($ls, 5, $korlab->nama, 0, 0, 'C');
		$this->fpdf->output();
	}
	
	function tanggal($tanggal){
		$pisah=explode(" ", $tanggal);
		isset($pisah[1])?$bulan=$pisah[1]:$bulan=0;
		switch($bulan)
		{
			case "Januari" :
				$bulan="01";
				break;
			case "Februari" :
				$bulan="02";
				break;
			case "Maret" :
				$bulan="03";
				break;
			case "April" :
				$bulan="04";
				break;
			case "Mei" :
				$bulan="05";
				break;
			case "Juni" :
				$bulan="06";
				break;
			case "Juli" :
				$bulan="07";
				break;
			case "Agustus" :
				$bulan="08";
				break;
			case "September" :
				$bulan="09";
				break;
			case "Oktober" :
				$bulan="10";
				break;
			case "November" :
				$bulan="11";
				break;
			case "Desember" :
				$bulan="12";
				break;
		}
		return $pisah[0].'/'.$bulan;
	}
}
?>