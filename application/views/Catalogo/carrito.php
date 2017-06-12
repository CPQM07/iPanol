<?php include_once('header.php') ?>
    <form action="" method="POST" accept-charset="utf-8">
	<section id="cart_items">
		<div class="container">
			<div class="table-responsive cart_info">
					<table class="table table-striped">
				<thead style="background: #FF1010; color: white;">
					<tr style="font-size: 15px">
					    <th>N°</th>
						<th>ARTÍCULO</th>
						<th>TIPO DE ARTÍCULO</th>
						<th>CANTIDAD</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php if (isset($_SESSION["productos"])): ?>
					<?php foreach ($_SESSION["productos"] as $key => $value): ?>
					<tr style="font-size: 17px">
						<td><?= $value["productoid"]  ?></td>
						<td><?= $value["nombre"]  ?></td>
						<td><?= $value["tipo"]  ?></td>
						<td><?= $value["cantidad"]  ?></td>
						<td>
							<a style="cursor: pointer;" class="cart_quantity_delete fa fa-times" id="<?= $key ?>">
							</a>
						</td>
					</tr>
					<?php endforeach ?>
				<?php endif ?>
				</tbody>
			</table>
		<!--FIN CONTENIDO CARRITO-->
        </div>

	    
        <h5 class="pull-left" style="font-size:19px;"> Información adicional </h5>
	    <br>
	    <hr>
	    <table class="table-responsive table table-striped">
			<thead>
				<tr>
				    <th>ASIGNATURA</th>
					<th>N° GRUPO DE TRABAJO</th>
					<th>FECHA ENTREGA</th>
				</tr>
			</thead>
			<tbody>
				<tr style="font-size: 15px">
					<td> 
					  <select name="asignaturas">
					  		<?php if ($asignaturas != null): ?>
					  			<?php foreach ($asignaturas as $key => $value): ?>
						  		 <option value="<?= $value->get("ASIGNATURA_ID") ?>"><?= $value->get("ASIGNATURA_NOMBRE") ?></option>
						  		<?php endforeach ?>
					  		<?php endif ?>
					  </select>
					</td>
					<td><input class="pull-left" required="required" type="number" id="cantidadGruTrab" name="cantidadGruTrab" style="width:130px;"></td>
					<td><input class="input pull-left" required="required" type="date" id="fechaEntrega" name="fechaEntrega" style="width:250px;"></td>
				</tr>
			</tbody>
		</table>
		<hr>

		
		</div>
	</section> <!--/#cart_items(items de carritos)-->

	<section id="do_action">
		<div class="container">
			<div class="row">
				<a class="btn btn-default check_out pull-right" id="limpiarcarrito" href="">Limpiar carrito</a>
				<a type="submit" class="btn btn-default check_out pull-right" href="">Realizar pedido</a>
			</div>
		</div>
	</section><!--/#do_action(subir pedido)-->
	</form>


<?php include_once('footer.php') ?>