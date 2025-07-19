<style>
	.input-medium{width:150px;border-radius:5px 5px 5px 5px; color:#666;}
	.atas{width:100%;float:left;margin-bottom:5px;}
	.col-lg-5,.col-lg-7{padding-left:0px;}
	.kiri1{width:150px;float:left;margin-left:0px;}
	.kiri2{width:180px;float:left;}
	.kehadiran{text-align:center; cursor:pointer;}
	.table-bordered{float:left;margin-top:0px;}
	.notiff{bottom:0px; right:5px; position:fixed;}
	.notifff{bottom:0px; right:5px; position:fixed;}
</style>
<script>
	$(document).ready(function(e) {
    	$('.id_praktikum').change(function(){
			var id_praktikum = $('.id_praktikum').val();
			if(id_praktikum!=''){
				window.location.href='<?php echo base_url() ?>index.php/admin_registrasi/pindah_praktikum/'+id_praktikum;				
			}
			else{
				window.location.href='<?php echo base_url() ?>index.php/admin_registrasi/pindah';	
			}
		});
		$('.cek-pindah').submit(function(){
			var id = $('.praktikum_ke').val();
			if(id=='<?php echo $id_praktikum ?>'){
				alert('Cek kembali Pindah ke ID Praktikum');
				return false;	
			}
		});
		$('.notiff').delay(5000).fadeOut('slow');
		$('.notifff').delay(7000).fadeOut('slow');
	});
</script>

<div class="col-lg-12">
	<h1 class="page-header">Pindah Praktikum</h1>
</div>
<div class="col-lg-12">
	<?php echo form_open('admin_registrasi/simpan_pindah_praktikum','class="cek-pindah"') ?>
        <div class="atas alert alert-warning" style="margin-bottom:20px;">
            <div class="atas">
                <div class="kiri1">
                    <b>Pilih ID Praktikum</b>
                </div>
                <div class="kiri2">
                    <select name="praktikum_dari" class="input-medium id_praktikum">
                        <?php 
                            foreach($praktikum as $rz){ 
                                if($rz->id_praktikum==$id_praktikum){
                                    $pilih = 'selected';
                                }
                                else{
                                    $pilih ='';
                                }
                                echo "<option value='$rz->id_praktikum' $pilih>".strtoupper($rz->id_praktikum)."</option>";
                            } 
                        ?>
                    </select>
                </div>
                <div class="kiri1" style="width:100px;">
                    <b>Pindah Ke</b>
                </div>
                <div class="kiri2">
                    <select name="praktikum_ke" class="input-medium praktikum_ke">
                        <?php 
                            foreach($praktikum as $rz){ 
                                if($rz->id_praktikum==$id_praktikum){
                                    $pilih = 'selected';
                                }
                                else{
                                    $pilih ='';
                                }
                                echo "<option value='$rz->id_praktikum' $pilih>".strtoupper($rz->id_praktikum)."</option>";
                            } 
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <th width="70">No</th>
                <th>NPM</th>
                <th>Nama</th>
                <th width="120">Kehadiran (%)</th>
                <th width="50">Tandai</th>
                <th width="50">Aksi</th>
            </thead>
            <tbody>
            <?php
                $shift = $this->uri->segment(3);
                $i=0;
                foreach($mahasiswa as $mhr){
                $i++;
    
                $hadir = $this->admin_penilaian_models->kehadiran($id_praktikum,$mhr->npm);
                $kehadiran = $hadir->kehadiran * 10;
            ?>
                <tr class="tr-nilai" id="<?php echo $mhr->id_registrasi ?>">
                    <td><?php echo $i ?></td>
                    <td><?php echo $mhr->npm ?></td>
                    <td><?php echo $mhr->nama ?></td>
                    <td class="hadir<?php echo $mhr->id_registrasi ?> kehadiran"><?php echo $kehadiran ?></td>
                    <td class="tugas text-center">
                        <input type="checkbox" value="<?php echo $mhr->npm ?>" name="pilih[]" />
                    </td>
                    <td class="text-center">
                        <a href="#" title="hapus" class="hapus">
                            <i class="glyphicon glyphicon-remove"></i>
                            <input type="hidden" value="<?php echo base_url('index.php/admin_registrasi/hapus/'.$shift.'/'.$mhr->npm) ?>">
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>        
        <input type="submit" class="btn btn-success" value="Simpan">
    </form>
</div>

<?php
	$ket1 = $this->uri->segment(3);
	$ket2 = $this->uri->segment(4);
	if($ket2=='ok'){
		echo '<div class="alert alert-info notiff">Data tersimpan.</div>';	
	}
	else if(!empty($ket2)){
		echo "<div class='alert alert-danger notifff'>Data gagal tersimpan.<br>Jumlah pertemuan praktikum $ket1 <br>tidak sama dengan jumlah praktikum $ket2</div>";	
	}
?>