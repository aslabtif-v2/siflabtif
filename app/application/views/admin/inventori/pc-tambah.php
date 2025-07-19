<script>
$(function(){
	$('.btn-komponen').click(function(){
		//var komponen = $('.komponen').html();
		var i = $('.input-jumlah').val();
		i++;
		$('.komponen-list').append(komponen(i));
		$('.input-jumlah').val(i);
	});
	
	function komponen(i){
		var komponens = '<div class="form-group"><label class="col-sm-3 control-label">Komponen '+i+'</label><div class="col-sm-9"><select class="form-control" name="komponen'+i+'" required><?php echo "<option value=".">--Pilih--</option>"; foreach($barang as $b){ echo "<option value=$b->brg_id>$b->barang - $b->merek </option>"; } ?></select></div></div>';
		return komponens;
	}
});
</script>
<div class="col-sm-12"><h2 class="page-header">Tambah Komponen & PC</h2></div>
<div class="col-sm-12">
	<?php 
		echo form_open('admin_inventori/pc_post','class="form-horizontal"');
	?>
	  <div class="form-group select-lab">
		<label class="col-sm-3 control-label">Laboratorium</label>
		<div class="col-sm-9">
			<select class="form-control" name="lab" required>
			<?php
				//echo "<option value=''>--Pilih--</option>";
				//foreach($lab as $l){
				//	echo "<option value='$l->id_ruangan'>$l->ruangan</option>";
				//}
				$jabatan = $_SESSION['jabatan'];
				$ruangan = $this->models->where1Row('ruangan','id_jabatan',$jabatan);
				if($jabatan=='adminsistem' || $jabatan=='teknisilab'){
					echo "<option value=''>--Pilih--</option>";
					foreach($lab as $l){
							$pilih='';
							if($l->id_ruangan==$id_ruangan){
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
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-sm-3 control-label">PC</label>
		<div class="col-sm-9">
			<select class="form-control" name="pc" required>
			<?php
				echo "<option value=''>--Pilih--</option>";
				foreach($pc as $pcs){
					echo "<option value='$pcs->code_id'>$pcs->code_desc</option>";
				}
			?>
			</select>
		</div>
	  </div>
	  <div class="komponen">
		  <div class="form-group">
			<label class="col-sm-3 control-label">Komponen 1</label>
			<div class="col-sm-9">
				<select class="form-control" name="komponen1" required>
				<?php
					echo "<option value=''>--Pilih--</option>";
					foreach($barang as $b){
						echo "<option value='$b->brg_id'>$b->barang - $b->merek </option>";
					}
				?>
				</select>
			</div>
		  </div>
	  </div>
	  <div class="komponen-list"></div>
	  <div class="form-group">
		<div class="col-sm-offset-3 col-sm-9">
		  <input type="hidden" name="jumlah" class="input-jumlah" value="1">
		  <button type="button" class="btn btn-primary btn-komponen" title="Tambah Komponen">+</button>
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-sm-offset-3 col-sm-9">
		  <button type="submit" class="btn btn-success kanan-mini">Simpan</button>
		  <?php echo anchor('admin_inventori/pc','Kembali','class="btn btn-default"') ?>
		</div>
	  </div>
	</form>
</div>