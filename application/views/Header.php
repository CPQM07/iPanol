<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistema Pañol INACAP</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="<?= base_url('resources/css/bootstrap3.css') ?>">
  <!-- bootstrap -->
  <link rel="stylesheet" href="<?= base_url('resources/css/bootstrap.css') ?>">
  <!-- font-awesome -->
  <link rel="stylesheet" href="<?= base_url('resources/css/font-awesome.css') ?>">
  <!-- AdminLTE -->
  <link rel="stylesheet" href="<?= base_url('resources/css/AdminLTE.css') ?>">
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="<?= base_url('resources/css/skin.css') ?>">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?= base_url('resources/css/daterangepicker.css') ?>">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?= base_url('resources/css/datepicker3.css') ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('resources/css/select2.css') ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('resources/css/dataTables.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('resources/css/AdminLTE.css') ?>">
</head>
<body class="hold-transition skin-red-light sidebar-mini">
<div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="index.php" class="logo">
        <span class="logo-mini"><b>S</b>PI</span>
        <span class="logo-lg"><b>Sistema</b>PAÑOL</span>
      </a>
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="dist/img/woman.png" class="user-image" alt="User Image">
                <span class="hidden-xs">Usuario</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="dist/img/woman.png" class="img-circle" alt="User Image">
                  <p>
                    Usuario - Cargo
                    <small>Correo</small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-right">
                    <a href="login.php" class="btn btn-danger btn-flat">Cerrar sesión</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <aside class="main-sidebar">
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="dist/img/woman.png" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>Usuario</p>
            <a href="#"><i class="fa fa-circle text-success"></i> En línea</a>
          </div>
        </div>

      <ul class="sidebar-menu">
        <li class="header">MENÚ DE NAVEGACIÓN</li>
        <li class="treeview">
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Panel de control</span>
          </a>
        </li>
        <li class="treeview">
          <a href="reportes.php">
            <i class="fa  fa-file-pdf-o"></i> <span>Generar reporte</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-text-o"></i>
            <span>Mantenedores</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="productos.php"><i class="fa fa-circle-o"></i> Productos</a></li>
            <li><a href="usuarios.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bar-chart"></i>
            <span>Inventario</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="ingreso.php"><i class="fa fa-circle-o"></i> Ingreso</a></li>
            <li><a href="baja.php"><i class="fa fa-circle-o"></i> Dar de baja</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-commenting-o"></i>
            <span>Solicitudes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="entrega.php"><i class="fa fa-circle-o"></i> Entrega manual</a></li>
            <li><a href="solicitudes.php"><i class="fa fa-circle-o"></i> Solicitudes pendientes</a></li>
            <li><a href="profesores.php"><i class="fa fa-circle-o"></i> Petición de Profesores</a></li>
            <li><a href="recepcion.php"><i class="fa fa-circle-o"></i> Recepción</a></li>
          </ul>
        </li>

      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <h3>
        Panel de control
      </h3>
    </section>

    <!-- Main content -->
    <div class="content">
      <div class="row">
