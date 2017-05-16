<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ingreso_Model extends CI_Model {

public function __construct()
{
  parent::__construct();
}

private  $_columns  =  array(
'ING_ID' => 0,
'ING_PROD_ID' => 0,
'ING_CANTIDAD' => '',
'ING_ORDEN_COMPRA'	=> 0,
'ING_DESC' => '',
'ING_FECHA' => '',
'ING_USU_RUT' => 0,
'ING_VIDA_ULTIL_PROVEEDOR' => 0,
'ING_PROV_RUT' => 0
);

public function get($attr){
  return $this->_columns[$attr];
}

public function create($row){
  $ingreso =  new Ingreso_Model();
  foreach ($row as $key => $value)
    {
      $ingreso->_columns[$key] = $value;
    }
  return $ingreso;
}

public function insert(){
$this->db->insert('ingreso',$this->_columns);
}

public function update($id, $data) {
  $ingreso = $this->db->get_where('ingreso',array('ING_ID'=>$id));
  if($ingreso->num_rows() > 0){
    $this->db->where('ING_ID', $id);
    return $this->db->update('ingreso', $data);
    }else{
  $data['ING_ID'] = $id;
  return $this->db->insert('ingreso',$data);
  }
}

public function delete($id){
  $this->db->where('ING_ID',$id);
  return $this->db->delete('ingreso');
}


public function findAll(){
  $result=array();
  $bit = null;
  $consulta = $this->db->get('ingreso');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

public function findById($id){
  $result=array();
  $bit = null;
  $this->db->where('ING_ID',$id);
  $consulta = $this->db->get('ingreso');
  if($consulta->num_rows() > 0){
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
    }
  }else{
    $result[] = $this->create($this->_columns);
  }
    return $result;
  }

  public function setColumns ($row = null){
    foreach ($row as $key => $value) {
      $this->columns[$key] = $value;
      }
    }
}
