<style>
.form-control{float:right; width:300px;}
.lihat{float:right; width:300px;}
.pp{max-width:100%;}
.input-tanggal{width:50px;}
.input-bulan{width:150px; margin:0px 10px 0px 10px;}
.input-tahun{width:80px;}
.simpan{margin:0px 0px 50px 30px;}
.kembali{margin:0px 0px 50px 30px;}
</style>
<div class="col-lg-12">
	<h1 class="page-header">Asisten</h1>
</div>
<div class="col-lg-12">
	<div class="panel panel-default" style="border-radius:0px 0px 0px 0px;">
        <div class="panel-body">
			<div class="col-lg-6">
				<?php 
					$namaBulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
					foreach($asisten as $rz){
					if($rz->tgl_lhr!='0000-00-00'){
						$tgl = explode('-',$rz->tgl_lhr);
						$tanggal = $tgl[2].' '.$namaBulan[$tgl[1]-1].' '.$tgl[0];
					}
					else{
						$tanggal = 'dd mm yyyy';
					}
				?><b>
                <table class="table table-striped">
                	<tr>
                    	<td width="130">Username</td>
                      	<td width="20"></td>
                    	<td><?php echo $rz->username ?></td>
                    </tr>
                	<tr>
                    	<td>Password</td>
                      	<td></td>
                    	<td>*******<?php ///echo $this->encrypt->decode($rz->password) ?></td>
                    </tr>
                	<tr>
                    	<td>Nama Asisten</td>
                      	<td></td>
                    	<td><?php echo $rz->nama ?></td>
                    </tr>
                	<tr>
                    	<td>Jabatan</td>
                      	<td></td>
                    	<td><?php echo $rz->jabatan ?></td>
                    </tr>
                	<tr>
                    	<td>Tanggal Lahir</td>
                      	<td></td>
                    	<td><?php echo $tanggal; ?></td>
                    </tr>
                	<tr>
                    	<td>Alamat</td>
                      	<td></td>
                    	<td><?php echo $rz->alamat ?></td>
                    </tr>
                	<tr>
                    	<td>Email</td>
                      	<td></td>
                    	<td><?php echo $rz->email ?></td>
                    </tr>
                	<tr>
                    	<td>Tahun Masuk</td>
                      	<td></td>
                    	<td><?php echo $rz->masuk ?></td>
                    </tr>
                	<tr>
                    	<td>Tahun Keluar</td>
                      	<td></td>
                    	<td><?php echo $rz->keluar ?></td>
                    </tr>
                	<tr>
                    	<td>Status Mengajar</td>
                      	<td></td>
                    	<td><?php if($rz->status!=0){echo 'Aktif';}else{echo 'Tidak Aktif';} ?></td>
                    </tr>
                </table></b>
			</div>
            <div class="col-lg-5" style="margin-left:40px; ">
                <div class="panel panel-default" style="overflow:auto;">
                    <div class="panel-body">
            			<img class="pp" src="<?php echo base_url("image/asisten/$rz->foto") ?>">
            		</div>
                </div>
                <?php echo form_open_multipart('admin_asisten/update_foto_asisten') ?>
                	<input type="hidden" value="<?php echo $rz->id_asisten ?>" name="id_asisten">
                	<input type="hidden" value="<?php echo $rz->foto ?>" name="nama_foto">
                	<input required type="file" name="foto">
                    <button type="submit" class="btn btn-warning" style="margin-top:30px;">
                    	<i class="glyphicon glyphicon-camera"></i> Ganti Foto
                    </button>
                	<!--input type="submit" value="Ganti Foto" class="btn btn-warning" style="margin-top:30px;"-->
        			<?php //echo anchor('admin_asisten/hapus_foto','Hapus Foto','class="btn btn-danger" style="margin:30px 0px 0px 10px;"') ?>
                </form>
            </div>
		</div>
		<?php } echo anchor('admin_asisten','OK','class="btn btn-primary simpan"') ?>
        <?php echo anchor('admin_asisten/edit_asisten/'.$rz->id_asisten,'<i class="glyphicon space glyphicon-edit"></i> Edit','title="Edit" class="btn btn-warning kembali"') ?>
    </div>
</div>