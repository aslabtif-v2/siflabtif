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
	.kn{float:right;}
</style>
<div class="col-lg-12">
	<h1 class="page-header">Tambah Jabatan</h1>
</div>
<div class="col-lg-12">
	<div class="panel panel-default" style="margin:auto; width:400px;">
        <div class="panel-body">
        	<?php echo form_open('admin_jabatan/post_jabatan','class="form-horizontal"') ?>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jabatan</label>
                  <div class="col-sm-8 kn">
                    <input type="text" class="form-control" required name="jabatan" placeholder="Jabatan">
                  </div>
                </div><div class="form-group">
                  <label class="col-sm-2 control-label">Honor/Pertemuan</label>
                  <div class="col-sm-8 kn">
                    <input type="number" class="form-control" name="honor_pertemuan" placeholder="Honor/Pertemuan">
                  </div>
                </div><div class="form-group">
                  <label class="col-sm-2 control-label">Honor/Perbulan</label>
                  <div class="col-sm-8 kn">
                    <input type="number" class="form-control" name="honor_perbulan" placeholder="Honor/Bulan">
                  </div>
                </div>
                <button type="submit" class="btn btn-success simpan">
                	Simpan
                </button>
				<?php echo anchor('admin_jabatan','Kembali','class="btn btn-default kembali"') ?>
            </form>
    	</div>
    </div>
</div>