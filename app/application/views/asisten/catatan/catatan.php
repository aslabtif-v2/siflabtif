<div class="col-md-12">
	<h2 class="page-header">Catatan</h2>
</div>
<div class="col-md-12">
	<?php echo anchor('asisten_catatan/tambah_catatan','Tambah Catatan','class="btn btn-primary"') ?>
	<table class="table table-bordered table-hover jarak-atas">
    	<thead class="alert-info">
        	<th width="50">No</th>
        	<th width="200">Nama Catatan</th>
        	<th>Catatan</th>
        	<th width="150">Tanggal</th>
            <th width="90">Aksi</th>
        </thead>
        <tbody>
        	<?php
				$no = 0;
				foreach($catatan as $item){
					$no++;
					$tanggal = explode('-',$item->tanggal);
					//nama catatan
					if(strlen($item->nama_cat)>20){
						$namaCat = substr($item->nama_cat,0,30).'...';
					}
					else{
						$namaCat = $item->nama_cat;
					}
					//isi catatan
					if(strlen($item->catatan)>90){
						$Cat = substr($item->catatan,0,90).'...';
					}
					else{
						$Cat = $item->catatan;
					}
			?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo  $namaCat ?></td>
                        <td><?php echo $Cat ?></td>
                        <td><?php echo $tanggal[2].' '.$namaBulan[$tanggal[1]-1].' '.$tanggal[0] ?></td>
                        <td>
                        	<?php echo anchor('asisten_catatan/lihat/'.$item->id_cat,'<i class="glyphicon glyphicon-open"></i>','title="Lihat"') ?>
							<?php echo anchor('asisten_catatan/edit/'.$item->id_cat,'<i class="glyphicon glyphicon-edit"></i>','title="Edit" class="jarak-kiri"') ?>
                			<a href="#" title="hapus" class="jarak-kiri hapus"><i class="glyphicon glyphicon-remove"></i> <input type="hidden" value="<?php echo base_url() ?>index.php/asisten_catatan/hapus/<?php echo $item->id_cat?>"></a>
                        </td>
                    </tr>
            <?php 
				}
				if($no==0){
					echo "
						<tr class='alert-warning' align='center'><td colspan='5'>Tidak ada catatan</td></tr>
					";	
				}
			?>
        </tbody>
    </table>
</div>
