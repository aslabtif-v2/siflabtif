<script>
	$(document).ready(function(e) {
    	$('.id_praktikum').change(function(){
			var id_praktikum = $('.id_praktikum').val();
			if(id_praktikum!=''){
				window.location.href='<?php echo base_url() ?>index.php/admin_penilaian/penilaian/'+id_praktikum;				
			}
		});
	});
</script>
<style>
	.input-medium{width:150px;}
	.atas{width:100%;float:left;margin-bottom:5px;}
	.col-lg-6,.col-lg-5,.col-lg-7{padding-left:0px;}
	.kiri1{width:150px;float:left;margin-left:0px;}
	.kiri2{width:230px;float:left;}
</style>
<div class="col-lg-12">
	<h1 class="page-header">Penilaian Praktikum</h1>
</div>
<div class="col-lg-12">
	<div class="atas alert alert-warning" style="margin-bottom:20px;">
    	<div class="atas">
            <div class="col-lg-7">
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
</div>