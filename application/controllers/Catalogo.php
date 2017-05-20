<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogo extends CI_Controller {

	public function index()
	{
		$this->load->model('Producto_Model', 'Prod');
		$this->load->model('Categoria_Model', 'Cat');
		$dato['productos'] = $this->Prod->findAll();
		$dato['categorias'] = $this->Cat->findAll();
		$this->load->view('Catalogo/catalogo', $dato, FALSE);
	}

	public function carrito()
	{
		$this->load->view('Catalogo/carrito', FALSE);
	}

	public function contactanos()
	{
		$this->load->view('Catalogo/contactanos', FALSE);
	}

	public function porCategoria($id){
		$this->load->model('Producto_Model', 'Prod');
		$this->load->model('Categoria_Model', 'Cat');
		$dato['productos'] = $this->Prod->findByCat($id);
		$dato['categorias'] = $this->Cat->findAll();
		$this->load->view('Catalogo/catalogo', $dato, FALSE);
	}

}

/* End of file catalogo.php */
/* Location: ./application/controllers/catalogo.php */