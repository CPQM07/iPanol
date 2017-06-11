<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>
            Mantenedor | Proveedores
          </h3>
        </div>
        <div class="col-sm-6"><br>
          <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#NUEVOPROVEEDOR">Agregar nuevo Proveedor</button>
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
                  <th>RUT</th>
                  <th>DV</th>
                  <th>NOMBRE</th>
                  <th>RAZON SOCIAL</th>
                  <th>ESTADO</th>
                  <th>ELIMINAR</th>
                  <th>EDITAR</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($proveedor as $key => $value): ?>
                  <tr>
                    <td><?= $value->get('PROV_RUT'); ?></td>
                    <td><?= $value->get('PROV_DV'); ?></td>
                    <td><?= $value->get('PROV_NOMBRE'); ?></td>
                    <td><?= $value->get('PROV_RSOCIAL'); ?></td>
                    <?php if ($value->get('PROV_ESTADO') == 1): ?>
                      <td><a href="<?= site_url('/Mantencion/CambiarEstadoPROV/1/');?><?=$value->get('PROV_RUT');?>" class="btn btn-danger btn-block">Deshabilitar</a></td>
                    <?php else: ?>
                      <td><a href="<?= site_url('/Mantencion/CambiarEstadoPROV/2/');?><?=$value->get('PROV_RUT');?>" class="btn btn-info btn-block">Habilitar</a></td>
                    <?php endif; ?>
                    <td>
                      <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#ELIMINAR"><i class="fa fa-remove"></i></button>
                    </td>
                    <td><button id="<?= $value->get('PROV_RUT'); ?>" type="button" class="editar btn btn-success btn-block" data-toggle="modal" data-target="#EDITAR"><i class="fa fa-edit"></i></button>
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
  <!--modalPRODUCTONUEVO-->
  <!--modalPRODUCTONUEVO-->
    <div class="modal fade bs-example-modal-lg" id="NUEVOPROVEEDOR" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-tittle">Nuevo Proveedor</h4>
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
                        <label class="col-sm-2 control-label">DV</label>
                        <div class="col-md-9">
                          <input type="text" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Razon Social</label>
                        <div class="col-md-9">
                          <input type="text" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Estado</label>
                        <div class="col-md-9">
                          <input type="text" class="col-md-12">
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

<!-- /.content-wrapper -->

  <!--ModalELIMINAR-->
  <!--ModalELIMINAR-->
    <div class="modal fade" id="ELIMINAR" tabindex="-1" role="dialog">
      <div class="modal-danger" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Eliminar un Proveedor</h4>
          </div>
          <div class="modal-body">
            <p>Está seguro de eliminar el Proveedor <strong><?= $value->get('PROV_NOMBRE'); ?></strong></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <a href='<?= site_url("Mantencion/eliminarProveedor/".$value->get('PROV_RUT').""); ?>' class="btn btn-danger">Eliminar</a>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!--ModalELIMINAR-->
  <!--ModalELIMINAR-->
  <!--modalPRODUCTONUEVO-->
  <!--modalPRODUCTONUEVO-->
  <div class="modal fade bs-example-modal-lg" id="EDITAR" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-tittle">Editar Proveedor</h4>
          <div class="modal-body">
            <div class="box">
              <div class="row">
                <form action="<?= site_url('/Mantencion/updateProveedor'); ?>" method="post" class="form-horizontal">
                  <input id="id" name="id" type="number" style="visibility: hidden;">
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Nombre</label>
                      <div class="col-md-9">
                        <input id="nombre" name="PROV[PROV_NOMBRE]" type="text" class="col-md-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Razon Social</label>
                      <div class="col-md-9">
                        <input id="rsocial" name="PROV[PROV_RSOCIAL]" type="text" class="col-md-12">
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                    <div class="row">
                      <div class="col-sm-6">
                        <button type="submit" class="btn btn-default col-md-12" data-dismiss="modal">Cancelar</button>
                      </div>
                      <div class="col-sm-6">
                        <button type="submit" class="btn btn-danger col-md-12">Actualizar</button>
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


  <?php function MISJAVASCRIPTPERSONALIZADO(){  ?>
  <script type="text/javascript" charset="utf-8">
  $(document).ready(function() {

    $('.editar').click(function(){
        limpiar();
        var id=$(this).attr("id");
        $.ajax({
          type:"POST",
          dataType:"json",
          data: {"id": id},
          url:"<?=site_url('/Mantencion/findByIdProveedor')?>",
          success: function(data){
            $("#id").val(data.PROV_RUT);
            $("#nombre").val(data.PROV_NOMBRE);
            $("#rsocial").val(data.PROV_RSOCIAL);
            console.log(data);
          }
        });
      });
  });

  function limpiar(){
      $("#id").val("");
      $("#nombre").val("");
      $("#rsocial").val("");
    }
  </script>
  <?php } ?>
