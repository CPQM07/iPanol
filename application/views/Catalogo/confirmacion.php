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
								<li><a href="<?= site_url('/Catalogo/carrito') ?>"><i class="fa fa-shopping-cart pull-right" id="totalcarrito"> <?php if(isset($_SESSION["productos"][$this->session->userdata('logged_in')["rut"]])) echo(count($_SESSION["productos"][$this->session->userdata('logged_in')["rut"]])); ?> </i> Carrito</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	</header>
<br>

<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

<div class="container">
    <div class="col-sm-12 col-md-8 col-md-offset-2">
        <div class="panel panel-success">
            <div class="panel-heading" style="font-size: 20px;">Solicitud de artículos realizada correctamente.</div>
                <div class="panel-body">
  	                <table class=table>
                        <tbody>
                            <tr> 
                                <th scope=row>N° de su pedido:</th>
                                <td><?= $ultimoID ?></td> 
                            </tr>
					        <tr> 
					            <th scope=row>Fecha de entrega:</th> 
					            <td><?= $fechaentrega ?></td>  
					        </tr>
					        <tr> 
					            <th scope=row>Grupos de trabajo:</th> 
					            <td><?= $grupo ?></td> 
					        </tr>
					        <tr> 
					            <th scope=row>Solicitado por:</th> 
					            <td><?= $user['nombres']." ".$user['apellidos'] ?></td> 
					        </tr> 
					    </tbody> 
					</table> 
			    </div>
		<div class="panel-footer">
		    <a href="<?= site_url('/Catalogo/') ?>" class="btn btn-success btn-block">Volver al inicio</a>
		</div>
		</div>
	</div>
</div>

<!--/////////////////////////////////////////////////////////////--><hr><!--/////////////////////////////////////////////////////////////////////////-->

<div class="header-bottom">
<div class="container">
    <div class="col-sm-12 col-md-8 col-md-offset-2">
        <div class="panel panel-danger">
            <div class="panel-heading" style="font-size: 20px;">Detalle de su solicitud</div>
                <div class="panel-body">
  	                <table class=table> 
  	                    <thead> 
  	                        <tr> 
  	                           <th>#</th> 
  	                           <th>ARTICULOS PEDIDOS</th> 
  	                           <th></th>
  	                           <th>CANTIDAD</th> 
  	                        </tr> 
  	                    </thead> 
  	                    <tbody> 
  	                    <?php if (isset($detalle)): ?>
							<?php foreach ($detalle as $key => $value): ?>
  	                        <tr> 
  	                           <th scope=row><?= $value["productoid"]  ?></th>
  	                           <td><?= $value["nombre"]  ?></td> 
  	                           <td></td>
  	                           <td><?= $value["cantidad"] ?></td> 
  	                        </tr> 
  	                        <?php endforeach ?>
						<?php endif ?>
  	                    </tbody> 
  	                </table>
			    </div>
		</div>
	</div>
</div>
</div>

<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

<div class="footer-bottom">
	<div class="container">
		<div class="row">
			<p class="pull-left">Copyright © 2017 iPañol. Todos los derechos reservados.</p>
			<p class="pull-right">Diseñado por INACAP Renca.</p>
		</div>
	</div>
</div>
		
	
<script src="<?= base_url(); ?>resources/js/jquery.js"></script>
<script src="<?= base_url(); ?>resources/js/bootstrap.js"></script>
<script src="<?= base_url(); ?>resources/js/main.js"></script>
<script type="text/javascript" src="<?= base_url()?>resources/plugins/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="<?= base_url()?>resources/plugins/jQuery-Timepicker-Addon-master/dist/jquery-ui-timepicker-addon.min.js"></script>
<script src="<?= base_url('resources/js/notify.min.js')  ?>"></script>

 <script type="text/javascript" charset="utf-8">
 $(function () {
 	 
 })
</script>
</body>
</html>	