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
    background: url("<?=base_url();?>/resources/images/Upload-128.png") center center no-repeat;
    width: 100px;
    height: 50px;
  }
</style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">

      <div class="row">

        <div class="col-md-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <form action="<?=site_url('Gestion/ingresar_producto_stock')?>" method="post" accept-charset="utf-8">

                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Producto (*)</label>
                        <div class="input-group">
                          <select placeholder="Seleccionar producto..." style="width: 100%" id="prodselect" required name="producto" class="select2">
                            <option></option>
                            <?php foreach ($productos as $key => $value): ?>
                              <?php if ($value->get("PROD_ESTADO") != 0): ?>
                                <option value="<?=$value->get("PROD_ID")?>"><?="(#" . $value->get("PROD_ID") . ") " . $value->get("PROD_NOMBRE") . " [" . $value->get("CAT_NOMBRE") . "]"?></option>
                              <?php endif?>
                            <?php endforeach?>
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

                  <div class="col-md-2">
                      <label>Cantidad (*)</label>
                      <input type="number" min="1" max="1000" required name="cantidad" class="form-control">
                  </div>
                  <div class="col-md-2">
                        <label>Vida útil (En meses)(*)</label>
                        <input name="vidautil" id="vidautil" type="number" class="form-control" >
                  </div>
                  <div class="col-md-3">
                      <label>Modo (*)</label>
                        <select placeholder="Seleccionar modo de ingreso..." required id="modo" name="modo" style="width: 100%" class="select2">
                          <option ></option>
                          <option value="1">Compra</option>
                          <option value="2">Donación</option>
                        </select>
                  </div>

                  <div class="col-md-12">
                      <label>Descripción (*)</label>
                      <textarea name="descripcion" required type="textarea" class="form-control"></textarea>
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
                        <h4 class="modal-title" id="myModalLabel">Modo de adquisición (Compra)</h4>
                      </div>
                      <div class="modal-body">

                          <div class="box-body">

                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>Proveedor (*)</label>

                                  <div class="input-group">
                                    <select name="proveedor" id="proveedor" class="select2" style="width: 100%">
                                      <option></option>
                                      <?php foreach ($proveedores as $key => $value): ?>
                                        <option value="<?=$value->get("PROV_RUT")?>"><?=$value->get("PROV_NOMBRE")?></option>
                                      <?php endforeach?>
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
                                  <label>Orden de compra (*)</label>
                                  <input type="number" name="ordencompra" id="ordencompra" class="form-control">
                              </div>
                              <div class="col-md-12">
                                  <label>Precio unitario (*)</label>
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
                    <table id="example2" class="datatableingre table table-bordered table-hover">
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
                            <td><?=$value->get('ING_FECHA')?></td>
                            <td><?=$value->get('USU_NOMBRES')?></td>
                            <td><?=$value->get('PROD_NOMBRE')?></td>
                            <td><?=$value->get('ING_CANTIDAD')?></td>
                            <td>
                              <button type="button" id="<?=$value->get('ING_ID')?>" class="editar btn btn-danger btn-xs btn-block" data-toggle="modal" data-target="#myPro">
                                <i class="fa fa-edit"></i>
                              </button>
                            </td>
                        </tr>
                      <?php endforeach?>
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
                  <form class="form-horizontal" action="<?=site_url('Mantencion/new_producto/0')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" onSubmit="return validate();">
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Nombre</label>
                        <div class="col-md-9">
                          <input name="producto[PROD_NOMBRE]" type="text" class="form-control col-md-12"  maxlength="50" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Categoría</label>

                        <div class="col-md-9">
                          <select name="producto[PROD_CAT_ID]" class="select2" style="width: 100%;" required>
                            <option></option>
                            <?php foreach ($categorias as $key => $value): ?>
                              <option value="<?=$value->get('CAT_ID')?>"><?=$value->get('CAT_NOMBRE')?></option>
                            <?php endforeach?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Tipo</label>

                        <div class="col-md-9">
                          <select name="producto[PROD_TIPOPROD_ID]" class="select2" style="width: 100%;" required>
                            <option></option>
                            <?php foreach ($tipos as $key => $value): ?>
                              <option value="<?=$value->get('TIPO_ID')?>"><?=$value->get('TIPO_NOMBRE')?></option>
                            <?php endforeach?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Stock crítico</label>

                        <div class="col-md-9">
                          <input name="producto[PROD_STOCK_CRITICO]" min="0" max="100000" type="number" class="form-control col-md-12" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Stock óptimo</label>

                        <div class="col-md-9">
                          <input name="producto[PROD_STOCK_OPTIMO]" min="0" max="100000" type="number" class="form-control col-md-12" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Posición</label>

                        <div class="col-md-9">
                          <input name="producto[PROD_POSICION]" type="text" class="form-control col-md-12" required>
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
                          <input name="producto[PROD_DIAS_ANTIC]" min="0" max="100000" type="number" class="form-control col-md-12" required>
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

          <form role="form" action="<?=site_url('Gestion/editar_ingreso')?>" method="post">
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
                  <label for="exampleInputPassword1">Vida Útil (Meses)</label>
                  <input type="number" name="vidautiledit" id="vuedit" class="form-control pull-right" >
                </div>

                <div class="form-group col-md-6"><br>
                  <label>Proveedor</label>
                      <select name="proveedor" id="provedit" class="form-control select2 pull-right" style="width: 100%">
                          <option></option>
                          <?php foreach ($proveedores as $key => $value): ?>
                            <option value="<?=$value->get("PROV_RUT")?>"><?=$value->get("PROV_NOMBRE")?></option>
                          <?php endforeach?>
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
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-tittle">Nuevo Proveedor</h4>

            <div class="modal-body">
              <div class="box">
                <div class="row">
                  <form class="form-horizontal" method="POST" action="<?=site_url('/Mantencion/NuevoProveedor/2');?>">
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-2 control-label" >RUT</label>
                        <div class="col-md-9">
                        <div class="row">
                        <div class="col-md-6">
                          <input id="rut" type="text" name="PROV[PROV_RUT]" class="col-md-12 form-control" placeholder="Rut sin punto, ni guion" pattern="[0-9]{7,8}" maxlength = "8" required>
                          </div>
                          <div class="col-md-2">
                          <input id="dv" name="PROV[PROV_DV]" pattern="^[9|8|7|6|5|4|3|2|1|k|K]\d{0}$" type="text" class="col-md-12 form-control" maxlength="1" required>
                          </div>
                        </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Tipo</label>

                        <div class="col-md-9">
                          <select id="newtipo" name="PROV[PROV_TIPO]" class="select2" style="width: 100%;" required>
                            <option></option>
                            <option value="1">Persona Natural</option>
                            <option value="2">Persona Jurídica</option>
                          </select>
                        </div>
                      </div>
                      <div id="new1" class="form-group" style='display:none;'>
                        <label class="col-sm-2 control-label">NOMBRE</label>
                        <div class="col-md-9">
                          <input id="newnombre" type="text" name="PROV[PROV_NOMBRE]" id="PROV[PROV_NOMBRE]" value="<?=set_value('PROV[PROV_NOMBRE]');?>" class="col-md-12 form-control">
                        </div>
                      </div>
                      <div id="new2" class="form-group" style='display:none;'>
                        <label class="col-sm-2 control-label" >RAZÓN SOCIAL</label>
                        <div class="col-md-9">
                          <input id="newrsocial" type="text" name="PROV[PROV_RSOCIAL]" id="PROV[PROV_RSOCIAL]" value="<?=set_value('PROV[PROV_RSOCIAL]');?>" class="col-md-12 form-control">
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
  <!--Proveedores-->

  <?php function MISJAVASCRIPTPERSONALIZADO()
{?>
  <script type="text/javascript">
$(document).ready(function() {
        $(".datatableingre").dataTable({
                    lengthMenu: [5,10, 20, 50, 100],
                    cache: false,
                    responsive: true,
                    "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                    },
                    dom: 'Bfrtip',
                    buttons: [
                         {
                                extend: 'excelHtml5',
                                text: 'Exportar a Excel',
                                exportOptions: {
                                            columns: [ 0, 1, 2, 3]
                                        },
                                customize: function( xlsx ) {
                                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                    $('row:first c', sheet).attr( 's', '42' );
                                }
                            },
                         {
                            extend: 'pdfHtml5',
                            text: 'Exportar a PDF',
                            exportOptions: {
                                            columns: [ 0, 1, 2, 3]
                                        }
                        },
                          {
                                extend: 'copyHtml5',
                                text: 'Copiar Todo',
                                exportOptions: {
                                            columns: [ 0, 1, 2, 3 ]
                                        }
                            },
                    ]
                });

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
    var Fn = {
    // Valida el rut con su cadena completa "XXXXXXXX-X"
    validaRut : function (rutCompleto) {
        rutCompleto = rutCompleto.replace("‐","-");
        if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rutCompleto ))
            return false;
        var tmp     = rutCompleto.split('-');
        var digv    = tmp[1];
        var rut     = tmp[0];
        if ( digv == 'K' ) digv = 'k' ;

        return (Fn.dv(rut) == digv );
    },
    dv : function(T){
        var M=0,S=1;
        for(;T;T=Math.floor(T/10))
            S=(S+T%10*(9-M++%6))%11;
        return S?S-1:'k';
    }
  }
  $("#agregar").click(function(){
    var rut=$('#rut').val();
    var dv=$('#dv').val();
    var rutOficial = rut+"-"+dv;
    if (Fn.validaRut( rutOficial )){
      return true;
   } else {
      $.notify("RUT no valido", "error");
      return false;
    }
    });

    $('#slider1').change(function() {
      var id=$('#slider1').val();
      $('#recibe').text(id);
    });


    $('#newtipo').click(function(){
      var value=$(this).val();
      if(value==1){
        $("#new2").css('display','none');
        $("#new1").css('display','inline');
        $("#newnombre").attr("required", true);
        $("#newrsocial").attr("required", false);
        $("#newrsocial").val("");
      }else{
        $("#new2").css('display','inline');
        $("#new1").css('display','none');
        $("#newrsocial").attr("required", true);
        $("#newnombre").attr("required", false);
        $("#newnombre").val("");
      }

    });

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
            $("#vuedit").val(response._columns.ING_VIDA_UTIL_PROVEEDOR);
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

    });

    function cleanformedit() {
     $("#ocedit").val("");
     $("#descedit").val("");
     $("#vuedit").val("");
     $("#provedit").val("").trigger('change');
     $("#idingreso").val("");
     $("#precioedit").val("");
  }

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

  /*function validate() {
  var file_size = $('#files-new')[0].files[0].size;
  if(file_size>2097152) {
    $.notify('El tamaño de la imagen supera el limite permitido, por favor eliga otra imagen');
    return false;
  }
  return true;
}*/
  </script>
  <?php }?>