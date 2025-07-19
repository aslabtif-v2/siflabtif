<style>
	.input-mini{width:70px;}
	.control-label{float:left;}
	.page-header{text-align:center;}
</style>
<div class="col-md-12">
	<h2 class="page-header">Persentase Penilaian Praktikum</h2>
</div>
<div class="col-md-12">
	<div class="panel panel-default" style="margin:auto; width:350px;">
        <div class="panel-body">
        	<?php 
				echo form_open('asisten_penilaian/update_persentase','class="form-horizontal"');
				echo form_hidden('id_praktikum',$persentase->id_praktikum);
			?>
                <div class="form-group">
                  <label class="col-sm-5 control-label">ID Praktikum</label>
                  <div class="col-sm-5">
                  <label class="col-sm-5 control-label"><?php echo strtoupper($persentase->id_praktikum) ?></label>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-5 control-label">Kehadiran</label>
                  <div class="col-sm-5">
                    <input type="number" class="form-control input-mini" value="<?php echo $persentase->kehadiran ?>" required name="kehadiran" placeholder="Kehadiran">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-5 control-label">Tugas</label>
                  <div class="col-sm-5">
                    <input type="number" class="form-control input-mini" value="<?php echo $persentase->tugas ?>" required name="tugas" placeholder="Tugas">
                  </div>
                </div>
                <div class="form-group">
                	<label class="col-sm-5 control-label">Ujian</label>
                  	<div class="col-sm-5">
					<input type="number" class="form-control input-mini" value="<?php echo $persentase->ujian ?>" required name="ujian" placeholder="Ujian">                
                  </div>
                </div><hr>
                <button type="submit" class="btn btn-warning simpan" style="margin-left:40px;">
                	Ganti
                </button>
				<?php echo anchor('asisten_penilaian/penilaian/'.$persentase->id_praktikum,'Batal','class="btn btn-default kembali"') ?>
            </form>
    	</div>
    </div>
</div>