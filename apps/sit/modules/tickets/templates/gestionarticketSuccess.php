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


<div class="titulo_modulo">GESTION DE TICKET ASIGNADO A (<?php if(isset($usuario_ticket[0])) echo ucwords($usuario_ticket[0]->getNombre1().' '.$usuario_ticket[0]->getApellido1()); else echo "Ninguno";?>)</div>

<div style="color:red;background-color:#E7EEF6;">LOS TICKETS PUEDEN CONTENER ARCHIVOS ADJUNTOS COMO IMÁGENES O ARCHIVOS DESCARGABLES DE 2MB MÁXIMO</div>
<BR>
	

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>

<form method="post" action="<?php echo url_for('tickets/gestionarticket?id='.$idtk)?>" name="form">

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
                                echo "<a href='/Telesur/web/sit.php/tickets/ticketsubcategoria?id=".$SitTicket->getIdTicket()."'>".$dessub->getDescripcion()."</a>";
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
                    echo "<tr><th>Archivo 1</th><td>
                    <a class='thumbnail' href='#thumb'>     
                    <img height='70px' src='/Telesur/web/uploads/sit/".$archivo1[0].".".$archivo1[1]."'>
                    <span><img height='400px' src='/Telesur/web/uploads/sit/".$archivo1[0].".".$archivo1[1]."'></span>
                    </a>    
                    </td></tr>";
                } else echo "<tr><th>Archivo 1</th><td><a href='/Telesur/web/uploads/sit/".$archivo1[0].".".$archivo1[1]."'><img src='/Telesur/web/images/descarga.png' width='50px'></a></td></tr>";
                
                if($archivo2[1]=='jpg' || $archivo2[1]=='png' || $archivo2[1]=='png' || $archivo2[1]=='jpeg'){
                    echo "<tr><th>Archivo 2</th><td>
                    <a class='thumbnail' href='#thumb'>    
                    <img height='70px' src='/Telesur/web/uploads/sit/".$archivo2[0].".".$archivo2[1]."'>
                    <span><img height='400px' src='/Telesur/web/uploads/sit/".$archivo2[0].".".$archivo2[1]."'></span>
                    </a>    
                    </td></tr>";
                } else echo "<tr><th>Archivo 2</th><td><a href='/Telesur/web/uploads/sit/".$archivo2[0].".".$archivo2[1]."'><img src='/Telesur/web/images/descarga.png' width='50px'></a></td></tr>";

            } else{
                $archivo1=  explode(".", $archivos[0]);
                if($archivo1[1]=='jpg' || $archivo1[1]=='png' || $archivo1[1]=='png' || $archivo1[1]=='jpeg'){
                    echo "
                        

                <tr><th>Archivo 1</th><td>
                <a class='thumbnail' href='#thumb'>
                <img height='50px' src='/Telesur/web/uploads/sit/".$archivo1[0].".".$archivo1[1]."'>
                <span><img height='400px' src='/Telesur/web/uploads/sit/".$archivo1[0].".".$archivo1[1]."'></span>
                </a>    
                </td></tr>";
                } else echo "<tr><th>Archivo 1</th><td><a href='/Telesur/web/uploads/sit/".$archivo1[0].".".$archivo1[1]."'><img src='/Telesur/web/images/descarga.png' width='50px'></a></td></tr>";
        
                
            }
            
        }
        ?>        
        
        <?php if($SitTicket->getEstatus()=='c'){?>
        <tr>
		<th>Solución:</th>
		<td align="justify"><?php echo $SitTicket->getSolucion()?></td>
	</tr>
        <?php }?>
        
	
	<?php if($SitTicket->getEstatus()!='c'){?>
		<tr>
			<th>Comentario</th>
			<td><textarea name="comentario" style="width:250px;height: 50px"></textarea></td>
		</tr>
		
		<tr>
                    <td style="text-align: center;" colspan="2"><input type="button" id="boton" value="Comentar" onclick="enviar_formulario('Enviar comentario')"></td>
		</tr>	
	<?php }?>
       
      
	
    </table>


    <?php if($SitTicket->getEstatus()!='c'){?>
        <br><br>
        <fieldset style="width: 500px;">
            <legend>GESTIONAR TICKET</legend>

                <table class="crud_form select200"  cellpadding="10px">

                    <tr>
                        <th>Tipo de acción</th>
                        <td>
                            <select name="tipo" id="tipo" onchange="ajax('<?php echo url_for('ajax/accion')?>','abc',document.getElementById('tipo').value,'ajax/accion')">
                                <option value="0">Seleccione una opción</option>
                                <option value="1">Asignar ticket</option>
                                <option value="2">Reasignar a otra unidad</option>
                            </select>
                        </td>
                    </tr>
               </table>

               <div id="abc"></div>
        </fieldset>
    <?php }?>
    
<input type="hidden" name="accion" id="accion" value="">
</form>
    
<br><br>

<div style="font-weight: bold;">COMENTARIOS</div><br>
<div style="overflow: AUTO;width: 500px; height: 100px;text-align: justify;" id="contenido"></div>

<div class="iconos">
<a href="<?php echo url_for('tickets/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>

