    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/textarea.js"></script> 
	<script type="text/javascript">
		bkLib.onDomLoaded(function() {
		new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('area4');
    	});
    </script>
<style>
.status{text-align:center;cursor:pointer;}
.simpan, .kembali{margin-top:20px;}
</style>
<div class="col-md-12">
	<h3 class="page-header">Tambah Informasi</h3>
</div>
<div class="col-md-12 table-responsive">
    <div class="panel panel-default" style="width:100%;margin:auto;">
    	<div class="panel-body">
        	<?php echo form_open('asisten_informasi/post_informasi') ?>
                <textarea rows="10" id="area4" class="form-control" name="informasi"></textarea>
                <button type="submit" class="btn btn-success simpan">Simpan</button>
                <?php echo anchor('asisten_informasi','Kembali','class="btn btn-default kembali"') ?>
            </form>
    	</div>
    </div>
</div>
