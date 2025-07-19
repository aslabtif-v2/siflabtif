<script>
	$(function(){
		$( window ).load(function() {
		  var cekOff = document.getElementById("Off").checked;
		  var cekH = document.getElementById("Harian").checked;
		  
		  if(cekOff==true){
			$('.div-hari').hide();
			$('.div-jam').hide();
			return false;
		  }
		  
		  if(cekH==true){
			$('.div-hari').hide();
			return false;
		  }
		  
		});
		
		$('.svrtipe').click(function(){
			var tipe = $(this).attr('id');
			
			if(tipe=='Off'){
				$('.div-hari').hide();
				$('.div-jam').hide();
			}
			else if(tipe=='Mingguan'){
				$('.div-hari').show();
				$('.div-jam').show();
			}
			else if(tipe=='Harian'){
				$('.div-hari').hide();
				$('.div-jam').show();
			}
		});
	});
</script>
<?php
	$uri3 = $this->uri->segment(3);
	$chekO = '';
	$chekM = '';
	$chekH = '';
	if($s->tmr_tipe=='Mingguan'){
		$chekM='checked';
	}
	else if($s->tmr_tipe=='Harian'){
		$chekH='checked';
	}
	else if($s->tmr_tipe=='Off'){
		$chekO='checked';
	}
?>
<div class="col-sm-12">
	<h3 class="page-header">Schedule Shutdown Server</h3>
</div>
<div class="col-sm-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<?php echo form_open('admin_shutdown/post','class="form-horizontal"') ?>
			  <div class="form-group">
				<label class="col-sm-3 control-label">Shutdown Server</label>
				<div class="col-sm-9">
					<label>
						<input type="radio" class="svrtipe" name="tipe" value="Off" id="Off" <?php echo $chekO ?>> Off
					</label>
					<label class="kiri-mini">
						<input type="radio" name="tipe" class="svrtipe" value="Mingguan" id="Mingguan" <?php echo $chekM ?>> Perminggu
					</label>
					<label class="kiri-mini">
						<input type="radio" name="tipe" class="svrtipe" value="Harian" id="Harian" <?php echo $chekH ?>> Perhari
					</label>
				</div>
			  </div>
			  <div class="form-group div-hari">
				<label for="inputPassword3" class="col-sm-3 control-label">Hari</label>
				<div class="col-sm-9">
					<select class="form-control" name="hari">
					<?php
						foreach($hari as $hr => $h){
							$pilih='';
							if($h==$s->tmr_hari){
								$pilih='selected';
							}
							echo "<option $pilih>$h</option>";
						}
					?>
					</select>
				</div>
			  </div>
			  <div class="form-group div-jam">
				<label for="inputPassword3" class="col-sm-3 control-label">Jam</label>
				<div class="col-sm-9">
				  <input type="time" class="form-control" value="<?php echo $s->tmr_jam ?>" name="jam" required>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
				  <button type="submit" class="btn btn-warning">Simpan</button>
				</div>
			  </div>
			</form>
		</div>
	</div>
	<?php
		if($uri3=='ok'){
	?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			Schedule berhasil diubah
		</div>
	<?php } ?>
</div>