<script>
	$(document).ready(function(e) {
		$('.status',this).click(function(){
			var id = $(this).attr('id');
			var status = $('#'+id).html();
			var respon;
			
			if(status=='Aktif'){
				respon = 'Tidak Aktif';
			}
			else if(status=='Tidak Aktif'){
				respon = 'Aktif';
			}
			$('#'+id).html('<img src="<?php echo base_url() ?>/image/loading.gif"/>');
			$.ajax({
				type:"POST",
				url:"<?php echo base_url() ?>index.php/admin_kelas/status_kelas",
				data:"id="+id+"&status="+respon,
				success: function(data){
					$('#'+id).html(data);
				}
			});
			return false;
		});
	});
</script>
<style>
	.status{
		cursor:pointer;
		text-align:center;
	}
</style>

<div class="col-lg-12">
	<h1 class="page-header">Kelas</h1>
</div>
<div class="col-lg-12">
	<?php echo anchor('admin_kelas/tambah_kelas','Tambah Kelas','class="btn btn-primary"') ?>
	<table class="table table-responsive table-hover table-bordered">
    	<thead>
        	<tr>
        		<th width="70">No</th>
        		<th width="200">ID Kelas</th>
        		<th>Kelas</th>
				<th width="150">Status</th>
        		<th width="150">Pilihan</th>
            </tr>
        </thead>
        <tbody>
        <?php
			$i=0;
			foreach($kelas as $rz){
				$i++;
				$status="Aktif";
				if($rz->kls_status==0){
					$status = "Tidak Aktif";
				}

				$cek1 = $this->models->cekdata('penjadwalan','id_kelas',$rz->id_kelas);

				$title = 'hapus';
				if ($cek1!=0) {
					$title ='Tidak bisa hapus';
				}
		?>
        	<tr>
        		<td><?php echo $i ?></td>
        		<td><?php echo $rz->id_kelas ?></td>
        		<td><?php echo $rz->kelas ?></td>
        		<td class="status" id="<?php echo $rz->id_kelas ?>"><?php echo $status ?></td>
        		<td>
					<?php echo anchor('admin_kelas/edit_kelas/'.$rz->id_kelas,'<i class="glyphicon glyphicon-edit"></i> Edit','title="Edit"') ?>
                	<a href="#" title="<?php echo $title ?>"  style="margin-left:10px;" class="hapus"><i class="glyphicon glyphicon-remove"></i> Hapus<input type="hidden" value="<?php echo base_url() ?>index.php/admin_kelas/hapus_kelas/<?php echo $rz->id_kelas ?>"></a>
                </td>
        	</tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="halaman"><?php //echo $halaman ?></div>
</div>