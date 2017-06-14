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
// METODO BUSCAR LOS PRODUCTOS CON FILTRO DE TIPO
	public function findAllProductosActivos($tipo, $cat){
		$result = array();
		//$this->db->like('TIPO_ID', $tipo);
		
		$this->db->select ("TIPO_ID, CAT_ID, TIPO_NOMBRE ,CAT_NOMBRE, INV_PROD_NOM, PROD_POSICION,
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
"TIPO_NOMBRE"=>"SIN DATOS",
"CAT_NOMBRE"=>"0", 
"INV_PROD_NOM"=>"0", 
"PROD_POSICION"=>"0",
"Total"=>"0"));
		}
    return $result;
}
	public function findAllProductosFungibles($tipo, $cat){
		$result = array();
		//$this->db->like('TIPO_ID', $tipo);
		
		$this->db->select ("TIPO_ID, CAT_ID, TIPO_NOMBRE ,CAT_NOMBRE, INV_PROD_NOM, PROD_POSICION");
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
"TIPO_NOMBRE"=>"SIN DATOS",
"CAT_NOMBRE"=>"0", 
"INV_PROD_NOM"=>"0", 
"PROD_POSICION"=>"0"));
		}
    return $result;
}
//METODO BUSCAR LOS PODRUCTOS CRITICOS CON FILTRO DE TIPO
public function findAllCriticos($tipo, $cat){
	$result = array();
	//$this->db->like('TIPO_ID', $tipo);
	$this->db->select('TIPO_ID, TIPO_NOMBRE,CAT_ID,CAT_NOMBRE,PROD_NOMBRE,
		PROD_STOCK_TOTAL,PROD_STOCK_OPTIMO,PROD_PRIORIDAD');
	$this->db->from('productos');
	$this->db->join('tipoprod','tipoprod.TIPO_ID = productos.PROD_TIPOPROD_ID');
	$this->db->join('categoria','categoria.CAT_ID = productos.PROD_CAT_ID');
	$this->db->where('productos.PROD_STOCK_CRITICO >= productos.PROD_STOCK_TOTAL');
		if(($cat!='0')){
			$this->db->where('CAT_ID', $cat);	
		}
		if($tipo!='0'){
			$this->db->where('TIPO_ID', $tipo);		
		}
	$this->db->group_by('productos.PROD_ID');
		$consulta = $this->db->get();
		
		$result = null;
    foreach ($consulta->result_array() as $row) {
      $result[] = $row;
    }

		if(is_null($result))
		{
			$result =array(array( 
"TIPO_ID"=>"0",
"TIPO_NOMBRE"=>"SIN DATOS",
"CAT_ID"=>"0",
"CAT_NOMBRE"=>"0", 
"PROD_NOMBRE"=>"0", 
"PROD_STOCK_TOTAL"=>"0",
"PROD_STOCK_OPTIMO"=>"0",
"PROD_PRIORIDAD"=>"0"));
		}
    return $result;
}

public function totalactivos(){

}
public function motivosdebaja(){
	$result = array();
		$this->db->select('TIPO_NOMBRE,CAT_NOMBRE,PROD_NOMBRE,INV_PROD_NOM,BAJA_FECHA,ING_FECHA,USU_NOMBRES,MOT_NOMBRE');
		$this->db->from('baja');
		$this->db->join('motivo','motivo.MOT_ID = baja.BAJA_MOTIVO_ID');
		$this->db->join('usuario','usuario.USU_RUT = baja.BAJA_USU_RUT');
		$this->db->join('ingreso','ingreso.ING_USU_RUT = usuario.USU_RUT');
		$this->db->join('productos','productos.PROD_ID = ingreso.ING_PROD_ID');
		$this->db->join('tipoprod','tipoprod.TIPO_ID = productos.PROD_TIPOPROD_ID');
		$this->db->join('categoria','categoria.CAT_ID = productos.PROD_CAT_ID');
		$this->db->join('inventario','INV_ID = baja.BAJA_INV_ID');
			$consulta = $this->db->get();
				$result = null;
    foreach ($consulta->result_array() as $row) {
      $result[] = $row;
    }
    return $result;
}

public function vidautil(){
	$this->db->select('TIPO_NOMBRE,PROD_NOMBRE,PROV_NOMBRE,ING_FECHA,ING_VIDA_UTIL_PROVEEDOR,USU_NOMBRES');
	$this->db->from('ingreso');
	$this->db->join('proveedor','proveedor.PROV_RUT = ingreso.ING_PROV_RUT');
	$this->db->join('usuario','usuario.USU_RUT = ingreso.ING_USU_RUT');
	$this->db->join('inventario','ingreso.ING_ID = inventario.INV_INGRESO_ID');
	$this->db->join('productos','productos.PROD_ID = inventario.INV_PROD_ID');
	$this->db->join('tipoprod','tipoprod.TIPO_ID = productos.PROD_TIPOPROD_ID');
	$this->db->group_by('ingreso.ING_ID'); //PUEDE QUE ESTO HAGA FUNCIONAR LA CONSULTA EN PHPMYADMIN Y NO AQUI EN CASO DE ALGUN ERROR ... ELIMINAR EL GROUP_BY 	
	$consulta = $this->db->get();
		$result = null;
    foreach ($consulta->result_array() as $row) {
      $result[] = $row;
    }
    return $result;
}
	public function tipo(){
		$this->db->select ('*');
		$this->db->from('tipoprod');
		$consulta = $this->db->get();
		$result = null;
		foreach ($consulta->result_array() as $row) {
			$result[]= $row;
		}
		return $result;
	}

			
		}
	


/* End of file Reporte_Model.php */
/* Location: ./application/models/Reporte_Model.php */