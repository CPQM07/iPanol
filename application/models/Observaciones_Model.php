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
'OBS_FECHA' => '',
'OBS_MOT_ID' => 0,
'OBS_MOT_NOMBRE' => ''
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
$this->db->insert('observaciones',$this->_columns);
return $this->db->insert_id();
}

public function update($id, $data) {
  $observaciones = $this->db->get_where('observaciones',array('OBS_ID'=>$id));
  if($observaciones->num_rows() > 0){
    $this->db->where('OBS_ID', $id);
    return $this->db->update('observaciones', $data);
    }else{
  $data['OBS_ID'] = $id;
  return $this->db->insert('observaciones',$data);
  }
}

public function delete($id){
  $this->db->where('OBS_ID',$id);
  return $this->db->delete('observaciones');
}

public function findByArray($myarray = null){
  $this->load->database();
  $this->db->order_by('OBS_ID', 'ASC'); // or 'DESC'
  $res = $this->db->get_where('observaciones',$myarray);
  $result = null;
  foreach ($res->result_array() as $row) {
    $result[] = $row;
  }
  return $result;
}


public function findAll(){
  $result=array();
  $bit = null;
  $consulta = $this->db->get('observaciones');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

public function findById($id){
  $result=array();
  $bit = null;
  $this->db->where('OBS_ID',$id);
  $consulta = $this->db->get('observaciones');
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
      $this->_columns[$key] = $value;
      }
    }
}
