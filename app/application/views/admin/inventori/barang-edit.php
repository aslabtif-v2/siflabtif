<div class="col-sm-12"><h2 class="page-header">Edit Barang</h2></div>
<div class="col-sm-12">
	<?php echo form_open('admin_inventori/barang_update/'.$b->brg_id,'class="form-horizontal"') ?>
	  <div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Jenis Barang</label>
		<div class="col-sm-10">
			<select class="form-control" name="jenis" required>
			<?php
				echo "<option value=''>--Pilih--</option>";
				foreach($jenis as $ji){
					$pilih="";
					if($ji->code_id==$b->jnis_brng){
						$pilih="selected";
					}
					echo "<option $pilih value='$ji->code_id'>$ji->code_desc</option>";
				}
			?>
			</select>
		</div>
	  </div>
	  <div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Merek Barang</label>
		<div class="col-sm-10">
			<select class="form-control" name="merek" required>
			<?php
				echo "<option value=''>--Pilih--</option>";
				foreach($merek as $m){
					$pilih="";
					if($m->code_id==$b->code_merk){
						$pilih="selected";
					}
					echo "<option $pilih value='$m->code_id'>$m->code_desc</option>";
				}
			?>
			</select>
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <button type="submit" class="btn btn-success kanan-mini">Simpan</button>
		  <?php echo anchor('admin_inventori/barang','Kembali','class="btn btn-default"') ?>
		</div>
	  </div>
	</form>
</div>