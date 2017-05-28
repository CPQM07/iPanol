<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TipoProd_Model extends CI_Model {

public function __construct()
{
parent::__construct();
}

private  $_columns  =  array(
'TIPO_ID' => 0,
'TIPO_NOMBRE' => ''
);

public function get($attr){
  return $this->_columns[$attr];
}

public function create($row){
  $tipo =  new TipoProd_Model();
  foreach ($row as $key => $value)
    {
      $tipo->_columns[$key] = $value;
    }
  return $tipo;
}

public function insert(){
$this->db->insert('tipoprod',$this->_columns);
}

public function update($id, $data) {
  $tipo = $this->db->get_where('tipoprod',array('TIPO_ID'=>$id));
  if($tipo->num_rows() > 0){
    $this->db->where('TIPO_ID', $id);
    return $this->db->update('tipoprod', $data);
    }else{
  $data['TIPO_ID'] = $id;
  return $this->db->insert('tipoprod',$data);
  }
}

public function delete($id){
  $this->db->where('TIPO_ID',$id);
  return $this->db->delete('tipoprod');
}


public function findAll(){
  $result=array();
  $bit = null;
  $consulta = $this->db->get('tipoprod');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

public function findById($id){
    $result = null;
    $this->db->where('TIPO_ID',$id);
    $this->db->order_by('TIPO_ID', 'ASC'); // or 'DESC'
    $consulta = $this->db->get('tipoprod');
    if($consulta->num_rows() == 1){
      $result = $this->create($consulta->row());
    }
    
    return $result;
  }

  public function setColumns ($row = null){
    foreach ($row as $key => $value) {
      $this->columns[$key] = $value;
      }
    }
}
