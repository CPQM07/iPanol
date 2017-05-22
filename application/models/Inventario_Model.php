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
'INV_CATEGORIA_ID' => 0,
'INV_TIPO_ID' => 0,
'INV_FECHA' => '',
'INV_IMAGEN' => '',
'INV_ULTIMO_USUARIO' => 0
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
    $result = null;
    $this->db->where('INV_ID',$id);
    $consulta = $this->db->get('inventario');
    if($consulta->num_rows() == 1){
      $result = $this->create($consulta->row());
    }
    
    return $result;
  }

  public function findByArray($myarray = null){
    $this->load->database();
    $res = $this->db->get_where('inventario',$myarray);
    $result = array();
       foreach ($res->result() as $row) {
        $result[] = $this->create($row);
        }
      return $result;
  }


//SELECT * FROM `inventario` WHERE (`INV_PROD_ID` = 1 or `INV_PROD_ID` =2) and (`INV_PROD_ESTADO` = 1)

  public function findByArrayIN($arraydeIDinv = null,$arraycondiciones = null){
    $this->load->database();
    $this->db->get('inventario');
    $this->db->or_where_in('INV_PROD_ID',$arraydeIDinv);
    $res = $this->db->get_where('inventario',$arraycondiciones);
    $result = array();
       foreach ($res->result() as $row) {
        $result[] = $this->create($row);
        }
      return $result;
  }

  public function setColumns ($row = null){
    foreach ($row as $key => $value) {
      $this->columns[$key] = $value;
      }
    }
}
