<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
	/*$hoy = getDate();*/
		parent::__construct();
		if ($this->session->userdata('logged_in')) {
		$this->layouthelper->SetMaster('layout');
		$this->load->model('DetSolicitud_Model','detalle',true);
		$this->load->model('Inventario_Model','inventario',true);
		$this->load->model('Producto_Model','producto',true);
	} else {
			redirect('/Login');
		}
	}

	public function dashboard()
	{
		$coun['solpen']=$this->detalle->count0();/*contador solicitudPendiendeRecepcionar*/
		$coun['solsinasig']=$this->detalle->count1();/*contador solicitudPendiendeRecepcionar*/
		$coun['baja']=$this->detalle->count2();/*contador productosBaja*/
		$coun['parciales']=$this->detalle->parciales();/*contador productosBaja*/

		$coun['activosHoy']=$this->detalle->productoActivoHoy();
		$coun['activosAyer']=$this->detalle->productoActivoAyer();
		$coun['activosAyer2']=$this->detalle->productoActivoAyer2();
		$coun['activosAyer3']=$this->detalle->productoActivoAyer3();
		$coun['activosAyer4']=$this->detalle->productoActivoAyer4();
		$coun['activosAyer5']=$this->detalle->productoActivoAyer5();
		$coun['activosAyer6']=$this->detalle->productoActivoAyer6();

		$coun['fungiblesHoy']=$this->detalle->productoFungiblesHoy();
		$coun['fungiblesAyer']=$this->detalle->productoFungiblesAyer();
		$coun['fungiblesAyer2']=$this->detalle->productoFungiblesAyer2();
		$coun['fungiblesAyer3']=$this->detalle->productoFungiblesAyer3();
		$coun['fungiblesAyer4']=$this->detalle->productoFungiblesAyer4();
		$coun['fungiblesAyer5']=$this->detalle->productoFungiblesAyer5();
		$coun['fungiblesAyer6']=$this->detalle->productoFungiblesAyer6();
		$coun['numberProduct0'] = 2;
      	$coun['numberProduct1'] = 3;

      	$total = count($this->producto->findAll());
      	$parte = count($this->producto->findByTipProd(1));
	    $porcentaje = round($parte / $total * 100);
      	$coun['percentProduct0'] = $porcentaje;
      	$coun['percentProduct1'] = count($this->producto->findByTipProd(2));
		/*$coun['we']=$this->detalle->prueba();*/
		$this->layouthelper->LoadView("dashboard/dashboard" ,$coun,false);
	}


	public function ej(){
		/*$we=  $this->producto->productoStockCritico(2);
		echo $we." ";
		$wr = $this->producto->findByTipProd(1);
		echo count($wr);*/
		/*$this->layouthelper->LoadView("dashboard/dashboard" , $data);*/
		/*echo round(7 / 9 * 100,9);*/
		$cantidadd = count($this->producto->findByTipProd(2))
		$ar[] = $this->producto->findByTipProd(2);
		foreach ($ar->result() as $key => $value) {
			$mos = $this->producto->productoStockCritico($value);
		}
		if ($mos == 0) {
			echo("error");
		}else{
			echo $mos;
		}
	}



}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
