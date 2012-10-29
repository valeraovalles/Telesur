<?php

    $ora=new ConexionDirecta();
    $db=$ora->oracle();
        
    $query_ni="
        select 
            a.tnom_tipnom, a.cedula, a.nombr1, a.nombr2, a.apell1, a.apell2
        from 
            nmm001 a
        where 
            a.fecing >= '01-01-2012'
            and a.fecing <= '30-06-2012'
            order by a.cedula
        
         
    ";
        
    $query="
        select 
            nmm001.nactra, nmm001.cedula, sum(nmm024.moncto) as SUMA          
        from 
            nmm001, nmm023, nmm024 
        where
            nmm001.fictra = nmm023.trab_fictra and
            nmm001.fictra = nmm024.trab_fictra and
     
            nmm023.proc_tippro = 51 and
            nmm024.proc_tippro=nmm023.proc_tippro and

            nmm023.fpro_anocal = 2012 and
            nmm024.fpro_anocal = nmm023.fpro_anocal and

            nmm023.tnom_tipnom = 'EMP' and
            nmm024.tnom_tipnom = nmm023.tnom_tipnom and

            nmm023.fpro_numper in (5,6) and 
            nmm023.fpro_numper = nmm024.fpro_numper

        group by nmm001.nactra, nmm001.cedula order by nmm001.cedula
    ";

    $rs = oci_parse($db,$query);
    oci_execute($rs);
   
    $cadena_ni='';
    $cadena='';
    $cant=0;
    $nuevo_ingreso=0;
    while ( $row = oci_fetch_array($rs, OCI_ASSOC) ){ 
        $ceros='';
	$monto_x='';
			
	$nac= trim($row['NACTRA']);
	$ced= trim($row['CEDULA']);
	$mon= trim($row['SUMA']);
			
	// nacionalidad
	if($nac==1) $nac='V';
        else if($nac==2) $nac='E';
		
	// agrego ceros faltantes a las cedulas
	$l=strlen($ced);
	$cant= 9 - $l;
				
	if($cant!=0){
        	for($i=0;$i<$cant;$i++){
					
                    $ceros .= '0';
                
		}
					
		$cedula = $ceros.$ced;
	}
	else $cedula = $ced;
		
	// agrego ceros faltantes al monto
	$ceros='';				
	$monto = str_replace(",", "", $mon);

	$l=strlen($monto);
				
	$cant= 13 - $l;
								
	if($cant!=0){
            for($i=0;$i<$cant;$i++){
						
                	$ceros .= '0';
						
            }

            $monto_x = $ceros.$monto;
	}
				
	else $monto_x = $monto;
		
	$ceros17=0;
	$cantidad=0;
	while($cantidad<16){
            $ceros17 .='0';
            $cantidad++;
	}
        
        //busco los nuevos ingresos
            $rs_ni = oci_parse($db,$query_ni);
            oci_execute($rs_ni);
            $ni='no';
            while ( $row_ni = oci_fetch_array($rs_ni, OCI_ASSOC)){
                
                if($ced==trim($row_ni['CEDULA'])){
                    $nuevo_ingreso=1;
                    $ni='si';
                    break;
                    
                }
            }
        //        
		
        if($ni=='no')    
            $cadena .= "23193".$nac.$cedula."100A".$monto_x."N".$ceros17." ".$ceros17."00\r\n";
        
        else if($ni=='si'){
            
            if(!isset($row_ni['NOMBR2'])) $row_ni['NOMBR2']='';
            if(!isset($row_ni['APELL2'])) $row_ni['APELL2']='';
           
            $espacios1='';$espacios2='';$espacios3='';$espacios4='';
            $largo1=strlen($row_ni['NOMBR1']);
            $largo2=strlen($row_ni['NOMBR2']);
            $largo3=strlen($row_ni['APELL1']);
            $largo4=strlen($row_ni['APELL2']);
            
            $row_ni['APELL2']=str_replace("?","Ñ",$row_ni['APELL2']);
            $row_ni['APELL1']=str_replace("?","Ñ",$row_ni['APELL1']);
            
            $resto1=31-(16+$largo1);           
            for($i=1;$i<=$resto1;$i++){
                $espacios1 .=' ';
            }
            
            $resto2=46-(31+$largo2);
            for($i=1;$i<=$resto2;$i++){
                $espacios2 .=' ';
            }
            
            $resto3=61-(46+$largo3);
            for($i=1;$i<=$resto3;$i++){
                $espacios3 .=' ';
            }
            
            $resto4=76-(61+$largo4);
            for($i=1;$i<=$resto4;$i++){
                $espacios4 .=' ';
            }
            
            $cadena_ni .= "23193".$nac.$cedula.$row_ni['NOMBR1'].$espacios1.$row_ni['NOMBR2'].$espacios2.$row_ni['APELL1'].$espacios3.$row_ni['APELL2'].$espacios4."S00000000000000000000000000".$monto_x."1\r\n";

        }
					
    }

    $archivo = fopen ("APO0612.txt", "w+");
	
    fwrite($archivo, $cadena);
    fclose($archivo);
    
    if($nuevo_ingreso==1){
        $archivo = fopen ("NIO0612.txt", "w+");

        fwrite($archivo, $cadena_ni);
        fclose($archivo);
    }

?>
