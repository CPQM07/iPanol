<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gestion extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->layouthelper->SetMaster('layout');
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
     $this->layouthelper->LoadView("gestion/entregamanual" , null );
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
}

/* End of file gestion.php */
/* Location: ./application/controllers/gestion.php */