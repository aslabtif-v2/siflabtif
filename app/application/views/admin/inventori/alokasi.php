<script>
	/*$(function(){
		$('.pilih-lab').change(function(){
			var lab = $('.pilih-lab').val();
			$.ajax({
				type:'get',
				url:base_url+'index.php/admin_inventori/tes',
				data:"lab="+lab,
				success : function(data){
				
				}
			});
		});
	$(function(){
		$('.pilih-lab').change(function(){
			var lab = $('.pilih-lab').val();
			var date = $('.input-date').val();
			if(lab==''){
				lab=0
			}
			window.location.href=base_url+'index.php/admin_inventori/alokasi/'+date+'/'+lab;				
		});
		
		$('.input-date').change(function(){
			var lab = $('.pilih-lab').val();
			var date = $('.input-date').val();
			
			if(lab==''){
				alert('Pilih Laboratorium');
				return false;
			}
			window.location.href=base_url+'index.php/admin_inventori/alokasi/'+date+'/'+lab;	
		});
	});*/
</script>
<div class="col-sm-12">
	<h2 class="page-header">Inventori Barang Laboratorium</h2>
	<?php echo anchor('admin_inventori/alokasi_barang','Alokasi Barang','class="btn btn-primary kanan-mini bawah-mini"') ?>
	<?php //echo anchor('admin_inventori/pc','Alokasi PC Lab','class="btn btn-primary kanan-mini bawah-mini"') ?>
	<?php echo anchor('admin_inventori/alokasi_histori','Histori Alokasi','class="btn btn-primary bawah-mini"') ?>
	<?php echo form_open('admin_inventori/alokasi') ?>
		<span class="kiri kanan-mini atas-super-mini">Tanggal : </span>
		<input type="date" value="<?php echo $date ?>" class="input-small input-date form-control kanan-mini" name="date">
		<select name="lab" class="form-control input-small bawah-mini kanan-mini pilih-lab">
		<?php
			$jabatan = $_SESSION['jabatan'];
			$ruangan = $this->models->where1Row('ruangan','id_jabatan',$jabatan);
			//if($jabatan=='adminsistem' || $jabatan=='teknisilab'){
				echo "<option value=''>Semua Barang Laboratorium</option>";
				foreach($lab as $l){
					$pilih='';
					if($inputlab==$l->id_ruangan){
						$pilih='selected';
					}
					echo "<option $pilih value='$l->id_ruangan'>$l->ruangan</option>";
				}
			/*}
			else{
				echo "<option value='$ruangan->id_ruangan'>$ruangan->ruangan</option>";
			}*/
		?>
		</select>
		<input type="submit" name="cetak" value="Cek" class="kanan-mini btn btn-default">
		<input type="submit" name="cetak" value="Excel" class="btn btn-success">
	</form>
	<table class="table table-bordered table-striped">
		<thead>
			<tr class="alert alert-info">
				<th rowspan="2">NO</th>
				<th rowspan="2">TYPE</th>
				<th rowspan="2">MEREK</th>
				<th colspan="5">KONDISI</th>
			</tr>
			<tr class="alert-info">
			<?php
			if($this->input->post('lab')==''){
					echo "<th>BARU</th>";
				}	
			?>
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
				
				if($this->input->post('lab')==''){
					echo "<td class='text-center'>$l->baru_qtty</td>";
				}	
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
		?>
		</tbody>
	</table>
</div>