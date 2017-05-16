<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carrera_Model extends CI_Model {

public function __construct()
{
parent::__construct();
}

private  $_columns  =  array(

'CARRERA_ID' => 0,
'CARRERA_NOMBRE' => '',
'CARRERA_DESCRIPCION' => ''
);

public function get($attr){
  return $this->_columns[$attr];
}

public function create($row){
  $carrera =  new Carrera_Model();
  foreach ($row as $key => $value)
    {
      $carrera->_columns[$key] = $value;
    }
  return $carrera;
}

public function insert(){
$this->db->insert('CARRERA',$this->_columns);
}

public function update($id, $data) {
  $carrera = $this->db->get_where('CARRERA',array('CARRERA_ID'=>$id));
  if($carrera->num_rows() > 0){
    $this->db->where('CARRERA_ID', $id);
    return $this->db->update('CARRERA', $data);
    }else{
  $data['CARRERA_ID'] = $id;
  return $this->db->insert('CARRERA',$data);
  }
}

public function delete($id){
  $this->db->where('CARRERA_ID',$id);
  return $this->db->delete('CARRERA');
}


public function findAll(){
  $result=array();
  $bit = null;
  $consulta = $this->db->get('CARRERA');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

public function findById($id){
  $result=array();
  $bit = null;
  $this->db->where('CARRERA_ID',$id);
  $consulta = $this->db->get('CARRERA');
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
