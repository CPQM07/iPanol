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

public function get($attr){
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

public function insert(){
$this->db->insert('asignatura',$this->_columns);
}

public function update($id, $data) {
  $asignatura = $this->db->get_where('asignatura',array('ASIGNATURA_ID'=>$id));
  if($asignatura->num_rows() > 0){
    $this->db->where('ASIGNATURA_ID', $id);
    return $this->db->update('asignatura', $data);
    }else{
  $data['ASIGNATURA_ID'] = $id;
  return $this->db->insert('asignatura',$data);
  }
}

public function delete($id){
  $this->db->where('ASIGNATURA_ID',$id);
  return $this->db->delete('asignatura');
}


public function findAll(){
  $result=array();
  $bit = null;
  $consulta = $this->db->get('asignatura');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

public function findById($id){
  $result=array();
  $bit = null;
  $this->db->where('ASIGNATURA_ID',$id);
  $consulta = $this->db->get('asignatura');
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
