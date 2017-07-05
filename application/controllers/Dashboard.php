<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        /*$hoy = getDate();*/
        parent::__construct();
        if ($this->session->userdata('logged_in')["cargo"][0] == 3 or $this->session->userdata('logged_in')["cargo"][0] == 4) {
            $this->layouthelper->SetMaster('layout');
        } else {
            redirect('/Login');
        }
    }

    public function dashboard()
    {
        $coun['solpen']     = $this->soli->count0(); /*contador solicitudPendiendeRecepcionar*/
        $coun['solsinasig'] = $this->soli->count1(); /*contador solicitudPendiendeRecepcionar*/
        $coun['baja']       = $this->baja->count2(array('BAJA_MOTIVO_ID !=' => 15,'MOT_DIF' => 1,"BAJA_TIPO" => 1)); /*contador productosBaja activos*/
        $coun['baja2']       = $this->baja->count2(array('BAJA_MOTIVO_ID' => 15,'MOT_DIF'=>1,"BAJA_TIPO" => 1)); /*contador productosBaja reparados activos*/
        $coun['parciales']  = $this->soli->parciales(); /*contador productosBaja*/

        $coun['activosHoy']   = $this->asignacion->productoActivoHoy();
        $coun['activosAyer']  = $this->asignacion->productoActivoAyer();
        $coun['activosAyer2'] = $this->asignacion->productoActivoAyer2();
        $coun['activosAyer3'] = $this->asignacion->productoActivoAyer3();
        $coun['activosAyer4'] = $this->asignacion->productoActivoAyer4();
        $coun['activosAyer5'] = $this->asignacion->productoActivoAyer5();
        $coun['activosAyer6'] = $this->asignacion->productoActivoAyer6();

        $coun['fungiblesHoy']   = $this->asignacion->productoFungiblesHoy();
        $coun['fungiblesAyer']  = $this->asignacion->productoFungiblesAyer();
        $coun['fungiblesAyer2'] = $this->asignacion->productoFungiblesAyer2();
        $coun['fungiblesAyer3'] = $this->asignacion->productoFungiblesAyer3();
        $coun['fungiblesAyer4'] = $this->asignacion->productoFungiblesAyer4();
        $coun['fungiblesAyer5'] = $this->asignacion->productoFungiblesAyer5();
        $coun['fungiblesAyer6'] = $this->asignacion->productoFungiblesAyer6();
        $coun['numberProduct0'] = 2;
        $coun['numberProduct1'] = 3;

        $total                   = count($this->prod->findAll());
        $parte                   = count($this->prod->findByTipProd(1));
        $porcentaje              = round($parte / $total * 100);
        $coun['percentProduct0'] = $porcentaje;
        $coun['percentProduct1'] = count($this->prod->findByTipProd(2));

        /*---------------------------------------------------------------------*/

        $coun['act'] = count($this->prod->productosCriticosDash());
        $coun['fun'] = count($this->inv->contarInventarioCritico());

        $this->layouthelper->LoadView("dashboard/dashboard", $coun, false);
    }

    public function msjCriticoActiv()
    {
        $proAc = $this->prod->productosCriticosDash();
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode(array("msjActi" => $proAc)));
    }

    public function msjFungi()
    {
        $vall = $this->inv->contarInventarioCritico();
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode(array("msjFungi" => $vall)));
    }

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
