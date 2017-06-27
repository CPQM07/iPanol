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

    <?php if (validation_errors()): ?>
      <div class="col-md-6 pull-right">
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-warning"></i>Oops!</h4>
            <?= validation_errors(); ?>
        </div>
      </div>
    <?php endif; ?>

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
                  <th>RAZÓN SOCIAL</th>
                  <th>TIPO</th>
                  <th>ESTADO</th>
                  <!--<th>ELIMINAR</th>-->
                  <th>EDITAR</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($proveedor != null): ?>
                <?php foreach ($proveedor as $key => $value): ?>
                  <tr>
                    <td><?= $value->get('PROV_RUT'); ?></td>
                    <td><?= $value->get('PROV_DV'); ?></td>
                    <td><?= $value->get('PROV_NOMBRE'); ?></td>
                    <td><?= $value->get('PROV_RSOCIAL'); ?></td>

                    <?php if ($value->get('PROV_TIPO') == 1): ?>
                      <td>PERSONA NATURAL</td>
                    <?php else: ?>
                      <td>PERSONA JURÍDICA</td>
                    <?php endif; ?>

                    <?php if ($value->get('PROV_ESTADO') == 1): ?>
                      <td><a href="<?= site_url('/Mantencion/CambiarEstadoPROV/1/');?><?=$value->get('PROV_RUT');?>" class="btn btn-danger btn-block">Deshabilitar</a></td>
                    <?php else: ?>
                      <td><a href="<?= site_url('/Mantencion/CambiarEstadoPROV/2/');?><?=$value->get('PROV_RUT');?>" class="btn btn-info btn-block">Habilitar</a></td>
                    <?php endif; ?>
                    <!--<td>
                      <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#ELIMINAR"><i class="fa fa-remove"></i></button>
                    </td>-->
                    <td><button id="<?= $value->get('PROV_RUT'); ?>" type="button" class="editar btn btn-success btn-block" data-toggle="modal" data-target="#EDITAR"><i class="fa fa-edit"></i></button>
                    </td>
                  </tr>
                <?php endforeach; ?>
                <?php endif ?>
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
    <div class="modal fade bs-example-modal-lg" id="NUEVOPROVEEDOR"  role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-tittle">Nuevo Proveedor</h4>

            <div class="modal-body">
              <div class="box">
                <div class="row">
                  <form class="form-horizontal" method="POST" action="<?= site_url('/Mantencion/NuevoProveedor'); ?>">
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">RUT</label>
                        <div class="col-md-9">
                          <div class="col-md-10">
                            <input type="text" name="PROV[PROV_RUT]" id="PROV[PROV_RUT]" placeholder="11111111" minlength="7" maxlength="8" value="<?= set_value('PROV[PROV_RUT]');  ?>" class="col-md-12 form-control">
                          </div>
                          <div class="col-md-2">
                            <input type="text" name="PROV[PROV_DV]" id="PROV[PROV_DV]" placeholder="1" maxlength="1" value="<?= set_value('PROV[PROV_DV]'); ?>" class="col-md-12 form-control">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">NOMBRE</label>
                        <div class="col-md-9">
                          <input type="text" name="PROV[PROV_NOMBRE]" id="PROV[PROV_NOMBRE]" value="<?= set_value('PROV[PROV_NOMBRE]'); ?>" class="col-md-12 form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">RAZÓN SOCIAL</label>
                        <div class="col-md-9">
                          <input type="text" name="PROV[PROV_RSOCIAL]" id="PROV[PROV_RSOCIAL]" value="<?= set_value('PROV[PROV_RSOCIAL]');  ?>"class="col-md-12 form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Tipo</label>
                        <div class="col-md-9">
                          <select class="form-control" name="PROV[PROV_TIPO]">
                            <option selected disabled>Seleccione Tipo</option>
                            <option value="1">Persona Natural</option>
                            <option value="2">Persona Jurídica</option>
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
                          <button id="agregar" type="submit" class="btn btn-danger col-md-12">Agregar</button>
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

  <!--modalPRODUCTONUEVO-->
  <!--modalPRODUCTONUEVO-->
  <div class="modal fade bs-example-modal-lg" id="EDITAR" role="dialog">
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
                      <label class="col-sm-2 control-label">Razón Social</label>
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

    function valida_rut($rut)
    {
        $rut = preg_replace('/[^k0-9]/i', '', $rut);
        $dv  = substr($rut, -1);
        $numero = substr($rut, 0, strlen($rut)-1);
        $i = 2;
        $suma = 0;
        foreach(array_reverse(str_split($numero)) as $v)
        {
            if($i==8)
                $i = 2;
            $suma += $v * $i;
            ++$i;
        }
        $dvr = 11 - ($suma % 11);

        if($dvr == 11)
            $dvr = 0;
        if($dvr == 10)
            $dvr = 'K';
        if($dvr == strtoupper($dv))
            return true;
        else
            return false;
    }

  </script>
  <?php } ?>
