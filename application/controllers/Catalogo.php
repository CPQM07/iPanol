<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Producto_Model', 'prod');
		$this->load->model('Categoria_Model', 'cat');
		$this->load->model('TipoProd_Model', 'tipprod');
		$this->load->model('Inventario_Model', 'inv');
		$this->load->model('Usuario_Model', 'usu');
		$this->load->model('Solicitud_Model','soli');
        $this->load->model('DetSolicitud_Model','detsol');
	}

	public function index()
	{
		$this->load->library('pagination');
		$like = null;$cat = null;$tipo = null;
		if (isset($_POST['query']))$like = $_POST['query'];
		if (isset($_GET['cat']))$cat = $_GET['cat'];
		if (isset($_GET['tipo']))$tipo = $_GET['tipo'];
		$dato['categorias'] = $this->cat->findAll();
		$dato['tipoProd'] = $this->tipprod->findAll();
        $config['base_url'] = base_url("index.php/Catalogo/index");
        $config['total_rows'] = $this->prod->contar($like,$cat,$tipo);
        $config['per_page'] = 6;
        $config['uri_segment'] = 3;
        $config['num_links'] = 5;
        $config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';    
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $productos = $this->prod->fetch_productos($config["per_page"], $page,$like,$cat,$tipo);
    
    	if ($productos != null) {
			foreach ($productos as $key => $value) {
        	$CANTIDAD = 0;
        	if ($value["PROD_TIPOPROD_ID"] == 1) {
        		$CANTIDAD = count($this->inv->findByArray(array('INV_PROD_ID' => $value["PROD_ID"] ,'INV_PROD_ESTADO'	=> 1)));
        	}else if($value["PROD_TIPOPROD_ID"] == 2){
        	$inventariotipofungible = $this->inv->findByArray(array('INV_PROD_ID' => $value["PROD_ID"] ,'INV_PROD_ESTADO'	=> 1));
        	if ($inventariotipofungible != null) {
        		$CANTIDAD = $inventariotipofungible[0]->get("INV_PROD_CANTIDAD");
        		}	
        	}

        	$productos[$key]["STOCKACTUAL"] = $CANTIDAD; 
        }
    	}
      

        $dato["consulta"] = $productos;
        $dato['pagination'] = $this->pagination->create_links();
		$this->load->view('Catalogo/catalogo', $dato, FALSE);
	}

	public function contactanos()
	{
		$this->load->view('Catalogo/contactanos', FALSE);
	}

	public function carrito()
	{
		$this->load->view('Catalogo/carrito', FALSE);
	}

	public function porCategoria($id){
		$dato['productos'] = $this->prod->findByCat($id);
		//$dato['productos'] = $this->prod->findByTipProd($id);
		$dato['categorias'] = $this->cat->findAll();
		$dato['tipoProd'] = $this->tipprod->findAll();
		$this->load->view('Catalogo/catalogo', $dato, FALSE);
	}

	public function porTipoProducto($id){
		$dato['productos'] = $this->prod->findByCat($id);
		//$dato['productos'] = $this->prod->findByTipProd($id);
		$dato['tipoProd'] = $this->tipprod->findAll();
		$dato['categorias'] = $this->cat->findAll();
		$this->load->view('Catalogo/catalogo', $dato, FALSE);
	}

	public function insert_solicitud_from_catalogo(){
		$fecha_actual = date("Y/m/d");
		$mcantidadArticulo = $_POST["mcantidadArticulo"];
	    $mcantidadGruTrab = $_POST["mcantidadGruTrab"];
	    $mfechaEntrega = $_POST["mfechaEntrega"];
	    $masignaturas = $_POST["masignaturas"];
	    $detalle = $POST['detalle'];

	    $usersession = $this->session->userdata('logged_in');

	if (isset($_POST["mcantidadArticulo"]) and isset($_POST["mcantidadGruTrab"]) and isset($_POST["mfechaEntrega"]) and 
		isset($_POST["masignaturas"]) and isset($_POST["detalle"])) {

      $solicitud = $_POST['detallesolicitud']; 
      $_columns  =  array(
		'SOL_ID' => 0,
		'SOL_USU_RUT' => $usersession['rut3'],
		'SOL_ASIG_ID' => $masignaturas,
		'SOL_FECHA_INICIO' => $fecha_actual,
		'SOL_FECHA_TERMINO' => $mfechaEntrega,
		'SOL_NRO_GRUPOTRAB' => $mcantidadGruTrab,
		'SOL_OBSERVACION' => 0,
		'SOL_RUTA_PDF' => '',
		'SOL_ESTADO' => 1
		);

      $this->soli->create($_columns);
      $ultimoIngresado = $this->soli->insert();

      foreach ($detalle as $key => $value) {
      	$_columns  =  array(
			'DETSOL_ID' => 0,
			'DETSOL_TIPOPROD' => $value['tipo'],
			'DETSOL_CANTIDAD' => $value['cantidad'],
			'DETSOL_ESTADO' => 1,
			'DETSOL_SOL_ID' => $ultimoIngresado,
			'DETSOL_PROD_ID' => $value['pro_id'],
			);
      	$this->detsol->create($_columns);
      	$this->detsol->insert();
      }
          
      }
    }


	
}


/*
public function findById($id){
    $result = null;
    $this->db->where('USU_RUT',$id);
    $consulta = $this->db->get('usuario');
    if($consulta->num_rows() == 1){
      $result = $this->create($consulta->row());
    }
    
    return $result;
  }
*/


/* End of file catalogo.php */
/* Location: ./application/controllers/catalogo.php */