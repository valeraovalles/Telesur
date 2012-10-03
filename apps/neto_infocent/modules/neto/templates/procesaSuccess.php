<br>
<?php

  $tasig=0;
  $tneto=0;
  $deduc=0;
  $montos=0;


  function str_to_float($numero)
  {
    $numero = str_replace(",", ".", $numero);
    $numero = floatval($numero);
    return $numero; 
  }
  
  
  	$ora=new ConexionDirecta();
	$db=$ora->oracle();

        

    if($db)
    {
	 if($proceso=="01")
	  {
      $query="
	
	
		select nmm001.cedula, nmm001.fictra, nmm001.nombr1, nmm001.apell1, nmm001.sueld1, nmm001.fecing, 
		nmm024.tnom_tipnom, nmm024.cto_codcto, nmm024.moncto, nmm024.functo, nmm024.cancto, nmm024.suecal, 
		nmt027.descto, nmt004.descar, nmt019.desdep, nmt033.fecini,nmt033.fecfin
		
		from nmm001, nmm023, nmm024, nmt004, nmt019, nmt027,nmt033 
		 
		where 
		 
		 nmm001.fictra like '%".$codtra."%' and 
		 nmm001.fictra = nmm023.trab_fictra and 
		 nmm001.fictra = nmm024.trab_fictra and 
		 
		 nmm023.fpro_numper = ".$numper." and 
		 nmm024.fpro_numper = nmm023.fpro_numper and 
		 nmt033.numper = nmm023.fpro_numper and
		 
		 nmm023.fpro_anocal = ".$ano." and 
		 nmm024.fpro_anocal = nmm023.fpro_anocal and 
		 nmt033.anocal = nmm023.fpro_anocal and 
		 
		 nmt027.tnom_tipnom = nmm001.tnom_tipnom and
		 nmt033.tnom_tipnom = nmm001.tnom_tipnom and 
		 
		 
		 nmm024.cto_codcto<9000 and
		 nmt027.codcto = nmm024.cto_codcto and 
		 nmm024.functo<>3 and
		  
		 nmm001.cgo_carocu = nmt004.codcar and 
		 nmm001.dpto_coddep = nmt019.coddep and 
		 
		 nmm023.proc_tippro = 1 and 
		 nmm023.proc_tippro = nmm024.proc_tippro and
		 nmt033.proc_tippro =  nmm023.proc_tippro 		 
		 
		 order by nmm024.cto_codcto
				
		";
      
      
      
     
	  }
	 else
	  {

	  $query="
	  	select nmm001.cedula, nmm001.fictra, nmm001.nombr1, nmm001.apell1, nmm001.sueld1, nmm001.fecing, 
		nmm024.tnom_tipnom, nmm024.cto_codcto, nmm024.moncto, nmm024.functo, nmm024.cancto, nmm024.suecal, 
		nmt027.descto, nmt004.descar, nmt019.desdep, nmt033.fecini,nmt033.fecfin
		
		from nmm001, nmm023, nmm024, nmt004, nmt019, nmt027,nmt033 
				 
		where 
				 
		 nmm001.fictra like '%".$codtra."%' and 
		 nmm001.fictra = nmm023.trab_fictra and 
		 nmm001.fictra = nmm024.trab_fictra and 
			 
		 nmm024.fpro_numper = nmm023.fpro_numper and 
		 nmt033.numper = nmm023.fpro_numper and
				 
		 nmm023.fpro_anocal = ".$ano." and 
		 nmm024.fpro_anocal = nmm023.fpro_anocal and 
		 nmt033.anocal = nmm023.fpro_anocal and 
				 
		 nmt027.tnom_tipnom = nmm001.tnom_tipnom and
		 nmt033.tnom_tipnom = nmm001.tnom_tipnom and 
				 
		 nmt027.codcto = nmm024.cto_codcto and 
		 nmm024.functo<>3 and
				  
		 nmm001.cgo_carocu = nmt004.codcar and 
		 nmm001.dpto_coddep = nmt019.coddep and 
				 
		 nmm023.proc_tippro = 52 and 
		 nmm023.proc_tippro = nmm024.proc_tippro and
		 nmt033.proc_tippro =  nmm023.proc_tippro
		 
		 order by nmm024.cto_codcto
	  	";
	  }

    	$rs = oci_parse($db,$query);
		oci_execute($rs);
		
		$row = oci_fetch_array($rs, OCI_ASSOC); 
		
		//fecha ingreso
		$fecing = $row['FECING'];
		
		//tipo nomina
        $tnom_tipnom = $row['TNOM_TIPNOM'];
        
        
        if ($tnom_tipnom == "CONT") {
        	$nomina = "Contratado";
        }
        else if ($tnom_tipnom == "EMP") {
            $nomina = "Empleado";
        }

        else if ($tnom_tipnom == "EXT") {
            $nomina = "Extranjero";
        }
        else if ($tnom_tipnom == "OBR") {
            $nomina = "Obrero";
        }
        else {
              $nomina = "Pasante";
        }

    	//20 porque el el concepto de sueldo
		if ($row['CTO_CODCTO'] == 20){
			$sueld1 = str_to_float($row['SUECAL']);
			$sueld1 = $sueld1 * 30;
		}

		//descripcion del cargo 
    	$descar = $row['DESCAR'];
    	
    	//descripcion del departamento
    	$desdep = $row['DESDEP'];	
      
      
    }
    
    
    //TITULO SI ES AGUINALDO O NOMINA
    if ($proceso=="01")
           $titulo="Desde: ".$row['FECINI'].'<br />'."Hasta: ".$row['FECFIN'].'<br />'."Lapso: QUINCENAL".'<br />'."Nomina: ".$nomina;
	else
		   $titulo="Desde: ".$row['FECINI'].'<br />'."Hasta: ".$row['FECFIN'].'<br />'."Lapso: ANUAL".'<br />'."Nomina: ".$nomina;
	
	$nombre= $row['APELL1']." ".$row['NOMBR1'];

	$f1=str_replace("/", "", $row['FECINI']);
	$f2=str_replace("/", "", $row['FECFIN']);
	$fec=$f1."-Hasta-".$f2;

	
	
	
	$cedula= $row['CEDULA'];
	$fictra= $row['FICTRA'];
	   
	
	oci_execute($rs);
	
	$tdeduc=0;
	//SACO LOS MONTOS
    while ( $row = oci_fetch_array($rs, OCI_ASSOC) ){
    	
		//SI ES UNO ES UNA ASIGNACION SI ES DOS ES DEDUCCION      		
		if ( $row['FUNCTO'] == 1 ){			   	  
		  	$asig = $row['MONCTO'];
        	$asig = str_to_float( $asig ); 
           	$tasig = $tasig + $asig;
		}
			  
		else if ( $row['FUNCTO'] == 2 ){
		 	$deduc = $row['MONCTO'];
            $deduc = str_to_float($deduc);
			$tdeduc = $tdeduc + $deduc;
		}
		
		if(!$asig)$asig=0;
		if(!$deduc)$deduc=0;
			  
		$montos .="
		    <tr>
		      <td>".$row['DESCTO']."</td>
		      <td style='padding-left:30px;'>".number_format($row['CANCTO'], 2, ',', '.')."</td>
		      <td style='padding-left:34px;'>".number_format($asig, 2, ',', '.')."</td>
		      <td style='padding-left:38px;'>".number_format($deduc, 2, ',', '.')."</td>
		    </tr>    
	    ";
	    
	     $asig = "";
	     $deduc = "";
        }
 	    
	    $tneto = $tasig - $tdeduc;
	  

$html="

		<div class='titulo'>RECIBO DE PAGO</div>
		
		<table width='700' cellspacing='1'>
			<tr>
			  <td style='background-color:white;' align='left'>".$titulo."</td>
			  <td style='background-color:white;' align='right'>".image_tag('telesur.jpeg',array('size' => '110x110'))."</td>
			</tr>
		</table>

		<br>
		
		<table width='700' cellspacing='1'>
		    <tr>
		      <th width='250'>APELLIDOS Y NOMBRES</th>
		      <th width='250'>CEDULA DE IDENTIDAD</th>
		      <th width='200'>CODIGO</th>
		    </tr> 
		    <tr>
		      <td align='center'>".$nombre."</td>
		      <td align='center'>".$cedula."</td>
		      <td align='center'>".$fictra."</td>
		    </tr>
		</table>
		
		<br>
		<div class='subtitulo'>DETALLE NETO</div>
		<br>
	
		<table width='700' cellspacing='1'>
   			<tr>
    		  <th width='400'>DESCRIPCION DE LOS CONCEPTOS</th>
    		  <th width='100'>VALOR</th>      
     		 <th width='125'>ASIGNACIONES</th>
    		  <th width='125'>DEDUCCIONES</th>
   			</tr>
   			
   			".$montos."
  		</table>
  		
  		
  		<table width='700' cellspacing='1'>
		    <tr>
		      <th width='225' align='center'>FECHA DE INGRESO</th>
		      <th width='225' align='center'>SUELDO</th>
		      <th width='250' colspan='2' align='center'>TOTALES Bs.</th>
		    </tr> 
		    
		    <tr>
		      <td width='225' align='center'>".$fecing."</td>
		      <td width='225' align='center'>".number_format($sueld1, 2, ",", ".")."</td>
		      <td width='125' align='center'>".number_format($tasig, 2, ",", ".")."</td>
		      <td width='125' align='center'>".number_format($tdeduc, 2, ",", ".")."</td>
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
		      <td align='center'>".$descar."</td>
		      <td align='center'>".$desdep."</td>
		      <td align='center'>".number_format($tneto, 2, ",", ".")."</td>
		    </tr>
		</table>

";
//echo $html;


//==============================================================
//==============================================================
//==============================================================

include("MPDF/mpdf.php");

$mpdf=new mPDF('c'); 

$mpdf->SetDisplayMode('default');

// LOAD a stylesheet
$stylesheet = file_get_contents('css/pdf_neto.css');
$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html);

$mpdf->Output("RP-".$nombre."-".$fec.".pdf","D");

//==============================================================
//==============================================================
//==============================================================

    
?>


