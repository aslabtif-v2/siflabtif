<script>
	$(document).ready(function(e) {
        $('.id_praktikum').change(function(){
			var id_praktikum = $('.id_praktikum').val();
			var pertemuan = $('.pertemuan').val();
			window.location.href='<?php echo base_url() ?>index.php/asisten_absensi/absensi/'+id_praktikum;
		});
    });
</script>
<style>
	.input-medium{width:150px; border-radius:5px 5px 5px 5px; color:#4D4D4D;}
	.atas{width:100%;float:left;margin-bottom:5px;}
	.kiri1{width:110px;float:left;margin-left:0px;}
	.kiri2{width:230px;float:left;}
	.tgl{width:150px;float:right;}
</style>
<div class="col-lg-12">
	<h2 class="page-header">Absensi Praktikum</h2>
</div>
<div class="col-lg-12">
	<div class="atas alert alert-info" style="margin-bottom:20px;">
                <div class="kiri1">
                    <b>ID Praktikum</b>
                </div>
                <div class="kiri2">
                    <select class="input-medium id_praktikum">
                        <option value="">--ID Praktikum--</option>
                        <?php foreach($praktikum as $rz){ ?>
                                <option value="<?php echo $rz->id_praktikum ?>"><?php echo strtoupper($rz->id_praktikum) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="tgl">
                    <b><i class="glyphicon glyphicon-calendar"></i> <?php echo $tanggal ?></b>
                </div>
    	</div>
    </div>  
</div>