					<?php
						$namabulan = array("","Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
						$jp = $this->db->query("SELECT pesan_balasan.id_pesan, pesan.user_satu, COUNT(pesan_balasan.status) AS jumlah, MAX(pesan_balasan.pesan) AS pesan, max(pesan_balasan.tanggal) as tanggal FROM pesan_balasan, pesan WHERE pesan_balasan.id_pesan=pesan.id_pesan AND pesan.user_dua='".$_SESSION['id_asisten']."' AND pesan_balasan.status='1' GROUP BY pesan.user_satu")->result();
						$tp = 0;
						$np = '';
						foreach($jp as $jps){
							$tp = $jps->jumlah+$tp;
						}
						
						if($tp!=0){
							$np = '<span class="badge badge-danger">'.$tp.'</span> <i class="fa fa-caret-down"></i>';
						}
					?>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> <?php echo $np ?>
                    </a>
                    <?php
					if($tp!=0){
						echo '<ul class="dropdown-menu dropdown-messages">';
						foreach($jp as $jps){
						$asis = $this->models->where1Row('asisten','id_asisten',$jps->user_satu);
						$tgls = explode('-',$jps->tanggal);
						if(($tgls[0]==date('Y'))&&($tgls[1]==date('m'))&&($tgls[2]==date('d'))){
							$waktu = 'Hari ini';	
						}
						else if(($tgls[0]==date('Y'))&&($tgls[1]==date('m'))&&($tgls[2]==date('d')-1)){
							$waktu ='Kemarin';
						}
						else{
							$waktu = $tgls[2].' '.$namabulan[$tgls[1]-1].' '.$tgls[0];	
						}
					?>    
                        <li>
                            <a href="<?php echo base_url('index.php/admin_pesan/index/'.$_SESSION['id_asisten'].'/'.$jps->user_satu) ?>">
                                <div>
                                    <strong><?php echo $asis->nama ?> <span class="badge badge-danger"><?php echo $jps->jumlah ?></span></strong>
                                    <span class="pull-right text-muted">
                                        <em><?php echo $waktu ?></em>
                                    </span>
                                </div>
                                <div><?php  echo substr($jps->pesan,0,30).'...'; ?></div>
                            </a>
                        </li>
                    <?php 
						}
                    	echo '</ul>';
					}
					?>