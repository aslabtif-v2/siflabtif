<style>
	.kiri1{width:120px;float:left;margin-top:5px;}
	.kiri2{width:250px;float:left;}
</style>
<script>
	$(function(){
		$('.pilih-jenis').change(function(){
			var jenis = $('.pilih-jenis').val();
			if(jenis!=''){
				window.location.href='<?php echo base_url() ?>index.php/admin_kategori/view/'+jenis;				
			}
			else{
				window.location.href='<?php echo base_url() ?>index.php/admin_kategori/view/';
			}
		});
	});
</script>
<?php
	$uri3 = $this->uri->segment(3);
?>
<div class="col-md-12"><h2 class="page-header">Kategori</h2></div>
<div class="col-md-12">
	<?php echo anchor('admin_kategori/tambah/'.$uri3,'Tambah Kategori','class="btn btn-primary bawah-mini"') ?>
	<div class="atas alert alert-info">
        <span class="kiri1 font-bold">Jenis Kategori :</span>
		<select class="form-control kiri2 pilih-jenis">
		<?php
			echo "<option value=''>--Pilih--</option>";
			foreach($jenis as $jv){
				$pilih='';
				if($jv->codd_code==$uri3){
					$pilih='selected';
				}
				echo "<option $pilih value='$jv->codd_code'>$jv->codd_desc</option>";
			}
		?>
		</select>
    </div>
	<table class="table table-bordered table-hover table-striped">	
		<thead>
			<tr class="alert-info">
				<th>No</th>
				<th>Jenis</th>
				<th>Kategori</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
		<?php
			if(isset($kategori)){
				$no=0;
				foreach($kategori as $k){
					$no++;
					$kat = "";
					foreach($jenis as $jv){
						if($k->code_kate==$jv->codd_code){
							$kat = $jv->codd_desc;
						}
					}
		?>
				<tr>
					<td class="text-center"><?php echo $no ?></td>
					<td><?php echo $kat ?></td>
					<td><?php echo $k->code_desc ?></td>
					<td  class="text-center">
						<?php echo anchor('admin_kategori/edit/'.$k->code_id,'<i class="glyphicon space glyphicon-edit"></i>') ?> &nbsp;       	
						<a href="#" title="hapus" class="hapus space">
							<i class="glyphicon glyphicon-remove"></i> 
							<input type="hidden" value="<?php echo base_url('index.php/admin_kategori/hapus/'.$k->code_id) ?>">
						</a>
					</td>
				</tr>
		<?php
				}
			} 
		?>
		</tbody>
	</table>
</div>