<?php
	$jabatan = $_SESSION['jabatan'];
	if($jabatan=='adminsistem' || $jabatan=='teknisilab'){
?>
<script>
$(function(){
	$('.pilih-kondisi').change(function(){
		var kondisi = $('.pilih-kondisi').val();
		//alert(kondisi);
		if(kondisi==6){
			$('.select-lab').html("");
		}
		else{
			$('.select-lab').load(base_url+'index.php/admin_inventori/get_lab');
		}
	});
});
</script>
<?php } ?>
<div class="col-sm-12"><h2 class="page-header">Alokasi Barang</h2></div>
<div class="col-sm-12">
	<?php echo form_open('admin_inventori/alokasi_post','class="form-horizontal"') ?>
	  <div class="form-group">
		<label class="col-sm-3 control-label">Barang</label>
		<div class="col-sm-9">
			<select class="form-control" name="barang" required>
			<?php
				echo "<option value=''>--Pilih--</option>";
				foreach($barang as $b){
					echo "<option value='$b->brg_id'>$b->barang - $b->merek </option>";
				}
			?>
			</select>
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-sm-3 control-label">Kondisi Barang</label>
		<div class="col-sm-9">
			<select class="form-control pilih-kondisi" name="kondisi" required>
			<?php
				echo "<option value=''>--Pilih--</option>";
				foreach($kondisi as $k){
					if(($jabatan!='adminsistem') && ($jabatan!='teknisilab')){
						if($k->code_desc!='Baru'){
							echo "<option value='$k->code_id'>$k->code_desc</option>";
						}
					}
					else{
						echo "<option value='$k->code_id'>$k->code_desc</option>";
					}
				}
			?>
			</select>
		</div>
	  </div>
	  <div class="form-group select-lab">
		<label class="col-sm-3 control-label">Laboratorium</label>
		<div class="col-sm-9">
			<select class="form-control" name="lab" required>
			<?php
				$ruangan = $this->models->where1Row('ruangan','id_jabatan',$jabatan);
				if($jabatan=='adminsistem' || $jabatan=='teknisilab'){
					echo "<option value=''>--Pilih--</option>";
					foreach($lab as $l){
						echo "<option value='$l->id_ruangan'>$l->ruangan</option>";
					}
				}
				else{
					echo "<option value='$ruangan->id_ruangan'>$ruangan->ruangan</option>";
				}
			?>
			</select>
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-sm-3 control-label">Jumlah</label>
		<div class="col-sm-9">
			<input class="form-control" name="qtty" required type="number">
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-sm-offset-3 col-sm-9">
		  <button type="submit" class="btn btn-success kanan-mini">Simpan</button>
		  <?php echo anchor('admin_inventori/alokasi','Kembali','class="btn btn-default"') ?>
		</div>
	  </div>
	</form>
</div>