<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APP_NAME ?> | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/dist/css/adminlte.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page back-color">
<div class="login-box">
  <div class="login-logo">
    <!-- <a href="<?php echo base_url('admin') ?>"><b>Welcome to Habesha Dating</a> -->
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body" style="background-color: #fff !important;">
    <div class="login-logo">
    <img src="<?php echo base_url('assets/admin/dist/img/logo.png') ?>" alt="logo.gif" style="height: 100px;">
  </div>
      <h4 class="text-center"><b>Welcome to <?php echo " ".APP_NAME ?></b></h4>
      <p class="login-box-msg">Login in. To see it in action.</p>
      <?php  
        if(flash_get('error')){ 
            echo '<p class="alert alert-danger site-errors">'.flash_get("error").' </p>';
        }
        if (flash_get('success')) {
          echo '<p class="alert alert-success site-errors">'.flash_get("success").' </p>';
 
        }
      ?>
      <form action="<?php echo base_url('admin/login-verify') ?>" method="post">

        <div class="input-group mb-3">
          <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>">
          <!-- <div class="input-group-append"> -->
            <!-- <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div> -->
          <!-- </div> -->
            <?php echo form_error('email', '<div class="form-valid-error">', '</div>'); ?>
        </div>
        
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <!-- <div class="input-group-append"> -->
            <!-- <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div> -->
          <!-- </div> -->
          <?php echo form_error('password', '<div class="form-valid-error">', '</div>'); ?>
        </div>
        <div class="row">

          <div class="col-12" >
            <button type="submit" class="btn  btn-block buttton-btn-sub">Sign In</button>
          </div>
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <p class="mb-1">
        <a href="<?php echo base_url('admin/forget-password') ?>" style="color:#000;">I forgot my password</a>
      </p>
      </div>
      <!-- /.social-auth-links -->


    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url('assets/admin/plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/admin/dist/js/adminlte.min.js') ?>"></script>

</body>
</html>
