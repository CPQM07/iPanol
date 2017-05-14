<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>
            Mantenedor | Usuarios
          </h3>
        </div>
        <div class="col-sm-6"><br>
          <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#newUsu">Agregar nuevo Usuario</button>
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
              <table id="example1" class="datatable table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Carrera</th>
                  <th>Semestre</th>
                  <th>Correo</th>
                  <th>Teléfono</th>
                  <th>Eliminar</th>
                  <th>Editar</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Alberto Matías</td>
                  <td>Nuñes Velis</td>
                  <td>Analista Programador</td>
                  <td> 4</td>
                  <th>alberto.nunes@inacapmail.cl</th>
                  <th>9 7663 1267</th>
                  <td>
                    <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#myModal"><i class="fa fa-remove"></i></button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myEdit"><i class="fa fa-edit"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>Beatriz Fernanda</td>
                  <td>Figueroa Muñoz</td>
                  <td>Analista Programador</td>
                  <td> 4</td>
                  <th>beatriz.figueroa@inacapmail.cl</th>
                  <th>9 8766 9704</th>
                  <td>
                    <button type="button" class="btn btn-danger btn-block"><i class="fa fa-remove"></i></button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-success btn-block"><i class="fa fa-edit"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>María Jose</td>
                  <td>Correo Serrano</td>
                  <td>Analista Programador</td>
                  <td> 4</td>
                  <th>maria.jose@inacapmail.cl</th>
                  <th>9 8762 1097</th>
                  <td>
                    <button type="button" class="btn btn-danger btn-block"><i class="fa fa-remove"></i></button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-success btn-block"><i class="fa fa-edit"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>Angelica Camila</td>
                  <td>Cortes Silva
                  </td>
                  <td>Analista Programador</td>
                  <td> 4</td>
                  <th>angelica.cortes@inacapmail.cl</th>
                  <th>9 3474 1298</th>
                  <td>
                    <button type="button" class="btn btn-danger btn-block"><i class="fa fa-remove"></i></button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-success btn-block"><i class="fa fa-edit"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>Eduardo Esteban</td>
                  <td>Araya Araya</td>
                  <td>Ingeniería en Informática</td>
                  <td> 4</td>
                  <th>eduardo.araya@inacapmail.cl</th>
                  <th>9 5862 7123</th>
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





  <!--ModalAGREGARUSUARIO-->
  <!--ModalAGREGARUSUARIO-->
    <div class="modal fade bs-example-modal-lg" id="newUsu" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-tittle">Nuevo Usuario</h4>
            <div class="modal-body">
              <div class="box">
                <div class="row">
                  <form class="form-horizontal">
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Nombres</label>

                        <div class="col-md-9">
                          <input type="text" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Apellidos</label>

                        <div class="col-md-9">
                          <input type="text" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Rut</label>

                        <div class="col-md-9">
                          <input type="text" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Cargo</label>

                        <div class="col-md-9">
                          <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Seleccione un cargo</option>
                            <option>Administrativo</option>
                            <option>Profesor</option>
                            <option>Estudiante</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Carrera</label>

                        <div class="col-md-9">
                          <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Seleccione una carrera</option>
                            <option>Ingenieria en Informática</option>
                            <option>Electrónica</option>
                            <option>Telecomunicaciones</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>

                        <div class="col-md-9">
                          <input type="email" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Teléfono</label>

                        <div class="col-md-9">
                          <input type="number" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Teléfono opcional</label>

                        <div class="col-md-9">
                          <input type="number" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Clave</label>

                        <div class="col-md-9">
                          <input type="text" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Estado</label>

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


  <!--ModalAGREGARUSUARIO-->
  <!--ModalAGREGARUSUARIO-->

  <!--ModalELIMINAR-->
  <!--ModalELIMINAR-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
      <div class="modal-danger" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Eliminar usuarios</h4>
          </div>
          <div class="modal-body">
            <p>Está seguro de eliminar al usuario <strong>19.543.514-6 Alberto Matías Nuñes Velis</strong></p>
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



  <!--ModalAGREGARUSUARIO-->
  <!--ModalAGREGARUSUARIO-->
    <div class="modal fade bs-example-modal-lg" id="myEdit" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-tittle">Nuevo Usuario</h4>
            <div class="modal-body">
              <div class="box">
                <div class="row">
                  <form class="form-horizontal">
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Nombres</label>

                        <div class="col-md-9">
                          <input type="text" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Apellidos</label>

                        <div class="col-md-9">
                          <input type="text" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Rut</label>

                        <div class="col-md-9">
                          <input type="text" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Cargo</label>

                        <div class="col-md-9">
                          <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Seleccione un cargo</option>
                            <option>Administrativo</option>
                            <option>Profesor</option>
                            <option>Estudiante</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Carrera</label>

                        <div class="col-md-9">
                          <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Seleccione una carrera</option>
                            <option>Ingenieria en Informática</option>
                            <option>Electrónica</option>
                            <option>Telecomunicaciones</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>

                        <div class="col-md-9">
                          <input type="email" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Teléfono</label>

                        <div class="col-md-9">
                          <input type="number" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Teléfono opcional</label>

                        <div class="col-md-9">
                          <input type="number" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Clave</label>

                        <div class="col-md-9">
                          <input type="text" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Estado</label>

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
