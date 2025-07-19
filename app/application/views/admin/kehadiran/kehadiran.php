<script>
	$(function(){
		$('.pilih-asisten').change(function(){
			var id_asisten = $('.pilih-asisten').val();
			if(id_asisten!=''){
				window.location.href='<?php echo base_url() ?>index.php/admin_kehadiran_asisten/cek/'+id_asisten;				
			}
			else{
				window.location.href='<?php echo base_url() ?>index.php/admin_kehadiran/asisten/cek';
			}
		});
	});
</script>
<style>
	.input-medium{width:150px;}
	.atas{width:100%;float:left;margin-bottom:5px;}
	.col-md7{padding-left:0px;}
	.kiri1{width:220px;float:left;margin-top:5px;}
	.kiri2{width:250px;float:left;}
	.table{font-size:14px;}
	.table th{
		text-align:center;
	}
	.icon-absen{width:20px;}
	.pilih-asisten{
		width:200px;
	}
</style>
<div class="col-md-12">
	<h2 class="page-header">Kehadiran Asisten</h2>
</div>
<div class="col-md-12">
	<div class="atas alert alert-info" style="margin-bottom:20px;">
        <b class="kiri1">Kehadiran Praktikum Asisten :</b>
		<select class="form-control kiri2 pilih-asisten">
		<?php
			echo "<option value=''>--Pilih Asisten--</option>";
			foreach($asisten as $ast){
				$pilih='';
				if($id_asisten==$ast->id_asisten){
					$pilih='selected';
				}
				echo "<option $pilih value='$ast->id_asisten'>$ast->nama</option>";
			}
		?>
		</select>
    </div>     
	<table class="table table-bordered">
	<?php
		echo "
		<thead>
			<tr class='alert alert-info'>";
		for($k=0;$k<=10;$k++)
		{
			if($k==0){
				echo "<td><b>Praktikum / Kehadiran</b></td>";
			}
			else{
				echo "<th>$k</th>";
			}
		}
		echo "
			</tr>
		</thead>";
		foreach($jadwal as $jwl)
		{
		
			echo "<tr>";
			for($k=0;$k<=10;$k++)
			{
				if($k==0){
					echo "<td>".strtoupper($jwl->id_praktikum)."</td>";
				}
				else{
				
					$cek = $this->admin_absen_models->cek_asisten('absensi_asisten',$jwl->id_praktikum,$id_asisten,$k);
					$color="#ff1a1a";
					$icon = "x.png";
					if($cek->hadir==1){
						$color="#00e600";
						$icon = "v.png";
					}
					echo "<td align='center' bgcolor='$color'><img class='icon-absen' src='".base_url('image/'.$icon)."'></td>";
				}
			}
			echo "</tr>";
		}
	?>
	</table>
</div>