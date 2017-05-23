<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Carrito de pedidos | iPañol</title>
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
								<button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#carrito">Carrito de pedidos</button>
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
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Buscar..."/>
						</div>
					</div>
				</div>
				</div>
			</div>
	</header>

<!--MODAL CARRITO-->
<div class="modal fade" id="carrito" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Carrito de pedidos</h4>
      </div>
      <div class="modal-body">
		<!--CONTENIDO CARRITO-->
			<table class="table table-striped">
				<thead>
					<tr>
					    <th>N°</th>
						<th>IMAGEN</th>
						<th>ARTICULO</th>
						<th>TIPO DE ARTÍCULO</th>
						<th>CANTIDAD</th>
						<th>TOTAL</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							
						</td>
					</tr>
				</tbody>
			</table>
		<!--FIN CONTENIDO CARRITO-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Realizar pedido</button>
      </div>
    </div>
  </div>
</div>
<!--MODAL CARRITO-->


<?php function MISJAVASCRIPTPERSONALIZADO(){  ?>
<script type="text/javascript" charset="utf-8">

</script>
<?php } ?>