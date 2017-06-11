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
              height: 50px;
          }
      </style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="row">
        <div class="col-sm-12">
          <h3>
            Mantenedor | Inventario
          </h3>
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
              <table id="example1" class="datatable table table-bordered hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Estado</th>
                  <th>Cantidad</th>
                  <th>Tipo</th>
                  <th>Categoría</th>
                  <th>Editar</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($inventario as $key => $value): ?>
                    <tr>
                      <td><?= $value['INV_ID']; ?></td>
                      <td><?= $value['INV_PROD_NOM']; ?></td>
                      <td>
                        <?php 
                          $estado= $value['INV_PROD_ESTADO']; 
                          switch ($estado) {
                            case '0':
                              echo "Dado de baja";
                              break;
                            case '1':
                              echo "Activo";
                              break;
                            case '2':
                              echo "Enviado a reparación";
                              break;
                            case '3':
                              echo "Prestado";
                              break;
                          }
                        ?>
                      </td>
                      <td><?= $value['INV_PROD_CANTIDAD']; ?></td>
                      <td><?= $value['INV_TIPO_ID']->get('TIPO_NOMBRE'); ?></td>
                      <td><?= $value['INV_CATEGORIA_ID']->get('CAT_NOMBRE'); ?></td>
                      <td>
                        <button value="<?= $value['INV_PROD_NOM']; ?>" id="<?= $value['INV_ID']; ?>" class="editar btn btn-block btn-danger" data-toggle="modal" data-target="#newPro">
                          <i class="fa fa-edit"></i>
                        </button>
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
    <div class="modal fade bs-example-modal-lg" id="newPro" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-tittle">Editar producto</h4>
            <div class="modal-body">
              <div class="box">
                <div class="row">
                  <form class="form-horizontal" action="<?=site_url('Mantencion/new_producto/1')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" onSubmit="return validate();">
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Nombre</label>
                        <div class="col-md-8">
                          <input id="wea" name="inventario[INV_PROD_NOM]" type="text" class="col-md-12"  maxlength="50" required>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Editar imagen</label>

                        <div class="col-md-4">
                          <div id="upload">
                            <input name="files" type="file" id="files-new" class="input-file" size="2120" accept="image/png,image/jpeg,image/jpg" href="javascript:void(0);" required>
                          </div>
                          <output id="list"></output>
                        </div>
                        <div class="col-md-6 pagination-centered">
                          <img class="col-md-6" style="text-align: center;" src="<?= base_url("/resources/images/Imagenes_Server/alicate.jpg"); ?>" alt="" width="100%" height="100%" />
                        </div>
                      </div>
                    </div>
                    </div>
                  </div>
                    <!-- /.box-body -->
                      <div class="form-group">
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

  <!--modalPRODUCTONUEVO-->
  <!--modalPRODUCTONUEVO-->



    </div>
<?php function MISJAVASCRIPTPERSONALIZADO(){  ?>

<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {

  });

    $('.editar').click(function(){
      $("#wea").val("");
      var id=$(this).attr("id");
      var nom = $(this).val();
          console.log(nom);
      $.ajax({
        type:"POST",
        dataType:"json",
        data: {"id": id},
        url:"<?=site_url('/Mantencion/inventarioById')?>",
        success: function(data){
          $("#wea").val(data.INV_PROD_NOM);
        }
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

/*function archivo(evt) {
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
                   document.getElementById("listo").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
           };
       })(f);

       reader.readAsDataURL(f);
   }
}*/


</script>
<?php } ?>
