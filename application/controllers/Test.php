<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller{

  public function __construct()
  {
		parent::__construct();
      if ($this->session->userdata('logged_in')) {
  		$this->layouthelper->SetMaster('layout');
      $this->load->model('Solicitud_Model','soli',true);
      $this->load->model('Usuario_Model','usu',true);
    } else {
      redirect('/Login');
    }
  }

  function Solicitudes (){
    $datos['Usuarios'] = $this->usu->findAll();
    $datos['Solicitudes'] = $this->soli->findEstados();
    $this->layouthelper->LoadView("gestion/solicitudes" , $datos);
  }


  function CambiarEstadoSOL($ESTADO, $id){
    if ($ESTADO == 1) {
      $this->session->set_flashdata('Update', 'Se Cambio el ESTADO Correctamente');
      $this->soli->update($id, array('SOL_ESTADO' => 2));
      redirect('Test/Solicitudes');
    } elseif ($ESTADO == 2) {
      $this->session->set_flashdata('Update', 'Se Cambio el ESTADO Correctamente');
      $this->soli->update($id, array('SOL_ESTADO' => 1));
      redirect('Test/Solicitudes');
    } elseif ($ESTADO == 3) {
      $this->session->set_flashdata('Update', 'Se Cambio el ESTADO Correctamente');
      $this->soli->update($id, array('SOL_ESTADO' => 7));
      redirect('Test/Solicitudes');
    } elseif ($ESTADO == 4) {
      $this->session->set_flashdata('Update', 'Se Cambio el ESTADO Correctamente');
      $this->soli->update($id, array('SOL_ESTADO' => 6));
      redirect('Test/Solicitudes');
    } elseif ($ESTADO == 6) {
      $this->session->set_flashdata('Update', 'Se Cambio el ESTADO Correctamente');
      $this->soli->update($id, array('SOL_ESTADO' => 4));
      redirect('Test/Solicitudes');
    } elseif ($ESTADO == 7) {
      $this->session->set_flashdata('Update', 'Se Cambio el ESTADO Correctamente');
      $this->soli->update($id, array('SOL_ESTADO' => 3));
      redirect('Test/Solicitudes');
    }
	}

}
