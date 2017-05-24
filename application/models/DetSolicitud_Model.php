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

public function insertlog($arraycolumns){
  $this->db->insert('logestadosolicitud',$arraycolumns);
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
  
  public function count0(){/*contador solicitudPendiendeRecepcionar*/
    $this->db->where('SOL_ESTADO',1);
    $consulta = $this->db->get('solicitud');
    return $consulta->num_rows();
  }

  public function count1(){/*contador solicitudPendiendeRecepcionar*/
    $this->db->where('ASIG_ESTADO',3);
    $consulta = $this->db->get('asignacion');
    return $consulta->num_rows();
  }

  public function count2(){ /*contador productosBaja*/
    $cont1 = $this->db->from('baja');
    $obj1 = $cont1->count_all_results();
    return $obj1;
  }

  public function solicitudesHoy() /*CANTIDAD DE SOLICITUDES DE HOY*/
  {
    $inicio;
    $f = getDate();
    $ano = $f['year'];
    $mes = $f['mon'];
    $dia = $f['mday'];

    if ($mes > 0 and $mes < 10 || $dia > 0 and $dia < 10) {
      $mes = '0'.$mes;
      $dia = '0'.$dia;
      $inicio = $ano.'-'.$mes.'-'.$dia.' '.'00:00:00';
    }else{
      $inicio = $ano.'-'.$mes.'-'.$dia.' '.'00:00:00';
    }

    $this->db->where('SOL_FECHA_INICIO',$inicio);
    $consult = $this->db->get('solicitud');
    return $consult->num_rows();
  }

  public function productoActivoHoy(){ /*CANTIDAD PRODUCTOS ACTIVOS HOY*/
    $inicio;
    $f = getDate();
    $ano = $f['year'];
    $mes = date('m');
    $dia = $f['mday'];

    if ($dia > 0 and $dia < 10) {
      $dia = '0'.$dia;
      $inicio = $ano.'-'.$mes.'-'.$dia.' '.'00:00:00';
    }else{
      $inicio = $ano.'-'.$mes.'-'.$dia.' '.'00:00:00';
    }
    $this->db->select('INV_TIPO_ID');
    $this->db->from('solicitud');
    $this->db->join('asignacion', 'asignacion.ASIG_SOL_ID = solicitud.SOL_ID');
    $this->db->join('inventario', 'inventario.INV_ID = asignacion.ASIG_INV_ID');
    $this->db->where('solicitud.SOL_FECHA_INICIO',$inicio);
    $this->db->where('solicitud.SOL_ESTADO',5);
    $this->db->where('inventario.INV_TIPO_ID',1);
    $result = $this->db->get();
    return $result->num_rows();
  }

  public function productoActivoAyer(){ /*CANTIDAD PRODUCTOS ACTIVOS AYER*/
    $inicio;
    $f = getDate();
    $ano = $f['year'];
    $mes = date('m');
    $nel = $f['mday'];
    $dia = $nel-1;

    if ($dia > 0 and $dia < 10) {
      $dia = '0'.$dia;
      $inicio = $ano.'-'.$mes.'-'.$dia.' '.'00:00:00';
    }else{
      $inicio = $ano.'-'.$mes.'-'.$dia.' '.'00:00:00';
    }
    $this->db->select('INV_TIPO_ID');
    $this->db->from('solicitud');
    $this->db->join('asignacion', 'asignacion.ASIG_SOL_ID = solicitud.SOL_ID');
    $this->db->join('inventario', 'inventario.INV_ID = asignacion.ASIG_INV_ID');
    $this->db->where('solicitud.SOL_FECHA_INICIO',$inicio);
    $this->db->where('solicitud.SOL_ESTADO',5);
    $this->db->where('inventario.INV_TIPO_ID',1);
    $result = $this->db->get();
    return $result->num_rows();
  }

  /*-------------------------------------------------------------------------------------*/

  public function productoFungiblesHoy(){ /*CANTIDAD PRODUCTOS FUNGIBLES HOY*/
    $inicio;
    $f = getDate();
    $ano = $f['year'];
    $mes = date('m');
    $dia = $f['mday'];

    if ($dia > 0 and $dia < 10) {
      $dia = '0'.$dia;
      $inicio = $ano.'-'.$mes.'-'.$dia.' '.'00:00:00';
    }else{
      $inicio = $ano.'-'.$mes.'-'.$dia.' '.'00:00:00';
    }
    $this->db->select('INV_TIPO_ID');
    $this->db->from('solicitud');
    $this->db->join('asignacion', 'asignacion.ASIG_SOL_ID = solicitud.SOL_ID');
    $this->db->join('inventario', 'inventario.INV_ID = asignacion.ASIG_INV_ID');
    $this->db->where('solicitud.SOL_FECHA_INICIO',$inicio);
    $this->db->where('solicitud.SOL_ESTADO',5);
    $this->db->where('inventario.INV_TIPO_ID',2);
    $result = $this->db->get();
    return $result->num_rows();
  }

  public function productoFungiblesAyer(){ /*CANTIDAD PRODUCTOS FUNGIBLES AYER*/
    $inicio;
    $f = getDate();
    $ano = $f['year'];
    $mes = date('m');
    $nel = $f['mday'];
    $dia = $nel-1;

    if ($dia > 0 and $dia < 10) {
      $dia = '0'.$dia;
      $inicio = $ano.'-'.$mes.'-'.$dia.' '.'00:00:00';
    }else{
      $inicio = $ano.'-'.$mes.'-'.$dia.' '.'00:00:00';
    }
    $this->db->select('INV_TIPO_ID');
    $this->db->from('solicitud');
    $this->db->join('asignacion', 'asignacion.ASIG_SOL_ID = solicitud.SOL_ID');
    $this->db->join('inventario', 'inventario.INV_ID = asignacion.ASIG_INV_ID');
    $this->db->where('solicitud.SOL_FECHA_INICIO',$inicio);
    $this->db->where('solicitud.SOL_ESTADO',5);
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
