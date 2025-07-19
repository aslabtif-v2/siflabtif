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
				url: '<?php echo base_url() ?>index.php/asisten_mahasiswa/cari',
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
    <input type="text" name="cari" class="form-control cari" placeholder="Cari..." />
    <select class="form-control berdasarkan">
    	<option value="">--Cari Berdasarkan--</option>
    	<option value="nama">Nama</option>
    	<option value="npm">NPM</option>
    </select>
    <span class="loading-cari"><img class="" src="<?php echo base_url() ?>image/loading2.gif" /> &nbsp; Memcari...</span>
	<table class="table table-responsive table-hover table-bordered" style="float:left; margin-top:30px;">
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
		?>
        	<tr>
        		<td><?php echo $i ?></td>
        		<td><?php echo $rz->npm ?></td>
        		<td><?php echo $rz->nama ?></td>
        		<td><?php echo $rz->kelas ?></td>
        		<td align="center"><?php echo anchor('admin_cetak/nilai_mahasiswa/'.$rz->npm, 'Cetak Nilai','target="_blank"') ?></td>
        	</tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="halaman"><?php echo $halaman; ?></div>
</div>