<script>
	$(document).ready(function(e) {
    	$('.id_praktikum').change(function(){
			var id_praktikum = $('.id_praktikum').val();
			if(id_praktikum==''){
				window.location.href='<?php echo base_url() ?>index.php/asisten_penilaian';	
			}
			window.location.href='<?php echo base_url() ?>index.php/asisten_penilaian/penilaian/'+id_praktikum;	
		});
	});
</script>
<style>
	.input-medium{width:150px;}
	.atas{width:100%;float:left;margin-bottom:5px;}
	.col-md7{padding-left:0px;}
	.kiri1{width:150px;float:left;margin-left:0px;}
	.kiri2{width:100px;float:left;}
</style>
<div class="col-md-12">
	<h2 class="page-header">Penilaian Praktikum</h2>
</div>
<div class="col-md-12">
	<div class="atas alert alert-info" style="margin-bottom:20px;">
        <div class="col-md-7">
            <div class="kiri1">
                <b>Pilih ID Praktikum</b>
            </div>
            <div class="kiri2">
                <select class="input-medium id_praktikum form-control">
                    <option value="">--ID Praktikum--</option>
                    <?php foreach($praktikum as $rz){ ?>
                            <option value="<?php echo $rz->id_praktikum ?>"><?php echo strtoupper($rz->id_praktikum) ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>            
</div>