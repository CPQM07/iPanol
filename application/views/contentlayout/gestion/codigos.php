<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3>Códigos de barra</h3>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
      </div>
      <!-- /.row -->
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
                    <td><?= $value['PROD_CAT_ID'][0]->get('CAT_NOMBRE'); ?></td>
                    <td>
                      <button id="" name="<?= $value['PROD_CAT_ID'][0]->get('CAT_NOMBRE'); ?>" value="<?= $value['PROD_NOMBRE']?>" type="button" class="barcode btn btn-danger btn-block">
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
                <!-- /.col -->
                <!-- /.col -->
              </div>
              <!-- /.row -->
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
                    url: "<?=site_url('/gestion/generarPDF')?>",
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