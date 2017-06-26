<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		/*$hoy = getDate();*/
		parent::__construct();
		if ($this->session->userdata('logged_in')["cargo"][0] == 3 or $this->session->userdata('logged_in')["cargo"][0] == 4) {
			$this->layouthelper->SetMaster('layout');
			$this->load->model('Solicitud_Model','solicitud',true);
			$this->load->model('Inventario_Model','inventario',true);
			$this->load->model('Producto_Model','producto',true);
			$this->load->model('Asignacion_Model','asignacion',true);
	    }else{
	      redirect('/Login');
	    }
	}

	public function dashboard()
	{
		$coun['solpen']=$this->solicitud->count0();/*contador solicitudPendiendeRecepcionar*/
		$coun['solsinasig']=$this->solicitud->count1();/*contador solicitudPendiendeRecepcionar*/
		$coun['baja']=$this->inventario->count2();/*contador productosBaja*/
		$coun['parciales']=$this->solicitud->parciales();/*contador productosBaja*/

		$coun['activosHoy']=$this->asignacion->productoActivoHoy();
		$coun['activosAyer']=$this->asignacion->productoActivoAyer();
		$coun['activosAyer2']=$this->asignacion->productoActivoAyer2();
		$coun['activosAyer3']=$this->asignacion->productoActivoAyer3();
		$coun['activosAyer4']=$this->asignacion->productoActivoAyer4();
		$coun['activosAyer5']=$this->asignacion->productoActivoAyer5();
		$coun['activosAyer6']=$this->asignacion->productoActivoAyer6();

		$coun['fungiblesHoy']=$this->asignacion->productoFungiblesHoy();
		$coun['fungiblesAyer']=$this->asignacion->productoFungiblesAyer();
		$coun['fungiblesAyer2']=$this->asignacion->productoFungiblesAyer2();
		$coun['fungiblesAyer3']=$this->asignacion->productoFungiblesAyer3();
		$coun['fungiblesAyer4']=$this->asignacion->productoFungiblesAyer4();
		$coun['fungiblesAyer5']=$this->asignacion->productoFungiblesAyer5();
		$coun['fungiblesAyer6']=$this->asignacion->productoFungiblesAyer6();
		$coun['numberProduct0'] = 2;
      	$coun['numberProduct1'] = 3;

      	$total = count($this->producto->findAll());
      	$parte = count($this->producto->findByTipProd(1));
	    $porcentaje = round($parte / $total * 100);
      	$coun['percentProduct0'] = $porcentaje;
      	$coun['percentProduct1'] = count($this->producto->findByTipProd(2));

      	/*---------------------------------------------------------------------*/

      	$coun['act'] = count($this->producto->productosCriticosDash());
		$coun['fun'] = count($this->inv->contarInventarioCritico());


      	
		$this->layouthelper->LoadView("dashboard/dashboard" ,$coun,false);
	}


	public function msjCriticoActiv(){
	  	$proAc = $this->producto->productosCriticosDash();
		$this->output->set_content_type('application/json');
     	$this->output->set_output(json_encode(array("msjActi" =>$proAc)));
	}

	public function msjFungi(){
		$vall = $this->inv->contarInventarioCritico();
		$this->output->set_content_type('application/json');
     	$this->output->set_output(json_encode(array("msjFungi" =>$vall)));
	}



}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
