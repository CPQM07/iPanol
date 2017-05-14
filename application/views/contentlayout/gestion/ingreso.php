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
                <!--<div class="col-md-3">
                    <div class="form-group">
                    <label>Tipo de insumo</label>
                      <select class="form-control select2" style="width: 100%;">
                        <option selected="selected">Seleccione</option>
                        <option>Fungible</option>
                        <option>Activo</option>
                      </select>
                    </div>
                  </div>-->
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Producto</label>

                      <div class="input-group">
                        <select class="form-control select2" style="width: 100%;">
                          <option selected="selected">Seleccionar</option>
                          <option>Martillo</option>
                          <option>RJ-45</option>
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
                      <input type="number" class="form-control">
                  </div>
                  <div class="col-md-3">
                      <label>Orden de compra</label>
                      <input type="number" class="form-control">
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Proveedor</label>

                      <div class="input-group">
                        <select class="form-control select2" style="width: 100%;">
                          <option selected="selected">Seleccionar</option>
                          <option>Casa Royal</option>
                          <option>PC Factory</option>
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
                      <input type="textarea" class="form-control">
                  </div>
                  <div class="col-md-6">
                      <label>Vida útil</label>
                      <input type=number" class="form-control">
                  </div>
                  <!--<div class="col-md-3">
                      <label>Stock de advertencia</label>
                      <input type="number" class="form-control">
                  </div>
                  <div class="col-md-3">
                      <label>Stock óptimo</label>
                      <input type="number" class="form-control">
                  </div>-->
                </div>
                <br>
                <div class="col-md-12">
                  <button class="btn btn-block btn-success">Agregar</button>
                </div>
                <!--<div class="row">
                  <div class="col-md-3">
                    <label>Precio unitario</label>
                    <input type="text" class="form-control">
                  </div>
                  <div class="col-md-3">
                    <label>Posicionamiento en el pañol</label>
                    <input type="text" class="form-control">
                  </div>
                  <div class="col-md-3">
                    <label>Prioridad stock critico</label>
                    <input type="number" placeholder="1-10" class="form-control">
                  </div>
                  <div class="col-md-3">
                    <label>Proveedor</label>
                    <input type="text" class="form-control">
                  </div>
                  <div class="col-md-12">
                    <label>Acción</label>
                    <button type="button" class="btn btn-block btn-success">Agregar insumo</button>
                  </div>
                </div>-->
                <hr>
                <div class="row">
                  <div class="col-md-12">
                  <div class="box-header">
                    <h3 class="box-title">Resultados</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Tipo</th>
                        <th>Insumo</th>
                        <th>Categoria</th>
                        <th>Fecha de ingreso</th>
                        <th>Ingresado por</th>
                        <th>Total</th>
                        <th>Editar</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                        <td>Fungible</td>
                        <td>Resistencia 1k Ohm</td>
                        <td>Resistencias</td>
                        <td>09/04/2017</td>
                        <td>Gael Campos</td>
                        <td>100</td>
                        <td>
                          <button type="button" class="btn btn-danger btn-xs btn-block" data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-edit"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>Fungible</td>
                        <td>Resistencia 100 Ohm</td>
                        <td>Resistencias</td>
                        <td>09/04/2017</td>
                        <td>Gael Campos</td>
                        <td>150</td>
                        <td>
                          <button type="button" class="btn btn-danger btn-xs btn-block">
                            <i class="fa fa-edit"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>Activo</td>
                        <td>Martillo</td>
                        <td>Herramientas</td>
                        <td>09/04/2017</td>
                        <td>Gael Campos</td>
                        <td>30</td>
                        <td>
                          <button type="button" class="btn btn-danger btn-xs btn-block">
                            <i class="fa fa-edit"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>Activo</td>
                        <td>Cautin</td>
                        <td>Herramientas</td>
                        <td>06/04/2017</td>
                        <td>Soledad Hormazabal</td>
                        <td>15</td>
                        <td>
                          <button type="button" class="btn btn-danger btn-xs btn-block">
                            <i class="fa fa-edit"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>Activo</td>
                        <td>Estaño</td>
                        <td>Electrónica</td>
                        <td>06/04/2017</td>
                        <td>Soledad Hormazabal</td>
                        <td>10</td>
                        <td>
                          <button type="button" class="btn btn-danger btn-xs btn-block">
                            <i class="fa fa-edit"></i>
                          </button>
                        </td>
                      </tr>
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