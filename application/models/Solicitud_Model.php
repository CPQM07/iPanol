<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitud_Model extends CI_Model {

public function __construct()
{
parent::__construct();
}

private  $_columns  =  array(
'SOL_ID' => 0,
'SOL_USU_RUT' => 0,
'SOL_ASIG_ID' => 0,
'SOL_FECHA_INICIO' => '',
'SOL_FECHA_TERMINO' => '',
'SOL_NRO_GRUPOTRAB' => 0,
'SOL_OBSERVACION' => 0,
'SOL_RUTA_PDF' => '',
'SOL_ESTADO' => 0
);

public function get($attr){
  return $this->_columns[$attr];
}

public function create($row){
  $solicitud =  new Solicitud_Model();
  foreach ($row as $key => $value)
    {
      $solicitud->_columns[$key] = $value;
    }
  return $solicitud;
}

public function insertlog($arraycolumns){
  $this->db->insert('logestadosolicitud',$arraycolumns);
return $this->db->insert_id();
}

public function insert(){
$this->db->insert('solicitud',$this->_columns);
return $this->db->insert_id();
}

public function update($id, $data) {
  $solicitud = $this->db->get_where('solicitud',array('SOL_ID'=>$id));
  if($solicitud->num_rows() > 0){
    $this->db->where('SOL_ID', $id);
    return $this->db->update('solicitud', $data);
    }else{
  $data['SOL_ID'] = $id;
  return $this->db->insert('solicitud',$data);
  }
}

public function delete($id){
  $this->db->where('SOL_ID',$id);
  return $this->db->delete('solicitud');
}


public function findAll(){
  $result=array();
  $bit = null;
  $consulta = $this->db->get('solicitud');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

public function findEstados(){
  $result=array();
  $this->db->join('usuario', 'usuario.USU_RUT = solicitud.SOL_USU_RUT');
  $consulta = $this->db->get('solicitud');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

 public function findById($id){
    $result = null;
    $this->db->where('SOL_ID',$id);
    $this->db->order_by('SOL_ID', 'ASC'); // or 'DESC'
    $consulta = $this->db->get('solicitud');
    if($consulta->num_rows() == 1){
      $result = $this->create($consulta->row());
    }

    return $result;
  }


  public function findByArray($myarray = null,$arrayestadosOR = null){
        $this->load->database();
        $this->db->select("SOL_ID,SOL_USU_RUT,SOL_ASIG_ID, DATE_FORMAT(SOL_FECHA_INICIO,'%d-%m-%Y %H:%i:%s') as SOL_FECHA_INICIO,DATE_FORMAT(SOL_FECHA_TERMINO,'%d-%m-%Y %H:%i:%s') as SOL_FECHA_TERMINO,SOL_NRO_GRUPOTRAB,SOL_OBSERVACION,SOL_ESTADO,SOL_RUTA_PDF");
        $res = $this->db->get_where('solicitud',$myarray);
        $this->db->or_where_in('SOL_ESTADO',$arrayestadosOR);
        $this->db->order_by('SOL_ID', 'ASC');
        $result = array();
           foreach ($res->result() as $row) {
            $result[] = $this->create($row);
            }
          return $result;
     }

   public function findByArrayIN($arraydeIDinv = null,$arraycondiciones = null){
    $this->load->database();
    $this->db->get('solicitud');
    $this->db->select("SOL_ID,SOL_USU_RUT,SOL_ASIG_ID, DATE_FORMAT(SOL_FECHA_INICIO,'%d-%m-%Y %H:%i:%s') as SOL_FECHA_INICIO,DATE_FORMAT(SOL_FECHA_TERMINO,'%d-%m-%Y %H:%i:%s') as SOL_FECHA_TERMINO,SOL_NRO_GRUPOTRAB,SOL_OBSERVACION,SOL_ESTADO,SOL_RUTA_PDF");
    $this->db->or_where_in('SOL_ESTADO',$arraydeIDinv);
    $res = $this->db->get_where('solicitud',$arraycondiciones);
    $result = array();
       foreach ($res->result() as $row) {
        $result[] = $this->create($row);
        }
      return $result;
  }


  //ESTE METODO BUSCA LAS SOLICITUDES POR EL ESTADO DE DEL DETALLE DEL MISMO
  function findByEstadoDetSol($estado){
    $result = array();
    $querry = $this->db->query("select SOL_ID,SOL_USU_RUT,SOL_ASIG_ID, DATE_FORMAT(SOL_FECHA_INICIO,'%d-%m-%Y %H:%i:%s') as SOL_FECHA_INICIO,DATE_FORMAT(SOL_FECHA_TERMINO,'%d-%m-%Y %H:%i:%s') as SOL_FECHA_TERMINO,SOL_NRO_GRUPOTRAB,SOL_OBSERVACION,,SOL_RUTA_PDF from solicitud JOIN detallesol on solicitud.SOL_ID = detallesol.DETSOL_SOL_ID where detallesol.DETSOL_ESTADO =".$estado." GROUP BY SOL_ID");
    foreach ($querry->result() as $data) {
      $result[] = $this->create($data);
    }
    return $result;
  }

}
