<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
          <h3>
            Ingreso de productos
          </h3>
          
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">

        <div class="col-md-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <form action="<?=site_url('Gestion/ingresar_producto_stock')?>" method="post" accept-charset="utf-8">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Producto</label>

                      <div class="input-group">
                        <select name="producto" class="form-control select2">
                          <option></option>
                          <?php foreach ($productos as $key => $value): ?>
                            <?php if ($value->get("PROD_ESTADO") != 0): ?>
                              <option value="<?= $value->get("PROD_ID")  ?>"><?= "(#".$value->get("PROD_ID").") ".$value->get("PROD_NOMBRE")." [".$value->get("CAT_NOMBRE")."]" ?></option>
                            <?php endif ?>
                          <?php endforeach ?>
                        </select>
                        <div class="input-group-addon">
                          <a href="" data-toggle="modal" data-target="#myPro">
                            <i class="fa fa-plus"></i>
                          </a>
                        </div>
                      </div>
                      <!-- /.input group -->
                    </div>
                  </div>
                  <div class="col-md-3">

                      <label>Cantidad</label>
                      <input type="number" name="cantidad" class="form-control">
                  </div>
                  <div class="col-md-3">
                      <label>Orden de compra</label>
                      <input type="number" name="ordencompra" class="form-control">
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Proveedor</label>

                      <div class="input-group">
                        <select name="proveedor" class="form-control select2">
                          <option></option>
                          <?php foreach ($proveedores as $key => $value): ?>
                            <option value="<?= $value->get("PROV_RUT")  ?>"><?= $value->get("PROV_NOMBRE")  ?></option>
                          <?php endforeach ?>
                        </select>
                        <div class="input-group-addon">
                          <a href="" data-toggle="modal" data-target="#myProvee">
                            <i class="fa fa-plus"></i>
                          </a>
                        </div>
                      </div>
                      <!-- /.input group -->
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                      <label>Descripción</label>
                      <input name="descripcion" type="textarea" class="form-control">
                  </div>
                  <div class="col-md-6">
                      <label>Vida útil</label>
                      <input name="vidautil" type="number" class="form-control" >
                  </div>
                </div>
                <br>
                <div class="col-md-12">
                  <button type="submit" class="btn btn-block btn-success">Agregar</button>
                </div>

                </form>

                <hr>
                <div class="row">
                  <div class="col-md-12">
                  <div class="box-header">
                    <h3 class="box-title">Resultados</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example2" class="datatable table table-bordered table-hover">
                      <thead>
                      <tr>                        
                        <th>Fecha de ingreso</th>
                        <th>Ingresado por</th>
                        <th>Insumo</th>
                        <th>Total</th>
                        <th>Editar</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($ingresos as $key => $value): ?>
                        <tr>                           
                            <td><?= $value->get('ING_FECHA') ?></td>
                            <td><?= $value->get('USU_NOMBRES') ?></td>
                            <td><?= $value->get('PROD_NOMBRE') ?></td>
                            <td><?= $value->get('ING_CANTIDAD') ?></td>
                            <td>
                              <button type="button" id="<?= $value->get('ING_ID') ?>" class="editar btn btn-danger btn-xs btn-block" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-edit"></i>
                              </button>
                            </td>
                        </tr>
                      <?php endforeach ?>
                  </tbody>
                  </table>
                </div>
                <!-- /.box-body -->
              </div>
                <!-- /.box -->
              </div>

              <!--modal-->
                  <div class="modal fade" id="myModal" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                          <h4 class="modal-title" id="myModalLabel">Editar ingreso</h4>
                        </div>
                        <div class="modal-body">
                          <div class="box-body">
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                  <thead>
                                    <tr>
                                      <th>Insumo</th>
                                      <th>Tipo</th>
                                      <th>Categoria</th>
                                      <th>Cantidad</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  <tr>
                                    <td>
                                      <h5>Resistencia 1K Ohm</h5>
                                    </td>
                                    <td>
                                      <div class="form-group">
                                        <select class="form-control select2" style="width: 100%;">
                                          <option selected="selected">Tipo</option>
                                          <option>Fungible</option>
                                          <option>Activo</option>
                                        </select>
                                      </div>
                                    </td>
                                    <td>
                                      <div class="form-group">
                                        <select class="form-control select2" style="width: 100%;">
                                          <option selected="selected">Categoria</option>
                                          <option>Herramientas</option>
                                          <option>Cables</option>
                                          <option>Conectores</option>
                                        </select>
                                      </div>
                                    </td>
                                    <td> <h5>
                                      
                                      <input type="Number" class="col-xs-12"></input>
                                    </h5>
                                    </td>
                                  </tr>
                                  </tbody>
                                </table>
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
              <!--modal-->

                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->

          </div>
          
        </section>
        <!-- /.col -->
      </div>
      <!-- /.row (main row) -->







  <!--Producto-->
    <div class="modal fade" id="myPro" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            <h4 class="modal-title" id="myModalLabel">Editar ingreso</h4>
          </div>
          <div class="modal-body form-inline">
            <div class="box-body">
              <div class="box-body">
              <form role="form">
              <div class="box-body">

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Nombre</label>
                  <input type="text" class="form-control pull-right" id="exampleInputEmail1" placeholder="Ingrese el nombre">
                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputPassword1">Stock crítico</label>
                  <input type="number" class="form-control pull-right" id="exampleInputPassword1">
                </div>

                <div class="form-group col-md-6"><br>
                  <label for="exampleInputPassword1">Stock óptimo</label>
                  <input type="number" class="form-control pull-right" id="exampleInputPassword1">
                </div>

                <div class="form-group col-md-6"><br>
                  <label for="exampleInputPassword1">Posición</label>
                  <input type="number" class="form-control pull-right" id="exampleInputPassword1" placeholder="A-1">
                </div>
                
                <div class="form-group col-md-6"><br>
                  <label for="exampleInputPassword1">Prioridad</label>
                  <input type="number" class="form-control pull-right" id="" placeholder="1-10">
                </div>

                <div class="form-group col-md-6"><br>
                  <label for="exampleInputPassword1">Días de anticipación</label>
                  <input type="number" class="form-control pull-right" id="">
                </div>

                <div class="form-group col-md-6">
                  <label>Tipo de producto</label>
                  <div class="pull-right">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                      Activo
                    </label>

                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                      Fungible
                    </label>
                  </div>
                </div>



                <div class="form-group col-md-6">
                  <label>Categoría</label>
                    <select class="form-control select2 pull-right" style="width: 100%;">
                      <option selected="selected">Seleccione</option>
                      <option>Herramienta</option>
                      <option>Conectores</option>
                    </select>
                </div>

                <br>

                <div class="form-group col-md-6">
                  <label for="exampleInputFile">Imagen</label>
                  <input type="file" class="pull-right" id="exampleInputFile">
                </div>


                </div>
              </div>
              <!-- /.box-body -->

              </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success">Guardar datos</button> 
          </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  <!--Producto-->


  <!--Proveedores-->
    <div class="modal fade" id="myProvee" aria-labelledby="myModalLabel">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            <h4 class="modal-title" id="myModalLabel">Editar ingreso</h4>
          </div>
          <div class="modal-body">
              <div class="box-body">

                <div class="form-group col-md-12">
                    <label class="control-label col-md-3">Rut</label>
                    <div class="col-md-5">
                    <input type="text" id="provnew_rut" name="provnew_rut" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                    <div class="col-md-2">
                      <input type="text" id="provnew_dv" name="provnew_dv" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>

                <div class="form-group ">
                  <label for="exampleInputEmail1">Nombre</label>
                  <input type="text" class="form-control pull-right col-md-6" id="exampleInputEmail1" placeholder="Ingrese el nombre">
                </div>
                <br>
                <div class="form-group ">
                  <label for="exampleInputEmail1">Razón social</label>
                  <input type="text" class="form-control pull-right col-md-6" id="exampleInputEmail1" placeholder="Ingrese razón social">
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
  <!--Proveedores-->