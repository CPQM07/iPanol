<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs_Model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
  }

  public function setLog($Mantenedor, $LogTipo , $Usuario , $Registro, $Datos){
    $InsertLog = array(
      'logman_mantenedor' => $Mantenedor,
      'logman_tipo' => $LogTipo,
      'logman_usu_rut' => $Usuario,
      'logman_id_registro' => $Registro,
      'logman_texto' => $Datos
    );
    $this->db->insert('logmantenedores', $InsertLog);
  }

}
