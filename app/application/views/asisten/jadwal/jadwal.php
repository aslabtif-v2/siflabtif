<script>
	$(document).ready(function(e) {
		$('.hari').change(function(){
			var hari = $('.hari').val();
			if(hari!=''){
				window.location.href='<?php echo base_url() ?>index.php/asisten_jadwal_praktikum/hari/'+hari;				
			}
			else{
				return false;
			}
		});
	});
</script>
<link href="<?php echo base_url() ?>assets/css/plugins/timeline/timeline.css" rel="stylesheet">
<div class="col-md-12">
	<h2 class="page-header">Jadwal Praktikum</h2>
</div>
<style>
	.input-medium{width:150px; border-radius:5px 5px 5px 5px; color:#4D4D4D;}
	.atas{width:100%;float:left;margin-bottom:5px;}
	.kiri1{width:110px;float:left;margin-left:0px;}
	.kiri2{width:230px;float:left;}
</style>
<?php
	$hr = array("Senin", "Selasa", "Rabu", "Kamis", "Jumat","Sabtu");
?>
<div class="col-md-12">
	<div class="atas alert alert-info">
        <div class="kiri1">
            <b>Pilih Hari</b>
        </div>
        <div class="kiri2">
            <select class="input-medium hari">
                <option value="">--Hari--</option>
                <?php 
                foreach($hr as $hri){
                    if($hri==$hari){
                        $pilih = 'selected';
                    }
                    else{
                        $pilih = '';	
                    }
                    echo "<option $pilih>$hri</option>";
                }
                ?>
            </select>
        </div>
	</div>  
</div>
<div class="col-md-12">
    <div class="panel panel-default">
    	<div class="panel-heading">
        	<i class="fa fa-clock-o fa-fw"></i> Jadwal Praktikum Hari ini <?php echo $hari.', '.date('d').' '.$bulan.' '.date('Y') ?>
        </div>
        <div class="panel-body">
			<ul class="timeline">
            <?php
				foreach($penjadwalan as $jadwal){
					$ass1 = $this->models->where2('asisten','id_asisten','status',$jadwal->pengajar1,1);
					$ass2 = $this->models->where2('asisten','id_asisten','status',$jadwal->pengajar2,1);
					$pertemuan = $this->admin_jadwal_models->pertemuan($jadwal->id_praktikum);
					$posisi = '';
					if($jadwal->id_ruangan==1){
						$posisi = 'timeline-inverted';
					}
					$warna = '';
					if($jadwal->id_ruangan==1){
						$warna = 'warning';
						$lab = 'LD';
					}
					else if($jadwal->id_ruangan==3){
						$warna = 'danger';
						$lab = 'LJ';
					}
					else if($jadwal->id_ruangan==4){
						$warna = 'info';
						$lab = 'LM';
					}
					$jamP = explode('-',$jadwal->jam);
					$waktuPD = $jamP[0];
					$waktuPS = $jamP[1];
					$skg = '';
					$status = '';
					if(date('H.i')>=$waktuPD && date('H.i')<=$waktuPS){
						$skg = 'Sekarang';
						$status = 'alert-info';
					}
			?>
                    <li class="<?php echo $posisi ?>">
                        <div class="timeline-badge  alert-info <?php echo $warna ?>"><?php echo $lab ?></div>
                        <div class="timeline-panel <?php echo $status ?>">
                            <div class="timeline-heading">
                                <h4 class="timeline-title"><?php echo $jadwal->mata_praktikum ?></h4>
                                <p><small class="text-muted"><i class="fa fa-clock-o fa-fw"></i> <?php echo $jadwal->jam.' '.$skg ?></small></p>
                            </div>
                            <div class="timeline-body">
                                <p>
                                	Kelas : <?php echo $jadwal->kelas ?><br />
                                	Pengajar 1 : <b><?php foreach($ass1 as $asss1){echo $asss1->nama;} ?></b><br />
                                	Pengajar 2 : <b><?php foreach($ass2 as $asss2){echo $asss2->nama;} ?></b><br />
                                    Pertemuan : <?php echo $pertemuan->pertemuan ?>
                                </p>
                            </div>
                        </div>
                    </li>
			<?php
				}
			?>
            </ul>
        </div>
    </div>
</div>