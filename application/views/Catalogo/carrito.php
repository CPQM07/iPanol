<?php include_once('header.php') ?>

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
					<tr style="font-size: 17px">
						<td>1</td>
						<td>RJ45</td>
						<td>Fungible</td>
						<td>43</td>
						<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
						</td>
					</tr>
				</tbody>
			</table>
		<!--FIN CONTENIDO CARRITO-->
        </div>

	    
        <h5 class="pull-left" style="font-size:19px;"> Información adicional </h5>
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
				<tr style="font-size: 15px">
					<td> 
					  <select name="asignaturas">
						  <option value="x">IT Essentials</option>
						  <option value="x">Networking I</option>
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
				<a class="btn btn-default check_out pull-right" href="">Realizar pedido</a>
			</div>
		</div>
	</section><!--/#do_action(subir pedido)-->


<?php include_once('footer.php') ?>