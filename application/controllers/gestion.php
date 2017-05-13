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

}

/* End of file gestion.php */
/* Location: ./application/controllers/gestion.php */