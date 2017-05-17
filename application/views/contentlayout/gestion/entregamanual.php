 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3>
        Entrega de insumos
      </h3>
    </section>  
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
                <option value="1">Profesor</option>
                <option value="2">Alumno</option>
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
                <select class="form-control select2" style="width: 100%;">
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
              <input type="number" class="form-control">
            </div>
          </div>
        </div>

       <div class="panel panel-default">
          <div class="row panel-body">
            <div class="col-md-4">
              <label>Tipo de insumo</label>
            <!-- iCheck -->
              <div class="box-body">
                <div class="form-group">
                  <label>Activo
                    <input type="radio" val="1" name="r1" class="minimal"></input>
                  </label>
                  <label>Fungible
                    <input type="radio" val="2" name="r1" class="minimal pull-right"></input>
                  </label>
                </div>
              </div>
            <!-- /.box-body -->

            </div>
          <!-- /.box -->
            <div class="col-md-4">
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
            <div class="col-md-4">
            <label>Filtrar producto/insumos</label>
              <div class="form-group">
                <button type="button" id="filtrar" class="btn btn-block btn-success fa fa-filter">Filtrar</button>
              </div>
            </div>
          </div>
        </div>

         <!-- /EMPIEZA PANEL QUE ENCIERRA LAS DOS TABLAS -->
        <div class="panel panel-default">
          <div class="row panel-body">
            <!-- /EMPIEZA PRIMERA TABLA -->
            <div class="col-md-6">
                <div class="box-header">
                  <h3 class="box-title">Asignacion Productos/Insumos</h3>
                </div>
                <div class="box-body">
                  <table id="dinamicajax" class="table table-responsive table-bordered table-hover">
                </table>
              </div>
            </div>
             <!-- /.TERMINA PRIMERA TABLA -->
              <!-- /EMPIEZA SEGUNDA TABLA -->
              <div class="col-md-6">
                <div class="box-header">
                  <h3 class="box-title">Asignados</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table  class="table table-responsive table-condensed">
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
            </div>
                <!-- /TERMINA SEGUNDA TABLA -->
          </div>
        </div>
         <!-- /TERMINA PANEL QUE ENCIERRA LAS DOS TABLAS -->
          <section class="content">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <h3>Observaciones</h3>
                  <textarea class="form-control" rows="10" placeholder="Ingrese algunas palabras..."></textarea>
                </div>
              </div>
            </div>
            </section>

            <div class="row">
              <div class="col-md-6">
                <button type="button" class="btn btn-block btn-success btn-flat">Generar prestamos</button>
              </div>
              <div class="col-md-6">
                <button type="button" class="btn btn-block btn-success btn-flat">Ver en PDF</button>
              </div>
            </div>

            </div> <!-- /ROW -->
        </div> <!-- /CONTENT -->
      </div><!-- BOX BODY -->
    </div> <!-- /CONTENT-WRAPPER -->

<?php function MISJAVASCRIPTPERSONALIZADO(){  ?>
<script type="text/javascript" charset="utf-8">
    $(function () {
          //Datemask dd/mm/yyyy
          $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
          //Datemask2 mm/dd/yyyy
          $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
          //Money Euro
          $("[data-mask]").inputmask();
          //Date range picker
          $('#reservation').daterangepicker();
          //Date range picker with time picker
          $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
          //Date range as a button
          $('#daterange-btn').daterangepicker(
              {
                ranges: {
                  'Today': [moment(), moment()],
                  'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                  'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                  'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                  'This Month': [moment().startOf('month'), moment().endOf('month')],
                  'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
              },
              function (start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
              }
          )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    })

});
  var tabla;
  var tipo = 0;
  var cat =0;
  var total = 0;
  var asignaciones = new Array();
        tabla = $('#dinamicajax').DataTable({
                lengthMenu: [5,10, 20, 50, 100],
                "pagingType": "simple",
                "responsive": true,
                "paging": true,
                "processing": true,
                "lengthChange": true,
                "deferRender": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "ajax": {
                    "url": "<?=site_url('/gestion/get_inv_by_cat_tipo_ajax')?>",
                    "type": "POST",
                    "data": function (argument) {
                      return {'idtipo': tipo,'idcat': cat };
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
                         $("#usuariossel").append(new Option(obj.RUT+" | "+obj.NOMBRES+" "+obj.APELLIDOS, obj.RUT, true, true));  
                    });               
                    }
           })
      }
   })
   $(document).on('click', '#filtrar', function() {
    tipo = $('input:radio[name=r1]:checked').attr("val");
     cat = $("#categoria").val();
     if (tipo != 0 && cat != 0) {
           $('#dinamicajax').DataTable().ajax.reload();
     }else{
      alert("Debe seleccionar a lo menos un tipo y una categoria");
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
            }else if(tipo == 2){
               cant = $("#INPUT"+id).val();
               if (cant <= stockactual) {
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

</script>
<?php } ?>