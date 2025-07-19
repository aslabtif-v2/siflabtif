<div class="col-lg-12">
	<h1 class="page-header">Jabatan</h1>
</div>
<div class="col-lg-12">
	<?php echo anchor('admin_jabatan/tambah_jabatan','Tambah Jabatan','class="btn btn-primary"') ?>
	<table class="table table-bordered table-hover">
    	<thead>
        	<tr>
            	<th width="70">No</th>
            	<th>Jabatan</th>
            	<th>Honor/Pertemuan</th>
            	<th>Honor/Bulan</th>
            	<th width="150">Pilihan</th>
            </tr>
        </thead>
        <tbody>
        <?php
			$i=0;
			foreach($jabatan as $rz){
			$i++;

            $cek1 = $this->models->cekdata('asisten','id_jabatan',$rz->id_jabatan);
            $cek2 = $this->models->cekdata('ruangan','id_jabatan',$rz->id_jabatan);

            $title = 'hapus';
            if ($cek1!=0 || $cek2!=0) {
                $title ='Tidak bisa hapus';
            }
		?>
        	<tr>
            	<td><?php echo $i ?></td>
            	<td><?php echo $rz->jabatan ?></td>
            	<td>Rp. <?php echo number_format($rz->honor_pertemuan,0,'','.'); ?></td>
            	<td>Rp. <?php echo number_format($rz->honor_perbulan,0,'','.');  ?></td>
            	<td>
                	<?php echo anchor('admin_jabatan/edit_jabatan/'.$rz->id_jabatan,'<i class="glyphicon glyphicon-edit"></i> Edit','title="Edit"') ?>
                    <a href="#" title="<?php echo $title ?>"  style="margin-left:10px;" class="hapus"><i class="glyphicon glyphicon-remove"></i> Hapus<input type="hidden" value="<?php echo base_url() ?>index.php/admin_jabatan/hapus_jabatan/<?php echo $rz->id_jabatan ?>"></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>