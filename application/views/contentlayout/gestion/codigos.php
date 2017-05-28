<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3>Códigos de barra</h3>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <!-- Main row -->
      <div class="row">

        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Todos los códigos de barra por nombre</h3>

            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="danger">Nombre</th>
                  <th>Categoria</th>
                  <th>Descargar todos los código de barra</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($productos as $key => $value): ?>
                  <tr>
                    <td><?= $value['PROD_NOMBRE']; ?></td>
                    <td><?= $value['PROD_CAT_ID']->get('CAT_NOMBRE'); ?></td>
                    <td>
                      <button id="" name="<?= $value['PROD_CAT_ID']->get('CAT_NOMBRE'); ?>" value="<?= $value['PROD_NOMBRE']?>" type="button" class="barcode btn btn-danger btn-block">
                        <i class="fa fa-barcode"></i>
                      </button>
                    </td>
                  </tr>
                <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
      <!-- /.box -->

          <!-- /.box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Códigos de barra en detalle</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <label>Tipo de insumo</label>
                    <div class="box-body">
                      <div class="form-group">
                          <input type="radio" val="1" name="r1" class="minimal-red" checked>Activo</input>
                          <input type="radio" val="2" name="r1" class="minimal-red">Fungible</input>
                      </div>
                    </div>
                <!-- /.box-body -->
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Producto</label>
                    <select class="form-control select2" style="width: 100%;">
                      <option selected="selected"></option>
                      <option>Alaska</option>
                    </select>
                  </div>
                </div>

              </div>
              <!-- /.row -->
              <div class="row">
              <div class="col-md-12">
                  <table id="example2" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th  style="text-align: center;">Seleccionar</th>
                      <th>Nombre</th>
                      <th>ID</th>
                      <th>Categoria</th>
                      <th>Descargar todos los código de barra</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($productos as $key => $value): ?>
                      <tr>
                        <div class="form-group">
                          <td style="text-align: center;">
                            <label>
                              <input class="" type="checkbox" data-toggle="toggle" data-on="<i class='fa fa-check'></i>" data-off="<i class='fa fa-close'></i>" data-onstyle="danger">
                            </label>
                          </td>
                        </div>
                        <td><?= $value['PROD_NOMBRE']; ?></td>
                        <td>we</td><!-- ID -->
                        <td><?= $value['PROD_CAT_ID']->get('CAT_NOMBRE'); ?></td>
                        <td>
                          <button id="" name="<?= $value['PROD_CAT_ID']->get('CAT_NOMBRE'); ?>" value="<?= $value['PROD_NOMBRE']?>" type="button" class="barcode btn btn-danger btn-block">
                            <i class="fa fa-barcode"></i>
                          </button>
                        </td>
                      </tr>
                    <?php endforeach ?>
                    </tbody>
                  </table>
              </div>
              </div>
            </div>
          </div>
            <!-- ./box-body -->

          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row (main row) -->
    <!-- /.content -->
  </div>
  <!--  /.content-wrapper -->

  <?php function MISJAVASCRIPTPERSONALIZADO(){?>
   <script type="text/javascript" charset="utf-8">

    $(function () {
      //Initialize Select2 Elements
      $(".select2").select2();



      $('#example1').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"}
      });

      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"}
      });



      $('.barcode').click(function(){
        var nombreProd = $(this).val();
        var nomCat = $(this).attr("name");

        $.ajax(
          {
            method:"POST",
            url: "<?=site_url('/gestion/validar')?>",
            datatype:'json',
            data: {"nombreProducto": nombreProd},
            success: function(response){
                if (response.val == 0)
                { 
                  $.notify("No existen "+nombreProd+" en el invetario.", "error");
                }else{
                  $('#carga_modal').modal('show');
                  $.ajax(
                  {
                    method:"POST",
                    url: "<?=site_url('/gestion/generarPDFGeneral')?>",
                    datatype:'json',
                    data: {"idBarcode": nombreProd,"nombreCat": nomCat},
                    success: function(response){
                      var win = window.open('', '_blank');
                      win.location.href = response.path;
                      $('#carga_modal').modal('hide');
                      location.reload();
                    }
                  });
                }
            }
          });

      });
    });


  </script>
  <?php } ?>