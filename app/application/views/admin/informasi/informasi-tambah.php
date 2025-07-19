<script type="text/javascript" src="<?php echo base_url() ?>assets/js/textarea.js"></script> 
<script type="text/javascript">
	bkLib.onDomLoaded(function() {
	new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('area4');
	});
</script>
<style>
.status{text-align:center;cursor:pointer;}
.panel-default{width:70%;margin:auto;}
</style>
<div class="col-lg-12">
	<h1 class="page-header">Tambah Informasi</h1>
</div>
<div class="col-lg-12 table-responsive">
    <div class="panel panel-default">
    	<div class="panel-body">
        	<?php echo form_open('admin_informasi/post_informasi') ?>
                <textarea cols="50" id="area4" class="form-control" name="informasi"></textarea>
                <button type="submit" class="btn btn-success simpan">Simpan</button>
                <?php echo anchor('admin_informasi','Kembali','class="btn btn-default kembali"') ?>
            </form>
    	</div>
    </div>
</div>
