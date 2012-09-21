<?php

	$ora=new ConexionDirecta();
	$db=$ora->oracle();
        
        $query="
            select nactra , cedula, nombr1, nombr2, apell1, apell2 from nmm001 where fecret is null and tnom_tipnom<>'Z999' and tnom_tipnom<>'EXT'
        ";
        
        $rs = oci_parse($db,$query);
	oci_execute($rs);
        
        $txt='';        
        while ( $row = oci_fetch_array($rs, OCI_ASSOC) ){ 

            
            //nacionalidad
            if($row['NACTRA']==1)$nacionalidad='V'; else $nacionalidad='E';
            
            //cedula
            $cedula=trim($row['CEDULA']);
            $ceros='';
            $largo = strlen(trim($row['CEDULA']));
            for($i=$largo;$i<9;$i++){$ceros .='0';}
           
            //nombre
            $nombr1=trim($row['NOMBR1']);
            $largo = strlen(trim($row['NOMBR1']));
            for($i=$largo;$i<=15;$i++){$nombr1 .='&nbsp;';}
            
                        //nombre 2
            $nombr2=trim($row['NOMBR2']);
            $largo = strlen(trim($row['NOMBR2']));
            for($i=$largo;$i<=15;$i++){$nombr2 .='&nbsp;';}
            
                        //apellido 1
            $apell1=trim($row['APELL1']);
            $largo = strlen(trim($row['APELL1']));
            for($i=$largo;$i<=15;$i++){$apell1 .='&nbsp;';}
            
                        //apellido 2
            $apell2=trim($row['APELL2']);
            $largo = strlen(trim($row['APELL2']));
            for($i=$largo;$i<15;$i++){$apell2 .='&nbsp;';}
            
            
            $txt .=trim($nacionalidad).''.$ceros.$cedula.' '.$nombr1.' '.$nombr2.' '.$apell1.' '.$apell2.'                      186 001<br>';
            
            
        }
        
        echo $txt;
        exit(0);
	
	/*
	$query="
	
		select nmm001.cedula, nmm001.fictra, nmm001.nombr1, nmm001.apell1, 
			   nmm001.sueld1, nmm001.fecing, nmm024.tnom_tipnom, nmm024.cto_codcto, 
			   nmm024.moncto, nmm024.functo, nmm024.cancto, nmm024.suecal,
			   nmt027.descto, nmt004.descar, nmt019.desdep
		
		from nmm001, nmm023, nmm024, nmt004, nmt019, nmt027
		
		where
		
		nmm001.fictra like '%17312612%' and
		nmm001.fictra = nmm023.trab_fictra and
		nmm001.fictra = nmm024.trab_fictra and
		
		nmm023.fpro_numper = 22 and
		nmm024.fpro_numper = nmm023.fpro_numper and
		
		nmm023.fpro_anocal = 2011 and
		nmm024.fpro_anocal = nmm023.fpro_anocal and
		
		nmt027.tnom_tipnom = nmm023.tnom_tipnom and
		nmt027.codcto = nmm024.cto_codcto and
		
		nmm024.functo<>3 and
		
		nmm001.cgo_carocu = nmt004.codcar and
		nmm001.dpto_coddep = nmt019.coddep and
		
		nmm023.proc_tippro = 1 and
		nmm023.proc_tippro = nmm024.proc_tippro
		
		
		order by nmm024.cto_codcto
		
	";
	*/
	
	$query="
	select nmm001.nactra, nmm001.cedula, nmm024.moncto  from nm m001, nmm023, nmm024 

		where
		nmm001.fictra = nmm023.trab_fictra and
		nmm001.fictra = nmm024.trab_fictra and
		
		nmm023.proc_tippro = 02 and
		nmm024.proc_tippro=nmm023.proc_tippro and
		
		nmm023.fpro_anocal = 2011 and
		nmm024.fpro_anocal = nmm023.fpro_anocal and
		
		nmm023.tnom_tipnom = 'CONT' and
		nmm024.tnom_tipnom = nmm023.tnom_tipnom and
		 
		nmm023.fpro_numper = 13 and 
		nmm023.fpro_numper = nmm024.fpro_numper
	";
	
	$rs = oci_parse($db,$query);
	oci_execute($rs);
	
	?>
	
	
	<?php 
	$cadena='';
	$cant=0;
		while ( $row = oci_fetch_array($rs, OCI_ASSOC) ){ 
		$ceros='';
		$monto_x='';
			
			$nac= trim($row['NACTRA']);
			$ced= trim($row['CEDULA']);
			$mon= trim($row['MONCTO']);
			
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
						
	?>
		
				<?php $cadena .= "23193".$nac.$cedula."100A".$monto_x."N".$ceros17." ".$ceros17."00\r\n"?>
					
	<?php }
	
	//echo "<div align=left>".$cadena.'<br>'.'23193V002153006100A0000000043467N00000000000000000 0000000000000000000</div>';
	
	?>
	
	
	<?php 


	$archivo = fopen ("contratados.txt", "w+");
	
	fwrite($archivo, $cadena);
	fclose($archivo);

	?>
	


  