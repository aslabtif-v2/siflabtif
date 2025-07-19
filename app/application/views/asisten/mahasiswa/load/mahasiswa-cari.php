<?php
	$i=0;
	foreach($mhs as $rz){
	$i++;
?>
	<tr>
		<td><?php echo $i ?></td>
		<td><?php echo $rz->npm ?></td>
		<td><?php echo $rz->nama ?></td>
		<td><?php echo $rz->kelas ?></td>
		<td align="center"><?php echo anchor('admin_cetak/nilai_mahasiswa/'.$rz->npm, 'Cetak Nilai','target="_blank"') ?></td>
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
?>