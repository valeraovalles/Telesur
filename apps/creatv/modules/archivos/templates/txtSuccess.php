<div class="titulo_modulo">GENERAR PLAYLIST</div>
<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>
<form action="<?php echo url_for('archivos/txt')?>" method="post" name="form">
    <table id="crud_form" cellpadding='10px'>
        <tr>
            <th>FECHA</th>
            <td><input type="text" class="tcal" name="fecha" value=""></td>
        </tr>
        
        <tr>
            <td colspan="2" style="text-align: center;"><input type="button" value="Generar" onclick="enviar_formulario('Generar PLaylist')"></td>
                
        </tr>
    </table>    
    <input type="hidden" name="accion" id="accion">
    <input type="hidden" name="enviomanual" value="exito">
</form>

<?php

    $f=new funciones;

    if($fecha_escaleta!=''){
       
        $link = mssql_connect('192.168.70.7', 'sa', '') or die("Could not connect !");
        $selected = mssql_select_db("creatv_data", $link);
        
	# Cambie estos datos por los de su Servidor FTP
	/*define("SERVER","10.10.2.243"); //IP o Nombre del Servidor
	define("PORT",21); //Puerto
	define("USER","jhoan"); //Nombre de Usuario
	define("PASSWORD","123456"); //Contraseña de acceso*/
        
        # Cambie estos datos por los de su Servidor FTP
	define("SERVER","192.168.100.30"); //IP o Nombre del Servidor
      	define("PORT",21); //Puerto
	define("USER","creatv"); //Nombre de Usuario
	define("PASSWORD","..*creatv*.."); //Contraseña de acceso

	# FUNCIONES
	function ConectarFTP(){
		//Permite conectarse al Servidor FTP
		$id_ftp=ftp_connect(SERVER,PORT); //Obtiene un manejador del Servidor FTP
		ftp_login($id_ftp,USER,PASSWORD); //Se loguea al Servidor FTP
		return $id_ftp; //Devuelve el manejador a la función
	}

	function SubirArchivo($archivo_local,$archivo_remoto){
		//Sube archivo de la maquina Cliente al Servidor (Comando PUT)
		$id_ftp=ConectarFTP(); //Obtiene un manejador y se conecta al Servidor FTP
		ftp_put($id_ftp,$archivo_remoto,$archivo_local,FTP_BINARY);
		//Sube un archivo al Servidor FTP en modo Binario
		ftp_quit($id_ftp); //Cierra la conexion FTP
	}

        function transmitidootrafecha($clipname,$fecha_escaleta){
            $f=new funciones;
            $repetido='';
            $query="SELECT count(*) as total FROM [creatv_data].[dbo].[Escaleta] es,[creatv_data].[dbo].[Evento] ev
            where es.IdEscaleta=ev.IdEscaleta and EV.ClipName LIKE '%".$clipname."%' and es.IdCanal='10' and es.Data_Emissio<'".$f->voltea_fecha($fecha_escaleta)."'";
            $result = mssql_query($query);
            while($row = mssql_fetch_array($result)){$repetido=$row['total'];}
            return $repetido;
        }
        
        function transmitidomismafecha($clipname,$fecha_escaleta){
            $f=new funciones;
            $repetido='';
            $query="SELECT count(*) as total FROM [creatv_data].[dbo].[Escaleta] es,[creatv_data].[dbo].[Evento] ev
            where es.IdEscaleta=ev.IdEscaleta and EV.ClipName LIKE '%".$clipname."%' and es.IdCanal='10' and es.Data_Emissio='".$f->voltea_fecha($fecha_escaleta)."'";
            $result = mssql_query($query);
            while($row = mssql_fetch_array($result)){$repetido=$row['total'];}
            return $repetido;
        }
        
        function eliminar_acentos($str){
	$a = array('À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','�»','ü','ý','ÿ','Ā','ā','Ă','ă','Ą','ą','Ć','ć','Ĉ','ĉ','Ċ','ċ','Č','č','Ď','ď','Đ','đ','Ē','ē','Ĕ','ĕ','Ė','ė','Ę','ę','Ě','ě','Ĝ','ĝ','Ğ','ğ','Ġ','ġ','Ģ','ģ','Ĥ','ĥ','Ħ','ħ','Ĩ','ĩ','Ī','ī','Ĭ','ĭ','Į','į','İ','ı','Ĳ','ĳ','Ĵ','ĵ','Ķ','ķ','Ĺ','ĺ','�»','ļ','Ľ','ľ','Ŀ','ŀ','Ł','ł','Ń','ń','Ņ','ņ','Ň','ň','ŉ','Ō','ō','Ŏ','ŏ','Ő','ő','Œ','œ','Ŕ','ŕ','Ŗ','ŗ','Ř','ř','Ś','ś','Ŝ','ŝ','Ş','ş','Š','š','Ţ','ţ','Ť','ť','Ŧ','ŧ','Ũ','ũ','Ū','ū','Ŭ','ŭ','Ů','ů','Ű','ű','Ų','ų','Ŵ','ŵ','Ŷ','ŷ','Ÿ','Ź','ź','�»','ż','Ž','ž','ſ','ƒ','Ơ','ơ','Ư','ư','Ǻ','�»','Ǽ','ǽ','Ǿ','ǿ');
	$b = array('A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L','l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','A','a','AE','ae','O','o');
	return str_replace($a, $b, $str);
        }
        
        $query="
        select 
                EV.VideoSource, EV.ClipName, EV.SegName, EV.StartTime, C.Titol_Emissio AS titulo_contenido, p.Titol_Emissio as titulo_produccion, ev.DurPrev  
        from 
                [creatv_data].[dbo].[Escaleta] e, [creatv_data].[dbo].[Evento] ev, [creatv_data].[dbo].[Contenido] c, [creatv_data].[dbo].[Produccion] p
        where 
                ev.IdEscaleta=e.IdEscaleta and 
                p.IdProduccio = ev.IdProduccio and 
                c.IdPrograma = p.IdPrograma and
                EV.Observacio = 'N' and
                EV.Separador = 'N' and
                e.Data_Emissio='".$f->voltea_fecha($fecha_escaleta)."' and 
                IdCanal=10

        order by EV.OrderNum ASC
        ";

        $result = mssql_query($query);

        $txt='';$segmento='';$programa='';
        while($row = mssql_fetch_array($result)){
            $transmitido_otrafecha=2;
            
            //verifico las transmisiones de los programas en vivo
            if($row["VideoSource"]!='A'){
                
                $transmitido_otrafecha=transmitidootrafecha($row["ClipName"],$fecha_escaleta);
               
                //if ($row["ClipName"]=='INPRIEM021701'){echo $transmitido_otrafecha;exit(0);}
                //$transmitido_otrafecha=0;
                //si no se ha transmitido en otra fecha
                if ($transmitido_otrafecha==0){
                    
                    $transmitido_mismafecha=transmitidomismafecha($row["ClipName"],$fecha_escaleta);
                //if ($row["ClipName"]=='INPRIEM021701'){echo $transmitido_mismafecha;exit(0);}
                    //si no se transmite una sola vez al dia
                    if($transmitido_mismafecha>1){                        
                        $programa[$row["ClipName"]]=$programa[$row["ClipName"]]+1;
                       
                    } else $programa[$row["ClipName"]]=1;
                } 
                
            }//fin verifico las transmisiones de los programas en vivo

                if($row["SegName"]!='1/1')$segmento=$row["SegName"]." "; else $segmento='';

                if(($row["VideoSource"]!='A' && $transmitido_otrafecha==0 && $programa[$row["ClipName"]]==1))
                $txt .=str_replace(".00","",$row["StartTime"])."\t".$row["ClipName"]."\t\t".$segmento.$row["titulo_contenido"]." - ".$row["titulo_produccion"]."\t".str_replace(".00","",$row["DurPrev"])."\t".$row["VideoSource"]."\r\n";
                else 
                $txt .=str_replace(".00","",$row["StartTime"])."\t".$row["ClipName"]."\t\t".$segmento.$row["titulo_contenido"]." - ".$row["titulo_produccion"]."\t".str_replace(".00","",$row["DurPrev"])."\r\n";
        }
      
                $txt=eliminar_acentos(utf8_encode($txt));
                
                $archivo = fopen ("/var/www/Telesur/web/uploads/creatv/txt/".$fecha_escaleta.".txt", "w+");
                //$archivo = fopen ("/home/jhoan/www/Telesur/web/uploads/creatv/txt/".$fecha_escaleta.".txt", "w+");

                fwrite($archivo, $txt);
                fclose($archivo);

                SubirArchivo("/var/www/Telesur/web/uploads/creatv/txt/".$fecha_escaleta.".txt",$fecha_escaleta.".txt");
                //SubirArchivo("/home/jhoan/www/Telesur/web/uploads/creatv/txt/".$fecha_escaleta.".txt",$fecha_escaleta.".txt");
                
                
                //verificar si el archivo fue subido
                $archivo = fopen ("ftp://creatv:..*creatv*..@192.168.100.30/".$fecha_escaleta.".txt", "r");
                //$archivo = fopen ("ftp://jhoan:123456@10.10.2.243/".$fecha_escaleta.".txt", "r");
                if (!$archivo) {
                    echo "<p><DIV class='sms'>EL ARCHIVO NO SE HA SUBIDO POR FAVOR INTENTE DE NUEVO O DESCARGUE EL ARCHIVO DESDE <a TARGET='_blank' href='/Telesur/web/uploads/creatv/txt/".$fecha_escaleta.".txt'>AQUI</a></div>.\n";
                }
                else
                echo "<p><div class='sms' style='color:green;'>ARCHIVO ENVIADO A LA CARPETA COMPARTIDA, PUEDE VISUALIZAR EL ARCHIVO <a TARGET='_blank' href='/Telesur/web/uploads/creatv/txt/".$fecha_escaleta.".txt'>AQUI</a></div>\n";

   }

?>