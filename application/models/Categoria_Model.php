<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria_Model extends CI_Model {

public function __construct()
{
parent::__construct();
}

private  $_columns  =  array(
'CAT_ID' => 0,
'CAT_NOMBRE' => '',
'CAT_DESC' => '',
'CAT_CODIGO' => 0
);

function get($attr){
  return $this->_columns[$attr];
}

public function create($row){
  $categoria =  new Categoria_Model();
  foreach ($row as $key => $value)
    {
      $categoria->_columns[$key] = $value;
    }
  return $categoria;
}

function insert(){
$this->db->insert('CATEGORIA',$this->_columns);
}

function update($id, $data) {
  $categoria = $this->db->get_where('CATEGORIA',array('CAT_ID'=>$id));
  if($categoria->num_rows() > 0){
    $this->db->where('CAT_ID', $id);
    return $this->db->update('CATEGORIA', $data);
    }else{
  $data['CAT_ID'] = $id;
  return $this->db->insert('CATEGORIA',$data);
  }
}

public function delete($id){
  $this->db->where('CAT_ID',$id);
  return $this->db->delete('CATEGORIA');
}


public function findAll(){
  $result=array();
  $bit = null;
  $consulta = $this->db->get('CATEGORIA');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

public function findById($id){
  $result=array();
  $bit = null;
  $this->db->where('CAT_ID',$id);
  $consulta = $this->db->get('CATEGORIA');
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
