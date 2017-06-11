<!-- Content Wrapper. Contains page content -->
<style type="text/css">
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
    height: 50px;
  }
</style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
          <h3>
            Ingreso de productos
          </h3>
          
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">

        <div class="col-md-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <form action="<?=site_url('Gestion/ingresar_producto_stock')?>" method="post" accept-charset="utf-8">
                  
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Producto</label>
                        <div class="input-group">
                          <select name="producto" class="form-control select2">
                            <option></option>
                            <?php foreach ($productos as $key => $value): ?>
                              <?php if ($value->get("PROD_ESTADO") != 0): ?>
                                <option value="<?= $value->get("PROD_ID")  ?>"><?= "(#".$value->get("PROD_ID").") ".$value->get("PROD_NOMBRE")." [".$value->get("CAT_NOMBRE")."]" ?></option>
                              <?php endif ?>
                            <?php endforeach ?>
                          </select>
                          <div class="input-group-addon">
                            <a href="" data-toggle="modal" data-target="#newPro">
                              <i class="fa fa-plus"></i>
                            </a>
                          </div>
                        </div>
                      <!-- /.input group -->
                    </div>
                  </div>

                  <div class="col-md-3">
                      <label>Cantidad</label>
                      <input type="number" name="cantidad" class="form-control">
                  </div>
                  <div class="col-md-3">
                        <label>Vida útil (En meses)</label>
                        <input name="vidautil" id="vidautil" type="number" class="form-control" >
                  </div>
                  <div class="col-md-3">
                      <label>Modo</label>
                        <select id="modo" name="modo" class="form-control">
                          <option value="0">Seleccione el modo de Ingreso</option>
                          <option value="1">Compra</option>
                          <option value="2">Donación</option>
                        </select>
                  </div>

                  <div class="col-md-12">
                      <label>Descripción</label>
                      <textarea name="descripcion" type="textarea" class="form-control"></textarea>
                  </div>

                <div class="col-md-12">
                  <button type="submit" class="btn btn-block btn-success">Agregar</button>
                </div>


                             <!--INGRESO MODO COMPRA-->
                <div class="modal fade" id="compraodonacion" aria-labelledby="myModalLabel">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                        <h4 class="modal-title" id="myModalLabel">Compra</h4>
                      </div>
                      <div class="modal-body">
                                  
                          <div class="box-body">
                           
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>Proveedor</label>

                                  <div class="input-group">
                                    <select name="proveedor" id="proveedor" class="form-control select2" style="width: 100%">
                                      <option></option>
                                      <?php foreach ($proveedores as $key => $value): ?>
                                        <option value="<?= $value->get("PROV_RUT")  ?>"><?= $value->get("PROV_NOMBRE")  ?></option>
                                      <?php endforeach ?>
                                    </select>
                                    <div class="input-group-addon">
                                      <a href="" data-toggle="modal" data-target="#myProvee">
                                        <i class="fa fa-plus"></i>
                                      </a>
                                    </div>
                                  </div>
                                  <!-- /.input group -->
                                </div>
                              </div>

                              <div class="col-md-12">
                                  <label>Orden de compra</label>
                                  <input type="number" name="ordencompra" id="ordencompra" class="form-control">
                              </div>
                              <div class="col-md-12">
                                  <label>Precio unitario</label>
                                  <input type="number" name="preciounitario" id="preciounitario" class="form-control">
                              </div>

                          </div>
                        
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <!--INGRESO MODO COMPRA-->

                </form>

                <hr>
                <div class="row">
                  <div class="col-md-12">
                  <div class="box-header">
                    <h3 class="box-title">Resultados</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example2" class="datatable table table-bordered table-hover">
                      <thead>
                      <tr>                        
                        <th>Fecha de ingreso</th>
                        <th>Ingresado por</th>
                        <th>Insumo</th>
                        <th>Total Ingreso</th>
                        <th>Editar</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($ingresos as $key => $value): ?>
                        <tr>                           
                            <td><?= $value->get('ING_FECHA') ?></td>
                            <td><?= $value->get('USU_NOMBRES') ?></td>
                            <td><?= $value->get('PROD_NOMBRE') ?></td>
                            <td><?= $value->get('ING_CANTIDAD') ?></td>
                            <td>
                              <button type="button" id="<?= $value->get('ING_ID') ?>" class="editar btn btn-danger btn-xs btn-block" data-toggle="modal" data-target="#myPro">
                                <i class="fa fa-edit"></i>
                              </button>
                            </td>
                        </tr>
                      <?php endforeach ?>
                  </tbody>
                  </table>
                </div>
                <!-- /.box-body -->
              </div>
                <!-- /.box -->
              </div>

              <!--modal-->
                  <div class="modal fade" id="myModal" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                          <h4 class="modal-title" id="myModalLabel">Editar ingreso</h4>
                        </div>
                        <div class="modal-body">
                          <div class="box-body">
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                  <thead>
                                    <tr>
                                      <th>Insumo</th>
                                      <th>Tipo</th>
                                      <th>Categoria</th>
                                      <th>Cantidad</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  <tr>
                                    <td>
                                      <h5>Resistencia 1K Ohm</h5>
                                    </td>
                                    <td>
                                      <div class="form-group">
                                        <select class="form-control select2" style="width: 100%;">
                                          <option selected="selected">Tipo</option>
                                          <option>Fungible</option>
                                          <option>Activo</option>
                                        </select>
                                      </div>
                                    </td>
                                    <td>
                                      <div class="form-group">
                                        <select class="form-control select2" style="width: 100%;">
                                          <option selected="selected">Categoria</option>
                                          <option>Herramientas</option>
                                          <option>Cables</option>
                                          <option>Conectores</option>
                                        </select>
                                      </div>
                                    </td>
                                    <td> <h5>
                                      
                                      <input type="Number" class="col-xs-12"></input>
                                    </h5>
                                    </td>
                                  </tr>
                                  </tbody>
                                </table>
                              </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                          <button type="button" class="btn btn-success">Guardar datos</button> 
                        </div>
                      </div>
                    </div>
                  </div>
              <!--modal-->

                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->

          </div>
          
        </section>
        <!-- /.col -->
      </div>
      <!-- /.row (main row) -->
  <!--modalPRODUCTONUEVO-->
  <!--modalPRODUCTONUEVO-->
    <div class="modal fade bs-example-modal-lg" id="newPro"  role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-tittle">Nuevo producto</h4>
            <div class="modal-body">
              <div class="box">
                <div class="row">
                  <form class="form-horizontal" action="<?=site_url('Mantencion/new_producto/1')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" onSubmit="return validate();">
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
                            <option></option>
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
                            <option></option>
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
                          <input name="files" type="file" id="files-new" class="input-file" size="2120" accept="image/png,image/jpeg,image/jpg" required>
                          </div>
                          <output id="lista"></output>
                        
                        </div>
                      </div>
                    </div>
                    <!-- /.box-body -->
                      <div class="row">
                        <div class="col-sm-6">
                          <button type="submit" class="btn btn-default col-md-12" data-dismiss="modal">Cancelar</button>
                        </div>
                        <div class="col-sm-6">
                          <button type="submit" class="Agregar btn btn-danger col-md-12">Agregar</button>
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
    </div>

  <!--Producto-->
    <div class="modal fade" id="myPro" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            <h4 class="modal-title" id="myModalLabel">Editar ingreso</h4>
          </div>
          <div class="modal-body">
                      
          <form role="form" action="<?= site_url('Gestion/editar_ingreso') ?>" method="post">
              <input type="hidden" name="idingreso" id="idingreso">
              <div class="box-body">
                <div class="form-group col-md-3">
                  <label>Orden de Compra</label>
                  <input type="text" class="form-control pull-right" id="ocedit" name="odecompraedit">
                </div>
                <div class="form-group col-md-3">
                  <label>Precio</label>
                  <input type="text" readonly class="form-control pull-right" id="precioedit" name="precioedit">
                </div>

                <div class="form-group col-md-6">
                  <label>Descripción</label>
                  <input type="text" name="descedit" id="descedit" class="form-control pull-right" >
                </div>

                <div class="form-group col-md-6"><br>
                  <label for="exampleInputPassword1">Vida Util (Meses)</label>
                  <input type="number" name="vidautiledit" id="vuedit" class="form-control pull-right" >
                </div>

                <div class="form-group col-md-6"><br>
                  <label>Proveedor</label>
                      <select name="proveedor" id="provedit" class="form-control select2 pull-right" style="width: 100%">
                          <option></option>
                          <?php foreach ($proveedores as $key => $value): ?>
                            <option value="<?= $value->get("PROV_RUT")  ?>"><?= $value->get("PROV_NOMBRE")  ?></option>
                          <?php endforeach ?>
                      </select>
                </div>
              </div>
            

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-success">Guardar datos</button> 
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  <!--Producto-->

 


  <!--Proveedores-->
    <div class="modal fade" id="myProvee" aria-labelledby="myModalLabel">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            <h4 class="modal-title" id="myModalLabel">Ingresar Proveeedor</h4>
          </div>
          <div class="modal-body">
              <div class="box-body">

                <div class="form-group col-md-12">
                    <label class="control-label col-md-3">Rut</label>
                    <div class="col-md-5">
                    <input type="text" id="provnew_rut" name="provnew_rut" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                    <div class="col-md-2">
                      <input type="text" id="provnew_dv" name="provnew_dv" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>

                <div class="form-group ">
                  <label for="exampleInputEmail1">Nombre</label>
                  <input type="text" class="form-control pull-right col-md-6" name="odecompra" placeholder="Ingrese el nombre">
                </div>
                <br>
                <div class="form-group ">
                  <label for="exampleInputEmail1">Razón social</label>
                  <input type="text" class="form-control pull-right col-md-6" name="odecompra" placeholder="Ingrese razón social">
                </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success">Guardar datos</button> 
          </div>
        </div>
      </div>
    </div>
  <!--Proveedores-->
  <?php function MISJAVASCRIPTPERSONALIZADO(){  ?>
  <script type="text/javascript">

  $(document).ready(function() {

    /*$('#files-new').on('change', function() {
      if(this.files[0].size/1024 > 2120){
        $.notify('El tamaño de la imagen supera el limite permitido, por favor eliga otra imagen');
      }
    });*/
    $(document).on('change', '#modo', function(event) {
      //event.preventDefault();
      var selector =$(this).val();
      if (selector == 1) {
          $('#compraodonacion').modal('show');
      }else if(selector == 2){
          $('#compraodonacion').modal('hide');
          limpiarformmodal();
      }else{
          $('#compraodonacion').modal('hide');
      }

    });

    function limpiarformmodal(argument) {
      $("#proveedor").val("").trigger('change');
          $("#vidautil").val("");
          $("#ordencompra").val("");
          $("#preciounitario").val("");
    }

    $("#compraodonacion").on("hidden.bs.modal", function () {       
        var selector =$("#modo").val();
        if (selector == 1) {

        }else if(selector == 2){
            limpiarformmodal();
        }else{
            limpiarformmodal();
        }

    });




    $('#slider1').change(function() {
      var id=$('#slider1').val();
      $('#recibe').text(id);
    });
  });

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
                    document.getElementById("lista").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
             };
         })(f);

         reader.readAsDataURL(f);
     }
  }
  document.getElementById('files-new').addEventListener('change', archivo, false);

  $(".editar").click(function (argument) {
    cleanformedit();
          $.ajax({
            url: "<?=site_url('/gestion/cargar_detalle_ingreso_ajax')?>",
            type: 'POST',
            dataType: 'json',
            data: {idingreso: $(this).attr("id")},
          })
          .done(function(response) {
            $("#ocedit").val(response._columns.ING_ORDEN_COMPRA);
            $("#descedit").val(response._columns.ING_DESC);
            $("#vuedit").val(response._columns.ING_VIDA_ULTIL_PROVEEDOR);
            $("#provedit").val(response._columns.ING_PROV_RUT).trigger('change');
            $("#idingreso").val(response._columns.ING_ID);
            $("#precioedit").val(response._columns.ING_PRECIO_UNITARIO);
          })
          .fail(function() {
            console.log("error");
          })
          .always(function() {
            console.log("complete");
          });
    
  })

  function cleanformedit() {
     $("#ocedit").val("");
     $("#descedit").val("");
     $("#vuedit").val("");
     $("#provedit").val("").trigger('change');
     $("#idingreso").val("");
     $("#precioedit").val("");
  }

  /*function validate() {
  var file_size = $('#files-new')[0].files[0].size;
  if(file_size>2097152) {
    $.notify('El tamaño de la imagen supera el limite permitido, por favor eliga otra imagen');
    return false;
  } 
  return true;
}*/
  </script>
  <?php } ?>