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

function get($attr){
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

function insert(){
$this->db->insert('DETALLESOL',$this->_columns);
}

function update($id, $data) {
  $detalle = $this->db->get_where('DETALLESOL',array('DETSOL_ID'=>$id));
  if($detalle->num_rows() > 0){
    $this->db->where('DETSOL_ID', $id);
    return $this->db->update('DETALLESOL', $data);
    }else{
  $data['DETSOL_ID'] = $id;
  return $this->db->insert('DETALLESOL',$data);
  }
}

function delete($id){
  $this->db->where('DETSOL_ID',$id);
  return $this->db->delete('DETALLESOL');
}


function findAll(){
  $result=array();
  $bit = null;
  $consulta = $this->db->get('DETALLESOL');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

function findById($id){
  $result=array();
  $bit = null;
  $this->db->where('DETSOL_ID',$id);
  $consulta = $this->db->get('DETALLESOL');
  if($consulta->num_rows() > 0){
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
    }
  }else{
    $result[] = $this->create($this->_columns);
  }
    return $result;
  }
  function count(){
    $cont = $this->db->from('DETALLESOL');
    $obj = $cont->count_all_results();
    return $obj;
  }
}
