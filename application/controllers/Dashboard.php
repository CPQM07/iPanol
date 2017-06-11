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

      	/*---------------------------------------------------------------------*/


      	
		$this->layouthelper->LoadView("dashboard/dashboard" ,$coun,false);
	}


	public function msjCriticoActiv(){
		$id = $_POST['acti'];
		$NuevoProducto = array();
	  $productos = $this->producto->findByTipProd($id);//tipo 1 activo | tipo 2 fingible
	  $larg = count($productos);
	  foreach ($productos as $key => $value) {
		    $NuevoProducto[] = array(
		      'PROD_ID' => $value->get('PROD_ID'),
		      'PROD_NOMBRE' => $value->get('PROD_NOMBRE'),
		      'PROD_STOCK_TOTAL' => $value->get('PROD_STOCK_TOTAL'),
		      'PROD_STOCK_CRITICO' => $value->get('PROD_STOCK_CRITICO'),
		      'PROD_CAT_ID' => $value->get('PROD_CAT_ID'),
		      'PROD_TIPOPROD_ID' => $value->get('PROD_TIPOPROD_ID'),
		      'PROD_POSICION' => $value->get('PROD_POSICION'),
		      'PROD_PRIORIDAD' => $value->get('PROD_PRIORIDAD'),
		      'PROD_STOCK_OPTIMO' => $value->get('PROD_STOCK_OPTIMO'),
		      'PROD_DIAS_ANTIC' => $value->get('PROD_DIAS_ANTIC'),
		      'PROD_IMAGEN' => $value->get('PROD_IMAGEN'),
		      'PROD_ESTADO' => $value->get('PROD_ESTADO')
		    );

		}

		$msjCriticoActiv = array();

		for ($i=0; $i < $larg; $i++) {
			$cantid = count($this->inventario->findAllByInvProdId($i));
			$nuevoP[] = $NuevoProducto[$i];

			foreach ($nuevoP as $data) {
		      $stockCritico = $data['PROD_STOCK_CRITICO'];
		      $nombreProducto = $data['PROD_NOMBRE'];
			}

		    if ($stockCritico>$cantid) {
		    	$msj = "Producto: ".$nombreProducto."<br/>Cantidad: ".$cantid." | Limite crítico: ".$stockCritico."<br/><br/>";
			    $msjCriticoActiv = array($msj);
		    }
     	}
		$this->output->set_content_type('application/json');
     	$this->output->set_output(json_encode(array("msjActivo" =>$msjCriticoActiv)));
	}

	public function msjCriticoFungible(){
		$id = $_POST['fungi'];
		$NuevoProducto = array();
	  $productos = $this->producto->findByTipProd($id);//tipo 1 activo | tipo 2 fingible
	  $larg = count($productos);
	  foreach ($productos as $key => $value) {
		    $NuevoProducto[] = array(
		      'PROD_ID' => $value->get('PROD_ID'),
		      'PROD_NOMBRE' => $value->get('PROD_NOMBRE'),
		      'PROD_STOCK_TOTAL' => $value->get('PROD_STOCK_TOTAL'),
		      'PROD_STOCK_CRITICO' => $value->get('PROD_STOCK_CRITICO'),
		      'PROD_CAT_ID' => $value->get('PROD_CAT_ID'),
		      'PROD_TIPOPROD_ID' => $value->get('PROD_TIPOPROD_ID'),
		      'PROD_POSICION' => $value->get('PROD_POSICION'),
		      'PROD_PRIORIDAD' => $value->get('PROD_PRIORIDAD'),
		      'PROD_STOCK_OPTIMO' => $value->get('PROD_STOCK_OPTIMO'),
		      'PROD_DIAS_ANTIC' => $value->get('PROD_DIAS_ANTIC'),
		      'PROD_IMAGEN' => $value->get('PROD_IMAGEN'),
		      'PROD_ESTADO' => $value->get('PROD_ESTADO')
		    );

		}

		$msjCriticoFungi = array();

		for ($i=0; $i < $larg; $i++) {
			$cantid = count($this->inventario->findAllByInvProdId($i));
			$nuevoP[] = $NuevoProducto[$i];

			foreach ($nuevoP as $data) {
		      $stockCritico = $data['PROD_STOCK_CRITICO'];
		      $nombreProducto = $data['PROD_NOMBRE'];
			}

		    if ($stockCritico>$cantid) {
		    	$msj = "Producto: ".$nombreProducto."<br/>Cantidad: ".$cantid." | Limite crítico: ".$stockCritico."<br/><br/>";
			    $msjCriticoFungi = array($msj);
		    }

			$this->output->set_content_type('application/json');
     		$this->output->set_output(json_encode(array("msjFungible"=>$msjCriticoFungi )));
		}
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
