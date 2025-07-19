<script>
	$(document).ready(function(e) {
        $('.pertemuan').change(function(){
			var id_praktikum = $('.id_praktikum').val();
			var pertemuan = $('.pertemuan').val();
			if(id_praktikum!=''){
				window.location.href='<?php echo base_url() ?>index.php/admin_absensi/absensi/'+id_praktikum+'/'+pertemuan;				
			}
			else{
				window.location.href='<?php echo base_url() ?>index.php/admin_absensi';	
			}
		});
		$('.id_praktikum').change(function(){
			var id_praktikum = $('.id_praktikum').val();
			var pertemuan = $('.pertemuan').val();
			if(id_praktikum!=''){
				window.location.href='<?php echo base_url() ?>index.php/admin_absensi/absensi/'+id_praktikum+'/'+pertemuan;				
			}
			else{
				window.location.href='<?php echo base_url() ?>index.php/admin_absensi';	
			}
		});
		$('.kehadiran',this).click(function(){
			var npm = $(this).attr('id');
			var kehadiran = $('#'+npm).html();
			$('#'+npm).html('<img src="<?php echo base_url() ?>/image/loading.gif"/>');
			var id_praktikum = $('.id_praktikum').val();
			var pertemuan = $('.pertemuan').val();
			var tgl = $('.tanggal').html();
			var respon;
			//alert(id_praktikum+' '+pertemuan+' '+npm+'\n'+tgl+'\n'+kehadiran);
			if(kehadiran=='Hadir'){
				respon = 'Tidak Hadir';
				$.ajax({
					type:"POST",
					url:"<?php echo base_url() ?>index.php/admin_absensi/mengabsen",
					data:"npm="+npm+"&respon="+respon+"&id_praktikum="+id_praktikum+"&pertemuan="+pertemuan+"&tanggal="+tgl,
					success: function(data){
						$('#'+npm).html(data);
					}
				});
			}
			else if(kehadiran=='Tidak Hadir'){
				respon = 'Hadir';
				$.ajax({
					type:"POST",
					url:"<?php echo base_url() ?>index.php/admin_absensi/mengabsen",
					data:"npm="+npm+"&respon="+respon+"&id_praktikum="+id_praktikum+"&pertemuan="+pertemuan+"&tanggal="+tgl,
					success: function(data){
						$('#'+npm).html(data);
					}
				});
			}
			else{
				alert('Tunggu sebentar');	
				 $.ajax({
					type:"POST",
					url:"<?php echo base_url() ?>index.php/admin_absensi/mengabsen",
					data:"npm="+npm+"&respon="+respon+"&id_praktikum="+id_praktikum+"&pertemuan="+pertemuan+"&tanggal="+tgl,
					success: function(data){
						$('#'+npm).html(data);
					}
				});
			}
			return false;
		});
		//asisten
		$('.ke-asisten',this).click(function(){
			var asisten = $(this).attr('id');
			var kehadiran = $('#'+asisten).html();
			$('#'+asisten).html('<img src="<?php echo base_url() ?>/image/loading.gif"/>');
			var id_praktikum = $('.id_praktikum').val();
			var pertemuan = $('.pertemuan').val();
			var tgl = $('.tanggal').html();
			var respon;
			//alert(id_praktikum+' '+pertemuan+' '+npm+'\n'+tgl+'\n'+kehadiran);
			if(kehadiran=='Hadir'){
				respon = 'Tidak Hadir';
				$.ajax({
					type:"POST",
					url:"<?php echo base_url() ?>index.php/admin_absensi/absen_asisten",
					data:"asisten="+asisten+"&respon="+respon+"&id_praktikum="+id_praktikum+"&pertemuan="+pertemuan+"&tanggal="+tgl,
					success: function(data){
						$('#'+asisten).html(data);
					}
				});
			}
			else if(kehadiran=='Tidak Hadir'){
				respon = 'Hadir';
				$.ajax({
					type:"POST",
					url:"<?php echo base_url() ?>index.php/admin_absensi/absen_asisten",
					data:"asisten="+asisten+"&respon="+respon+"&id_praktikum="+id_praktikum+"&pertemuan="+pertemuan+"&tanggal="+tgl,
					success: function(data){
						$('#'+asisten).html(data);
					}
				});
			}
			else{
				alert('Tunggu sebentar');	
				 $.ajax({
					type:"POST",
					url:"<?php echo base_url() ?>index.php/admin_absensi/absen_asisten",
					data:"asisten="+asisten+"&respon="+respon+"&id_praktikum="+id_praktikum+"&pertemuan="+pertemuan+"&tanggal="+tgl,
					success: function(data){
						$('#'+asisten).html(data);
					}
				});
			}
			return false;
		});
    });
</script>
<style>
	.input-mini{width:70px;border-radius:5px 5px 5px 5px;color:#525252;}
	.input-medium{width:150px; border-radius:5px 5px 5px 5px;color:#525252;}
	.jarak{margin-left:50px;}
	.atas{width:100%;float:left;margin-bottom:10px;}
	.col-lg-6,.col-lg-5,.col-lg-7{padding-left:0px;}
	.kiri1{width:110px;float:left;margin-left:0px;}
	.kiri2{width:230px;float:left;}
	.tgl{width:150px;float:right;}
	.kehadiran,.ke-asisten{cursor:pointer;text-align:center;}
</style>
<div class="col-lg-12">
	<h1 class="page-header">Absensi Praktikum</h1>
</div>
<?php 
	foreach($keterangan as $ket){
		$asisten1 = $this->models->where1('asisten','id_asisten',$ket->pengajar1);
		$asisten2 = $this->models->where1('asisten','id_asisten',$ket->pengajar2);
?>
<div class="col-lg-12" table-responsive>
	<div class="atas alert alert-warning" style="margin-bottom:-30px;">
    	<div class="atas">
            <div class="col-lg-5">
                <div class="kiri1">
                    <b>ID Praktikum</b>
                </div>
                <div class="kiri2">
                    <select class="input-medium id_praktikum">
                        <!--option value="">--ID Praktikum--</option-->
                        <?php 
							foreach($praktikum as $rz){ 
								if($rz->id_praktikum==$id_praktikum){
									$pilih = 'selected';
								}
								else{
									$pilih ='';
								}
                            	echo "<option value='$rz->id_praktikum' $pilih>".strtoupper($rz->id_praktikum)."</option>";
                        	} 
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="kiri1">
                    <b>Pertemuan</b>
                </div>
                <div class="kiri2">
                   <select class="input-mini pertemuan">
                        <?php 
							$pilih ='';
                            for($i=1;$i<=10;$i++){
								if($i==$pertemuan){
									$pilih = 'selected';
								}
								else{
									$pilih = '';
								}
                                echo "<option $pilih>$i</option>";
                            } 
                        ?>
                    </select>
                </div>
                <div class="tgl">
                    <b><i class="glyphicon glyphicon-calendar"></i> <span class="tanggal"><?php if(!empty($tanggal->tanggal)){echo $tanggal->tanggal;} ?></span></b>
                </div>
            </div>
    	</div><b>
        <div class="atas">
            <div class="col-lg-5">
                <div class="kiri1">
                    Praktikum
                </div>
                <div class="kiri2">
                    <?php echo $ket->mata_praktikum ?>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="kiri1">
                    Kelas
                </div>
                <div class="kiri2">
                    <?php echo $ket->kelas ?>
                </div>
            </div>
        </div>
        <div class="atas">
            <div class="col-lg-5">
                <div class="kiri1">
                    Jadwal
                </div>
                <div class="kiri2">
                	<?php echo $ket->hari.', '.$ket->jam ?>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="kiri1">
                    Ruangan
                </div>
                <div class="kiri2">
                    <?php echo $ket->ruangan ?>
                </div>
            </div>
        </div>
    </div></b>
</div>
<?php } ?>
<div class="col-lg-12 table-responsive">
<?php 
	$id_prak = explode('_',$id_praktikum);
	if(empty($id_prak[2])){
?>
	<table class="table table-bordered table-hover table-striped">
    	<caption><h3>Asisten</h3></caption>
    	<thead>
        	<th width="70">No</th>
        	<th width="250">Pengajar</th>
        	<th>Nama Asisten</th>
        	<th width="200">Kehadiran</th>
        </thead>
        <tbody>
        <?php
			foreach($keterangan as $ket){
				$noa = 1; 
				$asisten1 = $this->models->where2('asisten','id_asisten','status',$ket->pengajar1,1);
				$asisten2 = $this->models->where2('asisten','id_asisten','status',$ket->pengajar2,1);
				foreach($asisten1 as $pengajar1){
					$cek = $this->admin_absen_models->cek_asisten('absensi_asisten',$id_praktikum,$pengajar1->id_asisten,$pertemuan);
					if($cek->hadir==1){
						$phadir1 = 'Hadir';	
					}
					else{
						$phadir1 = 'Tidak Hadir';	
					}
		?>
        	<tr>
            	<td><?php echo $noa ?></td>
            	<td>Pengajar <?php echo $noa ?></td>
            	<td><?php echo $pengajar1->nama ?></td>
                <td class="ke-asisten" id="<?php echo $pengajar1->id_asisten ?>"><?php echo $phadir1 ?></td>
            </tr>
        <?php
				}
				$noa++; 
				foreach($asisten2 as $pengajar2){
					$cek = $this->admin_absen_models->cek_asisten('absensi_asisten',$id_praktikum,$pengajar2->id_asisten,$pertemuan);
					if($cek->hadir==1){
						$phadir2 = 'Hadir';	
					}
					else{
						$phadir2 = 'Tidak Hadir';	
					}
		?>
        	<tr>
            	<td><?php echo $noa ?></td>
            	<td>Pengajar <?php echo $noa ?></td>
            	<td><?php echo $pengajar2->nama ?></td>
                <td class="ke-asisten" id="<?php echo $pengajar2->id_asisten ?>"><?php echo $phadir2 ?></td>
            </tr>
        <?php 
				}
			}
		?>
        </tbody>
    </table>
<?php } ?>
	<table class="table table-bordered table-hover table-striped">
    	<caption><h3>Mahasiswa</h3></caption>
    	<thead>
        	<th width="70">No</th>
        	<th width="250">NPM</th>
        	<th>Nama</th>
        	<th width="200">Kehadiran</th>
        </thead>
        <tbody>
        <?php
			$no = 0;
			foreach($mahasiswa as $mhs){
			$no++;
			$cek = $this->admin_absen_models->cek('absensi',$id_praktikum,$mhs->npm,$pertemuan);
			if($cek->hadir==1){
				$kehadiran = 'Hadir';	
			}
			else{
				$kehadiran = 'Tidak Hadir';	
			}
		?>
        	<tr>
            	<td><?php echo $no ?></td>
            	<td><?php echo $mhs->npm ?></td>
            	<td><?php echo $mhs->nama ?></td>
            	<td class="kehadiran" id="<?php echo $mhs->npm ?>"><?php echo $kehadiran ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>