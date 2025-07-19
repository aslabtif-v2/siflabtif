<script>
	$(function(){
		$('.pilih-lab').change(function(){
			var lab = $('.pilih-lab').val();
			window.location.href=base_url+'index.php/admin_inventori/laporan/'+lab;	
		});
	});
</script>
<div class="col-sm-12">
	<h2 class="page-header">Laporan Inventori Laboratorium Informatika UNSUR</h2>
	<?php 
		$jabatan = $_SESSION['jabatan'];
		if($jabatan!='koordinatorlab' && $jabatan!='teknisilab'){
			echo anchor('admin_inventori/laporan_buat','Buat Laporan','class="kiri btn btn-primary kanan-mini "');	
		}
	?>
	<select name="lab" class="form-control input-small bawah-mini kanan-mini pilih-lab">
	<?php
		$uri3 = $this->uri->segment(3);
		$ruangan = $this->models->where1Row('ruangan','id_jabatan',$jabatan);
		if($jabatan=='adminsistem' || $jabatan=='teknisilab' || $jabatan=='koordinatorlab'){
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
			echo "<option value='$ruangan->id_ruangan'>$ruangan->ruangan</option>";
		}

	?>
	</select>
	<table class="table table-bordered">
		<thead>
			<tr class="alert alert-info">
				<th rowspan="2">NO</th>
				<th rowspan="2">Laporan Inventori</th>
				<th rowspan="2">Laboratorium</th>
				<th rowspan="2">Periode</th>
				<th rowspan="2">Pembuat</th>
				<?php if($jabatan!='koordinatorlab' && $jabatan!='teknisilab'){ echo '<th colspan="5">Aksi</th>'; } ?>
			</tr>
		</thead>
		<tbody>
		<?php
			$no=0;
			foreach($laporan as $p){
				$no++;
				$tgl = explode('-',$p->rpt_date);
		?>
			<tr>
				<td><?php echo $no ?></td>
				<td><?php echo anchor(base_url('file/inventori/'.$p->rpt_nama),'Inventori '.$bulan[$tgl[1]-0].' '.$tgl[0]) ?></td>
				<td><?php echo $p->ruangan ?></td>
				<td><?php echo $tgl[2].' '.$bulan[$tgl[1]-0].' '.$tgl[0] ?></td>
				<td><?php echo $p->asisten ?></td>
				<?php 
					if($jabatan!='koordinatorlab' && $jabatan!='teknisilab'){ 
					echo "
					<td class='text-center'>
						<a href='#' title='hapus' class='hapus space'>
							<i class='glyphicon glyphicon-remove'></i> 
							<input type='hidden' value='".base_url('index.php/admin_inventori/laporan_hapus/'.$p->rpt_id)."'>
						</a>
					</td>
						";
					}
				?>
			</tr>
		<?php
			}
			if($no==0){
				echo "<tr><td colspan='6' class='text-center alert alert-warning'><b>Belum ada laporan</b></td></tr>";
			}
		?>
		</tbody>
	</table>
</div>