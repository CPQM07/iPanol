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


      	
		$this->layouthelper->LoadView("dashboard/dashboard" ,$coun,false);
	}


	public function msjCriticoActiv(){
		/*$id = $_POST['acti'];*/
		$id=1;
		$NuevoProducto = array();
	  $productos = $this->producto->findByTipProd($id);//tipo 1 activo | tipo 2 fingible
/*	  $larg = count($productos);
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
		$stockCritico = array();
		$nombreProducto = array();
		for ($i=0; $i < $larg; $i++) {
			$cantid = count($this->inventario->findAllByInvProdId($i));
			$nuevoP[] = $NuevoProducto[$i];

			foreach ($nuevoP as $data) {
		      $stockCritico = array($data['PROD_STOCK_CRITICO']);
		      $nombreProducto = array($data['PROD_NOMBRE']);
			}

		    if ($stockCritico>$cantid) {
		    	$msj = "Producto: ".$nombreProducto[0]."<br/>Cantidad: ".$cantid." | Limite crítico: ".$stockCritico[0]."<br/><br/>";
			    $msjCriticoActiv[$i] = array($msj);
		    }
     	}
*/

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


		/*$this->output->set_content_type('application/json');
     	$this->output->set_output(json_encode(
     		array("msjActivo" =>$msjCriticoActiv,"cantida" => count($msjCriticoActiv))
     		));*/
	}
















	public function msjCriticoFungible(){
		/*$id = $_POST['fungi'];*/
		$id=2;
		$NuevoProducto = array();
		$productos = $this->producto->findByTipProd($id);//tipo 1 activo | tipo 2 fingible
		$larg = count($productos);
		foreach ($productos as $key => $value) {
		    $NuevoProducto[] = array(
		      'PROD_ID' => $value->get('PROD_ID'),
		      'PROD_NOMBRE' => $value->get('PROD_NOMBRE'),
		      'PROD_STOCK_CRITICO' => $value->get('PROD_STOCK_CRITICO')
		    );
		}

		$NuevoInventario = array();
		$inven = $this->inventario->findByTipProdYEstado(2,1);
		foreach ($inven as $key => $value) {
	        $NuevoInventario[] = array(
	          'INV_ID' => $value->get('INV_ID'),
	          'INV_PROD_ID' => $value->get('INV_PROD_ID'),
	          'INV_PROD_NOM' => $value->get('INV_PROD_NOM'),
	          'INV_PROD_CANTIDAD' => $value->get('INV_PROD_CANTIDAD')
	        );
	      }

		$msjCriticoFungi = array();
		$msj = "";
		$cantStockProduct= array();
		$cantStockInven= array();
		$nombreProducto="";
		//print_r($this->inventario->returnAllIdInventario());
		for ($i=0; $i < $larg; $i++) {

			//$cantid = count($this->inventario->findAllByInvProdId($i));
			foreach ($NuevoProducto as $data) {
			    $cantStockProduct = array($data['PROD_STOCK_CRITICO']);
			    $nombreProducto = $data['PROD_NOMBRE'];

				foreach ($NuevoInventario as $data) {
				    $cantStockInven = array($data['INV_PROD_CANTIDAD']);
				/*echo $cantStockProduct." - ".$nombreProducto." | "."Stock actual: ".$cantStockInven." | <br>";*/

				    if ($cantStockProduct>$cantStockInven) {
				    	$msj = "Producto: ".$nombreProducto."<br/>Cantidad: ".$cantStockInven[0]." | Stock crítico: ".$cantStockProduct[0]."<br/><br/>";
				    	}
				    $msjCriticoFungi[$i] = array($msj);
				}

			}
		}
		$fungCant = count($msjCriticoFungi);
		$this->output->set_content_type('application/json');
 		$this->output->set_output(json_encode(array("msjFungible"=>$msjCriticoFungi,"cantida" => count($msjCriticoFungi) )));
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
