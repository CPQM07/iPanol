<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h3>Motivos de baja a los produtos</h3>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Mes</label>
            <select class="form-control select2" style="width: 100%;">
              <option selected="selected">Mes</option>
              <option>Enero</option>
              <option>Febrero</option>
              <option>Marzo</option>
              <option>Abril</option>
              <option>Mayo</option>
              <option>Junio</option>
              <option>Julio</option>
              <option>Agosto</option>
              <option>Septiembre</option>
              <option>Octubre</option>
              <option>Noviembre</option>

            </select>
          </div>
        </div>
         <div class="col-md-4">
          <div class="form-group">
            <label>Tipo</label>
            <select class="form-control select2" style="width: 100%;">
              <option selected="selected">Tipo producto</option>
              <option>Activo</option>
              <option>Fungible</option>
            </select>
          </div>
        </div>
        <div class="col-md-4" class="pull-right">
          <label>Acción</label>
          <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#myModal">Filtrar</button>
        </div>
      </div>
      </div>
      <div class="box-body">
        <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Tipo de Producto</th>
                  <th>Producto</th>
                  <th>Fecha</th>
                  <th>Motivo de baja</th>
                  <th>Usuario responsable</th>
                  <th>Descripcion</th>
                  <th>Vista previa</th>
                  <th>Descargar</th>
                </tr>
              </thead>
              <tbody>
              <tr>
                <td>Stock Critico</td>
                <td>RJ45</td>
                <td>2017/05/14</td>
                <td>5</td>
                <td>Soledad H.</td>
                <td>Producto Obsoleto</td>
                <td>
                  <button type="button" class="btn btn-primary btn-block  " data-toggle="modal" data-target="#myModal" data-skin="skin-blue"><i class="fa fa-eye"></i></button>
                </td>
                <td>
                 <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myEdit"><i class="fa fa-save"></i></button>
                </td>
              <tr>
                <td>Stock Critico</td>
                <td>RJ45</td>
                <td>2017/05/14</td>
                <td>5</td>
                <td>Soledad H.</td>
                <td>Producto Obsoleto</td>
                <td>
                <button type="button" class="btn btn-primary btn-block  " data-toggle="modal" data-target="#myModal" data-skin="skin-blue"><i class="fa fa-eye"></i></button>
                </td>
                <td>
                   <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myEdit"><i class="fa fa-save"></i></button>
                </td>
              </tr>
              <tr>
                <td>Stock Critico</td>
                <td>RJ45</td>
                <td>2017/05/14</td>
                <td>5</td>
                <td>Soledad H.</td>
                <td>Producto Obsoleto</td>
                <td>
                  <button type="button" class="btn btn-primary btn-block  " data-toggle="modal" data-target="#myModal" data-skin="skin-blue"><i class="fa fa-eye"></i></button>
                </td>
                <td>
                   <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myEdit"><i class="fa fa-save"></i></button>
                </td>
              </tr>
              <tr>
               <td>Stock Critico</td>
                <td>RJ45</td>
                <td>2017/05/14</td>
                <td>5</td>
                <td>Elias Z.</td>
                <td>Producto Obsoleto</td>
                <td>
               <button type="button" class="btn btn-primary btn-block  " data-toggle="modal" data-target="#myModal" data-skin="skin-blue"><i class="fa fa-eye"></i></button>
                </td>
                <td>
                   <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myEdit"><i class="fa fa-save"></i></button>
                </td>
              </tr>
              <tr>
               <td>Stock Critico</td>
                <td>Mouse</td>
                <td>2017/05/4</td>
                <td>5</td>
                <td>Elias Z.</td>
                <td>Producto Obsoleto</td>
                <td>
                  <button type="button" class="btn btn-primary btn-block  " data-toggle="modal" data-target="#myModal" data-skin="skin-blue"><i class="fa fa-eye"></i></button>
                </td>
                <td>
                  <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myEdit"><i class="fa fa-save"></i></button>
                </td>
              </tr>
              <tr>
               <td>Stock Critico</td>
                <td>Martillo</td>
                <td>2017/05/11</td>
                <td>1</td>
                <td>Soledad H.</td>
                <td>Producto Obsoleto</td>
                <td>
                  <button type="button" class="btn btn-primary btn-block  " data-toggle="modal" data-target="#myModal" data-skin="skin-blue"><i class="fa fa-eye"></i></button>
                </td>
                <td>
                   <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myEdit"><i class="fa fa-save"></i></button>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
      </div>
    </div>
    <!-- /.box -->





  </section>
  <!-- /.content -->
</div>




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
