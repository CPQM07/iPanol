<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mantencion extends CI_Controller {

  public function __construct()
  {
		parent::__construct();
		$this->layouthelper->SetMaster('layout');
		$this->load->model('Cargo_Model','cargo', true);
		$this->load->model('Usuario_Model','usuario', true);
		$this->load->model('Carrera_Model','carrera', true);
		$this->load->model('Categoria_Model', 'categorias', true);
		$this->load->model('Proveedor_Model', 'proveedores', true);
		$this->load->model('Producto_Model', 'productos', true);
		$this->load->model('TipoProd_Model', 'tipoProducto', true);
  }

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

	public function new_usuario(){
		if(isset($_POST['new_usu'])){
			$nuevousuario=$this->usuario->create($_POST['new_usu']);
			$nuevousuario->insert();
			redirect('/Mantencion/usuarios');
		}else{
			echo "usuario no fue agregado";
		}
	}

	public function edit_usuario(){
		if(isset($_POST['new_usu'])){
			
			redirect('/Mantencion/usuarios');
		}else{
			echo "usuario no fue agregado";
		}
	}
	public function eliminarusuario($id=null){
		$this->usuario->delete($id);
	}
	//Fin Usuario

	//Categoria
	public function categorias(){
	  $datos['categoria'] = $this->categorias->findAll();
	  $this->layouthelper->LoadView("mantenedores/categorias", $datos, null);
	}

	public function eliminarCategoria($ID){
	  $this->categorias->delete($ID);
	  redirect('/Mantencion/categorias');
	}

	public function editarCategoria($ID){

	}
	//Fin Categoria

	//Productos
	public function productos(){
	  $NuevoProducto = array();
	  $productos = $this->productos->findAll();
	  foreach ($productos as $key => $value) {
	    $NuevoProducto[] = array(
	      'PROD_ID' => $value->get('PROD_ID'),
	      'PROD_NOMBRE' => $value->get('PROD_NOMBRE'),
	      'PROD_STOCK_TOTAL' => $value->get('PROD_STOCK_TOTAL'),
	      'PROD_STOCK_CRITICO' => $value->get('PROD_STOCK_CRITICO'),
	      'PROD_CAT_ID' => $this->categorias->findById($value->get('PROD_CAT_ID')),
	      'PROD_TIPOPROD_ID' => $this->tipoProducto->findById($value->get('PROD_TIPOPROD_ID')),
	      'PROD_POSICION' => $value->get('PROD_POSICION'),
	      'PROD_PRIORIDAD' => $value->get('PROD_PRIORIDAD'),
	      'PROD_STOCK_OPTIMO' => $value->get('PROD_STOCK_OPTIMO'),
	      'PROD_DIAS_ANTIC' => $value->get('PROD_DIAS_ANTIC'),
	      'PROD_IMAGEN' => $value->get('PROD_IMAGEN'),
	      'PROD_ESTADO' => $value->get('PROD_ESTADO')
	    );
	    $datos['productos'] = $NuevoProducto;
	  }
	  $datos['categorias'] = $this->categorias->findAll();
	  $datos['tipos'] = $this->tipoProducto->findAll();
	  $this->layouthelper->LoadView("mantenedores/productos", $datos, null);
	}

	public function new_producto(){
		if(isset($_POST['producto'])){
			$nuevopro=$this->productos->create($_POST['producto']);
			$nuevopro->insert();
			redirect('/Mantencion/productos');
		}else{
			echo "usuario no fue agregado";
		}
	}
	//Fin Productos

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
	  $datos['proveedor'] = $this->proveedores->findAll();
	  $this->layouthelper->LoadView("mantenedores/proveedores", $datos,	 null);
	}

	public function eliminarProveedor($RUT){
	  $this->proveedores->delete($RUT);
	  redirect('/Mantencion/proveedores');
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
