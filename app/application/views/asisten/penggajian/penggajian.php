<script>
	$(document).ready(function(e) {
        $('.dari').change(function(){
			var dari = $('.dari').val();
			var sampai = $('.sampai').val();
			var bulan = $('.bulan').val();
			window.location.href='<?php echo base_url() ?>index.php/asisten_penggajian/gaji/'+dari+'/'+sampai+'/'+bulan;
		});
		 $('.sampai').change(function(){
			var dari = $('.dari').val();
			var sampai = $('.sampai').val();
			var bulan = $('.bulan').val();
			window.location.href='<?php echo base_url() ?>index.php/asisten_penggajian/gaji/'+dari+'/'+sampai+'/'+bulan;
		});
		 $('.bulan').change(function(){
			var dari = $('.dari').val();
			var sampai = $('.sampai').val();
			var bulan = $('.bulan').val();
			window.location.href='<?php echo base_url() ?>index.php/asisten_penggajian/gaji/'+dari+'/'+sampai+'/'+bulan;
		});
    });
</script>
<style>
.dari,.sampai{margin-left:10px;color:#333}
.spasi{margin-left:20px;}
.input-mini{width:40px;}
.ctk{margin-bottom:50px;}
.bulan{color:#333;}
</style>
<div class="col-md-12">
	<h1 class="page-header">Penggajian Praktikum</h1>
</div>
<div class="col-md-12">
	<div class="alert alert-info">
		<b>Pertemuan</b>
        <input disabled class="dari input-mini" value="<?php echo $dari ?>" />
        <!--select class="dari">
        	<?php
				$pilih = '';
				for($d=1;$d<=10;$d++){
					if($d==$dari){ $pilih = 'selected';} else{$pilih = '';}
					echo "<option $pilih>$d</option>";	
				}
			?>
        </select--> 
		<b class="spasi">Sampai</b>
        <select class="sampai">
        	<?php
				$pilih = '';
				for($s=1;$s<=10;$s++){
					if($s==$sampai){ $pilih = 'selected';} else{$pilih = '';}
					echo "<option $pilih>$s</option>";	
				}
			?>
        </select> 
		<b class="spasi">Bulan</b>
        <select class="bulan">
        	<?php
				$pilih = '';
				for($b=1;$b<=4;$b++){
					if($b==$bulan){ $pilih = 'selected';} else{$pilih = '';}
					echo "<option $pilih>$b</option>";	
				}
			?>
        </select> 
    </div>
	<table class="table table-hover table-bordered table-striped">
    	<thead>
        	<th>No</th>
        	<th>Nama</th>
        	<th>Jabatan</th>
        	<th>Jumlah</th>
        	<th>Honor/Pertemuan</th>
        	<th>Honor/Jabatan</th>
        	<th>Total</th>
        </thead>
        <tbody>
        <?php
			$no = 0;
			foreach($asisten as $asistens){
				$no++;
			  	echo "<tr>
						<td>$no</td>
						<td>$asistens->nama</td>
						<td>$asistens->jabatan</td>";
				$jshif = 0;
				$shif = $this->admin_penggajian_models->shif($asistens->id_asisten);
				foreach($shif as $shifs){
					$pertemuan = $this->admin_penggajian_models->pertemuan($shifs->id_praktikum,$asistens->id_asisten,$dari,$sampai);
					foreach($pertemuan as $pertemuans){
						$jshif = $jshif+$pertemuans->pertemuan;
					}
					//$jshif = $jshif+$shifs->
				}
				$honorp = $jshif*$asistens->honor_pertemuan;
				$honorj = $bulan*$asistens->honor_perbulan;
				$total = $honorj+$honorp;
			  	echo '  <td>'.$jshif.'</td>';
				echo '  <td>Rp. '.number_format($honorp,0,'','.').'</td>';
				echo '  <td>Rp. '.number_format($honorj,0,'','.').'</td>';
				echo '	<td>Rp.'.number_format($total,0,'','.').'</td>
					</tr>
			';
			}
		?>
        </tbody>
    </table>
	<?php echo anchor('asisten_penggajian/cetak/'.$dari.'/'.$sampai.'/'.$bulan,'<i class="glyphicon glyphicon-print"></i> Cetak','class="btn ctk btn-primary"') ?>
</div>