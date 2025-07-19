<div class="col-lg-12">
	<h1 class="page-header">Edit Ruangan</h1>
</div>
<div class="col-lg-12">
	<div class="panel panel-default" style="width:400px; margin:auto;">
        <div class="panel-body ">
			<?php 
				echo form_open('admin_ruangan/update_ruangan');
				foreach($ruangan as $rz){ 
				echo form_hidden('id_ruangan',$rz->id_ruangan);
			?>
                <table>
                    <tr>
                        <td><b>Ruangan</b></td>
                        <td width="30"></td>
                        <td width="280"><input required type="text" placeholder="Ruangan" value="<?php echo $rz->ruangan ?>" name="ruangan" class="form-control"></td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-warning simpan">Ganti</button>
                <?php } echo anchor('admin_ruangan','Batal','class="btn btn-default kembali"') ?>
            </form>
 		</div>
    </div>          
</div>