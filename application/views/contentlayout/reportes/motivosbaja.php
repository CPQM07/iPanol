<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h3>Reportes Motivos de baja</h3>
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
          <div class="col-md-4">
            <label>Tipos de baja</label>
             <div class="form-group">
                <select id="mot" name="mot" class="form-control select2" >
                <option value="0">Todos los tipos de baja</option>
                   <?php foreach ($motivos as $key => $value): ?>
                    <?php if ($value['MOT_ESTADO']==1):?>
                <option value=" <?= $value['MOT_ID']  ?>"><?= $value['MOT_NOMBRE'];  ?>
                       </option>
                   <?php endif ?>
                  <?php endforeach ?>
                </select>
              </div>
        </div> 

       <div class="col-md-3" class="pull-right">
               <label>Acción</label>
               <input type="submit"  class="btn btn-block btn-danger" name="filtro" value="filtro">
            </div>
       </div>
       </form>
       
      <div class="box-body">
        <div class="box-body">
          <?php if (isset($buscar) > 0): ?>
            <div class="col-sm-offset-9 col-md-3">    
               <form id="pdf" action="Pdfbaja" method="post" target="_blank">
                  <input id="recuperartipo" type="hidden" name="recuperartipo" 
                         value="<?= @$buscartipo ?>">
                  <input id="recuperarcat" type="hidden" name="recuperarcat" 
                         value="<?= @$buscarcat?>">
                         <input id="recuperarmot" type="hidden" name="recuperarmot" 
                         value="<?= @$buscarmot?>">
                  
                  <button name="verpdf" type="submit" class="pull-right btn btn-primary btn-block  "  data-skin="skin-blue"><i class="fa fa-pdf"></i> Exportar </button>
                  <?php echo "tipo ".$buscartipo; ?>         
                  <?php echo "cat".$buscarcat; ?>              
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
                  <th>Fecha dado de baja</th>
                  <th>Motivo</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($buscar as $key => $value): ?>
                <tr>
                <td><?= $value['INV_PROD_CODIGO']; ?></td>
                <td><?= $value['INV_PROD_NOM']; ?></td>
                <td><?= $value['TIPO_NOMBRE']; ?></td>
                <td><?= $value['CAT_NOMBRE']; ?></td>
                <td><?= $value['BAJA_FECHA']; ?></td>
                <td><?= $value['MOT_NOMBRE']; ?></td>
                </tr>
              <?php endforeach ?>
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

  <?php if(isset($buscartipo) && isset($buscarcat) && isset($buscarmot)): ?>
    $("#cat").val('<?=$buscarcat?>').trigger('change');
    $("#tipo").val('<?=$buscartipo?>').trigger('change');
    $("#mot").val('<?=$buscarmot?>').trigger('change');
  <?php endif; ?>
  $('#pdf').submit(function(){
     $(this).append("<input name='tipo' type='hidden' value='"+$("#recuperartipo").val()+"'  >");
     $(this).append("<input name='cat' type='hidden' value='"+$("#recuperarcat").val()+"'  >");
     $(this).append("<input name='mot' type='hidden' value='"+$("#recuperarmot").val()+"'  >");
      console.log($("#tipo").val());
      console.log($("#cat").val());

     return;
    });
  });

</script>
</div>