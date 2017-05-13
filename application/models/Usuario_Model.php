<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Model extends CI_Model {

public function __construct()
{
parent::__construct();
}

private  $_columns  =  array(
'USU_RUT' => 0,
'USU_DV' => 0,
'USU_NOMBRES' => '',
'USU_APELLIDOS' => '',
'USU_CARGO_ID' => 0,
'USU_CARRERA_ID' => 0,
'USU_EMAIL' => '',
'USU_TELEFONO1' => 0,
'USU_TELEFONO2' => 0,
'USU_CLAVE' => '',
'USU_ESTADO' => 0

);

function get($attr){
  return $this->_columns[$attr];
}

public function create($row){
  $usuario =  new Usuario_Model();
  foreach ($row as $key => $value)
    {
      $usuario->_columns[$key] = $value;
    }
  return $usuario;
}

function insert(){
$this->db->insert('USUARIO',$this->_columns);
}

function update($id, $data) {
  $usuario = $this->db->get_where('USUARIO',array('USU_RUT'=>$id));
  if($usuario->num_rows() > 0){
    $this->db->where('USU_RUT', $id);
    return $this->db->update('USUARIO', $data);
    }else{
  $data['USU_RUT'] = $id;
  return $this->db->insert('USUARIO',$data);
  }
}

function delete($id){
  $this->db->where('USU_RUT',$id);
  return $this->db->delete('USUARIO');
}


function findAll(){
  $result=array();
  $bit = null;
  $consulta = $this->db->get('USUARIO');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

function findById($id){
  $result=array();
  $bit = null;
  $this->db->where('USU_RUT',$id);
  $consulta = $this->db->get('USUARIO');
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
