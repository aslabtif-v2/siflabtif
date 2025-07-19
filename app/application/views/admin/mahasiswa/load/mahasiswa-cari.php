<?php
	$i=0;
	foreach($mhs as $rz){
	$i++;

    $cek1 = $this->models->cekdata('registrasi_praktikum','npm',$rz->npm);

    $title = 'hapus';
    if ($cek1!=0) {
        $title ='Tidak bisa hapus';
    }
?>
	<tr>
		<td><?php echo $i ?></td>
		<td><?php echo $rz->npm ?></td>
		<td><?php echo anchor('admin_cetak/nilai_mahasiswa/'.$rz->npm,$rz->nama,'target="_blank"') ?></td>
		<td><?php echo $rz->kelas ?></td>
		<td>
			<?php echo anchor('admin_mahasiswa/edit_mhs/'.$rz->npm,'<i class="glyphicon glyphicon-edit"></i> Edit','title="Edit"') ?>
			<a href="#" title="<?php echo $title ?>"  style="margin-left:10px;" class="hapus"><i class="glyphicon glyphicon-remove"></i> Hapus<input type="hidden" value="<?php echo base_url() ?>index.php/admin_mahasiswa/hapus_mhs/<?php echo $rz->npm ?>"></a>
		</td>
	</tr>
<?php 
	}
	if($i==0){
		echo "
		<tr class='alert alert-warning'>
			<td colspan='5' align='center'>Data tidak ada</td>
		</tr>
		";
	}
	echo "<script src='".base_url()."assets/js/konfirmasi-hapus.js'></script>";
?>