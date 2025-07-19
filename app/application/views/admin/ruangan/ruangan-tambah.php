<div class="col-lg-12">
	<h1 class="page-header">Tambah Ruangan</h1>
</div>
<div class="col-lg-12">
	<div class="panel panel-default" style="width:400px; margin:auto;">
        <div class="panel-body ">
			<?php echo form_open('admin_ruangan/post_ruangan') ?>
                <table>
                    <tr>
                        <td><b>Ruangan</b></td>
                        <td width="30"></td>
                        <td width="280"><input required type="text" placeholder="Ruangan" name="ruangan" class="form-control"></td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-success simpan">Simpan</button>
                <?php echo anchor('admin_ruangan','Kembali','class="btn btn-default kembali"') ?>
            </form>
 		</div>
    </div>          
</div>