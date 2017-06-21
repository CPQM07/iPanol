<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte_Model extends CI_Model {
//productos en stock critico
//stock anual de productos e insumos....
// reporte motivos de productos dados de baja
//vida util de productos e insumos....
	

public function __construct()
{
parent::__construct();
}	

function get($attr){
	return $this->_columns[$attr];
}
	public function tipo(){
		$result = array();
		$this->db->select ('*');
		$this->db->from('tipoprod');
		$consulta = $this->db->get();
		$result = null;
		foreach ($consulta->result_array() as $row) {
			$result[]= $row;
		}
		return $result;
	}
	public function motivo(){
		$result = array();
		$this->db->select('*');
		$this->db->from('motivo');
		$consulta = $this->db->get();
		$result = null;
		foreach ($consulta->result_array() as $row) {
			$result[] = $row;
		}
		return $result;
	}
// METODO BUSCAR LOS PRODUCTOS CON FILTRO DE TIPO
	public function findAllProductosActivos($tipo, $cat){
		$result = array();
		//$this->db->like('TIPO_ID', $tipo);
		$this->db->select ("TIPO_ID, CAT_ID, INV_PROD_CODIGO,TIPO_NOMBRE ,CAT_NOMBRE, INV_PROD_NOM, PROD_POSICION,INV_PROD_CANTIDAD,
							count(inventario.INV_PROD_CANTIDAD) as Total");
		$this->db->from("inventario");
		$this->db->join('tipoprod', 'tipoprod.TIPO_ID = inventario.INV_TIPO_ID');
		$this->db->join('categoria','categoria.CAT_ID = inventario.INV_CATEGORIA_ID');
		$this->db->join('productos','inventario.INV_PROD_ID = productos.PROD_ID');
		$this->db->where('tipoprod.TIPO_ID = 1');
		if($cat!='0'){
	    	$this->db->where('CAT_ID', $cat);	
		}
		if($tipo!='0'){
			$this->db->where('TIPO_ID', $tipo);		
		}
		$this->db->group_by('inventario.INV_PROD_NOM');
		$consulta = $this->db->get();
		
		$result = null;
    foreach ($consulta->result_array() as $row) {
      $result[] = $row;
    }
   // echo "AVLOR:";
		//var_dump($result);
		if(is_null($result))
		{
			$result =array(array( 
"TIPO_ID"=>"0",
"CAT_ID"=>"0",
"INV_PROD_CODIGO"=>"0",
"TIPO_NOMBRE"=>"SIN REGISTRO",
"CAT_NOMBRE"=>"SIN REGISTRO", 
"INV_PROD_NOM"=>"SIN REGISTRO", 
"PROD_POSICION"=>"0",
"Total"=>"0"));
		}
    return $result;
}
	public function findAllProductosFungibles($tipo, $cat){
		$result = array();
		//$this->db->like('TIPO_ID', $tipo);
		$this->db->select ("TIPO_ID, CAT_ID, INV_PROD_CODIGO,TIPO_NOMBRE ,CAT_NOMBRE, INV_PROD_NOM, 
			INV_PROD_CANTIDAD, PROD_POSICION");
		$this->db->from("inventario");
		$this->db->join('tipoprod', 'tipoprod.TIPO_ID = inventario.INV_TIPO_ID');
		$this->db->join('categoria','categoria.CAT_ID = inventario.INV_CATEGORIA_ID');
		$this->db->join('productos','inventario.INV_PROD_ID = productos.PROD_ID');
		$this->db->where('tipoprod.TIPO_ID = 2');
		if($cat!='0'){
			$this->db->where('CAT_ID', $cat);	
		}
		if($tipo!='0'){
			$this->db->where('TIPO_ID', $tipo);		
		}
		$this->db->group_by('inventario.INV_PROD_NOM');
		$consulta = $this->db->get();
		$result = null;
    foreach ($consulta->result_array() as $row) {
      $result[] = $row;
    }
   // echo "AVLOR:";
		//var_dump($result);
		if(is_null($result))
		{
			$result =array(array( 
"TIPO_ID"=>"0",
"CAT_ID"=>"0",
"INV_PROD_CODIGO"=>"0",
"TIPO_NOMBRE"=>"SIN REGISTRO",
"CAT_NOMBRE"=>"SIN REGISTRO", 
"INV_PROD_NOM"=>"SIN REGISTRO",
"INV_PROD_CANTIDAD"=>"0",
"PROD_POSICION"=>"0"));
		}
    return $result;
}
//METODO BUSCAR LOS PODRUCTOS CRITICOS CON FILTRO DE TIPO
public function findAllCriticosActivos($tipo, $cat){
	$result = array();
	//$this->db->like('TIPO_ID', $tipo);
	$this->db->select('inventario.INV_PROD_CODIGO,tipoprod.TIPO_ID,tipoprod.TIPO_NOMBRE,categoria.CAT_ID,categoria.CAT_NOMBRE,inventario.INV_PROD_NOM, productos.PROD_STOCK_CRITICO, productos.PROD_STOCK_OPTIMO
		,productos.PROD_PRIORIDAD,inventario.INV_PROD_ID , COUNT(*) AS CANTIDAD');
	$this->db->from('inventario');
	$this->db->join('tipoprod','inventario.INV_TIPO_ID = tipoprod.TIPO_ID');
	$this->db->join('categoria','inventario.INV_CATEGORIA_ID = categoria.CAT_ID');
	$this->db->join('productos','inventario.INV_PROD_ID = productos.PROD_ID');
	$this->db->where('inventario.INV_PROD_ESTADO = 1');
	$this->db->where('tipoprod.TIPO_ID = 1');
 	if ($cat!='0') {
		$this->db->where('CAT_ID',$cat);
	}	
	if ($tipo!='0') {
		$this->db->where('TIPO_ID',$tipo);
	}
	$this->db->having('CANTIDAD <= productos.PROD_STOCK_CRITICO');
	$this->db->group_by('inventario.INV_PROD_NOM');
	$consulta = $this->db->get();
		$result = null;
    foreach ($consulta->result_array() as $row) {
      $result[] = $row;
    }
		if(is_null($result))
		{
			$result =array(array( 
"TIPO_ID"=>"0",
"INV_PROD_CODIGO"=>"0",
"INV_PROD_NOM"=>"SIN REGISTRO",
"TIPO_NOMBRE"=>"SIN REGISTRO",
"CAT_ID"=>"0",
"CAT_NOMBRE"=>"SIN REGISTRO", 
"PROD_STOCK_OPTIMO"=>"0",
"PROD_STOCK_CRITICO"=>"0",
"PROD_PRIORIDAD"=>"0",
"CANTIDAD"=>"0"));
		}
    return $result;
}

public function findAllCriticosFungibles($tipo, $cat){
	$result = array();
	//$this->db->like('TIPO_ID', $tipo);
	$this->db->select('inventario.INV_PROD_CODIGO,categoria.CAT_ID,tipoprod.TIPO_ID,categoria.CAT_NOMBRE,tipoprod.TIPO_NOMBRE,inventario.INV_PROD_NOM,inventario.INV_PROD_CANTIDAD,
productos.PROD_STOCK_CRITICO,productos.PROD_STOCK_OPTIMO,productos.PROD_PRIORIDAD');
	$this->db->from('inventario');
	$this->db->join('categoria','inventario.INV_CATEGORIA_ID = categoria.CAT_ID');
	$this->db->join('tipoprod','inventario.INV_TIPO_ID = tipoprod.TIPO_ID');
	$this->db->join('productos','inventario.INV_PROD_ID = productos.PROD_ID');
	$this->db->where('inventario.INV_PROD_CANTIDAD <= productos.PROD_STOCK_CRITICO');
	$this->db->where('tipoprod.TIPO_ID = 2');
	if ($cat!='0') {
		$this->db->where('CAT_ID',$cat);
	}	
	if ($tipo!='0') {
		$this->db->where('TIPO_ID',$tipo);
	}
	$this->db->group_by('inventario.INV_PROD_NOM');
	$consulta = $this->db->get();

		$result = null;
    foreach ($consulta->result_array() as $row) {
      $result[] = $row;
    }
		if(is_null($result))
		{
			$result =array(array( 
"TIPO_ID"=>"0",
"INV_PROD_CODIGO"=>"0",
"INV_PROD_NOM"=>"SIN REGISTRO",
"TIPO_NOMBRE"=>"SIN REGISTRO",
"CAT_ID"=>"0",
"CAT_NOMBRE"=>"SIN REGISTRO", 
"PROD_STOCK_OPTIMO"=>"0",
"PROD_STOCK_CRITICO"=>"0",
"PROD_PRIORIDAD"=>"0",
"INV_PROD_CANTIDAD"=>"0"));
		}
    return $result;
}

public function motivosdebaja($tipo, $cat, $mot){
	$result = array();
	//$this->db->like('TIPO_ID', $tipo);
	$this->db->select('inventario.INV_PROD_CODIGO, categoria.CAT_ID, categoria.CAT_NOMBRE,
						tipoprod.TIPO_ID, tipoprod.TIPO_NOMBRE, inventario.INV_PROD_ESTADO,
						inventario.INV_PROD_NOM, baja.BAJA_FECHA, motivo.MOT_ID, motivo.MOT_NOMBRE');
	$this->db->from('inventario');
	$this->db->join('categoria','inventario.INV_CATEGORIA_ID = categoria.CAT_ID');
	$this->db->join('tipoprod','inventario.INV_TIPO_ID = tipoprod.TIPO_ID');
	$this->db->join('baja','inventario.INV_ID = baja.BAJA_INV_ID');
	$this->db->join('motivo','baja.BAJA_MOTIVO_ID = motivo.MOT_ID');
	$this->db->where('inventario.INV_PROD_ESTADO != 1');
	if ($cat!='0') {
		$this->db->where('CAT_ID',$cat);
	}	
	if ($tipo!='0') {
		$this->db->where('TIPO_ID',$tipo);
	}
	if ($mot!='0') {
		$this->db->where('MOT_ID',$mot);
	}
	$this->db->group_by('inventario.INV_PROD_NOM');
	$consulta = $this->db->get();
		$result = null;
    foreach ($consulta->result_array() as $row) {
      $result[] = $row;
    }
		if(is_null($result))
		{
			$result =array(array( 
"TIPO_ID"=>"0",
"INV_PROD_CODIGO"=>"0",
"INV_PROD_NOM"=>"SIN REGISTRO",
"TIPO_NOMBRE"=>"SIN REGISTRO",
"CAT_ID"=>"0",
"CAT_NOMBRE"=>"SIN REGISTRO", 
"BAJA_FECHA"=>"SIN REGISTRO",
"MOT_NOMBRE"=>"SIN REGISTRO"));
		}
    return $result;
}

public function vidautilCompras($tipo, $cat, $adq){
	$this->db->select('INV_PROD_CODIGO,TIPO_ID,TIPO_NOMBRE,CAT_ID,CAT_NOMBRE,
 INV_PROD_NOM,ING_FECHA,PROV_NOMBRE,PROV_RUT,ING_VIDA_ULTIL_PROVEEDOR,ING_TIPO_INGRESO');
	$this->db->from('inventario');
	$this->db->join('ingreso','inventario.INV_INGRESO_ID = ingreso.ING_ID');
	$this->db->join('proveedor','ingreso.ING_PROV_RUT = proveedor.PROV_RUT');
	$this->db->join('tipoprod','inventario.INV_TIPO_ID = tipoprod.TIPO_ID');
	$this->db->join('categoria','inventario.INV_CATEGORIA_ID = categoria.CAT_ID ');
	if ($cat!='0') {
		$this->db->where('CAT_ID',$cat);
	}
	if ($tipo!='0') {
		$this->db->where('TIPO_ID',$tipo);
	}
	if ($adq!='0') {
		$this->db->where('ING_TIPO_INGRESO',$adq);
	}
	$this->db->group_by('inventario.INV_PROD_NOM');
	$consulta = $this->db->get();
		$result = null;
    foreach ($consulta->result_array() as $row) {
      $result[] = $row;
    }

		if(is_null($result))
		{
			$result =array(array( 
"INV_PROD_CODIGO"=>"0",				
"TIPO_ID"=>"0",
"TIPO_NOMBRE"=>"SIN REGISTRO",
"CAT_ID"=>"0",
"CAT_NOMBRE"=>"SIN REGISTRO",
"INV_PROD_NOM"=>"SIN REGISTRO",
"ING_FECHA"=>"0-0-0", 
"PROV_NOMBRE"=>"SIN REGISTRO",
"PROV_RUT"=>"0",
"ING_VIDA_ULTIL_PROVEEDOR"=>"0",
"ING_TIPO_INGRESO"=>"0"));
		}
    return $result;
}
public function vidautilDonaciones($tipo, $cat, $adq){
	$this->db->select('INV_PROD_CODIGO,TIPO_ID,TIPO_NOMBRE,CAT_ID,CAT_NOMBRE,
 INV_PROD_NOM,ING_FECHA,ING_VIDA_ULTIL_PROVEEDOR,ING_TIPO_INGRESO');
	$this->db->from('inventario');
	$this->db->join('ingreso','inventario.INV_INGRESO_ID = ingreso.ING_ID');
	$this->db->join('tipoprod','inventario.INV_TIPO_ID = tipoprod.TIPO_ID');
	$this->db->join('categoria','inventario.INV_CATEGORIA_ID = categoria.CAT_ID ');
	if ($cat!='0') {
		$this->db->where('CAT_ID',$cat);
	}
	if ($tipo!='0') {
		$this->db->where('TIPO_ID',$tipo);
	}
	if ($adq!='0') {
		$this->db->where('ING_TIPO_INGRESO',$adq);
	}
	$this->db->group_by('inventario.INV_PROD_NOM');
	$consulta = $this->db->get();
		$result = null;
    foreach ($consulta->result_array() as $row) {
      $result[] = $row;
    }

		if(is_null($result))
		{
			$result =array(array( 
"INV_PROD_CODIGO"=>"0",				
"TIPO_ID"=>"0",
"TIPO_NOMBRE"=>"SIN REGISTRO",
"CAT_ID"=>"0",
"CAT_NOMBRE"=>"SIN REGISTRO",
"INV_PROD_NOM"=>"SIN REGISTRO",
"ING_FECHA"=>"0-0-0",
"ING_VIDA_ULTIL_PROVEEDOR"=>"0",
"ING_TIPO_INGRESO"=>"0"));
		}
    return $result;
}
		}
	

/* End of file Reporte_Model.php */
/* Location: ./application/models/Reporte_Model.php */