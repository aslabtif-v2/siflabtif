<div class="col-sm-12">
	<h2 class="page-header">Barang Laboratorium Informatika UNSUR <?php echo date('Y') ?></h2>
</div>
<div class="col-sm-12">
	<?php echo anchor('admin_inventori/barang_tambah','Tambah Barang','class="btn btn-primary"') ?>
	<table class="table table-bordered table-striped atas-mini">
		<thead>
			<tr class="alert alert-info">
				<th>NO</th>
				<th>Barang</th>
				<th>MERK</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$no=0;
			foreach($barang as $b){
				$no++;

				$cek1 = $this->models->cekdata('inv_alokasi','brg_id',$b->brg_id);
				$cek2 = $this->models->cekdata('inv_pc','brg_id',$b->brg_id);

				$title = 'hapus';
				if ($cek1!=0 || $cek2!=0) {
					$title ='Tidak bisa hapus';
				}
		?>
			<tr>
				<td class="text-center"><?php echo $no ?></td>
				<td><?php echo $b->barang ?></td>
				<td><?php echo $b->merek ?></td>
				<td class="text-center">
					<?php echo anchor('admin_inventori/barang_edit/'.$b->brg_id,'<i class="glyphicon space glyphicon-edit"></i>') ?> &nbsp;       	
					<a href="#" title="<?php echo $title ?>" class="hapus space">
						<i class="glyphicon glyphicon-remove"></i> 
						<input type="hidden" value="<?php echo base_url('index.php/admin_inventori/barang_hapus/'.$b->brg_id) ?>">
					</a>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>