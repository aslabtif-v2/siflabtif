<div class="col-lg-12">
	<h1 class="page-header">Mata Praktikum</h1>
</div>
<div class="col-lg-12">
	<?php echo anchor('admin_mata_praktikum/tambah_matkum','Tambah Mata Praktikum','class="btn btn-primary"') ?>
	<table class="table table-bordered table-hover">
    	<thead>
        	<tr>
            	<th width="70">No</th>
            	<th>Mata Praktikum</th>
            	<th width="150">Pilihan</th>
            </tr>
        </thead>
        <tbody>
        <?php
			$i=0;
			foreach($matkum as $rz){
			$i++;

            $cek1 = $this->models->cekdata('penjadwalan','id_matkum',$rz->id_matkum);

            $title = 'hapus';
            if ($cek1!=0) {
                $title ='Tidak bisa hapus';
            }
		?>
        	<tr>
            	<td><?php echo $i ?></td>
            	<td><?php echo $rz->mata_praktikum ?></td>
            	<td>
                	<?php echo anchor('admin_mata_praktikum/edit_matkum/'.$rz->id_matkum,'<i class="glyphicon glyphicon-edit"></i> Edit','title="Edit"') ?>
                    <a href="#" title="<?php echo $title ?>"  style="margin-left:10px;" class="hapus"><i class="glyphicon glyphicon-remove"></i> Hapus<input type="hidden" value="<?php echo base_url() ?>index.php/admin_mata_praktikum/hapus_matkum/<?php echo $rz->id_matkum ?>"></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>