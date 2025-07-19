<script>
	$(document).ready(function(e) {
		$('.id_praktikum').change(function(){
			var id_praktikum = $('.id_praktikum').val();
			var pertemuan = $('.pertemuan').val();
			if(id_praktikum!=''){
				window.location.href='<?php echo base_url() ?>index.php/asisten_absensi/absensi/'+id_praktikum;				
			}
			else{
				return false;
			}
		});
		
<?php
		//cek tanggal absen
		if(date('Y-m-d')<$absendate->absen_tanggal){
			echo "$('#myModalAbsen').modal('show');";
		}
		
		$pertemuans = $pertemuan->pertemuan + 1;
		$pertermuanM ='0';
		if($pertemuans<=10){
			$pertermuanM = $pertemuan->pertemuan + 1;
		}
		else{
			if($pertermuanM==10){
				$pertermuanM = 10;
			}
			else{
				$pertermuanM = 'Pertemuan habis';
			}
		}
		if($pertemuans<=10){
?>
		$('.kehadiran',this).click(function(){
			var npm = $(this).attr('id');
			var kehadiran = $('#'+npm).html();
			$('#'+npm).html('<img src="<?php echo base_url() ?>/image/loading.gif"/>');
			var id_praktikum = $('.id_praktikum').val();
			var pertemuan = $('.pertemuan').html();
			var tgl = $('.tanggal').html();
			var respon;
			//alert(id_praktikum+' '+pertemuan+' '+npm+'\n'+tgl+'\n'+kehadiran);
			if(kehadiran=='Hadir'){
				respon = 'Tidak Hadir';
				$.ajax({
					type:"POST",
					url:"<?php echo base_url() ?>index.php/asisten_absensi/mengabsen",
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
					url:"<?php echo base_url() ?>index.php/asisten_absensi/mengabsen",
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
					url:"<?php echo base_url() ?>index.php/asisten_absensi/mengabsen",
					data:"npm="+npm+"&respon="+respon+"&id_praktikum="+id_praktikum+"&pertemuan="+pertemuan+"&tanggal="+tgl,
					success: function(data){
						$('#'+npm).html(data);
					}
				});
			}
			return false;
		});
		
		// asisten
		$('.ke-asisten',this).click(function(){
			$('.bs-example-modal-sm').modal('show');
			$('.input-pass-asisten').val('');
			var asisten = $(this).attr('id');
			var kehadiran = $('#'+asisten).html();
			$('.input-id-asisten').val(asisten);
			$('.input-kehadiran-asisten').val(kehadiran);
		});
		
		//ketika form pass muncul click hadir
		$('.hadir-asisten').click(function(){
			var asisten = $('.input-id-asisten').val();
			var kehadiran = $('.input-kehadiran-asisten').val();
			var pass = $('.input-pass-asisten').val();
			
			var id_praktikum = $('.id_praktikum').val();
			var pertemuan = $('.pertemuan').html();
			var tgl = $('.tanggal').html();
			
			var respon;
			if(kehadiran=='Hadir'){
				respon = 'Tidak Hadir';
				$.ajax({
					type:"POST",
					url:"<?php echo base_url() ?>index.php/asisten_absensi/absen_asisten",
					data:"asisten="+asisten+"&respon="+respon+"&id_praktikum="+id_praktikum+"&pertemuan="+pertemuan+"&tanggal="+tgl+"&pass="+pass,
					success: function(data){
						if(data=='Hadir'){
							$('#'+asisten).html(data);
							$('.bs-example-modal-sm').modal('hide');			
						}
						else if(data=='Tidak Hadir'){
							$('#'+asisten).html(data);
							$('.bs-example-modal-sm').modal('hide');			
						}
						else if(data=='PasswordSalah'){
							alert('Maaf, password yang anda masukan salah');	
						}
					}
				});
			}
			else if(kehadiran=='Tidak Hadir'){
				respon = 'Hadir';
				$.ajax({
					type:"POST",
					url:"<?php echo base_url() ?>index.php/asisten_absensi/absen_asisten",
					data:"asisten="+asisten+"&respon="+respon+"&id_praktikum="+id_praktikum+"&pertemuan="+pertemuan+"&tanggal="+tgl+"&pass="+pass,
					success: function(data){
						if(data=='Hadir'){
							$('#'+asisten).html(data);
							$('.bs-example-modal-sm').modal('hide');			
						}
						else if(data=='Tidak Hadir'){
							$('#'+asisten).html(data);
							$('.bs-example-modal-sm').modal('hide');			
						}
						else if(data=='PasswordSalah'){
							alert('Maaf, password yang anda masukan salah');	
						}
					}
				});
			}
			else{
				alert('Tunggu sebentar');	
				 $.ajax({
					type:"POST",
					url:"<?php echo base_url() ?>index.php/asisten_absensi/absen_asisten",
					data:"asisten="+asisten+"&respon="+respon+"&id_praktikum="+id_praktikum+"&pertemuan="+pertemuan+"&tanggal="+tgl+"&pass="+pass,
					success: function(data){
						alert(data);
					}
				});
			}
			return false;
		});
		
		//ketika inputan di enter
		$(".input-pass-asisten").keypress(function(t){
			if(t.which==13){
				var asisten = $('.input-id-asisten').val();
				var kehadiran = $('.input-kehadiran-asisten').val();
				var pass = $('.input-pass-asisten').val();
				
				var id_praktikum = $('.id_praktikum').val();
				var pertemuan = $('.pertemuan').html();
				var tgl = $('.tanggal').html();
				
				var respon;
				if(kehadiran=='Hadir'){
					respon = 'Tidak Hadir';
					$.ajax({
						type:"POST",
						url:"<?php echo base_url() ?>index.php/asisten_absensi/absen_asisten",
						data:"asisten="+asisten+"&respon="+respon+"&id_praktikum="+id_praktikum+"&pertemuan="+pertemuan+"&tanggal="+tgl+"&pass="+pass,
						success: function(data){
							if(data=='Hadir'){
								$('#'+asisten).html(data);
								$('.bs-example-modal-sm').modal('hide');			
							}
							else if(data=='Tidak Hadir'){
								$('#'+asisten).html(data);
								$('.bs-example-modal-sm').modal('hide');			
							}
							else if(data=='PasswordSalah'){
								alert('Maaf, password yang anda masukan salah');	
							}
						}
					});
				}
				else if(kehadiran=='Tidak Hadir'){
					respon = 'Hadir';
					$.ajax({
						type:"POST",
						url:"<?php echo base_url() ?>index.php/asisten_absensi/absen_asisten",
						data:"asisten="+asisten+"&respon="+respon+"&id_praktikum="+id_praktikum+"&pertemuan="+pertemuan+"&tanggal="+tgl+"&pass="+pass,
						success: function(data){
							if(data=='Hadir'){
								$('#'+asisten).html(data);
								$('.bs-example-modal-sm').modal('hide');			
							}
							else if(data=='Tidak Hadir'){
								$('#'+asisten).html(data);
								$('.bs-example-modal-sm').modal('hide');			
							}
							else if(data=='PasswordSalah'){
								alert('Maaf, password yang anda masukan salah');	
							}
						}
					});
				}
				else{
					alert('Tunggu sebentar');	
					 $.ajax({
						type:"POST",
						url:"<?php echo base_url() ?>index.php/asisten_absensi/absen_asisten",
						data:"asisten="+asisten+"&respon="+respon+"&id_praktikum="+id_praktikum+"&pertemuan="+pertemuan+"&tanggal="+tgl+"&pass="+pass,
						success: function(data){
							alert(data);
						}
					});
				}
				return false;
			}
		});
<?php 
		}
?>
    });
</script>
<style>
	.input-mini{width:70px;border-radius:5px 5px 5px 5px;color:#525252;}
	.input-medium{width:150px; border-radius:5px 5px 5px 5px;color:#525252;}
	.jarak{margin-left:50px;}
	.atas{width:100%;float:left;margin-bottom:10px;border-radius:0px 0px 0px 0px;}
	.kiri1{width:130px;float:left;margin-left:0px;}
	.kiri2{width:190px;float:left;}
	.tgl{float:right;}
	.kehadiran,.ke-asisten{cursor:pointer;text-align:center;}
	.jarak-bawah{margin-bottom:50px;}
	.pertemuan{float:left;}
</style>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="mySmallModalLabel">Kehadiran Asisten</h4>
        </div><br />
      	<input type="password" class="form-control input-pass-asisten w8" placeholder="Masukan Password" name="pass" />
        <input type="hidden" name="id_asisten" class="input-id-asisten" />
        <input type="hidden" name="id_asisten" class="input-kehadiran-asisten" /><br />
        <div class="modal-footer">
        	<a href="#" class="btn btn-primary hadir-asisten" style="float:left;">Hadir</a>
      	</div>
    </div>
  </div>
</div>

<div class="col-md-12">
	<h2 class="page-header">Absensi Praktikum</h2>
</div>
<?php 
	$pertemuans = $pertemuan->pertemuan + 1;
	foreach($keterangan as $ket){
		$asisten1 = $this->models->where1('asisten','id_asisten',$ket->pengajar1);
		$asisten2 = $this->models->where1('asisten','id_asisten',$ket->pengajar2);
?>
<div class="col-md-12 table-responsive">
	<div class="atas alert alert-info">
    	<div class="atas">
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
            <div class="kiri1">
                <b>Pertemuan</b>
            </div>
            <b><span class="pertemuan"><?php echo $pertermuanM ?></span></b>
            <div class="tgl">
                <b><i class="glyphicon glyphicon-calendar"></i> <span class="tanggal"><?php echo $tanggal; ?></span></b>
            </div>
    	</div><b>
        <div class="atas">
            <div class="kiri1">Praktikum</div>
            <div class="kiri2"><?php echo $ket->mata_praktikum ?></div>
            <div class="kiri1">Kelas</div>
            <div class="kiri2"><?php echo $ket->kelas ?></div>
        </div>
        <div class="atas">
            <div class="kiri1">Jadwal</div>
            <div class="kiri2"><?php echo $ket->hari.', '.$ket->jam ?></div>
            <div class="kiri1">Ruangan</div>
            <div class="kiri2"><?php echo $ket->ruangan ?></div>
        </div>
    </div></b>
</div>
<?php } ?>
<div class="col-md-12 table-responsive">
<?php 
	$id_prak = explode('_',$id_praktikum);
	if(empty($id_prak[2])){
?>
	<table class="table table-bordered table-hover table-striped">
    	<thead class="alert-info">
        	<th width="70">No</th>
        	<th width="250">Pengajar</th>
        	<th>Nama Asisten</th>
        	<th width="200">Kehadiran</th>
        </thead>
        <tbody>
        <?php
			foreach($keterangan as $ket){
				$asisten1 = $this->models->where2('asisten','id_asisten','status',$ket->pengajar1,1);
				$asisten2 = $this->models->where2('asisten','id_asisten','status',$ket->pengajar2,1);
				foreach($asisten1 as $pengajar1){
					$cek = $this->admin_absen_models->cek_asisten('absensi_asisten',$id_praktikum,$pengajar1->id_asisten,($pertemuan->pertemuan+1));
					if($cek->hadir==1){
						$phadir1 = 'Hadir';	
					}
					else{
						$phadir1 = 'Tidak Hadir';	
					}
		?>
        	<tr>
            	<td>1</td>
            	<td>Pengajar 1</td>
            	<td><?php echo $pengajar1->nama ?></td>
                <td class="ke-asisten" id="<?php echo $pengajar1->id_asisten ?>"><?php echo $phadir1 ?></td>
            </tr>
        <?php
				}
				foreach($asisten2 as $pengajar2){
					$cek = $this->admin_absen_models->cek_asisten('absensi_asisten',$id_praktikum,$pengajar2->id_asisten,($pertemuan->pertemuan+1));
					if($cek->hadir==1){
						$phadir2 = 'Hadir';	
					}
					else{
						$phadir2 = 'Tidak Hadir';	
					}
		?>
        	<tr>
            	<td>2</td>
            	<td>Pengajar 2</td>
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
    	<thead class="alert-info">
        	<th width="70">No</th>
        	<th width="250">NPM</th>
        	<th>Nama Mahasiswa</th>
        	<th width="200">Kehadiran</th>
        </thead>
        <tbody>
        <?php
			$no = 0;
			foreach($mahasiswa as $mhs){
			$no++;
		?>
        	<tr>
            	<td><?php echo $no ?></td>
            	<td><?php echo $mhs->npm ?></td>
            	<td><?php echo $mhs->nama ?></td>
            	<td class="kehadiran" id="<?php echo $mhs->npm ?>">Tidak Hadir</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <button type="button" data-toggle="modal" data-target="#ModBerita" rel="tooltip" title="Edit Task" class="btn btn-primary ">Berita Acara
                                                            </button>
</div>

<!--modal Berita acara-->
<div class="modal fade" id="ModBerita" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
    	<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="mySmallModalLabel">Berita acara</h4>
        </div><br />
        <form method="post" action="<?php echo base_url() ?>index.php/asisten_absensi/post_bertaAcara"> 
        <input type="hidden" name="id_praktikum" value="<?php echo $id_praktikum ?>">
        <input type="hidden" name="pertemuan" value="<?php echo $pertermuanM ?>">
        <input type="hidden" name="tanggal" value="<?php echo $tanggal ?>">
        <textarea  name='isi' placeholder="Isi dengan Detail" class="form-control" style="width: 560px; margin-left: 20px;height: 200px"></textarea>
      	<br />
        <div class="modal-footer">
        	<button class="btn btn-primary" style="float:right;">Simpan</button>
      	</div>
      	</form>
    </div>
  </div>
</div>

<!-- Modal Absen-->
<div class="modal fade" id="myModalAbsen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Kesalahan tanggal absensi.</h4>
      </div>
      <div class="modal-body text-center">
		 Perhatikan tanggal absen. Tanggal absen tidak sesuai dengan tanggal sekarang. Cek tanggal komputer server.
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>