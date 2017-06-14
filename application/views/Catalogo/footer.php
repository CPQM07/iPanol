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