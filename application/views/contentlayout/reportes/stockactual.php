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
              <select name="tipo" class="form-control select2" style="width: 100%;">
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
                <select name="cat" class="form-control select2" style="width: 100%;">
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
               <input type="submit" name="" class="btn btn-block btn-danger" 
                data-toggle="modal" data-target="#myModal" value="Filtro">
            </div>
       </div>
      <div class="col-md-3">    
                  <a href="<?= site_url('/Reportes/Pdfactual/');?>">
                  <td>
                  <button type="button" class="btn btn-primary btn-block  " data-toggle="modal" data-target="#myModal" data-skin="skin-blue"><i class="fa fa-eye"></i> Ver </button>
                </td></a>                             
                </div>
                </br>
                </br>
                </form>
      <thead>
      <div class="box-body">
        <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">    
                <tr>
                  <th>Tipo de Producto</th>
                  <th>Categoria</th>
                  <th>Producto</th>
                  <th>Fecha</th>
                  <th>Stock</th>
                  <th>Proveedor</th>
                  <th>Posicion</th>
                </tr>
              </thead>
              <?php foreach ($buscar as $key => $value): ?>
              <tbody>
              <tr>
                <td><?= $value['TIPO_NOMBRE']; ?></td>
                <td><?= $value['CAT_NOMBRE']; ?></td>
                <td><?= $value['PROD_NOMBRE']; ?></td>
                <td><?= $value['ING_FECHA']; ?></td>
                <td><?= $value['PROD_STOCK_TOTAL']; ?></td>
                <td><?= $value['PROV_NOMBRE']; ?></td>
                <td><?= $value['PROD_POSICION']; ?></td>
              
              <?php endforeach; ?>
    
              </tbody>
            </table>
          </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>  