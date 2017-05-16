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
                  <option selected="selected">Asignatura</option>
                  <option>Sistemas de información II</option>
                  <option>Sistemas de información II</option>
                  <option>Ingenieria de Software</option>
                  <option>Ingenieria de Software</option>
                  <option>Fundamentos de Programación</option>
                  <option>Fundamentos de Programación</option>
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
              <input type="text" class="form-control">
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
                    <input type="radio" name="r1" class="minimal" checked>
                  </label> - 
                  <label>Fungible
                    <input type="radio" name="r1" class="minimal pull-right">
                  </label>
                </div>
              </div>
            <!-- /.box-body -->

            </div>
          <!-- /.box -->
            <div class="col-md-4">
            <label>Categorias</label>
              <div class="form-group">
                <select class="form-control select2" style="width: 100%;">
                  <option selected="selected">Martillo</option>
                  <option>Resistencias</option>
                  <option>Soldadura</option>
                  <option>Diodos led</option>
                  <option>Herramientas</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
            <label>Filtrar producto/insumos</label>
              <div class="form-group">
                <button type="button" class="btn btn-block btn-success fa fa-filter">Filtrar</button>
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
                  <table class="datatable2 table table-responsive table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>Stock Actual</th>
                      <th>Insumo</th>
                      <th>Cantidad</th>
                      <th>Asignar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>50</td>
                      <td>Martillo</td>
                      <td disabled >1</td>
                      <td class="text-center"><a class="fa fa-plus"></a></td>
                    </tr>
                    <tr>
                      <td>200</td>
                      <td>RJ45</td>
                      <td><input type="number" style="width: 40px"></td>
                      <td class="text-center"><a class="fa fa-plus"></a></td>
                    </tr>
                    <tr>
                      <td>289</td>
                      <td>RJ11</td>
                      <td><input type="number" style="width: 40px"></td>
                      <td class="text-center"><a class="fa fa-plus"></a></td>
                    </tr>
                </tbody>
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
                  <table class="datatable2 table table-responsive table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>Tipo del Insumo</th>
                      <th>Insumo</th>
                      <th>Cantidad</th>
                    </tr>
                    </thead>
                     <tfoot>
                        <tr class="bg-success">
                          <td>Total asignados</td>
                          <td></td>
                          <td>13</td>
                        </tr>
                      </tfoot>
                    <tbody>
                    <tr>
                      <td>Activo</td>
                      <td>Martillo</td>
                      <td>1</td>
                    </tr>
                    <tr>
                      <td>Fungible</td>
                      <td>RJ45</td>
                      <td>7</td>
                    </tr>
                    <tr>
                      <td>Fungible</td>
                      <td>RJ11</td>
                      <td>5</td>
                    </tr>
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
                <button type="button" class="btn btn-block btn-success btn-flat">Generar prestamo</button>
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

</script>
<?php } ?>