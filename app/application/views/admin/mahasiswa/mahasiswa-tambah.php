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
					$('.notif').fadeIn('slow');
					$('.notif').html(msg[1]);
					$('.notif').delay(4000).fadeOut(1000);
					$('input').val('');
					$('.btn-success').html('Simpan');
					//$('select').val('');
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
<div class="col-lg-12">
	<h1 class="page-header">Tambah Mahasiswa</h1>
</div>
<div class="col-lg-12">
	<div class="panel panel-default" style="margin:auto; width:350px;">
        <div class="panel-body">
        	<?php echo form_open('admin_mahasiswa/post_mhs','class="form-horizontal"') ?>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NPM</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" required name="npm" placeholder="NPM">
                  </div>
                </div><div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" required name="nama" placeholder="Nama Mahasiswa">
                  </div>
                </div><div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kelas</label>
                  <div class="col-sm-10">
                    <select name="kelas" required class="form-control">
                        <option value="">--Pilih Kelas--</option>
                        <?php foreach($kelas as $rz){ ?>
                        <option value="<?php echo $rz->id_kelas ?>"><?php echo $rz->kelas ?></option>
                        <?php } ?>
                    </select>
                  </div>
                </div>
                <button type="submit" class="btn btn-success simpan">
                	Simpan
                </button>
				<?php echo anchor('admin_mahasiswa','Kembali','class="btn btn-default kembali"') ?>
            </form>
    	</div>
    </div>
</div>