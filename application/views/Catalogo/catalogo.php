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
									<h4 class="panel-title"><a href="<?= site_url("/Catalogo/porCategoria/".$value->get('CAT_ID').""); ?>"><?= $value->get('CAT_NOMBRE'); ?></a></h4>
								</div>
							</div>
			    <?php endforeach ?>
							</div><!--/categorias de productos-->
                        
                        <div class="brands_products"><!--por tipo de articulos-->
							<h2>TIPO DE ARTÍCULO</h2>
						<div class="brands-name">
							<?php foreach ($tipoProd as $key => $value): ?>	
								<ul class="nav nav-pills nav-stacked">
									<li><a href="<?= site_url("/Catalogo/porTipoProducto/".$value->get('TIPO_ID').""); ?>"> <span class="pull-right"><!--(??)--></span><?= $value->get('TIPO_NOMBRE'); ?></a></li>
								</ul>
							<?php endforeach ?>
						</div>
						</div><!--por tipo de articulos-->
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--articulos para pedido-->
						<h2 class="title text-center">Artículos para pedido</h2>
					<?php if ($productos == null): ?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">No se encontraron artículos en esta categoría.</h4>
								</div>
							</div>
					<?php endif ?>
					<?php foreach ($productos as $key => $value): ?>		
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="<?= base_url("/resources/images/Imagenes_Server/".$value->get('PROD_IMAGEN').""); ?>" alt="" />
										<h2><?= $value->get('PROD_NOMBRE'); ?></h2>
										<p>Stock total: <?= $value->get('PROD_STOCK_TOTAL'); ?></p>
										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Solicitar</a>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach ?>
					</div><!--articulos para pedido-->

					    <ul class="pagination">
							<li class="active"><a href="">1</a></li>
							<li><a href="">2</a></li>
							<li><a href="">3</a></li>
							<li><a href="">&raquo;</a></li>
						</ul>
				</div>
			</div>
		</div>
	</section>


<?php include_once('footer.php') ?>