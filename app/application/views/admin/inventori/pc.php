<script>
	$(function(){
		$('.pilih-lab').change(function(){
			var lab = $('.pilih-lab').val();
			window.location.href=base_url+'index.php/admin_inventori/pc/'+lab;	
		});
	});
</script>
<div class="col-sm-12">
	<h2 class="page-header">Inventori PC Laboratorium</h2>
	<?php echo anchor('admin_inventori/pc_tambah','Tambah Komponen & PC','class="kiri btn btn-primary kanan-mini "') ?>
	<select name="lab" class="form-control input-small bawah-mini kanan-mini pilih-lab">
	<?php
		$uri3 = $this->uri->segment(3);
		$jabatan = $_SESSION['jabatan'];
		if($jabatan=='adminsistem' || $jabatan=='teknisilab'){
			echo "<option value=''>Semua Barang Laboratorium</option>";
			foreach($lab as $l){
				$pilih='';
				if($uri3==$l->id_ruangan){
					$pilih='selected';
				}
				echo "<option $pilih value='$l->id_ruangan'>$l->ruangan</option>";
			}
		}
		else{
			$ruangan = $this->models->where1Row('ruangan','id_jabatan',$jabatan);
			echo "<option value='$ruangan->id_ruangan'>$ruangan->ruangan</option>";
		}
	?>
	</select>
	<table class="table table-bordered">
		<thead>
			<tr class="alert alert-info">
				<th rowspan="2">NO</th>
				<th rowspan="2">Laboratorium</th>
				<th rowspan="2">PC</th>
				<th colspan="5">Aksi</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$no=0;
			foreach($pc as $p){
				$no++;
		?>
			<tr>
				<td><?php echo $no ?></td>
				<td><?php echo $p->ruangan ?></td>
				<td><?php echo $p->code_desc ?></td>
				<td class="text-center">
					<?php //echo anchor('admin_inventori/alokasi_edit/','<i class="glyphicon space glyphicon-edit"></i>').'&nbsp;' ?>     	
					<a href='#' title='hapus' class='hapus space'>
						<i class='glyphicon glyphicon-remove'></i> 
						<input type='hidden' value='<?php echo base_url('index.php/admin_inventori/pc_hapuspc/'.$p->id_ruangan.'/'.$p->code_pclb) ?>'>
					</a>
				</td>
			</tr>
		<?php
			}
		?>
		</tbody>
	</table>
</div>