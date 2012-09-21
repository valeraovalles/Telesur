<?php

class funciones
{
    
    public function correo($cuerpo,$email,$asunto,$remitente){
	 		  	
        require_once('E-MAIL/htmlMimeMail5/htmlMimeMail5.php');
        $mail = new htmlMimeMail5();
                        
        //Establecemos el remitente
        $mail->setFrom($remitente);
		    
	//Establecemos el asunto
        $mail->setSubject($asunto); 
			   
	//Establecemos el texto del mensaje de correo
        $mail->setHTML($cuerpo);
			    
        $mail->setSMTPParams('correo.telesurtv.net', 25, null, true,'jvalera@telesurtv.net', '#v4l3r4*..');
        $mail->send($email, 'smtp');
                  
    }
    
  public function voltea_fecha($fecha){
    	
  	$valores=explode("-",$fecha);
  	$f=$valores[2].'-'.$valores[1].'-'.$valores[0];
  	return $f;  
  }
    
    public function SitIdUnidad($idu){
              
                //CONSULTO EL DEPARTAMENTO DEL USUARIO ACTUAL
                $a=new Criteria();
                $a->add(SitUsuariosUnidadesPeer::ID_USUARIO,$idu);
                $a->addJoin(SitUnidadesPeer::ID_UNIDAD, SitUsuariosUnidadesPeer::ID_UNIDAD);
                $this->unidad=SitUnidadesPeer::doSelect($a);
                if(isset( $this->unidad[0]))
                return $this->unidad[0]->getIdUnidad();
                
                else return null;
    }
    
    //calcula los dias entre la fecha actual y una fecha proporcionada
    public function dias_fechas($fecha1){

            $timestamp1 = mktime(0,0,0,$fecha1[1],$fecha1[0],$fecha1[2]);
            $timestamp2 = mktime(0,0,0,date("m"),date("d"),date("Y"));
            $segundos_diferencia = $timestamp1 - $timestamp2; 
            return $dias_diferencia = $segundos_diferencia / (60 * 60 * 24); 

    }
    
    public function horas_fechas($fecha1){

            $timestamp1 = mktime(0,0,0,$fecha1[1],$fecha1[0],$fecha1[2]);
            $timestamp2 = mktime(0,0,0,date("m"),date("d"),date("Y"));
            $segundos_diferencia = $timestamp1 - $timestamp2; 
            return $horas_diferencia = $segundos_diferencia / (60 * 60); 

    }

    public function comparar_fechas_mayor_menor($fecha1,$fecha2){
        
        
        $fechaA = strtotime($fecha1);
        $fechaB = strtotime($fecha2);

        if($fechaA > $fechaB){
                return "La fecha no debe ser menor a la actual";
        }
        
        else return false;
    }
    
        
          
          
        var $Void = "";
        var $SP = " ";
        var $Dot = ".";
        var $Zero = "0";
        var $Neg = "Menos";

        function ValorEnLetras($x, $Moneda ) 
        {
            $s="";
            $Ent="";
            $Frc="";
            $Signo="";

            if(floatVal($x) < 0)
            $Signo = $this->Neg . " ";
            else
            $Signo = "";

            if(intval(number_format($x,2,'.','') )!=$x) //<- averiguar si tiene decimales
            $s = number_format($x,2,'.','');
            else
            $s = number_format($x,0,'.','');

            $Pto = strpos($s, $this->Dot);

            if ($Pto === false)
            {
            $Ent = $s;
            $Frc = $this->Void;
            }
            else
            {
            $Ent = substr($s, 0, $Pto );
            $Frc =  substr($s, $Pto+1);
            }

            if($Ent == $this->Zero || $Ent == $this->Void)
            $s = "Cero ";
            elseif( strlen($Ent) > 7)
            {
            $s = $this->SubValLetra(intval( substr($Ent, 0,  strlen($Ent) - 6))) . 
                    "Millones " . $this->SubValLetra(intval(substr($Ent,-6, 6)));
            }
            else
            {
            $s = $this->SubValLetra(intval($Ent));
            }

            if (substr($s,-9, 9) == "Millones " || substr($s,-7, 7) == "Millón ")
            $s = $s . "de ";

            $s = $s . $Moneda;

            if($Frc != $this->Void)
            {
            //$s = $s . " Con " . $this->SubValLetra(intval($Frc)) . "céntimos";
            $s = $s . " CON " . $Frc . "/100 CÉNTIMOS";
            }
            return ($Signo . $s . " ");

        }


        function SubValLetra($numero) 
        {
            $Ptr="";
            $n=0;
            $i=0;
            $x ="";
            $Rtn ="";
            $Tem ="";

            $x = trim("$numero");
            $n = strlen($x);

            $Tem = $this->Void;
            $i = $n;

            while( $i > 0)
            {
            $Tem = $this->Parte(intval(substr($x, $n - $i, 1). 
                                str_repeat($this->Zero, $i - 1 )));
            If( $Tem != "Cero" )
                $Rtn .= $Tem . $this->SP;
            $i = $i - 1;
            }


            //--------------------- GoSub FiltroMil ------------------------------
            $Rtn=str_replace(" Mil Mil", " Un Mil", $Rtn );
            while(1)
            {
            $Ptr = strpos($Rtn, "Mil ");       
            If(!($Ptr===false))
            {
                If(! (strpos($Rtn, "Mil ",$Ptr + 1) === false ))
                    $this->ReplaceStringFrom($Rtn, "Mil ", "", $Ptr);
                Else
                break;
            }
            else break;
            }

            //--------------------- GoSub FiltroCiento ------------------------------
            $Ptr = -1;
            do{
            $Ptr = strpos($Rtn, "Cien ", $Ptr+1);
            if(!($Ptr===false))
            {
                $Tem = substr($Rtn, $Ptr + 5 ,1);
                if( $Tem == "M" || $Tem == $this->Void)
                    ;
                else          
                    $this->ReplaceStringFrom($Rtn, "Cien", "Ciento", $Ptr);
            }
            }while(!($Ptr === false));

            //--------------------- FiltroEspeciales ------------------------------
            $Rtn=str_replace("Diez Un", "Once", $Rtn );
            $Rtn=str_replace("Diez Dos", "Doce", $Rtn );
            $Rtn=str_replace("Diez Tres", "Trece", $Rtn );
            $Rtn=str_replace("Diez Cuatro", "Catorce", $Rtn );
            $Rtn=str_replace("Diez Cinco", "Quince", $Rtn );
            $Rtn=str_replace("Diez Seis", "Dieciseis", $Rtn );
            $Rtn=str_replace("Diez Siete", "Diecisiete", $Rtn );
            $Rtn=str_replace("Diez Ocho", "Dieciocho", $Rtn );
            $Rtn=str_replace("Diez Nueve", "Diecinueve", $Rtn );
            $Rtn=str_replace("Veinte Un", "Veintiun", $Rtn );
            $Rtn=str_replace("Veinte Dos", "Veintidos", $Rtn );
            $Rtn=str_replace("Veinte Tres", "Veintitres", $Rtn );
            $Rtn=str_replace("Veinte Cuatro", "Veinticuatro", $Rtn );
            $Rtn=str_replace("Veinte Cinco", "Veinticinco", $Rtn );
            $Rtn=str_replace("Veinte Seis", "Veintiseís", $Rtn );
            $Rtn=str_replace("Veinte Siete", "Veintisiete", $Rtn );
            $Rtn=str_replace("Veinte Ocho", "Veintiocho", $Rtn );
            $Rtn=str_replace("Veinte Nueve", "Veintinueve", $Rtn );

            //--------------------- FiltroUn ------------------------------
            If(substr($Rtn,0,1) == "M") $Rtn = "Un " . $Rtn;
            //--------------------- Adicionar Y ------------------------------
            for($i=65; $i<=88; $i++)
            {
            If($i != 77)
                $Rtn=str_replace("a " . Chr($i), "* y " . Chr($i), $Rtn);
            }
            $Rtn=str_replace("*", "a" , $Rtn);
            return($Rtn);
        }


        function ReplaceStringFrom(&$x, $OldWrd, $NewWrd, $Ptr)
        {
        $x = substr($x, 0, $Ptr)  . $NewWrd . substr($x, strlen($OldWrd) + $Ptr);
        }


        function Parte($x)
        {
            $Rtn='';
            $t='';
            $i='';
            Do
            {
            switch($x)
            {
                Case 0:  $t = "Cero";break;
                Case 1:  $t = "Un";break;
                Case 2:  $t = "Dos";break;
                Case 3:  $t = "Tres";break;
                Case 4:  $t = "Cuatro";break;
                Case 5:  $t = "Cinco";break;
                Case 6:  $t = "Seis";break;
                Case 7:  $t = "Siete";break;
                Case 8:  $t = "Ocho";break;
                Case 9:  $t = "Nueve";break;
                Case 10: $t = "Diez";break;
                Case 20: $t = "Veinte";break;
                Case 30: $t = "Treinta";break;
                Case 40: $t = "Cuarenta";break;
                Case 50: $t = "Cincuenta";break;
                Case 60: $t = "Sesenta";break;
                Case 70: $t = "Setenta";break;
                Case 80: $t = "Ochenta";break;
                Case 90: $t = "Noventa";break;
                Case 100: $t = "Cien";break;
                Case 200: $t = "Doscientos";break;
                Case 300: $t = "Trescientos";break;
                Case 400: $t = "Cuatrocientos";break;
                Case 500: $t = "Quinientos";break;
                Case 600: $t = "Seiscientos";break;
                Case 700: $t = "Setecientos";break;
                Case 800: $t = "Ochocientos";break;
                Case 900: $t = "Novecientos";break;
                Case 1000: $t = "Mil";break;
                Case 1000000: $t = "Millón";break;
            }

            If($t == $this->Void)
            {
                $i = $i + 1;
                $x = $x / 1000;
                If($x== 0) $i = 0;
            }
            else
                break;

            }while($i != 0);

            $Rtn = $t;
            Switch($i)
            {
            Case 0: $t = $this->Void;break;
            Case 1: $t = " Mil";break;
            Case 2: $t = " Millones";break;
            Case 3: $t = " Billones";break;
            }
            return($Rtn . $t);
        }

        function suma_fechas($fecha,$ndias)
        {
            if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha))
            list($dia,$mes,$año)=split("/", $fecha);
            if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
            list($dia,$mes,$año)=split("-",$fecha);
            $nueva = mktime(0,0,0, $mes,$dia,$año) + $ndias * 24 * 60 * 60;
            $nuevafecha=date("d/m/Y",$nueva);
            return ($nuevafecha);
        }
        
        function mes($num){
            
            if($num==1)
                $mes="enero";
            
            else if($num==2)
                $mes="febrero";
            
            else if($num==3)
                $mes="marzo";
            
            else if($num==4)
                $mes="abril";
            
            else if($num==5)
                $mes="mayo";
            
            else if($num==6)
                $mes="junio";
            
            else if($num==7)
                $mes="julio";
            
            else if($num==8)
                $mes="agosto";
            
            else if($num==9)
                $mes="septiembre";
            
            else if($num==10)
                $mes="octubre";
            
            else if($num==11)
                $mes="noviembre";
            
            else if($num==12)
                $mes="diciembre";
            
            return $mes;
            
        }

}
     
?>