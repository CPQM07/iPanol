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
    $this->load->model('Categoria_Model','cat',true);
    $this->load->model('Inventario_Model','inv',true);
    $this->load->model('Solicitud_Model','soli',true);
    $this->load->model('DetSolicitud_Model','detsol',true);
    $this->load->model('Asignacion_Model','asignacion',true);

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
     $data["solicitudes"] = $this->soli->findByEstadoDetSol(1);//busco las solicitudes enviadas por el catalogo
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
     $this->layouthelper->LoadView("gestion/baja" , null );
  }

  public function ingreso()
  {
     $this->layouthelper->LoadView("gestion/ingreso" , null );
  }

  public function recepcion()
  {
     $this->layouthelper->LoadView("gestion/recepcion" , null );
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
                    'SOL_OBSERVACION' => $observaciones
                    );
     $nuevasolicitud =  $this->soli->create($columnassolicitud);
     $ultimasolicitud = $nuevasolicitud->insert();

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
     $this->detsol->insertlog(array("LOGESTSOL_ESTADO" => 5,"LOGESTSOL_USU_RUT" => $usersesion['rut'],"LOGESTSOL_DETSOL_ID" => $ultimodetalle));
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
        if ($ultimaasignacion > 0) {
          $inventario = $this->inv->findById($value["idinv"]);
          if ($inventario->get("INV_TIPO_ID") == 1) {
             $columnasaeditar  =  array(
                      'INV_PROD_ESTADO' => 3,
                      'INV_ULTIMO_USUARIO' => $rutusu
                      );
             $inventario->update($value["idinv"],$columnasaeditar);
          }else if($inventario->get("INV_TIPO_ID") == 2){
              $columnasaeditar  =  array(
                      'INV_ULTIMO_USUARIO' => $rutusu,
                      'INV_PROD_CANTIDAD' => intval($inventario->get("INV_PROD_CANTIDAD"))-intval($value["cantidadinv"])
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
      $htmlpdf = $pdf->HTMLPDFSOLICITUD($ultimasolicitud,$cargo,$nombreapellidossolicitante,$asignaturanombre,$dividirfechas[0],$dividirfechas[1],$observaciones,$grupotrabajo,$usersesion['nombres'],$asignaciones);

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
    if ($asignaciones != null) {
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
             $this->detsol->update($value->get("DETSOL_ID"),array('DETSOL_ESTADO' => 3));
             $this->detsol->insertlog(array("LOGESTSOL_ESTADO" => 3,"LOGESTSOL_USU_RUT" => $usersesion['rut'],"LOGESTSOL_DETSOL_ID" => $value->get("DETSOL_ID")));
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

        if ($ultimaasignacion > 0) {
          $inventario = $this->inv->findById($value["idinv"]);
          if ($inventario->get("INV_TIPO_ID") == 1) {
             $columnasaeditar  =  array(
                      'INV_PROD_ESTADO' => 3,
                      'INV_ULTIMO_USUARIO' => $rutusu
                      );
             $inventario->update($value["idinv"],$columnasaeditar);
          }else if($inventario->get("INV_TIPO_ID") == 2){
              $columnasaeditar  =  array(
                      'INV_ULTIMO_USUARIO' => $rutusu,
                      'INV_PROD_CANTIDAD' => intval($inventario->get("INV_PROD_CANTIDAD"))-intval($value["cantidadinv"])
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
      $htmlpdf = $pdf->HTMLPDFSOLICITUD($idsolicitud,$cargo,$nombreapellidossolicitante,$asignaturanombre,$fechainicio,$fechatermino,$observaciones,$grupotrabajo,$usersesion['nombres'],$asignaciones);

      $pdf->writeHTML($htmlpdf, true, false, true, false, '');
      ob_clean();
      $rutasavePDF =FCPATH.'resources/pdf/SOLICITUD'.$idsolicitud.'-'.$rutusu.".pdf";
      $this->soli->update($idsolicitud, array('SOL_RUTA_PDF' => "SOLICITUD".$idsolicitud.'-'.$rutusu.".pdf"));
      $rutaAJAX = '/iPanol/resources/pdf/SOLICITUD'.$idsolicitud.'-'.$rutusu.".pdf";
      $pdf->Output($rutasavePDF, 'F');
       $this->output->set_content_type('application/json');
       $this->output->set_output(json_encode(array("resultado" => true ,"mensaje" => "Se ha creado correctamente la asignacion para esta solicitud","path" =>$rutaAJAX )));
      }else{
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode(array("resultado" => false ,"mensaje" => "La solicitud ingresada no tiene asignaciones de inventario")));
      }

  }




}

/* End of file gestion.php */
/* Location: ./application/controllers/gestion.php */