<label class="col-sm-3 control-label">Laboratorium</label>
<div class="col-sm-9">
	<select class="form-control" name="lab" required>
		<?php
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