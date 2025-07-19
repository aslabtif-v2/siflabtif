<style>
.form-control{float:right; width:240px;}
.pp{max-width:100%;}
.input-tanggal{width:50px;}
.input-bulan{width:110px; margin:0px 10px 0px 10px;}
.input-tahun{width:60px;}
.simpan{margin:0px 0px 50px 30px;}
.kembali{margin:0px 0px 50px 30px;}
</style>
<div class="col-md-12">
	<h2 class="page-header">Edit Biodata Asisten</h2>
</div>
<div class="col-md-12">
	<div class="panel panel-default" style="border-radius:0px 0px 0px 0px;">
        <div class="panel-body">
			<div class="col-md-6">
				<?php 
					$namaBulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
					echo form_open_multipart('asisten_biodata/update_asisten','class="form-horizontal"');
					foreach($asisten as $mhr){ 
					echo form_hidden('id_asisten',$mhr->id_asisten);
					$tgl = explode('-',$mhr->tgl_lhr);
					if($tgl[1]!='00'){
						$bulan = $namaBulan[$tgl[1]-1];
						$bulanNo = $tgl[1];
					}
					else{
						$bulan = '--Pilih Bulan--';
						$bulanNo = '';	
					}
				?>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Username</label>
                      <div class="col-sm-10">
                      	<input type="text" class="form-control" value="<?php echo $mhr->username ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" value="<?php echo $this->encrypt->decode($mhr->password) ?>" required name="password" placeholder="Password">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Nama_Asisten</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" required value="<?php echo $mhr->nama ?>" name="nama" placeholder="Nama Asisten">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Jabatan</label>
                      <div class="col-sm-10">
                        	<input type="text" class="form-control" value="<?php echo $mhr->jabatan ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Tanggal_Lahir</label>
                      <div class="col-sm-10">
                        <input type="text" maxlength="4" value="<?php echo $tgl[0] ?>" class="form-control input-tahun" required name="tahun" placeholder="Tahun">
                        <select name="bulan" required class="form-control input-bulan">
                        	<option value="<?php echo $bulanNo ?>"><?php echo $bulan; ?></option>
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
                        <input type="text" maxlength="2" value="<?php echo $tgl[2] ?>" class="form-control input-tanggal" required name="tanggal" placeholder="Tgl">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Alamat</label>
                      <div class="col-sm-10">
                        <textarea required name="alamat" class="form-control"><?php echo $mhr->alamat ?></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" value="<?php echo $mhr->email ?>" required name="email" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Tahun_Masuk</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control" value="<?php echo $mhr->masuk ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Tahun_Keluar</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control" value="<?php echo $mhr->keluar ?>" disabled="disabled">
                      </div>
                    </div>
			</div>
            <div class="col-md-5" style="margin-left:40px; ">
                <div class="panel panel-default" style="overflow:auto;">
                    <div class="panel-body">
            			<img class="pp" src="<?php echo base_url("image/asisten/$mhr->foto") ?>">
            		</div>
                </div>
                <input type="file" style="float:left" name="foto">
                <input type="hidden" value="<?php echo $mhr->foto ?>" name="foto_lama">
            </div>
		</div>
                    <button type="submit" class="btn btn-success simpan">
                        Simpan
                    </button>
                    <?php } ?>
                </form>
    </div>
</div>