<input type="hidden" value="<?php echo $idtk?>" id="idtk">

<script type="text/javascript">

	idtk=document.getElementById('idtk').value
	var seconds = 60; 
	var divid = "contenido"; 
	var url = "/Telesur/web/sit.php/ajax/comentarios?idtk="+idtk; 

	window.onload = function(){
		refreshdiv(); // corremos inmediatamente la funcion
	}
	
</script>


<div class="titulo_modulo">GESTION DE TICKET ASIGNADO A (<?php echo ucwords($nombre_user)?>)</div>

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>

<form method="post" action="<?php echo url_for('tickets_asignados/gestionarticket?id='.$idtk)?>" name="form">

    <table class="crud_form" cellpadding="10px" style="width: 500px;">
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
                                echo "<a href='/Telesur/web/sit.php/tickets/ticketsubcategoria?id=".$SitTicket->getIdTicket()."'>".$dessub->getDescripcion()."</a>";
                            }
                               
                    ?>
                
                </td>
	</tr>
	
	<tr>
		<th>Solicitud:</th>
                <td align="justify" style="text-align: justify;"><?php echo $SitTicket->getSolicitud()?></td>
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
        
        <tr>
            <th>Solución</th>
            <td><textarea name="solucion" style="width:250px;height: 50px"></textarea></td>
	</tr>
	<tr>
            <th>Comentario</th>
            <td><textarea name="comentario" style="width:250px;height: 50px"></textarea></td>
	</tr>
		
	<tr>
            <td style="text-align: center;" colspan="2"><input type="button" id="boton" value="Comentar" onclick="enviar_formulario('Enviar comentario')"><input type="button" id="boton" value="Cerrar" onclick="enviar_formulario('Cerrar ticket')"></td>
	</tr>	
	
    </table>
    
<input type="hidden" name="accion" id="accion" value="">
</form>
    
<br><br>

<div style="font-weight: bold;">COMENTARIOS</div><br>
<div style="overflow: AUTO;width: 500px; height: 100px;text-align: justify;" id="contenido"></div>

<div class="iconos">
<a href="<?php echo url_for('tickets/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>



