<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mantencion extends CI_Controller {

	  public function __construct()
	  {
	    parent::__construct();
	    $this->layouthelper->SetMaster('layout');
	    $this->load->model('Cargo_Model','cargo',true);
		$this->load->model('Usuario_Model','usuario',true);
		$this->load->model('Carrera_Model','carrera',true);
	  }

	public function index()
	{

	}

	//Productos
	public function productos(){
		$this->layouthelper->LoadView("mantenedores/productos" , null);
	}
	//Fin Productos

	//Usuarios
	public function usuarios(){
		$newarray= array();
		$usuarios = $this->usuario->findAll();
		foreach ($usuarios as $key => $value) {
			$newarray[] = array(
					'USU_RUT' => $value->get("USU_RUT"),
					'USU_DV' => $value->get("USU_DV"),
					'USU_NOMBRES' => $value->get("USU_NOMBRES"),
					'USU_APELLIDOS' => $value->get("USU_APELLIDOS"),
					'USU_CARGO_ID' => $this->cargo->findById($value->get("USU_CARGO_ID")),
					'USU_CARRERA_ID' => $this->carrera->findById($value->get("USU_CARRERA_ID")),
					'USU_EMAIL' => $value->get("USU_EMAIL"),
					'USU_TELEFONO1' => $value->get("USU_TELEFONO1"),
					'USU_TELEFONO2' => $value->get("USU_TELEFONO2"),
					'USU_CLAVE' => $value->get("USU_CLAVE"),
					'USU_ESTADO' => $value->get("USU_ESTADO")
					);
			
		}

		$data['usuario']= $newarray;
		$data['carrera']=$this->carrera->findAll();
		$data['cargo']=$this->cargo->findAll();
		$this->layouthelper->LoadView("mantenedores/usuarios" ,$data, false);
	}


	//Fin Usuario

	//Categoria

	public function categorias(){
		$this->layouthelper->LoadView("mantenedores/categorias" , null);
	}
	//Fin Categoria

	//Asignatura
	public function asignaturas(){
		$this->layouthelper->LoadView("mantenedores/asignaturas" , null);
	}
	//Fin Asignatura

	//Motivos
	public function motivos(){
		$this->layouthelper->LoadView("mantenedores/motivos" , null);
	}
	//Fin Motivos

	//Proveedores
	public function proveedores(){
		$this->layouthelper->LoadView("mantenedores/proveedores" , null);
	}
	//Fin Proveedores

	//Bajas
	public function bajas(){
		$this->layouthelper->LoadView("mantenedores/bajas" , null);
	}
	//Fin Bajas

}

/* End of file mantencion.php */
/* Location: ./application/controllers/mantencion.php */
