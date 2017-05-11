<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asignatura_Model extends CI_Model {

public function __construct()
{
parent::__construct();
}

private  $_columns  =  array(
'ASIGNATURA_ID' => 0,
'ASIGNATURA_NOMBRE' => ''
);

function get($attr){
  return $this->_columns[$attr];
}

public function create($row){
  $asignatura =  new Asignatura_Model();
  foreach ($row as $key => $value)
    {
      $asignatura->_columns[$key] = $value;
    }
  return $asignatura;
}

function insert(){
$this->db->insert('ASIGNATURA',$this->_columns);
}

function update($id, $data) {
  $asignatura = $this->db->get_where('ASIGNATURA',array('ASIGNATURA_ID'=>$id));
  if($asignatura->num_rows() > 0){
    $this->db->where('ASIGNATURA_ID', $id);
    return $this->db->update('ASIGNATURA', $data);
    }else{
  $data['ASIGNATURA_ID'] = $id;
  return $this->db->insert('ASIGNATURA',$data);
  }
}

function delete($id){
  $this->db->where('ASIGNATURA_ID',$id);
  return $this->db->delete('ASIGNATURA');
}


function findAll(){
  $result=array();
  $bit = null;
  $consulta = $this->db->get('ASIGNATURA');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

function findById($id){
  $result=array();
  $bit = null;
  $this->db->where('ASIGNATURA_ID',$id);
  $consulta = $this->db->get('ASIGNATURA');
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
