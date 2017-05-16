<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gestion extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->layouthelper->SetMaster('layout');
    $this->load->model('Usuario_Model','usu',true);
    $this->load->model('Asignatura_Model','asig',true);
    $this->load->model('Categoria_Model','cat',true);
    $this->load->model('Inventario_Model','inv',true);

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
     $this->layouthelper->LoadView("gestion/entregadigital" , null );
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
    $inventario = $this->inv->findByArray(array('INV_CATEGORIA_ID' => $idcat,'INV_TIPO_ID' => $idtipo ,'INV_PROD_ESTADO' =>1 ));

    foreach ($inventario as $key => $value) {
      $allinv[] = array($value->get('INV_ID'),
                        $value->get('INV_PROD_NOM'),
                        $value->get('INV_PROD_CANTIDAD')
                        );
    }

    $this->output->set_content_type('application/json');
    $this->output->set_output(json_encode($allinv));
  }

}

/* End of file gestion.php */
/* Location: ./application/controllers/gestion.php */