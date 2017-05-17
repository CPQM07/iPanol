<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->layouthelper->SetMaster('layout');
		$this->load->model('DetSolicitud_Model','detalle',true);
		$this->load->model('DetSolicitud_Model','cont',true);
	}

	public function dashboard()
	{
		$coun['solpen']=$this->detalle->count0();/*contador solicitudPendiendeRecepcionar*/
		$coun['solsinasig']=$this->detalle->count2();/*contador solicitudPendiendeRecepcionar*/
		$coun['baja']=$this->cont->count1();/*contador productosBaja*/
		$this->layouthelper->LoadView("dashboard/dashboard" ,$coun,false);
	}



}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */

