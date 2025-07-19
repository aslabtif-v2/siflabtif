<div class="col-lg-12">
	<h1 class="page-header">Ruangan</h1>
</div>
<div class="col-lg-12">
	<?php echo anchor('admin_ruangan/tambah_ruangan','Tambah Ruangan','class="btn btn-primary"') ?>
	<table class="table table-bordered table-hover">
    	<thead>
        	<tr>
            	<th width="70">Nomor</th>
                <th>Ruangan</th>
                <th width="150">Plilihan</th>
            </tr>
        <tbody>
        <?php 
			$i=0; 
			foreach($ruangan as $rz){ 
			$i++;

            $cek1 = $this->models->cekdata('penjadwalan','id_ruangan',$rz->id_ruangan);
            $cek2 = $this->models->cekdata('inv_alokasi','id_ruangan',$rz->id_ruangan);
            $cek3 = $this->models->cekdata('inv_pc','id_ruangan',$rz->id_ruangan);

            $title = 'hapus';
            if ($cek1!=0 || $cek2!=0 || $cek3!=0) {
                $title ='Tidak bisa hapus';
            }
		?>
        	<tr>
            	<td><?php echo $i ?></td>
            	<td><?php echo $rz->ruangan ?></td>
            	<td>
					<?php echo anchor('admin_ruangan/edit_ruangan/'.$rz->id_ruangan,'<i class="glyphicon glyphicon-edit"></i> Edit','title="Edit"') ?>
                    <a href="#" title="<?php echo $title ?>"  style="margin-left:10px;" class="hapus"><i class="glyphicon glyphicon-remove"></i> Hapus<input type="hidden" value="<?php echo base_url() ?>index.php/admin_ruangan/hapus_ruangan/<?php echo $rz->id_ruangan ?>"></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>