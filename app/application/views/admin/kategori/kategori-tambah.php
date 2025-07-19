<div class="col-sm-12"><h2 class="page-header">Tambah Kategori</h2></div>
<div class="col-sm-12">
	<?php echo form_open('admin_kategori/post','class="form-horizontal"') ?>
	  <div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Jenis Kategori</label>
		<div class="col-sm-10">
			<select class="form-control" name="jenis" required>
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
	  </div>
	  <div class="form-group">
		<label for="inputPassword3" class="col-sm-2 control-label">Kategori</label>
		<div class="col-sm-10">
		  <input type="text" class="form-control" name="kategori" placeholder="Kategori" required>
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <button type="submit" class="btn btn-success kanan-mini">Simpan</button>
		  <?php echo anchor('admin_kategori/view','Kembali','class="btn btn-default"') ?>
		</div>
	  </div>
	</form>
</div>