<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cargo_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    private $_columns = array(
        'CARGO_ID'     => 0,
        'CARGO_NOMBRE' => '',
        'CARGO_DESC'   => '',
    );

    public function get($attr)
    {
        return $this->_columns[$attr];
    }

    public function create($row)
    {
        $cargo = new Cargo_Model();
        foreach ($row as $key => $value) {
            $cargo->_columns[$key] = $value;
        }
        return $cargo;
    }

    public function insert()
    {
        $this->db->insert('cargo', $this->_columns);
    }

    public function update($id, $data)
    {
        $cargo = $this->db->get_where('cargo', array('CARGO_ID' => $id));
        if ($cargo->num_rows() > 0) {
            $this->db->where('CARGO_ID', $id);
            return $this->db->update('cargo', $data);
        } else {
            $data['CARGO_ID'] = $id;
            return $this->db->insert('cargo', $data);
        }
    }

    public function delete($id)
    {
        $this->db->where('CARGO_ID', $id);
        return $this->db->delete('cargo');
    }

    public function findAll()
    {
        $result   = array();
        $bit      = null;
        $consulta = $this->db->get('cargo');
        foreach ($consulta->result() as $row) {
            $result[] = $this->create($row);
        }
        return $result;
    }

    public function findById($id)
    {
        $result = null;
        $this->db->where('CARGO_ID', $id);
        $consulta = $this->db->get('cargo');
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
