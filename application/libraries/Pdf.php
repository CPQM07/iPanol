<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }


    public function HTMLPDFSOLICITUD($ultimasolicitud,$cargo,$usunombreapellido,$asignaturanombre,$fechainicio,$fechatermino,$observaciones,$grupotrabajo,$usuarionombresession,$asignaciones){
    	$forasig = "";
    	foreach($asignaciones as $key => $current) {

    	  if($current['INV_ULTIMO_USUARIO'] == 0){
    	  	$current['INV_ULTIMO_USUARIO'] = "NO POSEE";
    	  }
    	  	
          $forasig .= '<tr>
                      <td colspan="2">'.$current['INV_PROD_NOM'].' (ID:'.$current['ASIG_INV_ID'].')</td>
                      <td colspan="1">'.$current['ASIG_CANT'].'</td>
                      <td colspan="1"></td>
                      <td colspan="1"></td>
                      <td colspan="1">'.$current['INV_ULTIMO_USUARIO'].'</td>
                  </tr>';
              }
		$htmlpdf = '<html>
						<head>  
						</head>
						<body>
						  <table style="border-collapse: separate; border-spacing:  20px;">
						      <tr>
						        <td colspan="4" style="text-align: left;"><strong>SOLICITUD INSTRUMENTACIÓN E INSUMOS</strong></td>
						        <td colspan="1"><strong>N°</strong></td>
						        <td colspan="1" style="text-align: center; color:red"><strong>'.$ultimasolicitud.'</strong></td>
						      </tr>
						      <tr>
						        <td  colspan="2"><strong>'.$cargo.'</strong></td>
						        <td  colspan="2" border="1" style="text-align: center;">'.$usunombreapellido.' </td>
						        <td  colspan="1"><strong>FECHA:</strong></td>
						        <td  colspan="1" border="1" style="text-align: center;" >'.date("d-m-Y").'</td>
						      </tr>
						      <tr>
						        <td colspan="2"><strong>ASIGNATURA:</strong></td>
						        <td colspan="4" border="1" style="text-align: center;">'.$asignaturanombre.'</td>
						      </tr>
						      <tr>
						        <td colspan="6"><strong>FECHA Y HORA EN QUE SE REALIZA LA CLASE:</strong></td>
						      </tr>
						      <tr>
						        <td colspan="1"><strong>FECHA:</strong></td>
						        <td colspan="1">'.date("d-m-Y H:i:s").'</td>
						        <td colspan="1"><strong>INICIO:</strong></td>
						        <td colspan="1">'.$fechainicio.'</td>
						        <td colspan="1"><strong>TERMINO:</strong></td>
						        <td colspan="1">'.$fechatermino.'</td>
						      </tr>
						      <tr>
						        <td colspan="6"><strong>DESCRIPCION DE LA TAREA A REALIZAR:</strong></td>
						      </tr>
						      <tr>
						        <td colspan="6" border="1" style="height: : 100px">'.$observaciones.'</td>
						      </tr>
						      <tr>
						        <td colspan="3"><strong>N° DE GRUPOS DE TRABAJO</strong></td>
						        <td colspan="3" border="1" > '.$grupotrabajo.'</td>
						      </tr>
						      <tr>
						        <td colspan="6">
						        <table border="1" style="text-align: center;">
						          <tr bgcolor="lightgray">
						            <td colspan="2"><strong>INVENTARIO</strong></td>
						            <td colspan="1"><strong>CANTIDAD</strong></td>
						            <td colspan="1"><strong>RECIBIDO</strong></td>
						            <td colspan="1"><strong>ENTREGADO</strong></td>
						            <td colspan="1"><strong>ULTIMO RESPONSABLE</strong></td>
						          </tr>
						           '.$forasig.'
						        </table>
						        </td>
						      </tr>
						  </table>
						      <table style="border-collapse: separate; border-spacing:  25px;">
						          <tr>
						            <td colspan="3"><strong>ENTREGA</strong></td>
						            <td colspan="3"><strong>RECEPCIÓN</strong></td>
						          </tr>
						          <tr>
						            <td colspan="1"><small><strong>RECIBIDO:</strong></small></td>
						            <td colspan="2" border="1">'.$usunombreapellido.' </td>
						            <td colspan="1"><small><strong>ENTREGADO:</strong></small></td>
						            <td colspan="2" border="1">'.$usuarionombresession.'</td>
						          </tr>
						          <tr>
						            <td colspan="1"></td>
						            <td colspan="2"></td>
						            <td colspan="1"><small><strong>ENTREGADO:</strong></small></td>
						            <td colspan="2" border="1"></td>
						          </tr>
						      </table>
						</body>
						</html>';
	 return $htmlpdf;
    
}
    public function reporteActual($arrA){
    	/*$variable='';
    	foreach ($ar as $key => $value) {
    	$variable .="<p>".$value['PROD_NOMBRE']."</p><p>".$value['TIPO_NOMBRE']."</p>";

   		 }
   		 return $variable;*/
   		 $forasig='';
   		 foreach ($arrA as $key => $value) {
   		 	
   		  $forasig .= '<tr>
                      <td colspan="1">'.$value['TIPO_NOMBRE'].'</td>
                      <td colspan="1">'.$value['PROD_NOMBRE'].'</td>
                      <td colspan="1">'.$value['ING_FECHA'].'</td>
                      <td colspan="1">'.$value['PROD_STOCK_TOTAL'].'</td>
                      <td colspan="1">'.$value['PROV_NOMBRE'].'</td>
                      <td colspan="1">'.$value['PROD_POSICION'].'</td>
                  </tr>';
              }
              
		$htmlpdf = '<html>
						<head>  
						</head>
						<body>
						  <table style="border-collapse: separate; border-spacing:  20px;">
						      <tr>
						        <td colspan="4" style="text-align: left;"><strong>Productos Actualmente en Stock</strong></td>
						       </tr>
						      <tr>
						        <td colspan="1"><strong>FECHA EMISION:</strong></td>
						        <td colspan="1">'.date("d-m-Y").'</td>
						      
						      </tr>
						      <tr>
						        <td colspan="6">
						        <table border="1" style="text-align: center;">
						          <tr bgcolor="lightgray">
						            <td colspan="1"><strong>Tipo de Producto</strong></td>
						            <td colspan="1"><strong>Producto</strong></td>
						            <td colspan="1"><strong>Fecha</strong></td>
						            <td colspan="1"><strong>Stock</strong></td>
						            <td colspan="1"><strong>Proveedor</strong></td>
						            <td colspan="1"><strong>Posicion</strong></td>
						          </tr>
						           '.$forasig.'
						        </table>
						        </td>
						      </tr>
						  </table>

						     
						</body>
						</html>';
    	return $htmlpdf;
   		 }
    public function reporteCritico($arrC){
    		/*$variable='';
    	foreach ($ar as $key => $value) {
    	$variable .="<p>".$value['PROD_NOMBRE']."</p><p>".$value['TIPO_NOMBRE']."</p>";

   		 }
   		 return $variable;*/
   		 $forasig='';
   		 foreach ($arrC as $key => $value) {
   		 	
   		  $forasig .= '<tr>
                      <td colspan="1">'.$value['TIPO_NOMBRE'].'</td>
                      <td colspan="1">'.$value['CAT_NOMBRE'].'</td>
                      <td colspan="1">'.$value['PROD_NOMBRE'].'</td>
                      <td colspan="1">'.$value['PROD_STOCK_TOTAL'].'</td>
                      <td colspan="1">'.$value['PROD_STOCK_OPTIMO'].'</td>
                      <td colspan="1">'.$value['PROD_PRIORIDAD'].'</td>
                  </tr>';
              }
              
		$htmlpdf = '<html>
						<head>  
						</head>
						<body>
						  <table style="border-collapse: separate; border-spacing:  20px;">
						      <tr>
						        <td colspan="4" style="text-align: left;"><strong>Productos Actualmente en Stock Critico</strong></td>
						       </tr>
						      <tr>
						        <td colspan="1"><strong>FECHA EMISION:</strong></td>
						        <td colspan="1">'.date("d-m-Y").'</td>
						      
						      </tr>
						      <tr>
						        <td colspan="6">
						        <table border="1" style="text-align: center;">
						          <tr bgcolor="lightgray">
						            <td colspan="1"><strong>Tipo</strong></td>
						            <td colspan="1"><strong>Categoria</strong></td>
						            <td colspan="1"><strong>Producto</strong></td>
						            <td colspan="1"><strong>Stock</strong></td>
						            <td colspan="1"><strong>Stock optimo</strong></td>
						            <td colspan="1"><strong>Prioridad</strong></td>
						          </tr>
						           '.$forasig.'
						        </table>
						        </td>
						      </tr>
						  </table>
						     
						</body>
						</html>';
			return $htmlpdf;   		 
    }
    public function reporteBajas($arrB){
    	 $forasig='';
   		 foreach ($arrB as $key => $value) {
   		 	
   		  $forasig .= '<tr>
                      <td colspan="1">'.$value['TIPO_NOMBRE'].'</td>
                      <td colspan="1">'.$value['CAT_NOMBRE'].'</td>
                      <td colspan="1">'.$value['PROD_NOMBRE'].'</td>
                      <td colspan="1">'.$value['INV_PROD_NOM'].'</td>
                      <td colspan="1">'.$value['BAJA_FECHA'].'</td>
                      <td colspan="1">'.$value['ING_FECHA'].'</td>
                      <td colspan="1">'.$value['USU_NOMBRES'].'</td>
                      <td colspan="1">'.$value['MOT_NOMBRE'].'</td>
                  </tr>';
              }
		$htmlpdf = '<html>
						<head>  
						</head>
						<body>
						  <table style="border-collapse: separate; border-spacing:  20px;">
						      <tr>
						        <td colspan="4" style="text-align: left;"><strong>Productos Actualmente dados de baja</strong></td>
						       </tr>
						      <tr>
						        <td colspan="1"><strong>FECHA EMISION:</strong></td>
						        <td colspan="1">CODIGO AQUIIIII</td>
						      
						      </tr>
						      <tr>
						        <td colspan="3"><strong>N° DE GRUPOS DE TRABAJO</strong></td>
						        <td colspan="3" border="1" >CODIGO AQUIIIII</td>
						      </tr>
						      <tr>
						        <td colspan="6">
						        <table border="1" style="text-align: center;">
						          <tr bgcolor="lightgray">
						            <td colspan="1"><strong>Tipo</strong></td>
						            <td colspan="1"><strong>Categoria </strong></td>
						            <td colspan="1"><strong>Nombre</strong></td>
						            <td colspan="1"><strong>Inventario</strong></td>
						            <td colspan="1"><strong>Fecha de baja</strong></td>
						            <td colspan="1"><strong>Fecha Ingreso</strong></td>
						            <td colspan="1"><strong>Usuario responsable</strong></td>
						            <td colspan="1"><strong>Motivo</strong></td>
						          </tr>
						           '.$forasig.'
						        </table>
						        </td>
						      </tr>
						  </table>
						     
						</body>
						</html>';
    	return $htmlpdf;
   		 }    
    public function reporteVida($arrV){
    	 $forasig='';
   		 foreach ($arrV as $key => $value) {
   		 	
   		  $forasig .= '<tr>
                      <td colspan="1">'.$value['TIPO_NOMBRE'].'</td>
                      <td colspan="1">'.$value['PROD_NOMBRE'].'</td>
                      <td colspan="1">'.$value['PROV_NOMBRE'].'</td>
                      <td colspan="1">'.$value['ING_FECHA'].'</td>
                      <td colspan="1">'.$value['ING_VIDA_UTIL_PROVEEDOR'].'</td>
                      <td colspan="1">'.$value['USU_NOMBRES'].'</td>
                  </tr>';
              }
		$htmlpdf = '<html>
						<head>  
						</head>
						<body>
						  <table style="border-collapse: separate; border-spacing:  20px;">
						      <tr>
						        <td colspan="4" style="text-align: left;"><strong>Reporte de vida util de los productos</strong></td>
						       </tr>
						      <tr>
						        <td colspan="1"><strong>FECHA EMISION:</strong></td>
						        <td colspan="1">CODIGO AQUIIIII</td>
						      
						      </tr>
						      <tr>
						        <td colspan="3"><strong>N° DE GRUPOS DE TRABAJO</strong></td>
						        <td colspan="3" border="1" >CODIGO AQUIIIII</td>
						      </tr>
						      <tr>
						        <td colspan="6">
						        <table border="1" style="text-align: center;">
						          <tr bgcolor="lightgray">
						            <td colspan="1"><strong>Tipo de Producto</strong></td>
						            <td colspan="1"><strong>Producto</strong></td>
						            <td colspan="1"><strong>Proveedor</strong></td>
						            <td colspan="1"><strong>Ingreso</strong></td>
						            <td colspan="1"><strong>Vida util</strong></td>
						            <td colspan="1"><strong>Recepcionistas</strong></td>

						          </tr>
						           '.$forasig.'
						        </table>
						        </td>
						      </tr>
						  </table>
						     
						</body>
						</html>';
			return $htmlpdf;
   		 }
}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */