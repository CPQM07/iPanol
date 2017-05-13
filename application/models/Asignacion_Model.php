<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asignacion_Model extends CI_Model {

public function __construct()
{
parent::__construct();
}

private  $_columns  =  array(
'ASIG_ID' => 0,
'ASIG_ESTADO' => 0,
'ASIG_DETSOL_ID' => 0,
'ASIG_INV_ID' => 0,
'ASIG_FECHA' => ''
);

function get($attr){
  return $this->_columns[$attr];
}

public function create($row){
  $asignacion =  new Asignacion_Model();
  foreach ($row as $key => $value)
    {
      $asignacion->_columns[$key] = $value;
    }
  return $asignacion;
}

function insert(){
$this->db->insert('ASIGNACION',$this->_columns);
}

function update($id, $data) {
  $asignacion = $this->db->get_where('ASIGNACION',array('ASIG_ID'=>$id));
  if($asignacion->num_rows() > 0){
    $this->db->where('ASIG_ID', $id);
    return $this->db->update('ASIGNACION', $data);
    }else{
  $data['ASIG_ID'] = $id;
  return $this->db->insert('ASIGNACION',$data);
  }
}

function delete($id){
  $this->db->where('ASIG_ID',$id);
  return $this->db->delete('ASIGNACION');
}


function findAll(){
  $result=array();
  $bit = null;
  $consulta = $this->db->get('ASIGNACION');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

function findById($id){
  $result=array();
  $bit = null;
  $this->db->where('ASIG_ID',$id);
  $consulta = $this->db->get('ASIGNACION');
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
