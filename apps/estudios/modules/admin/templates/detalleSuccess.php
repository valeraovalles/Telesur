<div class="titulo_modulo">DETALLE DE SOLICITUDES<br>
<?php if($solicitud->getEstatus()=='r'){echo "<H1 style='color:red;'>RECHAZADA</H1>";}?>
</div>

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>

<form method="post" action="<?php echo url_for('admin/detalle?ids='.$solicitud->getIdSolicitud())?>" name="form">
    <table border="0" width="500px" cellpadding="5px" class="crud_form">
	<tr>
            <th>Fecha:</th>
            <td><?php echo $solicitud->getFechaSolicitud()?></td>
	</tr>
        
        <tr>
            <th>Estudio:</th>
            <td><?php echo $solicitud->getEstudio()?></td>
	</tr>
        
        <tr>
            <th>Producto:</th>
            <td><?php echo $producto->getDescripcion()?></td>
	</tr>
        
        <tr>
            <th>Hora desde:</th>
            <td><?php echo $solicitud->getHoraDesde()?></td>
	</tr>
        
        <tr>
            <th>Hora hasta:</th>
            <td><?php echo $solicitud->getHoraHasta()?></td>
	</tr>
		
		
	<tr>
            <th>Solicitante:</th>
            <td><?php echo ucwords($solicitante->getNombre1().' '.$solicitante->getApellido1())?></td>
	</tr>
		
	<tr>
            <th>Observaciones:</th>
            <td><?php echo $solicitud->getObservaciones()?></td>
	</tr>	
		
	<tr>
            <td colspan="2" style="text-align: center;">
                <?php if($solicitud->getEstatus()!='r'){?>
                
                <?php if($solicitud->getEstatus()!='a'){?>
                <input id="boton" type="button" onclick="enviar_formulario('Aprobar')" value="Aprobar">
                <?php }?>
                
                <input id="boton" type="button" onclick="enviar_formulario('Rechazar')" value="Rechazar">               
                <?php }?>
	</tr>	
  					
    </table>
    <input type="hidden" name="accion" id="accion">
</form>
	
<div class="iconos">
<a href="<?php echo url_for('admin/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>
