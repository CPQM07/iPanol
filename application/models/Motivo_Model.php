<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Motivo_Model extends CI_Model {

public function __construct()
{
parent::__construct();
}

private  $_columns  =  array(
'MOT_ID' => 0,
'MOT_NOMBRE' => '',
'MOT_DIF' => 0
);

public function get($attr){
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

public function insert(){
$this->db->insert('motivo',$this->_columns);
}

public function findByArray($myarray = null){
  $this->load->database();
  //$this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
  //$this->db->join('usuario', 'inventario.INV_ULTIMO_USUARIO = usuario.USU_RUT');
  //$this->db->order_by('ASIG_ID', 'ASC');
  $res = $this->db->get_where('motivo',$myarray);
  $result = array();
  foreach ($res->result_array() as $row) {
    $result[] = $row;
  }
  return $result;
}

public function update($id, $data) {
  $motivo = $this->db->get_where('motivo',array('MOT_ID'=>$id));
  if($motivo->num_rows() > 0){
    $this->db->where('MOT_ID', $id);
    return $this->db->update('motivo', $data);
    }else{
  $data['MOT_ID'] = $id;
  return $this->db->insert('motivo',$data);
  }
}

public function delete($id){
  $this->db->where('MOT_ID',$id);
  return $this->db->delete('motivo');
}


public function findAll(){
  $result=array();
  $bit = null;
  $consulta = $this->db->get('motivo');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

public function findById($id){
    $result = null;
    $this->db->where('MOT_ID',$id);
    $this->db->order_by('MOT_ID', 'ASC'); // or 'DESC'
    $consulta = $this->db->get('motivo');
    if($consulta->num_rows() == 1){
      $result = $this->create($consulta->row());
    }
    
    return $result;
  }

  public function setColumns ($row = null){
    foreach ($row as $key => $value) {
      $this->_columns[$key] = $value;
      }
    }
}
