<?php


/////////////////////////////////////////////////////
           //INICIO QUERY SIGEFIRRHH
/////////////////////////////////////////////////////
    /*$conexion=new ConexionDirecta();
    $postgresql_sigefirrhh=$conexion->postgresql_sigefirrhh();
    
    $fc=new funciones;
    
    $query="
        select 
        c.cod_concepto, hq.monto_asigna, hq.anio, gn.nombre as tipo_nomina
       
        from 
        historicoquincena hq, concepto c, conceptoTipoPersonal ctp, trabajador t, gruponomina gn, conceptofijo cf
       
        where 
        t.cedula='".$cedula."' and
        t.estatus='A' and
        t.id_trabajador=hq.id_trabajador and

        hq.id_concepto<>0 and
	cf.id_trabajador=t.id_trabajador and	
        cf.id_concepto_tipo_personal=ctp.id_concepto_tipo_personal and 
        c.id_concepto=ctp.id_concepto and
        ctp.id_concepto_tipo_personal = hq.id_concepto_tipo_personal and

        hq.id_grupo_nomina=gn.id_grupo_nomina and


        hq.anio=(select max(anio) from historicoquincena) and
        hq.mes=(select max(mes-1) from historicoquincena where anio = (select max(anio) from historicoquincena)) and
        hq.semana_quincena=(select max(semana_quincena) from historicoquincena where anio=(select max(anio) from historicoquincena) and mes = (select max(mes) from historicoquincena where anio = (select max(anio) from historicoquincena)))


    ";   
    
    $rs = pg_query($postgresql_sigefirrhh, $query);
    
    $suma_conceptos=0;
    while ($row = pg_fetch_array($rs)){
        
        $tipo_nomina = $row['tipo_nomina'];
        
        if($row['cod_concepto']==0001) $sueldo = $row['monto_asigna']*2;
        
        else{
            
            $suma_conceptos += $row['monto_asigna']*2;            
            
        }
        
    }//number_format($cesta, 2, ",", ".");

   $s_basico=$sueldo;
   $s_normal=$sueldo+$suma_conceptos;
   $s_integral=($s_normal/30)*41.25;   
   $s_anual_integral= $s_integral * 12;
   $s_anual_basico=$s_basico * 12;
   $s_anual_normal=$s_normal * 12;
   
   

   
   if($tipo_nomina=='CONTRATADOS'){
                            
      //$sicont=" bajo la figura de contratado(a)";
      $sicont="";
   } else $sicont="";*/
   
/////////////////////////////////////////////////////
           //FIN QUERY SIGEFIRRHH
/////////////////////////////////////////////////////   




/////////////////////////////////////////////////////
           //INICIO QUERY INFOCENT
/////////////////////////////////////////////////////
$fc=new funciones();
$ora=new ConexionDirecta();
$db=$ora->oracle();

$query=" select fictra from nmm001 where cedula like '%".$cedula."%'";
$rs = oci_parse($db,$query);
oci_execute($rs);
$row = oci_fetch_array($rs, OCI_ASSOC); 
$fictra_usuario= $row['FICTRA'];

$concepto=0;

if($db){
    
   //verificar si tiene conceptos fijos
   $existe=0;
   
   $query="
       select * from nmm002 where trab_fictra like '%".$fictra_usuario."%' and nmm002.cto_codcto < 1000 
   " ;   
    
   $rs = oci_parse($db,$query);
   oci_execute($rs);
   while ( $row = oci_fetch_array($rs, OCI_ASSOC) ){
       
       if($row['CTO_CODCTO']!=''){
        $existe=1;
        break;
       }
   }

   if($existe==1){
   
        $query="

        select  nmm024.cto_codcto, (nmm024.moncto*2) as mmconcepto, (nmm001.sueld1*30) as sueldo, nmm001.tnom_tipnom

        from  nmm001,  nmm024, nmm002

        where

            nmm001.fictra like '%".$fictra_usuario."%' and

            nmm024.trab_fictra  = nmm001.fictra and
            nmm024.fpro_anocal  = (select max(nmm024.fpro_anocal) from nmm024) and
            nmm024.mescal  = (select max(nmm024.mescal) from nmm024 where fpro_anocal = (select max(nmm024.fpro_anocal) from nmm024)) and
            nmm024.fpro_numper  = ( select max(nmm024.fpro_numper) from nmm024 where fpro_anocal = (select max(nmm024.fpro_anocal) from nmm024)) and
            nmm024.proc_tippro  = 1 and
            nmm024.cto_codcto < 1000 and  nmm024.cto_codcto <> 20 and
            nmm002.trab_fictra = nmm024.trab_fictra and
            nmm002.cto_codcto = nmm024.cto_codcto 

        ";
   } else if($existe==0){
        $query="

        select  nmm024.cto_codcto, (0) as mmconcepto, (nmm001.sueld1*30) as sueldo, nmm001.tnom_tipnom

        from  nmm001, nmm024

        where

            nmm001.fictra like '%".$fictra_usuario."%' and

            nmm024.trab_fictra  = nmm001.fictra and
            nmm024.fpro_anocal  = (select max(nmm024.fpro_anocal) from nmm024) and
            nmm024.mescal  = (select max(nmm024.mescal) from nmm024 where fpro_anocal = (select max(nmm024.fpro_anocal) from nmm024)) and
            nmm024.fpro_numper  = ( select max(nmm024.fpro_numper) from nmm024 where fpro_anocal = (select max(nmm024.fpro_anocal) from nmm024)) and
            nmm024.cto_codcto < 1000 and
            nmm024.proc_tippro  = 1


        ";
   }
    
   $rs = oci_parse($db,$query);
   
   if ( oci_execute($rs) ){
                $suma_conceptos=0;
   		while ( $row = oci_fetch_array($rs, OCI_ASSOC) ){
                            
                    
                          //dueldo diario
                          $sueld=$row['SUELDO'];
			  $sueldo=str_replace(",", ".", $sueld);
                          $suma_conceptos += $row['MMCONCEPTO'];
                          $tnom_tipnom = $row['TNOM_TIPNOM'];
                          
                       
              
                }   

                
                        $s_basico=$sueldo;
                        $s_normal=$sueldo+$suma_conceptos;
                        $s_integral=($s_normal/30)*41.25;   
        		$s_anual_integral= $s_integral * 12;
			$s_anual_basico=$s_basico*12;
			$s_anual_normal=$s_normal * 12;
                        
                        if($tipo_nomina=='CONT'){
                            
                                $sicont=" bajo la figura de contratado(a)";
                        } else $sicont="";

   }	
            

   $select="
     select  nmm024.moncto
        from nmm024
        where
            nmm024.trab_fictra like '%".$fictra_usuario."%' and
            nmm024.fpro_anocal  = (select max(nmm024.fpro_anocal) from nmm024) and
            nmm024.cto_codcto = 570 and 
            nmm024.proc_tippro  = 53
            GROUP BY nmm024.cto_codcto, nmm024.moncto
    ";
   $rs = oci_parse($db,$select);
   
   if ( oci_execute($rs) ){
   	
   		$cont=0;
   		while ( $row = oci_fetch_array($rs, OCI_ASSOC) ){
   			
   			if($cont==1) break;
   			$cesta=$row['MONCTO'];   			
   			
   			$cont++;
   		}
   }
   
   $cesta = number_format($cesta, 2, ",", ".");   
}

/////////////////////////////////////////////////////
           //FIN QUERY INFOCENT
/////////////////////////////////////////////////////

 
    if($constancia[0]->getTipoConstancia()=='sb'){
            $sueldo=number_format($s_basico, 2, ",", ".");	
            $tipo_salario="Salario Básico Mensual";
    }

    else if($constancia[0]->getTipoConstancia()=='sn'){
            $sueldo=number_format($s_normal, 2, ",", ".");
            $tipo_salario="Salario Normal Mensual";	
    }

    else if($constancia[0]->getTipoConstancia()=='si'){
            $sueldo=number_format($s_integral, 2, ",", ".");
            $tipo_salario="Salario Integral Mensual";	
    }

    else if($constancia[0]->getTipoConstancia()=='sia'){
            $sueldo=number_format($s_anual_integral, 2, ",", ".");
            $tipo_salario="Salario Integral Anual";	
    }

    else if($constancia[0]->getTipoConstancia()=='sba'){
            $sueldo=number_format($s_anual_basico, 2, ",", ".");
            $tipo_salario="Salario Básico Anual";	
    }

    else if($constancia[0]->getTipoConstancia()=='sna'){
            $sueldo=number_format($s_anual_normal, 2, ",", ".");
            $tipo_salario="Salario Normal Anual";	
    }

    $sueldox=str_replace(".","",$sueldo);
    $sueldox=str_replace(",", ".",$sueldox);



    $img_telesur = image_tag("telesur.jpeg",array('size' => '150x130'));

    $monto_cesta_ticket=1350;
    
    if($constancia[0]->getBonoALimentacion()==1)
    $nota="<br><br><div align='justify' class='letra'><span class='agregado'>Nota:</span> ".ucwords($ciudada)." recibe adicional un monto de Bs. ".$monto_cesta_ticket." por concepto de Beneficio de Alimentación.</div>";
    else $nota="";

   
    $html="
            <div align=left>
                    <div class='agregado' style='margin-left:-20px'>".$img_telesur."</div>
                    <div class='agregado'>RIF. G-20004500-0</div>
                    <div class='agregado'>DRH-2012</div>

                    <br><br>

                    <div class='letra'>Señores:</div>
                    <div><span class='agregado letra'>".strtoupper($constancia[0]->getDirigidoA())."</span></div>
                    <div class='letra'>Presente.-</div>

                    <br><br>

                    <div align='justify' class='interlineado'>

                            Quien suscribe, Director(a) de Recursos Humanos de La Nueva Televisión del Sur, C.A., por medio de la presente hace constar que ".$ciudada." <span class='agregado'>".strtoupper(($nombre))."</span>, titular de la cédula de identidad N° <span class='agregado'>".number_format($perfil[0]->getCedula(),0, ",", ".")."</span> labora en esta empresa desde el <span class='agregado'>".$perfil[0]->getFechaIngreso("d/m/Y")."</span>".$sicont.", desempeñando el cargo de <span class='agregado'>".strtoupper($cargo[0]->getDescripcion())."</span>, devengando un <span class='agregado'>".$tipo_salario."</span> de <span class='agregado'>".str_replace("é","É",strtoupper($fc->ValorEnLetras($sueldox,"BOLÍVARES")))."</span>(Bs. ".$sueldo.").

                    </div>

                    <br><br>

                    <div align='justify'>Constancia que se expide en Caracas, a los ".strtolower($fc->ValorEnLetras(date('d'),""))." (".date('d').") día(s) del mes de ".$fc->mes($mes = date("n"))." del año ".strtolower($fc->ValorEnLetras(date('Y'),""))." (".date('Y').").</div>

                    <br><br><br>

                    <div class='letra'>Atentamente,</div>

                    <br>

                    <div><span class='agregado' style='font-size:14px;'>Elaine Gonzalez</span><br>Directora General de Recursos Humanos<br><br>EG/ay</div>


                    ".$nota."

                    <br><br>
                    <div style='font-size:10px;' align='center'>Calle Vargas con calle Santa Clara, edificio Telesur, Boleita Norte, Caracas-Venezuela - Teléfono : 0212-6000202 -Ext . 303/306</div>
            </div>
    ";

//==============================================================
//==============================================================
//==============================================================

include("MPDF/mpdf.php");

$mpdf=new mPDF('c'); 

$mpdf->SetDisplayMode('fullpage');

// LOAD a stylesheet
$stylesheet = file_get_contents('css/pdf_constancia.css');
$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html);

$tipo_salario=  str_replace(" ", "-", $tipo_salario);
$mpdf->Output("CT-".$nb."-".$tipo_salario.".pdf","D");

//==============================================================
//==============================================================
//==============================================================


?>