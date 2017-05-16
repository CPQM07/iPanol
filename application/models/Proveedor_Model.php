<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedor_Model extends CI_Model {

public function __construct()
{
parent::__construct();
}

private  $_columns  =  array(
'PROV_RUT' => 0,
'PROV_DV' => 0,
'PROV_NOMBRE' => '',
'PROV_RSOCIAL' => ''
);

public function get($attr){
  return $this->_columns[$attr];
}

public function create($row){
  $proveedor =  new Proveedor_Model();
  foreach ($row as $key => $value)
    {
      $proveedor->_columns[$key] = $value;
    }
  return $proveedor;
}

public function insert(){
$this->db->insert('PROVEEDOR',$this->_columns);
}

public function update($id, $data) {
  $proveedor = $this->db->get_where('PROVEEDOR',array('PROV_RUT'=>$id));
  if($proveedor->num_rows() > 0){
    $this->db->where('PROV_RUT', $id);
    return $this->db->update('PROVEEDOR', $data);
    }else{
  $data['PROV_RUT'] = $id;
  return $this->db->insert('PROVEEDOR',$data);
  }
}

public function delete($id){
  $this->db->where('PROV_RUT',$id);
  return $this->db->delete('PROVEEDOR');
}


public function findAll(){
  $result=array();
  $bit = null;
  $consulta = $this->db->get('PROVEEDOR');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

public function findById($id){
  $result=array();
  $bit = null;
  $this->db->where('PROV_RUT',$id);
  $consulta = $this->db->get('PROVEEDOR');
  if($consulta->num_rows() > 0){
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
    }
  }else{
    $result[] = $this->create($this->_columns);
  }
    return $result;
  }
}
