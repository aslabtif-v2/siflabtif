<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_excel extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models','admin_cetak_models','admin_penilaian_models'));
		$this->load->helper(array('url'));
		$this->load->library('excel');
		session_start();
		if(!isset($_SESSION['password'])){
			redirect(base_url());
		}
	}
	
	function unduh_excel($id_praktikum){
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getProperties()->setCreator($_SESSION['nama'])
			  ->setLastModifiedBy("ASLABTIF")
			  ->setTitle("Data Nilai Praktikum")
			  ->setSubject("Laboratorium Teknik Informatika UNSUR")
			  ->setCategory("Data");
		$excel = $this->excel->getActiveSheet();
		for($i=1;$i<=3;$i++){
			$excel->mergeCells('A'.$i.':G'.$i);
			$excel->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}
		$excel->getStyle('A1')->getFont()->setSize(14);
		$excel->getStyle('A2')->getFont()->setSize(12);
		$excel->getStyle('A3')->getFont()->setSize(12);
		$excel->setCellValue('A1','Penilaian Ujian Praktikum');
		$ket = $this->admin_cetak_models->keterangan_praktikum($id_praktikum);
		foreach($ket as $terangan){
			$excel->setCellValue('A2',$terangan->mata_praktikum);
			$excel->setCellValue('A3','Kelas '.$terangan->kelas);
			$excel->setCellValue('A4','Asisten :');
			$excel->setCellValue('B4','1. '.$this->models->where1Row('asisten','id_asisten',$terangan->pengajar1)->nama);
			$excel->setCellValue('B5','2. '.$this->models->where1Row('asisten','id_asisten',$terangan->pengajar2)->nama);
		 }
		//border tabel
		$excel->getStyle('A7:G8')->getBorders()->applyFromArray(
			array(
				'bottom'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				),
				'top'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				),
				'left'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				),
				'right'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			)
		);
		$excel->getStyle('A7:A8')->getBorders()->applyFromArray(
			array(
				'left'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				),
				'right'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			)
		);
		$excel->getStyle('C7:C8')->getBorders()->applyFromArray(
			array(
				'left'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				),
				'right'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			)
		);
		$excel->getStyle('E7:E8')->getBorders()->applyFromArray(
			array(
				'left'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				),
				'right'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
					
				)
			)
		);
		$excel->getStyle('F7:F8')->getBorders()->applyFromArray(
			array(
				'right'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
					
				)
			)
		);
		//mengukur lebar cell
		$excel->getColumnDimension('A')->setAutoSize(true);
		$excel->getColumnDimension('B')->setAutoSize(true);
		$excel->getColumnDimension('C')->setAutoSize(true);
		$excel->getColumnDimension('D')->setWidth(20);
		$excel->getColumnDimension('E')->setWidth(20);
		$excel->getColumnDimension('F')->setWidth(20);
		$excel->getColumnDimension('G')->setWidth(15);
		
		$excel->getStyle('A7:G8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->getStyle('A7:G8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$excel->getStyle('A7:G8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$excel->getStyle('A7:G8')->getFill()->getStartColor()->setRGB('E4EAF4');
		$huruf = array('A','B','C','D','E','F','G');
		for($i=0;$i<7;$i++){
			$excel->mergeCells($huruf[$i].'7:'.$huruf[$i].'8');
		}
		$persentase = $this->models->where1Row('penjadwalan','id_praktikum',$id_praktikum);
		$excel->setCellValue('A7','No')
			  ->setCellValue('B7','NPM')
			  ->setCellValue('C7','Nama')
			  ->setCellValue('D7','KEHADIRAN '.$persentase->kehadiran.'%')
			  ->setCellValue('E7','NILAI TUGAS '.$persentase->tugas.'%')
			  ->setCellValue('F7','NILAI UJIAN '.$persentase->ujian.'%')
			  ->setCellValue('G7','TOTAL NILAI');
		$no = 9;
		$nomer =1;
		$mahasiswa = $this->admin_penilaian_models->nilai_mahasiswa($id_praktikum);
		foreach($mahasiswa as $mhr){
			$excel->getStyle('A'.$no.':G'.$no)->getBorders()->applyFromArray(
				array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN ,
						'color' => array(
							'rgb' => '000000'
						)
					)
				)
			);
			$hadir = $this->admin_penilaian_models->kehadiran($id_praktikum,$mhr->npm);
			$kehadiran = $hadir->kehadiran * 10;
			$total = ($kehadiran*$persentase->kehadiran/100)+($mhr->tugas*$persentase->tugas/100)+($mhr->ujian*$persentase->ujian/100);
			$excel->setCellValue('A'.$no,$nomer)
				  ->setCellValue('B'.$no,$mhr->npm)
				  ->setCellValue('C'.$no,$mhr->nama)
				  ->setCellValue('D'.$no,$kehadiran)
				  ->setCellValue('E'.$no,$mhr->tugas)
				  ->setCellValue('F'.$no,$mhr->ujian)
				  ->setCellValue('G'.$no,$total);
			$no++;
			$nomer++;
		}
		$excel->getStyle('B9:B'.$no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->getStyle('D9:G'.$no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->setTitle(strtoupper($id_praktikum));
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Nilai '.strtoupper($id_praktikum).'.xlsx"'); 
		header('Cache-Control: max-age=0'); //no cache
		// Save Excel 2007 file 
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
		$objWriter->save('php://output');
		exit;
		// Save Excel 2007 file tanpa menyimpan di server
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
	}
}
?>