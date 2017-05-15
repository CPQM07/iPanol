<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->layouthelper->SetMaster('layout');
	}

	public function dashboard()
	{
		$this->layouthelper->LoadView("dashboard/dashboard" ,null);
	}


}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */