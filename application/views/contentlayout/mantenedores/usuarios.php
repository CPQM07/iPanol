
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

          <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#newUsu" >Nuevo Usuario</button>
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
              <div class="table-responsive box-body">
                <table id="example1" class="datatable table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>RUT</th>
                    <th>Nombres<br>Apellidos</th>
                    <th>Carrera</th>
                    <th>Correo</th>
                    <th>Teléfonos</th>
                    <th>Cargo</th>
                    <th>Estado</th>
                    <th>Editar</th>
                  </tr>
                  </thead>
                  <tbody>
                 <?php foreach ($usuario as $key => $value): ?>
                  <tr>
                    <td><?= $value['USU_RUT']; ?>-<?= $value['USU_DV']; ?></td>
                    <td><?= $value['USU_NOMBRES']?><br><?= $value['USU_APELLIDOS']; ?></td>
                    <td><?= $value['USU_CARRERA_ID']->get('CARRERA_NOMBRE') ;  ?> </td>
                    <td><?= $value['USU_EMAIL']; ?> </td>
                    <td><?= $value['USU_TELEFONO1']; ?>/<br><?= $value['USU_TELEFONO2']; ?></td>
                    <td><?= $value['USU_CARGO_ID']->get('CARGO_NOMBRE') ;  ?> </td>
                    <?php if ($value['USU_ESTADO'] == 1): ?>
                    <td><a href="<?= site_url('/Mantencion/CambiarEstadoUSU/0/');?><?=$value['USU_RUT'];?>" class="btn btn-danger btn-block">Deshabilitar</a></td>
                    <?php else: ?>
                    <td><a href="<?= site_url('/Mantencion/CambiarEstadoUSU/1/');?><?=$value['USU_RUT'];?>" class="btn btn-info btn-block">Habilitar</a></td>
                    <?php endif; ?>
                    <td><button id="<?= $value['USU_RUT']; ?>" type="button" class="editar btn btn-success btn-block" data-toggle="modal" data-target="#EDITAR"><i class="fa fa-edit"></i></button></td>
                    </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
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
                  <form name="form1" id="new_form" class="form-horizontal" action="<?=site_url('Mantencion/new_usuario')?>" method="post" accept-charset="utf-8" >
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-2 control-label" >RUT</label>
                        <div class="col-md-9">
                        <div class="row">
                        <div class="col-md-6">
                          <input id="rut" type="text" name="new_usu[USU_RUT]" class="col-md-12 form-control" placeholder="Rut sin punto, ni guion" pattern="[0-9]{7,8}" maxlength = "8" title="Solo puede ingresar numeros" required>
                          </div>
                          <div class="col-md-2">
                          <input id="dv" name="new_usu[USU_DV]" pattern="^[9|8|7|6|5|4|3|2|1|k|K]\d{0}$" type="text" class="col-md-12 form-control" maxlength="1" required>
                          </div>
                        </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" >Nombres</label>

                        <div class="col-md-9">
                          <input name="new_usu[USU_NOMBRES]" pattern=".{3,}" maxlength = "50" type="text" class="col-md-12 form-control" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" >Apellidos</label>

                        <div class="col-md-9">
                          <input name="new_usu[USU_APELLIDOS]" maxlength = "50" type="text" class="col-md-12 form-control">
                        </div>
                      </div>
                  
                      <div class="form-group">
                        <label class="col-sm-2 control-label" >Cargo</label>

                        <div class="col-md-9">
                          <select id="new_cargo" name="new_usu[USU_CARGO_ID]" class="select2" style="width: 100%;" required>
                            <option></option>
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
                          <select id="new_carrera" name="new_usu[USU_CARRERA_ID]" class="select2" style="width: 100%;" required>
                            <option></option>
                            <?php foreach ($carrera as  $carreras): ?>
                               <option value="<?= $carreras->get('CARRERA_ID')?>" required><?=$carreras->get('CARRERA_NOMBRE')?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                               </option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">E-mail</label>

                        <div class="col-md-9">
                          <input name="new_usu[USU_EMAIL]" type="email" class="col-md-12 form-control" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Teléfono</label>

                        <div class="col-md-9">
                          <input name="new_usu[USU_TELEFONO1]" type="number" class="col-md-12 form-control" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Teléfono opcional</label>

                        <div class="col-md-9">
                          <input name="new_usu[USU_TELEFONO2]" type="number" class="col-md-12 form-control" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Clave</label>

                        <div class="col-md-9">
                          <input id="new_clave" name="new_usu[USU_CLAVE]" pattern=".{5,}" title="La contraseña debe constar con un minimo de 5 caracter" type="password" class="col-md-12 form-control" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Vuelve a ingresar tu clave</label>

                        <div class="col-md-9">
                          <input id="new_clave2"  pattern=".{5,}" title="La contraseña debe constar con un minimo de 5 caracter" type="password" class="col-md-12 form-control" required>
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
                  <form id="form" class="form-horizontal" action="<?=site_url('Mantencion/edit_usuario')?>" method="post" accept-charset="utf-8">
                  <input id="rutE" name="rut" style="width: 14px; visibility: hidden;">
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-2 control-label" >RUT</label>
                        <div class="col-md-9">
                        <div class="row">
                          <div class="col-md-6">
                          <input id="rutEdit" type="number" class="col-md-12 form-control" placeholder="Rut sin punto, ni guion" disabled>
                          </div>
                          <div class="col-md-2">
                          <input id="dvEdit" name="new_usu[USU_DV]" type="text" class="col-md-12 form-control" disabled>
                          </div>
                        </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" >Nombres</label>

                        <div class="col-md-9">
                          <input id="nombre" name="new_usu[USU_NOMBRES]" type="text" class="col-md-12 form-control" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" >Apellidos</label>

                        <div class="col-md-9">
                          <input id="apellido" name="new_usu[USU_APELLIDOS]" type="text" class="col-md-12 form-control">
                        </div>
                      </div>
                  
                      <div class="form-group">
                        <label class="col-sm-2 control-label" >Cargo</label>

                        <div class="col-md-9">
                          <select id="cargo" name="new_usu[USU_CARGO_ID]" class="select2" style="width: 100%;">
                            <option></option>
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
                          <select id="carrera" name="new_usu[USU_CARRERA_ID]" class="select2" style="width: 100%;">
                            <option></option>
                            <?php foreach ($carrera as  $carreras): ?>
                               <option value="<?= $carreras->get('CARRERA_ID')?>" required><?=$carreras->get('CARRERA_NOMBRE')?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                               </option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">E-mail</label>

                        <div class="col-md-9">
                          <input id="email" name="new_usu[USU_EMAIL]" type="email" class="col-md-12 form-control" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Teléfono</label>

                        <div class="col-md-9">
                          <input id="telefono" name="new_usu[USU_TELEFONO1]" type="number" class="col-md-12 form-control" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Teléfono opcional</label>

                        <div class="col-md-9">
                          <input id="telefonoOp" name="new_usu[USU_TELEFONO2]" type="number" class="col-md-12 form-control" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Clave</label>

                        <div class="col-md-9">
                          <input id="clave"  pattern=".{5,}" title="La contraseña debe constar con un minimo de 5 caracter"  name="new_usu[USU_CLAVE]" type="password" class="col-md-12 form-control" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Vuelve a ingresar tu clave</label>

                        <div class="col-md-9">
                          <input id="clave2"  pattern=".{5,}" title="La contraseña debe constar con un minimo de 5 caracter" type="password" class="col-md-12 form-control" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Estado</label>

                        <div class="col-md-9">
                          <select id="estado" name="new_usu[USU_ESTADO]"  class="select2" style="width: 100%;">
                            <option></option>
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
                    <input id="editar" type="submit" class="btn btn-danger col-md-12" value="Agregar">
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
  // Validador de Rut
var Fn = {
    // Valida el rut con su cadena completa "XXXXXXXX-X"
    validaRut : function (rutCompleto) {
        rutCompleto = rutCompleto.replace("‐","-");
        if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rutCompleto ))
            return false;
        var tmp     = rutCompleto.split('-');
        var digv    = tmp[1]; 
        var rut     = tmp[0];
        if ( digv == 'K' ) digv = 'k' ;
        
        return (Fn.dv(rut) == digv );
    },
    dv : function(T){
        var M=0,S=1;
        for(;T;T=Math.floor(T/10))
            S=(S+T%10*(9-M++%6))%11;
        return S?S-1:'k';
    }
}
  $("#agregar").click(function(){
    var rut=$('#rut').val();
    var dv=$('#dv').val();
    var rutOficial = rut+"-"+dv;
    var clave1=$('#new_clave').val();
    var clave2=$('#new_clave2').val();
    if (Fn.validaRut( rutOficial )){
      if (clave1==clave2) {
        return true;
      }else{ 
        $.notify("Las dos claves son distintas, por favor vuelva a introducir la contraseña", "error");
        return false;

      }
   } else {
        $.notify("RUT no valido", "error");
        return false;
    }
  });
  $("#editar").click(function(){
    var clave1=$('#clave').val();
    var clave2=$('#clave2').val();
     if (clave1==clave2) {
      return true;
    }else{ 
        $.notify("Las dos claves son distintas, por favor vuelva a introducir la contraseña", "error");
      return false;
    }
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
          $("#rutE").val(data.USU_RUT);
          $("#rutEdit").val(data.USU_RUT);
          $("#dvEdit").val(data.USU_DV);
          $("#nombre").val(data.USU_NOMBRES);
          $("#apellido").val(data.USU_APELLIDOS);
          $("#cargo").val(data.USU_CARGO_ID).trigger('change');
          $("#carrera").val(data.USU_CARRERA_ID).trigger('change');
          $("#email").val(data.USU_EMAIL);
          $("#telefono").val(data.USU_TELEFONO1);
          $("#telefonoOp").val(data.USU_TELEFONO2);
          $("#clave").val(data.USU_CLAVE);
          $("#clave2").val(data.USU_CLAVE);
          $("#estado").val(data.USU_ESTADO).trigger('change');
          console.log(data);
        }
      });
    });
});

function limpiar(){
    $("#rutEdit").val("");
    $("#dvEdit").val("");
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
  //

$("#btnvalida").click(function(){
    if (Fn.validaRut( $("#txt_rut").val() )){
        $("#msgerror").html("El RUT ingresado es válido.");
    } else {
        $("#msgerror").html("El RUT ingresado no es válido.");
    }
});

</script>
<?php } ?>