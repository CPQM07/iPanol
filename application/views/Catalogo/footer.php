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
    <script src="<?= base_url('resources/js/notify.min.js')  ?>"></script>

     <script type="text/javascript" charset="utf-8">
    var micarrito = new Array();
    $(".add-to-cart").click(function(event) {
    	var addcartobj = $(this);
    	var cantidadsolicitada = $("#CANT"+addcartobj.attr("id")).val();
    	var cantidadmaxima = $("#CANT"+addcartobj.attr("id")).attr("max");
    	if (parseInt(cantidadsolicitada) <= parseInt(cantidadmaxima) && parseInt(cantidadsolicitada) > 0) {
    		$.ajax({
    		url: "<?=site_url('/catalogo/agregarCarrito')?>",
    		type: 'POST',
    		dataType: 'json',
    		data: {idprod:addcartobj.attr("id"),cantidad: $("#CANT"+addcartobj.attr("id")).val()},
    	})
    	.done(function(response) {
    		if (response.estado) {
    			$.notify("Se han añadido "+response.prodnombre, "success");
    			$("#totalcarrito").text(" "+response.total);
    			addcartobj.attr("disabled", true);
    		}
    	})
    	.fail(function() {
    		console.log("error");
    	})
    	.always(function() {
    		console.log("complete");
    	});
    	} else {
    		$.notify("Lo sentimos no puede solicitar más de la cantidad actual en stock ó no ha ingresado la cantidad a solicitar¡¡", "warn");
    	}

    });

    $(document).on('keyup', '.inputcantidad', function(event) {
    	var objcant = $(this);
    	if (parseInt(objcant.val()) <= parseInt(objcant.attr("max")) && parseInt(objcant.val()) > 0) {

    	} else {
    		objcant.val("");
    	}
    });

    $(".cart_quantity_delete").click(function(event) {
    	var objthis = $(this);
    	$.ajax({
    		url: "<?=site_url('/catalogo/eliminarindexcarrito')?>",
    		type: 'POST',
    		dataType: 'json',
    		data: {indice: $(this).attr("id")},
    	})
    	.done(function(response) {
    			if (response.estado) {
    			$.notify("Se ha quitado correctamente un producto de su carrito de pedidos", "success");
    			$("#totalcarrito").text(" "+response.total);
    			objthis.parent("td").parent("tr").remove();
    		}
    	})
    	.fail(function() {
    		console.log("error");
    	})
    	.always(function() {
    		console.log("complete");
    	});
    	
    });

    $("#buscar").click(function(){
    	var texto = $("#query").val();
    	window.location.href = "<?=site_url('/Catalogo/buscar/')?>"+texto;
    });

    $("#limpiarcarrito").click(function(event) {
    	$.post("<?=site_url('/catalogo/limpiarCarrito')?>");	
    });


    </script>
</body>
</html>