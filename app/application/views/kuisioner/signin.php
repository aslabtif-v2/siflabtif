<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sign In Your Session!</title>
  <!-- plugins:css -->
  
  <link href="<?php echo base_url() ?>assets/vendor/mdi/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/vendor/base/vendor.bundle.base.css" rel="stylesheet">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link href="<?php echo base_url() ?>assets/css/kuisioner/style.css" rel="stylesheet">
  <!-- endinject -->
  <link href="<?php echo base_url() ?>image/logo-labtif.png" rel="shortcut icon" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
                <img src="<?=base_url()?>image/logo-lab.svg" alt="logo">
              </div>
              <h4>Hello there...!</h4>
              <h6 class="font-weight-light">Happy to see you again!</h6>
              <form class="pt-3" method="POST" action="<?=base_url()?>index.php/signin/store">
                <div class="form-group">
                  <label for="exampleInputEmail">NPM</label>
                  <div class="input-group">
                    <!-- <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>
                    </div> -->
                    <input type="text" name="npm" class="form-control form-control-lg" id="exampleInputEmail" placeholder="NPM" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">Kode Praktikum</label>
                  <div class="input-group">
                    <!-- <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-lock-outline text-primary"></i>
                      </span>
                    </div> -->
                    <!-- <input type="text" name="kd_praktikum" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Kode Praktikum" required>                         -->
                    <select name="kd_praktikum" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Kode Praktikum" required>
                        <option></option>
                        <?php
                          foreach ($id_praktikum as $key => $value) {
                        ?>
                        <option value="<?=$value['id_praktikum']?>"><?=$value['id_praktikum']?></option>
                          <?php } ?>
                    </select>
                  </div>
                </div>
                
                <div class="my-3">
                  <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="submit" value="NEXT"/>
                </div>
                
              </form>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2018  All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?php echo base_url() ?>assets/vendor/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="<?php echo base_url() ?>assets/js/kuisioner/off-canvas.js"></script>
  <script src="<?=base_url()?>assets/js/kuisioner/hoverable-collapse.js"></script>
  <script src="<?=base_url()?>assets/js/kuisioner/template.js"></script>
  <!-- endinject -->
</body>

</html>

