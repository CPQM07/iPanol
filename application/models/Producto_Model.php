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

public function get($attr){
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

public function insert(){
$this->db->insert('producto',$this->_columns);
}

public function update($id, $data) {
  $producto = $this->db->get_where('producto',array('PROD_ID'=>$id));
  if($producto->num_rows() > 0){
    $this->db->where('PROD_ID', $id);
    return $this->db->update('producto', $data);
    }else{
  $data['PROD_ID'] = $id;
  return $this->db->insert('producto',$data);
  }
}

public function delete($id){
  $this->db->where('PROD_ID',$id);
  return $this->db->delete('producto');
}


public function findAll(){
  $result=array();
  $bit = null;
  $consulta = $this->db->get('productos');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

public function findById($id){
    $result = null;
    $this->db->where('PROD_ID',$id);
    $consulta = $this->db->get('productos');
    if($consulta->num_rows() == 1){
      $result = $this->create($consulta->row());
    }
    
    return $result;
  }

  public function setColumns ($row = null){
    foreach ($row as $key => $value) {
      $this->columns[$key] = $value;
      }
    }


      public function findByCat($id){
      $result=array();
      $bit = null;
          $this->db->where('PROD_CAT_ID',$id);
      $consulta = $this->db->get('productos');
        foreach ($consulta->result() as $row) {
        $result[] = $this->create($row);
      }
      return $result;
    }

     public function findByTipProd($id){
      $result=array();
      $bit = null;
          $this->db->where('PROD_TIPOPROD_ID',$id);
      $consulta = $this->db->get('productos');
        foreach ($consulta->result() as $row) {
        $result[] = $this->create($row);
      }
      return $result;
    }
}
