<?php
	$id_ruangan='';
	if($a->id_ruangan!=0){
		$id_ruangan = "+$a->id_ruangan";
	}
?>
<script>
$(function(){
<?php
	if($a->id_ruangan!=0){
?>
	$(window).load(function(){
		$('.select-lab').load(base_url+'index.php/admin_inventori/get_lab/'<?php echo $id_ruangan ?>);
	});
<?php
	}
?>	
	$('.pilih-kondisi').change(function(){
		var kondisi = $('.pilih-kondisi').val();
		if(kondisi==6){
			$('.select-lab').html("");
		}
		else{
			$('.select-lab').load(base_url+'index.php/admin_inventori/get_lab/'<?php echo $id_ruangan ?>);
		}
	});
});
</script>
<div class="col-sm-12"><h2 class="page-header">Alokasi Barang</h2></div>
<div class="col-sm-12">
	<?php echo form_open('admin_inventori/alokasi_update/'.$a->allo_id,'class="form-horizontal"') ?>
	  <div class="form-group">
		<label class="col-sm-3 control-label">Barang</label>
		<div class="col-sm-9">
			<select class="form-control" name="barang" required>
			<?php
				echo "<option value=''>--Pilih--</option>";
				foreach($barang as $b){
					$pilih='';
					if($b->brg_id==$a->brg_id){
						$pilih='selected';
					}
					echo "<option $pilih value='$b->brg_id'>$b->barang - $b->merek </option>";
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
					if(($jabatan=='adminsistem') && ($jabatan=='teknisilab')){
						if($k->code_desc!='Baru'){
							echo "<option value='$k->code_id'>$k->code_desc</option>";
						}
					}
					else{
						$pilih='';
						if($k->code_id==$a->knds_brng){
							$pilih='selected';
						}
						echo "<option $pilih value='$k->code_id'>$k->code_desc</option>";
					}
				}
			?>
			</select>
		</div>
	  </div>
	  <div class="form-group select-lab">
		<!--label class="col-sm-3 control-label">Laboratorium</label>
		<div class="col-sm-9">
			<select class="form-control" name="lab" required>
			<?php
				echo "<option value=''>--Pilih--</option>";
				foreach($lab as $l){
					$pilih='';
					if($l->id_ruangan==$a->id_ruangan){
						$pilih='selected';
					}
					echo "<option  $pilih  value='$l->id_ruangan'>$l->ruangan</option>";
				}
			?>
			</select>
		</div-->
	  </div>
	  <div class="form-group">
		<label class="col-sm-3 control-label">Jumlah</label>
		<div class="col-sm-9">
			<input class="form-control" value="<?php echo $a->allo_qtty ?>" name="qtty" required type="number">
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