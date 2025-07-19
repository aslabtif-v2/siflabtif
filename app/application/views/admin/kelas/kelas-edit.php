<style>
	.control-label{
		float:left;
		margin-right:50px;
	}
</style>
<div class="col-lg-12">
	<h1 class="page-header">Edit Kelas</h1>
</div>
<div class="col-lg-12">
	<div class="panel panel-default" style="margin:auto; width:350px;">
        <div class="panel-body">
			<?php 
                echo form_open('admin_kelas/update_kelas');
                foreach($kelas as $rz){
                echo form_hidden('id_kelas',$rz->id_kelas);
            ?>
                <div>
                    <label class="control-label">ID Kelas</label> 
                    <input type="text" disabled placeholder="Kelas" name="kelas" value="<?php echo $rz->id_kelas ?>" class="input-small form-control">
                </div>	
                    <br /><br />
                <div style="margin-top:10px;">
                    <label class="control-label" style="margin-right:68px;">Kelas</label> 
                        <input required type="text" placeholder="Kelas" name="kelas" value="<?php echo $rz->kelas ?>" class="input-small form-control"> 
                </div>
                    <br /><br />
                <input type="submit" value="Ganti" class="btn btn-warning" style="margin:40px 0px 0px 0px;">
                <?php echo anchor('admin_kelas','Batal','class="btn btn-default" style="margin:40px 0px 0px 10px;"') ?>
            </form>
            <?php } ?>
		</div>
	</div>     
</div>