<script>
	$(document).ready(function(e) {
		$(window).load(function(){ 
				var tinggi = $('.obrolan').height();
				$('.dalam-chat').scrollTop(tinggi);
		});
        $('#btn-chat').click(function(){
			$('#btn-chat').html("<img class='img-loading' src='<?php echo base_url('image/ajax-loading.gif') ?>'  /> &nbsp; Mengirim...");
			var user1 = $('.user1').val();
			var user2 = $('.user2').val();
			var pesan = $('.input-sm').val();
			var tinggi = $('.obrolan').height();
			if(pesan==''){
				alert('Isikan pesan anda');
				$('#btn-chat').html('Kirim');
				return false;
			}
			$.ajax({
				type: 'POST',
				url: "<?php echo base_url('index.php/asisten_pesan/pesan') ?>",
				data: 'user1='+user1+'&user2='+user2+'&pesan='+pesan,
				success: function(data) {
					if(data=='sukses'){
						$('.input-sm').val('');
						$('.obrolan').load('<?php echo base_url('index.php/asisten_pesan/refresh_pesan') ?>/'+user1+'/'+user2); 
						$(".dalam-chat").animate({
							scrollTop:  tinggi
						});
					}
					else{
						alert('Pesan gagal terkirim');
						$('.input-sm').val('');
					} 
					$('#btn-chat').html('Kirim');
				}
			});
			return false;
		});
		$(".input-sm").keypress(function(t){
			if(t.which==13){
				$('#btn-chat').html("<img class='img-loading' src='<?php echo base_url('image/ajax-loading.gif') ?>'  /> &nbsp; Mengirim...");
				var user1 = $('.user1').val();
				var user2 = $('.user2').val();
				var pesan = $('.input-sm').val();
				var tinggi = $('.obrolan').height();
				if(pesan==''){
					alert('Isikan pesan anda');
					$('#btn-chat').html('Kirim');
					return false;
				}
				$.ajax({
					type: 'POST',
					url: "<?php echo base_url('index.php/asisten_pesan/pesan') ?>",
					data: 'user1='+user1+'&user2='+user2+'&pesan='+pesan,
					success: function(data) {
						if(data=='sukses'){
							$('.input-sm').val('');
							$('.obrolan').load('<?php echo base_url('index.php/asisten_pesan/refresh_pesan') ?>/'+user1+'/'+user2); 
							$(".dalam-chat").animate({
				       	 		scrollTop:  tinggi
							});
						}
						else{
							alert('Pesan gagal terkirim');
							$('.input-sm').val('');
						}
						$('#btn-chat').html('Kirim');
					}
				});
				return false;	
			}
		});
		setInterval(function(){
			var tinggi = $('.obrolan').height();
			var user1 = $('.user1').val();
			var user2 = $('.user2').val();
			$('.jumlah-pesan').load('<?php echo base_url('index.php/asisten_pesan/refresh_jumlah_pesan') ?>');
			$('.obrolan').load('<?php echo base_url('index.php/asisten_pesan/refresh_pesan') ?>/'+user1+'/'+user2); 
			$(".dalam-chat").animate({
				scrollTop:  tinggi
			});
		}, 40000);
    });
</script>
<link href="<?php echo base_url() ?>assets/css/asisten-chat.css" rel="stylesheet" />
<div class="col-md-12">
	<h2 class="page-header">Pesan</h2>
</div>
<?php
	$cp = $this->uri->segment(4);
?>
<div class="col-md-12">
	<div class="col-md-8">
	<?php if($cp!=0){ ?>
    	<div class="chat-panel panel panel-default">
        	<div class="panel-heading">
            	<i class="fa fa-comments fa-fw"></i>
				Obrolan dengan <?php if($cp!=0){echo $namaAsisten->nama;}else if($cp=='all'){echo 'Semua asisten';} ?>
			</div>
            <div class="panel-body dalam-chat">
				<ul class="chat obrolan">
                <?php
					$namabulan = array("","Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
					foreach($pesan as $psn){
						$tgls = explode('-',$psn->tanggal);
						if(($tgls[0]==date('Y'))&&($tgls[1]==date('m'))&&($tgls[2]==date('d'))){
							$waktu = 'Hari ini';	
						}
						else if(($tgls[0]==date('Y'))&&($tgls[1]==date('m'))&&($tgls[2]==date('d')-1)){
							$waktu ='Kemarin';
						}
						else{
							$waktu = $tgls[2].' '.$namabulan[$tgls[1]-1].' '.$tgls[0];	
						}
						if($psn->status==1){
							$statusp = '<span class="alert-warning">Belum di lihat</span>';
						}
						else{
							$statusp = '';
						}
						$asis = $this->models->where1Row('asisten','id_asisten',$psn->user_satu);
						if($psn->user_satu==$user1){
				?>
                            <li class="right clearfix">
                                <span class="chat-img pull-right">
                                    <img src="<?php echo base_url('image/asisten/'.$asis->foto) ?>" alt="User Avatar" class="img-circle" />
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <small class=" text-muted">
                                        <?php echo $statusp ?> <i class="fa fa-clock-o fa-fw"></i> <?php echo $waktu ?></small>
                                        <strong class="pull-right primary-font"><?php echo $asis->nama ?></strong>
                                    </div>
                                    <p><?php echo $psn->pesan ?></p>
                                </div>
                            </li>
                <?php 
						}
						else{
				?>
                            <li class="left clearfix">
                                <span class="chat-img pull-left">
                                    <img src="<?php echo base_url('image/asisten/'.$asis->foto) ?>" alt="User Avatar" class="img-circle" />
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font"><?php echo $asis->nama ?></strong> 
                                        <small class="pull-right text-muted">
                                           <?php echo $statusp ?> <i class="fa fa-clock-o fa-fw"></i> <?php echo $waktu ?></small>
                                    </div>
                                    <p><?php echo $psn->pesan ?></p>
                                </div>
                            </li>
                <?php 
						}
					}
				?>
                </ul>
            </div>
            <div class="panel-footer">
                <div class="input-group">
                	<!--textarea id="btn-input" class="form-control input-sm"></textarea-->
                    <input class="user1" type="hidden" value="<?php echo $_SESSION['id_asisten'] ?>" />
                    <input class="user2" type="hidden" value="<?php echo $user2 ?>" />
                    <input id="btn-input" type="text" class="form-control input-sm" placeholder="Ketikan pesan anda disini...." />
                    <span class="input-group-btn">
                        <button class="btn btn-warning btn-sm" id="btn-chat">
                            Kirim
                        </button>
                    </span>
                </div>
            </div>
        </div>
    <?php } ?>
    </div>
    <div class="col-md-4">
    	<div class="panel panel-default" style="height:445px;overflow:auto;">
        <ul class="list-group">
            <?php
				foreach($asisten as $rz){
					$jab ='';
					if($rz->id_asisten!=$_SESSION['id_asisten'])
					{
						$namaa ='';
						if(strlen($rz->nama)>13){
								$namaa = '...';
						}
							
						if($rz->id_jabatan=='adminsistem'){$jab = 'Admin Sistem';}
			?>
            	<a href="<?php echo base_url('index.php/asisten_pesan/index/'.$_SESSION['id_asisten'].'/'.$rz->id_asisten) ?>">
                
                <li class="list-group-item">
                    <span class="chat-img pull-left">
                        <img src="<?php echo base_url('image/asisten/'.$rz->foto) ?>" alt="User Avatar" class="img-circle" />
                    </span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font"><?php echo substr($rz->nama,0,13).' '.$namaa ?></strong> 
                            <small class="pull-right text-muted"><i class="fa fa-comments fa-fw"></i></small>
                        </div>
                        <p><?php echo $jab ?></p>
                    </div>
                </li></a>
            <?php 
					}
				}
			?>
                </ul>
        </div>
    </div>
</div>