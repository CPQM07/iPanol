<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>
            Mantenedor | Solicitudes
          </h3>
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
                  <th>USUARIO</th>
                  <th>FECHA INICIO</th>
                  <th>FECHA TERMINO</th>
                  <th>OBSERVACIONES</th>
                  <th>Acciones</th>
              </tr>
              </thead>
              <tbody>
                <?php foreach ($Solicitudes as $key => $value): ?>
                  <tr>
                    <td><?= $value->get('SOL_ID'); ?></td>
                    <td><?= $value->get('SOL_USU_RUT'); ?></td>
                    <td><?= $value->get('SOL_FECHA_INICIO'); ?></td>
                    <td><?= $value->get('SOL_FECHA_TERMINO'); ?></td>
                    <td><?= $value->get('SOL_OBSERVACION'); ?></td>
                    <?php if ($value->get('SOL_ESTADO') == 1): ?>
                      <td>
                        <a href="<?= site_url('/Gestion/CambiarEstadoSOL/1/');?><?=$value->get('SOL_ID');?>" class="btn btn-success btn-block">SOLICITADO</a>
                      </td>
                    <?php endif; ?>

                      <?php if ($value->get('SOL_ESTADO') == 2): ?>
                        <td>
                          <a href="<?= site_url('/Gestion/CambiarEstadoSOL/2/');?><?=$value->get('SOL_ID');?>" class="btn btn-danger btn-block">RECHAZADO</a>
                        </td>
                        <?php endif; ?>

                        <?php if ($value->get('SOL_ESTADO') == 3): ?>
                          <td>
                            <a href="<?= site_url('/Gestion/CambiarEstadoSOL/3/');?><?=$value->get('SOL_ID');?>" class="btn btn-info btn-block">DESPACHADO</a>
                          </td>
                          <?php endif; ?>

                          <?php if ($value->get('SOL_ESTADO') == 4): ?>
                            <td>
                              <a href="<?= site_url('/Gestion/CambiarEstadoSOL/4/');?><?=$value->get('SOL_ID');?>" class="btn btn-warning btn-block">RECEPCIONADO</a>
                            </td>
                            <?php endif; ?>
                             <?php if ($value->get('SOL_ESTADO') == 5): ?>
                            <td>
                            <p>Solicitud manual</p>
                            </td>
                            <?php endif; ?>

                            <?php if ($value->get('SOL_ESTADO') == 6): ?>
                              <td>
                                <a href="<?= site_url('/Gestion/CambiarEstadoSOL/6/');?><?=$value->get('SOL_ID');?>" class="btn btn-success btn-block">PARCIALMENTE RECEPCIONADO</a>
                              </td>
                            <?php endif; ?>

                              <?php if ($value->get('SOL_ESTADO') == 7): ?>
                                <td>
                                  <a href="<?= site_url('/Gestion/CambiarEstadoSOL/7/');?><?=$value->get('SOL_ID');?>" class="btn btn-info btn-block">PARCIALMENTE DESPACHADO</a>
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
