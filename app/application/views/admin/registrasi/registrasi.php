<script>
	$(document).ready(function(e) {
        $('.input-small').change(function(){
			var id_praktikum = $('.input-small').val();
			if(id_praktikum!=''){
				window.location.href='<?php echo base_url() ?>index.php/admin_registrasi/praktikum/'+id_praktikum;				
			}
			else{
				window.location.href='<?php echo base_url() ?>index.php/admin_registrasi';	
			}
		});
		$('.notiff').delay(4000).fadeOut('slow');
    });
</script>
<style>
	.input-mini{float:right;}
	.col-lg-8{padding-left:0px;}
	.notiff{bottom:0px; right:5px; position:fixed;}
</style>
<div class="col-lg-12">
	<h1 class="page-header">Registrasi Praktikum</h1>
</div>
<div class="col-lg-12">
	<div class="col-lg-8">
    	<?php
			$id_praktikum = $this->uri->segment(3);
			$notif = $this->uri->segment(4);
		?>
    	<form class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-2 control-label">ID_Praktikum</label>
              <div class="col-sm-10">
                <select class="input-small form-control">
                    <option value="">--Pilih ID Praktikum--</option>
                    <?php 
						foreach($praktikum as $rz){ 
						if($id_praktikum==$rz->id_praktikum){
							$pilih = "selected";
						}
						else{
							$pilih ="";
						}
					?>
                            <option value="<?php echo $rz->id_praktikum ?>" <?php echo $pilih ?>><?php echo strtoupper($rz->id_praktikum) ?></option>
                    <?php } ?>
                </select>
              </div>
            </div>
		</form>   
    </div>  
</div>
<div class="col-lg-12 table-responsive">
	<?php
		if(isset($mahasiswa)){
			echo form_open('admin_registrasi/simpan_registrasi');
	?>
    	<table class="table table-bordered table-hover table-striped">
        	<thead>
            	<th width="70">No</th>
            	<th>NPM</th>
            	<th>Nama</th>
            	<th>Kelas</th>
            	<th></th>
            </thead>
            <tbody>
        <?php
			$i=0;
			foreach($mahasiswa as $mhr){
			$i++;
			$satu = $this->db->query("SELECT COUNT(id_registrasi) AS ada FROM registrasi_praktikum WHERE id_praktikum='$id_praktikum' AND npm='$mhr->npm'")->row();
			if($satu->ada==1){
				$cek = 'checked';
				$tanda = 'info';
			}
			else{
				$cek = '';	
				$tanda = '';
			}
		?>
            	<tr class="<?php echo $tanda ?>">
                	<td><?php echo $i ?></td>
                	<td><?php echo $mhr->npm ?></td>
                	<td><?php echo $mhr->nama ?></td>
                	<td><?php echo $mhr->kelas ?></td>
                	<td><input type="checkbox" name="pilih[]" value="<?php echo $mhr->npm ?>" <?php echo $cek ?>></td>
                </tr>
        <?php				
			}
		?>
            </tbody>
        </table>
    		<input type="hidden" value="<?php echo $id_praktikum ?>" name="id_praktikum">
    		<input type="submit" value="Simpan" class="btn btn-success simpan">
    	</form>
    <?php
		}
	?>	
</div>
<?php
	if($notif=='ok'){
		echo '<div class="alert alert-info notiff">Data tersimpan.</div>';	
	}
?>