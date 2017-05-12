<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Layouthelper
{
	public $data		= array("CONTENT" => "UPS olvidaste cargar el contenido de la vista ¡¡");
	public $master;
	private $CI;

	public function __construct($layout = 'default')
	{
		$this->CI		= get_instance();
		$this->master	= "mainlayout/".$layout;
	}

	public function SetMaster($view = null){
		 $this->master = "mainlayout/".$view;
	}

	public function LoadView($view = null , $datarray = null ,$bool = false){
		$this->data["CONTENT"] = $view;
		if ($datarray != null) {
				foreach ($datarray as $key => $value) {
				$this->data[$key] = $value;
			}
		}
		return $this->CI->load->view($this->master, $this->data, $bool);
	}
}


//CREADO POR DIEGO LLANTEN
