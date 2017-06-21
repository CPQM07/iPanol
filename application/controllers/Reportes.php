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
  //METODO PARA LOS REPORTES DE STOCK ACTUAL
  public function Vistastockactual(){ 
      $datos['motivo'] = $this->reporte->motivo();
      $datos['categoria'] = $this->categorias->findAll();
      $datos['tipo'] = $this->reporte->tipo();
      if ($this->input->post('filtro')) {
        $buscartipo = $this->input->post('tipo');
        $buscarcat = $this->input->post('cat');
        
        if ($buscartipo == 1) {
        $datos['buscartipo'] = $buscartipo;
        $datos['buscarcat'] = $buscarcat;
        $datos['buscar'] = $this->reporte->findAllProductosActivos($buscartipo, $buscarcat);
        }
        if ($buscartipo == 2) {
        $datos['buscartipo'] = $buscartipo;
        $datos['buscarcat'] = $buscarcat;
        $datos['buscar'] = $this->reporte->findAllProductosFungibles($buscartipo, $buscarcat);        }
        
      }
        $this->layouthelper->Loadview("reportes/stockactual",$datos,false); 
  }
      public function excelactual(){
        $this->load->library('excel');
        $objPHPExcel = new PHPExcel();
        $buscartipo = $_POST["tipo"];
        $buscarcat = $_POST["cat"];
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Codigo')
            ->setCellValue('B1', 'Nombre Producto')
            ->setCellValue('C1', 'Tipo')
            ->setCellValue('A2', 'Categoria')
            ->setCellValue('B2', 'Posicion')
            ->setCellValue('C2', 'Total');
            $objPHPExcel->getActiveSheet()->setTitle('Usuarios');
            $objPHPExcel->setActiveSheetIndex(0);
            header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="01simple.xls"');
header('Cache-Control: max-age=0');
 
$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
$objWriter->save('php://output');
exit;
      }
      public function Pdfactual(){
      $this->load->library('Pdf');
      $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
      $buscartipo = $_POST["tipo"];
      $buscarcat = $_POST["cat"];
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
      if ($buscartipo == 1) {      
      $TotalProductos = $this->reporte->findAllProductosActivos($buscartipo, $buscarcat);
        $html = '';
        $html .= "<style type=text/css>";
        $html .= "th{color: #fff; font-weight: bold; background-color: #222}";
        $html .= "td{background-color: #AAC7E3; color: #fff}";
        $html .= "</style>";
        $html .= "<h4>Actualmente: ".count($TotalProductos)." Productos</h4>";
        $html .= "<table width='100%'>";
        $html .= "<tr>
                  <th>Codigo</th>
                  <th>Tipo</th>
                  <th>Categoria</th>
                  <th>Nombre Producto</th>
                  <th>Posición</th>
                  <th>Total</th>
                  </tr>";
               foreach ($TotalProductos as $value) 
        {
        $codigo = $value['INV_PROD_CODIGO'];
        $nomprod = $value['INV_PROD_NOM'];
        $nomtipo = $value['TIPO_NOMBRE'];
        $nomcat = $value['CAT_NOMBRE'];
        $posicion = $value['PROD_POSICION'];
        $total = $value['Total'];
            $html .= "<tr>
                      <td class='codigo'>".$codigo."</td>
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
      }
            if ($buscartipo == 2) {      
      $TotalProductos = $this->reporte->findAllProductosFungibles($buscartipo, $buscarcat);
        $html = '';
        $html .= "<style type=text/css>";
        $html .= "th{color: #fff; font-weight: bold; background-color: #222}";
        $html .= "td{background-color: #AAC7E3; color: #fff}";
        $html .= "</style>";
        $html .= "<h4>Actualmente: ".count($TotalProductos)." Productos</h4>";
        $html .= "<table width='100%'>";
        $html .= "<tr>
                  <th>Codigo</th>
                  <th>Tipo</th>
                  <th>Categoria</th>
                  <th>Nombre Producto</th>
                  <th>Posición</th>
                  <th>Total</th>
                  </tr>";
               foreach ($TotalProductos as $value) 
        {
        $codigo = $value['INV_PROD_CODIGO'];
        $nomprod = $value['INV_PROD_NOM'];
        $nomtipo = $value['TIPO_NOMBRE'];
        $nomcat = $value['CAT_NOMBRE'];
        $posicion = $value['PROD_POSICION'];
        $total = $value['INV_PROD_CANTIDAD'];
            $html .= "<tr>
                      <td class='codigo'>".$codigo."</td>
                      <td class='nomprod'>".$nomprod."</td>
                      <td class='tipo'>".$nomtipo."</td>
                      <td class='categoria'>".$nomcat."</td>
                      <td class= 'posicion' >".$posicion."</td>
                      <td class= 'total' >".$total."</td>
                      </tr>";
        }
        $html .= "</table>";
          $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 1, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
          ob_clean();
          $categoria = utf8_decode("Categoria ".$nomcat.".pdf");
          //$tipos = utf8_decode("Tipo".$tipo.".pdf");
          $pdf->Output($categoria, 'I');
      }  
  }
//////////////////////////////////////////////////////////////////////////
//METODO PARA LOS REPORTES STOCK CRITICO

    public function Vistastockcritico(){ 
      $datos['categoria'] = $this->categorias->findAll();
      $datos['tipo'] = $this->reporte->tipo();
      if ($this->input->post('filtro')) {
        $buscartipo = $this->input->post('tipo');
        $buscarcat = $this->input->post('cat');
          if ($buscartipo == 1) {
          $datos['buscartipo'] = $buscartipo;
          $datos['buscarcat'] = $buscarcat;
          $datos['buscar'] = $this->reporte->findAllCriticosActivos($buscartipo, $buscarcat);
        }
          if ($buscartipo == 2) {
          $datos['buscartipo'] = $buscartipo;
          $datos['buscarcat'] = $buscarcat;
          $datos['buscar'] = $this->reporte->findAllCriticosFungibles($buscartipo, $buscarcat);        }
        
      }
        $this->layouthelper->Loadview("reportes/stockcritico",$datos,false); 
  }
  public function Pdfcritico(){
      $this->load->library('Pdf');
      $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
      $buscartipo = $_POST["tipo"];
      $buscarcat = $_POST["cat"];
      $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
      $pdf->SetFont('dejavusans', '', 7, '', true);
      $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                   Reporte de Productos Criticos', "");
      $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
      $pdf->AddPage();
      if ($buscartipo == 1) {      
      $TotalProductos = $this->reporte->findAllCriticosActivos($buscartipo, $buscarcat);
        $html = '';
        $html .= "<style type=text/css>";
        $html .= "th{color: #fff; font-weight: bold; background-color: #222}";
        $html .= "td{background-color: #AAC7E3; color: #fff}";
        $html .= "</style>";
        $html .= "<h4>Criticos: ".count($TotalProductos)." Productos</h4>";
        $html .= "<table width='100%'>";
        $html .= "<tr>
                  <th>Codigo</th>
                  <th>Nombre Producto</th>
                  <th>Tipo</th>
                  <th>Categoria</th>                  
                  <th>Optimp</th>
                  <th>Critico</th>
                  <th>Prioridad</th>
                  <th>Total</th>
                  </tr>";
               foreach ($TotalProductos as $value) 
        {
        $codigo = $value['INV_PROD_CODIGO'];
        $nomprod = $value['INV_PROD_NOM'];
        $nomtipo = $value['TIPO_NOMBRE'];
        $nomcat = $value['CAT_NOMBRE'];
        $stockop = $value['PROD_STOCK_OPTIMO'];
        $stockcri = $value['PROD_STOCK_CRITICO'];
        $prioridad = $value['PROD_PRIORIDAD'];
        $cantidad = $value['CANTIDAD'];
            $html .= "<tr>
                      <td class='codigo' >".$codigo."</td>
                      <td class='tipo' >".$nomprod."</td>
                      <td class='categoria'>".$nomtipo."</td>
                      <td class='nombre'>".$nomcat."</td>
                      <td class= 'optimo' >".$stockop."</td>
                      <td class= 'critico' >".$stockcri."</td>
                      <td class='prioridad' >".$prioridad."</td>
                      <td class='cantidad' >".$cantidad."</td>
                      </tr>";
        }
        $html .= "</table>";
          $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 1, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
          ob_clean();
          $categoria = utf8_decode("Categoria ".$nomcat.".pdf");
          //$tipos = utf8_decode("Tipo".$tipo.".pdf");
          $pdf->Output($categoria, 'I');
      }
            if ($buscartipo == 2) {      
      $TotalProductos = $this->reporte->findAllCriticosFungibles($buscartipo, $buscarcat);
        $html = '';
        $html .= "<style type=text/css>";
        $html .= "th{color: #fff; font-weight: bold; background-color: #222}";
        $html .= "td{background-color: #AAC7E3; color: #fff}";
        $html .= "</style>";
        $html .= "<h4>Criticos: ".count($TotalProductos)." Productos</h4>";
        $html .= "<table width='100%'>";
        $html .= "<tr>
                  <th>Codigo</th>
                  <th>Nombre Producto</th>
                  <th>Tipo</th>
                  <th>Categoria</th>                  
                  <th>Optimp</th>
                  <th>Critico</th>
                  <th>Prioridad</th>
                  <th>Total</th>
                  </tr>";
               foreach ($TotalProductos as $value) 
        {
        $codigo = $value['INV_PROD_CODIGO'];
        $nomprod = $value['INV_PROD_NOM'];
        $nomtipo = $value['TIPO_NOMBRE'];
        $nomcat = $value['CAT_NOMBRE'];
        $stockop = $value['PROD_STOCK_OPTIMO'];
        $stockcri = $value['PROD_STOCK_CRITICO'];
        $prioridad = $value['PROD_PRIORIDAD'];
        $cantidad = $value['INV_PROD_CANTIDAD'];
            $html .= "<tr>
                      <td class='codigo'>".$codigo."</td>
                      <td class='nomprod'>".$nomprod."</td>
                      <td class='tipo'>".$nomtipo."</td>
                      <td class='categoria'>".$nomcat."</td>
                      <td class= 'optimo' >".$stockop."</td>
                      <td class= 'critico' >".$stockcri."</td>
                      <td class='prioridad'>".$prioridad."</td>
                      <td class='cantidad'>".$cantidad."</td>
                      </tr>";
        }
        $html .= "</table>";
          $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 1, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
          ob_clean();
          $categoria = utf8_decode("Categoria ".$nomcat.".pdf");
          //$tipos = utf8_decode("Tipo".$tipo.".pdf");
          $pdf->Output($categoria, 'I');
      }
  
  }
  ////////////////////////////////////////////////////////////////////////////////////
//METODO PARA LOS REPORTES DE MOTIVOS BAJA

    public function Vistamotivosbaja(){
      $datos['motivos'] = $this->reporte->motivo();
      $datos['categoria'] = $this->categorias->findAll();
      $datos['tipo'] = $this->reporte->tipo();
      if ($this->input->post('filtro')) {
        
        $buscarmot = $this->input->post('mot');
        $buscartipo = $this->input->post('tipo');
        $buscarcat = $this->input->post('cat');
        $datos['buscartipo'] = $buscartipo;
        $datos['buscarcat'] = $buscarcat;
        $datos['buscarmot'] = $buscarmot;
        $datos['buscar'] = $this->reporte->motivosdebaja($buscartipo, $buscarcat, $buscarmot); 
  }
  $this->layouthelper->Loadview("reportes/motivosbaja",$datos,false);
  }
    public function Pdfbaja(){
      $this->load->library('Pdf');
      $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
      $buscartipo = $_POST["tipo"];
      $buscarcat = $_POST["cat"];
      $buscarmot = $_POST["mot"];
      $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
      $pdf->SetFont('dejavusans', '', 7, '', true);
      $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                   Reporte de Productos Criticos', "");
      $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
      $pdf->AddPage();      
      $TotalProductos = $this->reporte->motivosdebaja($buscartipo, $buscarcat, $buscarmot);
        $html = '';
        $html .= "<style type=text/css>";
        $html .= "th{color: #fff; font-weight: bold; background-color: #222}";
        $html .= "td{background-color: #AAC7E3; color: #fff}";
        $html .= "</style>";
        $html .= "<h4>Productos dados de baja: ".count($TotalProductos)."</h4>";
        $html .= "<table width='100%'>";
        $html .= "<tr>
                  <th>Codigo</th>
                  <th>Nombre Producto</th>
                  <th>Tipo</th>
                  <th>Categoria</th>                  
                  <th>Fecha de baja</th>
                  <th>Motivo</th>
                  </tr>";
               foreach ($TotalProductos as $value) 
        {
        $codigo = $value['INV_PROD_CODIGO'];
        $nomprod = $value['INV_PROD_NOM'];
        $nomtipo = $value['TIPO_NOMBRE'];
        $nomcat = $value['CAT_NOMBRE'];
        $fecha = $value['BAJA_FECHA'];
        $motivo = $value['MOT_NOMBRE'];
            $html .= "<tr>
                      <td class='codigo' >".$codigo."</td>
                      <td class='tipo' >".$nomprod."</td>
                      <td class='categoria'>".$nomtipo."</td>
                      <td class='nombre'>".$nomcat."</td>
                      <td class= 'optimo' >".$fecha."</td>
                      <td class= 'critico' >".$motivo."</td>
                      </tr>";
        }
        $html .= "</table>";
          $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 1, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
          ob_clean();
          $categoria = utf8_decode("Categoria ".$nomcat.".pdf");
          //$tipos = utf8_decode("Tipo".$tipo.".pdf");
          $pdf->Output($categoria, 'I');
      }
      ////////////////////////////////////////////////////////////////////////////7

  //METODO LOS REPORTES DE VIDA UTIL

public function Vistavidautil(){
      $datos['categoria'] = $this->categorias->findAll();
      $datos['tipo'] = $this->reporte->tipo();
      if ($this->input->post('filtro')) {
        $buscartipo = $this->input->post('tipo');
        $buscarcat = $this->input->post('cat');
        $buscaradq = $this->input->post('adq');
      if ($buscaradq == 1) {
        $datos['buscartipo'] = $buscartipo;
        $datos['buscarcat'] = $buscarcat;
        $datos['buscaradq'] = $buscaradq;
        $datos['buscar'] = $this->reporte->vidautilCompras($buscartipo, $buscarcat, $buscaradq);    
      }  
            if ($buscaradq == 2 ) {
        $datos['buscartipo'] = $buscartipo;
        $datos['buscarcat'] = $buscarcat;
        $datos['buscaradq'] = $buscaradq;
        $datos['buscar'] = $this->reporte->vidautilDonaciones($buscartipo, $buscarcat, $buscaradq);    
    }
}
        $this->layouthelper->Loadview("reportes/vidautil",$datos,false); 
  
}
  public function Pdfvida(){
      $this->load->library('Pdf');
      $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
      $buscartipo = $_POST["tipo"];
      $buscarcat = $_POST["cat"];
      $buscaradq = $_POST["adq"];
      $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
      $pdf->SetFont('dejavusans', '', 7, '', true);
      $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                   Reporte de Vida Útil de Productos', "");
      $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
      $pdf->AddPage(); 
      if ($buscaradq == 1) {
          
      $vida = $this->reporte->vidautilCompras($buscartipo, $buscarcat, $buscaradq);
        $html = '';
        $html .= "<style type=text/css>";
        $html .= "th{color: #fff; font-weight: bold; background-color: #dd4b39}";
        $html .= "td{border:1px solid black; }";
        $html .= "</style>";
        $html .= "<h4>Actualmente: ".count($vida)." Productos</h4>";
        $html .= "<table width='100%'>";
        $html .= "<tr><th>Codigo</th>
                  <th>Tipo</th>
                  <th>Categoria</th>
                  <th>Nombre Producto</th>
                  <th>Fecha Ingreso</th>
                  <th>Nombre Proveedor</th>
                  <th>Rut</th>
                  <th>Vida util</th>
                  <th>Tipo Ingreso</th>
                  </tr>";
               foreach ($vida as $value) 
        {
        $codigo = $value['INV_PROD_CODIGO'];
        $nomtipo = $value['TIPO_NOMBRE'];
        $nomcat = $value['CAT_NOMBRE'];
        $prodnom = $value['INV_PROD_NOM'];
        $fechaing = $value['ING_FECHA'];
        $nomprov = $value['PROV_NOMBRE'];
        $rutprov = $value['PROV_RUT'];
        $vidautil = $value['ING_VIDA_ULTIL_PROVEEDOR'];
        $ingtipo = $value['ING_TIPO_INGRESO'];
            $html .= "<tr>
                      <td class='codigo'>".$codigo."</td>
                      <td class='tipo'>".$nomtipo."</td>
                      <td class='categoria'>".$nomcat."</td>
                      <td class= 'producto' >".$prodnom."</td>
                      <td class= 'ingreso' >".$fechaing."</td>
                      <td class= 'proveedor' >".$nomprov."</td>
                      <td class= 'rut' >".$rutprov."</td>
                      <td class= 'vidautil' >".$vidautil."</td>
                      <td class= 'tipoingreso' >".$ingtipo."</td>
                      </tr>";
        }
        $html .= "</table>";
          $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 1, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
          ob_clean();
          $categoria = utf8_decode("Categoria ".$nomcat.".pdf");
          //$tipos = utf8_decode("Tipo".$tipo.".pdf");
          $pdf->Output($categoria, 'I');
        }
        //ÇAQUI EMPIESA LA CONDICION 2
        if ($buscaradq == 2) {
          $vida = $this->reporte->vidautilDonaciones($buscartipo, $buscarcat, $buscaradq);
        $html = '';
        $html .= "<style type=text/css>";
        $html .= "th{color: #fff; font-weight: bold; background-color: #dd4b39}";
        $html .= "td{border:1px solid black; }";
        $html .= "</style>";
        $html .= "<h4>Actualmente: ".count($vida)." Productos</h4>";
        $html .= "<table width='100%'>";
        $html .= "<tr><th>Codigo</th>
                  <th>Tipo</th>
                  <th>Categoria</th>
                  <th>Nombre Producto</th>
                  <th>Fecha Ingreso</th>
                  <th>Vida util</th>
                  <th>Tipo Ingreso</th>
                  </tr>";
               foreach ($vida as $value) 
        {
        $codigo = $value['INV_PROD_CODIGO'];
        $nomtipo = $value['TIPO_NOMBRE'];
        $nomcat = $value['CAT_NOMBRE'];
        $prodnom = $value['INV_PROD_NOM'];
        $fechaing = $value['ING_FECHA'];
        $vidautil = $value['ING_VIDA_ULTIL_PROVEEDOR'];
        $ingtipo = $value['ING_TIPO_INGRESO'];
            $html .= "<tr>
                      <td class='codigo'>".$codigo."</td>
                      <td class='tipo'>".$nomtipo."</td>
                      <td class='categoria'>".$nomcat."</td>
                      <td class= 'producto' >".$prodnom."</td>
                      <td class= 'ingreso' >".$fechaing."</td>
                      <td class= 'vidautil' >".$vidautil."</td>
                      <td class= 'tipoingreso' >".$ingtipo."</td>
                      </tr>";
        }
        $html .= "</table>";
          $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 1, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
          ob_clean();
          $categoria = utf8_decode("Categoria ".$nomcat.".pdf");
          //$tipos = utf8_decode("Tipo".$tipo.".pdf");
          $pdf->Output($categoria, 'I');
            
          } 
}}
///////////////////////////////////////////////////////////////////////////////////

/* End of file reportes.php */
/* Location: ./application/controllers/reportes.php */