<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Update Password</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css') ?>">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/Login_RedDevs.css') ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/square/blue.css') ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition login-page">

<div class="sidenav">
</div>

<div class="main">
  <div class="col-md-6 col-sm-12">
    <div id="update_password_form" class="login-box">
      <div class="login-logo">
        <a><b>Parking Management System</b></a>
      </div>
      <div class="login-box-body">
          <p class="login-box-msg">Reset your password</p>

          <?php echo validation_errors(); ?>  

          <form action="<?php echo base_url('auth/update_password') ?>" method="post">
              <div class="form-group has-feedback">
                  <?php if (isset($email_hash, $email_code)) { ?>
                  <input type="hidden" value="<?php echo $email_hash ?>" name="email_hash">
                  <input type="hidden" value="<?php echo $email_code ?>" name="email_code">
                  <?php } ?>
                  <input type="email" class="form-control" name="email" value="<?php echo (isset($email)) ? $email : ''; ?>" placeholder="Email">
                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                  <input type="password" class="form-control" name="password" value="" placeholder=" New Password">
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                  <input type="password" class="form-control" name="password_conf" value="" placeholder="Confirm Password">
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <button type="submit" class="btn btn-primary btn-block btn-flat">Update My Password</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js') ?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
