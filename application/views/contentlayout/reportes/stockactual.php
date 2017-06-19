<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h3>Stock Actual</h3>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
      <div class="row">
          <div class="col-md-4">
          <form action="" method="post" class="form">
          <div class="form-group">
            <label>Tipo</label>
              <select id="tipo" name="tipo" class="form-control select2">
              <option value="0">Tipos de productos</option>
              <?php foreach ($tipo as $key => $value): ?>
              <option value="<?= $value['TIPO_ID']; ?>"><?= $value['TIPO_NOMBRE'];  ?></option>
              <?php endforeach ?>
        </select>
          </div>
        </div>
               <div class="col-md-4">
          <label>Categorias</label>
             <div class="form-group">
                <select id="cat" name="cat" class="form-control select2" >
                <option value="0">Todas las categorias</option>x
                   <?php foreach ($categoria as $key => $value): ?>
                    <?php if ($value->get("CAT_ESTADO") == 1): ?>
                       <option value=" <?= $value->get('CAT_ID')  ?>"><?= $value->get('CAT_NOMBRE')  ?>
                       </option>
                    <?php endif ?>
                  <?php endforeach ?>
                </select>
              </div>
        </div> 
       <div class="col-md-4" class="pull-right">
               <label>Acción</label>
               <input type="submit"  class="btn btn-block btn-danger" name="filtro" value="filtro">
            </div>
       </div>
       </form>
       
      <div class="box-body">
        <div class="box-body">
          <?php if (isset($buscar) > 0): ?>
            <div class="col-sm-offset-9 col-md-3">    
               <form id="pdf" action="pdfactual" method="post" target="_blank">
                  <input id="recuperartipo" type="hidden" name="recuperartipo" 
                         value="<?= @$buscartipo ?>">
                  <input id="recuperarcat" type="hidden" name="recuperarcat" 
                         value="<?= @$buscarcat?>">
                  
                  <button name="verpdf" type="submit" class="pull-right btn btn-primary btn-block  "  data-skin="skin-blue"><i class="fa fa-pdf"></i> Exportar </button>
                                         
                </br>
                </br>
                </form>
            </div>
            <table id="example2" class="datatable table table-bordered table-hover">    
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Nombre Producto</th>
                  <th>Tipo</th>
                  <th>Categoria</th>
                  <th>Posicion</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($buscar as $key => $value): ?>
              <tr>
                <td><?= $value['INV_PROD_CODIGO']; ?></td>
                <td><?= $value['INV_PROD_NOM']; ?></td>
                <td><?= $value['TIPO_NOMBRE']; ?></td>
                <td><?= $value['CAT_NOMBRE']; ?></td>
                <td><?= $value['PROD_POSICION']; ?></td>
                <?php if ($value['TIPO_ID'] == 2): ?>
                  <td><?= $value['INV_PROD_CANTIDAD']; ?></td>
                  <?php endif ?>
                  <?php if ($value['TIPO_ID']== 1): ?>
                <td> <?= @$value['Total']; ?></td>
                <?php endif ?>
              <?php endforeach ?>
              </tr>
              </tbody>
            </table>
          <?php endif ?>
          </div>
      </div>
       
    </div>
  </section>
  <!-- /.content -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){

  <?php if(isset($buscartipo) && isset($buscarcat)): ?>
    $("#cat").val('<?=$buscarcat?>').trigger('change');
    $("#tipo").val('<?=$buscartipo?>').trigger('change');
  <?php endif; ?>
  $('#pdf').submit(function(){
     $(this).append("<input name='tipo' type='hidden' value='"+$("#recuperartipo").val()+"'  >");
     $(this).append("<input name='cat' type='hidden' value='"+$("#recuperarcat").val()+"'  >");
      console.log($("#tipo").val());
      console.log($("#cat").val());

     //return false;
    });
  });

</script>
</div>