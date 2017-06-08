<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {


 public function __construct()
  {
    parent::__construct();
    $this->layouthelper->SetMaster('layout');
  $this->load->model('Reporte_Model','reporte',true);
  $this->load->model('Categoria_Model','categorias',true);
  }

//METODO PARA LOS REPORTES DE LA VIDA UTIL .... DATOS ASOCIADOS AL ARRAY Y LUEGO SE LES OTORGA EL VALOR DE LA VARIABLE LA CUAL CONTIENE LOS DATOS DE LA CONSULTA
  public function Pdfcritico(){
  
      $datosC = $this->reporte->findAllCriticos();
    $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
      $pdf->SetFont('dejavusans', '', 7, '', true);
      $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                   Reporte de Productos en Stock Critico', "");
      $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
      $pdf->AddPage();

 $htmlpdf = $pdf->reporteCritico($datosC); //DEFINIR METODO QUE ESPECIFICA EL PDF AL QUE PERTENECE
   $pdf->writeHTML($htmlpdf, true, false, true, false, '');
      ob_clean();
        $pdf->Output('', 'I');
  
  }
//METODO PARA LOS REPORTES DE LA VIDA UTIL .... DATOS ASOCIADOS AL ARRAY Y LUEGO SE LES OTORGA EL VALOR DE LA VARIABLE LA CUAL CONTIENE LOS DATOS DE LA CONSULTA
  public function Pdfactual(){
 
      $datosA= $this->reporte->findAllProductos();
    $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
      $pdf->SetFont('dejavusans', '', 7, '', true);
      $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                   Reporte de Productos Actuales', "");
      $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
      $pdf->AddPage();

 $htmlpdf = $pdf->reporteActual($datosA); //DEFINIR METODO QUE ESPECIFICA EL PDF AL QUE PERTENECE
   $pdf->writeHTML($htmlpdf, true, false, true, false, '');
      ob_clean();
        $pdf->Output('', 'I');
  
  }
//METODO PARA LOS REPORTES DE LA VIDA UTIL .... DATOS ASOCIADOS AL ARRAY Y LUEGO SE LES OTORGA EL VALOR DE LA VARIABLE LA CUAL CONTIENE LOS DATOS DE LA CONSULTA
    public function Pdfbaja(){

      $datosM = $this->reporte->motivosdebaja();
    $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
      $pdf->SetFont('dejavusans', '', 7, '', true);
      $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                   Reporte de Productos Dados de Baja', "");
      $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
      $pdf->AddPage();

 $htmlpdf = $pdf->reporteBajas($datosM); //DEFINIR METODO QUE ESPECIFICA EL PDF AL QUE PERTENECE
   $pdf->writeHTML($htmlpdf, true, false, true, false, '');
      ob_clean();
        $pdf->Output('', 'I');

  }
  //METODO PARA LOS REPORTES DE LA VIDA UTIL .... DATOS ASOCIADOS AL ARRAY Y LUEGO SE LES OTORGA EL VALOR DE LA VARIABLE LA CUAL CONTIENE LOS DATOS DE LA CONSULTA
    public function Pdfvida(){
   
      $datosV = $this->reporte->vidautil();
      print_r($datosV);
      exit();
    $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
      $pdf->SetFont('dejavusans', '', 7, '', true);
      $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                   Reporte de Vida Util de los Productos', "");
      $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
      $pdf->AddPage();

 $htmlpdf = $pdf->reporteVida($datosV); //DEFINIR METODO QUE ESPECIFICA EL PDF AL QUE PERTENECE
   $pdf->writeHTML($htmlpdf, true, false, true, false, '');
      ob_clean();
        $pdf->Output('', 'I');
   
  }
  //CONTROLADORES PARA CARGAS LAS VISTAS
  public function Vistastockcritico(){
     $datos['categoria'] = $this->categorias->findAll();
      $datos['tipo'] = $this->reporte->tipo();
          if ($_POST) {
        $buscartipo = $this->input->post('tipo');
        $buscarcat = $this->input->post('cat');
      }else {
        $buscartipo = "";
        $buscarcat = "";
      }
      $datos['buscar'] = $this->reporte->findAllCriticos($buscartipo, $buscarcat);
      $this->layouthelper->Loadview("reportes/stockcritico",$datos,false); 
  }
    public function Vistastockactual(){ 
      $datos['categoria'] = $this->categorias->findAll();
      $datos['tipo'] = $this->reporte->tipo();
          if ($_POST) {
        $buscartipo = $this->input->post('tipo');
        $buscarcat = $this->input->post('cat');
      }else {
        $buscartipo = "";
        $buscarcat = "";
      }
      $datos['buscar'] = $this->reporte->findAllProductos($buscartipo, $buscarcat);
      $this->layouthelper->Loadview("reportes/stockactual",$datos,false); 

      }
    
  public function Vistavidautil(){
       $datos['vida']=$this->reporte->vidautil();
       $datos['tipo'] = $this->reporte->tipo();
     $this->layouthelper->Loadview("reportes/vidautil",$datos,false);
  }
  public function Vistamotivosbaja(){
     $datos['baja']=$this->reporte->motivosdebaja();
     $datos['tipo'] = $this->reporte->tipo();
        $this->layouthelper->Loadview("reportes/motivosbaja",$datos,false); 
  }
}

/* End of file reportes.php */
/* Location: ./application/controllers/reportes.php */