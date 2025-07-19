<div class="col-sm-12"><h2 class="page-header">Tambah Barang</h2></div>
<div class="col-sm-12">
	<?php echo form_open('admin_inventori/barang_post','class="form-horizontal"') ?>
	  <div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Jenis Barang</label>
		<div class="col-sm-10">
			<select class="form-control" name="jenis" required>
			<?php
				echo "<option value=''>--Pilih--</option>";
				foreach($jenis as $ji){
					echo "<option value='$ji->code_id'>$ji->code_desc</option>";
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
					echo "<option value='$m->code_id'>$m->code_desc</option>";
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