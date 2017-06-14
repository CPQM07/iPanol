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
  public function index(){

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
      $datos['buscar'] = $this->reporte->findAllProductosActivos($buscartipo, $buscarcat);
      $datos['buscar2'] = $this->reporte->findAllProductosFungibles($buscartipo, $buscarcat);
      $this->layouthelper->Loadview("reportes/stockactual",$datos,false); 
      }
      
      public function Pdfactual(){
      $this->load->library('Pdf');
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
      $buscartipo = $this->input->post("tipo");
      $buscarcat = $this->input->post("cat");
      var_dump($buscartipo);
      $TotalProductos = $this->reporte->findAllProductosActivos($buscartipo, $buscarcat);
        $html = '';
        $html .= "<style type=text/css>";
        $html .= "th{color: #fff; font-weight: bold; background-color: #222}";
        $html .= "td{background-color: #AAC7E3; color: #fff}";
        $html .= "</style>";
        $html .= "<h4>Actualmente: ".count($TotalProductos)." Productos</h4>";
        $html .= "<table width='100%'>";
        $html .= "<tr><th>Tipo</th>
                  <th>Categoria</th>
                  <th>Nombre Producto</th>
                  <th>Fecha ingreso</th>
                  <th>Stock</th>
                  </tr>";
               foreach ($TotalProductos as $value) 
        {
        $nomprod = $value['INV_PROD_NOM'];
        $nomtipo = $value['TIPO_NOMBRE'];
        $nomcat = $value['CAT_NOMBRE'];
        $posicion = $value['PROD_POSICION'];
        $total = $value['Total'];
            $html .= "<tr>
                      <td class='tipo'>".$nomprod."</td>
                      <td class='categoria'>".$nomtipo."</td>
                      <td class='nombre'>".$nomcat."</td>
                      <td class= 'posicion' >".$posicion."</td>
                      <td class= 'posicion' >".$total."</td>
                      </tr>";
        }
        $html .= "</table>";
          $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 1, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
          ob_clean();
          $categoria = utf8_decode("Categoria ".$nomcat.".pdf");
          //$tipos = utf8_decode("Tipo".$tipo.".pdf");
          $pdf->Output($categoria, 'I');
        
      /*
      $htmlpdf = $pdf->reporteActual($datos); //DEFINIR METODO QUE ESPECIFICA EL PDF AL QUE PERTENECE
      $pdf->writeHTML($htmlpdf, true, false, true, false, '');
      ob_clean();
      

      $pdf->Output('', 'I');
      */
  }

//METODO PARA LOS REPORTES DE LA VIDA UTIL .... DATOS ASOCIADOS AL ARRAY Y LUEGO SE LES OTORGA EL VALOR DE LA VARIABLE LA CUAL CONTIENE LOS DATOS DE LA CONSULTA
  public function Pdfcritico(){
      $buscartipo = $_POST["tipo"];
      $buscarcat = $_POST["cat"]; 
      $datosC['buscar'] = $this->reporte->findAllCriticos($buscartipo, $buscarcat);

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