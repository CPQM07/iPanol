<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>
            Mantenedor | Asignatura
          </h3>
        </div>
        <div class="col-sm-6"><br>

          <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#NuevaAsignatura" >Agregar nueva Asignatura</button>
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
                  <th>ID</th>
                  <th>NOMBRE</th>
                  <th>Acciones</th>
              </tr>
              </thead>
              <tbody>
                <?php foreach ($asignatura as $key => $value): ?>
                  <tr>
                    <td><?= $value->get('ASIGNATURA_ID'); ?></td>
                    <td><?= $value->get('ASIGNATURA_NOMBRE'); ?></td>
                    <?php if ($value->get('ASIGNATURA_ESTADO') == 1): ?>
                      <td>
                        <a href="<?= site_url('/Mantencion/CambiarEstadoAsig/1/');?><?=$value->get('ASIGNATURA_ID');?>" class="btn btn-danger btn-block"><i class="fa fa-remove"></i></a>
                      </td>
                    <?php else: ?>
                      <td>
                        <a href="<?= site_url('/Mantencion/CambiarEstadoAsig/2/');?><?=$value->get('ASIGNATURA_ID');?>" class="btn btn-info btn-block"><i class="fa fa-check"></i></a>
                      </td>
                    <?php endif; ?>
                  </tr>
                <?php endforeach; ?>
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


  <!--modalAsignaturaNUEVO-->
  <!--modalAsignaturaNUEVO-->
    <div class="modal fade bs-example-modal-lg" id="NuevaAsignatura" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-tittle">Nueva Asignatura</h4>
            <div class="modal-body">
              <div class="box">
                <div class="row">
                  <form class="form-horizontal" action="Mantencion/NuevaAsignatura" method="post">
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Nombre</label>

                        <div class="col-md-9">
                          <input name="asignatura[ASIGNATURA_NOMBRE]" type="text" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">ESTADO</label>

                        <div class="col-md-9">
                          <input name="asignatura[ASIGNATURA_ESTADO]" type="text" class="col-md-12">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
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

  <!--modalAsignaturaNUEVO-->
  <!--modalAsignaturaNUEVO-->

  <!--ModalELIMINAR-->
  <!--ModalELIMINAR-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
      <div class="modal-danger" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Eliminar una Asignatura</h4>
          </div>
          <div class="modal-body">
            <p>Está seguro de eliminar el producto <strong>Networking</strong></p>
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

  <!--modalAsignatura-->
  <!--modalAsignaturaNUEVO-->
    <div class="modal fade bs-example-modal-lg" id="myEdit" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-tittle">Editar Asignatura</h4>
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
                        <label class="col-sm-2 control-label">Carrera</label>

                        <div class="col-md-9">
                          <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Seleccione un tipo</option>
                            <option>Informatica</option>
                            <option>Telecomunicación</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Estado</label>

                        <div class="col-md-9">
                          <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Seleccione un tipo</option>
                            <option>Activo</option>
                            <option>Inactivo</option>
                          </select>
                        </div>
                      </div>


                    </div>
                  </div>
                </div>
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
