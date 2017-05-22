<!-- Content Wrapper. Contains page content -->
  <div style="font-size: 10px" class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
      <!-- /.box-header -->
      <div class="box-body">
    <!-- Small boxes (Stat box) -->

    <div class="panel panel-default">
        <div class="row panel-body">
        <div class="col-md-12">
            <!-- /.box-header -->
            <div class="box-body">
              <table class="datatabledigital table table-bordered table-hover">
                <thead>
                  <tr bgcolor="orange">
                    <th>#</th>
                    <th>Solicitante</th>
                    <th>Feca inicio</th>
                    <th>Fecha entrega</th>
                    <th>Observación</th>
                    <th>Detalle</th>
                  </tr>
                </thead>
                <tbody>
              <!--  SOL_ID,SOL_USU_RUT,SOL_ASIG_ID,SOL_FECHA_INICIO,SOL_FECHA_TERMINO,SOL_NRO_GRUPOTRAB,SOL_OBSERVACION-->
                <?php foreach ($solicitudes as $key => $value): ?>
                  <tr>
                    <td><?= $value->get("SOL_ID")  ?></td>
                    <td><?= $value->get("SOL_USU_RUT")  ?></td>
                    <td><?= $value->get("SOL_FECHA_INICIO")  ?></td>
                    <td class="bg-danger "><?= $value->get("SOL_FECHA_TERMINO")  ?></td>
                    <td><?= $value->get("SOL_OBSERVACION")  ?></td>
                    <td class="text-center">
                      <a iddetalle="<?= $value->get("SOL_ID")  ?>" class="obtdetalle btn btn-xs btn-success fa fa-eye"></a>
                    </td>
                  </tr>
                <?php endforeach ?>
                </tbody>
              </table>
            </div>
          <!-- /.box-body -->
        </div>

        </div>
      </div>

          <div class="row">
            <div class="col-md-3">
              <div class="box-header">
                <h3 class="box-title">Detalle de la solicitud N° <strong id="setidsol"></strong></h3><br><br><br>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr bgcolor="CCCCCC">
                      <th>Id</th>
                      <th>Producto / insumo</th>
                      <th>Cantidad</th>
                    </tr>
                  </thead>
                  <tbody id="detallesol">
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
   
                  <div class="col-md-5">
                    <div class="box-header">
                      <h3 class="box-title">Asignación de insumos</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="dinamicajax" class="table table-bordered table-hover">
                        
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>



                <div class="col-md-4">
                    <div class="box-header">
                      <h3 class="box-title">Asignación final</h3><br><br><br>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                       <table id="resulasignacion"  class="table table-responsive table-condensed">
                    <thead>
                    <tr>
                      <th>Id</th>
                      <th>Producto/Insumo</th>
                      <th>Cantidad</th>
                    </tr>
                    </thead>
                     <tfoot>
                        <tr class="bg-success">
                          <td>Total asignados</td>
                          <td></td>
                          <td id="total"></td>
                          <td></td>
                        </tr>
                      </tfoot>
                    <tbody id="asignacion">
                    
                    </tbody>
                </table>
                  </div>
                  <!-- /.box-body -->
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-12">
                  <button type="button" id="generarprestamo" class="btn btn-block btn-success btn-flat">Asignar</button>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.row (main row) -->
    <!-- /.content-wrapper -->
    </section>
    </div>
    </div>

    <?php function MISJAVASCRIPTPERSONALIZADO(){  ?>
    <script type="text/javascript" charset="utf-8">
    $(function() {
      $(".datatabledigital").dataTable({
                    lengthMenu: [5,10, 20, 50, 100],
                    cache: false,
                    responsive: true,
                    "pagingType": "simple",
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bInfo": true,
                    "bAutoWidth": false,
                    "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                    }
                });

    });
    var tabla;
    var total = 0;
    var idsol = 0;
    var asignaciones = new Array();
    var productosid = new Array();
    productosid.push(0);
    tabla = $('#dinamicajax').DataTable({
                lengthMenu: [5,10, 20, 50, 100],
                "pagingType": "simple",
                "responsive": true,
                "paging": true,
                "cache": false,
                "processing": true,
                "lengthChange": true,
                "deferRender": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "ajax": {
                    "url": "<?=site_url('/gestion/get_inv_by_productos_id')?>",
                    "type": "POST",
                    "data": function (argument) {
                      return {'productosid': productosid};
                    },
                    "dataSrc": function ( json ) {
                        return json;
                    }
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                },
                "columns": [
                    { title: "Id",
                        className: "text-sm" },
                    { title: "Stock",
                        className: "text-red text-center"},
                    { title: "Nombre",
                        className: "text-green text-center"},
                    { title: "Cantidad",
                        className: "text-sm"},
                    { title: "Accion"}]
            });

     $(document).on('click','.obtdetalle',function(argument) {
      limpiar();
      idsol = $(this).attr("iddetalle");
      $("#setidsol").text(idsol);
      $.ajax({
                    method: "POST",
                    url: "<?=site_url('/gestion/get_detalle_solicitud')?>",
                    datatype: "json",
                    data:  {"idsolicitud": idsol},
                    success: function(response){
                        response.forEach(function(rr) {
                        var obj = JSON.parse(rr);
                        $("#detallesol").append('<tr><td>'+obj.ID+'</td><td>'+obj.PROD_NOMBRE+'</td><td>'+obj.CANTIDAD+'</td></tr>')
                        productosid.push(obj.PROD_ID);
                        $('#dinamicajax').DataTable().ajax.reload();
                    });              
                    }
           })
    })

    $(document).on('click', '.ADDinv', function(){
    var id = $(this).attr("id");
    var stockactual = $(this).attr("cant");
    var nom = $(this).attr("nom");
    var tipo = $(this).attr("tipo");
    if(asignaciones.indexOf(id) == -1){  
            if (tipo == 1) {
              $("#asignacion").append('<tr><td>'+id+'</td><td>'+nom+'</td><td>'+stockactual+'</td><td><a style="cursor:pointer;" id="DEL'+id+'" cant="'+stockactual+'" class="conlabel fa fa-trash"></a></td></tr>');
              asignaciones.push(id);
              total= parseInt(total)+parseInt(stockactual);
            }else if(tipo == 2){
               cant = $("#INPUT"+id).val();
               if (parseInt(cant) <= parseInt(stockactual) && parseInt(cant) != 0) {
                    $("#asignacion").append('<tr><td>'+id+'</td><td>'+nom+'</td><td>'+cant+'</td><td><a style="cursor:pointer;" id="DEL'+id+'" cant="'+cant+'" class="conlabel fa fa-trash"></a></td></tr>');
                  asignaciones.push(id);
                  total= parseInt(total)+parseInt(cant);
               }else{
                alert("La cantidad no debe exceder el stock actual, Usted esta ingresando actualmente: "+cant);
               }
            }
            $("#total").text(total);
      }else{
        alert("El producto o insumo que desea agregar, ya está agregado");
        return false;
      }
   })


   $("#generarprestamo").click(function (argument) {
    var observaciones = prompt('Ingrese una obeservación para poder asignar productos a esta solicitud:','');
    var arrayasig = new Array();
    
    if (observaciones != "") {
         $("#resulasignacion tbody tr").each(function (index) 
        {
            var idinv, nombreinv, cantidadinv;
            $(this).children("td").each(function (index2) 
            {
                switch (index2) 
                {
                    case 0: idinv = $(this).text();
                            break;
                    case 1: nombreinv = $(this).text();
                            break;
                    case 2: cantidadinv = $(this).text();
                            break;
                }
                $(this).css("background-color", "#ECF8E0");
            })
            arrayasig.push({'idinv': idinv,'cantidadinv': cantidadinv,'nombreinv' : nombreinv });
        })
         $.ajax({
                    method: "POST",
                    url: "<?=site_url('/gestion/insert_entrega_digital')?>",
                    datatype: "json",
                    data:  {"asignaciones": arrayasig,"observaciones": observaciones,"idsolicitud": idsol},
                    success: function(response){
                        if (response.resultado) {
                          alert(response.mensaje);
                          var win = window.open('', '_blank');
                          win.location.href = response.path;
                          location.reload();
                        } else{
                          alert(response.mensaje);
                        }      
                    }
           })
       }else{
          alert("Debe ingresar una observación");
       } 
   });


   $(document).on('click','.conlabel', function(){
          var id = $(this).attr("id");
          var cant = $(this).attr("cant");
          total = parseInt(total)-parseInt(cant);
          id = id.replace('DEL', "");
          $(this).parent().parent().remove();
          var index = asignaciones.indexOf(id);
            if (index > -1) {
               asignaciones.splice(index, 1);
            }
          $("#total").text(total);
        });

   function limpiar(){
    idsol = 0;
    $("#asignacion").text("");
    asignaciones = new Array();
    productosid = new Array();
    $("#detallesol").text('');
    $("#setidsol").text("");
   }

    </script>
    <?php } ?>
