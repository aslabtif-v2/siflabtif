<div class="col-md-12">
	<h2 class="page-header">Catatan</h2>
</div>
<div class="col-md-12">
    <div class="col-md-6 panel panel-default panel-body catatan">
        <?php echo $catatan->nama_cat ?>
    </div>
    <div class="col-md-12 panel panel-default panel-body catatan">
        <?php echo $catatan->catatan ?>
    </div>
	<div class="row">
        <div class="col-md-4 jarak-atas">
            <?php echo anchor('admin_catatan/listt/'.$catatan->id_asisten,'OK','class="btn btn-primary"') ?>  
        </div>
	</div>            
</div>
