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

	<!--SESSION USUARIO-->
	    <div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row pull-left">
					<div class="col-sm-6">					
							<ul class="nav navbar-nav">
								<div class="dropdown">
								  <button class="btn btn-link dropdown-toggle" style="color: grey; font-size: 14px;" type="button" data-toggle="dropdown">BIENVENIDO - [Nombre de usuario aquí]
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
								<li><a href="<?= site_url('/Catalogo/carrito') ?>"><i class="fa fa-shopping-cart" id="totalcarrito"> <?php if(isset($_SESSION["productos"])) echo(count($_SESSION["productos"])); ?> </i> Carrito</a></li>
								<li><a href="<?= site_url('/Login/index') ?>"><i class="fa fa-lock"></i> Ingreso de usuarios</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	</header>



   <h2>N° de su pedido: <?= $ultimoID ?> </h2>
   <hr>
   <h3>Detalle de su solicitud</h3>

   <table class="table table-striped">
				<thead style="background: #FF1010; color: white;">
					<tr style="font-size: 15px">
						<th>ARTICULOS PEDIDOS</th>
						<th></th>
						<th>CANTIDAD</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php if (isset($_SESSION["productos"])): ?>
					<?php foreach ($detalle as $key => $value): ?>
					<tr style="font-size: 17px">
						<td> <?= $value["nombre"]  ?></td>
						<td></td>
						<td><?= $value["cantidad"] ?></td>
						<td></td>
					</tr>
					<?php endforeach ?>
				<?php endif ?>
				</tbody>
			</table>

   <button class="btn btn-danger"><a href="<?= site_url('/Catalogo/') ?>">Volver al inicio</button></a>




    <div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2017 iPañol. Todos los derechos reservados.</p>
					<p class="pull-right">Diseñado por INACAP Renca.</p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	
    <script src="<?= base_url(); ?>resources/js/jquery.js"></script>
	<script src="<?= base_url(); ?>resources/js/bootstrap.js"></script>
    <script src="<?= base_url(); ?>resources/js/main.js"></script>
    <script type="text/javascript" src="<?= base_url()?>resources/plugins/jquery-ui/jquery-ui.js"></script>
    <script type="text/javascript" src="<?= base_url()?>resources/plugins/jQuery-Timepicker-Addon-master/dist/jquery-ui-timepicker-addon.min.js"></script>
    <script src="<?= base_url('resources/js/notify.min.js')  ?>"></script>

     <script type="text/javascript" charset="utf-8">
     $(function () {
     	 $('#fechaEntrega').datetimepicker({ dateFormat: 'yy-mm-dd',timeFormat:  "HH:mm:ss",
     	 	 prevText: 'Anterior',
			 nextText: 'Siguiente',
			 currentText: 'Hoy',
			 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
			 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
			 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
			 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
		});
     })
    var micarrito=new Array;$(".add-to-cart").click(function(a){var t=$(this),o=$("#CANT"+t.attr("id")).val(),r=$("#CANT"+t.attr("id")).attr("max");parseInt(o)<=parseInt(r)&&parseInt(o)>0?$.ajax({url:"<?=site_url('/catalogo/agregarCarrito')?>",type:"POST",dataType:"json",data:{idprod:t.attr("id"),cantidad:$("#CANT"+t.attr("id")).val()}}).done(function(a){a.estado&&($.notify("Se han añadido "+a.prodnombre,"success"),$("#totalcarrito").text(" "+a.total),t.attr("disabled",!0))}).fail(function(){console.log("error")}).always(function(){console.log("complete")}):$.notify("Lo sentimos no puede solicitar más de la cantidad actual en stock ó no ha ingresado la cantidad a solicitar¡¡","warn")}),$(document).on("keyup",".inputcantidad",function(a){var t=$(this);parseInt(t.val())<=parseInt(t.attr("max"))&&parseInt(t.val())>0||t.val("")}),$(".cart_quantity_delete").click(function(a){var t=$(this);$.ajax({url:"<?=site_url('/catalogo/eliminarindexcarrito')?>",type:"POST",dataType:"json",data:{indice:$(this).attr("id")}}).done(function(a){a.estado&&($.notify("Se ha quitado correctamente un producto de su carrito de pedidos","success"),$("#totalcarrito").text(" "+a.total),t.parent("td").parent("tr").remove())}).fail(function(){console.log("error")}).always(function(){console.log("complete")})}),$("#buscar").click(function(){var a=$("#query").val();window.location.href="<?=site_url('/Catalogo/buscar/')?>"+a}),$("#limpiarcarrito").click(function(a){$.post("<?=site_url('/catalogo/limpiarCarrito')?>")});
    	$('#timepicker').timepicker('setTime', '12:45 AM');
    </script>
</body>
</html>