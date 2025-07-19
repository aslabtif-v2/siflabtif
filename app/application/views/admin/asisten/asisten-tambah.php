<style>
.form-control{float:right; width:300px;}
.pp{max-width:100%;}
.input-tanggal{width:50px;}
.input-bulan{width:150px; margin:0px 10px 0px 10px;}
.input-tahun{width:80px;}
.simpan{margin:0px 0px 50px 30px;}
.kembali{margin:0px 0px 50px 30px;}
</style>
<div class="col-lg-12">
	<h1 class="page-header">Tambah Asisten</h1>
</div>
<div class="col-lg-12">
	<div class="panel panel-default" style="border-radius:0px 0px 0px 0px;">
        <div class="panel-body">
			<div class="col-lg-6">
				<?php echo form_open_multipart('admin_asisten/post_asisten','class="form-horizontal"') ?>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Username</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" required name="username" placeholder="ID Asisten">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" required name="password" placeholder="Password">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Nama_Asisten</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" required name="nama" placeholder="Nama Asisten">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Jabatan</label>
                      <div class="col-sm-10">
                      	<select name="jabatan" required class="form-control">
                        	<option value="">--Pilih Jabatan--</option>
                            <?php foreach($jabatan as $rz) { ?>
                            <option value="<?php echo $rz->id_jabatan ?>"><?php echo $rz->jabatan ?></option>
                            <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Tanggal_Lahir</label>
                      <div class="col-sm-10">
                        <input type="text" maxlength="4" class="form-control input-tahun" name="tahun" placeholder="Tahun">
                        <select name="bulan" class="form-control input-bulan">
                        	<option value="">--Bulan--</option>
                            <option value="01">Januari</option>
                            <option value="02">Febuari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        <input type="text" maxlength="2" class="form-control input-tanggal" name="tanggal" placeholder="Tgl">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Alamat</label>
                      <div class="col-sm-10">
                        <textarea name="alamat" class="form-control"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Tahun_Masuk</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control" required name="tmasuk" placeholder="Tahun Masuk">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Tahun_Keluar</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control" name="tkeluar" placeholder="Tahun Keluar">
                      </div>
                    </div>
			</div>
            <div class="col-lg-5" style="margin-left:40px; ">
                <div class="panel panel-default" style="height:420px;">
                    <div class="panel-body">
            	<!--img class="col-lg-12" src="<?php echo base_url() ?>image/foto.png"-->
            		</div>
                </div>
                <input type="file" style="float:left" name="foto">
            </div>
		</div>
                    <button type="submit" class="btn btn-success simpan">
                        Simpan
                    </button>
                    <?php echo anchor('admin_asisten','Kembali','class="btn btn-default kembali"') ?>
                </form>
    </div>
</div>