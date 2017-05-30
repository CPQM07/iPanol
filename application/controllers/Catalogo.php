<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Producto_Model', 'Prod');
		$this->load->model('Categoria_Model', 'Cat');
		$this->load->model('TipoProd_Model', 'TipProd');
	}

	public function index()
	{
		//INICIO CATEGORIZACIÓN
		$busqueda = $this->Prod->findAll();
		if (isset($_POST['query'])) {
			$busqueda = $this->Prod->buscar($_POST['query']);
		}

		$dato['productos'] = $busqueda;
		$dato['categorias'] = $this->Cat->findAll();
		$dato['tipoProd'] = $this->TipProd->findAll();

        $this->load->library('pagination');
        
        $config['base_url'] = base_url("/Catalogo/index");
        $config['total_rows'] = $this->Prod->num_post();
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
        $result = $this->Prod->get_pagination($config['per_page']);
        $dato['consulta'] = $result;
        $dato['pagination'] = $this->pagination->create_links();
        //FIN PAGINACIÓN        

		$this->load->view('Catalogo/catalogo', $dato, FALSE);
	}

	public function contactanos()
	{
		$this->load->view('Catalogo/contactanos', FALSE);
	}

	public function porCategoria($id){
		$dato['productos'] = $this->Prod->findByCat($id);
		//$dato['productos'] = $this->Prod->findByTipProd($id);
		$dato['categorias'] = $this->Cat->findAll();
		$dato['tipoProd'] = $this->TipProd->findAll();
		$this->load->view('Catalogo/catalogo', $dato, FALSE);
	}

	public function porTipoProducto($id){
		$dato['productos'] = $this->Prod->findByCat($id);
		//$dato['productos'] = $this->Prod->findByTipProd($id);
		$dato['tipoProd'] = $this->TipProd->findAll();
		$dato['categorias'] = $this->Cat->findAll();
		$this->load->view('Catalogo/catalogo', $dato, FALSE);
	}
	
}

/* End of file catalogo.php */
/* Location: ./application/controllers/catalogo.php */