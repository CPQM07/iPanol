<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perfil_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    private $_columns = array(
        'PERFIL_ID'     => 0,
        'PERFIL_NOMBRE' => '',
        'PERFIL_DESC'   => '',
    );

    public function get($attr)
    {
        return $this->_columns[$attr];
    }

    public function create($row)
    {
        $perfil = new Perfil_Model();
        foreach ($row as $key => $value) {
            $perfil->_columns[$key] = $value;
        }
        return $perfil;
    }

    public function insert()
    {
        $this->db->insert('perfil', $this->_columns);
    }

    public function update($id, $data)
    {
        $perfil = $this->db->get_where('perfil', array('PERFIL_ID' => $id));
        if ($perfil->num_rows() > 0) {
            $this->db->where('PERFIL_ID', $id);
            return $this->db->update('perfil', $data);
        } else {
            $data['PERFIL_ID'] = $id;
            return $this->db->insert('perfil', $data);
        }
    }

    public function delete($id)
    {
        $this->db->where('PERFIL_ID', $id);
        return $this->db->delete('perfil');
    }

    public function findAll()
    {
        $result   = array();
        $bit      = null;
        $consulta = $this->db->get('perfil');
        foreach ($consulta->result() as $row) {
            $result[] = $this->create($row);
        }
        return $result;
    }

    public function findById($id)
    {
        $result = null;
        $this->db->where('PERFIL_ID', $id);
        $consulta = $this->db->get('perfil');
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
