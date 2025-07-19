<div class="col-sm-12">
	<h2 class="page-header">Inventori Laboratorium</h2>
</div>
<div class="col-sm-12">
	<?php
		$jabatan = $_SESSION['jabatan'];
		if($jabatan=='koordinatorlab'){
			echo '
			<a href="'.base_url('index.php/admin_inventori/laporan').'" class="btn-menu">
				<img class="icon-btn-menu" src="'.base_url('image/inventory-laporan.png').'">
				<p class="btn-menu-text">Laporan Inventori Laboratorium</p>
			</a>
			';
		}
		else{
			if($jabatan=='teknisilab'){
				echo '
				<a href="'.base_url('index.php/admin_inventori/barang').'" class="btn-menu">
					<img class="icon-btn-menu" src="'.base_url('image/inventory-barang.png').'">
					<p class="btn-menu-text">Data Master Barang</p>
				</a>';
			}
			echo '
			<a href="'.base_url('index.php/admin_inventori/pc').'" class="btn-menu">
				<img class="icon-btn-menu" src="'.base_url('image/inventory.png').'">
				<p class="btn-menu-text">Alokasi Komponen & PC Laboratorium</p>
			</a>
			<a href="'.base_url('index.php/admin_inventori/alokasi').'" class="btn-menu">
				<img class="icon-btn-menu" src="'.base_url('image/inventory-alokasi.png').'">
				<p class="btn-menu-text">Alokasi Barang Laboratorium</p>
			</a>
			<a href="'.base_url('index.php/admin_inventori/laporan').'" class="btn-menu">
				<img class="icon-btn-menu" src="'.base_url('image/inventory-laporan.png').'">
				<p class="btn-menu-text">Laporan Inventori Laboratorium</p>
			</a>
			';
		}
	?>
</div>