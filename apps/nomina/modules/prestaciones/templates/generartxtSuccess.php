<?php

$ora=new ConexionDirecta();
$db=$ora->oracle();
        
    $cadena_ni_ced=array(
                0=>'10348813',1=>'21376923',2=>'84413731',
                3=>'9702473',4=>'16902660',5=>'32650031N',
                6=>'16590723',7=>'16889679',8=>'14197652',
                9=>'6475057',10=>'19272929',11=>'17958061',
                12=>'17125191',13=>'6749734',14=>'11200050',
                15=>'20068563',16=>'12688195',17=>'11182945',
                18=>'18327569',19=>'6119327',20=>'18368009',
                21=>'17753184',22=>'18914751',23=>'10489722',
                24=>'12960427',25=>'5842224',26=>'208606',
                27=>'30745400',28=>'12715290'
    );
    
    $query="
        select 
            nmm001.tnom_tipnom, nmm001.nombr1, nmm001.nombr2, nmm001.apell1, nmm001.apell2,
            nmm001.nactra, nmm001.cedula, sum(nmm024.moncto) as SUMA         
        from 
            nmm001, nmm023, nmm024 
        where
            --nmm001.fictra like '%17312612%' and
            nmm001.fictra = nmm023.trab_fictra and
            nmm001.fictra = nmm024.trab_fictra and
           
            nmm023.proc_tippro = 51 and
            nmm024.proc_tippro=nmm023.proc_tippro and

            nmm023.fpro_anocal = ".$anio." and
            nmm024.fpro_anocal = nmm023.fpro_anocal and

            nmm023.tnom_tipnom = '".$nomina."' and
            nmm024.tnom_tipnom = nmm023.tnom_tipnom and

            nmm023.fpro_numper in (".$periodo.") and 
            nmm023.fpro_numper = nmm024.fpro_numper

        group by nmm001.nactra, nmm001.cedula,nmm001.tnom_tipnom, nmm001.nombr1, nmm001.nombr2, nmm001.apell1, nmm001.apell2 order by nmm001.cedula
    ";

    $rs = oci_parse($db,$query);
    oci_execute($rs);
   

    $totalmonto=0;$cadena='';$cadena_ni='';
    //recorro el query de prestaciones para comprarlo con el array de nuevos ingresos
    while ( $row = oci_fetch_array($rs, OCI_ASSOC) ){ 
    $ceros='';		
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
        $monto_x='';
	$ceros='';
        $monto = str_replace(",", ".", $mon);
        $monto=number_format($monto, 2,".","");
        $totalmonto=$monto+$totalmonto; //VOY SUMANDO EL TOTAL
        $monto = str_replace(".", "", $monto);
	$l=strlen($monto);
	$cant= 13 - $l;
	if($cant!=0){
            for($i=0;$i<$cant;$i++){
                	$ceros .= '0';
            }
            $monto_x = $ceros.$monto;
	}
	else $monto_x = $monto;
		
        //CREO VARIABLE CON 17 CEROS
	$ceros17=0;
	$cantidad=0;
	while($cantidad<16){
            $ceros17 .='0';
            $cantidad++;
	}
        
        //busco los nuevos ingresos
            $ni='no';
            foreach ( $cadena_ni_ced as $ani){
                
                if($ced==$ani){
                    $ni='si';
                    $genera=1;
                    break;
                }
            }
        //        
		
        if($ni=='no')    
            $cadena .= "23193".$nac.$cedula."100A".$monto_x."N".$ceros17." ".$ceros17."00\r\n";
        
        else if($ni=='si'){

            if(!isset($row['NOMBR2'])) $row['NOMBR2']='';
            if(!isset($row['APELL2'])) $row['APELL2']='';
           
            $espacios1='';$espacios2='';$espacios3='';$espacios4='';
            $largo1=strlen($row['NOMBR1']);
            $largo2=strlen($row['NOMBR2']);
            $largo3=strlen($row['APELL1']);
            $largo4=strlen($row['APELL2']);
            
            $row['APELL2']=str_replace("?","Ñ",$row['APELL2']);
            $row['APELL1']=str_replace("?","Ñ",$row['APELL1']);
            
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
            
            $cadena_ni .= "23193".$nac.$cedula.$row['NOMBR1'].$espacios1.$row['NOMBR2'].$espacios2.$row['APELL1'].$espacios3.$row['APELL2'].$espacios4."S00000000000000000000000000".$monto_x."\r\n";
            //echo $row['APELL2'];
            //exit(0);
        }				
    }

    //echo $totalmonto;
    $periodo=  str_replace(",", "", $periodo);    
    if ($nomina=='OBR'){ $nombre_archivo='APO'.$periodo.$anio; $nombre_archivo_ni='NIO'.$periodo.$anio;}
    else if ($nomina=='CONT'){ $nombre_archivo='APC'.$periodo.$anio; $nombre_archivo_ni='NIC'.$periodo.$anio;}
    else if ($nomina=='EMP'){ $nombre_archivo='APE'.$periodo.$anio; $nombre_archivo_ni='NIE'.$periodo.$anio;}
    else if ($nomina=='ANI'){ $nombre_archivo='APA'.$periodo.$anio; $nombre_archivo_ni='NIA'.$periodo.$anio;}
    else if ($nomina=='EXT'){ $nombre_archivo='APEX'.$periodo.$anio; $nombre_archivo_ni='NIEX'.$periodo.$anio;}
    else if ($nomina=='COMS'){ $nombre_archivo='APCS'.$periodo.$anio; $nombre_archivo_ni='NICS'.$periodo.$anio;}
   
       $archivo = fopen("/home/jhoan/www/Telesur/web/uploads/nomina/".$nombre_archivo.".txt", "w+");
    fwrite($archivo, $cadena);
    fclose($archivo);
    
    if(isset($genera) && $genera==1){
        $archivo = fopen("/home/jhoan/www/Telesur/web/uploads/nomina/".$nombre_archivo_ni.".txt", "w+");
        fwrite($archivo, $cadena_ni);
        fclose($archivo);
    }


/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/*
    $ora=new ConexionDirecta();
    $db=$ora->oracle();
        
    $query_ni="
        select 
            a.tnom_tipnom, a.cedula, a.nombr1, a.nombr2, a.apell1, a.apell2
        from 
            nmm001 a
        where 
            a.fecing >= '".$nidesde."'
            and a.fecing <= '".$nihasta."'
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

            nmm023.fpro_anocal = ".$anio." and
            nmm024.fpro_anocal = nmm023.fpro_anocal and

            nmm023.tnom_tipnom = '".$nomina."' and
            nmm024.tnom_tipnom = nmm023.tnom_tipnom and

            nmm023.fpro_numper in (".$periodo.") and 
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
        $monto = str_replace(",", ".", $mon);
        $monto=number_format($monto, 2,"","");
        /*echo $monto;
        exit(0);
	$monto = str_replace(",", "", $mon);*/
/*
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

    
    $periodo=  str_replace(",", "", $periodo);    
    if ($nomina=='OBR'){ $nombre_archivo='APO'.$periodo.$anio; $nombre_archivo_ni='NIO'.$periodo.$anio;}
    else if ($nomina=='CONT'){ $nombre_archivo='APC'.$periodo.$anio; $nombre_archivo_ni='NIC'.$periodo.$anio;}
    else if ($nomina=='EMP'){ $nombre_archivo='APE'.$periodo.$anio; $nombre_archivo_ni='NIE'.$periodo.$anio;}
    else if ($nomina=='ANI'){ $nombre_archivo='APA'.$periodo.$anio; $nombre_archivo_ni='NIA'.$periodo.$anio;}
    else if ($nomina=='EXT'){ $nombre_archivo='APEX'.$periodo.$anio; $nombre_archivo_ni='NIEX'.$periodo.$anio;}
    else if ($nomina=='COMS'){ $nombre_archivo='APCS'.$periodo.$anio; $nombre_archivo_ni='NICS'.$periodo.$anio;}
   
    $archivo = fopen("/home/jhoan/www/Telesur/web/uploads/nomina/".$nombre_archivo.".txt", "w+");
    fwrite($archivo, $cadena);
    fclose($archivo);
    
    

    
    if($nuevo_ingreso==1){
        $archivo = fopen("/home/jhoan/www/Telesur/web/uploads/nomina/".$nombre_archivo_ni.".txt", "w+");
        fwrite($archivo, $cadena_ni);
        fclose($archivo);
    }

   */
?>


