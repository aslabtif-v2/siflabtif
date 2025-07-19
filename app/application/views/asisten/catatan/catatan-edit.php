<script type="text/javascript" src="<?php echo base_url() ?>assets/js/textarea.js"></script> 
<script type="text/javascript">
	bkLib.onDomLoaded(function() {
	new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('area4');
	});
</script>
<div class="col-md-12">
	<h2 class="page-header">Tambah Catatan</h2>
</div>
<div class="col-md-12">
	<div class="row">
		<?php 
			echo form_open('asisten_catatan/update');
			echo form_hidden('id_cat',$catatan->id_cat);
		?>
            <div class="col-md-6">
                <input type="text" name="namacat" value="<?php echo $catatan->nama_cat ?>" placeholder="Nama Catatan" class="form-control w8">
            </div>
            <div class="col-md-12 jarak-atas">
                <textarea rows="10" id="area4" class="form-control" placeholder="Isi Catatan" name="catatan"><?php echo $catatan->catatan ?></textarea>
            </div>
            <div class="col-md-4 jarak-atas">
                <button type="submit" class="btn btn-success">Simpan</button>
                <?php echo anchor('asisten_catatan','Kembali','class="btn btn-default jarak-kiri"') ?>    
            </div>
    	</form>
    </div>
</div>
