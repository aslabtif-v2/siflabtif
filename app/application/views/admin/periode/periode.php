<div class="col-sm-12">
	<h1 class="page-header">Periode</h1>
</div>
<div class="col-sm-12">
	<?php echo anchor('admin_periode/tambah','Tambah Periode','class="btn btn-primary"') ?>
	<table class="table table-responsive table-hover table-bordered">
    	<thead>
        	<tr>
        		<th width="70">No</th>
        		<th>Periode</th>
        		<th width="150">Pilihan</th>
            </tr>
        </thead>
        <tbody>
        <?php
			$i=0;
			foreach($periode as $rz){
			$i++;

            $cek1 = $this->models->cekdata('penjadwalan','pr_id',$rz->pr_id);
            $title = 'hapus';
            if ($cek1!=0) {
                $title ='Tidak bisa hapus';
            }
		?>
        	<tr>
        		<td><?php echo $i ?></td>
        		<td><?php echo anchor('admin_jadwal/periode/'.$rz->pr_id,$rz->pr_periode) ?></td>
        		<td>
					<?php echo anchor('admin_periode/edit/'.$rz->pr_id,'<i class="glyphicon glyphicon-edit"></i> Edit','title="Edit"') ?>
                	<a href="#" title="<?php echo $title ?>"  style="margin-left:10px;" class="hapus"><i class="glyphicon glyphicon-remove"></i> Hapus<input type="hidden" value="<?php echo base_url() ?>index.php/admin_periode/hapus/<?php echo $rz->pr_id ?>"></a>
                </td>
        	</tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="halaman"><?php echo $halaman ?></div>
</div>