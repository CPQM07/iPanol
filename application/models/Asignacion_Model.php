<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Asignacion_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    private $_columns = array(
        'ASIG_ID'            => 0,
        'ASIG_ESTADO'        => 0,
        'ASIG_SOL_ID'        => 0,
        'ASIG_INV_ID'        => 0,
        'ASIG_FECHA'         => '',
        'ASIG_CANT'          => '',
        'ASIG_CANT_DEVUELTA' => 0,
    );

    public function get($attr)
    {
        return $this->_columns[$attr];
    }

    public function create($row)
    {
        $asignacion = new Asignacion_Model();
        foreach ($row as $key => $value) {
            $asignacion->_columns[$key] = $value;
        }
        return $asignacion;
    }

    public function insertlog($arraycolumns)
    {
        $this->db->insert('logestadoasignaciones', $arraycolumns);
        return $this->db->insert_id();
    }

    public function insert()
    {
        $this->db->insert('asignacion', $this->_columns);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $asignacion = $this->db->get_where('asignacion', array('ASIG_ID' => $id));
        if ($asignacion->num_rows() > 0) {
            $this->db->where('ASIG_ID', $id);
            return $this->db->update('asignacion', $data);
        } else {
            $data['ASIG_ID'] = $id;
            return $this->db->insert('asignacion', $data);
        }
    }

    public function findByArray($myarray = null)
    {
        $this->load->database();
        $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
        //$this->db->join('usuario', 'inventario.INV_ULTIMO_USUARIO = usuario.USU_RUT');
        //$this->db->order_by('ASIG_ID', 'ASC');
        $res    = $this->db->get_where('asignacion', $myarray);
        $result = null;
        foreach ($res->result_array() as $row) {
            $result[] = $row;
        }
        return $result;
    }

    public function delete($id)
    {
        $this->db->where('ASIG_ID', $id);
        return $this->db->delete('asignacion');
    }

    public function findAll()
    {
        $result   = array();
        $bit      = null;
        $consulta = $this->db->get('asignacion');
        foreach ($consulta->result() as $row) {
            $result[] = $this->create($row);
        }
        return $result;
    }

    public function findById($id)
    {
        $result = null;
        $this->db->where('ASIG_ID', $id);
        $this->db->order_by('ASIG_ID', 'ASC'); // or 'DESC'
        $consulta = $this->db->get('asignacion');
        if ($consulta->num_rows() == 1) {
            $result = $this->create($consulta->row());
        }

        return $result;
    }

    public function setColumns($row = null)
    {
        foreach ($row as $key => $value) {
            $this->_columns[$key] = $value;
        }
    }

    public function productoActivoHoy()
    {
        /*CANTIDAD PRODUCTOS ACTIVOS HOY*/
        date_default_timezone_set("Chile/Continental");
        $inicio = date("Y-m-d", time());
        $this->db->select('INV_TIPO_ID');
        $this->db->from('asignacion');
        $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
        $this->db->where('asignacion.ASIG_FECHA<', $inicio . " " . "23:59:59");
        $this->db->where('asignacion.ASIG_FECHA>', $inicio . " " . "00:00:00");
        $this->db->where('inventario.INV_TIPO_ID', 1);
        $result = $this->db->get();
        return $result->num_rows();
    }

    public function productoActivoAyer()
    {
        /*CANTIDAD PRODUCTOS ACTIVOS AYER*/
        date_default_timezone_set("Chile/Continental");
        $fecha  = date("Y-m-d", time());
        $inicio = strtotime('-1 day', strtotime($fecha));
        $inicio = date('Y-m-d', $inicio);
        $this->db->select('INV_TIPO_ID');
        $this->db->from('asignacion');
        $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
        $this->db->where('asignacion.ASIG_FECHA<', $inicio . " " . "23:59:59");
        $this->db->where('asignacion.ASIG_FECHA>', $inicio . " " . "00:00:00");
        $this->db->where('inventario.INV_TIPO_ID', 1);
        $result = $this->db->get();
        return $result->num_rows();
    }

    public function productoActivoAyer2()
    {
        /*CANTIDAD PRODUCTOS ACTIVOS AYER*/
        date_default_timezone_set("Chile/Continental");
        $fecha  = date("Y-m-d", time());
        $inicio = strtotime('-2 day', strtotime($fecha));
        $inicio = date('Y-m-d', $inicio);
        $this->db->select('INV_TIPO_ID');
        $this->db->from('asignacion');
        $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
        $this->db->where('asignacion.ASIG_FECHA<', $inicio . " " . "23:59:59");
        $this->db->where('asignacion.ASIG_FECHA>', $inicio . " " . "00:00:00");
        $this->db->where('inventario.INV_TIPO_ID', 1);
        $result = $this->db->get();
        return $result->num_rows();
    }

    public function productoActivoAyer3()
    {
        /*CANTIDAD PRODUCTOS ACTIVOS AYER*/
        date_default_timezone_set("Chile/Continental");
        $fecha  = date("Y-m-d", time());
        $inicio = strtotime('-3 day', strtotime($fecha));
        $inicio = date('Y-m-d', $inicio);
        $this->db->select('INV_TIPO_ID');
        $this->db->from('asignacion');
        $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
        $this->db->where('asignacion.ASIG_FECHA<', $inicio . " " . "23:59:59");
        $this->db->where('asignacion.ASIG_FECHA>', $inicio . " " . "00:00:00");
        $this->db->where('inventario.INV_TIPO_ID', 1);
        $result = $this->db->get();
        return $result->num_rows();
    }

    public function productoActivoAyer4()
    {
        /*CANTIDAD PRODUCTOS ACTIVOS AYER*/
        date_default_timezone_set("Chile/Continental");
        $fecha  = date("Y-m-d", time());
        $inicio = strtotime('-4 day', strtotime($fecha));
        $inicio = date('Y-m-d', $inicio);
        $this->db->select('INV_TIPO_ID');
        $this->db->from('asignacion');
        $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
        $this->db->where('asignacion.ASIG_FECHA<', $inicio . " " . "23:59:59");
        $this->db->where('asignacion.ASIG_FECHA>', $inicio . " " . "00:00:00");
        $this->db->where('inventario.INV_TIPO_ID', 1);
        $result = $this->db->get();
        return $result->num_rows();
    }

    public function productoActivoAyer5()
    {
        /*CANTIDAD PRODUCTOS ACTIVOS AYER*/
        date_default_timezone_set("Chile/Continental");
        $fecha  = date("Y-m-d", time());
        $inicio = strtotime('-5 day', strtotime($fecha));
        $inicio = date('Y-m-d', $inicio);
        $this->db->select('INV_TIPO_ID');
        $this->db->from('asignacion');
        $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
        $this->db->where('asignacion.ASIG_FECHA<', $inicio . " " . "23:59:59");
        $this->db->where('asignacion.ASIG_FECHA>', $inicio . " " . "00:00:00");
        $this->db->where('inventario.INV_TIPO_ID', 1);
        $result = $this->db->get();
        return $result->num_rows();
    }

    public function productoActivoAyer6()
    {
        /*CANTIDAD PRODUCTOS ACTIVOS AYER*/
        date_default_timezone_set("Chile/Continental");
        $fecha  = date("Y-m-d", time());
        $inicio = strtotime('-6 day', strtotime($fecha));
        $inicio = date('Y-m-d', $inicio);
        $this->db->select('INV_TIPO_ID');
        $this->db->from('asignacion');
        $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
        $this->db->where('asignacion.ASIG_FECHA<', $inicio . " " . "23:59:59");
        $this->db->where('asignacion.ASIG_FECHA>', $inicio . " " . "00:00:00");
        $this->db->where('inventario.INV_TIPO_ID', 1);
        $result = $this->db->get();
        return $result->num_rows();
    }

    /*-------------------------------------------------------------------------------------*/

    public function productoFungiblesHoy()
    {
        /*CANTIDAD PRODUCTOS FUNGIBLES HOY*/
        date_default_timezone_set("Chile/Continental");
        $inicio = date("Y-m-d H:i:s", time()); /*OPCION2*/
        $this->db->select('INV_TIPO_ID');
        $this->db->from('asignacion');
        $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
        $this->db->where('asignacion.ASIG_FECHA<', $inicio . " " . "23:59:59");
        $this->db->where('asignacion.ASIG_FECHA>', $inicio . " " . "00:00:00");
        $this->db->where('inventario.INV_TIPO_ID', 2);
        $result = $this->db->get();
        return $result->num_rows();
    }

    public function productoFungiblesAyer()
    {
        /*CANTIDAD PRODUCTOS FUNGIBLES AYER*/
        date_default_timezone_set("Chile/Continental");
        $fecha  = date("Y-m-d", time());
        $inicio = strtotime('-1 day', strtotime($fecha));
        $inicio = date('Y-m-d', $inicio);
        $this->db->select('INV_TIPO_ID');
        $this->db->from('asignacion');
        $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
        $this->db->where('asignacion.ASIG_FECHA<', $inicio . " " . "23:59:59");
        $this->db->where('asignacion.ASIG_FECHA>', $inicio . " " . "00:00:00");
        $this->db->where('inventario.INV_TIPO_ID', 2);
        $result = $this->db->get();
        return $result->num_rows();
    }

    public function productoFungiblesAyer2()
    {
        /*CANTIDAD PRODUCTOS FUNGIBLES AYER*/
        date_default_timezone_set("Chile/Continental");
        $fecha  = date("Y-m-d", time());
        $inicio = strtotime('-2 day', strtotime($fecha));
        $inicio = date('Y-m-d', $inicio);
        $this->db->select('INV_TIPO_ID');
        $this->db->from('asignacion');
        $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
        $this->db->where('asignacion.ASIG_FECHA<', $inicio . " " . "23:59:59");
        $this->db->where('asignacion.ASIG_FECHA>', $inicio . " " . "00:00:00");
        $this->db->where('inventario.INV_TIPO_ID', 2);
        $result = $this->db->get();
        return $result->num_rows();
    }

    public function productoFungiblesAyer3()
    {
        /*CANTIDAD PRODUCTOS FUNGIBLES AYER*/
        date_default_timezone_set("Chile/Continental");
        $fecha  = date("Y-m-d", time());
        $inicio = strtotime('-3 day', strtotime($fecha));
        $inicio = date('Y-m-d', $inicio);
        $this->db->select('INV_TIPO_ID');
        $this->db->from('asignacion');
        $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
        $this->db->where('asignacion.ASIG_FECHA<', $inicio . " " . "23:59:59");
        $this->db->where('asignacion.ASIG_FECHA>', $inicio . " " . "00:00:00");
        $this->db->where('inventario.INV_TIPO_ID', 2);
        $result = $this->db->get();
        return $result->num_rows();
    }

    public function productoFungiblesAyer4()
    {
        /*CANTIDAD PRODUCTOS FUNGIBLES AYER*/
        date_default_timezone_set("Chile/Continental");
        $fecha  = date("Y-m-d", time());
        $inicio = strtotime('-4 day', strtotime($fecha));
        $inicio = date('Y-m-d', $inicio);
        $this->db->select('INV_TIPO_ID');
        $this->db->from('asignacion');
        $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
        $this->db->where('asignacion.ASIG_FECHA<', $inicio . " " . "23:59:59");
        $this->db->where('asignacion.ASIG_FECHA>', $inicio . " " . "00:00:00");
        $this->db->where('inventario.INV_TIPO_ID', 2);
        $result = $this->db->get();
        return $result->num_rows();
    }

    public function productoFungiblesAyer5()
    {
        /*CANTIDAD PRODUCTOS FUNGIBLES AYER*/
        date_default_timezone_set("Chile/Continental");
        $fecha  = date("Y-m-d", time());
        $inicio = strtotime('-5 day', strtotime($fecha));
        $inicio = date('Y-m-d', $inicio);
        $this->db->select('INV_TIPO_ID');
        $this->db->from('asignacion');
        $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
        $this->db->where('asignacion.ASIG_FECHA<', $inicio . " " . "23:59:59");
        $this->db->where('asignacion.ASIG_FECHA>', $inicio . " " . "00:00:00");
        $this->db->where('inventario.INV_TIPO_ID', 2);
        $result = $this->db->get();
        return $result->num_rows();
    }

    public function productoFungiblesAyer6()
    {
        /*CANTIDAD PRODUCTOS FUNGIBLES AYER*/
        date_default_timezone_set("Chile/Continental");
        $fecha  = date("Y-m-d", time());
        $inicio = strtotime('-6 day', strtotime($fecha));
        $inicio = date('Y-m-d', $inicio);
        $this->db->select('INV_TIPO_ID');
        $this->db->from('asignacion');
        $this->db->join('inventario', 'asignacion.ASIG_INV_ID = inventario.INV_ID');
        $this->db->where('asignacion.ASIG_FECHA<', $inicio . " " . "23:59:59");
        $this->db->where('asignacion.ASIG_FECHA>', $inicio . " " . "00:00:00");
        $this->db->where('inventario.INV_TIPO_ID', 2);
        $result = $this->db->get();
        return $result->num_rows();
    }
}
