<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in')["cargo"][0] == 1 or $this->session->userdata('logged_in')["cargo"][0] == 2) {
			$this->load->model('Producto_Model', 'prod');
			$this->load->model('Categoria_Model', 'cat');
			$this->load->model('TipoProd_Model', 'tipprod');
			$this->load->model('Inventario_Model', 'inv');
			$this->load->model('Usuario_Model', 'usu');
			$this->load->model('Solicitud_Model','soli');
	        $this->load->model('DetSolicitud_Model','detsol');
	        $this->load->model('Asignatura_Model','asig');
	    }else{
	      redirect('/Login');
	    }
	}

	public function index()
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url("index.php/Catalogo/index");
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url("index.php/Catalogo/index/");
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$dato['categorias'] = $this->cat->findAll();
		$dato['tipoProd'] = $this->tipprod->findAll();
        $config['total_rows'] = $this->prod->contar(null,null,null);
        $config['per_page'] = 6;
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
        
        $productos = $this->prod->fetch_productos($config["per_page"], $page,null,null,null);
    
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

	public function categoria($categoria = null)
	{
		$this->load->library('pagination');

			$config['uri_segment'] = 4;
			$config['base_url'] = base_url("index.php/Catalogo/categoria/".$categoria);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$dato['categorias'] = $this->cat->findAll();
		$dato['tipoProd'] = $this->tipprod->findAll();
        
        $config['total_rows'] = $this->prod->contar(null,$categoria,null);
        $config['per_page'] = 6;
        
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
        
        $productos = $this->prod->fetch_productos($config["per_page"], $page,null,$categoria,null);
    
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

	public function tipo($tipo = null)
	{
		$this->load->library('pagination');

			$config['uri_segment'] = 4;
			$config['base_url'] = base_url("index.php/Catalogo/tipo/".$tipo);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$dato['categorias'] = $this->cat->findAll();
		$dato['tipoProd'] = $this->tipprod->findAll();
        
        $config['total_rows'] = $this->prod->contar(null,null,$tipo);
        $config['per_page'] = 6;
        
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
        
        $productos = $this->prod->fetch_productos($config["per_page"], $page,null,null,$tipo);
    
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

	public function buscar($like = null)
	{
		$like = str_replace("%20", " ", $like);
		$this->load->library('pagination');
		$config['uri_segment'] = 4;
		$config['base_url'] = base_url("index.php/Catalogo/buscar/".$like);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$dato['categorias'] = $this->cat->findAll();
		$dato['tipoProd'] = $this->tipprod->findAll();
        
        $config['total_rows'] = $this->prod->contar($like,null,null);
        $config['per_page'] = 6;
        
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
        
        $productos = $this->prod->fetch_productos($config["per_page"], $page,$like,null,null);
    
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
		$data["asignaturas"] = $this->asig->findAll(array("ASIGNATURA_ESTADO" => 1));
		$this->load->view('Catalogo/carrito',$data, FALSE);
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

	public function crearsolicitud(){
		$usersession = $this->session->userdata('logged_in');
	  if (isset($_SESSION['productos'][$usersession["rut"]]) and $_SESSION['productos'][$usersession["rut"]] != null and $this->input->post('fechaEntrega') != "" and $this->input->post('cantidadGruTrab') != "") {
	  	$fecha_actual = date("Y-m-d H:i:s");

	  	if ($this->input->post('fechaEntrega') > $fecha_actual) {
	  		$cantidadGruTrab = $_POST["cantidadGruTrab"];
		  	$fechaEntrega = $_POST["fechaEntrega"];
		  	$asignaturas = $_POST["asignaturas"];
		  	$_columns  =  array(
						'SOL_ID' => 0,
						'SOL_USU_RUT' => $usersession['rut'],
						'SOL_ASIG_ID' => $asignaturas,
						'SOL_FECHA_INICIO' => $fecha_actual,
						'SOL_FECHA_TERMINO' => $fechaEntrega,
						'SOL_NRO_GRUPOTRAB' => $cantidadGruTrab,
						'SOL_OBSERVACION' => "",
						'SOL_RUTA_PDF' => '',
						'SOL_ESTADO' => 1
						);
	        $nuevasolicitud =  $this->soli->create($_columns);
	        $ultimoIngresado = $nuevasolicitud->insert();
	        foreach ($_SESSION['productos'][$usersession["rut"]] as $key => $value) {
		      	$_columns  =  array(
					'DETSOL_ID' => 0,
					'DETSOL_TIPOPROD' => $value['tipoid'],
					'DETSOL_CANTIDAD' => $value['cantidad'],
					'DETSOL_ESTADO' => 1,
					'DETSOL_SOL_ID' => $ultimoIngresado,
					'DETSOL_PROD_ID' => $value['productoid'],
					);
		      $detallesol =$this->detsol->create($_columns);
		      $detallesol->insert();
		    }
		    $data["detalle"] = $_SESSION['productos'][$usersession["rut"]];
		    $data["ultimoID"] = $ultimoIngresado;
		    $data["fechaentrega"] = $fechaEntrega;
		    $data["nombreuser"] = $usersession['nombres']." ".$usersession['apellidos'];
		    $data["grupo"] = $cantidadGruTrab;

		    if (intval($ultimoIngresado) > 0) {
		    	$_SESSION["productos"][$usersession["rut"]] = null;
		    	$this->load->view('Catalogo/confirmacion', $data, FALSE);
		    }else{
		    	$this->session->set_flashdata('camposvacios', 'Lo sentimos ocurrio un error inesperado revise que este correctamente logeado');
	  			redirect('Catalogo/carrito','refresh');
		    }		    
	  	}else{
	  		$this->session->set_flashdata('camposvacios', 'Lo sentimos la fecha de entrega ingresada no puede ser mayor a la fecha actual, minutos y segundos tambien son contabilizados¡¡');
	  	redirect('Catalogo/carrito','refresh');
	  	}
	  }else{
	  	$this->session->set_flashdata('camposvacios', 'Lo sentimos existe alguno de los campos vacios, o no tiene productos agregados al carrito, favor revisar (Fecha,Grupo,Asignatura,Productos).');
	  	redirect('Catalogo/carrito','refresh');
	  }

    }

    public function agregarCarrito(){
      $usersession = $this->session->userdata('logged_in');
      $tipo ="";
      $myarray = array();
      if (isset($_SESSION["productos"][$usersession["rut"]])) {
      	$myarray = $_SESSION["productos"][$usersession["rut"]];
      }
      $producto = $this->prod->findById($_POST["idprod"]);
      if ($producto->get("PROD_TIPOPROD_ID") == 1)$tipo = "Activo";
      if ($producto->get("PROD_TIPOPROD_ID") == 2)$tipo = "Fungible";
      $myarray[] = array("productoid" => $_POST["idprod"],"nombre" => $producto->get("PROD_NOMBRE"),"tipo" => $tipo,"cantidad" => $_POST["cantidad"],"tipoid" => $producto->get("PROD_TIPOPROD_ID"));
      $_SESSION["productos"][$usersession["rut"]] = $myarray;
      $this->output->set_content_type('application/json');
      $this->output->set_output(json_encode(array("estado" => true ,"prodnombre" => $producto->get("PROD_NOMBRE"),"total" => count($myarray))));
    }

    public function limpiarCarrito(){
    	$usersession = $this->session->userdata('logged_in');
    	$_SESSION["productos"][$usersession["rut"]] = null;
    }

    public function eliminarindexcarrito(){
    	$usersession = $this->session->userdata('logged_in');
    	$indiceaeliminar = $_POST["indice"];
    	$myarray = $_SESSION["productos"][$usersession["rut"]];
    	unset($myarray[$indiceaeliminar]);
    	$_SESSION["productos"][$usersession["rut"]] = $myarray;
    	$this->output->set_content_type('application/json');
        $this->output->set_output(json_encode(array("estado" => true,"total" => count($myarray))));
    }

    public function confirmacion(){
    	$this->load->view('Catalogo/confirmacion', FALSE);
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