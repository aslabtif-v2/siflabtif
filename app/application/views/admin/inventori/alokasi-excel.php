<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Inventori-Laboratorium.xls");
	/*header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");;
	header("Content-Disposition: attachment;filename=filename.xls");
	header("Content-Transfer-Encoding: binary ");*/
	$bulan = array("","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$tgl = explode('-',$date);
?>
<table>
	<tr>
		<td colspan="8" align="center"><b><?php echo $labtif ?> INVENTORI</b></td>
	</tr>
	<tr>
		<td colspan="8" align="center"><b>PERIODS : <?php echo $bulan[$tgl[1]-0].' '.$tgl[0] ?></b></td>
	</tr>
	<tr>
		<td colspan="8" align="center">&nbsp;</td>
	</tr>
</table>
<table class="table" border="1">
<thead>
	<tr class="alert-info">
		<th rowspan="2">NO</th>
		<th rowspan="2">TYPE</th>
		<th rowspan="2">MEREK</th>
		<th colspan="4">KONDISI</th>
	</tr>
	<tr class="alert-info">
	<?php
	if($this->input->post('lab')==''){
			echo "<th>BARU</th>";
		}	
	?>
		<th>BAGUS</th>
		<th>RUSAK</th>
		<th>HILANG</th>
		<th>Total Barang</th>
	</tr>
</thead>
<tbody>
<?php
	$no=0;
	foreach($laporan as $l){
		$no++;
		echo
		"<tr>
			<td class='text-center'>$no</td>
			<td>$l->barang</td>
			<td>$l->merek</td>";
		
		if($this->input->post('lab')==''){
			echo "<td class='text-center'>$l->baru_qtty</td>";
		}	
		echo "<td class='text-center'>$l->bagus_qtty</td>
			<td class='text-center'>$l->rusak_qtty</td>
			<td class='text-center'>$l->hilang_qtty</td>";
		
		if($this->input->post('lab')==''){
			echo "<td class='text-center'>$l->baru_ori</td>";
		}
		else{
			echo "<td class='text-center'>".($l->bagus_qtty+$l->rusak_qtty+$l->hilang_qtty)."</td>";
		}
		echo "
		</tr>
		";
	} 
?>
</tbody>
</table>