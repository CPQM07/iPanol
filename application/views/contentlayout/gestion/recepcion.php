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
            <div class="table-responsive box-body">
              <table id="tablaajax" class=" table table-bordered table-hover">
               
              </table>
            </div>
          <!-- /.box-body -->
        </div>

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


    <div class="modal fade bs-example-modal-lg" id="recproins" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div class="modal-body">
              <div class="box">
                <div class="row">
                    <div class="box-body">     
                        <div class="row">
                          <div class="col-md-12">
                            <div class="box-header col-md-12">
                              <div class="col-md-6">
                                <h3 class="box-title">Confirmación de recepción Productos N°<strong id="numsol"></strong></h3>
                              </div>
                              <div class="col-md-6">
                                <input type="text" class="form-control" id="buscador" placeholder="Aquí ingrese el Lector de códigos de barra ||||||||||">
                              </div>
                              
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                              <table id="example2" class="table table-responsive table-bordered table-hover">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>Producto</th>
                                    <th class="text-center">Asignados</th>
                                    <th class="text-center">Recepcionados</th>
                                    <th class="text-center"><input id="todoscheck" onclick="toggleSwitch()" data-width="100" data-toggle="toggle" class="pull-left" data-on="Todos" data-off="Ninguno" type="checkbox" /></th>
                                  </tr>
                                </thead>
                                <tbody id="tableasignacionesresultado">
                                </tbody>
                              </table>
                            </div>
                            <!-- /.box-body -->
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <button type="button" class="btn btn-default col-md-12" data-dismiss="modal">Cancelar</button>
                        </div>
                        <div class="col-sm-3">
                          <button type="button" value="reccer" class="recepcionar btn btn-danger col-md-12">Recepcionar/Cerrar</button>
                        </div>
                        <div class="col-sm-3">
                          <button type="button" value="rec" class="recepcionar btn btn-danger col-md-12">Recepcionar</button>
                        </div>
                      </div>
                    <!-- /.box-footer -->
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php function MISJAVASCRIPTPERSONALIZADO(){ ?>
   <script type="text/javascript" charset="utf-8">
    var tabla;    
       $(function () {
          tabla = $('#tablaajax').DataTable({
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
                    "url": "<?=site_url('/gestion/recepcion_ajax')?>",
                    "type": "POST",
                    "beforeSend": function () {
                            $('#carga_modal').modal('show');
                        },
                    "dataSrc": function ( json ) {
                      $('#carga_modal').modal('hide');
                        return json;
                    }
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                },
                "columns": [
                    { title: "ID",
                        className: "text-center" },
                    { title: "RUT",
                        className: "text-red text-center"},
                    { title: "Fecha de Inicio",
                        className: "text-green text-center"},
                    { title: "Fecha de Término",
                        className: "text-sm text-center"},
                    { title: "Cargo",
                        className: "text-sm text-center"},
                    { title: "PDF",
                        className: "text-center"},
                    { title: "Acción"}]
            });

$(document).on("click",".getasignaciones",function (argument) {
    clean();
     var idsol = $(this).attr("idsol");
     $("#numsol").text(idsol);
         $.ajax({
                    method: "POST",
                    url: "<?=site_url('/gestion/get_all_asignaciones_by_sol')?>",
                    datatype: "json",
                    data:  {"idsolicitud": idsol},
                    beforeSend: function () {
                            $('#carga_modal').modal('show');
                        },
                    success: function(response){
                      if (response.estado) {
                        var obj = JSON.parse(response.allasig);
                        obj.forEach(function(rr){
                          var checked = "";

                          if (parseInt(rr.ASIG_ESTADO) == 2 ) {
                              checked = "checked";
                            }
                          if (parseInt(rr.INV_TIPO_ID) == 1) {
                             
                            
                           $("#tableasignacionesresultado").append('<tr><td>'+rr.ASIG_ID+'</td><td>'+rr.INV_PROD_NOM+'(#'+rr.INV_ID+')'+'</td><td class="text-center">'+rr.INV_PROD_CANTIDAD+'</td><td class="text-center">'+rr.INV_PROD_CANTIDAD+'</td><td class="text-center"><input type="checkbox" data-toggle="toggle" data-onstyle="success" data-on="Si" data-off="No" tipo="'+rr.INV_TIPO_ID+'" id="ASI'+rr.INV_PROD_CODIGO+'" value="'+rr.ASIG_ID+'"  '+checked+'  name="todo" class="items" /></td></tr>');
                            }else{
                              $("#tableasignacionesresultado").append('<tr><td>'+rr.ASIG_ID+'</td><td>'+rr.INV_PROD_NOM+'(#'+rr.INV_ID+')'+'</td><td class="text-center">'+rr.ASIG_CANT+'</td><td class="text-center"><input type="number" min="1" max="'+rr.ASIG_CANT+'" id="UFC'+rr.ASIG_ID+'" class="form-control validar" placeholder="Cantidad recibida" value="'+rr.ASIG_CANT_DEVUELTA+'"/></td><td class="text-center"><input type="checkbox" data-toggle="toggle" id="ASI'+rr.INV_PROD_CODIGO+'" data-onstyle="success" data-on="Si" data-off="No" tipo="'+rr.INV_TIPO_ID+'" value="'+rr.ASIG_ID+'"  '+checked+'  name="todo" class="items" /></td></tr>');
                            }
                            $('.items').bootstrapToggle();
                        })
                         $.notify(response.mensaje, "success");
                      }else{
                        $.notify(response.mensaje, "warn"); 
                      }            
                    },
                    complete:function (argument) {
                      $('#carga_modal').modal('hide');
                    }
           })

   })
       })

    $(document).on("change","#todoscheck",function (argument) {
        if ($(this).is(":checked")) {
          $('.items').bootstrapToggle('on');
        }
        else{
         $('.items').bootstrapToggle('off');
      }  
    })

    $(document).on("keyup","#buscador",function (argument) {
        var etiqueta = $(this);
        var asieti = $('#ASI'+etiqueta.val()+'').bootstrapToggle('on');
        if (asieti.is(":checked")) etiqueta.val("").focus();

    })
          

   $(".recepcionar").click(function(event) {
   var countallbox = 0;
   var recepcionarsiono = $(this).val();
    var countchcheados = 0;
    var arrayidcheckeados = new Array();
    var arraycheckeadosmascantidad = new Array();
    var arrayidnocheckeados = new Array();
    var flagcerrarsolono =false;
    var numsolicitud = $("#numsol").text();
     $("input:checkbox[name='todo']").each(function() {
            countallbox++;
            if (this.checked) {
               countchcheados++;
               if ($(this).attr("tipo") == 1) {

                arrayidcheckeados.push($(this).val());

               }else if ($(this).attr("tipo") == 2) {

                arraycheckeadosmascantidad.push({"idasignacion":$(this).val(),"cantidad":$("#UFC"+$(this).val()+"").val() });

               }

            }else{
               arrayidnocheckeados.push($(this).val());
            }
      });
     if (countchcheados == countallbox) {
      flagcerrarsolono = true;
     }
              $.ajax({
                    method: "POST",
                    url: "<?=site_url('/gestion/update_asignaciones_recepcionadas')?>",
                    datatype: "json",
                    data:  {"idcheckeados": arrayidcheckeados , "resultadocerrarono": flagcerrarsolono,"nocheckeados": arrayidnocheckeados,"idsol" : numsolicitud ,"checkeadostipo2": arraycheckeadosmascantidad,"flagrecepcionarocerrar" : recepcionarsiono},
                    beforeSend: function () {
                            $('#carga_modal').modal('show');
                        },
                    success: function(response){
                      if (response.estado) {
                         $.notify(response.mensaje, "success");
                         $('#recproins').modal('hide');
                      }else{
                        $.notify(response.mensaje, "warn"); 
                      }            
                    },
                    complete:function (argument) {
                      $('#tablaajax').DataTable().ajax.reload();
                      $('#carga_modal').modal('hide');
                    }
                 })

   });


   $(document).on("keyup",".validar",function(argument) {
     var cantidadingresada  =  $(this).val();
     var cantidadmaxima  =  $(this).attr("max");
     if (parseInt(cantidadmaxima) < parseInt(cantidadingresada)) {
        $.notify("Error la cantidad ingresada para recepcionar no puede superar lo solicitado", "warn");
        $(this).val(0); 
     }
     if (parseInt(cantidadingresada) < 0) {
        $.notify("Error la cantidad ingresada para recepcionar debe ser mayor o igual a 0", "warn");
        $(this).val(0); 
     }

   })

   function clean(){
     $("#tableasignacionesresultado").text("");
     $("#numsol").text("");
   }

  </script>
  <?php } ?>