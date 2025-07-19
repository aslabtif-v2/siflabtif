<div class="col-lg-12">
	<h1 class="page-header">Edit Mata Praktikum</h1>
</div>
<div class="col-lg-12">
	<div class="panel panel-default" style="width:400px; margin:auto;">
        <div class="panel-body ">
			<?php 
				echo form_open('admin_mata_praktikum/update_matkum') ;
				foreach($matkum as $rz){
				echo form_hidden('id_matkum',$rz->id_matkum);
			?>
                <table>
                    <tr>
                        <td><b>Mata Praktikum</b></td>
                        <td width="30"></td>
                        <td width="230"><input required type="text" value="<?php echo $rz->mata_praktikum ?>" placeholder="Mata Praktikum" name="matkum" class="form-control"></td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-warning simpan">Ganti</button>
                <?php } echo anchor('admin_mata_praktikum','Kembali','class="btn btn-default kembali"') ?>
            </form>
 		</div>
    </div>          
</div>