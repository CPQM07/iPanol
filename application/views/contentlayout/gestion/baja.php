 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    </br>

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
        <form action="<?= site_url('/Gestion/dar_de_baja') ?>" method="post" accept-charset="utf-8">
        <div class="panel panel-default">
          <div class="row panel-body">

             <div class="col-md-6">
              <div class="form-group">
                <label>Inventario</label>
                <select name="forminventario" id="forminventario" required class="select2" style="width: 100%;">
                <option></option>
                <?php if ($inventario != null): ?>
                  <?php foreach ($inventario as $key => $value): ?>
                    <option stock="<?= $value->get("INV_PROD_CANTIDAD") ?>" tipo="<?= $value->get("INV_TIPO_ID") ?>" value=" <?= $value->get("INV_ID") ?>"> <?= "(cod:".$value->get("INV_PROD_CODIGO").")".$value->get("INV_PROD_NOM")."   /    stock actual(".$value->get("INV_PROD_CANTIDAD").")"  ?></option>
                  <?php endforeach ?>
                <?php endif ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
             <div class="form-group">
              <label><small>Cantidad a dar de baja(Si es activo siempre será 1,si es fungible puede elegir la cantidad)</small></label>
              <div id="siesactivoofung">
                <input type="number" min="1" max="5000" placeholder="Cantidad a dar de baja" name="cantidadbaja" id="cantidadbaja" value="1" readonly class="form-control">
                <input type="hidden" name="tipobaja" id="tipobaja"> 
              </div>
             </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Motivo Origen</label>
              <select name="formmotivoorigen" required class="select2" style="width: 100%;">
                <option></option>
                <?php foreach ($motivos as $key => $value): ?>
                  <?php if ($value['MOT_DIF'] == 1): ?>
                     <option value=" <?= $value['MOT_ID']  ?> "><?= $value['MOT_NOMBRE']  ?> </option>
                  <?php endif ?>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Descripción</label>
              <input name="formdescripcion" type="text" required class="form-control">
            </div>
          </div>
          <div class="col-md-4">
            <label>Acción</label>
            <button type="submit" class="btn btn-block btn-danger fa fa-arrow-down">Dar de Baja</button>
          </div>
        </div>

        </form>
        </div>
        <div class="box-body">
          <h3>Historial de productos / insumos dados de baja</h3>
          <div class="box-body">
              <table name="example2" class="datatablebaja table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Tipo</th>
                    <th>Nombre</th>
                    <th>Motivo</th>
                    <th>Motivo resultado</th>
                    <th>Observaciones</th>
                  </tr>
                </thead>
                <tbody>
                <?php //print_r($bajas) ?>
                <?php foreach ($bajas as $key => $value): ?>
                 <tr>
                  <td><?= $value['BAJA_FECHA']  ?></td>
                  <td><?= "(cod:".$value['INV_PROD_CODIGO'].") -".$value['INV_PROD_NOM']  ?></td>
                  <td><?= $value['BAJA_CANTIDAD']  ?></td>
                  <td>
                    <?php if (intval($value['BAJA_TIPO']) == 1): ?>
                      Activo
                    <?php elseif(intval($value['BAJA_TIPO']) == 2): ?>
                      Fungible
                    <?php endif ?>
                  </td>
                  <td><?= $value['USU_NOMBRES']  ?></td>
                  <td><?= $value['MOT_NOMBRE'] ?></td>
                  <td><?php if ($value['BAJA_MOTIVO_RESULTADO'] != null): ?>
                    <?php
                     $ultimoregistro = array_pop($value['BAJA_MOTIVO_RESULTADO']);  
                     echo($ultimoregistro["OBS_MOT_NOMBRE"]);
                     ?>
                  <?php else: ?>
                     SIN RESULTADO
                  <?php endif ?>
                    
                  </td>
                  <td>
                    <?php if ($value['MOT_ID'] == 15): ?>
                      <button idbaja="<?= $value['BAJA_ID'] ?>" class="obsbaja btn btn-block btn-success fa fa-eye" data-toggle="modal" data-target=".myObs"></button>
                    <?php endif ?>
                  </td>
                 </tr> 
                <?php endforeach ?>
                </tbody>
              </table>
            </div>
        </div>
      </div>
      <!-- /.box -->





    </section>
    <!-- /.content -->
  </div>

<!--Observaciones-->
    <div class="modal fade myObs" aria-labelledby="myModalLabel">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            <h4 class="modal-title" id="myModalLabel">Ver/Añadir Observaciones</h4>
          </div>
          <div class="modal-body">
              <div class="box-body">

              <input type="hidden" id="bajaidhidden" />
              <input type="hidden" id="inventarioabajar" />
                <div class="form-group ">
                  <label>Texto</label>
                  <input id="obstexto" type="text" class="form-control pull-right col-md-6"  placeholder="Ingrese el texto">
                </div>
                <br>
                  <div class="form-group">
                    <label>Motivo Origen</label>
                    <select id="obsmotivoresultado" class="select2" style="width: 100%;">
                      <option></option>
                      <?php foreach ($motivos as $key => $value): ?>
                        <?php if ($value['MOT_DIF'] == 2): ?>
                           <option value=" <?= $value['MOT_ID']  ?> "><?= $value['MOT_NOMBRE']  ?> </option>
                        <?php endif ?>
                      <?php endforeach ?>
                    </select>
                  </div>

                  <div class="form-group">
                   <table name="example2" class="table table-responsive table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>Fecha</th>
                          <th>Texto</th>
                          <th>Motivo</th>
                        </tr>
                      </thead>
                      <tbody id="historialobs">
                     
                      </tbody>
                    </table>
                    
                  </div>


            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="button" id="agregarmotivoresultado" class="btn btn-success">Guardar datos</button> 
          </div>
        </div>
      </div>
    </div>
  <!--Observaciones-->
    <?php function MISJAVASCRIPTPERSONALIZADO(){  ?>
    <script type="text/javascript" charset="utf-8">
    $(document).ready(function() {

       $(".datatablebaja").dataTable({
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
                                            columns: [ 0, 1, 2, 3,4]
                                        },
                                customize: function( xlsx ) {
                                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                    $('row:first c', sheet).attr( 's', '42' );
                                }
                            },
                         {
                            extend: 'pdfHtml5',
                            text: 'Exportar a pdf',
                            exportOptions: {
                                            columns: [ 0, 1, 2, 3,4 ]
                                        }
                        },
                          {
                                extend: 'copyHtml5',
                                text: 'Copiar Todo',
                                exportOptions: {
                                            columns: [ 0, 1, 2, 3,4 ]
                                        }
                            },
                    ]
                });

    })

    $(".obsbaja").click(function (argument) {
      clear();
       var id = $(this).attr("idbaja");
        $.ajax({
                    method: "POST",
                    url: "<?=site_url('/gestion/get_obs_by_baja_id')?>",
                    datatype: "json",
                    data:  {"bajaid": id},
                    success: function(response){
                      var pp = JSON.parse(response.allobs);
                      pp.forEach(function(rr) {
                        $("#historialobs").append('<tr><th>'+rr.FECHA+'</th><th>'+rr.TEXTO+'</th><th>'+rr.MOT_NOMBRE+'</th></tr>');
                      });
                       $("#bajaidhidden").val(id);
                       $("#inventarioabajar").val(response.INV_ID);
                       $.notify("Detalle observaciones cargado exitosamente", "success");      
                    }
           })   

    })

    $(document).on('change','#forminventario', function(event) {
      var tipo = $('option:selected', this).attr('tipo');
      $("#cantidadbaja").attr("max",$('option:selected', this).attr('stock'));
      $("#tipobaja").val(tipo);
      if (parseInt(tipo) == 1) {
        $("#cantidadbaja").val("1");
        $("#cantidadbaja").removeAttr('required');
        $("#cantidadbaja").prop('readonly', true);
      }else if(parseInt(tipo) == 2){
        $("#cantidadbaja").val("");
        $("#cantidadbaja").removeAttr('readonly');
        $("#cantidadbaja").prop('required', true);
      }
    });

     $(document).on('keyup', '#cantidadbaja', function(event) {
      var objcant = $(this);
      if (parseInt(objcant.val()) <= parseInt(objcant.attr("max")) && parseInt(objcant.val()) > 0) {

      } else {
        objcant.val("");
      }
    });

    $("#agregarmotivoresultado").click(function (argument) {
       var motivores = $("#obsmotivoresultado").val();
       var texto = $("#obstexto").val();
       var bajaidhidden = $("#bajaidhidden").val();
       var inventarioabajar = $("#inventarioabajar").val();
       if (motivores.trim() == "") {
        $.notify("Favor debe seleccionar un motivo de resultado", "warn");
        return false;
       }
       if (texto.trim() == "") {
        $.notify("Favor debe seleccionar escribir un texto de resultado", "warn");
        return false;
       }


       $.ajax({
                    method: "POST",
                    url: "<?=site_url('/gestion/insert_obs_to_baja')?>",
                    datatype: "json",
                    data:  {"bajaid": bajaidhidden,"texto": texto,"motivores": motivores,"inventarioabajar": inventarioabajar},
                    beforeSend: function () {
                            $('#carga_modal').modal('show');
                        },
                    success: function(response){
                      if (response.estado) {
                         $.notify(response.mensaje, "success");
                         location.reload(); 
                      }else{
                        $.notify(response.mensaje, "warn"); 
                      }
                           
                    }
           })

    })

    function clear(){
      $("#historialobs").text("");
      $("#motivoresultado").val("");
      $("#texto").val("");
      $("#bajaidhidden").val("");
      $("#inventarioabajar").val("");
    }

    </script>
    <?php } ?>