<script>
	$(function(){
		$('.pilih-lab').change(function(){
			var lab = $('.pilih-lab').val();
			var date = $('.input-date').val();
			window.location.href=base_url+'index.php/admin_inventori/laporan_buat/'+date+'/'+lab;	
		});
		
		$('.input-date').change(function(){
			var lab = $('.pilih-lab').val();
			var date = $('.input-date').val();
			window.location.href=base_url+'index.php/admin_inventori/laporan_buat/'+date+'/'+lab;	
		});
		
		$('.status2',this).click(function(){
			var id = $(this).attr('id');
			$('.span-ket'+id).hide();
			$('.input-ket'+id).show();
		}).change(function(){
			var id = $(this).attr('id');
			var keterangan = $('.input-ket'+id).val();
			$('.span-ket'+id).html('<img src="'+base_url+'image/loading.gif"/>');
			$.ajax({
				type:"POST",
				url:base_url+"index.php/admin_inventori/pc_keterangan",
				data:"pc_id="+id+"&keterangan="+keterangan,
				success: function(data){
					$('.span-ket'+id).html(data);
				}
			});
		});
		
		$(document).mouseup(function(){
			$('.hilang').hide();
			$('.muncul').show();
			return false;
		});
		
		$('.hilang').mouseup(function(){
			return false;
		});
		
		$('.status',this).click(function(){
			var id = $(this).attr('id');
			var kondisi = $(this).attr('kondisi');
			var status = $(this).html();
			var respon;
			//alert(id+' '+kondisi+' '+status);
			if(status=='-'){
				respon='V';
				if(kondisi==7){
					$('.kondisi'+id+8).html('-');
					$('.kondisi'+id+9).html('-');
				}
				else if(kondisi==8){
					$('.kondisi'+id+7).html('-');
					$('.kondisi'+id+9).html('-');
				}
				else if(kondisi==9){
					$('.kondisi'+id+8).html('-');
					$('.kondisi'+id+7).html('-');
				}
			}
			else if(status=='V'){
				respon='-';
			}
			else{
				alert('Silahkan reload ulang halaman.');
				//$('.kondisi'+id+kondisi).html('-');
				return false;
			}
			
			$('.kondisi'+id+kondisi).html('<img src="'+base_url+'image/loading.gif"/>');
			$.ajax({
				type:"POST",
				url:base_url+"index.php/admin_inventori/pc_kondisi",
				data:"pc_id="+id+"&respon="+respon+"&kondisi="+kondisi,
				success: function(data){
					$('.kondisi'+id+kondisi).html(data);
				}
			});
		});
	});
</script>
<div class="col-sm-12">
	<h2 class="page-header">Laporan Inventori Laboratorium</h2>
	<?php 
		$jabatan = $_SESSION['jabatan'];
		$uri4 = $this->uri->segment(4);
		$uri3 = $this->uri->segment(3);
	?>
		<span class="kiri kanan-mini atas-super-mini">Tanggal : </span>
		<input type="date" value="<?php echo $date ?>" class="input-small form-control kanan-mini input-date" name="date">
		<select name="lab" class="form-control input-small bawah-mini kanan-mini pilih-lab">
		<?php
			$ruangan = $this->models->where1Row('ruangan','id_jabatan',$jabatan);
			if($jabatan=='adminsistem' || $jabatan=='teknisilab'){
				echo "<option value=''>--Pilih Laboratorium--</option>";
				foreach($lab as $l){
					$pilih='';
					if($inputlab==$l->id_ruangan){
						$pilih='selected';
					}
					echo "<option $pilih value='$l->id_ruangan'>$l->ruangan</option>";
				}
			}
			else{
				echo "<option value='$ruangan->id_ruangan'>$ruangan->ruangan</option>";
			}
		?>
		</select>
	<table class="table table-bordered table-striped">
		<thead>
			<tr class="alert alert-info">
				<th rowspan="2">NO</th>
				<th rowspan="2">TYPE</th>
				<th rowspan="2">MEREK</th>
				<th colspan="5">KONDISI</th>
			</tr>
			<tr class="alert-info">
				<th>BAGUS</th>
				<th>RUSAK</th>
				<th>HILANG</th>
				<th>Total Barang</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$no=0;
			foreach($laporan as $l){
				$no++;
				echo
				"<tr>
					<td class='text-center'>$no</td>
					<td>$l->barang</td>
					<td>$l->merek</td>";
				echo "<td class='text-center'>$l->bagus_qtty</td>
					<td class='text-center'>$l->rusak_qtty</td>
					<td class='text-center'>$l->hilang_qtty</td>";
				
				if($this->input->post('lab')==''){
					echo "<td class='text-center'>$l->baru_ori</td>";
				}
				else{
					echo "<td class='text-center'>".($l->bagus_qtty+$l->rusak_qtty+$l->hilang_qtty)."</td>";
				}
				echo "
				</tr>
				";
			}
			if($no==0){
				echo "<tr><td colspan='7' class='text-center alert alert-warning'><b>Belum ada laporan</b></td></tr>";
			}
		?>
		</tbody>
	</table>
	<h3 class="page-header">Laporan PC Laboratorium</h3>
	<table class="table table-bordered">
		<thead>
			<tr class="alert alert-info">
				<th rowspan="2">NO</th>
				<th rowspan="2">PC</th>
				<th rowspan="2">KOMPONEN</th>
				<th rowspan="2">MEREK</th>
				<th colspan="5">KONDISI</th>
			</tr>
			<tr class="alert-info">
				<th>BAGUS</th>
				<th>RUSAK</th>
				<th>HILANG</th>
				<th>KETERANGAN</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$no=0;
			$nr=0;
			$cekr='';
			foreach($pc as $p){
				$baru ='-';
				$rusak='-';
				$hilang='-';
				if($p->knds_brng==7){
					$baru='V';
				}
				else if($p->knds_brng==8){
					$rusak='V';
				}
				else if($p->knds_brng==9){
					$hilang='V';
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
					echo '
					<tr class="text-center">
						<td rowspan="'.($p->rows*2).'">'.$no.'</td>
						<td rowspan="'.($p->rows*2).'">'.$p->pc.'</td>
					</tr>';
				}
				else{
					echo '<tr></tr>';
				}
		?>
			
			<tr>
				<td><?php echo $p->barang ?></td>
				<td><?php echo $p->merek ?></td>
				<td class="text-center status kondisi<?php echo $p->pc_id ?>7" id="<?php echo $p->pc_id ?>" kondisi="7"><?php echo $baru ?></td>
				<td class="text-center status kondisi<?php echo $p->pc_id ?>8" id="<?php echo $p->pc_id ?>" kondisi="8"><?php echo $rusak ?></td>
				<td class="text-center status kondisi<?php echo $p->pc_id ?>9" id="<?php echo $p->pc_id ?>" kondisi="9"><?php echo $hilang ?></td>
				<td class="status2" id="<?php echo $p->pc_id ?>">
					<span class="muncul span-ket<?php echo $p->pc_id ?>"><?php echo $p->pc_keterangan ?></span>
					<input type="text" class="hilang input-ket<?php echo $p->pc_id ?>" value="<?php echo $p->pc_keterangan ?>">
				</td>
			</tr>
		<?php
			}
			if($no==0){
				echo "<tr><td colspan='8' class='text-center alert alert-warning'><b>Belum ada laporan</b></td></tr>";
			}
		?>
		</tbody>
	</table>
	<?php 
		$btn="";
		$link = 'admin_inventori/laporan_excel/'.$uri3.'/'.$uri4;
		if($uri3==""){
			$btn="disabled";
			$link = '';
		}
		echo anchor($link,'Simpan',"$btn class='btn btn-success bawah-mini'");
	?>
</div>