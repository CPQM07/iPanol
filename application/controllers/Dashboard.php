<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->layouthelper->SetMaster('layout');
		$this->load->model('DetSolicitud_Model','detalle',true);
	}

	public function dashboard()
	{
		$coun['solpen']=$this->detalle->count();
		$this->layouthelper->LoadView("dashboard/dashboard" ,$coun,false);
	}



}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */

