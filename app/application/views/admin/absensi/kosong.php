<script>
	$(document).ready(function(e) {
        $('.pertemuan').change(function(){
			var id_praktikum = $('.id_praktikum').val();
			var pertemuan = $('.pertemuan').val();
			if(id_praktikum!=''){
				window.location.href='<?php echo base_url() ?>index.php/admin_absensi/absensi/'+id_praktikum+'/'+pertemuan;				
			}
			else{
				window.location.href='<?php echo base_url() ?>index.php/admin_absensi';	
			}
		});
		$('.notiff').delay(4000).fadeOut('slow');
    });
</script>
<style>
	.input-mini{width:100px;}
	.input-medium{width:150px;}
	.jarak{margin-left:50px;}
	.atas{width:100%;float:left;margin-bottom:5px;}
	.col-lg-6,.col-lg-5,.col-lg-7{padding-left:0px;}
	.kiri1{width:110px;float:left;margin-left:0px;}
	.kiri2{width:230px;float:left;}
	.tgl{width:150px;float:right;}
</style>
<div class="col-lg-12">
	<h1 class="page-header">Absensi Praktikum</h1>
</div>
<div class="col-lg-12">
	<div class="atas alert alert-warning" style="margin-bottom:20px;">
    	<div class="atas">
            <div class="col-lg-5">
                <div class="kiri1">
                    <b>ID Praktikum</b>
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
            <div class="col-lg-7">
                <div class="kiri1">
                    <b>Pertemuan</b>
                </div>
                <div class="kiri2">
                    <select class="input-mini pertemuan form-control">
                        <option value="">--Pilih--</option>
                        <?php 
                            for($i=1;$i<=10;$i++){
                                echo "<option>$i</option>";
                            } 
                        ?>
                    </select>
                </div>
                <div class="tgl">
                    <b><i class="glyphicon glyphicon-calendar"></i> <?php echo $tanggal ?></b>
                </div>
            </div>
    	</div>
    </div>  
</div>