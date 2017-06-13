<?php include_once('header.php') ?>	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Categorías</h2>
						<div class="panel-group category-products" id="accordian"><!--categorias de productos-->
						<?php foreach ($categorias as $key => $value): ?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="<?= site_url("/Catalogo/index/".$value->get('CAT_ID').""); ?>"><?= $value->get('CAT_NOMBRE'); ?></a></h4>
								</div>
							</div>
			    		<?php endforeach ?>
							</div><!--/categorias de productos-->
                        <div class="brands_products"><!--por tipo de articulos-->
							<h2>TIPO DE ARTÍCULO</h2>
						<div class="brands-name">
							<?php foreach ($tipoProd as $key => $value): ?>	
								<ul class="nav nav-pills nav-stacked">
									<li><a href="<?= site_url("/Catalogo/tipo/".$value->get('TIPO_ID').""); ?>"> <span class="pull-right"><!--(??)--></span><?= $value->get('TIPO_NOMBRE'); ?></a></li>
								</ul>
							<?php endforeach ?>
						</div>
						</div><!--por tipo de articulos-->
					</div>
				</div>
				<div class="col-sm-9 padding-right">
					<div id="todos" class="features_items"><!--articulos para pedido-->
						<h2 class="title text-center">Artículos para pedido</h2>
					<div class="col-sm-12">
					    <?php echo $pagination;  ?>
					</div>
					<?php if ($consulta != null): ?>
					<?php foreach ($consulta as $key => $value): ?>	
					<?php $disabled = ""; ?>
					<?php if(isset($_SESSION["productos"])): ?>
						<?php foreach ($_SESSION["productos"] as $key => $pro): ?>
							<?php if ($value['PROD_ID'] == $pro['productoid']): ?>
								<?php $disabled = "disabled"; ?>
							<?php endif ?>			
						<?php endforeach ?>
					<?php endif ?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img style="height: 250px;width: 200px" src="<?= base_url("/resources/images/Imagenes_Server/".$value['PROD_IMAGEN'].""); ?>" alt="" />
										<h2><?= $value['PROD_NOMBRE']; ?></h2>
										<p>Disponibles: <?= $value['STOCKACTUAL']; ?></p>
										<input type="number" placeholder="Cantidad a solicitar" class="form-control inputcantidad" min="1" max="<?= $value['STOCKACTUAL']; ?>" id="CANT<?= $value['PROD_ID']?>">
										<a <?php echo($disabled) ?> id="<?= $value['PROD_ID']?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar</a>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach ?>
					<?php else: ?>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">No se encontraron artículos en esta categoría.</h4>
									</div>
								</div>
					<?php endif ?>
					</div><!--articulos para pedido-->
					<div class="col-sm-12">
					    <?php echo $pagination;  ?>
					</div>			    
				</div>
			</div>
		</div>
	</section>
<?php include_once('footer.php') ?>


