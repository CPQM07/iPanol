<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Observaciones_Model extends CI_Model {

public function __construct()
{
parent::__construct();
}

private  $_columns  =  array(
'OBS_ID' => 0,
'OBS_TEXTO' => '',
'OBS_BAJA_ID' => 0,
'OBS_FECHA' => ''
);

public function get($attr){
  return $this->_columns[$attr];
}

public function create($row){
  $observaciones =  new Observaciones_Model();
  foreach ($row as $key => $value)
    {
      $observaciones->_columns[$key] = $value;
    }
  return $observaciones;
}

public function insert(){
$this->db->insert('OBSERVACIONES',$this->_columns);
}

public function update($id, $data) {
  $observaciones = $this->db->get_where('OBSERVACIONES',array('OBS_ID'=>$id));
  if($observaciones->num_rows() > 0){
    $this->db->where('OBS_ID', $id);
    return $this->db->update('OBSERVACIONES', $data);
    }else{
  $data['OBS_ID'] = $id;
  return $this->db->insert('OBSERVACIONES',$data);
  }
}

public function delete($id){
  $this->db->where('OBS_ID',$id);
  return $this->db->delete('OBSERVACIONES');
}


public function findAll(){
  $result=array();
  $bit = null;
  $consulta = $this->db->get('OBSERVACIONES');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

public function findById($id){
  $result=array();
  $bit = null;
  $this->db->where('OBS_ID',$id);
  $consulta = $this->db->get('OBSERVACIONES');
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
