 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) --> 
      <!-- /.box-header -->
      <div class="box-body">
  <div class="content">
  <div class="row">

    <div class="panel panel-default">
        <div class="row panel-body">
          <div class="col-md-4">
            <div class="form-group">
              <select id="Cargo" class="form-control">
                <option value="0">Seleccionar</option>
                <option value="2">Profesor</option>
                <option value="1">Alumno</option>
              </select>
            </div>
            <!-- /.form-group -->
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <select id="usuariossel" class="form-control select2" style="width: 100%;">
                <option></option>
              </select>
            </div>
            <!-- /.form-group -->
          </div>
          <div class="col-md-4">
            <div class="form-group">
                <select id="asignatura" class="form-control select2" style="width: 100%;">
                 <option></option>
                 <?php foreach ($asignaturas as $key => $value): ?>
                  <?php if ($value->get('ASIGNATURA_ESTADO') == 1): ?>
                  <option value=" <?= $value->get('ASIGNATURA_ID') ?>" ><?= $value->get('ASIGNATURA_NOMBRE') ?></option>
                  <?php endif ?>
                 <?php endforeach ?>
                </select>
              </div>
              <!-- /.form-group -->
            <!--<button type="button" class="btn btn-block btn-success">Buscar</button>-->
          </div>
          <!-- /.col -->
        </div>
    </div>

        <div class="panel panel-default">
          <div class="row panel-body">
            <div class='col-md-8'>
               <!-- Date and time range -->
              <div class="form-group">
                <label>Rango de fechas y horas:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="reservationtime">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              </div>
            <div class="col-md-4">
              <label>Número de grupos de trabajo</label>
              <input id="grupotrabajo" type="number" class="form-control">
            </div>
          </div>
        </div>
         <!-- /EMPIEZA PANEL QUE ENCIERRA LAS DOS TABLAS -->
        <div class="panel panel-default">
          <div class="row panel-body">
            <!-- /EMPIEZA PRIMERA TABLA -->
            <div class="col-md-6">
                
              <div class="panel panel-body panel-info">
                <div class="col-md-6">
              <label>Tipo de insumo</label>
                <!-- iCheck -->
                <div class="box-body">
                  <div class="form-group">
                      <input type="radio" val="1" name="r1" class="minimal" checked>Activo</input>
                      <input type="radio" val="2" name="r1" class="minimal">Fungible</input>
                  </div>
                </div>
            <!-- /.box-body -->
            </div>
          <!-- /.box -->
            <div class="col-md-6">
            <label>Categorias</label>
              <div class="form-group">
                <select id="categoria" class="form-control select2" style="width: 100%;">
                  <option value="0"></option>
                  <?php foreach ($categorias as $key => $value): ?>
                    <?php if ($value->get("CAT_ESTADO") == 1): ?>
                       <option value=" <?= $value->get('CAT_ID')  ?>"><?= $value->get('CAT_NOMBRE')  ?></option>
                    <?php endif ?>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
              </div>
               
                <div class="box-body">
                  <table id="dinamicajax" class="table table-responsive table-bordered table-hover">
                </table>
              </div>
            </div>
             <!-- /.TERMINA PRIMERA TABLA -->
              <!-- /EMPIEZA SEGUNDA TABLA -->
              <div class="col-md-6 panel panel-body panel-info">
                <div class="box-header text-center">
                  <h3 class="box-title">Asignados</h3>
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
                    <tbody id="asignacion"></tbody>
                </table>
              </div>
            </div>

                <!-- /TERMINA SEGUNDA TABLA -->
          </div>
        </div>
         <!-- /TERMINA PANEL QUE ENCIERRA LAS DOS TABLAS -->

            <div class="row">
              <div class="col-md-6">
              </div>
              <div class="col-md-6">
                <button type="button" id="generarprestamo" class="btn btn-block btn-success btn-flat">Generar prestamo</button>
              </div>
            </div>

            </div> <!-- /ROW -->
        </div> <!-- /CONTENT -->
      </div><!-- BOX BODY -->
    </div> <!-- /CONTENT-WRAPPER -->

<?php function MISJAVASCRIPTPERSONALIZADO(){  ?>
<script type="text/javascript" charset="utf-8">
 var tipo = 0;
  var cat =0;
  $(function () {
     tipo = 0;
      cat =0;
          $('#reservationtime').daterangepicker({
                minDate: moment(),
                showWeekNumbers: true,
                timePicker: true,
                timePicker24Hour: true,
                startDate: moment(),
                dateLimit: {
                    days: 5
                },
                minDate: moment(),
                locale: {format: 'DD/MM/YYYY HH:mm:ss'},
              },function (start, end) {
                $('#daterange-btn span').html(start.format('DD/MM/YYYY HH:mm:ss') + '-' + end.format('DD/MM/YYYY HH:mm:ss'));
              }
            );

});
  var tabla;
  var total = 0;
  var asignaciones = new Array();
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
                    "url": "<?=site_url('/gestion/get_inv_by_cat_tipo_ajax')?>",
                    "type": "POST",
                    "beforeSend": function () {
                            $('#carga_modal').modal('show');
                        },
                    "data": function (argument) {
                      return {'idtipo': tipo,'idcat': cat };
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
                    { title: "Id",
                        className: "text-sm hidden" },
                    { title: "Codigo",
                        className: "text-sm"},
                    { title: "Stock",
                        className: "text-red text-center"},
                    { title: "Nombre",
                        className: "text-green text-center"},
                    { title: "Cantidad",
                        className: "text-sm"},
                    { title: "Accion"}]
            });

                            

   $("#Cargo").on("change",function(event){
    var id = $(this).val();
    $("#usuariossel").text("");
      if (id != 0) {
            $.ajax({
                    method: "POST",
                    url: "<?=site_url('/gestion/get_user_by_cargo_ajax')?>",
                    datatype: "json",
                    data:  {"idcargo": id},
                    success: function(response){
                        response.forEach(function(entry) {
                         var obj = JSON.parse(entry);
                         $("#usuariossel").append(new Option(obj.RUT+obj.DV+" | "+obj.NOMBRES, obj.RUT, true, true));  
                    });               
                    }
           })
      }
   })
   $(document).on('change', '#categoria, .minimal', function() {
    tipo = $('input:radio[name=r1]:checked').attr("val");
     cat = $("#categoria").val();
     if (tipo != 0 && cat != 0) {
           $('#dinamicajax').DataTable().ajax.reload();
     }
   });


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
              $.notify("Se han añadido "+stockactual+" "+nom+"(#"+id+") ", "success");
            }else if(tipo == 2){
               cant = $("#INPUT"+id).val();
               if (parseInt(cant) <= parseInt(stockactual) && parseInt(cant) != 0) {
                    $("#asignacion").append('<tr><td>'+id+'</td><td>'+nom+'</td><td>'+cant+'</td><td><a style="cursor:pointer;" id="DEL'+id+'" cant="'+cant+'" class="conlabel fa fa-trash"></a></td></tr>');
                  asignaciones.push(id);
                  total= parseInt(total)+parseInt(cant);
                  $.notify("Se han añadido "+cant+" "+nom+"(#"+id+") ", "success");
               }else{
                alert("La cantidad no debe exceder el stock actual, Usted esta ingresando actualmente: "+cant);
               }
            }
            $("#total").text(total);
      }else{
          $.notify("El producto o insumo que desea agregar, ya está agregado", "warn");
        return false;
      }
   })

   $(document).on('click','.conlabel', function(){
          var id = $(this).attr("id");
          var cant = $(this).attr("cant");
          total = parseInt(total)-parseInt(cant);
          id = id.replace('DEL', "");
          $(this).parent().parent().remove();
          var index = asignaciones.indexOf(id);
            if (index > -1) {
               asignaciones.splice(index, 1);
               $.notify("Se ha quitado de su lista se asignaciones el P/I #"+id, "error");
            }
          $("#total").text(total);
        });

   $("#generarprestamo").click(function (argument) {
    var observaciones = prompt('Ingrese una obeservación para poder asignar productos a esta solicitud:','');
    if (observaciones === null) {
      $.notify("Ha cancelado la opción de ingresar una observación", "warn");
        return; //break out of the function early
    }
    var rutusu = $("#usuariossel").val();
    var asignatura = $("#asignatura").val();
    var grupotrabajo = $("#grupotrabajo").val();
    var reservationtime = $("#reservationtime").val();

    if ($.trim($("#asignacion").text()) != "") {

    if ($.trim(observaciones) != "") {

      if (asignatura == "") {
        $.notify("No ha seleccionado una asignatura", "warn");
        return; //break out of the function early
      }
      if (grupotrabajo == "") {
        $.notify("No ha escrito ningun numero en el grupo de trabajo", "warn");
        return; //break out of the function early
      }
      if (rutusu == "") {
        $.notify("No ha seleccionado un usuario", "warn");
        return; //break out of the function early
      }
      if (reservationtime == "") {
        $.notify("No ha seleccionado un rango de fechas", "warn");
        return; //break out of the function early
      }



      var arrayasig = new Array();
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
                    url: "<?=site_url('/gestion/insert_entrega_manual')?>",
                    datatype: "json",
                    data:  {"asignaciones": arrayasig,"rutusu": rutusu,"asignatura": asignatura,"grupotrabajo": grupotrabajo,"rangofechas": reservationtime,"observaciones": observaciones},
                    beforeSend: function () {
                            $('#carga_modal').modal('show');
                        },
                    success: function(response){
                        if (response.resultado) {
                          $.notify(response.mensaje, "success");
                          var win = window.open('', '_blank');
                          win.location.href = response.path;
                          location.reload();
                          $('#carga_modal').modal('hide');
                        } else{
                          $.notify(response.mensaje, "warn");
                          $('#carga_modal').modal('hide');
                        }    
                    }
           })
    }else{
    $.notify("Debe ingresar una observación", "warn");
    }

    }else{
      $.notify("Debe a lo menos asignar un producto, actualmente la asignación se encuentra vacía", "warn");
    }
     
   });


</script>
<?php } ?>