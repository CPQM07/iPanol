<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categoria_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    private $_columns = array(
        'CAT_ID'     => 0,
        'CAT_NOMBRE' => '',
        'CAT_DESC'   => '',
        'CAT_CODIGO' => 0,
        'CAT_ESTADO' => 1,
    );

    public function get($attr)
    {
        return $this->_columns[$attr];
    }

    public function create($row)
    {
        $categoria = new Categoria_Model();
        foreach ($row as $key => $value) {
            $categoria->_columns[$key] = $value;
        }
        return $categoria;
    }

    public function insert()
    {
        $this->db->insert('categoria', $this->_columns);
    }

    public function insertLogs($tipo, $rut = null, $id, $dato)
    {
        if ($tipo == 1) {
            $ultR      = 'select CAT_ID from categoria order by CAT_ID DESC limit 1';
            $ultimoOBJ = $this->db->query($ultR);
            $ya        = $ultimoOBJ->row();
            foreach ($ya as $ar) {
                $id = $ar;
            }
            $query = 'INSERT INTO `logmantenedores` (`logman_mantenedor`, `logman_tipo`, `logman_usu_rut`, `logman_id_registro`, `logman_texto`)VALUES ("Categoria", ' . $tipo . ',' . $rut . ',' . $id . ',"' . $dato . '")';
        } else {
            $query = 'INSERT INTO `logmantenedores` (`logman_mantenedor`, `logman_tipo`, `logman_usu_rut`, `logman_id_registro`, `logman_texto`)VALUES ("Categoria", ' . $tipo . ',' . $rut . ',' . $id . ',"' . $dato . '")';
        }
        $this->db->query($query);
        return true;
    }
    public function update($id, $data)
    {
        $categoria = $this->db->get_where('categoria', array('CAT_ID' => $id));
        if ($categoria->num_rows() > 0) {
            $this->db->where('CAT_ID', $id);
            return $this->db->update('categoria', $data);
        } else {
            $data['CAT_ID'] = $id;
            return $this->db->insert('categoria', $data);
        }
    }

    public function delete($id)
    {
        $sql   = "update categoria set CAT_ESTADO=0 WHERE CAT_ID=" . $id;
        $query = $this->db->query($sql);

        return 1;
    }

    public function findAll()
    {
        $result   = array();
        $bit      = null;
        $consulta = $this->db->get('categoria');
        foreach ($consulta->result() as $row) {
            $result[] = $this->create($row);
        }
        return $result;
    }

    public function findAllSelect()
    {
        $result   = array();
        $bit      = null;
        $consulta = $this->db->get_where('categoria', array('CAT_ESTADO' => '1'));
        foreach ($consulta->result() as $row) {
            $result[] = $this->create($row);
        }
        return $result;
    }

    public function findById($id)
    {
        $result = null;
        $this->db->where('CAT_ID', $id);
        $this->db->order_by('CAT_ID', 'ASC'); // or 'DESC'
        $consulta = $this->db->get('categoria');
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

    public function findByArray($myarray = null)
    {
        $this->load->database();
        $this->db->order_by('CAT_ID', 'ASC');
        $res    = $this->db->get_where('categoria', $myarray);
        $result = array();
        foreach ($res->result_array() as $row) {
            $result[] = $row;
        }
        return $result;
    }
}
