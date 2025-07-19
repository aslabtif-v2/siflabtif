<div class="col-sm-12"><h2 class="page-header">Edit Kategori</h2></div>
<div class="col-sm-12">
	<?php echo form_open('admin_kategori/update/'.$code->code_id,'class="form-horizontal"') ?>
	  <div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Jenis Kategori</label>
		<div class="col-sm-10">
			<select class="form-control" name="jenis" required>
			<?php
				
				echo "<option value=''>--Pilih--</option>";
				foreach($jenis as $jv){
					$pilih='';
					if($jv->codd_code==$code->code_kate){
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
		  <input type="text" class="form-control" name="kategori" value="<?php echo $code->code_desc ?>" placeholder="Kategori" required>
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <button type="submit" class="btn btn-warning kanan-mini">Simpan</button>
		  <?php echo anchor('admin_kategori/view/'.$code->code_kate,'Kembali','class="btn btn-default"') ?>
		</div>
	  </div>
	</form>
</div>