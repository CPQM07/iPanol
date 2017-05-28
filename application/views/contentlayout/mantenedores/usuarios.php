<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>
            Mantenedor | Usuarios
          </h3>
        </div>
        <div class="col-sm-6"><br>

          <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#newUsu" >Agregar nueva categoría</button>
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
              <table id="example1" class="datatable table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Rut</th>
                  <th>Nombres<br>Apellidos</th>
                  <th>Carrera</th>
                  <th>Correo</th>
                  <th>Teléfonos</th>
                  <th>Cargo</th>
                  <th>Estado</th>
                  <th>Eliminar</th>
                  <th>Editar</th>
                </tr>
                </thead>
                <tbody>
                     <?php 
                     foreach ($usuario as $key => $value): 
                  switch ($value['USU_ESTADO']) {
                  case 1:
                    $estado="Activo";
                    break;
                  
                  default:
                    $estado="Inactivo";
                    break;
                  }
                ?>
                <tr>
                  <td><?= $value['USU_RUT']; ?>-<?= $value['USU_DV']; ?></td>
                  <td><?= $value['USU_NOMBRES']?><br><?= $value['USU_APELLIDOS']; ?></td>
                  <td><?= $value['USU_CARRERA_ID']->get('CARRERA_NOMBRE') ;  ?> </td>
                  <td><?= $value['USU_EMAIL']; ?> </td>
                  <td><?= $value['USU_TELEFONO1']; ?>/<br><?= $value['USU_TELEFONO2']; ?></td>
                  <td><?= $value['USU_CARGO_ID']->get('CARGO_NOMBRE') ;  ?> </td>
                  <td><?= $estado; ?></td>
                  <td>
                          <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#ELIMINAR<?= $value['USU_RUT']; ?>"><i class="fa fa-remove"></i></button>
                        </td>
                        <td><button id="<?= $value['USU_RUT']; ?>" type="button" class="editar btn btn-success btn-block" data-toggle="modal" data-target="#EDITAR"><i class="fa fa-edit"></i></button>
                        </td>
                      </tr>
                        <!--ModalELIMINAR-->
  <!--ModalELIMINAR-->
    <div class="modal fade" id="ELIMINAR<?= $value['USU_RUT']; ?>" tabindex="-1" role="dialog">
      <div class="modal-danger" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Eliminar un Usuario</h4>
          </div>
          <div class="modal-body">
            <p>Está seguro de eliminar el producto <strong><?= $value['USU_NOMBRES']?></strong></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <a href='<?= site_url("Mantencion/eliminarusuario/".$value['USU_RUT'].""); ?>' class="btn btn-danger">Eliminar</a>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!--ModalELIMINAR-->
  <!--ModalELIMINAR-->
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
 <!--modalCATEGORIANUEVO-->
  <!--modalCATEGORIANUEVO-->
    <div class="modal fade bs-example-modal-lg" id="newUsu" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-tittle">Nuevo Usuario</h4>
            <div class="modal-body">
              <div class="box">
                <div class="row">
                  <form id="form" class="form-horizontal" action="<?=site_url('Mantencion/new_usuario')?>" method="post" accept-charset="utf-8">
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-2 control-label" >Rut</label>
                        <div class="col-md-9">
                        <div class="row">
                        <div class="col-md-6">
                          <!-- <input name="new_usu[USU_RUT]" type="number" class="col-md-12" placeholder="Rut sin punto, ni guion" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "8" pattern=".{0}|.{7,}" min="1000000" required> -->
                          <input type="text" name="new_usu[USU_RUT]" class="col-md-12" placeholder="Rut sin punto, ni guion" pattern="[0-9]{7,8}" maxlength = "8" title="Solo puede ingresar numeros" required>
                          </div>
                          <div class="col-md-2">
                          <input name="new_usu[USU_DV]" pattern="^[9|8|7|6|5|4|3|2|1|k|K]\d{0}$" type="text" class="col-md-12" maxlength="1" required>
                          </div>
                        </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" >Nombres</label>

                        <div class="col-md-9">
                          <input name="new_usu[USU_NOMBRES]" pattern=".{3,}" maxlength = "50" type="text" class="col-md-12" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" >Apellidos</label>

                        <div class="col-md-9">
                          <input name="new_usu[USU_APELLIDOS]" maxlength = "50" type="text" class="col-md-12">
                        </div>
                      </div>
                  
                      <div class="form-group">
                        <label class="col-sm-2 control-label" >Cargo</label>

                        <div class="col-md-9">
                          <select id="new_cargo" name="new_usu[USU_CARGO_ID]" class="form-control select2" style="width: 100%;">
                            <option selected="selected">Seleccione un cargo</option>
                            <?php foreach ($cargo as  $cargos): 
                            if ($cargos->get('CARGO_ESTADO')==1) {
                            ?>
                               <option value="<?=$cargos->get('CARGO_ID')?>" required><?=$cargos->get('CARGO_NOMBRE')?></option>
                            <?php } endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Carrera</label>

                        <div class="col-md-9">
                          <select id="new_carrera" name="new_usu[USU_CARRERA_ID]" class="form-control select2" style="width: 100%;">
                            <option selected="selected">Seleccione una carrera</option>
                            <?php foreach ($carrera as  $carreras): ?>
                               <option value="<?= $carreras->get('CARRERA_ID')?>" required><?=$carreras->get('CARRERA_NOMBRE')?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                               </option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>

                        <div class="col-md-9">
                          <input name="new_usu[USU_EMAIL]" type="email" class="col-md-12" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Teléfono</label>

                        <div class="col-md-9">
                          <input name="new_usu[USU_TELEFONO1]" type="number" class="col-md-12" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Teléfono opcional</label>

                        <div class="col-md-9">
                          <input name="new_usu[USU_TELEFONO2]" type="number" class="col-md-12" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Clave</label>

                        <div class="col-md-9">
                          <input name="new_usu[USU_CLAVE]" type="password" class="col-md-12" required>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <button type="submit" class="btn btn-default col-md-12" data-dismiss="modal">Cancelar</button>
                  </div>
                  <div class="col-sm-6">
                    <input id="agregar" type="submit" class="btn btn-danger col-md-12" value="Agregar">
                  </div>
                </div>
              <!-- /.box-footer -->
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>



  <!--modalCategoría-->
  <!--modalCategoríaNUEVO-->
    <div class="modal fade bs-example-modal-lg" id="EDITAR" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-tittle">Editar Usuario</h4>
            <div class="modal-body">
              <div class="box">
                <div class="row">
                  <form class="form-horizontal" action="<?=site_url('Mantencion/edit_usuario')?>" method="post" accept-charset="utf-8">
                  <input id="rutE" name="rut" style="width: 14px; visibility: hidden;">
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-2 control-label" >Rut</label>
                        <div class="col-md-9">
                        <div class="row">
                          <div class="col-md-6">
                          <input id="rut" type="number" class="col-md-12" placeholder="Rut sin punto, ni guion" disabled>
                          </div>
                          <div class="col-md-2">
                          <input id="dv" name="new_usu[USU_DV]" type="text" class="col-md-12" disabled>
                          </div>
                        </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" >Nombres</label>

                        <div class="col-md-9">
                          <input id="nombre" name="new_usu[USU_NOMBRES]" type="text" class="col-md-12" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" >Apellidos</label>

                        <div class="col-md-9">
                          <input id="apellido" name="new_usu[USU_APELLIDOS]" type="text" class="col-md-12">
                        </div>
                      </div>
                  
                      <div class="form-group">
                        <label class="col-sm-2 control-label" >Cargo</label>

                        <div class="col-md-9">
                          <select id="cargo" name="new_usu[USU_CARGO_ID]" class="form-control select2" style="width: 100%;">
                            <option selected="selected">Seleccione un cargo</option>
                            <?php foreach ($cargo as  $cargos): 
                            if ($cargos->get('CARGO_ESTADO')==1) {
                            ?>
                               <option value="<?=$cargos->get('CARGO_ID')?>" required><?=$cargos->get('CARGO_NOMBRE')?></option>
                            <?php } endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Carrera</label>

                        <div class="col-md-9">
                          <select id="carrera" name="new_usu[USU_CARRERA_ID]" class="form-control select2" style="width: 100%;">
                            <option selected="selected">Seleccione una carrera</option>
                            <?php foreach ($carrera as  $carreras): ?>
                               <option value="<?= $carreras->get('CARRERA_ID')?>" required><?=$carreras->get('CARRERA_NOMBRE')?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                               </option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>

                        <div class="col-md-9">
                          <input id="email" name="new_usu[USU_EMAIL]" type="email" class="col-md-12" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Teléfono</label>

                        <div class="col-md-9">
                          <input id="telefono" name="new_usu[USU_TELEFONO1]" type="number" class="col-md-12" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Teléfono opcional</label>

                        <div class="col-md-9">
                          <input id="telefonoOp" name="new_usu[USU_TELEFONO2]" type="number" class="col-md-12" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Clave</label>

                        <div class="col-md-9">
                          <input id="clave" name="new_usu[USU_CLAVE]" type="password" class="col-md-12" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Estado</label>

                        <div class="col-md-9">
                          <select id="estado" name="new_usu[USU_ESTADO]"  class="form-control select2" style="width: 100%;">
                            <option selected="selected">Seleccione un tipo</option>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <button type="submit" class="btn btn-default col-md-12" data-dismiss="modal">Cancelar</button>
                  </div>
                  <div class="col-sm-6">
                    <input type="submit" class="btn btn-danger col-md-12" value="Agregar">
                  </div>
                </div>
              <!-- /.box-footer -->
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php function MISJAVASCRIPTPERSONALIZADO(){  ?>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {

  $("#agregar").click(function(){
    var carrera=$('#new_carrera').val();
    var cargo=$('#new_cargo').val();
    if(carrera=="Seleccione una carrera")
    {
      alert(carrera);
      $("#form").finish();
    }else if(cargo=="Seleccione un cargo")
    {
      alert(cargo);
      $("#form").finish();
    }else{}
  });

  $(".btn btn-success btn-block").click(function(){
    var data=$(this).attr("id");
    $("#prueba").html("text"); 
    $("#prueba").attr("id",id);
  });

  $(".btn btn-danger").click(function(){
    var data=$(this).attr("id");
    $.ajax({
          type:"GET",
          dataType:"html",
          url:"../Mantencion/delete_usuario/"+data,
          success: function(data){
            alert(data);
           location.reload();
          }
        });
  });

  $('.editar').click(function(){
      limpiar();
      var id=$(this).attr("id");
      $.ajax({
        type:"POST",
        dataType:"json",
        data: {"id": id},
        url:"<?=site_url('/Mantencion/findById_usuario')?>",
        success: function(data){
          $("#rut").val(data.USU_RUT);
          $("#rutE").val(data.USU_RUT);
          $("#dv").val(data.USU_DV);
          $("#nombre").val(data.USU_NOMBRES);
          $("#apellido").val(data.USU_APELLIDOS);
          $("#cargo").val(data.USU_CARGO_ID);
          $("#carrera").val(data.USU_CARRERA_ID);
          $("#email").val(data.USU_EMAIL);
          $("#telefono").val(data.USU_TELEFONO1);
          $("#telefonoOp").val(data.USU_TELEFONO2);
          $("#clave").val(data.USU_CLAVE);
          $("#estado").val(data.USU_ESTADO);
          console.log(data);
        }
      });
    });
});

function limpiar(){
    $("#rut").val("");
    $("#dv").val("");
    $("#nombre").val("");
    $("#apellido").val("");
    $("#cargo").val("");
    $("#carrera").val("");
    $("#email").val("");
    $("#telefono").val("");
    $("#telefonoOp").val("");
    $("#clave").val("");
    $("#estado").val("");

  }
</script>
<?php } ?>