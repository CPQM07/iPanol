<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetSolicitud_Model extends CI_Model {

public function __construct()
{
parent::__construct();
}

private  $_columns  =  array(
'DETSOL_ID' => 0,
'DETSOL_TIPOPROD' => 0,
'DETSOL_CANTIDAD' => 0,
'DETSOL_ESTADO' => 0,
'DETSOL_SOL_ID' => 0,
'DETSOL_PROD_ID' => 0,
);

public function get($attr){
  return $this->_columns[$attr];
}

public function create($row){
  $detalle =  new DetSolicitud_Model();
  foreach ($row as $key => $value)
    {
      $detalle->_columns[$key] = $value;
    }
  return $detalle;
}

public function findByArray($myarray = null){
  $this->load->database();
  $res = $this->db->get_where('detallesol',$myarray);
  //$this->db->order_by('SOL_ID', 'ASC');
  $result = array();
  foreach ($res->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

public function insert(){
$this->db->insert('detallesol',$this->_columns);
return $this->db->insert_id();
}

public function update($id, $data) {
  $detalle = $this->db->get_where('detallesol',array('DETSOL_ID'=>$id));
  if($detalle->num_rows() > 0){
    $this->db->where('DETSOL_ID', $id);
    return $this->db->update('detallesol', $data);
    }else{
  $data['DETSOL_ID'] = $id;
  return $this->db->insert('detallesol',$data);
  }
}

public function delete($id){
  $this->db->where('DETSOL_ID',$id);
  return $this->db->delete('detallesol');
}


public function findAll(){
  $result=array();
  $bit = null;
  $consulta = $this->db->get('detallesol');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

public function getAllIdProductGroupByIdSolicitud($idsol){
   $result = array();
    $querry = $this->db->query('SELECT detallesol.DETSOL_PROD_ID from detallesol join solicitud ON solicitud.SOL_ID = detallesol.DETSOL_SOL_ID WHERE solicitud.SOL_ID ='.$idsol.' GROUP by DETSOL_PROD_ID');
    foreach ($querry->result_array() as $data) {
      $result[] = $data['DETSOL_PROD_ID'];  
    }
    return $result;
}

public function findById($id){
  $result=array();
  $bit = null;
  $this->db->where('DETSOL_ID',$id);
  $consulta = $this->db->get('detallesol');
  if($consulta->num_rows() > 0){
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
    }
  }else{
    $result[] = $this->create($this->_columns);
  }
    return $result;
  }
  
  public function count0(){/*contador Solicitudes pendientes por recepcionar*/
    $this->db->where('SOL_ESTADO',3);
    $this->db->or_where('SOL_ESTADO',5);
    $consulta = $this->db->get('solicitud');
    return $consulta->num_rows();
  }

  public function count1(){/*contador Solicitudes pendientes sin asignación*/
    $this->db->where('SOL_ESTADO',1);
    $consulta = $this->db->get('solicitud');
    return $consulta->num_rows();
  }

  public function count2(){ /*contador productosBaja*/
    $cont1 = $this->db->from('inventario');
    $this->db->where('INV_PROD_ESTADO',0);
    $obj1 = $cont1->count_all_results();
    return $obj1;
  }

  public function parciales(){ /*solicitudes parciales*/
    $cont1 = $this->db->from('solicitud');
    $this->db->where('SOL_ESTADO',7);
    $obj1 = $cont1->count_all_results();
    return $obj1;
  }

  public function productoActivoHoy(){ /*CANTIDAD PRODUCTOS ACTIVOS HOY*/
    date_default_timezone_set("Chile/Continental");
    $inicio = date ("Y-m-d",time());
    $this->db->select('INV_TIPO_ID');
    $this->db->from('asignacion');
    $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
    $this->db->where('asignacion.ASIG_FECHA<',$inicio." "."23:59:59");
    $this->db->where('asignacion.ASIG_FECHA>',$inicio." "."00:00:00");
    $this->db->where('inventario.INV_TIPO_ID',1);
    $result = $this->db->get();
    return $result->num_rows();
  }

  public function productoActivoAyer(){ /*CANTIDAD PRODUCTOS ACTIVOS AYER*/
    date_default_timezone_set("Chile/Continental");
    $fecha = date ("Y-m-d",time());
    $inicio = strtotime('-1 day', strtotime($fecha));
    $inicio = date('Y-m-d',$inicio);
    $this->db->select('INV_TIPO_ID');
    $this->db->from('asignacion');
    $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
    $this->db->where('asignacion.ASIG_FECHA<',$inicio." "."23:59:59");
    $this->db->where('asignacion.ASIG_FECHA>',$inicio." "."00:00:00");
    $this->db->where('inventario.INV_TIPO_ID',1);
    $result = $this->db->get();
    return $result->num_rows();
  }

  public function productoActivoAyer2(){ /*CANTIDAD PRODUCTOS ACTIVOS AYER*/
    date_default_timezone_set("Chile/Continental");
    $fecha = date ("Y-m-d",time());
    $inicio = strtotime('-2 day', strtotime($fecha));
    $inicio = date('Y-m-d',$inicio);
    $this->db->select('INV_TIPO_ID');
    $this->db->from('asignacion');
    $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
    $this->db->where('asignacion.ASIG_FECHA<',$inicio." "."23:59:59");
    $this->db->where('asignacion.ASIG_FECHA>',$inicio." "."00:00:00");
    $this->db->where('inventario.INV_TIPO_ID',1);
    $result = $this->db->get();
    return $result->num_rows();
  }

  public function productoActivoAyer3(){ /*CANTIDAD PRODUCTOS ACTIVOS AYER*/
    date_default_timezone_set("Chile/Continental");
    $fecha = date ("Y-m-d",time());
    $inicio = strtotime('-3 day', strtotime($fecha));
    $inicio = date('Y-m-d',$inicio);
    $this->db->select('INV_TIPO_ID');
    $this->db->from('asignacion');
    $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
    $this->db->where('asignacion.ASIG_FECHA<',$inicio." "."23:59:59");
    $this->db->where('asignacion.ASIG_FECHA>',$inicio." "."00:00:00");
    $this->db->where('inventario.INV_TIPO_ID',1);
    $result = $this->db->get();
    return $result->num_rows();
  }

  public function productoActivoAyer4(){ /*CANTIDAD PRODUCTOS ACTIVOS AYER*/
    date_default_timezone_set("Chile/Continental");
    $fecha = date ("Y-m-d",time());
    $inicio = strtotime('-4 day', strtotime($fecha));
    $inicio = date('Y-m-d',$inicio);
    $this->db->select('INV_TIPO_ID');
    $this->db->from('asignacion');
    $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
    $this->db->where('asignacion.ASIG_FECHA<',$inicio." "."23:59:59");
    $this->db->where('asignacion.ASIG_FECHA>',$inicio." "."00:00:00");
    $this->db->where('inventario.INV_TIPO_ID',1);
    $result = $this->db->get();
    return $result->num_rows();
  }

  public function productoActivoAyer5(){ /*CANTIDAD PRODUCTOS ACTIVOS AYER*/
    date_default_timezone_set("Chile/Continental");
    $fecha = date ("Y-m-d",time());
    $inicio = strtotime('-5 day', strtotime($fecha));
    $inicio = date('Y-m-d',$inicio);
    $this->db->select('INV_TIPO_ID');
    $this->db->from('asignacion');
    $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
    $this->db->where('asignacion.ASIG_FECHA<',$inicio." "."23:59:59");
    $this->db->where('asignacion.ASIG_FECHA>',$inicio." "."00:00:00");
    $this->db->where('inventario.INV_TIPO_ID',1);
    $result = $this->db->get();
    return $result->num_rows();
  }

  public function productoActivoAyer6(){ /*CANTIDAD PRODUCTOS ACTIVOS AYER*/
    date_default_timezone_set("Chile/Continental");
    $fecha = date ("Y-m-d",time());
    $inicio = strtotime('-6 day', strtotime($fecha));
    $inicio = date('Y-m-d',$inicio);
    $this->db->select('INV_TIPO_ID');
    $this->db->from('asignacion');
    $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
    $this->db->where('asignacion.ASIG_FECHA<',$inicio." "."23:59:59");
    $this->db->where('asignacion.ASIG_FECHA>',$inicio." "."00:00:00");
    $this->db->where('inventario.INV_TIPO_ID',1);
    $result = $this->db->get();
    return $result->num_rows();
  }

  /*-------------------------------------------------------------------------------------*/

  public function productoFungiblesHoy(){ /*CANTIDAD PRODUCTOS FUNGIBLES HOY*/
    date_default_timezone_set("Chile/Continental");
    $inicio = date ("Y-m-d H:i:s",time());/*OPCION2*/
    $this->db->select('INV_TIPO_ID');
    $this->db->from('asignacion');
    $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
    $this->db->where('asignacion.ASIG_FECHA<',$inicio." "."23:59:59");
    $this->db->where('asignacion.ASIG_FECHA>',$inicio." "."00:00:00");
    $this->db->where('inventario.INV_TIPO_ID',2);
    $result = $this->db->get();
    return $result->num_rows();
  }

  public function productoFungiblesAyer(){ /*CANTIDAD PRODUCTOS FUNGIBLES AYER*/
    date_default_timezone_set("Chile/Continental");
    $fecha = date ("Y-m-d",time());
    $inicio = strtotime('-1 day', strtotime($fecha));
    $inicio = date('Y-m-d',$inicio);
    $this->db->select('INV_TIPO_ID');
    $this->db->from('asignacion');
    $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
    $this->db->where('asignacion.ASIG_FECHA<',$inicio." "."23:59:59");
    $this->db->where('asignacion.ASIG_FECHA>',$inicio." "."00:00:00");
    $this->db->where('inventario.INV_TIPO_ID',2);
    $result = $this->db->get();
    return $result->num_rows();
  }

  public function productoFungiblesAyer2(){ /*CANTIDAD PRODUCTOS FUNGIBLES AYER*/
    date_default_timezone_set("Chile/Continental");
    $fecha = date ("Y-m-d",time());
    $inicio = strtotime('-2 day', strtotime($fecha));
    $inicio = date('Y-m-d',$inicio);
    $this->db->select('INV_TIPO_ID');
    $this->db->from('asignacion');
    $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
    $this->db->where('asignacion.ASIG_FECHA<',$inicio." "."23:59:59");
    $this->db->where('asignacion.ASIG_FECHA>',$inicio." "."00:00:00");
    $this->db->where('inventario.INV_TIPO_ID',2);
    $result = $this->db->get();
    return $result->num_rows();
  }

  public function productoFungiblesAyer3(){ /*CANTIDAD PRODUCTOS FUNGIBLES AYER*/
    date_default_timezone_set("Chile/Continental");
    $fecha = date ("Y-m-d",time());
    $inicio = strtotime('-3 day', strtotime($fecha));
    $inicio = date('Y-m-d',$inicio);
    $this->db->select('INV_TIPO_ID');
    $this->db->from('asignacion');
    $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
    $this->db->where('asignacion.ASIG_FECHA<',$inicio." "."23:59:59");
    $this->db->where('asignacion.ASIG_FECHA>',$inicio." "."00:00:00");
    $this->db->where('inventario.INV_TIPO_ID',2);
    $result = $this->db->get();
    return $result->num_rows();
  }

  public function productoFungiblesAyer4(){ /*CANTIDAD PRODUCTOS FUNGIBLES AYER*/
    date_default_timezone_set("Chile/Continental");
    $fecha = date ("Y-m-d",time());
    $inicio = strtotime('-4 day', strtotime($fecha));
    $inicio = date('Y-m-d',$inicio);
    $this->db->select('INV_TIPO_ID');
    $this->db->from('asignacion');
    $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
    $this->db->where('asignacion.ASIG_FECHA<',$inicio." "."23:59:59");
    $this->db->where('asignacion.ASIG_FECHA>',$inicio." "."00:00:00");
    $this->db->where('inventario.INV_TIPO_ID',2);
    $result = $this->db->get();
    return $result->num_rows();
  }

  public function productoFungiblesAyer5(){ /*CANTIDAD PRODUCTOS FUNGIBLES AYER*/
    date_default_timezone_set("Chile/Continental");
    $fecha = date ("Y-m-d",time());
    $inicio = strtotime('-5 day', strtotime($fecha));
    $inicio = date('Y-m-d',$inicio);
    $this->db->select('INV_TIPO_ID');
    $this->db->from('asignacion');
    $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
    $this->db->where('asignacion.ASIG_FECHA<',$inicio." "."23:59:59");
    $this->db->where('asignacion.ASIG_FECHA>',$inicio." "."00:00:00");
    $this->db->where('inventario.INV_TIPO_ID',2);
    $result = $this->db->get();
    return $result->num_rows();
  }

  public function productoFungiblesAyer6(){ /*CANTIDAD PRODUCTOS FUNGIBLES AYER*/
    date_default_timezone_set("Chile/Continental");
    $fecha = date ("Y-m-d",time());
    $inicio = strtotime('-6 day', strtotime($fecha));
    $inicio = date('Y-m-d',$inicio);
    $this->db->select('INV_TIPO_ID');
    $this->db->from('asignacion');
    $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
    $this->db->where('asignacion.ASIG_FECHA<',$inicio." "."23:59:59");
    $this->db->where('asignacion.ASIG_FECHA>',$inicio." "."00:00:00");
    $this->db->where('inventario.INV_TIPO_ID',2);
    $result = $this->db->get();
    return $result->num_rows();
  }


  public function setColumns ($row = null){
    foreach ($row as $key => $value) {
      $this->columns[$key] = $value;
      }
    }
    
}
