<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login SIFLABTIF</title>
    <link href="<?php echo base_url() ?>image/logo-labtif.png" rel="shortcut icon" />
    <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/sb-admin.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/login.css" rel="stylesheet">
</head>
<body>
	<div class="container">
        <div class="row">
            <div class="menu-login">
            	<div class="alert alert-danger"></div>
                <div class="login-panel panel panel-default">
                    <div class="panel-body">
                    	<img class="img-login" src="<?php echo base_url() ?>image/login-icon.png" />
                        <div style="float:right; width:250px;">
                    	<h3>Sistem Informasi Laboratorium Teknik Informatika <?php echo date('Y') ?></h3>
                        <p>Program Studi Teknik Informatika<br />Universitas Suryakancana</p>
                        </div>
                        <form role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control user" type="text" placeholder="ID Asisten" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control pass" type="password" placeholder="Password">
                                </div>
                                <button class="btn btn-lg btn-info btn-block">
                                	<span class="loading"><img class='img-loading' src='<?php echo base_url() ?>image/ajax-loading.gif' /> &nbsp; Autentikasi...</span>
                                    <span class="masuk">Masuk</span>
                                </button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<script src="<?php echo base_url() ?>assets/js/jquery-1.10.2.js"></script>
    <script type="text/javascript">
		$(document).ready(function(e) {
            $('.btn-lg').click(function(){
				$('.loading').show();
				$('.masuk').hide();
				var user = $('.user').val();
				var pass = $('.pass').val();
				if(user==''||pass==''){
					$('.alert-danger').html('Harap isi username dan password anda.');
					$('.alert-danger').fadeIn('fast').delay(3000).fadeOut('slow');
					$('.loading').hide();
					$('.masuk').show();
					return false;	
				}
				$.ajax({
					type: 'POST',
					url: "index.php/login/proses_login",
					data: 'username='+user+'&password='+pass,
					success: function(data) {
						msg = data.split('|');
						if(msg[0]=='sukses'){
							window.location.href='<?php echo base_url() ?>'+msg[2];
						}
						else{
							$('.loading').fadeOut();
							$('.alert-danger').html(msg[1]);
							$('.user').val('');
							$('.pass').val('');
							$('.alert-danger').fadeIn('slow').delay(3000).fadeOut('slow');
							$('.loading').hide();
							$('.masuk').show();
						}
					}
				});
				return false;
			});
			$(".user, .pass").keypress(function(t){
				if(t.which==13){
					$('.loading').show();
					$('.masuk').hide();
					var user = $('.user').val();
					var pass = $('.pass').val();
					if(user==''||pass==''){
						$('.alert-danger').html('Harap isi username dan password anda.');
						$('.alert-danger').fadeIn('fast').delay(3000).fadeOut('slow');
						$('.loading').hide();
						$('.masuk').show();
						return false;	
					}
					$.ajax({
						type: 'POST',
						url: "index.php/login/proses_login",
						data: 'username='+user+'&password='+pass,
						success: function(data) {
							msg = data.split('|');
							if(msg[0]=='sukses'){
								window.location.href='<?php echo base_url() ?>'+msg[2];
							}
							else{
								$('.loading').fadeOut();
								$('.alert-danger').html(msg[1]);
								$('.user').val('');
								$('.pass').val('');
								$('.alert-danger').fadeIn('slow').delay(3000).fadeOut('slow');
								$('.loading').hide();
								$('.masuk').show();
							}
						}
					});
					return false;
				}
			});
        });
    </script>
</body>
</html>