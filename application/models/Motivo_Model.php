<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Motivo_Model extends CI_Model {

public function __construct()
{
parent::__construct();
}

private  $_columns  =  array(
'MOT_ID' => 0,
'MOT_NOMBRE' => ''
);

function get($attr){
  return $this->_columns[$attr];
}

public function create($row){
  $motivo =  new Motivo_Model();
  foreach ($row as $key => $value)
    {
      $motivo->_columns[$key] = $value;
    }
  return $motivo;
}

function insert(){
$this->db->insert('MOTIVO',$this->_columns);
}

function update($id, $data) {
  $motivo = $this->db->get_where('MOTIVO',array('MOT_ID'=>$id));
  if($motivo->num_rows() > 0){
    $this->db->where('MOT_ID', $id);
    return $this->db->update('MOTIVO', $data);
    }else{
  $data['MOT_ID'] = $id;
  return $this->db->insert('MOTIVO',$data);
  }
}

function delete($id){
  $this->db->where('MOT_ID',$id);
  return $this->db->delete('MOTIVO');
}


function findAll(){
  $result=array();
  $bit = null;
  $consulta = $this->db->get('MOTIVO');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

function findById($id){
  $result=array();
  $bit = null;
  $this->db->where('MOT_ID',$id);
  $consulta = $this->db->get('MOTIVO');
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
