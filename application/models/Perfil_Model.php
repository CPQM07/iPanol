<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil_Model extends CI_Model {

public function __construct()
{
parent::__construct();
}

private  $_columns  =  array(
'PERFIL_ID' => 0,
'PERFIL_NOMBRE' => '',
'PERFIL_DESC' => ''
);

function get($attr){
  return $this->_columns[$attr];
}

public function create($row){
  $perfil =  new Perfil_Model();
  foreach ($row as $key => $value)
    {
      $perfil->_columns[$key] = $value;
    }
  return $perfil;
}

function insert(){
$this->db->insert('PERFIL',$this->_columns);
}

function update($id, $data) {
  $perfil = $this->db->get_where('PERFIL',array('PERFIL_ID'=>$id));
  if($perfil->num_rows() > 0){
    $this->db->where('PERFIL_ID', $id);
    return $this->db->update('PERFIL', $data);
    }else{
  $data['PERFIL_ID'] = $id;
  return $this->db->insert('PERFIL',$data);
  }
}

function delete($id){
  $this->db->where('PERFIL_ID',$id);
  return $this->db->delete('PERFIL');
}


function findAll(){
  $result=array();
  $bit = null;
  $consulta = $this->db->get('PERFIL');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

function findById($id){
  $result=array();
  $bit = null;
  $this->db->where('PERFIL_ID',$id);
  $consulta = $this->db->get('PERFIL');
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
