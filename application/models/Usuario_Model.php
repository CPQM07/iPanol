<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    private $_columns = array(
        'USU_RUT'        => 0,
        'USU_DV'         => 0,
        'USU_NOMBRES'    => '',
        'USU_APELLIDOS'  => '',
        'USU_CARGO_ID'   => 0,
        'USU_CARRERA_ID' => 0,
        'USU_EMAIL'      => '',
        'USU_TELEFONO1'  => 0,
        'USU_TELEFONO2'  => 0,
        'USU_CLAVE'      => '',
        'USU_ESTADO'     => 1,

    );

    public function get($attr)
    {
        return $this->_columns[$attr];
    }

    public function insertLogs($tipo, $rut, $id, $dato)
    {
        $query = 'INSERT INTO `logmantenedores` (`logman_mantenedor`, `logman_tipo`, `logman_usu_rut`, `logman_id_registro`, `logman_texto`)VALUES ("Usuario", ' . $tipo . ',' . $rut . ',' . $id . ',"' . $dato . '")';
        $this->db->query($query);
        return true;
    }

    public function create($row)
    {
        $usuario = new Usuario_Model();
        foreach ($row as $key => $value) {
            $usuario->_columns[$key] = $value;
        }
        return $usuario;
    }

    public function insert()
    {
        $this->db->insert('usuario', $this->_columns);
    }

    public function update($id, $data)
    {
        $usuario = $this->db->get_where('usuario', array('USU_RUT' => $id));
        if ($usuario->num_rows() > 0) {
            $this->db->where('USU_RUT', $id);
            return $this->db->update('usuario', $data);
        } else {
            $data['USU_RUT'] = $id;
            return $this->db->insert('usuario', $data);
        }
    }

    public function delete($id)
    {
        $sql   = "update usuario set USU_ESTADO =0 WHERE USU_RUT=" . $id;
        $query = $this->db->query($sql);
        return 1;
    }

    public function findAll()
    {
        $result   = array();
        $bit      = null;
        $consulta = $this->db->get('usuario');
        foreach ($consulta->result() as $row) {
            $result[] = $this->create($row);
        }
        return $result;
    }

    public function findById($id)
    {
        $result = null;
        $this->db->where('USU_RUT', $id);
        $consulta = $this->db->get('usuario');
        if ($consulta->num_rows() == 1) {
            $result = $this->create($consulta->row());
        }

        return $result;
    }

    public function setColumns($row = null)
    {
        foreach ($row as $key => $value) {
            $this->columns[$key] = $value;
        }
    }

    public function getCargo()
    {
        $result = $this->db->get_where("cargo", array('CARGO_ID' => $this->_columns['USU_CARGO_ID']));
        $cargo  = array();
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $key => $value) {
                $cargo[] = $value->CARGO_ID;
            }
        }
        return $cargo;
    }

    public function findByArray($myarray = null)
    {
        $this->load->database();
        $res    = $this->db->get_where('usuario', $myarray);
        $result = array();
        foreach ($res->result() as $row) {
            $result[] = $this->create($row);
        }
        return $result;
    }

    public function getCarrera()
    {
        $result = $this->db->query("select CARRERA_NOMBRE from carrera inner join usuario on usuario.USU_CARRERA_ID = carrera.CARRERA_ID where
        usuario.USU_RUT = " . $this->_columns['USU_RUT']);
        $carrera = 0;
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $key => $value) {
                $carrera = $value->CARRERA_NOMBRE;
            }
        }
        return $carrera;
    }

    public function login($rut, $clave)
    {
        $datos = array();
        $user  = null;

        $result = $this->db->get_where('usuario', array('USU_RUT' => $rut, 'USU_ESTADO' => 1));
        if ($result->num_rows() > 0) {
            $row = $result->row_object();
            if ($row->USU_CLAVE == $clave) {
                $user = $this->create($row);
            }
        }
        return $user;
    }
}
