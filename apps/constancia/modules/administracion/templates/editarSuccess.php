<div class="titulo_modulo">EDITAR CONSTANCIA</div>
	
<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>

<form method="post" action="<?php echo url_for('administracion/editar?idc='.$constancia->getIdConstancia())?>" name="form">
    <table border="0" width="500px" cellpadding="5px" class="crud_form">
        <tr>
            <th>Tipo de constancia:</th>
            <td>
                <?php 
                         if($constancia->getTipoConstancia()=='si') echo "Sueldo Integral";
                    else if($constancia->getTipoConstancia()=='sb') echo "Sueldo Básico";
                    else if($constancia->getTipoConstancia()=='sn') echo "Sueldo Normal";
                    else if($constancia->getTipoConstancia()=='sba') echo "Sueldo Básico Anual";
                    else if($constancia->getTipoConstancia()=='sna') echo "Sueldo Normal Anual";
                    else if($constancia->getTipoConstancia()=='sia') echo "Sueldo Integral Anual";
		?>
            </td>
	</tr>
	
	<tr>
            <th>Fecha:</th>
            <td><?php echo date("d-m-Y")?></td>
	</tr>
		
	<tr>
            <th>Cédula:</th>
            <td><?php echo $solicitante->getCedula()?></td>
	</tr>
		
	<tr>
            <th>Nombres:</th>
            <td><?php echo strtoupper($solicitante->getNombre1().' '.$solicitante->getNombre2())?></td>
	</tr>
		
	<tr>
            <th>Apellidos:</th>
            <td><?php echo strtoupper($solicitante->getApellido1().' '.$solicitante->getApellido2())?></td>
	</tr>
		
	<tr>
            <th>Cargo:</th>
            <td><?php echo $cargo->getDescripcion()?></td>
	</tr>		

	<tr>
            <th>Departamento:</th>
            <td><?php echo $dependencia->getDescripcion()?></td>
	</tr>	
		
	<tr>
            <th>Bono Alimentación:</th>
            <td><?php if($constancia->getBonoAlimentacion()==true)echo "Si"; else echo "No";?></td>
	</tr>	
		
	<tr>
            <th><span style="color:red;">*</span>Dirigida:</th>
            <td><input type="text" style="width: 250px;" name="dirigida" value="<?php echo $constancia->getDirigidoA()?>"></td>
	</tr>	
		
        <tr>
            <th>Motivo:</th>
            <td><?php echo $constancia->getMotivo()?></td>
	</tr>	
		
	<tr>
            <td colspan="2" style="text-align: center;">
                <input id="boton" type="button" onclick="enviar_formulario('Actualizar')" value="Actualizar">
                <input id="boton" type="button" value="Limpiar" onclick="limpiar('/Telesur/web/constancia_dev.php/administracion/editar?idc=<?php echo $constancia->getIdConstancia()?>')">&nbsp;&nbsp;&nbsp;
                <a href="<?php echo url_for('administracion/pdfconstancia?idc='.$constancia->getIdConstancia())?>">Generar<?php echo image_tag("pdf.gif",array('size' => '20x20'))?></a>&nbsp;&nbsp;&nbsp;
                Culminar<input type="checkbox" value="c" name="culmina" <?php if($constancia->getEstatus()=='c') echo "checked='checked';"?>></td>
	</tr>	
  					
    </table>
</form>
<input type="hidden" name="accion" id="accion">
<div style="color:red;">* Campos obligatorios</div>
	
<div class="iconos">
<a href="<?php echo url_for('administracion/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>
