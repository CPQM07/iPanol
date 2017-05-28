<!-- Content Wrapper. Contains page content -->
      <style>
          .thumb{
               height: 300px;
               border: 1px solid #000;
               margin: 10px 5px 0 0;
          }
          input[type=file] {
              opacity: 0;
              width: 100%;
              height: 100%;
          }
           
          #upload {
              background: url("<?= base_url();?>/resources/images/Upload-128.png") center center no-repeat;
              width: 100px;
              height: 100px;
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
                  <th>Estado</th>
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
                      <td><?= $value['PROD_CAT_ID']->get('CAT_NOMBRE'); ?></td>
                      <td><?= $value['PROD_TIPOPROD_ID']->get('TIPO_NOMBRE'); ?></td>
                      <td><?= $value['PROD_STOCK_TOTAL']; ?></td>
                      <td><?= $value['PROD_STOCK_CRITICO']; ?></td>
                      <td><?= $value['PROD_STOCK_OPTIMO']; ?></td>
                      <td><?= $estado?></td>
                      <td>
                        <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#myModal<?= $value['PROD_ID']; ?>"><i class="fa fa-remove"></i></button>
                      </td>
                      <td>
                     
                      <button type="button" id="<?= $value['PROD_ID']; ?>" class="editar btn btn-success btn-block" data-toggle="modal" data-target="#editPro"><i class="fa fa-edit"></i></button>
               
                      </td>
                    </tr>
<!--ModalELIMINAR-->
    <div class="modal fade" id="myModal<?= $value['PROD_ID']; ?>" tabindex="-1" role="dialog">
      <div class="modal-danger" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Eliminar un producto</h4>
          </div>
          <div class="modal-body">
            <p>Está seguro de eliminar el producto <strong><?= $value['PROD_NOMBRE']; ?></strong></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" onclick=" location.href='eliminarproducto/<?= $value['PROD_ID']; ?>' " class="btn btn-danger">Eliminar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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
                  <form class="form-horizontal" action="<?=site_url('Mantencion/new_producto')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" >
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Nombre</label>
                        <div class="col-md-9">
                          <input name="producto[PROD_NOMBRE]" type="text" class="col-md-12"  maxlength="50" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Categoria</label>

                        <div class="col-md-9">
                          <select name="producto[PROD_CAT_ID]" class="form-control select2" style="width: 100%;" required>
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
                          <select name="producto[PROD_TIPOPROD_ID]" class="form-control select2" style="width: 100%;" required>
                            <option selected="selected">Seleccione un tipo</option>
                            <?php foreach ($tipos as $key => $value): ?>
                              <option value="<?=$value->get('TIPO_ID')?>"><?=$value->get('TIPO_NOMBRE')?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Stock crítico</label>

                        <div class="col-md-9">
                          <input name="producto[PROD_STOCK_CRITICO]" min="0" max="100000" type="number" class="col-md-12" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Stock margen</label>

                        <div class="col-md-9">
                          <input name="producto[PROD_STOCK_OPTIMO]" min="0" max="100000" type="number" class="col-md-12" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Posición</label>

                        <div class="col-md-9">
                          <input name="producto[PROD_POSICION]" type="text" class="col-md-12" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Prioridad</label>

                        <div class="col-md-9">
                          <input name="producto[PROD_PRIORIDAD]" id="slider1" type="range" min="1" max="10" step="1" value="5" required>
                          <span id="recibe">5</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Días necesarios de anticipación</label>

                        <div class="col-md-9">
                          <input name="producto[PROD_DIAS_ANTIC]" min="0" max="100000" type="number" class="col-md-12" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Subir Imagen</label>

                        <div class="col-md-9">
                        <div id="upload">
                          <input name="files" type="file" id="files" class="input-file" size="2120" accept="image/png,image/jpeg,image/jpg" href="javascript:void(0);" required>
                          </div>
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
<!--modalPRODUCTO-->
  <!--modalPRODUCTONUEVO-->
    <div class="modal fade bs-example-modal-lg" id="editPro" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-tittle">Editar producto</h4>
            <div class="modal-body">
              <div class="box">
                <div class="row">
                  <form id="formulario" class="form-horizontal" action="<?=site_url('Mantencion/edit_producto')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" >
                  
                  <input id="id_pro" name="id_pro" type="number" style="width: 14px;height: 11px; visibility: hidden;">
                    
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Nombre</label>
                        <div class="col-md-9">
                          <input id="nombre" name="producto[PROD_NOMBRE]" type="text" class="col-md-12"  required>

                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Categoria</label>

                        <div class="col-md-9">
                          <select id="categoria" name="producto[PROD_CAT_ID]" class="form-control select2" style="width: 100%;" required>
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
                          <select id="tipo" name="producto[PROD_TIPOPROD_ID]" class="form-control select2" style="width: 100%;" required>
                            <option selected="selected">Seleccione un tipo</option>
                            <?php foreach ($tipos as $key => $value): ?>
                              <option value="<?=$value->get('TIPO_ID')?>"><?=$value->get('TIPO_NOMBRE')?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Stock crítico</label>

                        <div class="col-md-9">
                          <input id="stockcritico" name="producto[PROD_STOCK_CRITICO]" type="number" class="col-md-12" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Stock margen</label>

                        <div class="col-md-9">
                          <input id="stockmargen" name="producto[PROD_STOCK_OPTIMO]" type="number" class="col-md-12" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Posición</label>

                        <div class="col-md-9">
                          <input id="posicion" name="producto[PROD_POSICION]" type="text" class="col-md-12" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Prioridad</label>

                        <div class="col-md-9">
                          <input name="producto[PROD_PRIORIDAD]" id="slider2" type="range" min="1" max="10" step="1" value="5"  required>
                          <span id="recibe2">5</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Días necesarios de anticipación</label>

                        <div class="col-md-9">
                          <input id="dias" name="producto[PROD_DIAS_ANTIC]" type="number" class="col-md-12" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Subir Imagen</label>

                        <div class="col-md-9">
                        <div id="upload">
                          <input name="files" type="file" id="filess" class="input-file" size="2120" accept="image/png,image/jpeg,image/jpg" href="javascript:void(0);">
                          </div>
                          <output id="list"></output>
                        
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Estado</label>

                        <div class="col-md-9">
                          <select id="estado" name="producto[PROD_ESTADO]" class="form-control select2" style="width: 100%;">
                            <option selected="selected">Seleccione un tipo</option>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
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




    </div>
<?php function MISJAVASCRIPTPERSONALIZADO(){  ?>

<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {

    $('.input-file').change(function (){
     var sizeByte = this.files[0].size;
     var siezekiloByte = parseInt(sizeByte / 1024);
     console.log(siezekiloByte);
     if(siezekiloByte > $(this).attr('size')){
         alert('El tamaño de la imagen supera el limite permitido, por favor eliga otra imagen');
         $('#files').end();
     }
   });
    window.onload = function() {
      VariableJS = $alert;
      alert(VariableJS);
      if(VariableJS==1){
        alert("Ingrese el formulario de manera adecuada");
      }
    };
    $('#slider1').change(function() {
      var id=$('#slider1').val();
      $('#recibe').text(id);
    });

    $('#slider2').change(function() {
      var id=$('#slider2').val();
      $('#recibe2').text(id);
    });


    $('.editar').click(function(){
      limpiar();
      var id=$(this).attr("id");
      $("#nombre").val("");
      $.ajax({
        type:"POST",
        dataType:"json",
        data: {"id": id},
        url:"<?=site_url('/Mantencion/findById_productos')?>",
        success: function(data){
          $("#id_pro").val(data.PROD_ID);
          $("#nombre").val(data.PROD_NOMBRE);
          $("#categoria").val(data.PROD_CAT_ID);
          $("#tipo").val(data.PROD_TIPOPROD_ID);
          $("#stocktotal").val(data.PROD_STOCK_TOTAL);
          $("#stockcritico").val(data.PROD_STOCK_CRITICO);
          $("#stockmargen").val(data.PROD_STOCK_OPTIMO);
          $("#posicion").val(data.PROD_POSICION);
          $("#slider2").val(data.PROD_PRIORIDAD);
          $('#recibe2').text(data.PROD_PRIORIDAD);
          $("#dias").val(data.PROD_DIAS_ANTIC);
          $("#filess").val(data.PROD_IMAGEN);
          $("#estado").val(data.PROD_ESTADO);
          console.log(data);
        }
      });
    });

  });

  function limpiar(){
    $("#nombre").val("");
    $("#categoria").val("");
    $("#tipo").val("");
    $("#stocktotal").val("");
    $("#stockcritico").val("");
    $("#stockmargen").val("");
    $("#posicion").val("");
    $("#prioridad").val("");
    $("#dias").val("");
    $("#imagen").val("");
    $("#estado").val("");
    $("#id_pro").val("");

  }

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
