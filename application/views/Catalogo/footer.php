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
    <script src="<?= base_url(); ?>resources/js/datepicker.js"></script>
    <script src="<?= base_url('resources/js/notify.min.js')  ?>"></script><!-- charjs -->

    <script type="text/javascript" charset="utf-8">
    var micarrito = new Array();
    $(".add-to-cart").click(function(event) {
    	var tipo = $(this).attr("tipo");
    	if (tipo == 1) {
    		tipo = "Activo";
    	}else if(tipo == 2){
    		tipo = "Fungible";
    	}

    	$.notify("Se ha agregado al carrito de prestamos "+$(this).attr("nom"), "success");

    	$.ajax({
    		url: "<?=site_url('/catalogo/agregarCarrito')?>",
    		type: 'POST',
    		dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
    		data: {idprod:$(this).attr("id"),cantidad: $("#CANT"+$(this).attr("id")).val(),tipo:tipo},
    	})
    	.done(function() {
    		console.log("success");
    	})
    	.fail(function() {
    		console.log("error");
    	})
    	.always(function() {
    		console.log("complete");
    	});
    	


    	$("#contador").text(" "+micarrito.length+" ");
    });

    </script>
</body>
</html>