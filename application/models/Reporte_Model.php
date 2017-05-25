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
private $_columns= array(
	'REPORTE_ID' =>0,
	'REPORTE_FECHA'=>'',
	'REPORTE_TIPO' =>0,
	'REPORTE_DESC' =>''
	);
function get($attr){
	return $this->_columns[$attr];
}

public function findAllProductos(){
	$result = array();
	$bit = null;
	$this->db->select('TIPO_NOMBRE,PROD_NOMBRE,ING_FECHA,PROD_STOCK_TOTAL,PROV_NOMBRE,PROD_POSICION');
	$this->db->from('productos');
	$this->db->join('tipoprod','TIPO_ID = PROD_TIPOPROD_ID');
	$this->db->join('inventario','PROD_ID = INV_PROD_ID');
	$this->db->join('ingreso','ING_ID = INV_INGRESO_ID');
	$consulta = $this->db->get();	
	$totalproductos = null;
	if ($consulta->num_rows()==1) {
		$totalproductos = $consulta->row_object();
	}
	return $totalproductos;
}
public function findAllCriticos(){
	$result = array();
	$bit= null;
	$this->db->select('TIPO_PRODUCTO,PROD_NOMBRE,ING_FECHA,PROD_STOCK_TOTAL,PROD_STOCK_OPTIMO,PROD_PRIORIDAD,');
	$this->db->from('productos');
	$this->db->where('PROD_STOCK_CRITICO >= PROD_STOCK_TOTAL');
	$this->db->join('inventario','INV_PROD_ID = PROD_ID');
	$this->db->join('ingreso','ING_ID = INV_INGRESO_ID');
	$consulta = $this->db->get();
		$productoscriticos = null;
			if ($consulta->num_rows()==1) {
				$productoscriticos = $consulta->row_object();
			}
			return $productoscriticos;
		}

public function motivosdebaja(){
	$result = array();
	$bit = null;
		$this->db->select('TIPO_NOMBRE,PROD_NOMBRE,BAJA_FECHA,USU_NOMBRES,BAJA_DESC');
		$this->db->from('baja');
		$this->db->where('BAJA_INV_ID = INV_ID');
		$this->db->join('inventario','BAJA_INV_ID = INV_ID');
		$this->db->join('productos','INV_PROD_ID = PROD_ID');
		$this->db->join('tipoprod','TIPO_ID = PROD_TIPOPROD_ID');
		$this->db->join('usuario','USU_RUT = BAJA_USU_RUT');
			$consulta = $this->db->get();
			$motivosbaja = null;
				if ($consulta->num_rows()==1) {
					$motivosbaja = $consulta->row_object();
				}
				return $motivosbaja;
}

public function vidautil(){
	$result = array();
	$bit = null;
	$this->db->select('TIPO_NOMBRE,PROD_NOMBRE,PROV_NOMBRE,ING_FECHA,ING_VIDA_UTIL_PROVEEDOR,USU_NOMBRES');
	$this->db->from('ingreso');
	$this->db->join('proveedor','PROV_RUT = ING_PROV_RUT');
	$this->db->join('usuario','USU_RUT = ING_USU_RUT');
	$this->db->join('inventario','ING_ID = INV_INGRESO_ID');
	$this->db->join('productos','PROD_ID = INV_PROD_ID');
	$this->db->join('tipoprod','TIPO_NOMBRE = PROD_TIPOPROD_ID');
	
	$consulta = $this->db->get();
	$vidautilproductos = null;
	if ($consulta->num_rows()==1) {
		$vidautilproductos = $consulta->row_object();
	}
	return $vidautilproductos;
}

}


/* End of file Reporte_Model.php */
/* Location: ./application/models/Reporte_Model.php */