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
'ASIG_FECHA' => '',
'ASIG_CANT' => ''
);

public function get($attr){
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

public function insert(){
$this->db->insert('asignacion',$this->_columns);
return $this->db->insert_id();
}

public function update($id, $data) {
  $asignacion = $this->db->get_where('asignacion',array('ASIG_ID'=>$id));
  if($asignacion->num_rows() > 0){
    $this->db->where('ASIG_ID', $id);
    return $this->db->update('asignacion', $data);
    }else{
  $data['ASIG_ID'] = $id;
  return $this->db->insert('asignacion',$data);
  }
}

public function delete($id){
  $this->db->where('ASIG_ID',$id);
  return $this->db->delete('asignacion');
}


public function findAll(){
  $result=array();
  $bit = null;
  $consulta = $this->db->get('asignacion');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

public function findById($id){
  $result=array();
  $bit = null;
  $this->db->where('ASIG_ID',$id);
  $consulta = $this->db->get('asignacion');
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
