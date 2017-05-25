<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {


 public function __construct()
  {
    parent::__construct();
    $this->layouthelper->SetMaster('layout');
	$this->load->model('Reporte_Model','reporte',true);
  }


	public function Vistastockcritico(){
		$this->layouthelper->Loadview("reportes/stockcritico", null);
	}
		public function Vistastockactual(){
		$this->layouthelper->Loadview("reportes/stockactual", null);
	}
		public function Vistamotivosbaja(){
		$this->layouthelper->Loadview("reportes/motivosbaja", null);
	}
		public function Vistavidautil(){
		$this->layouthelper->Loadview("reportes/vidautil", null);
	}

	public function Traercriticos(){
		 $dato = $_POST['reporte'];//recibe quien tenga la name="reporte"
		 $reporte = $this->reporte->findAllCriticos();
		 $datoB['criticos'] = $reporte;
		 $this->load->view('reportes/stockcritico',$datoB,false);

	}
	public function Traeractuales(){
		 $dato = $_POST['reporte'];
		 $reporte = $this->reporte->findAllProductos();
		 $datoB['actuales'] = $reporte;
		 $this->load->view('reporte/stockactual',$datoB,false);
	}
	public function Traerbajas(){
		$dato = $_POST['reporte'];
		$reporte = $this->reporte->motivosdebaja();
		$datoB['bajas'] = $reporte;
		$this->load->view('reporte/motivosdebaja',$datoB,false);
	}
	public function Traervidautil(){
		$dato = $_POST['reporte'];
		$reporte = $this->reporte->vidautil();
		$datoB['vida'] = $reporte;
		$this->load->view('reporte/vidautil',$datoB);

	}



}

/* End of file reportes.php */
/* Location: ./application/controllers/reportes.php */