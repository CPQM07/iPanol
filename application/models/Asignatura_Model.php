<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Asignatura_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    private $_columns = array(
        'ASIGNATURA_ID'     => 0,
        'ASIGNATURA_NOMBRE' => '',
        'ASIGNATURA_ESTADO' => '1',
    );

    public function get($attr)
    {
        return $this->_columns[$attr];
    }

    public function create($row)
    {
        $asignatura = new Asignatura_Model();
        foreach ($row as $key => $value) {
            $asignatura->_columns[$key] = $value;
        }
        return $asignatura;
    }

    public function insert()
    {
        $this->db->insert('asignatura', $this->_columns);
    }

    public function update($id, $data)
    {
        $asignatura = $this->db->get_where('asignatura', array('ASIGNATURA_ID' => $id));
        if ($asignatura->num_rows() > 0) {
            $this->db->where('ASIGNATURA_ID', $id);
            return $this->db->update('asignatura', $data);
        } else {
            $data['ASIGNATURA_ID'] = $id;
            return $this->db->insert('asignatura', $data);
        }
    }

    public function delete($id)
    {
        $sql   = "update usuario set ASIGNATURA_ESTADO =0 WHERE ASIGNATURA_ID=" . $id;
        $query = $this->db->query($sql);
        return 1;
    }

    public function findAll($condicion = null)
    {
        $result = array();
        $bit    = null;
        if ($condicion != null) {
            $this->db->where($condicion);
        }

        $consulta = $this->db->get('asignatura');
        foreach ($consulta->result() as $row) {
            $result[] = $this->create($row);
        }
        return $result;
    }

    public function findById($id)
    {
        $result = null;
        $this->db->where('ASIGNATURA_ID', $id);
        $consulta = $this->db->get('asignatura');
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

    public function lastInsert()
    {
        $this->db->order_by("ASIGNATURA_ID, DESC");
        $this->db->limit(1);
        $last = $this->db->get('asignatura');
        return intval($last);
    }
}
