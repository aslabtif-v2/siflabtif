<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SIFLABTIF</title>
    <link href="<?php echo base_url() ?>image/logo-labtif.png" rel="shortcut icon" />
    <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link  href="data:text/css;charset=utf-8," data-href="<?php echo base_url() ?>assets/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/my-style-asisten.css" rel="stylesheet">
    
    <!--javascript dan jquery-->
    <script src="<?php echo base_url() ?>assets/js/jquery-1.10.2.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/sb-admin.js"></script>
    <script src="<?php echo base_url()?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>  
    <script> var base_url = "<?php echo base_url() ?>"; </script>
</head>

<body>
	<div class="dasboard">
    	<div class="container">
        	<!--img class="logo" src="<?php echo base_url() ?>image/logo-teknik.png" /-->
            <h1 class="si">Sistem Informasi Laboratorium Teknik Informatika <?php echo date('Y') ?></h2>
        </div>
	</div>
    <div class="navbar navbar-default navbar-static-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
          		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
          		</button>
          		<a class="navbar-brand" href="#">LABTIF</a>
			</div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class=""><a href="#"><?php echo $_SESSION['nama'] ?></a></li>
                    <li class="dropdown jumlah-pesan">
						<?php
							$copyrigth = $this->models->where1Row('asisten','id_asisten','10');
                            $namabulan = array("","Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                            $jp = $this->db->query("SELECT pesan_balasan.id_pesan, pesan.user_satu, COUNT(pesan_balasan.status) AS jumlah, MAX(pesan_balasan.pesan) AS pesan, max(pesan_balasan.tanggal) as tanggal FROM pesan_balasan, pesan WHERE pesan_balasan.id_pesan=pesan.id_pesan AND pesan.user_dua='".$_SESSION['id_asisten']."' AND pesan_balasan.status='1' GROUP BY pesan.user_satu")->result();
                            $tp = 0;
                            $np = '';
                            foreach($jp as $jps){
                                $tp = $jps->jumlah+$tp;
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
                            $asis = $this->models->where1Row('asisten','id_asisten',$jps->user_satu);
                            $tgls = explode('-',$jps->tanggal);
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
                                <a href="<?php echo base_url('index.php/asisten_pesan/index/'.$_SESSION['id_asisten'].'/'.$jps->user_satu) ?>">
                                    <div>
                                        <strong><?php echo $asis->nama ?> <span class="badge badge-danger"><?php echo $jps->jumlah ?></span></strong>
                                        <span class="pull-right text-muted tmsg">
                                            <em><?php echo $waktu ?></em>
                                        </span>
                                    </div>
                                    <div><?php  echo substr($jps->pesan,0,30).'...'; ?></div>
                                </a>
                            </li>
                        <?php 
                            }
                            echo '</ul>';
                        }
                        ?>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['namajabatan'] ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                        <?php if($_SESSION['jabatan']=='adminsistem'){ ?>
                        <li><?php echo anchor('admin_beranda','<i class="glyphicon glyphicon-th-large"></i> Halaman Admin') ?></li>
                        <?php } ?>
                        <li><?php echo anchor('asisten_biodata/lihat_asisten/'.$_SESSION['id_asisten'],'<i class="fa fa-user fa-fw"></i> Profil') ?></li>
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
            </div><!--/.nav-collapse -->
		</div>
    </div>
    <div class="container konten">
    	<div class="col-md-3" style="padding-left:0px;">
        	<div class="panel-group" id="accordion" style="margin-top:0px;">
                <div class="panel panel-info">
                    <div class="panel-heading" style="height:50px;">
                    	<h4 class="panel-title">
                            	<h3>Menu</h3>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse in">
                        <div class="panel panel-default">
                            <ul class="nav" id="side-menu">
                            <li><a href="<?php echo base_url('index.php/asisten_beranda') ?>"><img src="<?php echo base_url('image/home.png') ?>" class="menu-icon" /> Beranda</a></li>
                                <li><a href="<?php echo base_url('index.php/asisten_biodata/lihat_asisten/'.$_SESSION['id_asisten']) ?>"><img src="<?php echo base_url('image/biodata.png') ?>" class="menu-icon" /> Biodata Asisten</a></li>
                                <li><a href="<?php echo base_url('index.php/asisten_absensi') ?>"><img src="<?php echo base_url('image/absen.png') ?>" class="menu-icon" /> Absensi Praktikum</a></li>
                                <li><a href="<?php echo base_url('index.php/asisten_penilaian') ?>"><img src="<?php echo base_url('image/nilai.png') ?>" class="menu-icon" /> Penilaian Praktikum</a></li>
                                <li><a href="<?php echo base_url('index.php/asisten_pesan/index/'.$_SESSION['id_asisten'].'/0') ?>"><img src="<?php echo base_url('image/pesan.png') ?>" class="menu-icon" /> Pesan</a></li>
 								<?php if(($_SESSION['jabatan']=='sekretaris')||($_SESSION['jabatan']=='bendahara')){ ?>
                                <li><a href="<?php echo base_url('index.php/asisten_penggajian/gaji/1/1/1') ?>"><img src="<?php echo base_url('image/penggajian.png') ?>" class="menu-icon" /> Penggajian</a></li>
                                <li>
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><img src="<?php echo base_url('image/printer.png') ?>" class="menu-icon" /> Cetak<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level list-group">
                                        <li class="group-item"><a target="_blank" href="<?php echo base_url('index.php/admin_cetak/absensi_mahasiswa') ?>"><img src="<?php echo base_url('image/printer.png') ?>" class="menu-icon-kecil" /> Kehadiran Mahasiswa</a></li>
                                        <li class="group-item"><a target="_blank" href="<?php echo base_url('index.php/admin_cetak/absensi_asisten') ?>"><img src="<?php echo base_url('image/printer.png') ?>" class="menu-icon-kecil" /> Kehadiran Asisten</a></li> 
                                        <li class="group-item"><a target="_blank" href="<?php echo base_url('index.php/admin_cetak/absen_ujian') ?>"><img src="<?php echo base_url('image/printer.png') ?>" class="menu-icon-kecil" /> Absensi Ujian</a></li> 
                                    </ul>
                                </li>
                                <?php } ?>
                                <?php if($_SESSION['jabatan']=='koordinatorlab'){ ?>
                                <li><a href="<?php echo base_url('index.php/admin_kehadiran_asisten/cek') ?>"><img src="<?php echo base_url('image/absen-asisten.png') ?>" class="menu-icon" />Cek Kehadiran Asisten</a>
                                <li><a href="<?php echo base_url('index.php/asisten_inventori') ?>"><img src="<?php echo base_url('image/inventory.png') ?>" class="menu-icon" /> Laporan Inventori</a>
                                <li><a href="<?php echo base_url('index.php/asisten_informasi') ?>"><img src="<?php echo base_url('image/informasi.png') ?>" class="menu-icon" /> Informasi</a></li>
                                <li><a href="<?php echo base_url('index.php/asisten_jadwal_praktikum') ?>"><img src="<?php echo base_url('image/jadwal.png') ?>" class="menu-icon" /> Jadwal Praktikum</a></li>
                                <li><a href="<?php echo base_url('index.php/asisten_mahasiswa') ?>"><img src="<?php echo base_url('image/mhs.png') ?>" class="menu-icon" /> Nilai Mahasiswa</a></li>
                                <?php } ?> 
                                <?php if(($_SESSION['jabatan']=='pjmulti') || ($_SESSION['jabatan']=='pjdasar') || ($_SESSION['jabatan']=='pjjarkom') || ($_SESSION['jabatan']=='teknisilab')){ ?>
                                <li><a href="<?php echo base_url('index.php/asisten_inventori') ?>"><img src="<?php echo base_url('image/inventory.png') ?>" class="menu-icon" /> Laporan Inventori</a>
                                <?php } ?> 
                                <li><a href="<?php echo base_url('index.php/asisten_kehadiran') ?>"><img src="<?php echo base_url('image/absen-asisten.png') ?>" class="menu-icon" /> Kehadiran Asisten</a>
                                <li><a href="<?php echo base_url('index.php/asisten_catatan') ?>"><img src="<?php echo base_url('image/catatan.png') ?>" class="menu-icon" /> Catatan</a>
                                </li>
                                <li><a href="<?php echo base_url('index.php/asisten/penilaian_asisten') ?>"><img src="<?php echo base_url('image/catatan.png') ?>" class="menu-icon" /> Penilaian Asisten</a>
                                <li><a href="<?php echo base_url('index.php/asisten/penilaian_diri') ?>"><img src="<?php echo base_url('image/catatan.png') ?>" class="menu-icon" /> Penilaian Diri</a>
                                </li>
                            </ul>
                        </div>
                    </div>
				</div>
        	</div>
        </div>
        <div class="col-md-9">
			<div class="row"><?php echo $this->load->view($view); ?></div>
        </div>
    </div>
    <div class="footer-bwh">
        <p><b title="<?php echo $copyrigth->nama ?>">Copyrigth &copy; ASLABTIF 2014<br>Teknik Informatika UNSUR</b></p>
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
	<script type="text/javascript">
		$(document).ready(function(e) {
		//modal konfirmasi hapus
			$('.hapus').click(function(){
					var url = $('input',this).val();
						tipe = $(this).attr('title');
					$('.modal-body').html('');
					
					if(tipe == 'logout'){
						$('.modal-body').html('Apakah anda yakin ingin <b>Logout</b> ?');
					}
					else{
						$('.modal-body').html('Apakah anda yakin ingin menghapus ini ?');
					}
					$("#hapus").attr('href', url);
					
					$('.konfirmasi-modal').modal('toggle');
					return false;
			});
			setInterval(function(){
				$('.jumlah-pesan').load('<?php echo base_url('index.php/asisten_pesan/refresh_jumlah_pesan') ?>');
				}, 60000);
        });
	</script>
</body>
</html>