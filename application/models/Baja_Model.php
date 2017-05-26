<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Baja_Model extends CI_Model {

public function __construct()
{
parent::__construct();
}

private  $_columns  =  array(
'BAJA_ID' => 0,
'BAJA_MOTIVO_ID' => 0,
'BAJA_DESC' => '',
'BAJA_INV_ID'	=> 0,
'BAJA_FECHA' => '',
'BAJA_USU_RUT' => 0
);

public function get($attr){
  return $this->_columns[$attr];
}

public function create($row){
  $baja =  new Baja_Model();
  foreach ($row as $key => $value)
    {
      $baja->_columns[$key] = $value;
    }
  return $baja;
}

public function insert(){
$this->db->insert('baja',$this->_columns);
return $this->db->insert_id();
}

public function update($id, $data) {
  $baja = $this->db->get_where('baja',array('BAJA_ID'=>$id));
  if($baja->num_rows() > 0){
    $this->db->where('BAJA_ID', $id);
    return $this->db->update('baja', $data);
    }else{
  $data['BAJA_ID'] = $id;
  return $this->db->insert('baja',$data);
  }
}

public function delete($id){
  $this->db->where('BAJA_ID',$id);
  return $this->db->delete('baja');
}


public function findAll(){
  $result=array();
  $this->db->from('baja');
  $this->db->join('motivo', 'motivo.MOT_ID = baja.BAJA_MOTIVO_ID');
  $this->db->join('inventario', 'inventario.INV_ID = baja.BAJA_INV_ID');
  //$this->db->join('observaciones', 'observaciones.OBS_BAJA_ID = baja.BAJA_ID');
  $this->db->join('usuario', 'usuario.USU_RUT = baja.BAJA_USU_RUT');
  $consulta = $this->db->get();
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

public function findAllArray($params = null){
  $result=array();
  $this->db->from('baja');
  $this->db->join('motivo', 'motivo.MOT_ID = baja.BAJA_MOTIVO_ID');
  $this->db->join('inventario', 'inventario.INV_ID = baja.BAJA_INV_ID');
  //$this->db->join('observaciones', 'observaciones.OBS_BAJA_ID = baja.BAJA_ID');
  $this->db->join('usuario', 'usuario.USU_RUT = baja.BAJA_USU_RUT');
  $this->db->where($params);
  $consulta = $this->db->get();
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

public function findById($id){
    $result = null;
    $this->db->where('BAJA_ID',$id);
    $this->db->order_by('BAJA_ID', 'ASC'); // or 'DESC'
    $consulta = $this->db->get('baja');
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
