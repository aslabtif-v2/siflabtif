<script>
	$(document).ready(function(e) {
        $('.cari').keyup(function(){
			$('.loading-cari').show();
			var cari = $('.cari').val();
			var berdasarkan = $('.berdasarkan').val();
			if(berdasarkan==''){
				alert('Pilih cari berdasarkan');
				$('.loading-cari').hide();
				return false;	
			}
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url() ?>index.php/admin_mahasiswa/cari',
				data: 'cari='+cari+'&berdasarkan='+berdasarkan,
				success: function(data) {
					$('tbody').html(data);
					$('.loading-cari').hide();
				}
			});
		});
		
    });
</script>
<style>
	.form-control{width:200px;float:right;margin-left:20px;}
	.loading-cari{float:right;margin-right:50px;display:none;}
</style>
<div class="col-md-12">
	<h1 class="page-header">Mahasiswa</h1>
</div>
<div class="col-md-12">
	<?php echo anchor('admin_mahasiswa/tambah_mhs','Tambah Mahasiswa','class="btn btn-primary"') ?>
    <input type="text" name="cari" class="form-control cari" placeholder="Cari..." />
    <select class="form-control berdasarkan">
    	<option value="">--Cari Berdasarkan--</option>
    	<option value="nama">Nama</option>
    	<option value="npm">NPM</option>
    </select>
    <span class="loading-cari"><img class="" src="<?php echo base_url() ?>image/loading2.gif" /> &nbsp; Memcari...</span>
	<table class="table table-responsive table-hover table-bordered">
    	<thead>
        	<tr>
        		<th width="50">No</th>
        		<th width="150">NPM</th>
        		<th>Nama</th>
        		<th>Kelas</th>
        		<th width="150">Pilihan</th>
            </tr>
        </thead>
        <tbody>
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
        <?php } ?>
        </tbody>
    </table>
    <div class="halaman"><?php echo $halaman; ?></div>
</div>