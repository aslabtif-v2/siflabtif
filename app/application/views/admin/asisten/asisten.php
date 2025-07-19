<script>
$(document).ready(function(e) {
    $('.status',this).click(function(){
        var status = $(this).html();
        var id=$(this).attr('id');
		var respon;
		//alert(status+' '+id);
		if(status=='Aktif'){
			respon = 'Tidak Aktif';
		}
		else{
			respon = 'Aktif';
		}
		$('#'+id).html('<img src="<?php echo base_url() ?>/image/loading.gif"/>');
		$.ajax({
			type:"POST",
			url:"<?php echo base_url() ?>index.php/admin_asisten/status_asisten",
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
	.status{text-align:center; cursor:pointer;}
	.space{margin-left:10px;}
</style>
<div class="col-lg-12">
	<h1 class="page-header">Asisten</h1>
</div>
<div class="col-lg-12">
	<?php echo anchor('admin_asisten/tambah_asisten','Tambah Asisten','class="btn btn-primary"') ?>
	<table class="table table-responsive table-hover table-bordered">
    	<thead>
        	<tr>
        		<th width="70">No</th>
        		<th>Nama</th>
        		<th>Jabatan</th>
        		<th width="150">Status Mengajar</th>
        		<th width="210">Pilihan</th>
            </tr>
        </thead>
        <tbody>
        <?php
			$i=0;
			foreach($asisten as $rz){
			$i++;
			$cek1 = $this->models->cekdata('penjadwalan','pengajar1',$rz->id_asisten);
			$cek2 = $this->models->cekdata('penjadwalan','pengajar2',$rz->id_asisten);

			$title = 'hapus';
			if ($cek1!=0 || $cek2!=0) {
				$title ='Tidak bisa hapus';
			}
		?>
        	<tr>
        		<td><?php echo $i ?></td>
        		<td><?php echo $rz->nama ?></td>
        		<td><?php echo $rz->jabatan ?></td>
        		<td class="status" id="<?php echo $rz->id_asisten ?>"><?php if($rz->status==1){echo 'Aktif';}else{echo 'Tidak Aktif';} ?></td>
        		<td>
					<?php echo anchor('admin_asisten/lihat_asisten/'.$rz->id_asisten,'<i class="glyphicon glyphicon-eye-open"></i> Lihat','title="Lihat Detail"') ?>
					<?php echo anchor('admin_asisten/edit_asisten/'.$rz->id_asisten,'<i class="glyphicon space glyphicon-edit"></i> Edit','title="Edit"') ?>
                	<a href="#" title="<?php echo $title ?>" class="hapus space"><i class="glyphicon glyphicon-remove"></i> Hapus<input type="hidden" value="<?php echo base_url() ?>index.php/admin_asisten/hapus_asisten/<?php echo $rz->id_asisten ?>"></a>
                </td>
        	</tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="halaman"><?php echo $halaman ?></div>
</div>