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

	public function motivos(){
		$this->layouthelper->LoadView("mantenedores/motivos" , null);
	}

	public function proveedores(){
		$this->layouthelper->LoadView("mantenedores/proveedores" , null);
	}

	public function bajas(){
		$this->layouthelper->LoadView("mantenedores/bajas" , null);
	}

}

/* End of file mantencion.php */
/* Location: ./application/controllers/mantencion.php */
