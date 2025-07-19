<style>
	.input-medium{width:150px;border-radius:5px 5px 5px 5px; color:#666;}
	.atas{width:100%;float:left;margin-bottom:5px;}
	.col-lg-5,.col-lg-7{padding-left:0px;}
	.kiri1{width:150px;float:left;margin-left:0px;}
	.kiri2{width:180px;float:left;}
	.status{text-align:center; cursor:pointer;}
	.table-bordered{float:left;margin-top:0px;}
</style>
<script>
	$(document).ready(function(e) {
    	$('.id_kelas').change(function(){
			var id_kelas = $('.id_kelas').val();
			if(id_kelas!=''){
				window.location.href='<?php echo base_url() ?>index.php/admin_pembayaran/kelas/'+id_kelas;				
			}
			else{
				window.location.href='<?php echo base_url() ?>index.php/admin_pembayaran';	
			}
		});
		
		$('.status').click(function(){
			var npm = $(this).attr('id');
			var status = $('#'+npm).html();
			var respon;
			if(status=='Belum Lunas'){
				respon = 'Lunas';
			}
			else if(status=='Lunas'){
				respon = 'Belum Lunas';
			}
			$('#'+npm).html('<img src="<?php echo base_url() ?>/image/loading.gif"/>');
			$.ajax({
				type:"POST",
				url:"<?php echo base_url() ?>index.php/admin_pembayaran/status_bayaran",
				data:"npm="+npm+"&status="+respon,
				success: function(data){
					$('#'+npm).html(data);
				}
			});
			return false;
		});
	});
</script>

<div class="col-lg-12">
	<h1 class="page-header">Status Pembayaran Praktikum</h1>
</div>
<div class="col-lg-12">
        <div class="atas alert alert-warning" style="margin-bottom:20px;">
            <div class="atas">
                <div class="kiri1">
                    <b>Pilih Kelas</b>
                </div>
                <div class="kiri2">
                    <select class="input-medium id_kelas form-control">
                        <?php 
							$uri3 = $this->uri->segment(3);
							echo "<option value=''>--pilih kelas--</option>";                            
							foreach($kelas as $rz){
								$pilih='';
								if($rz->id_kelas==$uri3){
									$pilih='selected';
								}
                                echo "<option value='$rz->id_kelas' $pilih>".strtoupper($rz->kelas)."</option>";
                            } 
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <th width="70">No</th>
                <th>NPM</th>
                <th>Nama</th>
                <th width="120">Status</th>
            </thead>
            <tbody>
            <?php
                $i=0;
				
				if(isset($mhs)){
					foreach($mhs as $mhr){
						$status = "Belum Lunas";
						if($mhr->byr_status==1){
							$status = "Lunas";							
						}
						$i++;
            ?>
					<tr class="">
						<td><?php echo $i ?></td>
						<td><?php echo $mhr->npm ?></td>
						<td><?php echo $mhr->nama ?></td>
						<td class="status" id="<?php echo $mhr->npm ?>"><?php echo $status ?></td>
					</tr>
            <?php 
					} 
				}
				if($i==0){
					echo "<tr><td colspan='5' class='text-center'>Data Mahasiswa</td></tr>";
				}
			?>
            </tbody>
        </table>        
</div>