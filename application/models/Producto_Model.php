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

public function update($id, $data) {
  $producto = $this->db->get_where('productos',array('PROD_ID'=>$id));
  if($producto->num_rows() > 0){
    $this->db->where('PROD_ID', $id);
    if($data['PROD_ESTADO']==0){
      $query = " UPDATE inventario SET 
      INV_PROD_NOM ='".$data['PROD_NOMBRE']."',
      INV_PROD_ESTADO =".$data['PROD_ESTADO'].",
      INV_PROD_CODIGO =".$data['PROD_CAT_ID'].$id.",
      INV_IMAGEN='".$data['PROD_IMAGEN']."',
      INV_TIPO_ID=".$data['PROD_TIPOPROD_ID'].",
      INV_CATEGORIA_ID=".$data['PROD_CAT_ID']." 
      WHERE INV_PROD_ID=".$id;
    }else{
      $query = " UPDATE inventario SET 
      INV_PROD_NOM ='".$data['PROD_NOMBRE']."',
      INV_PROD_CODIGO =".$data['PROD_CAT_ID'].$id.",
      INV_IMAGEN='".$data['PROD_IMAGEN']."',
      INV_TIPO_ID=".$data['PROD_TIPOPROD_ID'].",
      INV_CATEGORIA_ID=".$data['PROD_CAT_ID']." 
      WHERE `INV_PROD_ID` =".$id;
    }
    $this->db->query($query);
    return $this->db->update('productos', $data);
    }else{
  $data['PROD_ID'] = $id;
  return $this->db->insert('producto',$data);
  }
}

public function insertLogs($tipo,$rut=null,$id,$dato){
  if($tipo==1){
    $ultR='select PROD_ID from productos order by prod_id DESC limit 1';
    $ultimoOBJ= $this->db->query($ultR);
    $ya=$ultimoOBJ->row();
    foreach($ya as $ar){
      $id=$ar;
    }
    $query='INSERT INTO `logmantenedores` (`logman_mantenedor`, `logman_tipo`, `logman_usu_rut`, `logman_id_registro`, `logman_texto`)VALUES ("Productos", '.$tipo.','.$rut.','.$id.',"'.$dato.'")';
  }else{
    $query='INSERT INTO `logmantenedores` (`logman_mantenedor`, `logman_tipo`, `logman_usu_rut`, `logman_id_registro`, `logman_texto`)VALUES ("Productos", '.$tipo.','.$rut.','.$id.',"'.$dato.'")';
  }
 $this->db->query($query);
 return true;
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

public function contar($like = null,$categoria = null,$tipo = null) {
        if ($categoria!= null) $this->db->where('PROD_CAT_ID',$categoria);
        if ($tipo!= null) $this->db->where('PROD_TIPOPROD_ID',$tipo);
        if ($like!= null) $this->db->like('PROD_NOMBRE', $like);
        $query = $this->db->get("productos");
        return $query->num_rows();
   }

public function fetch_productos($limit, $start,$like = null,$categoria = null,$tipo = null) {
        $this->db->where('PROD_ESTADO',1);
        if ($categoria!= null) $this->db->where('PROD_CAT_ID',$categoria);
        if ($tipo!= null) $this->db->where('PROD_TIPOPROD_ID',$tipo);
        if ($like!= null) $this->db->like('PROD_NOMBRE', $like);
        $this->db->limit($limit, $start);
        $query = $this->db->get("productos");
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return null;
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

public function findByTipProdYEstado($tipo=null,$estado=null){
    $result=array();
    $bit = null;
    $this->db->where('PROD_TIPOPROD_ID',$tipo);
    $this->db->where('PROD_ESTADO',$estado);
    $consulta = $this->db->get('productos');
      foreach ($consulta->result() as $row) {
        $result[] = $this->create($row);
      }
      return $result;
}

public function productoStockCritico($id=null){
  $result;
    $querry = $this->db->query('SELECT productos.PROD_STOCK_CRITICO from productos WHERE productos.PROD_ID ='.$id);
    foreach ($querry->result_array() as $data) {
      $result = $data['PROD_STOCK_CRITICO'];
    }
    return $result;
  }

}
