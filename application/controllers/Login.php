<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usuario_Model', 'usuario');
	}
	public function index()
	{
	    $this->session->unset_userdata('logged_in');//matamos la session apenas entre al login
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data =array();
		if(isset($_REQUEST['user']) && isset($_REQUEST['password']))
		{
			$user     =  $_REQUEST['user'];
			$password =	 $_REQUEST['password'];
		   $this->form_validation->set_rules('user', 'user', 'trim|required|xss_clean');
		   $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean|callback_check_database');
			   if($this->form_validation->run())
		   {
		   		$user = $this->session->userdata('logged_in');
	   			if(count($user['cargo']) > 0){
					if (in_array(1, $user['cargo'])) {
	   					redirect('Catalogo','refresh');
	   				}elseif (in_array(2, $user['cargo'])) {
	   					redirect('Catalogo','refresh');
	   				}elseif (in_array(3, $user['cargo'])) {
	   					redirect('dashboard/dashboard','refresh');
	   				}elseif (in_array(4, $user['cargo'])) {
	   					redirect('dashboard/dashboard','refresh');
	   				}
	   			}else{
   					session_destroy();
  					$this->session->unset_userdata('logged_in');
	   				$data['error'] = 'Usted no cuenta con los privilegios necesarios para ingresar al sistema';
	   			}

		   }else
		   {
		   	   $data['error'] = "Credenciales no validas";
		   }

		}
		$this->load->view('contentlayout/login/login',$data);
	}

	function logout(){
	   session_destroy();
	   $this->session->unset_userdata('logged_in');
	   redirect('/Login/index', 'refresh');
	}
 	function check_database($pass)
 	{
	   $user = $this->input->post('user');
	   if($this->valida_rut($user)){
		   	$rut = explode("-",$user);
		   	$user = $this->usuario->login($rut[0], $pass);
	   }else{
	   		$user = null;
	   }
	   $existe = false;
	   if(!is_null($user)){
	     	$sess_array = array();
				$sess_array = array(
				  'rut' => $user->get('USU_RUT'),
				  'dv' => $user->get('USU_DV'),
				  'nombres' => $user->get('USU_NOMBRES'),
				  'apellidos' => $user->get('USU_APELLIDOS'),
				  'cargo' =>$user->getCargo(),
				  'carrera' => $user->getCarrera(),
				  'correo' => $user->get('USU_EMAIL'),
				  'telefono1' => $user->get('USU_TELEFONO1'),
				  'telefono2' => $user->get('USU_TELEFONO2')
				);
	       $this->session->set_userdata('logged_in', $sess_array);
				 $existe = true;
	   }
	   return $existe;
	}

	function valida_rut($rut)
	{
	    $rut = preg_replace('/[^k0-9]/i', '', $rut);
	    $dv  = substr($rut, -1);
	    $numero = substr($rut, 0, strlen($rut)-1);
	    $i = 2;
	    $suma = 0;
	    foreach(array_reverse(str_split($numero)) as $v)
	    {
	        if($i==8)
	            $i = 2;
	        $suma += $v * $i;
	        ++$i;
	    }
	    $dvr = 11 - ($suma % 11);

	    if($dvr == 11)
	        $dvr = 0;
	    if($dvr == 10)
	        $dvr = 'K';
	    if($dvr == strtoupper($dv))
	        return true;
	    else
	        return false;
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */
