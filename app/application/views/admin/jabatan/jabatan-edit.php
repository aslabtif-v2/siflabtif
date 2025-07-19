<style>
	.kn{float:right;}
</style>
<div class="col-lg-12">
	<h1 class="page-header">Edit Jabatan</h1>
</div>
<div class="col-lg-12">
	<div class="panel panel-default" style="margin:auto; width:400px;">
        <div class="panel-body">
        	<?php 
				echo form_open('admin_jabatan/update_jabatan','class="form-horizontal"');
				foreach($jabatan as $rz){
				echo form_hidden('id_jabatan',$rz->id_jabatan);
			?>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jabatan</label>
                  <div class="col-sm-8 kn">
                    <input type="text" class="form-control" required value="<?php echo $rz->jabatan ?>" name="jabatan" placeholder="Jabatan">
                  </div>
                </div><div class="form-group">
                  <label class="col-sm-2 control-label">Honor/Pertemuan</label>
                  <div class="col-sm-8 kn">
                    <input type="number" class="form-control" name="honor_pertemuan" value="<?php echo $rz->honor_pertemuan ?>" placeholder="Honor/Pertemuan">
                  </div>
                </div><div class="form-group">
                  <label class="col-sm-2 control-label">Honor/Perbulan</label>
                  <div class="col-sm-8 kn">
                    <input type="number" class="form-control" name="honor_perbulan" value="<?php echo $rz->honor_perbulan ?>" placeholder="Honor/Bulan">
                  </div>
                </div>
                <button type="submit" class="btn btn-warning simpan">
                	Ganti
                </button>
				<?php } echo anchor('admin_jabatan','Kembali','class="btn btn-default kembali"') ?>
            </form>
    	</div>
    </div>
</div>