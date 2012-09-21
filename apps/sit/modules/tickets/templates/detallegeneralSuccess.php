<script type="text/javascript">

	idtk=document.getElementById('idtk').value
	var seconds = 60; 
	var divid = "contenido"; 
	var url = "/Telesur/web/sit.php/ajax/comentarios?idtk="+idtk; 

	window.onload = function(){
		refreshdiv(); // corremos inmediatamente la funcion
	}
	
</script>


<div class="titulo_modulo">TICKET ASIGNADO A (<?php if(isset($usuario_ticket[0])) echo ucwords($usuario_ticket[0]->getNombre1().' '.$usuario_ticket[0]->getApellido1()); else echo "Ninguno";?>)</div>

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>

    <table class="crud_form" style="width: 500px;" cellpadding="10px">
	<tr>
		<th>Fecha Solicitud:</th>
		<td><?php echo $SitTicket->getFechaSolicitud("d-m-Y")?></td>
	</tr>


	<tr>
		<th>Hora Solicitud:</th>
		<td><?php echo $SitTicket->getHoraSolicitud()?></td>
	</tr>
	
        
	<tr>
		<th>Solicitante:</th>
		<td><?php echo ucwords($solicitante->getNombre1().' '.$solicitante->getApellido1())?></td>
	</tr>	
	
        
        	<tr>
		<th>Extensión:</th>
                <td align="justify"><?php echo $solicitante->getExtension()?></td>
	</tr>
        
	<tr>
		<th>Sub-Categoria:</th>
		<td>
                    
                    <?php
                            if($SitTicket->getIdSubcategoria()!=null){
                                $dessub= SitSubcategoriasPeer::retrieveByPk($SitTicket->getIdSubcategoria());
                                echo $dessub->getDescripcion();
                            }
                               
                    ?>
                
                </td>
	</tr>
	
	<tr>
		<th>Solicitud:</th>
		<td align="justify"><?php echo $SitTicket->getSolicitud()?></td>
	</tr>
        
        <?php if($SitTicket->getArchivos()!=''){
            
            $archivos=  explode(",", $SitTicket->getArchivos());
            if(count($archivos)==2){
                $archivo1=  explode(".", $archivos[0]);
                $archivo2=  explode(".", $archivos[1]);

                if($archivo1[1]=='jpg' || $archivo1[1]=='png' || $archivo1[1]=='png' || $archivo1[1]=='jpeg'){
                    echo "<tr><th>Archivo 1</th><td><img height='70px' src='/Telesur/web/uploads/sit/".$archivo1[0].".".$archivo1[1]."'></td></tr>";
                } else echo "<tr><th>Archivo 1</th><td><a href='/Telesur/web/uploads/sit/".$archivo1[0].".".$archivo1[1]."'><img src='/Telesur/web/images/descarga.png' width='50px'></a></td></tr>";
                
                if($archivo2[1]=='jpg' || $archivo2[1]=='png' || $archivo2[1]=='png' || $archivo2[1]=='jpeg'){
                    echo "<tr><th>Archivo 2</th><td><img height='70px' src='/Telesur/web/uploads/sit/".$archivo2[0].".".$archivo2[1]."'></td></tr>";
                } else echo "<tr><th>Archivo 2</th><td><a href='/Telesur/web/uploads/sit/".$archivo2[0].".".$archivo2[1]."'><img src='/Telesur/web/images/descarga.png' width='50px'></a></td></tr>";

            } else{
                $archivo1=  explode(".", $archivos[0]);
                if($archivo1[1]=='jpg' || $archivo1[1]=='png' || $archivo1[1]=='png' || $archivo1[1]=='jpeg'){
                    echo "<tr><th>Archivo 1</th><td><img height='50px' src='/Telesur/web/uploads/sit/".$archivo1[0].".".$archivo1[1]."'></td></tr>";
                } else echo "<tr><th>Archivo 1</th><td><a href='/Telesur/web/uploads/sit/".$archivo1[0].".".$archivo1[1]."'><img src='/Telesur/web/images/descarga.png' width='50px'></a></td></tr>";
        
                
            }
        }
        ?>        
	
    </table>

<br><br>
<div style="font-weight: bold;">COMENTARIOS</div><br>
<div style="overflow: AUTO;width: 500px; height: 100px;text-align: justify;" id="contenido"></div>

<div class="iconos">
<a href="<?php echo url_for('tickets/general')?>"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>




