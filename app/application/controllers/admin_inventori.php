<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_inventori extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('models','admin_inventori_models'));
		$this->load->helper(array('url','form'));
		$this->load->library('excel');
		date_default_timezone_set('Asia/Jakarta');
		session_start();
		if(!isset($_SESSION['password'])){
			redirect(base_url());
		}
	}
	
	function index(){
		$data['view'] = 'admin/inventori/inventori';
		$this->load->view('admin/template',$data);
	}
	
	//===================================================================================================
	//LAPORAN
	
	function laporan_excel($tanggal, $id_ruangan){
		$lab = $this->models->where1Row('ruangan','id_ruangan',$id_ruangan);
		$bulan = array("","Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$tgl = explode('-',$tanggal);
		
		$this->excel->createSheet(0);
		$this->excel->setActiveSheetIndex(0);
		$excel = $this->excel->getActiveSheet();
		$this->e_deklar();
		
		
		for($i=1;$i<=3;$i++){
			$excel->mergeCells('A'.$i.':H'.$i);
			$this->e_hcenter('A'.$i);
		}
		
		$this->e_fontsize('A1',14);
		$this->e_fontsize('A2',14);
		$this->e_fontbold('A1:A2');
		$excel->setCellValue('A1',strtoupper('LABORATORIUM '.$lab->ruangan.' INVENTORI'))
		      ->setCellValue('A2',strtoupper('PERIODE : '.$bulan[$tgl[1]-0].' '.$tgl[0]));
		
		$excel->mergeCells('A5:A6')->mergeCells('B5:B6')->mergeCells('C5:C6')->mergeCells('D5:G5');
		$this->e_hcenter('E5:H5');
		$excel->setCellValue('A5','NO')
			 ->setCellValue('B5','TYPE')
			 ->setCellValue('C5','MEREK')
			 ->setCellValue('D5','KONDISI')
			 ->setCellValue('D6','BAGUS')
			 ->setCellValue('E6','JELEK')
			 ->setCellValue('F6','RUSAK')
			 ->setCellValue('G6','KETERANGAN');
		$this->e_fontbold('A5:G6');
		
		$this->e_border('A5:A6');
		$this->e_border('B5:B6');
		$this->e_border('C5:C6');
		$this->e_border('D5:G5');
		$this->e_border('D6');
		$this->e_border('E6');
		$this->e_border('F6');
		$this->e_border('G6');
		
		$this->e_hcenter('A5:H6');
		$this->e_vcenter('A5:H6');
		
		$cell=7;
		$ruangan="AND id_ruangan='$id_ruangan'";
		$laporan = $this->admin_inventori_models->laporan($tanggal,$ruangan);
		$no=0;
		
		foreach($laporan as $l){
			$no++;
			$excel->setCellValue('A'.$cell,$no)
				 ->setCellValue('B'.$cell,$l->barang)
				 ->setCellValue('C'.$cell,$l->merek)
				 ->setCellValue('D'.$cell,$l->bagus_qtty)
				 ->setCellValue('E'.$cell,$l->rusak_qtty)
				 ->setCellValue('F'.$cell,$l->hilang_qtty)
				 ->setCellValue('G'.$cell,'');
				 
			$this->e_border('A'.$cell);
			$this->e_border('B'.$cell);
			$this->e_border('C'.$cell);
			$this->e_border('D'.$cell);
			$this->e_border('E'.$cell);
			$this->e_border('F'.$cell);
			$this->e_border('G'.$cell);
			
			$cell = $cell+1;
		}
		
		$this->e_colwidth('A',5);
		$this->e_colwidth('B','auto');
		$this->e_colwidth('C','auto');
		$this->e_colwidth('D','auto');
		$this->e_colwidth('E',10);
		$this->e_colwidth('F',10);
		$this->e_colwidth('G','auto');
		$this->e_sheettitle("$lab->ruangan");
		
		$this->sheet2($tanggal, $id_ruangan);
		
		$datar = array(
				'id_ruangan'=>$id_ruangan,
				'id_asisten'=>$_SESSION['id_asisten'],
				'rpt_date'=>$tanggal
			);
		$this->db->insert('inv_report',$datar);
		
		$rpt_id = $this->models->maxx('inv_report','rpt_id')->rpt_id;
		$repot = "Laporan Inventori $rpt_id.xlsx";
		$datar2 = array('rpt_nama'=>$repot);
		$this->models->update('inv_report','rpt_id',$rpt_id,$datar2);
		$this->e_save($repot);
		
		redirect('admin_inventori/laporan');
	}
	
	function sheet2($tanggal, $id_ruangan){
		$lab = $this->models->where1Row('ruangan','id_ruangan',$id_ruangan);
		$bulan = array("","Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$tgl = explode('-',$tanggal);
		
		$this->excel->createSheet(1);
		$this->excel->setActiveSheetIndex(1);
		$excel = $this->excel->getActiveSheet();
		$this->e_deklar();
		
		for($i=1;$i<=3;$i++){
			$excel->mergeCells('A'.$i.':H'.$i);
			$this->e_hcenter('A'.$i);
		}
		
		$this->e_fontsize('A1',14);
		$this->e_fontsize('A2',14);
		$this->e_fontbold('A1:A2');
		$excel->setCellValue('A1',strtoupper($lab->ruangan.' INVENTORI'))
		      ->setCellValue('A2',strtoupper('PERIODE : '.$bulan[$tgl[1]-0].' '.$tgl[0]));
		
		$excel->mergeCells('A5:A6')->mergeCells('B5:B6')->mergeCells('C5:C6')->mergeCells('D5:D6')->mergeCells('E5:H5');
		$this->e_hcenter('E5:H5');
		$excel->setCellValue('A5','NO')
			 ->setCellValue('B5','PC')
			 ->setCellValue('C5','TYPE')
			 ->setCellValue('D5','MEREK')
			 ->setCellValue('E5','KONDISI')
			 ->setCellValue('E6','BAGUS')
			 ->setCellValue('F6','RUSAK')
			 ->setCellValue('G6','HILANG')
			 ->setCellValue('H6','KETERANGAN');
		$this->e_fontbold('A5:H6');
		
		$this->e_border('A5:A6');
		$this->e_border('B5:B6');
		$this->e_border('C5:C6');
		$this->e_border('D5:D6');
		$this->e_border('E5:H5');
		$this->e_border('E6');
		$this->e_border('F6');
		$this->e_border('G6');
		$this->e_border('H6');
		
		$this->e_hcenter('A5:H6');
		$this->e_vcenter('A5:H6');
		
		$cell=7;
		$cell1=$cell;
		$no=0;
		$nr=0;
		$cekr='';
		$pc = $this->admin_inventori_models->pc_laporan($id_ruangan);	
		foreach($pc as $p){
			$baru ='';
			$rusak='';
			$hilang='';
			if($p->knds_brng==7){
				$baru='a';
			}
			else if($p->knds_brng==8){
				$rusak='a';
			}
			else if($p->knds_brng==9){
				$hilang='a';
			}
			
			if($p->pc==$cekr){
				$nr=0;
			}
			else{
				$cekr=$p->pc;
				$nr++;
			}
			
			if($nr!=0){
				$no++;				
				$excel->mergeCells('A'.$cell.':A'.(($cell+$p->rows)-1));
				$excel->setCellValue('A'.$cell,$no);
				
				$excel->setCellValue('B'.$cell,$p->pc);
				$excel->mergeCells('B'.$cell.':B'.(($cell+$p->rows)-1));
				
			}
			
			$excel->setCellValue('C'.$cell,$p->barang)
				 ->setCellValue('D'.$cell,$p->merek)
				 ->setCellValue('E'.$cell,$baru)
				 ->setCellValue('F'.$cell,$rusak)
				 ->setCellValue('G'.$cell,$hilang)
				 ->setCellValue('H'.$cell,$p->pc_keterangan);
				 
			$this->e_border('A'.$cell);
			$this->e_border('B'.$cell);
			$this->e_border('C'.$cell);
			$this->e_border('D'.$cell);
			$this->e_border('E'.$cell);
			$this->e_border('F'.$cell);
			$this->e_border('G'.$cell);
			$this->e_border('H'.$cell);
			
			$cell = $cell+1;
		}
		
		$this->e_hcenter('A'.$cell1.':B'.$cell);
		$this->e_vcenter('A'.$cell1.':B'.$cell);
		$this->e_hcenter('E'.$cell1.':G'.$cell);
		$this->e_fontfamily('E'.$cell1.':G'.$cell,'Webdings');
		$this->e_wrap('B'.$cell1.':B'.$cell);
		
		//Tanda tangan
		//TTD Jabatan
		$cellttd = $cell+4;
		$excel->mergeCells('B'.$cellttd.':C'.$cellttd);
		$excel->mergeCells('G'.$cellttd.':H'.$cellttd);
		$excel->setCellValue('B'.$cellttd,'PJ '.$lab->ruangan)
			  ->setCellValue('G'.$cellttd,'Koordinator Laboratorium');		
		$this->e_hcenter('A'.$cellttd.':H'.$cellttd);
		
		//TTD Nama 
		$cellttd = $cellttd+4;
		$asisten = $this->models->where2Row('asisten','id_jabatan','status','koordinatorlab',1);		
		$excel->mergeCells('B'.$cellttd.':C'.$cellttd);
		$excel->mergeCells('G'.$cellttd.':H'.$cellttd);
		$excel->setCellValue('B'.$cellttd,$_SESSION['nama'])
			  ->setCellValue('G'.$cellttd,$asisten->nama);		
		$this->e_hcenter('A'.$cellttd.':H'.$cellttd);			  
	
		
		$this->e_colwidth('A',5);
		$this->e_colwidth('B',15);
		$this->e_colwidth('C','auto');
		$this->e_colwidth('D','auto');
		$this->e_colwidth('E',10);
		$this->e_colwidth('F',10);
		$this->e_colwidth('G',10);
		$this->e_colwidth('H','auto');
		$this->e_sheettitle("PC $lab->ruangan");
	}
	
	function e_wrap($cell){
		$excel = $this->excel->getActiveSheet();
		$excel->getStyle($cell)->getAlignment()->setWrapText(true);
	}
	
	function e_border($cell){
		$excel = $this->excel->getActiveSheet();
		$excel->getStyle($cell)->getBorders()->applyFromArray(
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
	}
	
	function e_colwidth($cell,$width){
		$excel = $this->excel->getActiveSheet();
		if($width=='auto'){
			$excel->getColumnDimension($cell)->setAutoSize(true);
		}
		else{
			$excel->getColumnDimension($cell)->setWidth($width);
		}
	}
	
	function e_fontsize($cell,$size){
		$excel = $this->excel->getActiveSheet();
		$excel->getStyle($cell)->getFont()->setSize($size);
	}
	
	function e_fontfamily($cell,$font){
		$excel = $this->excel->getActiveSheet();
		$excel->getStyle($cell)->getFont()->setName($font);
	}
	
	function e_fontbold($cell){
		$excel = $this->excel->getActiveSheet();
		$excel->getStyle($cell)->getFont()->setBold(true);
	}
	
	function e_hcenter($cell){
		$excel = $this->excel->getActiveSheet();
		$excel->getStyle($cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	}
	
	function e_vcenter($cell){
		$excel = $this->excel->getActiveSheet();
		$excel->getStyle($cell)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	}
	
	function e_deklar(){
		$this->excel->getProperties()->setCreator($_SESSION['nama'])
			  ->setLastModifiedBy("Asisten Laboratorium")
			  ->setTitle("Data Inventori Laboratorium")
			  ->setSubject("Laboratorium Teknik Informatika UNSUR")
			  ->setCategory("Data");
	}
	
	function e_sheettitle($title){	
		$excel = $this->excel->getActiveSheet();
		$excel->setTitle($title);
	}
	
	function e_save($nama){
		header('Content-Type: application/vnd.ms-excel');
		//header('Content-Disposition: attachment;filename="Nilai.xlsx"'); 
		header('Cache-Control: max-age=0'); //no cache
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		$objWriter->save(str_replace('.php', '.xlsx', 'file/inventori/'.$nama));
	}
	
	//LAPORAN
	function laporan($id_ruangan=''){
		if(($_SESSION['jabatan']!='adminsistem' && $_SESSION['jabatan']!='koordinatorlab' && $_SESSION['jabatan']!='teknisilab') && $id_ruangan==''){
			$ruangan = $this->models->where1Row('ruangan','id_jabatan',$_SESSION['jabatan']);
			redirect('admin_inventori/laporan/'.$ruangan->id_ruangan);
			exit;
		}
		
		$data['bulan'] = array("","Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$data['lab'] = $this->models->lihat_menurun('ruangan','asc','id_ruangan');
		$data['laporan'] = $this->admin_inventori_models->laporan_inv($id_ruangan);
		$data['view'] = 'admin/inventori/laporan';
		
		if($_SESSION['jabatan']!='adminsistem'){
			$this->load->view('asisten/template',$data);
		}
		else{
			$this->load->view('admin/template',$data);
		}
	}
	
	function laporan_buat($date='',$lab=''){
		if($_SESSION['jabatan']!='adminsistem' && $lab=='') {//|| ($_SESSION['jabatan']!='koordinatorlab' && $lab=='')){
			$ruangan = $this->models->where1Row('ruangan','id_jabatan',$_SESSION['jabatan']);
			redirect('admin_inventori/laporan_buat/'.date('Y-m-d').'/'.$ruangan->id_ruangan);
			exit;
		}
	
		$id_ruangan = $lab;
		if($lab!=''){
			$data['inputlab']=$lab;
			$lab="AND id_ruangan='$lab'";
		}
		else{
			$lab="AND id_ruangan='0'";
			$data['inputlab']='';
		}
		
		if($date!=''){
			$data['date'] = $date;
		}
		else{
			$data['date'] = date('Y-m-d');
		}
		
		$data['lab'] = $this->models->lihat_menurun('ruangan','asc','id_ruangan');
		$data['laporan'] = $this->admin_inventori_models->laporan($date,$lab);
		$data['pc'] = $this->admin_inventori_models->pc_laporan($id_ruangan);		
		$data['view'] = 'admin/inventori/laporan-buat';
		
		if($_SESSION['jabatan']!='adminsistem'){
			$this->load->view('asisten/template',$data);
		}
		else{
			$this->load->view('admin/template',$data);
		}
	}
	
	function pc_kondisi(){
		$pc_id = $this->input->post('pc_id');
		$kondisi = $this->input->post('kondisi');
		$respon = $this->input->post('respon');
		if($respon=='V'){
			$data = array('knds_brng'=>$kondisi);
		}
		else{
			$data = array('knds_brng'=>null);
		}
		$this->models->update('inv_pc','pc_id',$pc_id,$data);
		echo $respon;
	}
	
	function pc_keterangan(){
		$pc_id = $this->input->post('pc_id');
		$keterangan = $this->input->post('keterangan');
		
		$data = array('pc_keterangan'=>$keterangan);
		$this->models->update('inv_pc','pc_id',$pc_id,$data);
		echo $keterangan;
	}
	
	function laporan_hapus($rpt_id){
		$repot = $this->models->where1Row('inv_report','rpt_id',$rpt_id);
		$this->models->hapus('inv_report','rpt_id',$rpt_id);
		unlink('file/inventori/'.$repot->rpt_nama);
		redirect('admin_inventori/laporan');	
	}
	
	//===================================================================================================
	//ALOKASI KOMPONEN & PC
	
	function pc($id_ruangan=''){
		if(($_SESSION['jabatan']!='adminsistem' && $_SESSION['jabatan']!='teknisilab') && $id_ruangan=='') {
			$ruangan = $this->models->where1Row('ruangan','id_jabatan',$_SESSION['jabatan']);
			redirect('admin_inventori/pc/'.$ruangan->id_ruangan);
			exit;
		}
		
		$data['lab'] = $this->models->lihat_menurun('ruangan','asc','id_ruangan');
		$data['pc'] = $this->admin_inventori_models->pc($id_ruangan);
		$data['view'] = 'admin/inventori/pc';
		
		if($_SESSION['jabatan']!='adminsistem'){
			$this->load->view('asisten/template',$data);
		}
		else{
			$this->load->view('admin/template',$data);
		}
	}
	
	function pc_tambah(){
		$data['pc'] = $this->models->where1menurun('codexd','code_kate','CODE_PCLB','code_desc','ASC');
		$data['barang'] = $this->admin_inventori_models->barang();
		$data['lab'] = $this->models->lihat_menurun('ruangan','asc','id_ruangan');
		$data['view'] = 'admin/inventori/pc-tambah';
		
		if($_SESSION['jabatan']!='adminsistem'){
			$this->load->view('asisten/template',$data);
		}
		else{
			$this->load->view('admin/template',$data);
		}
	}
	
	function pc_post(){
		$jumlah = $this->input->post('jumlah');
		$pc = $this->input->post('pc');
		$lab = $this->input->post('lab');
		
		for($i=1;$i<=$jumlah;$i++){
			$komponen = $this->input->post('komponen'.$i);
			$data = array(
					'id_ruangan'=>$lab,
					'brg_id'=>$komponen,
					'code_pclb'=>$pc
				);
			$this->db->insert('inv_pc',$data);
		}
		redirect('admin_inventori/pc/'.$lab);
	}
	
	function pc_hapuspc($id_ruangan,$code_pclb){
		$this->models->hapus2('inv_pc','id_ruangan','code_pclb',$id_ruangan,$code_pclb);
		redirect('admin_inventori/pc/'.$id_ruangan);
	}
	
	//===================================================================================================
	//ALOKASI
	
	function alokasi(){
		$date = $this->input->post('date');
		$lab = $this->input->post('lab');
		$cetak = $this->input->post('cetak');
		
		if($lab!=''){
			$data['inputlab']=$lab;
			$lab="AND id_ruangan='$lab'";
		}
		else{
			$data['inputlab']='';
		}
		
		if($date!=''){
			$data['date'] = $date;
		}
		else{
			$data['date'] = date('Y-m-d');
		}
		
		$data['lab'] = $this->models->lihat_menurun('ruangan','asc','id_ruangan');
		$data['laporan'] = $this->admin_inventori_models->laporan($date,$lab);
		
		if($cetak=='Excel'){
			$lab = $this->input->post('lab');
			if($lab!=''){
				$labtif = $this->models->where1Row('ruangan','id_ruangan',$lab);
				$data['labtif'] = strtoupper($labtif->ruangan);
			}
			else{
				$data['labtif'] = strtoupper('Laboratorium Informatika');
			}
			$this->load->view('admin/inventori/alokasi-excel',$data);
		}
		else{
			$data['view'] = 'admin/inventori/alokasi';
			if($_SESSION['jabatan']!='adminsistem'){
				$this->load->view('asisten/template',$data);
			}
			else{
				$this->load->view('admin/template',$data);
			}
		}
	}
	
	function alokasi_histori(){
		$jabatan = $_SESSION['jabatan'];
		$id_ruangan='';
		if($jabatan!='adminsistem' && $jabatan!='teknisilab'){
			$ruangan = $this->models->where1Row('ruangan','id_jabatan',$jabatan);
			$id_ruangan = $ruangan->id_ruangan;		
		}
		$data['barang'] = $this->admin_inventori_models->histori($id_ruangan);
		$data['view'] = 'admin/inventori/alokasi-histori';
		
		if($_SESSION['jabatan']!='adminsistem'){
			$this->load->view('asisten/template',$data);
		}
		else{
			$this->load->view('admin/template',$data);
		}
	}
	
	function alokasi_barang(){
		$data['kondisi'] = $this->models->where1menurun('codexd','code_kate','KNDS_BRNG','code_desc','ASC');
		$data['barang'] = $this->admin_inventori_models->barang();
		$data['lab'] = $this->models->lihat_menurun('ruangan','asc','id_ruangan');
		$data['view'] = 'admin/inventori/alokasi-barang';
		
		if($_SESSION['jabatan']!='adminsistem'){
			$this->load->view('asisten/template',$data);
		}
		else{
			$this->load->view('admin/template',$data);
		}
	}
	
	function alokasi_edit($allo_id){
		$data['a'] = $this->models->where1Row('inv_alokasi','allo_id',$allo_id);
		$data['kondisi'] = $this->models->where1menurun('codexd','code_kate','KNDS_BRNG','code_desc','ASC');
		$data['barang'] = $this->admin_inventori_models->barang();
		$data['lab'] = $this->models->lihat_menurun('ruangan','asc','id_ruangan');
		$data['view'] = 'admin/inventori/alokasi-edit';
		
		if($_SESSION['jabatan']=='adminsistem'){
			$this->load->view('admin/template',$data);
		}
		else{
			$this->load->view('asisten/template',$data);
		}
	}
	
	function alokasi_post(){
		$barang = $this->input->post('barang');
		$kondisi = $this->input->post('kondisi');
		$qtty = $this->input->post('qtty');
		$lab = $this->input->post('lab');
		
		$data = array(
				'id_asisten'=>$_SESSION['id_asisten'],
				'id_ruangan'=>$lab,
				'brg_id'=>$barang,
				'knds_brng'=>$kondisi,
				'allo_qtty'=>$qtty,
				'allo_tanggal'=>date('Ymd')
			);
		$this->db->insert('inv_alokasi',$data);
		redirect('admin_inventori/alokasi');
	}
	
	function alokasi_update($allo_id){
		$barang = $this->input->post('barang');
		$kondisi = $this->input->post('kondisi');
		$qtty = $this->input->post('qtty');
		$lab = $this->input->post('lab');
		
		$data = array(
				'id_asisten'=>$_SESSION['id_asisten'],
				'id_ruangan'=>$lab,
				'brg_id'=>$barang,
				'knds_brng'=>$kondisi,
				'allo_qtty'=>$qtty
			);
		$this->models->update('inv_alokasi','allo_id',$allo_id,$data);
		redirect('admin_inventori/alokasi');
	}
	
	function alokasi_hapus($allo_id){
		$this->models->hapus('inv_alokasi','allo_id',$allo_id);	
		redirect('admin_inventori/alokasi');
	}
	
	//===================================================================================================
	//BARANG
	function barang(){
		$data['barang'] = $this->admin_inventori_models->barang();
		$data['view'] = 'admin/inventori/barang-view';
		
		if($_SESSION['jabatan']=='teknisilab'){
			$this->load->view('asisten/template',$data);
		}
		else{
			$this->load->view('admin/template',$data);
		}
	}
	
	function barang_tambah(){
		$data['merek'] = $this->models->where1menurun('codexd','code_kate','CODE_MERK','code_desc','ASC');
		$data['jenis'] = $this->models->where1menurun('codexd','code_kate','jnis_brng','code_desc','ASC');
		$data['view'] = 'admin/inventori/barang-tambah';
		
		if($_SESSION['jabatan']=='teknisilab'){
			$this->load->view('asisten/template',$data);
		}
		else{
			$this->load->view('admin/template',$data);
		}
	}
	
	function barang_edit($brg_id){
		$data['b'] = $this->models->where1Row('inv_barang','brg_id',$brg_id);
		$data['merek'] = $this->models->where1menurun('codexd','code_kate','CODE_MERK','code_desc','ASC');
		$data['jenis'] = $this->models->where1menurun('codexd','code_kate','jnis_brng','code_desc','ASC');
		$data['view'] = 'admin/inventori/barang-edit';
		
		if($_SESSION['jabatan']=='teknisilab'){
			$this->load->view('asisten/template',$data);
		}
		else{
			$this->load->view('admin/template',$data);
		}
	}
	
	function barang_post(){
		$jenis = $this->input->post('jenis');
		$merek = $this->input->post('merek');
		
		$data = array(
				'jnis_brng'=>$jenis,
				'code_merk'=>$merek
			);
		$this->db->insert('inv_barang',$data);
		redirect('admin_inventori/barang');
	}
	
	function barang_update($brg_id){
		$jenis = $this->input->post('jenis');
		$merek = $this->input->post('merek');
		
		$data = array(
				'jnis_brng'=>$jenis,
				'code_merk'=>$merek
			);
		$this->models->update('inv_barang','brg_id',$brg_id,$data);
		redirect('admin_inventori/barang');
	}
	
	function barang_hapus($brg_id){
		$this->models->hapus('inv_barang','brg_id',$brg_id);	
		redirect('admin_inventori/barang');
	}
	
	function get_lab($id_ruangan=null){
		$data['id_ruangan'] = $id_ruangan;
		$data['lab'] = $this->models->lihat_menurun('ruangan','asc','id_ruangan');
		$this->load->view('admin/inventori/load/laboratorium',$data);
	}
}