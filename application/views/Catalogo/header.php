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
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="<?= base_url('resources/images/system/Logo.ico'); ?>">
</head><!--/head-->

<body>
	<header id="header"><!--header-->

	<!--SESSION USUARIO-->
	    <div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row pull-left">
					<div class="col-sm-6">					
							<ul class="nav navbar-nav">
								<div class="dropdown">
								  <button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown">BIENVENIDO - Yerko Pailemilla Parada
								  <span class="caret"></span></button>
								  <ul class="dropdown-menu">
								    <li><a href="<?= site_url('/Catalogo/') ?>">Cerrar sesión</a></li>
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
								<li><button type="button" class="btn btn-block btn-danger fa fa-shopping-cart" data-toggle="modal" data-target="#carrito">Carrito de pedidos</button></li>
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
						<form id="form" method="POST" action="<?=site_url()?>/Catalogo/index/">
							<input type="text" id="query" name="query" />
							<input type="submit" id="buscar" value="Buscar...">						
						</form>
					</div>
				</div>
				</div>
			</div>
	</header>

<!--MODAL CARRITO-->
<div class="modal fade" id="carrito" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header btn-danger">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Solicitud de préstamos</h4>
      </div>
      <div class="modal-body">
		<!--CONTENIDO CARRITO-->
			<table class="table table-striped">
				<thead>
					<tr>
					    <th>N°</th>
						<th>ARTICULO</th>
						<th>TIPO DE ARTÍCULO</th>
						<th>CANTIDAD</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>RJ45</td>
						<td>Fungible</td>
						<td><input type="number" required="required" id="mcantidadArticulo" name="mcantidadArticulo" style="width:100px;"></td>
					</tr>
				</tbody>
			</table>
		<!--FIN CONTENIDO CARRITO-->
      </div>
      <div class="modal-footer">
      <h5 class="modal-title pull-left" id="myModalLabel" style="font-size:18px;"> Información adicional </h5>
      <br>
      <hr>
      <table class="table table-striped">
				<thead>
					<tr>
					    <th>ASIGNATURA</th>
						<th>N° GRUPO DE TRABAJO</th>
						<th>FECHA ENTREGA</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td> 
						  <select name="masignaturas">
							  <option value="x">IT Essentials</option>
							  <option value="x">Networking I</option>
						  </select>
						</td>
						<td><input class="pull-left" required="required" type="number" id="mcantidadGruTrab" name="mcantidadGruTrab" style="width:130px;"></td>
						<td><input class="input" required="required" type="date" id="mfechaEntrega" name="mfechaEntrega" style="width:250px;"></td>
					</tr>
				</tbody>
			</table>
			<hr>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger">Realizar pedido</button>
      </div>
    </div>
  </div>
</div>
<!--MODAL CARRITO-->