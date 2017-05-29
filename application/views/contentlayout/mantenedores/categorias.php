<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>
            Mantenedor | Categoría
          </h3>
        </div>
        <div class="col-sm-6"><br>

          <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#NUEVACATEGORIA" >Agregar nueva categoría</button>
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
                  <th>DESCRIPCION</th>
                  <th>CODIGO</th>
                  <th>ESTADO</th>
                  <th>ELIMINAR</th>
                  <th>EDITAR</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($categoria as $key => $value): ?>
                      <tr>
                        <td><?= $value->get('CAT_ID'); ?></td>
                        <td><?= $value->get('CAT_NOMBRE'); ?></td>
                        <td><?= $value->get('CAT_DESC'); ?></td>
                        <td><?= $value->get('CAT_CODIGO'); ?></td>
                        <?php if ($value->get('CAT_ESTADO') == 1): ?>
                          <td><a href="<?= site_url('/Mantencion/CambiarEstadoCAT/1/');?><?=$value->get('CAT_ID');?>" class="btn btn-danger btn-block">Deshabilitar</a></td>
                        <?php else: ?>
                          <td><a href="<?= site_url('/Mantencion/CambiarEstadoCAT/2/');?><?=$value->get('CAT_ID');?>" class="btn btn-info btn-block">Habilitar</a></td>
                        <?php endif; ?>
                        <td>
                          <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#ELIMINAR<?= $value->get('CAT_ID'); ?>"><i class="fa fa-remove"></i></button>
                        </td>
                        <td><button id="<?= $value->get('CAT_ID'); ?>" type="button" class="editar btn btn-success btn-block" data-toggle="modal" data-target="#EDITAR"><i class="fa fa-edit"></i></button>
                        </td>
                      </tr>
                        <!--ModalELIMINAR-->
  <!--ModalELIMINAR-->
    <div class="modal fade" id="ELIMINAR<?= $value->get('CAT_ID'); ?>" tabindex="-1" role="dialog">
      <div class="modal-danger" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Eliminar una categoría</h4>
          </div>
          <div class="modal-body">
            <p>Está seguro de eliminar el producto <strong><?= $value->get('CAT_NOMBRE'); ?></strong></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <a href='<?= site_url("Mantencion/eliminarCategoria/".$value->get('CAT_ID').""); ?>' class="btn btn-default">Eliminar</a>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!--ModalELIMINAR-->
  <!--ModalELIMINAR-->
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
  <!--modalCATEGORIANUEVO-->
  <!--modalCATEGORIANUEVO-->
    <div class="modal fade bs-example-modal-lg" id="NUEVACATEGORIA" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-tittle">Nueva categoría</h4>
            <div class="modal-body">
              <div class="box">
                <div class="row">
                  <form class="form-horizontal" action="<?=site_url('Mantencion/new_cat')?>" method="post" accept-charset="utf-8">
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Nombre</label>

                        <div class="col-md-9">
                          <input name="cat[CAT_NOMBRE]" type="text" class="col-md-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">Descripción</label>

                        <div class="col-md-9">
                          <input name="cat[CAT_DESC]" type="text" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Codigo</label>

                        <div class="col-md-9">
                          <input name="cat[CAT_CODIGO]" type="number" class="col-md-12">
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
        </div>
      </div>
    </div>
  <!--modalCATEGORIANUEVO-->



  <!--modalCategoría-->
  <!--modalCategoríaNUEVO-->
    <div class="modal fade bs-example-modal-lg" id="EDITAR" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-tittle">Editar Categoría</h4>
            <div class="modal-body">
              <div class="box">
                <div class="row">
                  <form class="form-horizontal" action="<?=site_url('Mantencion/edit_categoria')?>" method="post" accept-charset="utf-8">
                   <input id="id" name="id" type="number" style="width: 14px;height: 11px; visibility: hidden;">
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Nombre</label>

                        <div class="col-md-9">
                          <input id="nombre"  name="cat[CAT_NOMBRE]" type="text" class="col-md-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">Descripción</label>

                        <div class="col-md-9">
                          <input id="desc" name="cat[CAT_DESC]"  type="text" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Codigo</label>

                        <div class="col-md-9">
                          <input id="cod" name="cat[CAT_CODIGO]"  type="number" class="col-md-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">Estado</label>

                        <div class="col-md-9">
                          <select id="estado" name="cat[CAT_ESTADO]" class="form-control select2" style="width: 100%;">
                            <option selected="selected">Seleccione un tipo</option>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
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
        url:"<?=site_url('/Mantencion/findById_categorias')?>",
        success: function(data){
          $("#id").val(data.CAT_ID);
          $("#nombre").val(data.CAT_NOMBRE);
          $("#desc").val(data.CAT_DESC);
          $("#cod").val(data.CAT_CODIGO);
          $("#estado").val(data.CAT_ESTADO);
          console.log(data);
        }
      });
    });
});

function limpiar(){
    $("#id").val("");
    $("#nombre").val("");
    $("#desc").val("");
    $("#cod").val("");
    $("#estado").val("");

  }
</script>
<?php } ?>
