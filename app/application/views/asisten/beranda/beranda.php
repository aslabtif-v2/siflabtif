<style>
.tanggal-info{
	float:right;
	width:100%;
	margin-top:-22px;
	margin-right:5px;
	
}
.jabatan{padding-top:20px;}
</style>
<div class="col-md-12">
	<h2 class="page-header">Selamat Datang....</h2>
</div>
<div class="col-md-12">
	<div style="margin-bottom:20px;">
		Sekarang <?php echo $hari.', '.date('d').' '.$bulan.' '.date('Y') ?>
    </div>
	<?php		  
		//biodata belum di isi
		$tgl = explode('-',$asisten->tgl_lhr);
		if($tgl[2]==00&&$tgl[1]==00){
			echo "
				<div class='alert alert-danger'>
					<i class='glyphicon glyphicon-warning-sign'></i> &nbsp; ".anchor('asisten_biodata/edit_asisten/'.$_SESSION['id_asisten'],$_SESSION['nama'])." mohon lengkapi biodata anda. Terimakasih
				</div>
			";			
		}
		//info ultah
		if($tgl[2]==date('d')&&$tgl[1]==date('m')){
			$my =  "
				  <div class='alert alert-danger alert-dismissable'>
					  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					  <i class='glyphicon glyphicon-gift'></i> Selamat ulang tahun <b>$asisten->nama</b>. Semoga menjadi lebih baik dan semakin berprestasi....
				  </div>";
		}
		$cek=0;
		foreach($semua_asisten as $asis){
			$tanggal = explode('-',$asis->tgl_lhr);
			if($tanggal[2]==date('d')&&$tanggal[1]==date('m')){
				$lahir[$cek] = $asis->id_asisten;
				$cek++;
			}
		}
		if($cek>0){
			foreach($lahir as $id_as){
				if($id_as==$_SESSION['id_asisten']){
					echo $my;
				}
				else{
					$ultah = $this->models->where1Row('asisten','id_asisten',$id_as);
					echo "
						<div class='alert alert-warning alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<i class='glyphicon glyphicon-gift'></i> Hari ini <b>$ultah->nama</b> berulang tahun.
						</div>";
				}
			}
		}	
		//infotmasi
		foreach($informasi as $info){
			$tgl = explode('-',$info->tanggal);
			if(($tgl[0]==date('Y'))&&($tgl[1]==date('m'))&&($tgl[2]==date('d'))){
				$waktu = 'Hari ini';
			}
			else if(($tgl[0]==date('Y'))&&($tgl[1]==date('m'))&&($tgl[2]==date('d')-1)){
				$waktu = 'Kemarin';	
			}
			else{
				$waktu = $tgl[2].' '.$namaBulan[$tgl[1]-1].' '.$tgl[0];
			}
			echo "<div class='alert alert-info alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<p class='tanggal-info'><span style='float:right;margin-bottom:3px;'>".$waktu."</span></p>
					<p>$info->informasi</p>
					<p class='jabatan'><b>$info->jabatan</b></p>
				  </div>";
		}
		
	?>
</div>
