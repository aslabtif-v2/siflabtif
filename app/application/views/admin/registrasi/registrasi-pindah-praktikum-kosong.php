<style>
	.input-medium{width:150px;border-radius:5px 5px 5px 5px; color:#666;}
	.atas{width:100%;float:left;margin-bottom:5px;}
	.col-lg-5,.col-lg-7{padding-left:0px;}
	.kiri1{width:150px;float:left;margin-left:0px;}
	.kiri2{width:180px;float:left;}
	.kehadiran{text-align:center; cursor:pointer;}
</style>
<script>
	$(document).ready(function(e) {
    	$('.id_praktikum').change(function(){
			var id_praktikum = $('.id_praktikum').val();
			if(id_praktikum!=''){
				window.location.href='<?php echo base_url() ?>index.php/admin_registrasi/pindah_praktikum/'+id_praktikum;				
			}
			else{
				window.location.href='<?php echo base_url() ?>index.php/admin_registrasi/pindah';	
			}
		});
	});
</script>
<div class="col-lg-12">
	<h1 class="page-header">Pindah Praktikum</h1>
</div>
<div class="col-lg-12">
	<div class="atas alert alert-warning" style="margin-bottom:20px;">
    	<div class="atas">
            <div class="kiri1">
                <b>Pilih ID Praktikum</b>
            </div>
            <div class="kiri2">
                <select class="input-medium id_praktikum">
                    <option value="">--ID Praktikum--</option>
                    <?php 
                        foreach($praktikum as $rz){ 
                            if($rz->id_praktikum==$id_praktikum){
                                $pilih = 'selected';
                            }
                            else{
                                $pilih ='';
                            }
                            echo "<option value='$rz->id_praktikum' $pilih>".strtoupper($rz->id_praktikum)."</option>";
                        } 
                    ?>
                </select>
            </div>
            <div class="kiri1" style="width:100px;">
                <b>Pindah Ke</b>
            </div>
            <div class="kiri2">
                <select class="input-medium">
                    <option value="">--ID Praktikum--</option>
                    <?php 
                        foreach($praktikum as $rz){ 
                            if($rz->id_praktikum==$id_praktikum){
                                $pilih = 'selected';
                            }
                            else{
                                $pilih ='';
                            }
                            echo "<option value='$rz->id_praktikum' $pilih>".strtoupper($rz->id_praktikum)."</option>";
                        } 
                    ?>
                </select>
            </div>
    	</div>
    </div>
</div>