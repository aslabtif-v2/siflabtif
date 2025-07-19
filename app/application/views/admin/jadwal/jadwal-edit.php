<style>
	.dalam{width:400px; margin:auto;}
	.input-small{float:right;}
</style>
<div class="col-lg-12">
	<h1 class="page-header">Edit Penjadwalan Praktikum</h1>
</div>
<div class="col-lg-12">
	<div class="panel panel-default" style="border-radius:0px 0px 0px 0px;">
        <div class="panel-body">
			<div class="dalam">
				<?php 
					echo form_open('admin_jadwal/update_jadwal','class="form-horizontal"');
					foreach($praktikum as $rz){
					echo form_hidden('id',$rz->id_praktikum);
          echo form_hidden('pr_id',$rz->pr_id);
				?>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">ID_Praktikum</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control input-small" value="<?php echo $rz->id_praktikum ?>" required name="id_praktikum" placeholder="ID Praktikum">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Pengajar1</label>
                      <div class="col-sm-10">
                        <select name="pengajar1" class="form-control input-small" required>
                        	<?php
								echo "<option value='' $pilih>--Pilih Asisten 1--</option>";
								$asis1 = $this->models->where1Row('asisten','id_asisten',$rz->pengajar1);
								foreach($asisten as $asisten1){
									if($asisten1->id_asisten==$asis1->id_asisten){
										$pilih = 'selected';	
									}
									else{
										$pilih = '';	
									}
									echo "<option value='$asisten1->id_asisten' $pilih>$asisten1->nama</option>";	
								} 
							 ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Pengajar2</label>
                      <div class="col-sm-10">
                        <select name="pengajar2" class="form-control input-small" required>
                        	<?php 
								echo "<option value='' $pilih>--Pilih Asisten 2--</option>";
								$asis2 = $this->models->where1Row('asisten','id_asisten',$rz->pengajar2);
								$pilih='';
								foreach($asisten as $asisten1){
									if($asisten1->id_asisten==$asis2->id_asisten){
										$pilih = 'selected';	
									}
									else{
										$pilih = '';	
									}
									echo "<option value='$asisten1->id_asisten' $pilih>$asisten1->nama</option>";	
								} 
							 ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Kelas</label>
                      <div class="col-sm-10">
                        <select name="kelas" class="form-control input-small" required>
                            <?php 
								$pilih ='';
								echo "<option value=''>--Pilih Kelas--</option>";
								foreach($kelas as $kelass){
									if($kelass->id_kelas==$rz->id_kelas){
										$pilih ='selected';
									}
									else{
										$pilih ='';	
									}
									echo "<option value='$kelass->id_kelas' $pilih>$kelass->kelas</option>";	
								} 
							 ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Mata_Praktikum</label>
                      <div class="col-sm-10">
                        <select name="matkum" class="form-control input-small" required>
                            <?php 
								$pilih ='';
								echo "<option value=''>--Pilih Mata Praktikum--</option>";
								foreach($matkum as $matkums){
									if($matkums->id_matkum==$rz->id_matkum){
										$pilih ='selected';
									}
									else{
										$pilih ='';	
									}
									echo "<option value='$matkums->id_matkum' $pilih>$matkums->mata_praktikum</option>";	
								} 
							 ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Hari</label>
                      <div class="col-sm-10">
                        <select name="hari" class="form-control input-small" required>
                        	<?php echo "<option value='$rz->hari'>$rz->hari</option>"; ?>
                        	<option value="Senin">Senin</option>
                        	<option value="Selasa">Selasa</option>
                        	<option value="Rabu">Rabu</option>
                        	<option value="Kamis">Kamis</option>
                        	<option value="Jumat">Jumat</option>
                        	<option value="Sabtu">Sabtu</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Jam</label>
                      <div class="col-sm-10">
                        <select name="jam" class="form-control input-small" required>
                        	<?php echo "<option>$rz->jam</option>"; ?>
                            <option>08.00 - 09.40</option>
                            <option>08.50 - 10.30</option>
                            <option>09.40 - 11.20</option>
                            <option>10.30 - 12.10</option>
                            <option>11.20 - 13.00</option>
                            <option>12.10 - 13.50</option>
                            <option>13.00 - 14.40</option>
                            <option>13.50 - 15.30</option>
                            <option>14.40 - 16.20</option>
                            <option>15.30 - 17.10</option>
                            <option>16.20 - 18.00</option>
                            <option>17.10 - 18.50</option>
                            <option>18.00 - 19.40</option>
                            <option>18.50 - 20.30</option>
                            <option>19.40 - 21.20</option>
                            <option>20.30 - 22.10</option>
                            <option>21.20 - 23.00</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Ruangan</label>
                      <div class="col-sm-10">
                        <select name="ruangan" class="form-control input-small" required>
                            <?php 
								$pilih ='';
								echo "<option value=''>--Pilih Ruangan--</option>";
								foreach($ruangan as $ruangans){
									if($ruangans->id_ruangan==$rz->id_ruangan){
										$pilih ='selected';
									}
									else{
										$pilih ='';	
									}
									echo "<option value='$ruangans->id_ruangan' $pilih>$ruangans->ruangan</option>";	
								} 
							 ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Kehadiran</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control input-small" value="<?php echo $rz->kehadiran ?>" required name="kehadiran" placeholder="Persentase Nilai Kehadiran">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Tugas</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control input-small" value="<?php echo $rz->tugas ?>" required name="tugas" placeholder="Persentase Nilai Tugas">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Ujian</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control input-small" value="<?php echo $rz->ujian ?>" required name="ujian" placeholder="Persentase Nilai Ujian">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-warning simpan">Ganti</button>
					         <?php  }echo anchor('admin_jadwal/periode/'.$rz->pr_id,'Batal','class="btn btn-default kembali"') ?>
            	</form>
			</div>
		</div>
    </div>
</div>            