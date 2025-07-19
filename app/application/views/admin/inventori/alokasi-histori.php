<div class="col-sm-12">
	<h2 class="page-header">Alokasi Barang Laboratorium</h2>
</div>
<div class="col-sm-12">
	<?php echo anchor('admin_inventori/alokasi','Kembali','class="btn btn-default"') ?>
	<table class="table table-bordered table-striped atas-mini">
		<thead>
			<tr class="alert alert-info">
				<th rowspan="2" valign="middle">NO</th>
				<th rowspan="2" valign="middle">TYPE</th>
				<th rowspan="2" valign="middle">MEREK</th>
				<th colspan="4">KONDISI</th>
				<th rowspan="2">Laboratorium</th>
				<th rowspan="2">Keterangan</th>
				<th rowspan="2">Tanggal</th>
				<th rowspan="2" width="60">Aksi</th>
			</tr>
			<tr class="alert-info">
				<th>BARU</th>
				<th>BAGUS</th>
				<th>RUSAK</th>
				<th>HILANG</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$no=0;
			foreach($barang as $b){
				$no++;
				echo
				"<tr>
					<td>$no</td>
					<td>$b->barang</td>
					<td>$b->merek</td>";
				if($b->kondisi=='Baru'){
					echo "<td class='text-center'>$b->allo_qtty</td>";
				}
				else{
					echo "<td></td>";
				}
				
				if($b->kondisi=='Bagus'){
					echo "<td class='text-center'>$b->allo_qtty</td>";
				}
				else{
					echo "<td></td>";
				}
				
				if($b->kondisi=='Rusak'){
					echo "<td class='text-center'>$b->allo_qtty</td>";
				}
				else{
					echo "<td></td>";
				}
				
				if($b->kondisi=='Hilang'){
					echo "<td class='text-center'>$b->allo_qtty</td>";
				}
				else{
					echo "<td></td>";
				}
				echo "
					<td>$b->ruangan</td>
					<td>$b->asisten</td>
					<td>$b->allo_tanggal</td>
					<td class='text-center'>
						".anchor('admin_inventori/alokasi_edit/'.$b->allo_id,'<i class="glyphicon space glyphicon-edit"></i>')." &nbsp;       	
						<a href='#' title='hapus' class='hapus space'>
							<i class='glyphicon glyphicon-remove'></i> 
							<input type='hidden' value='".base_url('index.php/admin_inventori/alokasi_hapus/'.$b->allo_id)."'>
						</a>
					</td>
				</tr>";
			} 
		?>
		</tbody>
	</table>
</div>