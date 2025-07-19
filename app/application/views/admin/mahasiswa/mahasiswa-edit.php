<script>
$(document).ready(function(e) {
	$('.form-horizontal').submit(function(){
		$('.simpan').html('<img class="loading" src="<?php echo base_url() ?>image/ajax-loading.gif"> Proses...');
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: $(this).serialize(),
			success: function(data) {
				msg = data.split('|');
				if(msg[0]=='sukses'){
					window.location.href='../../admin_mahasiswa';
				}
				else{
					$('.notif').fadeIn('slow');
					$('.notif').html(msg[1]);
					$('.notif').delay(4000).fadeOut(1000);
					$('.btn-warning').html('Ganti');
				}
			}
		});
		return false;
	});
});
</script>
<div class="col-lg-12">
	<h1 class="page-header">Tambah Mahasiswa</h1>
</div>
<div class="col-lg-12">
	<div class="panel panel-default" style="margin:auto; width:350px;">
        <div class="panel-body">
        	<?php 
				echo form_open('admin_mahasiswa/update_mhs','class="form-horizontal"'); 
				foreach($mhs as $mhr){
				echo form_hidden('id_npm',$mhr->npm);
			?>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NPM</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo $mhr->npm ?>" required name="npm" placeholder="NPM">
                  </div>
                </div><div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo $mhr->nama ?>" required name="nama" placeholder="Nama Mahasiswa">
                  </div>
                </div><div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kelas</label>
                  <div class="col-sm-10">
                    <select name="kelas" required class="form-control">
                        <option value="<?php echo $mhr->id_kelas ?>"><?php echo $mhr->kelas ?></option>
                        <?php foreach($kelas as $rz){ ?>
                        <option value="<?php echo $rz->id_kelas ?>"><?php echo $rz->kelas ?></option>
                        <?php } ?>
                    </select>
                  </div>
                </div>
                <button type="submit" class="btn btn-warning simpan">
                	Ganti
                </button>
				<?php } echo anchor('admin_mahasiswa','Batal','class="btn btn-default kembali"') ?>
            </form>
    	</div>
    </div>
</div>