<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedor_Model extends CI_Model {

public function __construct()
{
parent::__construct();
}

private  $_columns  =  array(
'PROV_RUT' => 0,
'PROV_DV' => 0,
'PROV_NOMBRE' => '',
'PROV_RSOCIAL' => '',
'PROV_ESTADO' => 0,
'PROV_TIPO' => 0
);

public function get($attr){
  return $this->_columns[$attr];
}

public function create($row){
  $proveedor =  new Proveedor_Model();
  foreach ($row as $key => $value)
    {
      $proveedor->_columns[$key] = $value;
    }
  return $proveedor;
}

public function insert(){
$this->db->insert('proveedor',$this->_columns);
}

public function update($id, $data) {
  $proveedor = $this->db->get_where('proveedor',array('PROV_RUT'=>$id));
  if($proveedor->num_rows() > 0){
    $this->db->where('PROV_RUT', $id);
    return $this->db->update('proveedor', $data);
    }else{
  $data['PROV_RUT'] = $id;
  return $this->db->insert('proveedor',$data);
  }
}

public function delete($id){
  $this->db->where('PROV_RUT',$id);
  return $this->db->delete('proveedor');
}


public function findAll(){
  $result=array();
  $bit = null;
  $consulta = $this->db->get('proveedor');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

public function findById($id){
    $result = null;
    $this->db->where('PROV_RUT',$id);
    $this->db->order_by('PROV_RUT', 'ASC'); // or 'DESC'
    $consulta = $this->db->get('proveedor');
    if($consulta->num_rows() == 1){
      $result = $this->create($consulta->row());
    }

    return $result;
  }

}
