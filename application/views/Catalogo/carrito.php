<?php include_once('header.php') ?>

    <form action="<?=site_url('Catalogo/crearsolicitud')?>" method="POST" accept-charset="utf-8">
	<section id="cart_items">
		<div class="container table-responsive">
			<div class="cart_info">
			  <table class="table">
				<thead style="background: #FF1010; color: white;">
					<tr style="font-size: 15px">
					    <th class="text-center">N°</th>
						<th class="text-center">ARTÍCULO</th>
						<th class="text-center">TIPO</th>
						<th class="text-center">CANTIDAD</th>
					
					</tr>
				</thead>
				<tbody>
				<?php if (isset($_SESSION["productos"])): ?>
					<?php foreach ($_SESSION["productos"] as $key => $value): ?>
					<tr class="text-center" style="font-size: 12px">
						<td><?= $value["productoid"]  ?> <a style="cursor: pointer;" class="cart_quantity_delete fa fa-times pull-right" id="<?= $key ?>">
							</a></td>
						<td><?= $value["nombre"]  ?></td>
						<td><?= $value["tipo"]  ?></td>
						<td><?= $value["cantidad"]  ?></td>
						
					</tr>
					<?php endforeach ?>
				<?php endif ?>
				</tbody>
			</table>
		<!--FIN CONTENIDO CARRITO-->
        </div>

	    <div class="table-responsive">
        <h5 class="pull-left" style="font-size:19px;"> Información adicional 
        <small class="alert-info">
        <?php if (isset($_SESSION['camposvacios'])): ?>
        	<?php echo($_SESSION['camposvacios']); ?>
        <?php endif ?>
        </small>
        </h5>
        
	    <br>
	    <hr>
	    <table class="table table-condensed table-striped">
			<thead>
				<tr>
				    <th>ASIGNATURA</th>
					<th>N° GRUPOS</th>
					<th>FECHA ENTREGA</th>
				</tr>
			</thead>
			<tbody>
				<tr style="font-size: 15px">
					<td> 
					  <select class="select2" placeholder="Seleccionar asignatura..." style="width: 100%;" name="asignaturas">
					  <option></option>
					  		<?php if ($asignaturas != null): ?>
					  			<?php foreach ($asignaturas as $key => $value): ?>
						  		 <option value="<?= $value->get("ASIGNATURA_ID") ?>"><?= $value->get("ASIGNATURA_NOMBRE") ?></option>
						  		<?php endforeach ?>
					  		<?php endif ?>
					  </select>
					</td>
					<td><input class="pull-left form-control" required="required" type="number" id="cantidadGruTrab" name="cantidadGruTrab" style="width:100px;"></td>
					<td><input class="input pull-left form-control" readonly placeholder="Click aquí.." requir..ed type="text" id="fechaEntrega" name="fechaEntrega" style="width:160px;"></td>
				</tr>
			</tbody>
		</table>
		<hr>
		</div>


		</div>
	</section> <!--/#cart_items(items de carritos)-->

	<section id="do_action">
		<div class="container">
			<div class="row">
				<a class="btn btn-default check_out" id="limpiarcarrito" href="">Limpiar carrito</a>
				<input type="submit" class="btn btn-success check_out" value="Realizar pedido"/>
			</div>
		</div>
	</section><!--/#do_action(subir pedido)-->
	</form>


<?php include_once('footer.php') ?>