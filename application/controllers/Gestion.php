<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gestion extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->layouthelper->SetMaster('layout');
    $this->load->model('Usuario_Model','usu',true);
    $this->load->model('Asignatura_Model','asig',true);
    $this->load->model('Producto_Model','prod',true);
    $this->load->model('Proveedor_Model','prov',true);
    $this->load->model('Categoria_Model','cat',true);
    $this->load->model('Ingreso_Model','ing',true);
    $this->load->model('Inventario_Model','inv',true);
    $this->load->model('Solicitud_Model','soli',true);
    $this->load->model('DetSolicitud_Model','detsol',true);
    $this->load->model('Asignacion_Model','asignacion',true);
    $this->load->model('Baja_Model','baja',true);
    $this->load->model('Motivo_Model','mot',true);
    $this->load->model('Observaciones_Model','obs',true);
    $this->load->model('Baja_Model','baja',true);
    /*nuevo*/
    $this->load->model('TipoProd_Model','tipoP',true);
    /*nuevo*/

  }

  public function index()
  {   
    $this->layouthelper->LoadView("pruebas/indexcontent" , null);
  }

  public function indexcontentdos()
  {   
    $this->layouthelper->LoadView("pruebas/contentdos" , null );
  }

  public function entregamanual()
  {
     $data['categorias'] = $this->cat->findAll();
     $data['asignaturas'] = $this->asig->findAll();
     $this->layouthelper->LoadView("gestion/entregamanual" , $data);

  }

  public function entregadigital()
  {
     $data["solicitudes"] = $this->soli->findByArrayIN(array(7,1));//busco las solicitudes enviadas por el catalogo y las parcialmente entregadas 1 y 7
     $this->layouthelper->LoadView("gestion/entregadigital" , $data );
  }

  public function get_detalle_solicitud(){
    $tododetjson = array();
    $idsol= $_POST['idsolicitud'];
    $detalle = $this->detsol->findByArray(array("DETSOL_SOL_ID" => $idsol ,"DETSOL_ESTADO" => 1));
    foreach ($detalle as $key => $value) {
      $producto = $this->prod->findById($value->get("DETSOL_PROD_ID"));
       $tododetjson[]  =  json_encode(array(
                  'ID' => $value->get("DETSOL_ID"),
                  'TIPOPROD' => $value->get("DETSOL_TIPOPROD"),
                  'CANTIDAD' => $value->get("DETSOL_CANTIDAD"),
                  'ESTADO' => $value->get("DETSOL_ESTADO"),
                  'SOL_ID' => $value->get("DETSOL_SOL_ID"),
                  'PROD_ID' => $value->get("DETSOL_PROD_ID"),
                  'PROD_NOMBRE' => $producto->get("PROD_NOMBRE")
                  ));
    }
    $this->output->set_content_type('application/json');
    $this->output->set_output(json_encode($tododetjson));
  }

  public function baja()
  {
     $allbajas = $this->baja->findAll();
     $arraytodasbajas = array();
     foreach ($allbajas as $key => $value) {
          $arraytodasbajas[] = Array( "BAJA_ID" => $value->get("BAJA_ID"),
                                      "BAJA_MOTIVO_ID" => $value->get("BAJA_MOTIVO_ID"),
                                      "BAJA_DESC" => $value->get("BAJA_DESC"),
                                      "BAJA_INV_ID" => $value->get("BAJA_INV_ID"),
                                      "BAJA_FECHA" => $value->get("BAJA_FECHA"),
                                      "BAJA_USU_RUT" => $value->get("BAJA_USU_RUT"),
                                      "MOT_ID" => $value->get("MOT_ID"),
                                      "MOT_NOMBRE" => $value->get("MOT_NOMBRE"),
                                      "INV_ID" => $value->get("INV_ID"),
                                      "INV_PROD_ID" => $value->get("INV_PROD_ID"),
                                      "INV_PROD_NOM" => $value->get("INV_PROD_NOM"),
                                      "INV_PROD_CANTIDAD" => $value->get("INV_PROD_CANTIDAD"),
                                      "INV_PROD_ESTADO" => $value->get("INV_PROD_ESTADO"),
                                      "INV_PROD_CODIGO" => $value->get("INV_PROD_CODIGO"),
                                      "INV_INGRESO_ID" => $value->get("INV_INGRESO_ID"),
                                      "INV_FECHA" => $value->get("INV_FECHA"),
                                      "INV_IMAGEN" => $value->get("INV_IMAGEN"),
                                      "INV_TIPO_ID" => $value->get("INV_TIPO_ID"),
                                      "INV_CATEGORIA_ID" => $value->get("INV_CATEGORIA_ID"),
                                      "INV_ULTIMO_USUARIO" => $value->get("INV_ULTIMO_USUARIO"),
                                      "INV_ACTUAL_USUARIO" => $value->get("INV_ACTUAL_USUARIO"),
                                      "USU_RUT" => $value->get("USU_RUT"),
                                      "USU_DV" => $value->get("USU_DV"),
                                      "USU_NOMBRES" => $value->get("USU_NOMBRES"),
                                      "USU_APELLIDOS" => $value->get("USU_APELLIDOS"),
                      "BAJA_MOTIVO_RESULTADO" => $this->obs->findByArray(array("OBS_BAJA_ID" => $value->get("BAJA_ID")))
                                    );
     }   

     $data["motivos"] = $this->mot->findByArray();//array('MOT_DIF' => 1)
     $data["bajas"] = $arraytodasbajas;
     $data['categorias'] = $this->cat->findByArray(array('CAT_ESTADO' => 1));
     $this->layouthelper->LoadView("gestion/baja" , $data);
  }

  public function get_iventario_by_cat_ajax(){
    $nomsearch = $_POST['search'];
    $todoivbycat = $this->inv->findByArrayLike($nomsearch,'INV_PROD_NOM','INV_ID');
    $arrayinv = array();
    foreach ($todoivbycat as $key => $value) {
      if ($value->get('INV_TIPO_ID') == 1 and $value->get('INV_PROD_ESTADO') == 1) {
      $arrayinv[] = array("id" =>$value->get('INV_ID'),
                        "text" =>$value->get('INV_ID')."-".$value->get('INV_PROD_NOM')
                        );
      }
    }
    $this->output->set_content_type('application/json');
    $this->output->set_output(json_encode($arrayinv));
  }



  public function dar_de_baja(){
    $usersesion = $this->session->userdata('logged_in');
    $ultimoid = 0;
    if (isset($_POST['forminventario']) and $_POST['forminventario'] != "0" and $_POST['formmotivoorigen'] != "0" and isset($_POST['formmotivoorigen']) and $_POST['formdescripcion']) {

       $_columns  =  array(
                'BAJA_ID' => 0,
                'BAJA_MOTIVO_ID' => $_POST['formmotivoorigen'],
                'BAJA_DESC' => $_POST['formdescripcion'],
                'BAJA_INV_ID' => $_POST['forminventario'],
                'BAJA_FECHA' => date("Y-m-d H:i:s"),
                'BAJA_USU_RUT' => $usersesion['rut']
                );

        $this->baja->setColumns($_columns);
        $ultimoid = $this->baja->insert();
        if ($ultimoid > 0) {
          switch (intval($_POST['formmotivoorigen'])) {
            case 15:
                  $this->inv->update($_POST['forminventario'], array('INV_PROD_ESTADO' => 2));
              break;
            default:
                  $this->inv->update($_POST['forminventario'], array('INV_PROD_ESTADO' => 0));
              break;
          }
        }


        $this->session->set_flashdata('Habilitar', 'Se ingreso correctamente el activo a dar de baja');
       redirect('/Gestion/baja');
    }else{
        $this->session->set_flashdata('Deshabilitar', 'Lo sentimos algunos de los campos no estan definidos, favor revisar');
        redirect('/Gestion/baja');
    }
    
  }

  public function get_obs_by_baja_id(){
    $idbaja = $_POST['bajaid'];
    $allobs = array();
    $observaciones = $this->obs->findByArray(array('OBS_BAJA_ID' => $idbaja));

    $baja = $this->baja->findById($idbaja);

    //necesito obtener el id del inventario que se esta dando de baja

    if ($observaciones != null) {
      foreach ($observaciones as $key => $value) {
      $allobs[]  =  array(
                        'ID' => $value['OBS_ID'],
                        'TEXTO' => $value['OBS_TEXTO'],
                        'BAJA_ID' => $value['OBS_BAJA_ID'],
                        'MOT_NOMBRE' => $value['OBS_MOT_NOMBRE'],
                        'FECHA' => $value['OBS_FECHA']                        
                        );
      }
    }
    
    $this->output->set_content_type('application/json');
    $this->output->set_output(json_encode(array('INV_ID' => $baja->get("BAJA_INV_ID"), 'allobs' => json_encode($allobs))));
  }

  public function insert_obs_to_baja(){
    //{"bajaid": bajaidhidden,"texto": texto,"motivores": motivores},
    if (isset($_POST["bajaid"]) and isset($_POST["texto"]) and isset($_POST["motivores"]) ) {
      $bajaid = $_POST["bajaid"];
      $texto = $_POST["texto"];
      $motivores = $_POST["motivores"];
      $inventarioabajar = $_POST["inventarioabajar"];
         $motivo = $this->mot->findById($motivores);
          $columns  =  array(
                'OBS_ID' => 0,
                'OBS_TEXTO' => $texto,
                'OBS_BAJA_ID' => $bajaid,
                'OBS_FECHA' => date("Y-m-d H:i:s"),
                'OBS_MOT_ID' => $motivo->get("MOT_ID"),
                'OBS_MOT_NOMBRE' => $motivo->get("MOT_NOMBRE")
                );
          $this->obs->setColumns($columns);
          $ultimoobs = $this->obs->insert();
          if ($ultimoobs > 0) {
            switch (intval($motivo->get("MOT_ID"))) {
              case 16:
                $this->inv->update($inventarioabajar,array('INV_PROD_ESTADO'  => 1));
                break;
              case 17:
                $this->inv->update($inventarioabajar,array('INV_PROD_ESTADO'  => 0));
                break;
              case 18:
                $this->inv->update($inventarioabajar,array('INV_PROD_ESTADO'  => 2));
                break;
              case 19:
                $this->inv->update($inventarioabajar,array('INV_PROD_ESTADO'  => 0));
                break;
              case 20:
                $this->inv->update($inventarioabajar,array('INV_PROD_ESTADO'  => 2));
                break;
              case 21:
                $this->inv->update($inventarioabajar,array('INV_PROD_ESTADO'  => 2));
                break;
              case 23:
                $this->inv->update($inventarioabajar,array('INV_PROD_ESTADO'  => 0));
                break;
              case 24:
                $this->inv->update($inventarioabajar,array('INV_PROD_ESTADO'  => 2));
                break;
              case 25:
                $this->inv->update($inventarioabajar,array('INV_PROD_ESTADO'  => 2));
                break;
              default:
                $this->inv->update($inventarioabajar,array('INV_PROD_ESTADO'  => 0));
                break;
            }
            $this->session->set_flashdata('Habilitar', 'Se ingreso correctamente el motivo resultado');
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode(array("estado" => true ,"mensaje" => "Se ha insertado correctamente")));
          }else{
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode(array("estado" => false ,"mensaje" => "Ocurrio un error al insertar esta observación")));
          }
      
    }else{
      $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode(array("estado" => true ,"mensaje" => "Alguno de los formularios no esta definido, favor revisar")));
    }

  }

  public function ingreso()
  {
     $data['proveedores'] = $this->prov->findAll();
     $data['productos'] = $this->prod->findAll();
     $data['ingresos'] = $this->ing->findAll();
     $this->layouthelper->LoadView("gestion/ingreso" , $data);
  }

  public function ingresar_producto_stock(){
    $usersesion = $this->session->userdata('logged_in');
    $producto = $this->prod->findById($_POST['producto']);

    $columns =array(
              'ING_PROD_ID' =>$_POST['producto'],
              'ING_CANTIDAD' =>$_POST['cantidad'],
              'ING_ORDEN_COMPRA'  =>$_POST['ordencompra'],
              'ING_DESC' =>$_POST['descripcion'],
              'ING_USU_RUT' =>$usersesion['rut'],
              'ING_VIDA_ULTIL_PROVEEDOR' =>$_POST['vidautil'],
              'ING_PROV_RUT' =>$_POST['proveedor']
              );
    $ultimoingreso = $this->ing->insert($columns);

    if ($producto->get("PROD_TIPOPROD_ID") == 1) {
      for ($i=0; $i < $_POST['cantidad']; $i++) { 
        $_columns  =  array(
                      'INV_ID' => 0,
                      'INV_PROD_ID' => $producto->get("PROD_TIPOPROD_ID"),
                      'INV_PROD_NOM' => $producto->get("PROD_NOMBRE"),
                      'INV_PROD_CANTIDAD' => 1,
                      'INV_PROD_ESTADO' => 1,
                      'INV_INGRESO_ID' => $ultimoingreso,
                      'INV_CATEGORIA_ID' => $producto->get("PROD_CAT_ID"),
                      'INV_TIPO_ID' => 1
                      );
        $this->inv->insertDirect($_columns);
      }
    }else if($producto->get("PROD_TIPOPROD_ID") == 2){
      $insumo = $this->inv->findByArrayOne(array('INV_PROD_ID' => $producto->get("PROD_ID")));
      if ($insumo != null) {
        $total = intval($insumo->get('INV_PROD_CANTIDAD'))+intval($_POST['cantidad']);
        $this->inv->update($insumo->get("INV_ID"), array('INV_PROD_CANTIDAD' => $total));
      }else{
         $_columns  =  array(
                      'INV_ID' => 0,
                      'INV_PROD_ID' => $producto->get("PROD_TIPOPROD_ID"),
                      'INV_PROD_NOM' => $producto->get("PROD_NOMBRE"),
                      'INV_PROD_CANTIDAD' => $_POST['cantidad'],
                      'INV_PROD_ESTADO' => 1,
                      'INV_INGRESO_ID' => $ultimoingreso,
                      'INV_CATEGORIA_ID' => $producto->get("PROD_CAT_ID"),
                      'INV_TIPO_ID' => 2
                      );
        $this->inv->insertDirect($_columns);
      }      
    }


  redirect('Gestion/ingreso','refresh');
  }

  public function recepcion()
  {
     //$data["solicitudes"] = $this->soli->findByArrayIN(array(3,5));
     $this->layouthelper->LoadView("gestion/recepcion",null);
  }

   public function recepcion_ajax()
  {
     $newarray = array();
     $solicitudes = $this->soli->findByArrayIN(array(3,5));
     foreach ($solicitudes as $key => $value) {
      $newarray[] = array(
              $value->get('SOL_ID'),
              $value->get('SOL_USU_RUT'),
              $value->get('SOL_FECHA_INICIO'),
              $value->get('SOL_FECHA_TERMINO'),
              "<a target='_blank' href='".base_url()."resources/pdf/".$value->get('SOL_RUTA_PDF')."' class='fa fa-file-pdf-o'></a>",
              "<button idsol='".$value->get('SOL_ID')."' class='getasignaciones btn btn-block btn-success' data-toggle='modal' data-target='#recproins' >Gestionar recepcion P/I</button>"

              );
       
     }

     $this->output->set_content_type('application/json');
     $this->output->set_output(json_encode($newarray));
     //$this->layouthelper->LoadView("gestion/recepcion",$data);
  }

  public function get_all_asignaciones_by_sol(){
      $idsolicitud = $_POST['idsolicitud'];
      $asignaciones = $this->asignacion->findByArray(array('ASIG_SOL_ID' => $idsolicitud));

      if ($asignaciones != null) {
        $newarrayasign= array();
          foreach ($asignaciones as $key => $value) {
            $newarrayasign[] = array(
                      "ASIG_ID" => $value['ASIG_ID'],
                      "ASIG_ESTADO" => $value['ASIG_ESTADO'],
                      "ASIG_SOL_ID" => $value['ASIG_SOL_ID'],
                      "ASIG_INV_ID" => $value['ASIG_INV_ID'],
                      "ASIG_FECHA" => $value['ASIG_FECHA'],
                      "ASIG_CANT" => $value['ASIG_CANT'],
                      "ASIG_CANT_DEVUELTA" => $value['ASIG_CANT_DEVUELTA'],
                      "INV_ID" => $value['INV_ID'],
                      "INV_PROD_ID" => $value['INV_PROD_ID'],
                      "INV_PROD_NOM" => $value['INV_PROD_NOM'],
                      "INV_PROD_CANTIDAD" => $value['INV_PROD_CANTIDAD'],
                      "INV_PROD_ESTADO" => $value['INV_PROD_ESTADO'],
                      "INV_PROD_CODIGO" => $value['INV_PROD_CODIGO'],
                      "INV_INGRESO_ID" => $value['INV_INGRESO_ID'],
                      "INV_FECHA" => $value['INV_FECHA'],
                      "INV_IMAGEN" => $value['INV_IMAGEN'],
                      "INV_TIPO_ID" => $value['INV_TIPO_ID'],
                      "INV_CATEGORIA_ID" => $value['INV_CATEGORIA_ID'],
                      "INV_ULTIMO_USUARIO" => $value['INV_ULTIMO_USUARIO'],
                      "INV_ACTUAL_USUARIO" => $value['INV_ACTUAL_USUARIO'],

              );
          }
          $this->output->set_content_type('application/json');
          $this->output->set_output(json_encode(array("estado" => true ,"mensaje" => "Se ha cargado exitosamente la asignacion de esa solicitud", "allasig" => json_encode($newarrayasign))));
      }else{
        $this->output->set_content_type('application/json');
          $this->output->set_output(json_encode(array("estado" => false ,"mensaje" => "Lo sentimos esta solicitud no posee asignaciones de productos o insumos")));
      }

  }

  public function update_asignaciones_recepcionadas(){ 
    $cerrarono = $_POST['resultadocerrarono'];
    $solicitudid = $_POST['idsol'];

    if (isset($_POST['idcheckeados'])) {
      $idcheckeados = $_POST['idcheckeados'];
      foreach ($idcheckeados as $key => $value) {
       $this->asignacion->update($value,array('ASIG_ESTADO' => 2));
       $asignacionobj = $this->asignacion->findById($value);
       $this->inv->update($asignacionobj->get('ASIG_INV_ID'),array('INV_PROD_ESTADO'  => 1));
        }
    }

    if (isset($_POST['checkeadostipo2'])) {
      $checkmascantidadfungibles = $_POST['checkeadostipo2'];
      foreach ($checkmascantidadfungibles as $key => $value) {
        $this->asignacion->update($value['idasignacion'],array('ASIG_ESTADO' => 2,"ASIG_CANT_DEVUELTA" => $value['cantidad']));
        $asignacionobj = $this->asignacion->findById($value['idasignacion']);
        $inventarioobj = $this->inv->findById($asignacionobj->get('ASIG_INV_ID'));

        $ultimacantidad = $inventarioobj->get('INV_PROD_CANTIDAD');//ultima cantidad en el inventario hay que sumarle los los devolvidos
        $ultimacantidad = intval($ultimacantidad)+intval($value['cantidad']);

        $this->inv->update($asignacionobj->get('ASIG_INV_ID'),array('INV_PROD_CANTIDAD'  => $ultimacantidad));

        //$asignacionobj = $this->asignacion->findById($value['idasignacion']);
       //$this->inv->update($asignacionobj->get('ASIG_INV_ID'),array('INV_PROD_ESTADO'  => 1));
      }
    }

    if (!empty($_POST['nocheckeados']) && is_array($_POST['nocheckeados'])) {
       $nocheckeados = $_POST['nocheckeados'];
       foreach ($nocheckeados as $key => $value) {
       $this->asignacion->update($value,array('ASIG_ESTADO' => 3));
       $asignacionobj = $this->asignacion->findById($value);
       $inventarioobj = $this->inv->findById($asignacionobj->get('ASIG_INV_ID'));
       if ($inventarioobj->get("INV_TIPO_ID") == 1) {
         $this->inv->update($asignacionobj->get('ASIG_INV_ID'),array('INV_PROD_ESTADO'  => 3));
       }else if($inventarioobj->get("INV_TIPO_ID") == 2){
           $actualcantidadasig = $asignacionobj->get('ASIG_CANT_DEVUELTA');
           $actualcantidadinv = $inventarioobj->get('INV_PROD_CANTIDAD');
           $ultimoresul = intval($actualcantidadinv)-intval($actualcantidadasig);


          $this->asignacion->update($value,array('ASIG_ESTADO' => 3,"ASIG_CANT_DEVUELTA" => 0));
         $this->inv->update($asignacionobj->get('ASIG_INV_ID'),array('INV_PROD_ESTADO'  => 1,'INV_PROD_CANTIDAD'  => $ultimoresul ));

       }
       $this->soli->update($solicitudid,array('SOL_ESTADO' => 3));
      }
    }else{
      $this->soli->update($solicitudid,array('SOL_ESTADO' => 4));
    }

     $this->output->set_content_type('application/json');
     $this->output->set_output(json_encode(array("estado" => true ,"mensaje" =>"Se a guardado correctamente la recepcion de productos para esta solicitud")));
  }

    public function get_user_by_cargo_ajax(){
      $alluser = array();
      $idcargo = $_POST['idcargo'];
      $usuarios = $this->usu->findByArray(array("USU_CARGO_ID" => $idcargo));
      foreach ($usuarios as $key => $value) {
        $alluser[] = json_encode(array('RUT' => $value->get("USU_RUT"),
                          'DV' => $value->get("USU_DV"),
                          'NOMBRES' => $value->get("USU_NOMBRES"),
                          'APELLIDOS' => $value->get("USU_APELLIDOS"),
                          'CARGO_ID' => $value->get("USU_CARGO_ID"),
                          'CARRERA_ID' => $value->get("USU_CARRERA_ID"),
                          'EMAIL' => $value->get("USU_EMAIL"),
                          'TELEFONO1' => $value->get("USU_TELEFONO1"),
                          'TELEFONO2' => $value->get("USU_TELEFONO2"),
                          'CLAVE' => $value->get("USU_CLAVE"),
                          'ESTADO' => $value->get("USU_ESTADO")));
      }
      $this->output->set_content_type('application/json');
      $this->output->set_output(json_encode($alluser));
    }

    public function get_inv_by_cat_tipo_ajax(){
    $allinv = array();
    $idtipo = $_POST['idtipo'];
    $idcat = $_POST['idcat'];
    $inventario = $this->inv->findByArray(array('INV_CATEGORIA_ID' => $idcat,'INV_TIPO_ID' => $idtipo,'INV_PROD_ESTADO' =>1 ));
    foreach ($inventario as $key => $value) {
      if ($value->get('INV_TIPO_ID') == 1) {
         $allinv[] = array($value->get('INV_ID'),
                        $value->get('INV_PROD_CANTIDAD'),
                        $value->get('INV_PROD_NOM'),
                        $value->get('INV_PROD_CANTIDAD'),
                        "<button type='button' tipo=".$value->get('INV_TIPO_ID')." cant=".$value->get('INV_PROD_CANTIDAD')." id=".$value->get('INV_ID')." nom=".$value->get('INV_PROD_NOM')." class='ADDinv btn btn-block btn-success btn-flat fa fa-plus'></button>");
      }else if($value->get('INV_TIPO_ID') == 2){
           $allinv[] = array($value->get('INV_ID'),
                        $value->get('INV_PROD_CANTIDAD'),
                        $value->get('INV_PROD_NOM'),
                        "<input type='number' min='1' max=".$value->get('INV_PROD_CANTIDAD')." id='INPUT".$value->get('INV_ID')."' class='form-control' >",
                        "<button type='button' tipo='".$value->get('INV_TIPO_ID')."' cant=".$value->get('INV_PROD_CANTIDAD')." id=".$value->get('INV_ID')." nom=".$value->get('INV_PROD_NOM')." class='ADDinv btn btn-block btn-success btn-flat fa fa-plus'></button>");
      }
    }
    $this->output->set_content_type('application/json');
    $this->output->set_output(json_encode($allinv));
  }

  public function get_inv_by_productos_id(){
    $allinv = array();
    $todoslosiddeproductos = $_POST['productosid'];
    $inventario = $this->inv->findByArrayIN($todoslosiddeproductos,array('INV_PROD_ESTADO' =>1));

    foreach ($inventario as $key => $value) {
      if ($value->get('INV_TIPO_ID') == 1) {
         $allinv[] = array($value->get('INV_ID'),
                        $value->get('INV_PROD_CANTIDAD'),
                        $value->get('INV_PROD_NOM'),
                        $value->get('INV_PROD_CANTIDAD'),
                        "<button type='button' prodid=".$value->get('INV_PROD_ID')." tipo=".$value->get('INV_TIPO_ID')." cant=".$value->get('INV_PROD_CANTIDAD')." id=".$value->get('INV_ID')." nom=".$value->get('INV_PROD_NOM')." class='ADDinv btn btn-block btn-success btn-flat fa fa-plus'></button>");
      }else if($value->get('INV_TIPO_ID') == 2){
           $allinv[] = array($value->get('INV_ID'),
                        $value->get('INV_PROD_CANTIDAD'),
                        $value->get('INV_PROD_NOM'),
                        "<input type='number' min='1' max=".$value->get('INV_PROD_CANTIDAD')." id='INPUT".$value->get('INV_ID')."' class='form-control' >",
                        "<button type='button' prodid=".$value->get('INV_PROD_ID')." tipo='".$value->get('INV_TIPO_ID')."' cant=".$value->get('INV_PROD_CANTIDAD')." id=".$value->get('INV_ID')." nom=".$value->get('INV_PROD_NOM')." class='ADDinv btn btn-block btn-success btn-flat fa fa-plus'></button>");
      }
    }
    $this->output->set_content_type('application/json');
    $this->output->set_output(json_encode($allinv));
  }


  public function insert_entrega_manual(){
    $usersesion = $this->session->userdata('logged_in');
    $asignaciones = $_POST["asignaciones"];
    if ($asignaciones != null) {
    $rutusu = $_POST["rutusu"];$asignatura = $_POST["asignatura"];$grupotrabajo = $_POST["grupotrabajo"];
    $rangofechas = $_POST["rangofechas"]; $observaciones = $_POST["observaciones"];$dividirfechas = explode("-",$rangofechas);
    $dateinicio = DateTime::createFromFormat("d/m/Y H:i:s",trim($dividirfechas[0]));
    $fechainicio = $dateinicio->format('Y-m-d H:m:s');   
    $datetermino= DateTime::createFromFormat("d/m/Y H:i:s",trim($dividirfechas[1]));
    $fechatermino = $datetermino->format("Y-m-d H:m:s");
     $columnassolicitud  =  array(
                    'SOL_ID' => 0,
                    'SOL_USU_RUT' => $rutusu,
                    'SOL_ASIG_ID' => $asignatura,
                    'SOL_FECHA_INICIO' => $fechainicio,
                    'SOL_FECHA_TERMINO' => $fechatermino,
                    'SOL_NRO_GRUPOTRAB' => $grupotrabajo,
                    'SOL_OBSERVACION' => $observaciones,
                    'SOL_ESTADO' => 5
                    );
     $nuevasolicitud =  $this->soli->create($columnassolicitud);
     $ultimasolicitud = $nuevasolicitud->insert();

     $this->soli->insertlog(array("LOGESTSOL_ESTADO"=>5,"LOGESTSOL_USU_RUT"=>$usersesion['rut'],"LOGESTSOL_SOL_ID"=>$ultimasolicitud));


     //SE INSERTA UN DETALLE SOLO PARA INDICAR QUE ESA SOLICITUD FUE MANUAL, Y SOLO SE ASIGNARON INSUMO Y PRODUCTOS DIRECTAMENTE.
     //PUEDE QUE ESTE DEMAS ESTAS LINEAS DE CODIGO PERO LO VEREMOS MAS ADELANTE.
     $columnadetsol  =  array(
                    'DETSOL_ID' => 0,
                    'DETSOL_TIPOPROD' => NULL,
                    'DETSOL_CANTIDAD' => 0,
                    'DETSOL_ESTADO' => 5,
                    'DETSOL_SOL_ID' => $ultimasolicitud,
                    'DETSOL_PROD_ID' => NULL,
                    ); 
     $nuevodetalle =  $this->detsol->create($columnadetsol);
     $ultimodetalle = $nuevodetalle->insert();
     //HASTA AQUI NOSE AUN SI VOY A DEJAR ESTAS LINEAS DE CODIGO

      foreach ($asignaciones as $key => $value) {
        $columnasignacion  =  array(
                    'ASIG_ID' => 0,
                    'ASIG_ESTADO' => 1,
                    'ASIG_SOL_ID' => $ultimasolicitud,
                    'ASIG_INV_ID' => $value["idinv"],
                    'ASIG_FECHA' => date("Y-m-d H:i:s"),
                    'ASIG_CANT' => $value["cantidadinv"]
                    );
        $nuevaasignacion =  $this->asignacion->create($columnasignacion);
        $ultimaasignacion = $nuevaasignacion->insert();
        $this->asignacion->insertlog(array("LOGESTASIG_ASIG_ID" =>$ultimaasignacion,"LOGESTASIG_USU_RUT"=>$usersesion['rut'],"LOGESTASIG_ESTADO"=>1));
        if ($ultimaasignacion > 0) {
          $inventario = $this->inv->findById($value["idinv"]);
          if ($inventario->get("INV_TIPO_ID") == 1) {
             $columnasaeditar  =  array(
                      'INV_PROD_ESTADO' => 3,
                      'INV_ULTIMO_USUARIO' => $inventario->get("INV_ACTUAL_USUARIO"),
                      'INV_ACTUAL_USUARIO'=> $rutusu
                      );
             $inventario->update($value["idinv"],$columnasaeditar);
          }else if($inventario->get("INV_TIPO_ID") == 2){
              $columnasaeditar  =  array(
                      'INV_PROD_CANTIDAD' => intval($inventario->get("INV_PROD_CANTIDAD"))-intval($value["cantidadinv"]),
                      'INV_ULTIMO_USUARIO' => $inventario->get("INV_ACTUAL_USUARIO"),
                      'INV_ACTUAL_USUARIO'=> $rutusu
                      );         
             $inventario->update($value["idinv"],$columnasaeditar);
          }
        }
      }
      $cargo = "";$asignaturanombre = "";$usuario = $this->usu->findById($rutusu);
      $verificardocenteoalumno = $usuario->get("USU_CARGO_ID");
      if ($verificardocenteoalumno == 1)$cargo = "ESTUDIANTE";
      if($verificardocenteoalumno == 2)$cargo = "DOCENTE";
      $asignaturaobj = $this->asig->findById($asignatura);
      $asignaturanombre = $asignaturaobj->get("ASIGNATURA_NOMBRE");
      $nombreapellidossolicitante = $usuario->get("USU_NOMBRES").' '.$usuario->get("USU_APELLIDOS");

      
      $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
      $pdf->SetFont('dejavusans', '', 7, '', true);
      $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                   Solicitud de prestamos N°'.$ultimasolicitud, "");
      $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
      $pdf->AddPage();

      $asignacionesactuales = $this->asignacion->findByArray(array('ASIG_SOL_ID' => $ultimasolicitud));
     // print_r($asignacionesactuales);

      $htmlpdf = $pdf->HTMLPDFSOLICITUD($ultimasolicitud,$cargo,$nombreapellidossolicitante,$asignaturanombre,$dividirfechas[0],$dividirfechas[1],$observaciones,$grupotrabajo,$usersesion['nombres'],$asignacionesactuales);

      $pdf->writeHTML($htmlpdf, true, false, true, false, '');
      ob_clean();
      $rutasavePDF =FCPATH.'resources/pdf/SOLICITUD'.$ultimasolicitud.'-'.$rutusu.".pdf";
      $this->soli->update($ultimasolicitud, array('SOL_RUTA_PDF' => "SOLICITUD".$ultimasolicitud.'-'.$rutusu.".pdf"));
      $rutaAJAX = '/iPanol/resources/pdf/SOLICITUD'.$ultimasolicitud.'-'.$rutusu.".pdf";
      $pdf->Output($rutasavePDF, 'F');
       $this->output->set_content_type('application/json');
       $this->output->set_output(json_encode(array("resultado" => true ,"mensaje" => "Se ha creado correctamente la asignacion para esta solicitud","path" =>$rutaAJAX )));
      }else{
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode(array("resultado" => false ,"mensaje" => "La solicitud ingresada no tiene asignaciones de inventario")));
      }

  }


  public function insert_entrega_digital(){
    $usersesion = $this->session->userdata('logged_in');
    $asignaciones = $_POST["asignaciones"];
    //if ($asignaciones != null) {
      $cerraroparcial = $_POST["parcialocerrar"];
      $idsolicitud = $_POST["idsolicitud"];
      $solicitud = $this->soli->findById($idsolicitud);
      $rutusu = $solicitud->get("SOL_USU_RUT");
      $asignatura = $solicitud->get("SOL_ASIG_ID");
      $grupotrabajo = $solicitud->get("SOL_NRO_GRUPOTRAB");
      $observaciones = $_POST["observaciones"];
      $dateinicio = DateTime::createFromFormat("Y-m-d H:i:s",$solicitud->get("SOL_FECHA_INICIO"));
      $fechainicio = $dateinicio->format('d-m-Y H:i:s');   
      $datetermino= DateTime::createFromFormat("Y-m-d H:i:s",$solicitud->get("SOL_FECHA_TERMINO"));
      $fechatermino = $datetermino->format("d-m-Y H:m:s");      

      $detallesol = $this->detsol->findByArray(array('DETSOL_SOL_ID' => $idsolicitud));
      foreach ($detallesol as $key => $value) {
              foreach ($asignaciones as $key2 => $value2) {
                if ($value->get("DETSOL_PROD_ID") == $value2["idprod"]) {
                  $this->detsol->update($value->get("DETSOL_ID"),array('DETSOL_ESTADO' => 3));
                }
              }           
      }
      foreach ($asignaciones as $key => $value) {
        $columnasignacion  =  array(
                    'ASIG_ID' => 0,
                    'ASIG_ESTADO' => 1,
                    'ASIG_SOL_ID' => $idsolicitud,
                    'ASIG_INV_ID' => $value["idinv"],
                    'ASIG_FECHA' => date("Y-m-d H:i:s"),
                    'ASIG_CANT' => $value["cantidadinv"]
                    );
        $nuevaasignacion =  $this->asignacion->create($columnasignacion);
        $ultimaasignacion = $nuevaasignacion->insert();
        $this->asignacion->insertlog(array("LOGESTASIG_ASIG_ID" => $ultimaasignacion, "LOGESTASIG_USU_RUT" => $usersesion['rut'],"LOGESTASIG_ESTADO" => 1));

        if ($ultimaasignacion > 0) {
          $inventario = $this->inv->findById($value["idinv"]);
          if ($inventario->get("INV_TIPO_ID") == 1) {
             $columnasaeditar  =  array(
                      'INV_PROD_ESTADO' => 3,
                      'INV_ULTIMO_USUARIO' => $inventario->get("INV_ACTUAL_USUARIO"),
                      'INV_ACTUAL_USUARIO'=> $rutusu
                      );
             $inventario->update($value["idinv"],$columnasaeditar);
          }else if($inventario->get("INV_TIPO_ID") == 2){
              $columnasaeditar  =  array(
                      'INV_PROD_CANTIDAD' => intval($inventario->get("INV_PROD_CANTIDAD"))-intval($value["cantidadinv"]),
                      'INV_ULTIMO_USUARIO' => $inventario->get("INV_ACTUAL_USUARIO"),
                      'INV_ACTUAL_USUARIO'=> $rutusu
                      );
             $inventario->update($value["idinv"],$columnasaeditar);
          }
        }

      }

      $detallesolverificar = $this->detsol->findByArray(array('DETSOL_SOL_ID' => $idsolicitud));   
      $b = 0; $i = 0;
      foreach ($detallesolverificar as $key => $value) {
        $i++;
        if ($value->get("DETSOL_ESTADO") == 3) {
          $b++;
        }
      }

      if ($b == $i) {
        $this->soli->update($idsolicitud,array('SOL_ESTADO' => 3));
        $this->soli->insertlog(array("LOGESTASIG_ID"=>0,"LOGESTSOL_ESTADO" => 3,"LOGESTSOL_USU_RUT" => $usersesion['rut'],"LOGESTSOL_SOL_ID" => $idsolicitud));
      }else{
        if ($cerraroparcial == "asignarcerrar") {
          $this->soli->update($idsolicitud,array('SOL_ESTADO' => 3));
          $this->soli->insertlog(array("LOGESTASIG_ID"=>0,"LOGESTSOL_ESTADO" => 3,"LOGESTSOL_USU_RUT" => $usersesion['rut'],"LOGESTSOL_SOL_ID" => $idsolicitud));
        }else if($cerraroparcial == "asignarparcial"){
          $this->soli->update($idsolicitud,array('SOL_ESTADO' => 7));
          $this->soli->insertlog(array("LOGESTASIG_ID"=>0,"LOGESTSOL_ESTADO" => 7,"LOGESTSOL_USU_RUT" => $usersesion['rut'],"LOGESTSOL_SOL_ID" => $idsolicitud));
        }

      }




      $cargo = "";$asignaturanombre = "";$usuario = $this->usu->findById($rutusu);
      $verificardocenteoalumno = $usuario->get("USU_CARGO_ID");
      if ($verificardocenteoalumno == 1)$cargo = "ESTUDIANTE";
      if($verificardocenteoalumno == 2)$cargo = "DOCENTE";
      $asignaturaobj = $this->asig->findById($asignatura);
      $asignaturanombre = $asignaturaobj->get("ASIGNATURA_NOMBRE");
      $nombreapellidossolicitante = $usuario->get("USU_NOMBRES").' '.$usuario->get("USU_APELLIDOS");
      $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
      $pdf->SetFont('dejavusans', '', 7, '', true);
      $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                   Solicitud de prestamos N°'.$idsolicitud, "");
      $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
      $pdf->AddPage();

      $asignacionesactuales = $this->asignacion->findByArray(array('ASIG_SOL_ID' => $idsolicitud));

      $htmlpdf = $pdf->HTMLPDFSOLICITUD($idsolicitud,$cargo,$nombreapellidossolicitante,$asignaturanombre,$fechainicio,$fechatermino,$observaciones,$grupotrabajo,$usersesion['nombres'],$asignacionesactuales);

      $pdf->writeHTML($htmlpdf, true, false, true, false, '');
      ob_clean();
      $rutasavePDF =FCPATH.'resources/pdf/SOLICITUD'.$idsolicitud.'-'.$rutusu.".pdf";
      $this->soli->update($idsolicitud, array('SOL_RUTA_PDF' => "SOLICITUD".$idsolicitud.'-'.$rutusu.".pdf"));
      $rutaAJAX = '/iPanol/resources/pdf/SOLICITUD'.$idsolicitud.'-'.$rutusu.".pdf";
      $pdf->Output($rutasavePDF, 'F');
       $this->output->set_content_type('application/json');
       $this->output->set_output(json_encode(array("resultado" => true ,"mensaje" => "Se ha creado correctamente la asignacion para esta solicitud","path" =>$rutaAJAX )));
     // }else{
       // $this->output->set_content_type('application/json');
       // $this->output->set_output(json_encode(array("resultado" => false ,"mensaje" => "La solicitud ingresada no tiene asignaciones de inventario")));
     // }

  }

  /* End of file gestion.php */
  /* Location: ./application/controllers/gestion.php */
    public function codigos()
  {
    $NuevoProducto = array();
    $productos = $this->prod->findAll();
    foreach ($productos as $key => $value) {
      $NuevoProducto[] = array(
        'PROD_ID' => $value->get('PROD_ID'),
        'PROD_NOMBRE' => $value->get('PROD_NOMBRE'),
        'PROD_STOCK_TOTAL' => $value->get('PROD_STOCK_TOTAL'),
        'PROD_STOCK_CRITICO' => $value->get('PROD_STOCK_CRITICO'),
        'PROD_CAT_ID' => $this->cat->findById($value->get('PROD_CAT_ID')),
        'PROD_TIPOPROD_ID' => $this->tipoP->findById($value->get('PROD_TIPOPROD_ID')),
        'PROD_POSICION' => $value->get('PROD_POSICION'),
        'PROD_PRIORIDAD' => $value->get('PROD_PRIORIDAD'),
        'PROD_STOCK_OPTIMO' => $value->get('PROD_STOCK_OPTIMO'),
        'PROD_DIAS_ANTIC' => $value->get('PROD_DIAS_ANTIC'),
        'PROD_IMAGEN' => $value->get('PROD_IMAGEN'),
        'PROD_ESTADO' => $value->get('PROD_ESTADO')
      );
      $datos['productos'] = $NuevoProducto;
    }
    $datos['categorias'] = $this->cat->findAll();
    $datos['tipos'] = $this->tipoP->findAll();
    $this->layouthelper->LoadView("gestion/codigos" , $datos);
  }




}


