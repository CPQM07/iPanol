<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>
            Mantenedor | Productos
          </h3>
        </div>
        <div class="col-sm-6"><br>
          <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#newPro">Agregar nuevo producto</button>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Categoria</th>
                  <th>Tipo de producto</th>
                  <th>Stock total</th>
                  <th>Stock crítico</th>
                  <th>Stock crítico margen</th>
                  <th>Eliminar</th>
                  <th>Editar</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Martillo</td>
                  <td>Herramientas</td>
                  <td>No consumible</td>
                  <td>90</td>
                  <td>20</td>
                  <td>30</td>
                  <td>
                    <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#myModal"><i class="fa fa-remove"></i></button>
                  </td>
                  <td><button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myEdit"><i class="fa fa-edit"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>Alicate</td>
                  <td>Herramientas</td>
                  <td>No consumible</td>
                  <td>33</td>
                  <td>10</td>
                  <td>15</td>
                  <td>
                    <button type="button" class="btn btn-danger btn-block"><i class="fa fa-remove"></i></button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-success btn-block"><i class="fa fa-edit"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>RJ45</td>
                  <td>Connectores</td>
                  <td>Consumibles</td>
                  <td>60</td>
                  <td>20</td>
                  <td>22</td>
                  <td>
                    <button type="button" class="btn btn-danger btn-block"><i class="fa fa-remove"></i></button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-success btn-block"><i class="fa fa-edit"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>RJ11</td>
                  <td>Conectores</td>
                  <td>Consumibles</td>
                  <td>66</td>
                  <td>20</td>
                  <td>35</td>
                  <td>
                    <button type="button" class="btn btn-danger btn-block"><i class="fa fa-remove"></i></button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-success btn-block"><i class="fa fa-edit"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>Cautín</td>
                  <td>Herramienta</td>
                  <td>No consumible</td>
                  <td>20</td>
                  <td>8</td>
                  <td>10</td>
                  <td>
                    <button type="button" class="btn btn-danger btn-block"><i class="fa fa-remove"></i></button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-success btn-block"><i class="fa fa-edit"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>Pistola de calor</td>
                  <td>Herramientas</td>
                  <td>No consumible</td>
                  <td>20</td>
                  <td>10</td>
                  <td>15</td>
                  <td>
                    <button type="button" class="btn btn-danger btn-block"><i class="fa fa-remove"></i></button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-success btn-block"><i class="fa fa-edit"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>Resistecia 100 Ohm</td>
                  <td>Electrónico</td>
                  <td>Consumible</td>
                  <td>80</td>
                  <td>10</td>
                  <td>20</td>
                  <td>
                    <button type="button" class="btn btn-danger btn-block"><i class="fa fa-remove"></i></button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-success btn-block"><i class="fa fa-edit"></i></button>
                  </td>
                </tr>
                
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!--modalPRODUCTONUEVO-->
  <!--modalPRODUCTONUEVO-->
    <div class="modal fade bs-example-modal-lg" id="newPro" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-tittle">Nuevo producto</h4>
            <div class="modal-body">
              <div class="box">
                <div class="row">
                  <form class="form-horizontal">
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Nombre</label>

                        <div class="col-md-9">
                          <input type="text" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Categoria</label>

                        <div class="col-md-9">
                          <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Seleccione una categoria</option>
                            <option>Herramientas</option>
                            <option>Cables</option>
                            <option>Resistencias</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Tipo</label>

                        <div class="col-md-9">
                          <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Seleccione un tipo</option>
                            <option>Fungible</option>
                            <option>Activo</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Stock total</label>

                        <div class="col-md-9">
                          <input type="number" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Stock crítico</label>

                        <div class="col-md-9">
                          <input type="number" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Stock margen</label>

                        <div class="col-md-9">
                          <input type="number" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Posición</label>

                        <div class="col-md-9">
                          <input type="text" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Prioridad</label>

                        <div class="col-md-9">
                          <input type="number" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Año requerido</label>

                        <div class="col-md-9">
                          <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Seleccione el año</option>
                            <option>Alumnos de primer año</option>
                            <option>Alumnos de segundo año</option>
                            <option>Alumnos de tercer año</option>
                            <option>Profesores</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <!-- /.box-body -->
                      <div class="row">
                        <div class="col-sm-6">
                          <button type="submit" class="btn btn-default col-md-12" data-dismiss="modal">Cancelar</button>
                        </div>
                        <div class="col-sm-6">
                          <button type="submit" class="btn btn-danger col-md-12">Agregar</button>
                        </div>
                      </div>
                    <!-- /.box-footer -->
                  </form>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  <!--modalPRODUCTONUEVO-->
  <!--modalPRODUCTONUEVO-->


  <!--ModalELIMINAR-->
  <!--ModalELIMINAR-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
      <div class="modal-danger" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Eliminar un producto</h4>
          </div>
          <div class="modal-body">
            <p>Está seguro de eliminar el producto <strong>Martillo</strong></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger">Eliminar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!--ModalELIMINAR-->
  <!--ModalELIMINAR-->
  <!--modalPRODUCTONUEVO-->
  <!--modalPRODUCTONUEVO-->
    <div class="modal fade bs-example-modal-lg" id="myEdit" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-tittle">Editar producto</h4>
            <div class="modal-body">
              <div class="box">
                <div class="row">
                  <form class="form-horizontal">
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Nombre</label>

                        <div class="col-md-9">
                          <input type="text" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Categoria</label>

                        <div class="col-md-9">
                          <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Seleccione una categoria</option>
                            <option>Herramientas</option>
                            <option>Cables</option>
                            <option>Resistencias</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Tipo</label>

                        <div class="col-md-9">
                          <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Seleccione un tipo</option>
                            <option>Fungible</option>
                            <option>Activo</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Stock total</label>

                        <div class="col-md-9">
                          <input type="number" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Stock crítico</label>

                        <div class="col-md-9">
                          <input type="number" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Stock margen</label>

                        <div class="col-md-9">
                          <input type="number" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Posición</label>

                        <div class="col-md-9">
                          <input type="text" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Prioridad</label>

                        <div class="col-md-9">
                          <input type="number" class="col-md-12">
                        </div>
                      </div>
                    </div>
                    <!-- /.box-body -->
                      <div class="row">
                        <div class="col-sm-6">
                          <button type="submit" class="btn btn-default col-md-12" data-dismiss="modal">Cancelar</button>
                        </div>
                        <div class="col-sm-6">
                          <button type="submit" class="btn btn-danger col-md-12">Agregar</button>
                        </div>
                      </div>
                    <!-- /.box-footer -->
                  </form>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>