<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo de préstamos | iPañol</title>
    <link href="<?= base_url(); ?>resources/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>resources/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?= base_url(); ?>resources/css/main.css" rel="stylesheet">
	<link href="<?= base_url(); ?>resources/css/responsive.css" rel="stylesheet">
	<link href="<?= base_url()?>resources/plugins/jquery-ui/jquery-ui.css" rel="stylesheet"/>
  <link href="<?= base_url()?>resources/plugins/jQuery-Timepicker-Addon-master/dist/jquery-ui-timepicker-addon.min.css" rel="stylesheet"/>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="<?= base_url('resources/images/system/Logo.ico'); ?>">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
<?php $user = $this->session->userdata('logged_in');?>
	<!--SESSION USUARIO-->
	    <div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row pull-left">
					<div class="col-sm-6">					
							<ul class="nav navbar-nav">
								<div class="dropdown">
								  <button class="btn btn-link dropdown-toggle" style="color: grey; font-size: 14px;" type="button" data-toggle="dropdown">BIENVENIDO - <?= $user['nombres']." ".$user['apellidos'] ?>
								  <span class="caret"></span></button>
								  <ul class="dropdown-menu">
								    <a href="<?= site_url('/Login/logout'); ?>" class="btn btn-danger btn-flat">Cerrar sesión</a>
								  </ul>
								</div>
							</ul>
					</div>
				</div>
			</div>
		</div>
    <!--SESSION USUARIO-->
    
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="<?= site_url('/Catalogo/') ?>"><img src="<?= base_url('resources/images/system/Logo.png'); ?>" width="80px" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="<?= site_url('/Catalogo/carrito') ?>"><i class="fa fa-shopping-cart" id="totalcarrito"> <?php if(isset($_SESSION["productos"])) echo("".count($_SESSION["productos"]).""); ?> </i> Carrito</a></li>
								<li><a href="<?= site_url('/Login/index') ?>"><i class="fa fa-lock"></i> Ingreso de usuarios</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="<?= site_url('/Catalogo/') ?>">Inicio</a></li>
								<li><a href="<?= site_url('/Catalogo/contactanos') ?>">Contáctanos</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 pull-right">
							<div class="input-group input-group-sm">
				                <input type="text" placeholder="Buscar ..." id="query" name="query" class="form-control">
				                    <span class="input-group-btn">
				                      <button type="button" id="buscar" class="btn btn-danger btn-flat fa fa-search"></button>
				                    </span>
				            </div>
					</div>
				</div>
				</div>
			</div>
	</header>
