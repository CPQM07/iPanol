<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto_Model extends CI_Model {

public function __construct()
{
parent::__construct();
}

private  $_columns  =  array(
'PROD_ID' => 0,
'PROD_NOMBRE' => 0,
'PROD_STOCK_TOTAL' => 0,
'PROD_STOCK_CRITICO' => 0,
'PROD_CAT_ID' => 0,
'PROD_TIPOPROD_ID' => 0,
'PROD_POSICION' => '',
'PROD_PRIORIDAD' => 0,
'PROD_STOCK_OPTIMO' => 0,
'PROD_DIAS_ANTIC' => 0,
'PROD_IMAGEN' => '',
'PROD_ESTADO' => 1,
);

public function get($attr){
  return $this->_columns[$attr];
}

public function create($row){
  $producto =  new Producto_Model();
  foreach ($row as $key => $value)
    {
      $producto->_columns[$key] = $value;
    }
  return $producto;
}

public function insert($imagen=null){
  $this->_columns['PROD_IMAGEN']=$imagen;
$this->db->insert('productos',$this->_columns);
}

public function update($id, $data,$img) {
  $data['PROD_IMAGEN']=$img;
  $producto = $this->db->get_where('productos',array('PROD_ID'=>$id));
  if($producto->num_rows() > 0){
    $this->db->where('PROD_ID', $id);
    return $this->db->update('productos', $data);
    }else{
  $data['PROD_ID'] = $id;
  return $this->db->insert('producto',$data);
  }
}

public function delete($id){
  $sql="update productos set PROD_ESTADO=0 WHERE PROD_ID=".$id;
  $query = $this->db->query($sql);

  return 1;
}


public function findAll(){
  $result=array();
  $bit = null;
  $this->db->join('categoria', 'productos.PROD_CAT_ID = categoria.CAT_ID');
  //$this->db->join('usuario', 'inventario.INV_ULTIMO_USUARIO = usuario.USU_RUT');
  $consulta = $this->db->get('productos');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

public function findById($id){
    $result = null;
    $this->db->where('PROD_ID',$id);
    $consulta = $this->db->get('productos');
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


   public function findByCat($id){
      $result=array();
      $bit = null;
          $this->db->where('PROD_CAT_ID',$id);
      $consulta = $this->db->get('productos');
        foreach ($consulta->result() as $row) {
        $result[] = $this->create($row);
      }
      return $result;
    }

     public function findByTipProd($id){
      $result=array();
      $bit = null;
          $this->db->where('PROD_TIPOPROD_ID',$id);
      $consulta = $this->db->get('productos');
        foreach ($consulta->result() as $row) {
        $result[] = $this->create($row);
      }
      return $result;
    }
}
