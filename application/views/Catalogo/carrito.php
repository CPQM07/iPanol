
<?php include_once('header.php') ?>

	<section id="cart_items">
		<div class="container">
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Artículo</td>
							<td class="description"></td>
							<td class="price">Tipo de artículo</td>
							<td class="quantity">Cantidad</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="cart_product">
								<a href=""><img src="images/cart/mouse.jpg" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">Mouse</a></h4>
								<p>Código: 1089772</p>
							</td>
							<td class="cart_price">
								<p>Activo</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="3" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">3</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
						</tr>

						<tr>
							<td class="cart_product">
								<a href=""><img src="images/cart/cable.jpg" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">Cable de red LAN</a></h4>
								<p>Código: 1089772</p>
							</td>
							<td class="cart_price">
								<p>Fungible</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">1</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items(items de carritos)-->

	<section id="do_action">
		<div class="container">
			<div class="row">
				<a class="btn btn-default check_out" href="">Realizar pedido</a>
			</div>
		</div>
	</section><!--/#do_action(subir pedido)-->

		
<?php include_once('footer.php') ?>