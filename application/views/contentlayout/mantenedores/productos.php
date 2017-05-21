<!-- Content Wrapper. Contains page content -->
      <style>
          .thumb{
               height: 300px;
               border: 1px solid #000;
               margin: 10px 5px 0 0;
          }
      </style>
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
          <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#newCategoria" style="background-color:#f39c12; border-color: #F39D12">Agregar nueva categoría</button>
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
                  <?php 
                  foreach ($productos as $key => $value): 
                  switch ($value['PROD_ESTADO']) {
                  case 1:
                    $estado="Activo";
                    break;
                  
                  default:
                    $estado="Inactivo";
                    break;
                  }
                  ?>
                    <tr>
                      <td><?= $value['PROD_ID']; ?></td>
                      <td><?= $value['PROD_NOMBRE']; ?></td>
                      <td><?= $value['PROD_CAT_ID'][0]->get('CAT_NOMBRE'); ?></td>
                      <td><?= $value['PROD_TIPOPROD_ID'][0]->get('TIPO_NOMBRE'); ?></td>
                      <td><?= $value['PROD_STOCK_TOTAL']; ?></td>
                      <td><?= $value['PROD_STOCK_CRITICO']; ?></td>
                      <td><?= $value['PROD_STOCK_OPTIMO']; ?></td>
                      <td><?= $value['PROD_STOCK_OPTIMO']; ?></td>
                      <td>
                        <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#myModal"><i class="fa fa-remove"></i></button>
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
                  <form class="form-horizontal" action="<?=site_url('Mantencion/new_producto')?>" method="post" accept-charset="utf-8">
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Nombre</label>
                        <div class="col-md-9">
                          <input name="producto[PROD_NOMBRE]" type="text" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Categoria</label>

                        <div class="col-md-9">
                          <select name="producto[PROD_CAT_ID]" class="form-control select2" style="width: 100%;">
                            <option selected="selected">Seleccione una categoria</option>
                            <?php foreach ($categorias as $key => $value): ?>
                              <option value="<?=$value->get('CAT_ID')?>"><?=$value->get('CAT_NOMBRE')?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Tipo</label>

                        <div class="col-md-9">
                          <select name="producto[PROD_TIPOPROD_ID]" class="form-control select2" style="width: 100%;">
                            <option selected="selected">Seleccione un tipo</option>
                            <?php foreach ($tipos as $key => $value): ?>
                              <option value="<?=$value->get('TIPO_ID')?>"><?=$value->get('TIPO_NOMBRE')?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Stock total</label>

                        <div class="col-md-9">
                          <input name="producto[PROD_STOCK_TOTAL]" type="number" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Stock crítico</label>

                        <div class="col-md-9">
                          <input name="producto[PROD_STOCK_CRITICO]" type="number" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Stock margen</label>

                        <div class="col-md-9">
                          <input name="producto[PROD_STOCK_OPTIMO]" type="number" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Posición</label>

                        <div class="col-md-9">
                          <input name="producto[PROD_POSICION]" type="text" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Prioridad</label>

                        <div class="col-md-9">
                          <input name="producto[PROD_PRIORIDAD]" id="slider1" type="range" min="1" max="10" step="1" value="5" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Días necesarios de anticipación</label>

                        <div class="col-md-9">
                          <input name="producto[PROD_DIAS_ANTIC]" type="number" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Imagen</label>

                        <div class="col-md-9">
                          <input name="producto[PROD_IMAGEN]" type="file" id="files"  />
                          <br />
                          <output id="list"></output>
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
  <!--modalCATEGORIANUEVO-->
  <!--modalCATEGORIANUEVO-->
    <div class="modal fade bs-example-modal-lg" id="newCategoria" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-tittle">Nueva categoría</h4>
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
                        <label class="col-sm-2 control-label">Descripción</label>

                        <div class="col-md-9">
                          <input type="text" class="col-md-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Codigo</label>

                        <div class="col-md-9">
                          <input type="number" class="col-md-12">
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
<?php function MISJAVASCRIPTPERSONALIZADO(){  ?>
<script type="text/javascript" charset="utf-8">
function archivo(evt) {
      var files = evt.target.files; // FileList object
       
        //Obtenemos la imagen del campo "file". 
      for (var i = 0, f; f = files[i]; i++) {         
           //Solo admitimos imágenes.
           if (!f.type.match('image.*')) {
                continue;
           }
       
           var reader = new FileReader();
           
           reader.onload = (function(theFile) {
               return function(e) {
               // Creamos la imagen.
                      document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
               };
           })(f);
 
           reader.readAsDataURL(f);
       }
}
             
      document.getElementById('files').addEventListener('change', archivo, false);
            
</script>
<?php } ?>
