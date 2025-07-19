<script>
$(document).ready(function(e) {
    $('.status',this).click(function(){
        var status = $(this).html();
        var id=$(this).attr('id');
		var respon;
		if(status=='Aktif'){
			respon = 'Tidak Aktif';
		}
		else{
			respon = 'Aktif';
		}
		$('#'+id).html('<img src="<?php echo base_url() ?>/image/loading.gif"/>');
		$.ajax({
			type:"POST",
			url:"<?php echo base_url() ?>index.php/admin_jadwal/status_jadwal",
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
	.status{cursor:pointer; text-align:center;}
	.space{margin:0px 3px 0px 3px;}
</style>
<?php 
    $uri2 = $this->uri->segment(2);
    $uri3 = $this->uri->segment(3);
?>
<div class="col-lg-12">
	<h3 class="page-header">
        PENJADWALAN PRAKTIKUM
        <?php
            if($uri2!='index'){
                if($uri3!=''){
                    echo $this->models->where1Row('periode','pr_id',$uri3)->pr_periode;
                }
            }
        ?>
    </h3>
</div>
<div class="col-lg-12 table-responsive">
	<?php echo anchor('admin_jadwal/tambah_jadwal/'.$uri3,'Tambah Penjadwalan','class="btn btn-primary kanan-mini"') ?>
    <?php echo anchor('admin_periode/','Kembali','class="btn btn-default"') ?>
    <table class="table table-bordered table-hover table-striped">
    	<thead>
        	<th>No</th>
            <th>ID</th>
        	<th>Pengajar1</th>
        	<th>Pengajar2</th>
        	<th>Kelas</th>
        	<th>Mata Praktikum</th>
        	<th>Hari</th>
        	<th>Jam</th>
        	<th>Ruangan</th>
        	<th>Status Jadwal</th>
        	<th>Plilihan</th>
        </thead>
        <tbody>
        <?php 
			$no=0;
			foreach($jadwal as $rz){
			$no++;

            $cek1 = $this->models->cekdata('registrasi_praktikum','id_praktikum',$rz->id_praktikum);

            $title = 'hapus';
            if ($cek1!=0) {
                $title ='Tidak bisa hapus';
            }
		?>
        	<tr>
            	<td><?php echo $no ?></td>
            	<td><?php echo $rz->id_praktikum; ?></td>
        		<?php
					$asisten1 = $this->models->where1('asisten','id_asisten',$rz->pengajar1);
				?>
            	<td><?php foreach($asisten1 as $pengajar1){echo $pengajar1->nama;}?></td>
        		<?php
					$asisten2 = $this->models->where1('asisten','id_asisten',$rz->pengajar2);
				?>
            	<td><?php foreach($asisten2 as $pengajar2){echo $pengajar2->nama;}?></td>
            	<td><?php echo $rz->kelas; ?></td>
            	<td><?php echo $rz->mata_praktikum; ?></td>
            	<td><?php echo $rz->hari; ?></td>
            	<td><?php echo $rz->jam; ?></td>
            	<td><?php echo $rz->ruangan; ?></td>
            	<td class="status" id="<?php echo $rz->id_praktikum; ?>"><?php  if($rz->status==1){echo 'Aktif';}else{echo 'Tidak Aktif';} ?></td>
            	<td>
                	<?php echo anchor('admin_jadwal/edit_jadwal/'.$rz->id_praktikum,'<i class="glyphicon space glyphicon-edit"></i>','title="Edit"') ?>
                	<a href="#" title="<?php echo $title ?>" class="hapus space"><i class="glyphicon glyphicon-remove"></i><input type="hidden" value="<?php echo base_url() ?>index.php/admin_jadwal/hapus_jadwal/<?php echo $rz->id_praktikum ?>"></a>
                </td>
            </tr>
        <?php 
            } 
            if($no==0){
                echo "<tr class='alert alert-danger'><td colspan='11' class='text-center'><b>Data Kosong</b></td></tr>";
            }
        ?>
        </tbody>
    </table>	
</div>
<div class="halaman"><?php echo $this->pagination->create_links(); ?></div>