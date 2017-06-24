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
        $donacion = "Donacion";
        // Se asignan las propiedades del libro
        $objPHPExcel->getProperties()->setCreator("Bryan Cordova and Elliott Urrutia") // Nombre del autor
            ->setLastModifiedBy("Bryan") //Ultimo usuario que lo modificó
            ->setTitle("Reporte") // Titulo
            ->setSubject("Reporte Excel con PHP") //Asunto
            ->setDescription("Reporte de stock actual") //Descripción
            ->setKeywords("reporte stock actual") //Etiquetas
            ->setCategory("Reporte excel"); //Categorias
        $tituloReporte = "Reporte stock actual de Productos";
        $titulosColumnas = array('Codigo  ' , 'Nombre Producto', 'Tipo', 'Categoria','Tipo Ingreso'
                                ,'Posicion','Total');
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
              $total = $value['Total'];

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
      $donacion = "Donacion";
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
        $posicion = $value['PROD_POSICION'];
        $total = $value['Total'];
        if ($buscaradq == 1) {
            $html .= "<tr>
                      <td class='codigo'>".$codigo."</td>
                      <td class='producto'>".$nomprod."</td>
                      <td class='tipo'>".$nomtipo."</td>
                      <td class='categoria'>".$nomcat."</td>
                      <td class='compra'>".$compra."</td>
                      <td class= 'posicion' >".$posicion."</td>
                      <td class= 'posicion' >".$total."</td>
                      </tr>";
        }if ($buscaradq == 2) {
            $html .= "<tr>
                      <td class='codigo'>".$codigo."</td>
                      <td class='producto'>".$nomprod."</td>
                      <td class='tipo'>".$nomtipo."</td>
                      <td class='categoria'>".$nomcat."</td>
                      <td class='compra'>".$donacion."</td>
                      <td class= 'posicion' >".$posicion."</td>
                      <td class= 'posicion' >".$total."</td>
                      </tr>";
        }
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
        $posicion = $value['PROD_POSICION'];
        $total = $value['INV_PROD_CANTIDAD'];
        if ($buscaradq == 1) {
            $html .= "<tr>
                      <td class='codigo'>".$codigo."</td>
                      <td class='nomprod'>".$nomprod."</td>
                      <td class='tipo'>".$nomtipo."</td>
                      <td class='categoria'>".$nomcat."</td>
                      <td class='donacion'>".$compra."</td>
                      <td class= 'posicion' >".$posicion."</td>
                      <td class= 'total' >".$total."</td>
                      </tr>";
        }if ($buscaradq == 2) {
            $html .= "<tr>
                      <td class='codigo'>".$codigo."</td>
                      <td class='nomprod'>".$nomprod."</td>
                      <td class='tipo'>".$nomtipo."</td>
                      <td class='categoria'>".$nomcat."</td>
                      <td class='donacion'>".$donacion."</td>
                      <td class= 'posicion' >".$posicion."</td>
                      <td class= 'total' >".$total."</td>
                      </tr>";
        }
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
        $donacion = "Donacion";
        // Se asignan las propiedades del libro
        $objPHPExcel->getProperties()->setCreator("Bryan Cordova and Elliott Urrutia") // Nombre del autor
            ->setLastModifiedBy("Bryan") //Ultimo usuario que lo modificó
            ->setTitle("Reporte") // Titulo
            ->setSubject("Reporte Excel con PHP") //Asunto
            ->setDescription("Reporte de stock critico") //Descripción
            ->setKeywords("reporte stock critico") //Etiquetas
            ->setCategory("Reporte excel");     //Categorias
        $tituloReporte = "Reporte stock critico de Productos";
        $titulosColumnas = array('Codigo  ' , 'Nombre Producto', 'Tipo','Categoria', 'Tipo Ingreso','Stock Optimo    ', 'Stock Critico','Prioridad  ','Total');
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
        $stockop = $value['PROD_STOCK_OPTIMO'];
        $stockcri = $value['PROD_STOCK_CRITICO'];
        $prioridad = $value['PROD_PRIORIDAD'];
        $cantidad = $value['CANTIDAD'];
        if ($buscaradq == 1) {
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
        if ($buscaradq == 2) {
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

        if ($buscaradq == 1) {
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
        if ($buscaradq == 2) {
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
        $compra = "Compra";
        $donacion = "Donacion";                  
      if ($buscartipo == 1) {      
      $TotalProductos = $this->reporte->findAllCriticosActivos($buscartipo, $buscarcat, $buscaradq);
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
        $stockop = $value['PROD_STOCK_OPTIMO'];
        $stockcri = $value['PROD_STOCK_CRITICO'];
        $prioridad = $value['PROD_PRIORIDAD'];
        $cantidad = $value['CANTIDAD'];
        if ($buscaradq == 1) {
            $html .= "<tr>
                      <td class='codigo' >".$codigo."</td>
                      <td class='producto' >".$nomprod."</td>
                      <td class='tipo'>".$nomtipo."</td>
                      <td class='categoria'>".$nomcat."</td>
                      <td class='compra'>".$compra."</td>
                      <td class= 'optimo' >".$stockop."</td>
                      <td class= 'critico' >".$stockcri."</td>
                      <td class='prioridad' >".$prioridad."</td>
                      <td class='cantidad' >".$cantidad."</td>
                      </tr>";
        }if ($buscaradq == 2) {
                      $html .= "<tr>
                      <td class='codigo' >".$codigo."</td>
                      <td class='producto' >".$nomprod."</td>
                      <td class='tipo'>".$nomtipo."</td>
                      <td class='categoria'>".$nomcat."</td>
                      <td class='compra'>".$donacion."</td>
                      <td class= 'optimo' >".$stockop."</td>
                      <td class= 'critico' >".$stockcri."</td>
                      <td class='prioridad' >".$prioridad."</td>
                      <td class='cantidad' >".$cantidad."</td>
                      </tr>";
        }
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
        $stockop = $value['PROD_STOCK_OPTIMO'];
        $stockcri = $value['PROD_STOCK_CRITICO'];
        $prioridad = $value['PROD_PRIORIDAD'];
        $cantidad = $value['INV_PROD_CANTIDAD'];
        if ($buscaradq == 1) {        
            $html .= "<tr>
                      <td class='codigo'>".$codigo."</td>
                      <td class='nomprod'>".$nomprod."</td>
                      <td class='tipo'>".$nomtipo."</td>
                      <td class='categoria'>".$nomcat."</td>
                      <td class='compra'>".$compra."</td>
                      <td class= 'optimo' >".$stockop."</td>
                      <td class= 'critico' >".$stockcri."</td>
                      <td class='prioridad'>".$prioridad."</td>
                      <td class='cantidad'>".$cantidad."</td>
                      </tr>";
        }if ($buscaradq == 2) {
            $html .= "<tr>
                      <td class='codigo'>".$codigo."</td>
                      <td class='nomprod'>".$nomprod."</td>
                      <td class='tipo'>".$nomtipo."</td>
                      <td class='categoria'>".$nomcat."</td>
                      <td class='donacion'>".$donacion."</td>
                      <td class= 'optimo' >".$stockop."</td>
                      <td class= 'critico' >".$stockcri."</td>
                      <td class='prioridad'>".$prioridad."</td>
                      <td class='cantidad'>".$cantidad."</td>
                      </tr>";
        }
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
            ->setKeywords("reporte Motivos de baja") //Etiquetas
            ->setCategory("Reporte excel"); //Categorias
        $tituloReporte = "Reporte Motivos de baja de Productos";
        $titulosColumnas = array('Codigo   ' , 'Nombre Producto', 'Tipo', 'Categoria','Fecha de baja ',
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
            ->setCellValue('F3',  $titulosColumnas['5']);
            //Se agregan los datos de los productos
        $i = 4; //Numero de fila donde se va a comenzar a rellenar
      $TotalProductos = $this->reporte->motivosdebaja($buscartipo, $buscarcat, $buscarmot);     
      foreach ($TotalProductos as $value) 
        {
              $codigo = $value['INV_PROD_CODIGO'];
              $nomprod = $value['INV_PROD_NOM'];
              $nomtipo = $value['TIPO_NOMBRE'];
              $nomcat = $value['CAT_NOMBRE'];
              $fecha = $value['BAJA_FECHA'];
              $motivo = $value['MOT_NOMBRE'];

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $codigo)
            ->setCellValue('B'.$i, $nomprod)
            ->setCellValue('C'.$i, $nomtipo)
            ->setCellValue('D'.$i, $nomcat)
            ->setCellValue('E'.$i, $fecha)
            ->setCellValue('F'.$i, $motivo);
        $i++;
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
$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A3:F3')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:F".($i-1));
// Tamaño automatico
for($i = 'A'; $i <= 'F'; $i++){
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
        $html .= "th{border:1px solid black;text-align:center;font-weight:bold; }";
        $html .= "td{border:1px solid black;text-align:center }";
        $html .= "</style>";
        $html .= "<h4>Productos dados de baja: ".count($TotalProductos)."</h4>";
        $html .= "<table width='100%'>";
        $html .= "<tr>
                  <th>Codigo</th>
                  <th>Nombre Producto</th>
                  <th>Tipo</th>
                  <th>Categoria</th>                  
                  <th>Fecha de baja</th>
                  <th>Motivo de baja</th>
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
            ->setDescription("Reporte de Vida util") //Descripción
            ->setKeywords("reporte Vida util") //Etiquetas
            ->setCategory("Reporte excel"); //Categorias
        $tituloReporte = "Reporte Vida util de Productos";
          if ($buscaradq == 1) {
        $titulosColumnas = array('Codigo' , 'Nombre Producto', 'Tipo', 'Categoria','Fecha de ingreso',
          'Fecha Termino','Nombre Proveedor','Rut Proveedor','Tipo ingreso','Vida util');
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
               foreach ($vida as $value) 
        {
        $codigo = $value['INV_PROD_CODIGO'];
        $prodnom = $value['INV_PROD_NOM'];
        $nomtipo = $value['TIPO_NOMBRE'];
        $nomcat = $value['CAT_NOMBRE'];
        $fechaing = $value['ING_FECHA'];
        $nomprov = $value['PROV_NOMBRE'];
        $rutprov = $value['PROV_RUT'];
        $ingtipo = $value['ING_TIPO_INGRESO'];
        $vidautil = $value['ING_VIDA_UTIL_PROVEEDOR'];
        $fecha = date('Y-m-d',strtotime('+'.$vidautil.'months', strtotime($fechaing)));
        if ($codigo == 0) {
          $fecha = "0-0-0";
        }
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $codigo)
            ->setCellValue('B'.$i, $prodnom)
            ->setCellValue('C'.$i, $nomtipo)
            ->setCellValue('D'.$i, $nomcat)
            ->setCellValue('E'.$i, $fechaing)
            ->setCellValue('F'.$i, $fecha)
            ->setCellValue('G'.$i, $nomprov)
            ->setCellValue('H'.$i, $rutprov)
            ->setCellValue('I'.$i, $ingtipo)
            ->setCellValue('J'.$i, $vidautil);
        $i++;
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
$objPHPExcel->getActiveSheet()->setTitle('Vida util');
 
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
}  if ($buscaradq == 2) {
          $titulosColumnas = array('Codigo' , 'Nombre Producto', 'Tipo', 'Categoria',
                                    'Fecha de ingreso','Fecha Termino','Tipo ingreso','Vida util');
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
        $vida = $this->reporte->vidautilDonaciones($buscartipo, $buscarcat, $buscaradq);     
               foreach ($vida as $value) 
        {
        $codigo = $value['INV_PROD_CODIGO'];
        $prodnom = $value['INV_PROD_NOM'];
        $nomtipo = $value['TIPO_NOMBRE'];
        $nomcat = $value['CAT_NOMBRE'];
        $fechaing = $value['ING_FECHA'];
        $ingtipo = $value['ING_TIPO_INGRESO'];
        $vidautil = $value['ING_VIDA_UTIL_PROVEEDOR'];
        $fecha = date('Y-m-d',strtotime('+'.$vidautil.'months', strtotime($fechaing)));                 
        if ($codigo == 0) {
          $fecha = "0-0-0";
        }
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $codigo)
            ->setCellValue('B'.$i, $prodnom)
            ->setCellValue('C'.$i, $nomtipo)
            ->setCellValue('D'.$i, $nomcat)
            ->setCellValue('E'.$i, $fechaing)
            ->setCellValue('F'.$i, $fecha)
            ->setCellValue('G'.$i, $ingtipo)
            ->setCellValue('H'.$i, $vidautil);
        $i++;
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
$objPHPExcel->getActiveSheet()->setTitle('Vida util');
 
// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
$objPHPExcel->setActiveSheetIndex(0);
 
// Inmovilizar paneles
//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
// Se manda el archivo al navegador web, con el nombre que se indica, en formato Excel5
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reportesvidautildonacion.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

}}

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
        $html .= "th{border:1px solid black;text-align:center;font-weight:bold; }";
        $html .= "td{border:1px solid black;text-align:center }";
        $html .= "</style>";
        $html .= "<h4>Actualmente: ".count($vida)." Productos</h4>";
        $html .= "<table width='100%'>";
        $html .= "<tr><th>Codigo</th>
                  <th>Tipo</th>
                  <th>Categoria</th>
                  <th>Nombre Producto</th>
                  <th>Fecha Ingreso</th>
                  <th>Fecha Termino</th>
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
        $vidautil = $value['ING_VIDA_UTIL_PROVEEDOR'];
        $ingtipo = $value['ING_TIPO_INGRESO'];
        $fecha = date('Y-m-d',strtotime('+'.$vidautil.'months', strtotime($fechaing)));                 
        if ($codigo == 0) {
          $fecha = "0-0-0";
        }
            $html .= "<tr>
                      <td class='codigo'>".$codigo."</td>
                      <td class='tipo'>".$nomtipo."</td>
                      <td class='categoria'>".$nomcat."</td>
                      <td class= 'producto' >".$prodnom."</td>
                      <td class= 'ingreso' >".$fechaing."</td>
                      <td class= 'termino' >".$fecha."</td>
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
        $html .= "<h4>Actualmente: ".count($vida)." Productos</h4>";
        $html .= "<style type=text/css>";
        $html .= "th{border:1px solid black;text-align:center;font-weight:bold; }";
        $html .= "td{border:1px solid black;text-align:center }";
        $html .= "</style>";
        
        $html .= "<table width='100%'>";
        $html .= "<tr><th>Codigo</th>
                  <th>Tipo</th>
                  <th>Categoria</th>
                  <th>Nombre Producto  </th>
                  <th>Fecha Ingreso</th>
                  <th>Fecha Termino</th>
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
        $vidautil = $value['ING_VIDA_UTIL_PROVEEDOR'];
        $ingtipo = $value['ING_TIPO_INGRESO'];
        $fecha = date('Y-m-d',strtotime('+'.$vidautil.'months', strtotime($fechaing)));          
        if ($codigo == 0) {
          $fecha = "0-0-0";
        }
            $html .= "<tr>
                      <td class='codigo'>".$codigo."</td>
                      <td class='tipo'>".$nomtipo."</td>
                      <td class='categoria'>".$nomcat."</td>
                      <td class= 'producto' >".$prodnom."</td>
                      <td class= 'ingreso' >".$fechaing."</td>
                      <td class= 'termino' >".$fecha."</td>
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
}
  public function Vistapreciounitario(){
          $datos['categoria'] = $this->categorias->findAll();
      $datos['tipo'] = $this->reporte->tipo();
      if ($this->input->post('filtro')) {
        $buscartipo = $this->input->post('tipo');
        $buscarcat = $this->input->post('cat');

        $datos['buscartipo'] = $buscartipo;
        $datos['buscarcat'] = $buscarcat;
        $datos['buscar'] = $this->reporte->productospreciounitario($buscartipo, $buscarcat);    
      }        
        $this->layouthelper->Loadview("reportes/precioproductos.php",$datos,false); 
  }

    public function Pdfprecio(){
      $this->load->library('Pdf');
      $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
      $buscartipo = $_POST["tipo"];
      $buscarcat = $_POST["cat"];
      $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
      $pdf->SetFont('dejavusans', '', 7, '', true);
      $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                   Reporte Precio de productos', "");
      $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
      $pdf->AddPage(); 
        $preciototal = $this->reporte->productospreciototal($buscartipo, $buscarcat);
        $precio = $this->reporte->productospreciounitario($buscartipo, $buscarcat);
        $html = '';
        $html .= "<style type=text/css>";
        $html .= "th{border:1px solid black;text-align:center;font-weight:bold; }";
        $html .= "td{border:1px solid black;text-align:center }";
        $html .= "</style>";
        $html .= "<h4>Actualmente: ".count($precio)." Productos</h4>";
        $html .= "<table width='100%'>";
        $html .= "<tr><th>Codigo</th>
                  <th>Tipo</th>
                  <th>Categoria</th>
                  <th>Nombre Producto</th>
                  <th>Tipo Ingreso</th>
                  <th>Precio unitario</th>
                  <th>Monto total</th>
                  </tr>";
               foreach ($precio as $value) 
        {
        $codigo = $value['INV_PROD_CODIGO'];
        $nomtipo = $value['TIPO_NOMBRE'];
        $nomcat = $value['CAT_NOMBRE'];
        $prodnom = $value['INV_PROD_NOM'];
        $ingtipo= $value['ING_TIPO_INGRESO'];
        $ingpreciounitario = $value['ING_PRECIO_UNITARIO'];
        $precioprod = $value['totalprecio'];
        
            $html .= "<tr>
                      <td class='codigo'>".$codigo."</td>
                      <td class='tipo'>".$nomtipo."</td>
                      <td class='categoria'>".$nomcat."</td>
                      <td class= 'producto' >".$prodnom."</td>
                      <td class= 'ingreso' >".$ingtipo."</td>
                      <td class= 'vidautil' >".$ingpreciounitario."</td>
                      <td class= 'vidautil' >".$precioprod."</td>
                      
                      </tr>";
                      }
                       foreach ($preciototal as $value) 
        {
        $total = $value['total'];
        $html .= "</table><h4>".$total."</h4>";
      }
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