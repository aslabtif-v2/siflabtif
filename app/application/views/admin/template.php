<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SIFLABTIF</title>
    <link href="<?php echo base_url() ?>image/logo-labtif.png" rel="shortcut icon" />
    <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link  href="data:text/css;charset=utf-8," data-href="<?php echo base_url() ?>assets/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/sb-admin.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/my-style-admin.css" rel="stylesheet">
    <!--javascript dan jquery-->
    <script src="<?php echo base_url() ?>assets/js/jquery-1.10.2.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>  
    <script src="<?php echo base_url() ?>assets/js/sb-admin.js"></script>
	<script>
		var base_url = "<?php echo base_url() ?>";
	</script>
</head>
<body>
	<div id="wrapper">
		<div class="headingg">
        	<h1>Sistem Informasi Laboratorium Teknik Informatika <?php echo date('Y')?></h1>
        </div>
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
               	</button>
                <font class="navbar-brand">Panel Admin Sistem</font>
            </div>
            <ul class="nav navbar-top-links navbar-right">
            	<li class="text-muted"><?php echo $_SESSION['nama'] ?></li>
                <li class="dropdown jumlah-pesan">
                	<?php
						$namabulan = array("","Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
						$jp = $this->db->query("SELECT pesan_balasan.id_pesan, pesan.user_satu, COUNT(pesan_balasan.status) AS jumlah, MAX(pesan_balasan.pesan) AS pesan, max(pesan_balasan.tanggal) as tanggal FROM pesan_balasan, pesan WHERE pesan_balasan.id_pesan=pesan.id_pesan AND pesan.user_dua='".$_SESSION['id_asisten']."' AND pesan_balasan.status='1' GROUP BY pesan.user_satu")->result_array();
						$tp = 0;
						$np = '';
						foreach($jp as $jps){
							$tp = $jps['jumlah']+$tp;
						}
						
						if($tp!=0){
							$np = '<span class="badge badge-danger">'.$tp.'</span> <i class="fa fa-caret-down"></i>';
						}
					?>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> <?php echo $np ?> 
                    </a>
                    <?php
					if($tp!=0){
						echo '<ul class="dropdown-menu dropdown-messages">';
						foreach($jp as $jps){
						$asis = $this->models->where1Row('asisten','id_asisten',$jps['user_satu']);
						$tgls = explode('-',$jps['tanggal']);
						if(($tgls[0]==date('Y'))&&($tgls[1]==date('m'))&&($tgls[2]==date('d'))){
							$waktu = 'Hari ini';	
						}
						else if(($tgls[0]==date('Y'))&&($tgls[1]==date('m'))&&($tgls[2]==date('d')-1)){
							$waktu ='Kemarin';
						}
						else{
							$waktu = $tgls[2].' '.$namabulan[$tgls[1]-1].' '.$tgls[0];	
						}
					?>    
                        <li>
                            <a href="<?php echo base_url('index.php/admin_pesan/index/'.$_SESSION['id_asisten'].'/'.$jps['user_satu']) ?>">
                                <div>
                                    <strong><?php echo $asis->nama ?> <span class="badge badge-danger"><?php echo $jps['jumlah'] ?></span></strong>
                                    <span class="pull-right text-muted">
                                        <em><?php echo $waktu ?></em>
                                    </span>
                                </div>
                                <div><?php  echo substr($jps['pesan'],0,30).'...'; ?></div>
                            </a>
                        </li>
                    <?php 
						}
                    	echo '</ul>';
					}
					?>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><?php echo anchor('asisten_beranda','<i class="glyphicon glyphicon-th-large"></i> Halaman Asisten') ?></li>
                        <li class="divider"></li>
                        <li>
                        	<a href="#" title="logout" class="hapus">
                            	<i class="fa fa-sign-out fa-fw"></i> Logout
                                <input type="hidden" value="<?php echo base_url().'index.php/login/logout' ?>">
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li><?php echo anchor('admin_beranda','<i class="glyphicon glyphicon-home"></i> Beranda') ?></li>
   					<li><?php echo anchor('admin_asisten','<i class="glyphicon glyphicon-user"></i> Biodata Asisten') ?></li>
   					<li>
                    	<a href="#"><i class="glyphicon glyphicon-calendar"></i> Penjadwalan Praktikum<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
   							<li><?php echo anchor('admin_periode','Penjadwalan') //anchor('admin_jadwal','Penjadwalan') ?></li>
   							<li><?php echo anchor('admin_jadwal/hari_ini','Jadwal Praktikum') ?></li> 
                        </ul>
   					</li>
                    <li>
                    	<a href="#"><i class="fa fa-edit fa-fw"></i> Registrasi Praktikum<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
   							<li><?php echo anchor('admin_registrasi','Registrasi') ?></li>
   							<li><?php echo anchor('admin_registrasi/pindah','Pindah Praktikum') ?></li> 
                        </ul>
   					</li>
                    <li><?php echo anchor('admin_pembayaran','<i class="glyphicon glyphicon glyphicon-ok"></i> Status Pembayaran') ?></li>
                    <li><?php echo anchor('admin_absensi','<i class="glyphicon glyphicon-list-alt"></i> Absensi') ?></li>
   					<li><?php echo anchor('admin_penilaian','<i class="glyphicon glyphicon-font"></i> Penilaian Praktikum') ?></li>
   					<li><?php echo anchor('admin_penggajian/gaji/1/1/1','<i class="glyphicon glyphicon-usd"></i> Penggajian Praktikum') ?></li>
   					<li><?php echo anchor('admin_kehadiran_asisten/cek','<i class="fa fa-check-circle-o"></i> Kehadiran Asisten') ?></li>
   					<li><?php echo anchor('admin_inventori','<i class="fa fa-briefcase"></i> Inventori') ?></li>
   					<!--li><?php echo anchor('admin_pesan/index/'.$_SESSION['id_asisten'].'/0','<i class="fa fa-envelope fa-fw"></i> Pesan') ?></li-->
                    <li>
                    	<a href="#"><i class="fa fa-envelope fa-fw"></i> Pesan<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
   							<li><?php echo anchor('admin_pesan/index/'.$_SESSION['id_asisten'].'/0','<i class="glyphicon glyphicon-envelope"></i> Kirim Pesan') ?></li>
   							<li>
							<a href="#" title="Kosongkan Pesan" class="hapus">
                            	<i class="glyphicon glyphicon-trash"></i> Hapus Semua Pesan
                                <input type="hidden" value="<?php echo base_url().'index.php/admin_pesan/kosongkan/pesan/pesan_balasan' ?>">
                            </a>
                            </li> 
                        </ul>
   					</li>
   					<li><?php echo anchor('admin_informasi','<i class="glyphicon glyphicon-bullhorn"></i> Informasi') ?></li>
   					<li><?php echo anchor('admin_catatan','<i class="glyphicon glyphicon-book"></i> Catatan Asisten') ?></li>
   					<!--li><?php echo anchor('admin_pesan/inbox','<i class="fa fa-envelope fa-fw"></i> Pesan') ?></li-->
                    <li>
                        <a href="#"><i class="fa fa-print fa-fw"></i> Cetak<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
   							<li><?php echo anchor('admin_cetak/absensi_mahasiswa','Cetak Kehadiran Mahasiswa') ?></li>
   							<li><?php echo anchor('admin_cetak/absensi_asisten','Cetak Kehadiran Asisten') ?></li> 
   							<li><?php echo anchor('admin_cetak/absen_ujian','Cetak Absen Ujian') ?></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-files-o fa-fw"></i> Lain-lain<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><?php echo anchor('admin_kelas','<i class="fa fa-home fa-fw"></i> Kelas') ?></li>
                            <li><?php echo anchor('admin_mahasiswa','<i class="fa fa-user fa-fw"></i> Mahasiswa') ?></li>
                            <li><?php echo anchor('admin_ruangan','<i class="fa fa-home fa-fw"></i> Ruangan') ?></li>
                            <li><?php echo anchor('admin_mata_praktikum','<i class="fa fa-file fa-fw"></i> Mata Praktikum') ?></li>
                            <li><?php echo anchor('admin_jabatan','<i class="fa fa-star fa-fw"></i> Jabatan') ?></li>
                            <li><?php echo anchor('admin_kategori/view','<i class="fa fa-bars fa-fw"></i> Kategori') ?></li>
                            <li><?php echo anchor('admin_shutdown/setting','<i class="glyphicon glyphicon-off"></i> Shutdown Server') ?></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-print fa-fw"></i> Kuisioner<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
   							<li><?php echo anchor('admin/kuisioner_mahasiswa','Kuisioner Mahasiswa') ?></li>
   							<li><?php echo anchor('admin/kuisioner_asisten','Kuisioner Asisten') ?></li> 
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper">
            <div class="row">
            	<?php $this->load->view($view) ?>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->    
    </div>
    <!-- Small modal Konfirmasi -->
	<div class="modal fade konfirmasi-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-sm">
    		<div class="modal-content" style="width:320px; border-radius:0px;">
            	<div class="modal-header">
          			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          			<h4 class="modal-title" id="mySmallModalLabel">Konfirmasi</h4>
        		</div>
        		<div class="modal-body"></div>
                <div class="modal-footer">
                    <a href="#" id="hapus" class="btn btn-primary">Ok</a>
                    <a href="#" class="btn btn-default" data-dismiss="modal" style="margin-left:10px;">Batal</a>
                </div>
            </div>
  		</div>
	</div>
    <!--Notif-->
    <div class="alert alert-info notif"></div>
    <!--div class="chatt">
    	<b>Chat Asisten</b>
    </div-->
    <script type="text/javascript">
		$(document).ready(function(e) {
		//modal konfirmasi hapus
			$('.hapus').click(function(){
					var url = $('input',this).val();
						tipe = $(this).attr('title');
					$('.modal-body').html('');
					$("#hapus").show();

					if(tipe == 'logout'){
						$('.modal-body').html('Apakah anda yakin ingin <b>Logout</b> ?');
					}
					else if(tipe == 'hapus'){
						$('.modal-body').html('Apakah anda yakin ingin menghapus ini ?');
					}
					else if(tipe == 'Kosongkan Pesan'){
						$('.modal-body').html('Apakah anda yakin ingin menghapus semua pesan ?');
					}
                    else if(tipe == 'Tidak bisa hapus'){
                        $('.modal-body').html('Data tidak bisa dihapus, data sudah digunakan pada menu sebelumnya.');
                        $("#hapus").hide();
                    }
					$("#hapus").attr('href', url);
					
					$('.konfirmasi-modal').modal('toggle');
					return false;
			});
			setInterval(function(){
				$('.jumlah-pesan').load('<?php echo base_url('index.php/admin_pesan/refresh_jumlah_pesan') ?>');
				}, 60000);
        });
	</script>
</body>
</html>