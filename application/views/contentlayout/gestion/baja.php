 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3>Dar de baja</h3>
    </section>

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
                <select name="forminventario" class="form-control selectinv" style="width: 100%;">
                  <option value="0"></option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Motivo Origen</label>
              <select name="formmotivoorigen" class="form-control select2" style="width: 100%;">
                <option value="0"></option>
                <?php foreach ($motivos as $key => $value): ?>
                  <option value=" <?= $value['MOT_ID']  ?> "><?= $value['MOT_NOMBRE']  ?> </option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Descripción</label>
              <input name="formdescripcion" type="text" class="form-control">
            </div>
          </div>
          <div class="col-md-4">
            <label>Acción</label>
            <input type="submit" class="btn btn-block btn-danger" value="Dar de Baja" />
          </div>
        </div>

        </form>
        </div>
        <div class="box-body">
          <h3>Historial de productos / insumos dados de baja</h3>
          <div class="box-body">
              <table name="example2" class="datatable table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Nombre</th>
                    <th>Motivo</th>
                    <th>Motivo resultado</th>
                    <th>Editar</th>
                    <th>Observaciones</th>
                  </tr>
                </thead>
                <tbody>
                <?php //print_r($bajas) ?>
                <?php foreach ($bajas as $key => $value): ?>
                 <tr>
                  <td><?= $value['BAJA_FECHA']  ?></td>
                  <td><?= $value['USU_NOMBRES']  ?></td>
                  <td><?= $value['MOT_NOMBRE']  ?></td>
                  <td><?php if ($value['BAJA_MOTIVO_RESULTADO'] != null): ?>
                    <?php
                     $ultimoregistro = array_pop($value['BAJA_MOTIVO_RESULTADO']);  
                     echo($ultimoregistro["OBS_MOT_NOMBRE"]);

                     ?>
                  <?php else: ?>
                     NO POSEE RESULTADO AUN
                  <?php endif ?>
                    
                  </td>
                  <td>
                    <button class="btn btn-block btn-success">Editar</button>
                  </td>
                  <td>
                    <button class="btn btn-block btn-success" data-toggle="modal" data-target=".myObs">Observación</button>
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
  <!--ModalELIMINAR-->
  <!--ModalELIMINAR-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
      <div class="modal-danger" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Eliminar producto</h4>
          </div>
          <div class="modal-body">
            <p>Está seguro de eliminar al producto <strong>Martillo</strong></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger">Eliminar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!--Modal-->
  <!--Modal-->



<!--Observaciones-->
    <div class="modal fade myObs" aria-labelledby="myModalLabel">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            <h4 class="modal-title" id="myModalLabel">Editar ingreso</h4>
          </div>
          <div class="modal-body">
              <div class="box-body">

                <div class="form-group ">
                  <label >Texto</label>
                  <input type="text" class="form-control pull-right col-md-6"  placeholder="Ingrese el texto">
                </div>
                <br>
                <div class="form-group">
                  <label>Motivo</label>
                  <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Motivos</option>
                    <option>Reparado</option>
                    <option>Merma</option>
                    <option>Necesita presupuesto</option>
                    <option>En espera de repuestos</option>
                  </select>
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
  <!--Observaciones-->
    <?php function MISJAVASCRIPTPERSONALIZADO(){  ?>
    <script type="text/javascript" charset="utf-8">
    $(document).ready(function() {

      $('.selectinv').select2({
            minimumInputLength: 1,
            maximumInputLength: 20,
            ajax: {
                    url: "<?=site_url('/gestion/get_iventario_by_cat_ajax')?>",
                    dataType: 'json',
                    method: "POST",
                    data: function (params) {
                            var query = {
                              search: params.term,
                            }
                            return query;
                          },    
                    processResults: function (data, params) {
                    return {
                      results: $.map(data, function (item) {
                            return {
                                text: item.text,
                                id: item.id
                            }
                }),
                    };
                  },
            cache: true
            },

    });

    })


    $(".itemSearch").select2({
    tags: true,
    multiple: true,
    tokenSeparators: [',', ' '],
    minimumInputLength: 2,
    minimumResultsForSearch: 10,
    ajax: {
        url: URL,
        dataType: "json",
        type: "GET",
        data: function (params) {

            var queryParameters = {
                term: params.term
            }
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.tag_value,
                        id: item.tag_id
                    }
                })
            };
        }
    }
});


    </script>
    <?php } ?>