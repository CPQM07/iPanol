<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto_Model extends CI_Model {

public function __construct()
{
parent::__construct();
}

private  $_columns  =  array(
'PROD_ID' => 0,
'PROD_NOMBRE' => 0,
'PROD_STOCK_TOTAL' => 0,
'PROD_STOCK_CRITICO' => 0,
'PROD_CAT_ID' => 0,
'PROD_TIPOPROD_ID' => 0,
'PROD_POSICION' => '',
'PROD_PRIORIDAD' => 0,
'PROD_STOCK_OPTIMO' => 0,
'PROD_DIAS_ANTIC' => 0,
'PROD_IMAGEN' => ''
);

function get($attr){
  return $this->_columns[$attr];
}

public function create($row){
  $producto =  new Producto_Model();
  foreach ($row as $key => $value)
    {
      $producto->_columns[$key] = $value;
    }
  return $producto;
}

function insert(){
$this->db->insert('PERMISO',$this->_columns);
}

function update($id, $data) {
  $producto = $this->db->get_where('PERMISO',array('PROD_ID'=>$id));
  if($producto->num_rows() > 0){
    $this->db->where('PROD_ID', $id);
    return $this->db->update('PERMISO', $data);
    }else{
  $data['PROD_ID'] = $id;
  return $this->db->insert('PERMISO',$data);
  }
}

function delete($id){
  $this->db->where('PROD_ID',$id);
  return $this->db->delete('PERMISO');
}


function findAll(){
  $result=array();
  $bit = null;
  $consulta = $this->db->get('PERMISO');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

function findById($id){
  $result=array();
  $bit = null;
  $this->db->where('PROD_ID',$id);
  $consulta = $this->db->get('PERMISO');
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
