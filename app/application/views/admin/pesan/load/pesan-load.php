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
                                            <i class="fa fa-clock-o fa-fw"></i> <?php echo $waktu ?></small>
                                    </div>
                                    <p><?php echo $psn->pesan ?></p>
                                </div>
                            </li>
                <?php 
						}
					}
				?>