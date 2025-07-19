<script>
$(document).ready(function(e) {
	$('.form-horizontal').submit(function(){
		$('.simpan').html('<img class="loading" src="<?php echo base_url() ?>image/ajax-loading.gif"> Proses...');
		$.ajax({
			type: 'POST',
			url:$(this).attr('action'),
			data: $(this).serialize(),
			success: function(data) {
				msg = data.split('|');
				if(msg[0]=='sukses'){
					$('.notif').fadeIn('slow');
					$('.notif').html(msg[1]);
					$('.notif').delay(4000).fadeOut(1000);
					$('input').val('');
					$('.btn-success').html('Simpan');
					$('select').val('');
				}
				else{
					$('.notif').fadeIn('slow');
					$('.notif').html(msg[1]);
					$('.notif').delay(4000).fadeOut(1000);
					//$('select').val('');
					$('.btn-success').html('Simpan');
				}
			}
		});
		return false;
	});
});
</script>
<style>
	.dalam{width:400px; margin:auto;}
	.input-small{float:right;}
</style>
<div class="col-lg-12">
	<h1 class="page-header">Tambah Penjadwalan Praktikum</h1>
</div>
<div class="col-lg-12">
	<div class="panel panel-default" style="border-radius:0px 0px 0px 0px;">
        <div class="panel-body">
			<div class="dalam">
				<?php 
          $uri3 = $this->uri->segment(3);
          echo form_open('admin_jadwal/post_jadwal/'.$uri3,'class="form-horizontal"');
        ?>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">ID_Praktikum</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control input-small" required name="id_praktikum" placeholder="ID Praktikum">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Pengajar1</label>
                      <div class="col-sm-10">
                        <select name="pengajar1" class="form-control input-small" required>
                        	<option value="">--Asisten 1--</option>
                            <?php 
								foreach($asisten as $asisten1){
									echo "<option value='$asisten1->id_asisten'>$asisten1->nama</option>";	
								} 
							 ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Pengajar2</label>
                      <div class="col-sm-10">
                        <select name="pengajar2" class="form-control input-small" required>
                        	<option value="">--Asisten 2--</option>
                        	<?php 
								foreach($asisten as $asisten1){
									echo "<option value='$asisten1->id_asisten'>$asisten1->nama</option>";	
								} 
							 ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Kelas</label>
                      <div class="col-sm-10">
                        <select name="kelas" class="form-control input-small" required>
                        	<option value="">--Pilih Kelas--</option>
                            <?php 
								foreach($kelas as $kelass){
									echo "<option value='$kelass->id_kelas'>$kelass->kelas</option>";	
								} 
							 ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Mata_Praktikum</label>
                      <div class="col-sm-10">
                        <select name="matkum" class="form-control input-small" required>
                        	<option value="">--Pilih Mata Praktikum--</option>
                            <?php 
								foreach($matkum as $matkums){
									echo "<option value=$matkums->id_matkum'>$matkums->mata_praktikum</option>";	
								} 
							 ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Hari</label>
                      <div class="col-sm-10">
                        <select name="hari" class="form-control input-small" required>
                        	<option value="">--Pilih Hari--</option>
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
                        	<option value="">--Pilih Jam--</option>
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
                        	<option value="">--Pilih Ruangan--</option>
                            <?php 
								foreach($ruangan as $ruangans){
									echo "<option value='$ruangans->id_ruangan'>$ruangans->ruangan</option>";	
								} 
							 ?>
                        </select>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success simpan">Simpan</button>
					<?php echo anchor('admin_jadwal/periode/'.$uri3,'Kembali','class="btn btn-default kembali"') ?>
				</form>
            </div>
		</div>
    </div>
</div>            