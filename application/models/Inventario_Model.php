<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventario_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    private $_columns = array(
        'INV_ID'             => 0,
        'INV_PROD_ID'        => 0,
        'INV_PROD_NOM'       => '',
        'INV_PROD_CANTIDAD'  => 0,
        'INV_PROD_ESTADO'    => 0,
        'INV_PROD_CODIGO'    => 0,
        'INV_INGRESO_ID'     => 0,
        'INV_CATEGORIA_ID'   => 0,
        'INV_TIPO_ID'        => 0,
        'INV_FECHA'          => '',
        'INV_IMAGEN'         => '',
        'INV_ULTIMO_USUARIO' => 0,
        'INV_ACTUAL_USUARIO' => 0,
    );

    public function get($attr)
    {
        return $this->_columns[$attr];
    }

    public function create($row)
    {
        $inventario = new Inventario_Model();
        foreach ($row as $key => $value) {
            $inventario->_columns[$key] = $value;
        }
        return $inventario;
    }

    public function insert()
    {
        $this->db->insert('inventario', $this->_columns);
        return $this->db->insert_id();
    }

    public function insertDirect($columnas)
    {
        $this->db->insert('inventario', $columnas);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $inventario = $this->db->get_where('inventario', array('INV_ID' => $id));
        if ($inventario->num_rows() > 0) {
            $this->db->where('INV_ID', $id);
            return $this->db->update('inventario', $data);
        } else {
            $data['INV_ID'] = $id;
            return $this->db->insert('inventario', $data);
        }
    }
/* METODO MALOOOOO ¡NO TOCAR!
public function update($id, $data,$img) {
$data['INV_IMAGEN']=$img;
$producto = $this->db->get_where('inventario',array('INV_ID'=>$id));
if($producto->num_rows() > 0){
$this->db->where('INV_ID', $id);
return $this->db->update('inventario', $data);
}else{
$data['INV_ID'] = $id;
return $this->db->insert('inventario',$data);
}
}*/

    public function delete($id)
    {
        $this->db->where('INV_ID', $id);
        return $this->db->delete('inventario');
    }

    public function findAll()
    {
        $result   = array();
        $bit      = null;
        $consulta = $this->db->get('inventario');
        foreach ($consulta->result() as $row) {
            $result[] = $this->create($row);
        }
        return $result;
    }

    public function findById($id)
    {
        $result = null;
        $this->db->where('INV_ID', $id);
        $consulta = $this->db->get('inventario');
        if ($consulta->num_rows() == 1) {
            $result = $this->create($consulta->row());
        }

        return $result;
    }

    public function findByArray($myarray = null)
    {
        $result = null;
        $res    = $this->db->get_where('inventario', $myarray);
        foreach ($res->result() as $row) {
            $result[] = $this->create($row);
        }

        return $result;
    }

    public function findByArrayLike($like = null, $campo = null, $campo2 = null)
    {
        $result = array();
        $this->db->like($campo, $like);
        $this->db->or_like($campo2, $like);
        $res = $this->db->get_where('inventario');
        foreach ($res->result() as $row) {
            $result[] = $this->create($row);
        }

        return $result;
    }

    public function findByArrayOne($myarray = null)
    {
        $this->load->database();
        $res    = $this->db->get_where('inventario', $myarray);
        $result = null;
        if ($res->num_rows() == 1) {
            $result = $this->create($res->row());
        }
        return $result;
    }

    public function findByArrayIN($arraydeIDinv = null, $arraycondiciones = null)
    {
        $this->load->database();
        $this->db->get('inventario');
        $this->db->or_where_in('INV_PROD_ID', $arraydeIDinv);
        $res    = $this->db->get_where('inventario', $arraycondiciones);
        $result = array();
        foreach ($res->result() as $row) {
            $result[] = $this->create($row);
        }
        return $result;
    }

    public function setColumns($row = null)
    {
        foreach ($row as $key => $value) {
            $this->columns[$key] = $value;
        }
    }

    public function findAllByInvProdId($id = null)
    {
        $this->load->database();
        $this->db->where('INV_PROD_ID', $id);
        $res    = $this->db->get('inventario');
        $result = array();
        foreach ($res->result() as $row) {
            $result[] = $this->create($row);
        }
        return $result;
    }

    public function findByTipProdYEstado($tipo = null, $estado = null)
    {
        $result = array();
        $bit    = null;
        $this->db->where('INV_TIPO_ID', $tipo);
        $this->db->where('INV_PROD_ESTADO', $estado);
        $consulta = $this->db->get('inventario');
        foreach ($consulta->result() as $row) {
            $result[] = $this->create($row);
        }
        return $result;
    }

    public function contarInventarioCritico()
    {
        $result = array();
        $this->db->select('inventario.INV_PROD_CODIGO,categoria.CAT_ID,tipoprod.TIPO_ID,categoria.CAT_NOMBRE,tipoprod.TIPO_NOMBRE,inventario.INV_PROD_NOM,inventario.INV_PROD_CANTIDAD,
    productos.PROD_STOCK_CRITICO,productos.PROD_STOCK_OPTIMO,productos.PROD_PRIORIDAD,ingreso.ING_TIPO_INGRESO');

        $this->db->from('inventario');
        $this->db->join('categoria', 'inventario.INV_CATEGORIA_ID = categoria.CAT_ID');
        $this->db->join('tipoprod', 'inventario.INV_TIPO_ID = tipoprod.TIPO_ID');
        $this->db->join('ingreso', 'inventario.INV_INGRESO_ID = ingreso.ING_ID');
        $this->db->join('productos', 'inventario.INV_PROD_ID = productos.PROD_ID');
        $this->db->where('inventario.INV_PROD_CANTIDAD <= productos.PROD_STOCK_CRITICO');
        $this->db->where('tipoprod.TIPO_ID = 2');

        $this->db->where('TIPO_ID', 2);

        $this->db->group_by('inventario.INV_PROD_NOM');
        $consulta = $this->db->get();

        if ($consulta != null) {
            $result = null;

            foreach ($consulta->result_array() as $row) {
                $result[] = $row;
            }

            if (is_null($result)) {
                $result = array(array(
                    "TIPO_ID"            => "0",
                    "INV_PROD_CODIGO"    => "0",
                    "INV_PROD_NOM"       => "SIN REGISTRO",
                    "TIPO_NOMBRE"        => "SIN REGISTRO",
                    "CAT_ID"             => "0",
                    "CAT_NOMBRE"         => "SIN REGISTRO",
                    "PROD_STOCK_OPTIMO"  => "0",
                    "PROD_STOCK_CRITICO" => "0",
                    "PROD_PRIORIDAD"     => "0",
                    "ING_TIPO_INGRESO"   => "0",
                    "INV_PROD_CANTIDAD"  => "0"));
            }
        }
        return $result;
    }

    public function selectCantidadStockById($id = null)
    {
/************/
        $this->db->select('INV_PROD_CANTIDAD');
        $this->db->where('INV_ID', $id);
        $query = $this->db->get('inventario');
        foreach ($query as $key => $value) {
            $cosa = $value['INV_PROD_CANTIDAD'];
        }
        return $cosa;
    }

    public function returnAllIdInventario()
    {
/************/
        $result = array();
        $querry = $this->db->query('SELECT inventario.INV_PROD_ID from inventario where inventario.INV_PROD_ESTADO =1');
        foreach ($querry->result_array() as $data) {
            $result[] = $data['INV_PROD_ID'];
        }
        return $result;
    }

    

}
