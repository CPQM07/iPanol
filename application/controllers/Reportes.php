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
      $datos['categoria'] = $this->categorias->findAll();
      $datos['tipo'] = $this->reporte->tipo();
      if ($this->input->post('filtro')) {
        $buscartipo = $this->input->post('tipo');
        $buscarcat = $this->input->post('cat');
        $buscaradq = $this->input->post('adq');
        if ($buscartipo == 1) {
        $datos['buscartipo'] = $buscartipo;
        $datos['buscarcat'] = $buscarcat;
        $datos['buscaradq'] = $buscaradq;
        $datos['buscar'] = $this->reporte->findAllProductosActivos($buscartipo, $buscarcat, $buscaradq);
        }
        if ($buscartipo == 2) {
        $datos['buscartipo'] = $buscartipo;
        $datos['buscarcat'] = $buscarcat;
        $datos['buscaradq'] = $buscaradq;
        $datos['buscar'] = $this->reporte->findAllProductosFungibles($buscartipo, $buscarcat ,$buscaradq);        }
        
      }
        $this->layouthelper->Loadview("reportes/stockactual",$datos,false); 
  }
      public function excelactual(){
        $this->load->library('Excel');
        $objPHPExcel = new PHPExcel();
        $buscartipo = $_POST["tipo"];
        $buscarcat = $_POST["cat"];
        $buscaradq = $_POST["adq"];
        $compra = "Compra";
        $donacion = "Donación";
        // Se asignan las propiedades del libro
        $objPHPExcel->getProperties()->setCreator("Bryan Cordova and Elliott Urrutia") // Nombre del autor
            ->setLastModifiedBy("Bryan") //Ultimo usuario que lo modificó
            ->setTitle("Reporte") // Titulo
            ->setSubject("Reporte Excel con PHP") //Asunto
            ->setDescription("Reporte de stock actual") //Descripción
            ->setKeywords("Reporte stock actual") //Etiquetas
            ->setCategory("Reporte excel"); //Categorias
        $tituloReporte = "Reporte stock actual de Productos";
        $titulosColumnas = array('Código  ' , 'Nombre Producto', 'Tipo', 'Categoría','Tipo Ingreso'
                                ,'Posición','Total');
        // Se combinan las celdas A1 hasta F1, para colocar ahí el titulo del reporte
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A1:G1');
        // Se agregan los titulos del reporte
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1',  $tituloReporte) // Titulo del reporte
            ->setCellValue('A3',  $titulosColumnas['0'])  //Titulo de las columnas
            ->setCellValue('B3',  $titulosColumnas['1'])
            ->setCellValue('C3',  $titulosColumnas['2'])
            ->setCellValue('D3',  $titulosColumnas['3'])
            ->setCellValue('E3',  $titulosColumnas['4'])
            ->setCellValue('F3',  $titulosColumnas['5'])
            ->setCellValue('G3',  $titulosColumnas['6']);
            //Se agregan los datos de los productos
        $i = 4; //Numero de fila donde se va a comenzar a rellenar
        if ($buscartipo == 1) {
          $TotalProductos = $this->reporte->findAllProductosActivos($buscartipo, $buscarcat, $buscaradq);
            foreach ($TotalProductos as $value) {
              $codigo = $value['INV_PROD_CODIGO'];
              $nomprod = $value['INV_PROD_NOM'];
              $nomtipo = $value['TIPO_NOMBRE'];
              $nomcat = $value['CAT_NOMBRE'];
              $posicion = $value['PROD_POSICION'];
              $tipoing = $value['ING_TIPO_INGRESO'];
              $total = $value['Total'];
              $node = "No definido";
        if ($tipoing == 1) {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $codigo)
            ->setCellValue('B'.$i, $nomprod)
            ->setCellValue('C'.$i, $nomtipo)
            ->setCellValue('D'.$i, $nomcat)
            ->setCellValue('E'.$i, $compra)
            ->setCellValue('F'.$i, $posicion)
            ->setCellValue('G'.$i, $total);
        $i++;
        }
        elseif ($tipoing == 2) {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $codigo)
            ->setCellValue('B'.$i, $nomprod)
            ->setCellValue('C'.$i, $nomtipo)
            ->setCellValue('D'.$i, $nomcat)
            ->setCellValue('E'.$i, $donacion)
            ->setCellValue('F'.$i, $posicion)
            ->setCellValue('G'.$i, $total);
        $i++;
        }
        else  
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $codigo)
            ->setCellValue('B'.$i, $nomprod)
            ->setCellValue('C'.$i, $nomtipo)
            ->setCellValue('D'.$i, $nomcat)
            ->setCellValue('E'.$i, $node)
            ->setCellValue('F'.$i, $posicion)
            ->setCellValue('G'.$i, $total);
        $i++;
        
        }
      }if ($buscartipo == 2) {
        $TotalProductos = $this->reporte->findAllProductosFungibles($buscartipo, $buscarcat,$buscaradq);
            foreach ($TotalProductos as $value) { 
              $codigo = $value['INV_PROD_CODIGO'];
              $nomprod = $value['INV_PROD_NOM'];
              $nomtipo = $value['TIPO_NOMBRE'];
              $nomcat = $value['CAT_NOMBRE'];
              $posicion = $value['PROD_POSICION'];
              $total = $value['INV_PROD_CANTIDAD'];
        if ($buscaradq == 1) {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $codigo)
            ->setCellValue('B'.$i, $nomprod)
            ->setCellValue('C'.$i, $nomtipo)
            ->setCellValue('D'.$i, $nomcat)
            ->setCellValue('E'.$i, $compra)
            ->setCellValue('F'.$i, $posicion)
            ->setCellValue('G'.$i, $total);
        $i++;
        }
        if ($buscaradq == 2) {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $codigo)
            ->setCellValue('B'.$i, $nomprod)
            ->setCellValue('C'.$i, $nomtipo)
            ->setCellValue('D'.$i, $nomcat)
            ->setCellValue('E'.$i, $donacion)
            ->setCellValue('F'.$i, $posicion)
            ->setCellValue('G'.$i, $total);
        $i++;
        }
        }
 }
$estiloTituloReporte = array(
    'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>16,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'argb' => 'FF220835')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
 
$estiloTituloColumnas = array(
    'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' => 8,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'argb' => 'FF220835')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
 
$estiloInformacion = new PHPExcel_Style();
$estiloInformacion->applyFromArray( array(
    'font' => array(
        'name'  => 'Arial',
        'size' =>12,
        'color' => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
  'type'  => PHPExcel_Style_Fill::FILL_SOLID,
  'color' => array(
            'argb' => 'FFd9b7f4')
  ),
    'borders' => array(
        'left' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
      'color' => array(
              'rgb' => '3a2a47'
            )
        )
    )
));
$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A3:G3')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:G".($i-1));
// Tamaño automatico
for($i = 'A'; $i <= 'G'; $i++){
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
}
// Se asigna el nombre a la hoja
$objPHPExcel->getActiveSheet()->setTitle('Stock Actual');
 
// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
$objPHPExcel->setActiveSheetIndex(0);
 
// Inmovilizar paneles
//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
// Se manda el archivo al navegador web, con el nombre que se indica, en formato Excel5
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reportestockactual.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

      }
      public function Pdfactual(){
      $this->load->library('Pdf');
      $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
      $buscartipo = $_POST["tipo"];
      $buscarcat = $_POST["cat"];
      $buscaradq = $_POST["adq"];
      $compra = "Compra";
      $donacion = "Donación";
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
      $TotalProductos = $this->reporte->findAllProductosActivos($buscartipo, $buscarcat, $buscaradq); 
              $html = '';
        $html .= "<style type=text/css>";
        $html .= "th{border:1px solid black;text-align:center;font-weight:bold; }";
        $html .= "td{border:1px solid black;text-align:center }";
        $html .= "</style>";
        $html .= "<h4>Actualmente: ".count($TotalProductos)." Productos</h4>";
        $html .= "<table width='100%'>";
        $html .= "<tr>
                  <th>Código</th>
                  <th>Nombre producto</th>
                  <th>Tipo</th>
                  <th>Categoría</th>
                  <th>Tipo ingreso</th>
                  <th>Posición</th>
                  <th>Total</th>
                  </tr>";
      foreach ($TotalProductos as $value) 
        {
        $codigo = $value['INV_PROD_CODIGO'];
        $nomprod = $value['INV_PROD_NOM'];
        $nomtipo = $value['TIPO_NOMBRE'];
        $nomcat = $value['CAT_NOMBRE'];
        $tipoing = $value['ING_TIPO_INGRESO'];
        $posicion = $value['PROD_POSICION'];
        $total = $value['Total'];
        /*
        if ($tipoing == 1) {
        $tipoing == "Compra";          
        }elseif ($tipoing == 2) {
          $tipoing == "Donacion";
        }else $tipoing == "No definido";
*/
            $html .= "<tr>
                      <td class='codigo'>".$codigo."</td>
                      <td class='producto'>".$nomprod."</td>
                      <td class='tipo'>".$nomtipo."</td>                      
                      <td class='categoria'>".$nomcat."</td>";
                      if ($tipoing == 1) {
                      $html .= "<td>Compra</td>";      
                      }elseif ($tipoing ==2) {
                      $html .= "<td>Donacion</td>";
                      }else
                      $html .= "<td>No definido</td>";
            $html .= "<td class= 'posicion' >".$posicion."</td>
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
      $TotalProductos = $this->reporte->findAllProductosFungibles($buscartipo, $buscarcat, $buscaradq);
              $html = '';
        $html .= "<style type=text/css>";
        $html .= "th{border:1px solid black;text-align:center;font-weight:bold; }";
        $html .= "td{border:1px solid black;text-align:center }";
        $html .= "</style>";
        $html .= "<h4>Actualmente: ".count($TotalProductos)." Productos</h4>";
        $html .= "<table width='100%'>";
        $html .= "<tr>
                  <th>Codigo</th>
                  <th>Nombre Producto</th>
                  <th>Tipo</th>
                  <th>Categoria</th>
                  <th>Tipo Ingreso</th>
                  <th>Posición</th>
                  <th>Total</th>
                  </tr>";
               foreach ($TotalProductos as $value) 
        {
        $codigo = $value['INV_PROD_CODIGO'];
        $nomprod = $value['INV_PROD_NOM'];
        $nomtipo = $value['TIPO_NOMBRE'];
        $nomcat = $value['CAT_NOMBRE'];
        $tipoing = $value['ING_TIPO_INGRESO'];
        $posicion = $value['PROD_POSICION'];
        $total = $value['INV_PROD_CANTIDAD'];

            $html .= "<tr>
                      <td class='codigo'>".$codigo."</td>
                      <td class='producto'>".$nomprod."</td>
                      <td class='tipo'>".$nomtipo."</td>                      
                      <td class='categoria'>".$nomcat."</td>";
                      if ($tipoing == 1) {
                      $html .= "<td>Compra</td>";      
                      }elseif ($tipoing ==2) {
                      $html .= "<td>Donacion</td>";
                      }else
                      $html .= "<td>No definido</td>";
            $html .= "<td class= 'posicion' >".$posicion."</td>
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
  }
//////////////////////////////////////////////////////////////////////////
//METODO PARA LOS REPORTES STOCK CRITICO

    public function Vistastockcritico(){ 
      $datos['categoria'] = $this->categorias->findAll();
      $datos['tipo'] = $this->reporte->tipo();
      if ($this->input->post('filtro')) {
        $buscartipo = $this->input->post('tipo');
        $buscarcat = $this->input->post('cat');
        $buscaradq = $this->input->post('adq');
          if ($buscartipo == 1) {
          $datos['buscartipo'] = $buscartipo;
          $datos['buscarcat'] = $buscarcat;
          $datos['buscaradq'] = $buscaradq;
          $datos['buscar'] = $this->reporte->findAllCriticosActivos($buscartipo, $buscarcat,$buscaradq);
        }
          if ($buscartipo == 2) {
          $datos['buscartipo'] = $buscartipo;
          $datos['buscarcat'] = $buscarcat;
          $datos['buscaradq'] = $buscaradq;
          $datos['buscar'] = $this->reporte->findAllCriticosFungibles($buscartipo, $buscarcat,$buscaradq);        }
        
      }
        $this->layouthelper->Loadview("reportes/stockcritico",$datos,false); 
  }
        public function excelcritico(){
        $this->load->library('Excel');
        $objPHPExcel = new PHPExcel();
        date_default_timezone_set('America/Santiago');
        $buscartipo = $_POST["tipo"];
        $buscarcat = $_POST["cat"];
        $buscaradq = $_POST["adq"];
        $compra = "Compra";
        $donacion = "Donación";
        // Se asignan las propiedades del libro
        $objPHPExcel->getProperties()->setCreator("Bryan Cordova and Elliott Urrutia") // Nombre del autor
            ->setLastModifiedBy("Bryan") //Ultimo usuario que lo modificó
            ->setTitle("Reporte") // Titulo
            ->setSubject("Reporte Excel con PHP") //Asunto
            ->setDescription("Reporte de stock crítico") //Descripción
            ->setKeywords("Reporte stock crítico") //Etiquetas
            ->setCategory("Reporte excel");     //Categorias
        $tituloReporte = "Reporte stock crítico de Productos";
        $titulosColumnas = array('Código  ' , 'Nombre Producto', 'Tipo','Categoría', 'Tipo Ingreso','Stock Óptimo', 'Stock Crítico','Prioridad  ','Total');
        // Se combinan las celdas A1 hasta F1, para colocar ahí el titulo del reporte
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A1:I1');
        // Se agregan los titulos del reporte
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1',  $tituloReporte) // Titulo del reporte
            ->setCellValue('A3',  $titulosColumnas['0'])  //Titulo de las columnas
            ->setCellValue('B3',  $titulosColumnas['1'])
            ->setCellValue('C3',  $titulosColumnas['2'])
            ->setCellValue('D3',  $titulosColumnas['3'])
            ->setCellValue('E3',  $titulosColumnas['4'])
            ->setCellValue('F3',  $titulosColumnas['5'])
            ->setCellValue('G3',  $titulosColumnas['6'])
            ->setCellValue('H3',  $titulosColumnas['7'])
            ->setCellValue('I3',  $titulosColumnas['8']);
            //Se agregan los datos de los productos
        $i = 4; //Numero de fila donde se va a comenzar a rellenar
              if ($buscartipo == 1) {      
      $TotalProductos = $this->reporte->findAllCriticosActivos($buscartipo, $buscarcat, $buscaradq);
               foreach ($TotalProductos as $value) 
        {
  
        $codigo = $value['INV_PROD_CODIGO'];
        $nomprod = $value['INV_PROD_NOM'];
        $nomtipo = $value['TIPO_NOMBRE'];
        $nomcat = $value['CAT_NOMBRE'];
        $tipoing = $value['ING_TIPO_INGRESO'];
        $stockop = $value['PROD_STOCK_OPTIMO'];
        $stockcri = $value['PROD_STOCK_CRITICO'];
        $prioridad = $value['PROD_PRIORIDAD'];
        $cantidad = $value['CANTIDAD'];
        $node = "No definido";
        if ($tipoing == 1) {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $codigo)
            ->setCellValue('B'.$i, $nomprod)
            ->setCellValue('C'.$i, $nomtipo)
            ->setCellValue('D'.$i, $nomcat)
            ->setCellValue('E'.$i, $compra)
            ->setCellValue('F'.$i, $stockop)
            ->setCellValue('G'.$i, $stockcri)
            ->setCellValue('H'.$i, $prioridad)
            ->setCellValue('I'.$i, $cantidad);
        $i++;
        }
        elseif ($tipoing == 2) {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $codigo)
            ->setCellValue('B'.$i, $nomprod)
            ->setCellValue('C'.$i, $nomtipo)
            ->setCellValue('D'.$i, $nomcat)
            ->setCellValue('E'.$i, $donacion)
            ->setCellValue('F'.$i, $stockop)
            ->setCellValue('G'.$i, $stockcri)
            ->setCellValue('H'.$i, $prioridad)
            ->setCellValue('I'.$i, $cantidad);
        $i++;
        }
                else  {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $codigo)
            ->setCellValue('B'.$i, $nomprod)
            ->setCellValue('C'.$i, $nomtipo)
            ->setCellValue('D'.$i, $nomcat)
            ->setCellValue('E'.$i, $node)
            ->setCellValue('F'.$i, $stockop)
            ->setCellValue('G'.$i, $stockcri)
            ->setCellValue('H'.$i, $prioridad)
            ->setCellValue('I'.$i, $cantidad);
        $i++;
        }
      }
      }if ($buscartipo == 2) {
      $TotalProductos = $this->reporte->findAllCriticosFungibles($buscartipo, $buscarcat, $buscaradq);
               foreach ($TotalProductos as $value) 
        {
        $codigo = $value['INV_PROD_CODIGO'];
        $nomprod = $value['INV_PROD_NOM'];
        $nomtipo = $value['TIPO_NOMBRE'];
        $nomcat = $value['CAT_NOMBRE'];
        $tipoing = $value['ING_TIPO_INGRESO'];
        $stockop = $value['PROD_STOCK_OPTIMO'];
        $stockcri = $value['PROD_STOCK_CRITICO'];
        $prioridad = $value['PROD_PRIORIDAD'];
        $cantidad = $value['INV_PROD_CANTIDAD'];
        $node = "No definido";

        if ($tipoing == 1) {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $codigo)
            ->setCellValue('B'.$i, $nomprod)
            ->setCellValue('C'.$i, $nomtipo)
            ->setCellValue('D'.$i, $nomcat)
            ->setCellValue('E'.$i, $compra)
            ->setCellValue('F'.$i, $stockop)
            ->setCellValue('G'.$i, $stockcri)
            ->setCellValue('H'.$i, $prioridad)
            ->setCellValue('I'.$i, $cantidad);
        $i++;
        }
        elseif ($tipoing == 2) {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $codigo)
            ->setCellValue('B'.$i, $nomprod)
            ->setCellValue('C'.$i, $nomtipo)
            ->setCellValue('D'.$i, $nomcat)
            ->setCellValue('E'.$i, $donacion)
            ->setCellValue('F'.$i, $stockop)
            ->setCellValue('G'.$i, $stockcri)
            ->setCellValue('H'.$i, $prioridad)
            ->setCellValue('I'.$i, $cantidad);
        $i++;
        }
                else  {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $codigo)
            ->setCellValue('B'.$i, $nomprod)
            ->setCellValue('C'.$i, $nomtipo)
            ->setCellValue('D'.$i, $nomcat)
            ->setCellValue('E'.$i, $node)
            ->setCellValue('F'.$i, $stockop)
            ->setCellValue('G'.$i, $stockcri)
            ->setCellValue('H'.$i, $prioridad)
            ->setCellValue('I'.$i, $cantidad);
        $i++;
        }
        }
 }
$estiloTituloReporte = array(
    'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>16,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'argb' => 'FF220835')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
 
$estiloTituloColumnas = array(
    'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' => 8,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'argb' => 'FF220835')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
 
$estiloInformacion = new PHPExcel_Style();
$estiloInformacion->applyFromArray( array(
    'font' => array(
        'name'  => 'Arial',
        'size' =>12,
        'color' => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
  'type'  => PHPExcel_Style_Fill::FILL_SOLID,
  'color' => array(
            'argb' => 'FFd9b7f4')
  ),
    'borders' => array(
        'left' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
      'color' => array(
              'rgb' => '3a2a47'
            )
        )
    )
));
$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A3:I3')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:I".($i-1));
// Tamaño automatico
for($i = 'A'; $i <= 'I'; $i++){
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
}
// Se asigna el nombre a la hoja
$objPHPExcel->getActiveSheet()->setTitle('Stock Critico');
 
// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
$objPHPExcel->setActiveSheetIndex(0);
 
// Inmovilizar paneles
//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
// Se manda el archivo al navegador web, con el nombre que se indica, en formato Excel5
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reportestockcritico.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

      }
  public function Pdfcritico(){
      $this->load->library('Pdf');
      $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
      $buscartipo = $_POST["tipo"];
      $buscarcat = $_POST["cat"];
      $buscaradq = $_POST["adq"];
      $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
      $pdf->SetFont('dejavusans', '', 7, '', true);
      $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                   Reporte de Productos Críticos', "");
      $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
      $pdf->AddPage();
        $compra = "Compra";
        $donacion = "Donación";                  
      if ($buscartipo == 1) {      
      $TotalProductos = $this->reporte->findAllCriticosActivos($buscartipo, $buscarcat, $buscaradq);
              $html = '';
        $html .= "<style type=text/css>";
        $html .= "th{border:1px solid black;text-align:center;font-weight:bold; }";
        $html .= "td{border:1px solid black;text-align:center }";
        $html .= "</style>";
        $html .= "<h4>Críticos: ".count($TotalProductos)." Productos</h4>";
        $html .= "<table width='100%'>";
        $html .= "<tr>
                  <th>Código</th>
                  <th>Nombre Producto</th>
                  <th>Tipo</th>
                  <th>Categoría</th>                  
                  <th>Tipo ingreso</th>
                  <th>Óptimo</th>
                  <th>Crítico</th>
                  <th>Prioridad</th>
                  <th>Total</th>
                  </tr>";
               foreach ($TotalProductos as $value) 
        {
        $codigo = $value['INV_PROD_CODIGO'];
        $nomprod = $value['INV_PROD_NOM'];
        $nomtipo = $value['TIPO_NOMBRE'];
        $nomcat = $value['CAT_NOMBRE'];
        $tipoing = $value['ING_TIPO_INGRESO'];
        $stockop = $value['PROD_STOCK_OPTIMO'];
        $stockcri = $value['PROD_STOCK_CRITICO'];
        $prioridad = $value['PROD_PRIORIDAD'];
        $cantidad = $value['CANTIDAD'];
            $html .= "<tr>
                      <td class='codigo' >".$codigo."</td>
                      <td class='producto' >".$nomprod."</td>
                      <td class='tipo'>".$nomtipo."</td>
                      <td class='categoria'>".$nomcat."</td>";
                      if ($tipoing == 1) {
                      $html .= "<td>Compra</td>";      
                      }elseif ($tipoing ==2) {
                      $html .= "<td>Donacion</td>";
                      }else
                      $html .= "<td>No definido</td>";        
            $html .= "<td class= 'optimo' >".$stockop."</td>
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
      $TotalProductos = $this->reporte->findAllCriticosFungibles($buscartipo, $buscarcat, $buscaradq);
        $html = '';
        $html .= "<style type=text/css>";
        $html .= "th{border:1px solid black;text-align:center;font-weight:bold; }";
        $html .= "td{border:1px solid black;text-align:center }";
        $html .= "</style>";
        $html .= "<h4>Criticos: ".count($TotalProductos)." Productos</h4>";
        $html .= "<table width='100%'>";
        $html .= "<tr>
                  <th>Codigo</th>
                  <th>Nombre Producto</th>
                  <th>Tipo</th>
                  <th>Categoria</th>                  
                  <th>Tipo Ingreso</th>
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
        $tipoing = $value['ING_TIPO_INGRESO'];
        $stockop = $value['PROD_STOCK_OPTIMO'];
        $stockcri = $value['PROD_STOCK_CRITICO'];
        $prioridad = $value['PROD_PRIORIDAD'];
        $cantidad = $value['INV_PROD_CANTIDAD'];     
            $html .= "<tr>
                      <td class='codigo'>".$codigo."</td>
                      <td class='nomprod'>".$nomprod."</td>
                      <td class='tipo'>".$nomtipo."</td>
                      <td class='categoria'>".$nomcat."</td>";
                      if ($tipoing == 1) {
                      $html .= "<td>Compra</td>";      
                      }elseif ($tipoing ==2) {
                      $html .= "<td>Donacion</td>";
                      }else
                      $html .= "<td>No definido</td>";
            $html .= "<td class='compra'>".$compra."</td>
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
  public function excelbaja(){
        $this->load->library('Excel');
        $objPHPExcel = new PHPExcel();
        date_default_timezone_set('America/Santiago');
        $buscartipo = $_POST["tipo"];
        $buscarcat = $_POST["cat"];
        $buscarmot = $_POST["mot"];
        // Se asignan las propiedades del libro
        $objPHPExcel->getProperties()->setCreator("Bryan Cordova and Elliott Urrutia") // Nombre del autor
            ->setLastModifiedBy("Bryan") //Ultimo usuario que lo modificó
            ->setTitle("Reporte") // Titulo
            ->setSubject("Reporte Excel con PHP") //Asunto
            ->setDescription("Reporte de Motivos de baja") //Descripción
            ->setKeywords("Reporte Motivos de baja") //Etiquetas
            ->setCategory("Reporte Excel"); //Categorias
        $tituloReporte = "Reporte Motivos de baja de Productos";
        $titulosColumnas = array('Código' , 'Nombre Producto', 'Tipo', 'Categoría','Fecha de baja ','Cantidad de baja','Usuario que realizó la baja',
                                  'Motivo de baja');
        // Se combinan las celdas A1 hasta F1, para colocar ahí el titulo del reporte
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A1:H1');
        // Se agregan los titulos del reporte
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1',  $tituloReporte) // Titulo del reporte
            ->setCellValue('A3',  $titulosColumnas['0'])  //Titulo de las columnas
            ->setCellValue('B3',  $titulosColumnas['1'])
            ->setCellValue('C3',  $titulosColumnas['2'])
            ->setCellValue('D3',  $titulosColumnas['3'])
            ->setCellValue('E3',  $titulosColumnas['4'])
            ->setCellValue('F3',  $titulosColumnas['5'])
            ->setCellValue('G3',  $titulosColumnas['6'])
            ->setCellValue('H3',  $titulosColumnas['7']);
            //Se agregan los datos de los productos
        $i = 4; //Numero de fila donde se va a comenzar a rellenar
      $TotalProductos = $this->reporte->motivosdebaja($buscartipo, $buscarcat, $buscarmot);     
      foreach ($TotalProductos as $value) 
        {
              $codigo = $value['INV_PROD_CODIGO'];
              $nomprod = $value['INV_PROD_NOM'];
              $nomtipo = $value['BAJA_TIPO'];
              $nomcat = $value['CAT_NOMBRE'];
              $Activo = "Activo";
              $Fungible = "Fungible";
              $fecha = $value['BAJA_FECHA'];
              $sr = "SIN REGISTRO";
              $cantidad = $value['BAJA_CANTIDAD'];
              $usuario = $value['USU_NOMBRES'];
              $motivo = $value['MOT_NOMBRE'];
              if ($nomtipo == 1) {
             $objPHPExcel->setActiveSheetIndex(0)
              ->setCellValue('A'.$i, $codigo)
              ->setCellValue('B'.$i, $nomprod)
              ->setCellValue('C'.$i, $Activo)
              ->setCellValue('D'.$i, $nomcat)
              ->setCellValue('E'.$i, $fecha)
              ->setCellValue('F'.$i, $cantidad)
              ->setCellValue('G'.$i, $usuario)
              ->setCellValue('H'.$i, $motivo);
          $i++;
              }elseif ($nomtipo == 2) {
             $objPHPExcel->setActiveSheetIndex(0)
              ->setCellValue('A'.$i, $codigo)
              ->setCellValue('B'.$i, $nomprod)
              ->setCellValue('C'.$i, $Fungible)
              ->setCellValue('D'.$i, $nomcat)
              ->setCellValue('E'.$i, $fecha)
              ->setCellValue('F'.$i, $cantidad)
              ->setCellValue('G'.$i, $usuario)
              ->setCellValue('H'.$i, $motivo);
          $i++;
              }else
              {
             $objPHPExcel->setActiveSheetIndex(0)
              ->setCellValue('A'.$i, $codigo)
              ->setCellValue('B'.$i, $nomprod)
              ->setCellValue('C'.$i, $sr)
              ->setCellValue('D'.$i, $nomcat)
              ->setCellValue('E'.$i, $fecha)
              ->setCellValue('F'.$i, $cantidad)
              ->setCellValue('G'.$i, $usuario)
              ->setCellValue('H'.$i, $motivo);
          $i++;

              }

        }
      
$estiloTituloReporte = array(
    'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>16,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'argb' => 'FF220835')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
 
$estiloTituloColumnas = array(
    'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' => 8,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'argb' => 'FF220835')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
 
$estiloInformacion = new PHPExcel_Style();
$estiloInformacion->applyFromArray( array(
    'font' => array(
        'name'  => 'Arial',
        'size' =>12,
        'color' => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
  'type'  => PHPExcel_Style_Fill::FILL_SOLID,
  'color' => array(
            'argb' => 'FFd9b7f4')
  ),
    'borders' => array(
        'left' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
      'color' => array(
              'rgb' => '3a2a47'
            )
        )
    )
));
$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A3:H3')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:H".($i-1));
// Tamaño automatico
for($i = 'A'; $i <= 'H'; $i++){
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
}
// Se asigna el nombre a la hoja
$objPHPExcel->getActiveSheet()->setTitle('Motivos de baja');
 
// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
$objPHPExcel->setActiveSheetIndex(0);
 
// Inmovilizar paneles
//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
// Se manda el archivo al navegador web, con el nombre que se indica, en formato Excel5
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reportesbaja.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

      }
    public function Pdfbaja(){
      $this->load->library('Pdf');
      $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
      $buscartipo = $_POST["tipo"];
      $buscarcat = $_POST["cat"];
      $buscarmot = $_POST["mot"];
      $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
      $pdf->SetFont('dejavusans', '', 7, '', true);
      $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                   Reporte de Motivos de baja', "");
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
        $html .= "th{border:1px solid black;text-align:center;font-weight:bold; }";
        $html .= "td{border:1px solid black;text-align:center }";
        $html .= "</style>";
        $html .= "<h4>Productos dados de baja: ".count($TotalProductos)."</h4>";
        $html .= "<table width='100%'>";
        $html .= "<tr>
                  <th>Código</th>
                  <th>Nombre producto</th>
                  <th>Tipo</th>
                  <th>Categoría</th>
                  <th>Fecha dado de baja</th>
                  <th>Cantidad de baja</th>
                  <th>Usuario que realizó la baja</th>
                  <th>Motivo de baja</th>
                  </tr>";
               foreach ($TotalProductos as $value) 
        {
        $codigo = $value['INV_PROD_CODIGO'];
        $nomprod = $value['INV_PROD_NOM'];
        $nomtipo = $value['BAJA_TIPO'];
        $nomcat = $value['CAT_NOMBRE'];
        $fecha = $value['BAJA_FECHA'];
        $cantidad = $value['BAJA_CANTIDAD'];
        $usuario = $value['USU_NOMBRES'];
        $motivo = $value['MOT_NOMBRE'];
            $html .= "<tr>
                      <td class='codigo' >".$codigo."</td>
                      <td class='tipo' >".$nomprod."</td>";
                      if ($value['BAJA_TIPO'] == 1) {
            $html .= "<td class='Tipo' >Activo</td>";
                      }elseif ($value['BAJA_TIPO'] == 2) {
            $html .= "<td class='Tipo'>Fungible</td>";
                      }else{
            $html .= "<td class='Tipo'>SIN REGISTRO</td>";
                      }
                      
            $html .= "<td class='Categoria'>".$nomcat."</td>
                      <td class= 'Fecha' >".$fecha."</td>
                      <td class= 'cantidad' >".$cantidad."</td>
                      <td class= 'usuario' >".$usuario."</td>
                      <td class= 'motivo' >".$motivo."</td>
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
      if ($buscaradq == 0) {
        $datos['buscartipo'] = $buscartipo;
        $datos['buscarcat'] = $buscarcat;
        $datos['buscaradq'] = $buscaradq;
        $datos['buscar'] = $this->reporte->vidautilCompras($buscartipo, $buscarcat, $buscaradq);    
        $datos['buscar'] = $this->reporte->vidautilDonaciones($buscartipo, $buscarcat, $buscaradq); 
      }
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
  public function excelvida(){
        $this->load->library('Excel');
        $objPHPExcel = new PHPExcel();
        date_default_timezone_set('America/Santiago');
        $buscartipo = $_POST["tipo"];
        $buscarcat = $_POST["cat"];
        $buscaradq = $_POST["adq"];
        // Se asignan las propiedades del libro
        $objPHPExcel->getProperties()->setCreator("Bryan Cordova and Elliott Urrutia") // Nombre del autor
            ->setLastModifiedBy("Bryan") //Ultimo usuario que lo modificó
            ->setTitle("Reporte") // Titulo
            ->setSubject("Reporte Excel con PHP") //Asunto
            ->setDescription("Reporte de Vida útil") //Descripción
            ->setKeywords("Reporte Vida útil") //Etiquetas
            ->setCategory("Reporte Excel"); //Categorias
        $tituloReporte = "Reporte Vida útil de Productos";
        $titulosColumnas = array('Código' , 'Nombre Producto', 'Tipo', 'Categoría','Fecha de ingreso',
          'Fecha Término','Nombre Proveedor','RUT Proveedor','Tipo ingreso','Vida útil');
        // Se combinan las celdas A1 hasta F1, para colocar ahí el titulo del reporte
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A1:J1');
        // Se agregan los titulos del reporte
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1',  $tituloReporte) // Titulo del reporte
            ->setCellValue('A3',  $titulosColumnas['0'])  //Titulo de las columnas
            ->setCellValue('B3',  $titulosColumnas['1'])
            ->setCellValue('C3',  $titulosColumnas['2'])
            ->setCellValue('D3',  $titulosColumnas['3'])
            ->setCellValue('E3',  $titulosColumnas['4'])
            ->setCellValue('F3',  $titulosColumnas['5'])
            ->setCellValue('G3',  $titulosColumnas['6'])
            ->setCellValue('H3',  $titulosColumnas['7'])
            ->setCellValue('I3',  $titulosColumnas['8'])
            ->setCellValue('J3',  $titulosColumnas['9']);
            //Se agregan los datos de los productos
        $i = 4; //Numero de fila donde se va a comenzar a rellenar
        $vida = $this->reporte->vidautilCompras($buscartipo, $buscarcat, $buscaradq);
        $vida = $this->reporte->vidautilDonaciones($buscartipo, $buscarcat, $buscaradq);          
               foreach ($vida as $value) 
        {
        $codigo = $value['INV_PROD_CODIGO'];
        $prodnom = $value['INV_PROD_NOM'];
        $nomtipo = $value['TIPO_NOMBRE'];
        $nomcat = $value['CAT_NOMBRE'];
        $fechaing = $value['ING_FECHA'];
        @$nomprov = $value['PROV_NOMBRE'];
        @$rutprov = $value['PROV_RUT'];
        $ingtipo = $value['ING_TIPO_INGRESO'];
        $vidautil = $value['ING_VIDA_UTIL_PROVEEDOR'];
        $compra = "Compra";
        $donacion = "Donación";
        $node = "No definido";
        $fecha = date('Y-m-d',strtotime('+'.$vidautil.'months', strtotime($fechaing)));
        if ($codigo == 0) {
          $fecha = "0-0-0";
        }
        if ($nomprov == 0) {
        $nomprov = "Sin registro";
        $rutprov = "Sin registro";
        }
        if ($ingtipo == 1) {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $codigo)
            ->setCellValue('B'.$i, $prodnom)
            ->setCellValue('C'.$i, $nomtipo)
            ->setCellValue('D'.$i, $nomcat)
            ->setCellValue('E'.$i, $fechaing)
            ->setCellValue('F'.$i, $fecha)
            ->setCellValue('G'.$i, $nomprov)
            ->setCellValue('H'.$i, $rutprov)
            ->setCellValue('I'.$i, $compra)
            ->setCellValue('J'.$i, $vidautil);
        $i++;
        }elseif ($ingtipo == 2) {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $codigo)
            ->setCellValue('B'.$i, $prodnom)
            ->setCellValue('C'.$i, $nomtipo)
            ->setCellValue('D'.$i, $nomcat)
            ->setCellValue('E'.$i, $fechaing)
            ->setCellValue('F'.$i, $fecha)
            ->setCellValue('G'.$i, $nomprov)
            ->setCellValue('H'.$i, $rutprov)
            ->setCellValue('I'.$i, $donacion)
            ->setCellValue('J'.$i, $vidautil);
        $i++;
        }else {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $codigo)
            ->setCellValue('B'.$i, $prodnom)
            ->setCellValue('C'.$i, $nomtipo)
            ->setCellValue('D'.$i, $nomcat)
            ->setCellValue('E'.$i, $fechaing)
            ->setCellValue('F'.$i, $fecha)
            ->setCellValue('G'.$i, $nomprov)
            ->setCellValue('H'.$i, $rutprov)
            ->setCellValue('I'.$i, $node)
            ->setCellValue('J'.$i, $vidautil);
        $i++;
        }
      }
      
$estiloTituloReporte = array(
    'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>16,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'argb' => 'FF220835')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
 
$estiloTituloColumnas = array(
    'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' => 8,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'argb' => 'FF220835')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
 
$estiloInformacion = new PHPExcel_Style();
$estiloInformacion->applyFromArray( array(
    'font' => array(
        'name'  => 'Arial',
        'size' =>12,
        'color' => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
  'type'  => PHPExcel_Style_Fill::FILL_SOLID,
  'color' => array(
            'argb' => 'FFd9b7f4')
  ),
    'borders' => array(
        'left' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
      'color' => array(
              'rgb' => '3a2a47'
            )
        )
    )
));
$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A3:J3')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:J".($i-1));
// Tamaño automatico
for($i = 'A'; $i <= 'J'; $i++){
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
}
// Se asigna el nombre a la hoja
$objPHPExcel->getActiveSheet()->setTitle('Vida útil');
 
// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
$objPHPExcel->setActiveSheetIndex(0);
 
// Inmovilizar paneles
//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
// Se manda el archivo al navegador web, con el nombre que se indica, en formato Excel5
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reportesvidautil.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
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
      $vida = $this->reporte->vidautilCompras($buscartipo, $buscarcat, $buscaradq);    
      $vida = $this->reporte->vidautilDonaciones($buscartipo, $buscarcat, $buscaradq);
        $html = '';
        $html .= "<style type=text/css>";
        $html .= "th{border:1px solid black;text-align:center;font-weight:bold; }";
        $html .= "td{border:1px solid black;text-align:center }";
        $html .= "</style>";
        $html .= "<h4>Actualmente: ".count($vida)." Productos</h4>";
        $html .= "<table width='100%'>";
        $html .= "<tr><th>Código</th>
                  <th>Tipo</th>
                  <th>Categoría</th>
                  <th>Nombre producto</th>
                  <th>Fecha ingreso</th>
                  <th>Fecha término</th>
                  <th>Nombre proveedor</th>
                  <th>RUT</th>
                  <th>Tipo Ingreso</th>
                  <th>Vida útil</th>
                  </tr>";
               foreach ($vida as $value) 
        {
        $codigo = $value['INV_PROD_CODIGO'];
        $nomtipo = $value['TIPO_NOMBRE'];
        $nomcat = $value['CAT_NOMBRE'];
        $prodnom = $value['INV_PROD_NOM'];
        $fechaing = $value['ING_FECHA'];
        @$nomprov = $value['PROV_NOMBRE'];
        @$rutprov = $value['PROV_RUT'];
        $vidautil = $value['ING_VIDA_UTIL_PROVEEDOR'];
        $ingtipo = $value['ING_TIPO_INGRESO'];
        $fecha = date('Y-m-d',strtotime('+'.$vidautil.'months', strtotime($fechaing)));                 
        if ($codigo == 0) {
          $fecha = "0-0-0";
        }
        if ($nomprov == 0) {
          $nomprov = "Sin registro";
          $rutprov = "Sin registro";
        }
            $html .= "<tr>
                      <td class='codigo'>".$codigo."</td>
                      <td class='tipo'>".$nomtipo."</td>
                      <td class='categoria'>".$nomcat."</td>
                      <td class= 'producto' >".$prodnom."</td>
                      <td class= 'ingreso' >".$fechaing."</td>
                      <td class= 'termino' >".$fecha."</td>";
                      if ($value['ING_TIPO_INGRESO'] == 1) {
            $html .= "<td class= 'proveedor' >".$nomprov."</td>
                      <td class= 'rut' >".$rutprov."</td>
                      <td>Compra</td>";
                      }elseif ($value['ING_TIPO_INGRESO'] == 2) {
            $html .= "<td>Sin registro</td>
                        <td>Sin registro</td>
                        <td>Donación</td>";
                      }else
            $html .= "<td>Sin registro</td>
                      <td>Sin registro</td>
                      <td>No definido</td>";

            $html .= "<td class= 'vidautil' >".$vidautil." Meses</td>
                      </tr>";
        }
        $html .= "</table>";
          $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 1, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
          ob_clean();
          $categoria = utf8_decode("Categoria ".$nomcat.".pdf");
          //$tipos = utf8_decode("Tipo".$tipo.".pdf");
          $pdf->Output($categoria, 'I');
        
}
//7496204
  // PRECIO UNITARIO
  public function Vistapreciounitario(){
        $datos['categoria'] = $this->categorias->findAll();
        $datos['tipo'] = $this->reporte->tipo();
        if ($this->input->post('filtro')) {
        $buscartipo = $this->input->post('tipo');
        $buscarcat = $this->input->post('cat');
        if ($buscartipo == 1) {
        $datos['buscartipo'] = $buscartipo;
        $datos['buscarcat'] = $buscarcat;
        $datos['buscar'] = $this->reporte->productospreciounitarioActivos($buscartipo, $buscarcat);    
      }if ($buscartipo == 2) { 
        $datos['buscartipo'] = $buscartipo;
        $datos['buscarcat'] = $buscarcat;
        $datos['buscar'] = $this->reporte->productospreciounitarioFungibles($buscartipo, $buscarcat);    
      }

        }
        $this->layouthelper->Loadview("reportes/precioproductos.php",$datos,false); 
  }

    public function excelprecio(){
        $this->load->library('Excel');
        $objPHPExcel = new PHPExcel();
        date_default_timezone_set('America/Santiago');
        $buscartipo = $_POST["tipo"];
        $buscarcat = $_POST["cat"];
        // Se asignan las propiedades del libro
        $objPHPExcel->getProperties()->setCreator("Bryan Cordova and Elliott Urrutia") // Nombre del autor
            ->setLastModifiedBy("Bryan") //Ultimo usuario que lo modificó
            ->setTitle("Reporte") // Titulo
            ->setSubject("Reporte Excel con PHP") //Asunto
            ->setDescription("Reporte de Precios") //Descripción
            ->setKeywords("Reporte Precios") //Etiquetas
            ->setCategory("Reporte Excel"); //Categorias
        $tituloReporte = "Reporte Precio de Productos";
        $titulosColumnas = array('Código   ' ,'Tipo' ,  'Categoría' ,'Nombre Producto',
                                  'Precio unitario','Cantidad','Precio productos');
        // Se combinan las celdas A1 hasta F1, para colocar ahí el titulo del reporte
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A1:F1');
        // Se agregan los titulos del reporte
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1',  $tituloReporte) // Titulo del reporte
            ->setCellValue('A3',  $titulosColumnas['0'])  //Titulo de las columnas
            ->setCellValue('B3',  $titulosColumnas['1'])
            ->setCellValue('C3',  $titulosColumnas['2'])
            ->setCellValue('D3',  $titulosColumnas['3'])
            ->setCellValue('E3',  $titulosColumnas['4'])
            ->setCellValue('F3',  $titulosColumnas['5'])
            ->setCellValue('G3',  $titulosColumnas['6']);

            //Se agregan los datos de los productos
        $i = 4; //Numero de fila donde se va a comenzar a rellenar
      $precio = $this->reporte->productospreciounitarioActivos($buscartipo, $buscarcat);
      $totalmax =0;
      $cantidad = 0;
      foreach ($precio as $value) 
        {
              $codigo = $value['INV_PROD_CODIGO'];
              $nomprod = $value['INV_PROD_NOM'];
              $nomtipo = $value['TIPO_NOMBRE'];
              $nomcat = $value['CAT_NOMBRE'];
              if ($value['TIPO_ID'] == 1) {
              $preciounitario = $value['ING_PRECIO_UNITARIO'];
              $precioprod = $value['totalprecio'];
              $total = "Total";
              $totalmax += intval($value['totalprecio']); 
              $cantidad= $value['cantidad'];
              }elseif ($value['TIPO_ID'] == 2) {
              $preciounitario = $value['ING_PRECIO_UNITARIO'];
              $total = "Total";
              $cantidad = $value['INV_PROD_CANTIDAD'];
              $precioprod = $cantidad * $preciounitario;
              $totalmax += $precioprod;
              }elseif ($value['INV_PROD_CODIGO'] == 0) {
                  $preciounitario = $value['ING_PRECIO_UNITARIO'];
                  $total = "Total";
                  $cantidad = "0";
                  $precioprod = "0";
                  $totalmax = "0";
                  
              }

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $codigo)
            ->setCellValue('B'.$i, $nomtipo)
            ->setCellValue('C'.$i, $nomcat)
            ->setCellValue('D'.$i, $nomprod)
            ->setCellValue('E'.$i, $preciounitario)
            ->setCellValue('F'.$i, $cantidad)
            ->setCellValue('G'.$i, $precioprod);
        $i++;
        }
         $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F'.$i, $total);

       $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('G'.$i, $totalmax);

$estilototal = array(
    'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>16,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'argb' => 'FF220835')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);

$estiloTituloReporte = array(
    'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>16,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'argb' => 'FF220835')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
 
$estiloTituloColumnas = array(
    'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' => 8,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'argb' => 'FF220835')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
 
$estiloInformacion = new PHPExcel_Style();
$estiloInformacion->applyFromArray( array(
    'font' => array(
        'name'  => 'Arial',
        'size' =>12,
        'color' => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
  'type'  => PHPExcel_Style_Fill::FILL_SOLID,
  'color' => array(
            'argb' => 'FFd9b7f4')
  ),
    'borders' => array(
        'left' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
      'color' => array(
              'rgb' => '3a2a47'
            )
        )
    )
));

$estilonumeral = ( array(
    'font' => array(
        'name'  => 'Arial',
        'size' =>12,
        'color' => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
  'type'  => PHPExcel_Style_Fill::FILL_SOLID,
  'color' => array(
            'argb' => 'FFd9b7f4')
  ),
    'borders' => array(
        'left' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
      'color' => array(
              'rgb' => '3a2a47'
            )
        )
    )
));
$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A3:G3')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:G".($i-1));
$objPHPExcel->getActiveSheet()->getStyle('F'.$i.':F'.$i)->applyFromArray($estilototal);
$objPHPExcel->getActiveSheet()->getStyle('G'.$i.':G'.$i)->applyFromArray($estilonumeral);


// Tamaño automatico
for($i = 'A'; $i <= 'G'; $i++){
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
}
// Se asigna el nombre a la hoja
$objPHPExcel->getActiveSheet()->setTitle('Precio productos');
 
// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
$objPHPExcel->setActiveSheetIndex(0);
 
// Inmovilizar paneles
//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
// Se manda el archivo al navegador web, con el nombre que se indica, en formato Excel5
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="PrecioProductos.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

      }

    public function Pdfprecio(){

      $this->load->library('Pdf');
      $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
      $buscartipo = $_POST["tipo"];
      $buscarcat = $_POST["cat"];
      $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
      $pdf->SetFont('dejavusans', '', 7, '', true);
      $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                   Reporte Precio de Productos', "");
      $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
      $pdf->AddPage(); 
        $precio = $this->reporte->productospreciounitarioActivos($buscartipo, $buscarcat);
        $html = '';
        $html .= "<style type=text/css>";
        $html .= "th{border:1px solid black;text-align:center;font-weight:bold; }";
        $html .= "td{border:1px solid black;text-align:center }";
        $html .= "p{text-align:right;}";
        $html .= "</style>";
        $html .= "<h4>Actualmente: ".count($precio)." Productos</h4>";
        $html .= "<h4>Fecha: ". date('d-m-Y')."</h4>";
        $html .= "<table width='100%'>";
        $html .= "<tr><th>Código</th>
                  <th>Tipo</th>
                  <th>Categoría</th>
                  <th>Nombre producto</th>
                  <th>Precio unitario</th>
                  <th>Cantidad</th>
                  <th>Monto total</th>
                  </tr>";
                  $totalmax = 0;
                  $total1 = 0;
               foreach ($precio as $value) 
        {
        $codigo = $value['INV_PROD_CODIGO'];
        $nomtipo = $value['TIPO_NOMBRE'];
        $nomcat = $value['CAT_NOMBRE'];
        $prodnom = $value['INV_PROD_NOM'];
        
        if ($value['TIPO_ID'] == 1) { 
        $ingpreciounitario = $value['ING_PRECIO_UNITARIO'];
        $precioprod = $value['totalprecio'];
        $totalmax += intval($precioprod); 
        $total1 += $totalmax;
        $cantidad= $value['cantidad'];
      }elseif ($value['TIPO_ID'] == 2) {
        $ingpreciounitario = $value['ING_PRECIO_UNITARIO'];
        $cantidad = $value['INV_PROD_CANTIDAD'];
        $precioprod = $cantidad * $ingpreciounitario;
        $totalmax += $precioprod;
      }elseif ($value['INV_PROD_CODIGO'] == 0) {
        $ingpreciounitario = "0";
        $cantidad = "0";
        $precioprod = "0";
        $totalmax = "0";
      }
        
            $html .= "<tr>
                      <td class='codigo'>".$codigo."</td>
                      <td class='tipo'>".$nomtipo."</td>
                      <td class='categoria'>".$nomcat."</td>
                      <td class= 'producto' >".$prodnom."</td>
                      <td class= 'vidautil' >".$ingpreciounitario."</td>
                      <td class= 'ingreso' >".$cantidad."</td>
                      <td class= 'vidautil' >".$precioprod."</td>
                      </tr>";
                      }
        $html .= "</table>
                      <p>Precio total :".$totalmax."</p>";
      
          $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 1, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
          ob_clean();
          $categoria = utf8_decode("Categoria ".$nomcat.".pdf");
          //$tipos = utf8_decode("Tipo".$tipo.".pdf");
          $pdf->Output($categoria, 'I');

    }
}
///////////////////////////////////////////////////////////////////////////////////

/* End of file reportes.php */
/* Location: ./application/controllers/reportes.php */