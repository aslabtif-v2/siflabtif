<script>
	$(document).ready(function(e) {
        $('.input-small').change(function(){
			var id_asisten = $('.input-small').val();
			if(id_asisten!=''){
				window.location.href='<?php echo base_url() ?>index.php/admin_catatan/listt/'+id_asisten;				
			}
			else{
				window.location.href='<?php echo base_url() ?>index.php/admin_catatan';	
			}
		});
    });
</script>
<style>
	.input-mini{float:right;}
	.col-lg-8{padding-left:0px;}
	.notiff{bottom:0px; right:5px; position:fixed;}
</style>
<div class="col-lg-12">
	<h1 class="page-header">Catatan Asisten</h1>
</div>
<div class="col-lg-12">
	<div class="col-lg-8">
    	<?php 
			$id_asisten = $this->uri->segment(3);
		?>
    	<form class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-2 control-label">Pilih Asisten</label>
              <div class="col-sm-10">
                <select class="input-small form-control">
                    <option value="">--Pilih ID Praktikum--</option>
                    <?php 
						foreach($asisten as $rz){ 
						if($id_asisten==$rz->id_asisten){
							$pilih = "selected";
						}
						else{
							$pilih ="";
						}
					?>
                            <option value="<?php echo $rz->id_asisten ?>" <?php echo $pilih ?>><?php echo ucwords($rz->nama) ?></option>
                    <?php } ?>
                </select>
              </div>
            </div>
		</form>   
    </div>  
</div>
<div class="col-lg-12 table-responsive">
	<?php 
		if(isset($catatan)){
	?>
    	<table class="table table-bordered table-hover table-striped">
        	<thead class="alert alert-info">
            	<th width="70">No</th>
            	<th>Nama Catatan</th>
            	<th>Catatan</th>
            	<th>Tanggal</th>
            	<th>Aksi</th>
            </thead>
            <tbody>
       <?php
			$no = 0;
			foreach($catatan as $item){
				$no++;
				$tanggal = explode('-',$item->tanggal);
				//nama catatan
				if(strlen($item->nama_cat)>20){
					$namaCat = substr($item->nama_cat,0,30).'...';
				}
				else{
					$namaCat = $item->nama_cat;
				}
				//isi catatan
				if(strlen($item->catatan)>90){
					$Cat = substr($item->catatan,0,90).'...';
				}
				else{
					$Cat = $item->catatan;
				}
		?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo  $namaCat ?></td>
                    <td><?php echo $Cat ?></td>
                    <td><?php echo $tanggal[2].' '.$namaBulan[$tanggal[1]-1].' '.$tanggal[0] ?></td>
                    <td>
                        <?php echo anchor('admin_catatan/lihat/'.$item->id_cat,'<i class="glyphicon glyphicon-open"></i>','title="Lihat"') ?>
                        <a href="#" title="hapus" class="jarak-kiri hapus"><i class="glyphicon glyphicon-remove"></i> <input type="hidden" value="<?php echo base_url() ?>index.php/admin_catatan/hapus/<?php echo $item->id_cat.'/'.$id_asisten ?>"></a>
                    </td>
                </tr>
	<?php 
			}
			if($no==0){
				echo "<tr class='alert-danger'><td colspan='5' align='center'><b>Tidak ada catatan</b></td></tr>";	
			}
	?>
            </tbody>
        </table>
    <?php
		}
	?>	
</div>