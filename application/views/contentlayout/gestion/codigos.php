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
              <table id="example1" class="table table-bordered hover">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Categoria</th>
                  <th>Descargar todos los código de barra</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($productos as $key => $value): ?>
                  <tr>
                    <td class="success"><?= $value['PROD_NOMBRE']; ?></td>
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
                  <label>Tipo de producto</label>
                  <form name="formulario" id="formulario" method="POST">
                    <input type="radio" name="tipo" id="tipo1" value="1"> Activo
                    <input type="radio" name="tipo" id="tipo2" value="2"> Fungible
                  </form>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Producto</label>
                    <select class="form-control productos" style="width: 100%;">
                      <option>Seleccione un tipo de producto</option>
                    </select>
                  </div>
                </div>
<!-- <div class="form-group">
  <td style="text-align: center;">
    <label>
      <input id="show" type="checkbox" data-toggle="toggle" data-on="<i class='fa fa-check'></i>" data-off="<i class='fa fa-close'></i>" data-onstyle="danger">
    </label>
  </td>
</div> -->
              </div>
              <!-- /.row -->
              <div class="row">
                <div class="col-md-12">
                  <table id="dinamicajax" class="table table-responsive table-bordered table-hover">
                  </table>
                <div class="col-md-12">
                  <button id="enviar" value="ola" class="btn btn-danger btn-block">Descargar códigos de barra seleccionados</button>
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

      $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
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

    var data=0;
    var tabla;
    var asignaciones = new Array();
        tabla = $('#dinamicajax').DataTable({
          lengthMenu: [5,10, 20, 50, 100],
          "pagingType": "simple",
          "responsive": true,
          "paging": true,
          "cache": false,
          "processing": true,
          "lengthChange": true,
          "deferRender": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "ajax": {
              "url": "<?=site_url('/gestion/traerInventarioByIdTipo')?>",
              "type": "POST",
              "beforeSend": function () {
                      $('#carga_modal').modal('show');
                  },
              "data": function (argument) {
                return {'idTipo': data };
              },
              "dataSrc": function ( json ) {
                $('#carga_modal').modal('hide');
                  return json;
              }
          },
          "language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
          },
          "columns": [
              { title: "Seleccionar",className: "text-center" },
              { title: "ID",className: "text-center" },
              { title: "Nombre",className: " text-center"},
              { title: "Descargar código de barra unitario",className: "text-center"}]
            });


      $("input[name=tipo]").change(function () {/*CARGAR SELECT2 DEPENDIENDO DE TIPO DE PROODUCTOS POR AJAX*/
          $('.productos').select2().on("change", function(e) {
          data = $('.productos').select2('data')[0]['id'];
          if (data != 0) {
            $('#dinamicajax').DataTable().ajax.reload();
          }
        });


        var idTipo = $(this).val();
        $('.productos').select2({
          maximumInputLength: 20,
          ajax: {
                url: "<?=site_url('/gestion/traerProductosByIdTipo')?>",
                dataType: 'json',
                method: "POST",
                data: function (params) {
                        var query = {
                          idTipo: idTipo,
                        }
                        return query;
                      },
                processResults: function (data, params) {
                return {
                  results: $.map(data, function (item) {
                      return {
                          text: item.nombre,
                          id: item.id
                          }
                        }),
                      };
                    },
              cache: true
              }, 
            });
      });


        $(document).on("click",".xd",function function_name(argument) {/*GENERA PDF UNITARIO*/
          var value = $(this).val();
          $.ajax({
            method:"POST",
            url: "<?=site_url('/gestion/generarPDFunitario')?>",
            datatype:'json',
            data: {"idInv": value},
            success: function(response){
              var win = window.open('', '_blank');
              win.location.href = response.path;
              $('#carga_modal').modal('hide');
            }
          });
        });



      var selected = [];  
      $(document).on("click",".items",function function_name(argument){
        if (this.checked) {
            selected.push($(this).val());
          }else{
            var po = selected.indexOf($(this).val());
            if(po > -1){
              selected.splice(po,1);
            }
          }
      });


        function deMenorAMayor(elem1, elem2) {return elem1-elem2;}

        $('#enviar').click(function(){

          if (selected.length != 0 && selected.length > 1){

            var arr = selected.sort(deMenorAMayor);

            $.ajax({
                  type: "POST",
                  url: "<?=site_url('/gestion/generarPDFseleccionado')?>",
                  datatype:'json',
                  data: {"data" : arr},
                  success: function(response){console.log(response.path);
                      var win = window.open('', '_blank');
                      win.location.href = response.path;
                      location.reload();
                    }
              });

          }else{
            $.notify("Seleccione algun producto.", "error");
          }

        });
          

    

  </script>
  <?php } ?>