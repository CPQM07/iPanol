<script type="text/javascript" charset="utf-8">

$(function () {
    setTimeout(function() {
        $(".messages").fadeOut(8000);
    },3000);
});

$(function(){
                <?php if (isset($_SESSION['Deshabilitar'])): ?> 
                    $.notify("Mensaje: <?php echo($_SESSION['Deshabilitar']); ?> ¡¡", "error");   
                <?php endif; ?>

                <?php if (isset($_SESSION['Habilitar'])): ?>
                    $.notify("Mensaje: <?php echo($_SESSION['Habilitar']); ?> ¡¡", "success");
                <?php endif; ?>

                <?php if (isset($_SESSION['Observacion'])): ?>
                    $.notify("Mensaje: <?php echo($_SESSION['Observacion']); ?> ¡¡", "info");
                <?php endif; ?>

                <?php if (isset($_SESSION['Baja'])): ?>
                    $.notify("Mensaje: <?php echo($_SESSION['Baja']); ?> ¡¡", "success");
                <?php endif; ?>

                <?php if (isset($_SESSION['Update'])): ?> 
                    $.notify("Mensaje: <?php echo($_SESSION['Update']); ?> ¡¡", "success");
                <?php endif; ?>

            	$(".select2").select2({
            		placeholder:"seleccionar",
                    locale: 'es'
            	});
	  			$(".datatable").dataTable({
                    lengthMenu: [5,10, 20, 50, 100],
                    cache: false,
                    responsive: true,
                     "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                    }
                });
                $(".datatablebotones").dataTable({
                    lengthMenu: [5,10, 20, 50, 100],
                    cache: false,
                    responsive: true,
                    "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                    },
                    dom: 'Bfrtip',
                    buttons: [
                         {
                                extend: 'excelHtml5',
                                text: 'Exportar a Excel',
                                customize: function( xlsx ) {
                                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                    $('row:first c', sheet).attr( 's', '42' );
                                }
                            },
                         {
                            extend: 'pdfHtml5',
                            text: 'Exportar a pdf'
                        },
                          {
                                extend: 'copyHtml5',
                                text: 'Copiar Todo'
                            }
                    ]
                });


                $(".datatable2").dataTable({
                    lengthMenu: [5,10, 20, 50, 100],
                    cache: false,
                    responsive: true,
                    "pagingType": "simple",
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bInfo": false,
                    "bAutoWidth": false,
                    "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                    }
                });
                $(".datatable3").dataTable({
                    lengthMenu: [5,10, 20, 50, 100],
                    cache: false,
                    responsive: true,
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bInfo": false,
                    "bAutoWidth": false,
                     "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                    }
                });

})
</script>
