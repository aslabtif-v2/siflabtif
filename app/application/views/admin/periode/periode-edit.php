<div class="col-lg-12">
	<h1 class="page-header">Edit Periode</h1>
</div>
<div class="col-lg-12">
	<div class="panel panel-default" style="margin:auto; width:400px;">
        <div class="panel-body">
			<?php echo form_open('admin_periode/update/'.$pr->pr_id,'class="form-horizontal" role="form"') ?>
                <table width="100%">
                    <tr>
                        <td><b>Periode</b></td>
                        <td width="50"></td>
                        <td><input required type="text" value="<?php echo $pr->pr_periode ?>" placeholder="Periode Mengajar" name="periode" class="form-control"></td>
                    </tr>
                </table>
                <input type="submit" value="Simpan" class="btn btn-warning simpan">
                <?php echo anchor('admin_periode','Kembali','class="btn btn-default kembali"') ?>
            </form>
 		</div>
    </div>          
</div>