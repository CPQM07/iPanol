<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>
            Mantenedor | Motivo
          </h3>
        </div>
        <div class="col-sm-6"><br>

          <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#newCategoria" >Agregar nueva Motivo</button>
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
                  <th>ESTADO</th>
                  <th>ORIGEN</th>
                  <th>Editar</th>
                  <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($motivos as $key => $value): ?>
                    <tr>
                      <td><?= $value->get('MOT_ID'); ?></td>
                      <td><?= $value->get('MOT_NOMBRE'); ?></td>
                      <?php if ($value->get('MOT_ESTADO') == 1): ?>
                        <td>ACTIVO</td>
                      <?php else: ?>
                        <td>ELIMINADO</td>
                      <?php endif; ?>
                      <?php if ($value->get('MOT_DIF') == 1): ?>
                        <td>BAJA</td>
                      <?php else: ?>
                        <td>OBSERVACION</td>
                      <?php endif; ?>
                      <td>
                        <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#EDITAR"><i class="fa fa-remove"></i></button>
                      </td>
                      <td><button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myEdit"><i class="fa fa-edit"></i></button>
                      </td>
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


  <!--modalMotivoNUEVO-->
  <!--modalMotivoNUEVO-->
    <div class="modal fade bs-example-modal-lg" id="newCategoria" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-tittle">Nueva Motivo</h4>
            <div class="modal-body">
              <div class="box">
                <div class="row">
                  <form class="form-horizontal" action="<?= site_url('Mantencion/NuevoMotivo') ?>" method="post">
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Nombre</label>

                        <div class="col-md-9">
                          <input name="motivo[MOT_NOMBRE]" type="text" class="col-md-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">ESTADO</label>
                        <div class="col-md-9">
                          <select class="form-control select2"  name="motivo[MOT_ESTADO]" style="width: 100%;">
                            <option selected="selected">ESTADO</option>
                              <option value="1">ACTIVO</option>
                              <option value="2">ELIMINADO</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">ORIGEN</label>
                        <div class="col-md-9">
                          <select class="form-control select2" name="motivo[MOT_DIF]" style="width: 100%;">
                            <option selected="selected">ORIGEN</option>
                            <option value="1">BAJA</option>
                            <option value="2">OBSERVACION</option>
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

  <!--modalMotivoNUEVO-->
  <!--modalMotivoNUEVO-->

  <!--ModalELIMINAR-->
  <!--ModalELIMINAR-->
    <div class="modal fade" id="EDITAR" tabindex="-1" role="dialog">
      <div class="modal-danger" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Eliminar un Motivo</h4>
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

  <!--modalMotivo-->
  <!--modalMotivoNUEVO-->
    <div class="modal fade bs-example-modal-lg" id="myEdit" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-tittle">Editar Motivo</h4>
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
