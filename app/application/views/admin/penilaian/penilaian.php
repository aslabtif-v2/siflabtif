<style>
	.input-medium{width:150px;}
	.atas{width:100%;float:left;margin-bottom:5px;}
	.col-lg-6,.col-lg-5,.col-lg-7{padding-left:0px;}
	.kiri1{width:150px;float:left;margin-left:0px;}
	.kiri2{width:230px;float:left;}
	.kehadiran, .tugas, .ujian, .total{text-align:center; cursor:pointer;}
	.table-nilai{float:right;margin-bottom:10px;}
	.input-mini{width:40px; text-align:center;}
	.td-nilai{text-align:center; width:100px;}
	.hilang{display:none;}
</style>
<script>
	$(document).ready(function(e) {
    	$('.id_praktikum').change(function(){
			var id_praktikum = $('.id_praktikum').val();
			if(id_praktikum!=''){
				window.location.href='<?php echo base_url() ?>index.php/admin_penilaian/penilaian/'+id_praktikum;				
			}
			else{
				window.location.href='<?php echo base_url() ?>index.php/admin_penilaian';	
			}
		});
		$('.tr-nilai',this).click(function(){
			var id=$(this).attr("id");
			$('.nt'+id).hide();
			$('.nu'+id).hide();
			$('.it'+id).show();
			$('.iu'+id).show();
		}).change(function(){
			var id=$(this).attr("id");
			var id_praktikum = $('.id_praktikum').val();
			var phadir = $('.khadir').val();
			var ptugas = $('.ktugas').val();
			var pujian = $('.kujian').val();
			var kehadiran = $('.hadir'+id).html();
			var tugas = $('.it'+id).val();
			var ujian = $('.iu'+id).val();
			var total =(kehadiran*phadir/100)+(tugas*ptugas/100)+(ujian*pujian/100);
			total = parseInt(total);
			$('.total'+id).html(total);
			$.ajax({
				type:"POST",
				url:"<?php echo base_url() ?>index.php/admin_penilaian/nilai",
				data:"id_praktikum="+id_praktikum+"&id_regis="+id+"&tugas="+tugas+"&ujian="+ujian,
				success: function(data){
					$('.nt'+id).html(tugas);
					$('.nu'+id).html(ujian);
				}
			});
		});
		$('.hilang').mouseup(function(){
			return false;
		});
		$(document).mouseup(function(){
			$('.hilang').hide();
			$('.muncul').show();
			return false;
		});
	});
</script>

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
    <table class="table-nilai">
    	<tr>
        	<th></th>
        	<th></th>
        	<th></th>
        	<th class="td-nilai"><input disabled class="input-mini khadir" value="<?php echo $persentase->kehadiran ?>"> %</th>
        	<th class="td-nilai"><input disabled class="input-mini ktugas" value="<?php echo $persentase->tugas ?>"> %</th>
        	<th class="td-nilai"><input disabled class="input-mini kujian" value="<?php echo $persentase->ujian ?>"> %</th>
        	<th class="td-nilai"><?php echo anchor('admin_penilaian/edit_persentase/'.$id_praktikum,'<i class="glyphicon glyphicon-edit"></i> Edit','title="Edit persentase nilai"') ?></th>
        </tr>
    </table>
    <table class="table table-bordered table-hover table-striped">
    	<thead>
        	<th width="70">No</th>
        	<th>NPM</th>
        	<th>Nama</th>
        	<th width="100">Kehadiran</th>
        	<th width="100">Tugas</th>
        	<th width="100">Ujian</th>
        	<th width="100">Total</th>
        </thead>
        <tbody>
        <?php
			$i=0;
			foreach($mahasiswa as $mhr){
			$i++;
			$hadir = $this->admin_penilaian_models->kehadiran($id_praktikum,$mhr->npm);
			$kehadiran = $hadir->kehadiran * 10;
			$total = ($kehadiran*$persentase->kehadiran/100)+($mhr->tugas*$persentase->tugas/100)+($mhr->ujian*$persentase->ujian/100);
		?>
        	<tr class="tr-nilai" id="<?php echo $mhr->id_registrasi ?>">
            	<td><?php echo $i ?></td>
            	<td><?php echo $mhr->npm ?></td>
            	<td><?php echo $mhr->nama ?></td>
            	<td class="hadir<?php echo $mhr->id_registrasi ?> kehadiran"><?php echo $kehadiran ?></td>
            	<td class="tugas">
                	<span class="nt<?php echo $mhr->id_registrasi ?> muncul"><?php echo $mhr->tugas ?></span>
                	<input type="text" maxlength="3" class="it<?php echo $mhr->id_registrasi ?> input-mini hilang" value="<?php echo $mhr->tugas ?>" />
                </td>
            	<td class="ujian">
                	<span class="nu<?php echo $mhr->id_registrasi ?> muncul"><?php echo $mhr->ujian ?></span>
                	<input type="text" maxlength="3" class="iu<?php echo $mhr->id_registrasi ?> input-mini hilang" value="<?php echo $mhr->ujian ?>" />
                </td>
            	<td class="total<?php echo $mhr->id_registrasi ?>"><?php echo $total ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>        
	<?php echo anchor('admin_excel/unduh_excel/'.$id_praktikum,'<i class="glyphicon glyphicon-save"></i> Unduh Excel','class="btn btn-success" target="_blank" style="margin-bottom:40px;"') ?>
</div>