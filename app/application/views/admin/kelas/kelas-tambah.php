<div class="col-lg-12">
	<h1 class="page-header">Tambah Kelas</h1>
</div>
<div class="col-lg-12">
	<div class="panel panel-default" style="margin:auto; width:350px;">
        <div class="panel-body">
			<?php echo form_open('admin_kelas/post_kelas','class="form-horizontal" role="form"') ?>
                <table>
                    <tr>
                        <td><b>Kelas</b></td>
                        <td width="50"></td>
                        <td><input required type="text" placeholder="Kelas" name="kelas" class="form-control"></td>
                    </tr>
                </table>
                <input type="submit" value="Tambah" class="btn btn-success simpan">
                <?php echo anchor('admin_kelas','Kembali','class="btn btn-default kembali"') ?>
            </form>
 		</div>
    </div>          
</div>