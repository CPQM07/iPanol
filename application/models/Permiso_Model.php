<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permiso_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    private $_columns = array(
        'PERMISO_PERFIL_ID' => 0,
        'PERMISO_USU_RUT'   => 0,
    );

    public function get($attr)
    {
        return $this->_columns[$attr];
    }

    public function create($row)
    {
        $permiso = new Permiso_Model();
        foreach ($row as $key => $value) {
            $permiso->_columns[$key] = $value;
        }
        return $permiso;
    }

    public function insert()
    {
        $this->db->insert('permiso', $this->_columns);
    }

    public function update($id, $data)
    {
        $permiso = $this->db->get_where('permiso', array('PERMISO_PERFIL_ID' => $id));
        if ($permiso->num_rows() > 0) {
            $this->db->where('PERMISO_PERFIL_ID', $id);
            return $this->db->update('permiso', $data);
        } else {
            $data['PERMISO_PERFIL_ID'] = $id;
            return $this->db->insert('permiso', $data);
        }
    }

    public function delete($id)
    {
        $this->db->where('PERMISO_PERFIL_ID', $id);
        return $this->db->delete('permiso');
    }

    public function findAll()
    {
        $result   = array();
        $bit      = null;
        $consulta = $this->db->get('permiso');
        foreach ($consulta->result() as $row) {
            $result[] = $this->create($row);
        }
        return $result;
    }

    public function findById($id)
    {
        $result = null;
        $this->db->where('PERMISO_PERFIL_ID', $id);
        $consulta = $this->db->get('permiso');
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
}
