 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3>
        Entrega de insumos
      </h3>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
      <!-- /.box-header -->
      <div class="box-body">
    <!-- Small boxes (Stat box) -->

    <div class="panel panel-default">
        <div class="row panel-body">
          <div class="col-md-4">
            <div class="form-group">
              <select class="form-control select2" style="width: 100%;">
                <option selected="selected">Profesor</option>
                <option>Alumno</option>
              </select>
            </div>
            <!-- /.form-group -->
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <select class="form-control select2" style="width: 100%;">
                <option selected="selected">Raúl Silva | 6536372-8</option>
                <option>Alfredo Araya | 6536372-8</option>
                <option>Samuel Videla | 6536372-8</option>
                <option>Javier Miles | 6536372-8</option>
                <option>Alexis Fuentealba | 6536372-8</option>
                <option>Andres Zulian | 6536372-8</option>
                <option>Mauricio Solar | 6536372-8</option>
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
            <div class='col-sm-8'>
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
            <div class="col-xs-4">
              <label>Número de grupos de trabajo</label>
              <input type="text" class="form-control">
            </div>
          </div>
        </div>


        <div class="panel panel-default">
          <div class="row panel-body">
            <div class="col-sm-4">
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
          <div class="col-sm-4">
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
          <div class="col-sm-4">
          <label>Filtrar producto/insumos</label>
            <div class="form-group">
              <button type="button" class="btn btn-block btn-success fa fa-filter">Filtrar</button>
            </div>
          </div>
          </div>
          </div>



        <div class="panel panel-default">
          <div class="row panel-body">
            <div class="col-md-6">
            <div class="box-header">
              <h3 class="box-title">Asignacion Productos/Insumos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
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
          <!-- /.box-body -->
        </div>
          <!-- /.box -->
          <div class="col-md-6">
            <div class="box-header">
              <h3 class="box-title">Asignados</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
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
          <!-- /.box-body -->
        </div>
        </div>
        </div>



          <section class="content">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <h3>Observaciones</h3>
                  <textarea class="form-control" rows="10" placeholder="Ingrese algunas palabras..."></textarea>
                </div>
              </div>
            </div>
            </section>
            <div class="row">
              <div class="col-sm-6">
                <button type="button" class="btn btn-block btn-success btn-flat">Generar prestamo</button>
              </div>
              <div class="col-sm-6">
                <button type="button" class="btn btn-block btn-success btn-flat">Ver en PDF</button>
              </div>

            </div>
            </div>
          </div>

    
        </div>
        <!-- /.row (main row) -->
    <!-- /.content-wrapper -->