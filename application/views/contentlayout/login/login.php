<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Iniciar sesión</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= base_url('resources/css/bootstrap.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('resources/css/AdminLTE.css') ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('resources/css/skin.css') ?>">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index2.html"><b>Sistema</b>PAÑOL</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Ingrese sus credenciales</p>

    <form action="<?= site_url('Login/index') ?>" method="post">
      <?=(isset($error))? $error : ""; ?>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="user" value="19549226-3" placeholder="RUT">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" class="form-control" name ="password" value="2112Aeqdlf" placeholder="CONTRASEÑA">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-danger btn-block btn-flat">Ingresar</button>
        </div>
      </div><br>

      <!--<div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-default btn-block btn-flat">Registrarse</button>
        </div>
      </div>-->
    </form><br>
    <!--<a href="#" style="color: red;">Recuperar contraseña</a><br>-->
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?= base_url('resources/js/jquery.js') ?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?= base_url('resources/js/bootstrap.js') ?>"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
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
