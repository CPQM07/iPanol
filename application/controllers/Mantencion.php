<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mantencion extends CI_Controller {

	  public function __construct()
	  {
	    parent::__construct();
	    $this->layouthelper->SetMaster('layout');
	  }

	public function index()
	{
		
	}

	public function productos(){
		$this->layouthelper->LoadView("mantenedores/productos" , null);
	}

	public function usuarios(){
		$this->layouthelper->LoadView("mantenedores/usuarios" , null);
	}

	public function categorias(){
		$this->layouthelper->LoadView("mantenedores/categorias" , null);
	}

	public function asignaturas(){
		$this->layouthelper->LoadView("mantenedores/asignaturas" , null);
	}

}

/* End of file mantencion.php */
/* Location: ./application/controllers/mantencion.php */