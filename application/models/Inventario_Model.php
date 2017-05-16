<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario_Model extends CI_Model {

public function __construct()
{
parent::__construct();
}

private  $_columns  =  array(
'INV_ID' => 0,
'INV_PROD_ID' => 0,
'INV_PROD_NOM' => '',
'INV_PROD_CANTIDAD'	=> 0,
'INV_PROD_ESTADO'	=> 0,
'INV_PROD_CODIGO' => '',
'INV_INGRESO_ID' => 0,
'INV_FECHA' => '',
'INV_IMAGEN' => ''
);

public function get($attr){
  return $this->_columns[$attr];
}

public function create($row){
  $inventario =  new Inventario_Model();
  foreach ($row as $key => $value)
    {
      $inventario->_columns[$key] = $value;
    }
  return $inventario;
}

public function insert(){
$this->db->insert('inventario',$this->_columns);
}

public function update($id, $data) {
  $inventario = $this->db->get_where('inventario',array('INV_ID'=>$id));
  if($inventario->num_rows() > 0){
    $this->db->where('INV_ID', $id);
    return $this->db->update('inventario', $data);
    }else{
  $data['INV_ID'] = $id;
  return $this->db->insert('inventario',$data);
  }
}

public function delete($id){
  $this->db->where('INV_ID',$id);
  return $this->db->delete('inventario');
}


public function findAll(){
  $result=array();
  $bit = null;
  $consulta = $this->db->get('inventario');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

public function findById($id){
  $result=array();
  $bit = null;
  $this->db->where('INV_ID',$id);
  $consulta = $this->db->get('inventario');
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
