<?php
$html="

		<div class='titulo'>RECIBO DE PAGO</div>
		
		<table width='700' cellspacing='1'>
			<tr>
			  <td style='background-color:white;' align='left'>".html_entity_decode($titulo)."</td>
			  <td style='background-color:white;' align='right'>".image_tag('telesur.jpeg',array('size' => '110x110'))."</td>
			</tr>
		</table>

		<br>
		
		<table width='700' cellspacing='1'>
		    <tr>
		      <th width='300'>APELLIDOS Y NOMBRES</th>
		      <th width='300'>CEDULA DE IDENTIDAD</th>
		    </tr> 
		    <tr>
		      <td align='center'>".$nomape."</td>
		      <td align='center'>".$cedula."</td>
		    </tr>
		</table>
		
		<br>
		<div class='subtitulo'>DETALLE NETO</div>
		<br>
	
		<table width='700' cellspacing='1'>
   		
                    <tr>
                        <th width='450'>DESCRIPCION DE LOS CONCEPTOS</th>   
                        <th width='125'>ASIGNACIONES</th>
                        <th width='125'>DEDUCCIONES</th>
                    </tr>
   			
                               
   			".html_entity_decode($montos)."                    
                            
  		</table>
  		
                <br>

  		<table width='700' cellspacing='1'>
		    <tr>
		      <th width='225' align='center'>FECHA DE INGRESO</th>
		      <th width='225' align='center'>SUELDO</th>
		      <th width='250' colspan='2' align='center'>TOTALES Bs.</th>
		    </tr> 
		    
		    <tr>
		      <td width='225' align='center'>".$fecha_ingreso."</td>
		      <td width='225' align='center'>".number_format($sueldo, 2, ",", ".")."</td>
		      <td width='125' align='center'>".number_format($total_asignado, 2, ",", ".")."</td>
		      <td width='125' align='center'>".number_format($total_deducido, 2, ",", ".")."</td>
		    </tr>
		</table>
		
		<br>
		
  		<table border=2 width='700' cellspacing='1'>
		    <tr>
		      <th width='225' align='center'>CARGO</th>
		      <th width='225' align='center'>UBICACIÓN ADMINISTRATIVA</th>
		      <th width='250' align='center'>TOTAL A PAGAR</th>
		    </tr> 
		    
		    <tr>
		      <td align='center'>".$cargo."</td>
		      <td align='center'>".$dependencia."</td>
		      <td align='center'>".number_format($total_pago, 2, ",", ".")."</td>
		    </tr>
		</table>

";

//==============================================================
//==============================================================
//==============================================================

include("MPDF/mpdf.php");

$mpdf=new mPDF('c'); 

$mpdf->SetDisplayMode('fullpage');

// LOAD a stylesheet
$stylesheet = file_get_contents('css/pdf_neto.css');
$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html);

$mpdf->Output("RP-".$nomape.".pdf","D");

exit;

//==============================================================
//==============================================================
//==============================================================
?>