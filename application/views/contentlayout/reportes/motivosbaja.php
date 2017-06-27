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
              <select id="tipo" name="tipo" class="select2" style="width: 100%" required="true">
              <option value="0">Tipos de productos</option>
              <?php foreach ($tipo as $key => $value): ?>
              <option value="<?= $value['TIPO_ID']; ?>"><?= $value['TIPO_NOMBRE'];  ?></option>
              <?php endforeach ?>
        </select>
          </div>
        </div>
               <div class="col-md-4">
          <label>Categorías</label>
             <div class="form-group">
                <select id="cat" name="cat" class="select2" style="width: 100%">
                <option value="0">Todas las categorías</option>x
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
                <select id="mot" name="mot" class="select2" style="width: 100%">
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
               <input type="submit"  class="btn btn-block btn-danger" name="filtro" value="Filtro">
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
                  
                  <button name="verpdf" type="submit" class="pull-right btn btn-primary btn-block  "  data-skin="skin-blue"><i class="fa fa-pdf"></i> Exportar PDF</button>             
                </br>
                </br>
                </form>
                <form id="excel" action="excelbaja" method="post" target="_blank">
                <meta charset="utf-8">
                  <input id="recuperartipo" type="hidden" name="recuperartipo" 
                         value="<?= @$buscartipo ?>">
                  <input id="recuperarcat" type="hidden" name="recuperarcat" 
                         value="<?= @$buscarcat?>">
                  <input id="recuperarmot" type="hidden" name="recuperarmot" 
                         value="<?= @$buscarmot?>">
                  
                  
                  <button name="verexcel" type="submit" class="pull-right btn btn-primary btn-block  "  data-skin="skin-blue"><i class="fa fa-pdf"></i> Exportar EXCEL</button>
                                         
                </br>
                </br>
                </form>
            </div>
            </div>
            <div class="table-responsive">
            <table id="example2" class="datatable table-bordered table-hover">    
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Nombre producto</th>
                  <th>Tipo</th>
                  <th>Categoría</th>
                  <th>Fecha dado de baja</th>
                  <th>Motivo de baja</th>
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
            </div>
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
     $('#excel').submit(function(){
     $(this).append("<input name='tipo' type='hidden' value='"+$("#recuperartipo").val()+"'  >");
     $(this).append("<input name='cat' type='hidden' value='"+$("#recuperarcat").val()+"'  >");
     $(this).append("<input name='mot' type='hidden' value='"+$("#recuperarmot").val()+"'  >");
    console.log($("#tipo").val());
      console.log($("#cat").val());
     //return false;
  });
  });

</script>
</div>