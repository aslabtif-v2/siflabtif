    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/textarea.js"></script> <script type="text/javascript">
		bkLib.onDomLoaded(function() {
		new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('area4');
    });
    </script>
<style>
.status{text-align:center;cursor:pointer;}
.panel-default{width:70%;margin:auto;}
</style>
<div class="col-lg-12">
	<h1 class="page-header">Edit Informasi</h1>
</div>
<div class="col-lg-12 table-responsive">
    <div class="panel panel-default">
    	<div class="panel-body">
        	<?php 
				echo form_open('admin_informasi/update_informasi') ;
				foreach($informasi as $info){
				echo form_hidden('id_info',$info->id_informasi);		
			?>
                    <textarea cols="50" id="area4" class="form-control" name="informasi"><?php echo $info->informasi ?></textarea>
                    <button type="submit" class="btn btn-warning simpan">Ganti</button>
            <?php 
				} 
				echo anchor('admin_informasi','Batal','class="btn btn-default kembali"') 
			?>
            </form>
    	</div>
    </div>
</div>
