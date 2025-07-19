<div class="col-lg-12">
	<h1 class="page-header">Rekap Kuisioner Mahasiswa</h1>
</div>
<div class="col-lg-12">
	<table class="table table-bordered table-hover">
    	<thead>
        	<tr>
            	<th>No</th>
            	<th>Kode Asisten</th>
				<th>Nama</th>
				<th>Rerata Nilai</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
        <?php
			$i=1;
			foreach($asisten as $value){
			
		?>
        	<tr>
            	<td><?=$i++?></td>
            	<td><?=$value['username']?></td>
				<td><?=$value['nama']?></td>
				<td><?=$value['nilai']?></td>
                <td>
                    <a href="<?=base_url()?>index.php/admin/kuisioner_asisten/<?=$value['username']?>"> <i class="glyphicon glyphicon-search"></i> detail</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>