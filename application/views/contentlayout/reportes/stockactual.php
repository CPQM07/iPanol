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
              <select id="tipo" name="tipo" class="form-control select2" style="width: 100%;">
              <option value=0 selected="">Tipo Productos</option>
              <?php foreach ($tipo as $key => $value): ?>
              <option value="<?= $value['TIPO_ID']; ?>"><?= $value['TIPO_NOMBRE'];  ?></option>
              <?php endforeach ?>
        </select>
          </div>
        </div>
               <div class="col-md-4">
          <label>Categorias</label>
             <div class="form-group">
                <select id="cat" name="cat" class="form-control select2" style="width: 100%;">
                   <option value=0 selected="">Tipo Categorias</option>
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
               <input type="submit"  class="btn btn-block btn-danger" 
                data-toggle="modal" data-target="#myModal" value="Filtro">
            </div>
       </div>
       </form>
      <div class="col-md-3">    
               <form id="pdf" action="Pdfactual" method="post" target="_blank">
                  <input id="recuperartipo" type="hidden" name="recuperartipo" 
                         value="<?= $_SESSION['buscartipo'] ?>">
                  <input id="recuperarcat" type="hidden" name="recuperarcat" 
                         value="<?= $_SESSION['buscarcat'] ?>">
                  <?php echo "tipo: ".$_SESSION['buscartipo']; ?>
                  <?php echo "cat: ".$_SESSION['buscarcat']; ?>
                  <td>
                  <button name="verpdf" type="submit" class="btn btn-primary btn-block  " data-toggle="modal" data-target="#myModal" data-skin="skin-blue"><i class="fa fa-eye"></i> Ver </button>
                </td>                         
                </div>
                </br>
                </br>
                </form>
      <thead>
      <div class="box-body">
        <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">    
                <tr>
                  <th>Nombre Producto</th>
                  <th>Tipo</th>
                  <th>Categoria</th>
                  <th>Posicion</th>
                  <th>Total</th>
                </tr>
              </thead>
              <?php foreach ($buscar as $key => $value): ?>
              
              <tbody>
              <tr>
                <td><?= $value['INV_PROD_NOM']; ?></td>
                <td><?= $value['TIPO_NOMBRE']; ?></td>
                <td><?= $value['CAT_NOMBRE']; ?></td>
                <td><?= $value['PROD_POSICION']; ?></td>
                <td><?= @$value['Total']; ?></td>
              
              <?php endforeach; ?>
    
              </tbody>
            </table>
          </div>
      </div>
       
    </div>
  </section>
  <!-- /.content -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $('#pdf').submit(function(){
     $(this).append("<input name='tipo' type='hidden' value='"+$("#recuperartipo").val()+"'  >");
     $(this).append("<input name='cat' type='hidden' value='"+$("#recuperarcat").val()+"'  >");
      console.log($("#recuperartipo").val());
      console.log($("#recuperarcat").val());

    //  return false;
    });
  });

</script>
</div>