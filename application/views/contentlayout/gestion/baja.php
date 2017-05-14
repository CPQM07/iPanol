 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3>Dar de baja</h3>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">

        <div class="panel panel-default">
          <div class="row panel-body">
            <div class="col-md-4">
              <div class="form-group">
                <label>Tipo de producto</label>
                <select class="form-control select2" style="width: 100%;">
                  <option selected="selected">Tipos</option>
                  <option>Activo</option>
                  <option>Fungible</option>
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Categoría</label>
                <select class="form-control select2" style="width: 100%;">
                  <option selected="selected">Seleccionar</option>
                  <option>Herramienta</option>
                  <option>Conectores</option>
                  <option>Cables</option>
                </select>
              </div>
          </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Inventario</label>
                <select class="form-control select2" style="width: 100%;">
                  <option selected="selected">Seleccionar</option>
                  <option>Martillo</option>
                  <option>RJ-45</option>
                  <option>Diodo Led rojo</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Motivo</label>
              <select class="form-control select2" style="width: 100%;">
                <option selected="selected">Motivos</option>
                <option>Reparación</option>
                <option>Malo</option>
                <option>Desgaste</option>
                <option>Baja definitiva</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Descripción</label>
              <input type="textarea" class="form-control">
            </div>
          </div>
          <div class="col-md-4">
            <label>Acción</label>
            <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#myModal">
                  Dar de baja</button>
          </div>
        </div>
        </div>
        <div class="box-body">
          <div class="box-body">
              <table id="example2" class="datatable table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Tipo</th>
                    <th>Categoria</th>
                    <th>Nombre</th>
                    <th>Motivo</th>
                    <th>Motivo resultado</th>
                    <th>Editar</th>
                    <th>Observaciones</th>
                  </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Activo</td>
                  <td>Herramientas</td>
                  <td>Martillo</td>
                  <td>Reparación</td>
                  <td>Reparado</td>
                  <td>
                    <button class="btn btn-block btn-success">Editar</button>
                  </td>
                  <td>
                    <button class="btn btn-block btn-success" data-toggle="modal" data-target=".myObs">Observación</button>
                  </td>
                <tr>
                  <td>Activo</td>
                  <td>Herramientas</td>
                  <td>alicate</td>
                  <td>Baja definitiva</td>
                  <td></td>
                  <td>
                    <button class="btn btn-block btn-success disabled">Editar</button>
                  </td>
                  <td>
                    <button class="btn btn-block btn-success disabled">Observación</button>
                  </td>
                </tr>
                <tr>
                  <td>Fungible</td>
                  <td>Conectores</td>
                  <td>RJ45</td>
                  <td>C1</td>
                  <td></td>
                  <td>
                    <button class="btn btn-block btn-success">Editar</button>
                  </td>
                  <td>
                    <button class="btn btn-block btn-success" data-toggle="modal" data-target=".myObs">Observación</button>
                  </td>
                </tr>
                <tr>
                  <td>Fungible</td>
                  <td>Diodos</td>
                  <td>Diodo led rojo</td>
                  <td>D1</td>
                  <td></td>
                  <td>
                    <button class="btn btn-block btn-success">Editar</button>
                  </td>
                  <td>
                    <button class="btn btn-block btn-success" data-toggle="modal" data-target=".myObs">Observación</button>
                  </td>
                </tr>
                <tr>
                  <td>Fungible</td>
                  <td>Resistencias</td>
                  <td>Resistencia 1K Ohm</td>
                  <td>E1</td>
                  <td></td>
                  <td>
                    <button class="btn btn-block btn-success">Editar</button>
                  </td>
                  <td>
                    <button class="btn btn-block btn-success" data-toggle="modal" data-target=".myObs">Observación</button>
                  </td>
                </tr>
                <tr>
                  <td>Fungible</td>
                  <td>Cables</td>
                  <td>Coaxial 1.5</td>
                  <td>F1</td>
                  <td></td>
                  <td>
                    <button class="btn btn-block btn-success">Editar</button>
                  </td>
                  <td>
                    <button class="btn btn-block btn-success" data-toggle="modal" data-target=".myObs">Observación</button>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
        </div>
      </div>
      <!-- /.box -->





    </section>
    <!-- /.content -->
  </div>
  <!--ModalELIMINAR-->
  <!--ModalELIMINAR-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
      <div class="modal-danger" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Eliminar producto</h4>
          </div>
          <div class="modal-body">
            <p>Está seguro de eliminar al producto <strong>Martillo</strong></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger">Eliminar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!--Modal-->
  <!--Modal-->



<!--Observaciones-->
    <div class="modal fade myObs" aria-labelledby="myModalLabel">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            <h4 class="modal-title" id="myModalLabel">Editar ingreso</h4>
          </div>
          <div class="modal-body">
              <div class="box-body">

                <div class="form-group ">
                  <label >Texto</label>
                  <input type="text" class="form-control pull-right col-md-6"  placeholder="Ingrese el texto">
                </div>
                <br>
                <div class="form-group">
                  <label>Motivo</label>
                  <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Motivos</option>
                    <option>Reparado</option>
                    <option>Merma</option>
                    <option>Necesita presupuesto</option>
                    <option>En espera de repuestos</option>
                  </select>
               </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success">Guardar datos</button> 
          </div>
        </div>
      </div>
    </div>
  <!--Observaciones-->