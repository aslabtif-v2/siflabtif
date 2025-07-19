<script>
	$(document).ready(function(e) {
    	$('.status',this).click(function(){
			var status = $(this).html();
			var id=$(this).attr('id');
			var respon;
			//alert(status+' '+id);
			if(status=='Ditampilkan'){
				respon = 'Tidak Ditampilkan';
			}
			else{
				respon = 'Ditampilkan';
			}
			$('#'+id).html('<img src="<?php echo base_url() ?>/image/loading.gif"/>');
			$.ajax({
				type:"POST",
				url:"<?php echo base_url() ?>index.php/admin_informasi/status_informasi",
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
.status{text-align:center;cursor:pointer;}
</style>
<div class="col-lg-12">
	<h1 class="page-header">Informasi</h1>
</div>
<div class="col-lg-12 table-responsive">
	<?php echo anchor('admin_informasi/tambah_informasi','Tambah Informasi','class="btn btn-primary"') ?>
	<table class="table table-bordered table-hover">
    	<thead>
        	<th>No</th>
        	<th>Informasi</th>
        	<th width="200">Dari</th>
        	<th width="150">Tanggal</th>
            <th width="150">Status</th>
        	<th width="140">Pilihan</th>
        </thead>
        <tbody>
        <?php
			$no = 0;
			foreach($informasi as $info){
				$no++;
				$tgl = explode('-',$info->tanggal);
				$psn ='';
				if(strlen($info->informasi)>100){
					$psn = '....';
				}
				$status = 'Tidak Ditampilkan';
				if($info->status==1){
					$status = 'Ditampilkan';	
				}
		?>
        	<tr>
            	<td><?php echo $no ?></td>
            	<td><?php echo substr($info->informasi,0,100).' '.$psn ?></td>
            	<td><?php echo $info->jabatan ?></td>
            	<td><?php echo $tgl[2].' '.$namaBulan[$tgl[1]-1].' '.$tgl[0]; ?></td>
                <td class="status" id="<?php echo $info->id_informasi ?>"><?php echo $status ?></td>
                <td>
					<?php echo anchor('admin_informasi/edit_informasi/'.$info->id_informasi,'<i class="glyphicon glyphicon-edit"></i> Edit','title="Edit"') ?>
                	<a href="#" title="hapus"  style="margin-left:10px;" class="hapus"><i class="glyphicon glyphicon-remove"></i> Hapus<input type="hidden" value="<?php echo base_url() ?>index.php/admin_informasi/hapus_informasi/<?php echo $info->id_informasi ?>"></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>