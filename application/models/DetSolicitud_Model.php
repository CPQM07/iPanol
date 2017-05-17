<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetSolicitud_Model extends CI_Model {

public function __construct()
{
parent::__construct();
}

private  $_columns  =  array(
'DETSOL_ID' => 0,
'DETSOL_TIPOPROD' => 0,
'DETSOL_CANTIDAD' => 0,
'DETSOL_ESTADO' => 0,
'DETSOL_SOL_ID' => 0,
'DETSOL_PROD_ID' => 0,
);

public function get($attr){
  return $this->_columns[$attr];
}

public function create($row){
  $detalle =  new DetSolicitud_Model();
  foreach ($row as $key => $value)
    {
      $detalle->_columns[$key] = $value;
    }
  return $detalle;
}

public function insert(){
$this->db->insert('detallesol',$this->_columns);
}

public function update($id, $data) {
  $detalle = $this->db->get_where('detallesol',array('DETSOL_ID'=>$id));
  if($detalle->num_rows() > 0){
    $this->db->where('DETSOL_ID', $id);
    return $this->db->update('detallesol', $data);
    }else{
  $data['DETSOL_ID'] = $id;
  return $this->db->insert('detallesol',$data);
  }
}

public function delete($id){
  $this->db->where('DETSOL_ID',$id);
  return $this->db->delete('detallesol');
}


public function findAll(){
  $result=array();
  $bit = null;
  $consulta = $this->db->get('detallesol');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

public function findById($id){
  $result=array();
  $bit = null;
  $this->db->where('DETSOL_ID',$id);
  $consulta = $this->db->get('detallesol');
  if($consulta->num_rows() > 0){
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
    }
  }else{
    $result[] = $this->create($this->_columns);
  }
    return $result;
  }
  
  public function count0(){
    /*$cont0 = $this->db->from('detallesol');
    $obj0 = $cont0->count_all_results();
    return $obj0;*/
    $this->db->where('DETSOL_ESTADO',1);
    $consulta = $this->db->get('detallesol');
    return $consulta->num_rows();
  }

  public function count2(){
    /*$cont0 = $this->db->from('detallesol');
    $obj0 = $cont0->count_all_results();
    return $obj0;*/
    $this->db->where('DETSOL_ESTADO',3);
    $consulta = $this->db->get('detallesol');
    return $consulta->num_rows();
  }





  public function count1(){
    $cont1 = $this->db->from('baja');
    $obj1 = $cont1->count_all_results();
    return $obj1;
  }

  public function setColumns ($row = null){
    foreach ($row as $key => $value) {
      $this->columns[$key] = $value;
      }
    }
}
