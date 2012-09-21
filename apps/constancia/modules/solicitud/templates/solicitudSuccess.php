<div class="titulo_modulo">SOLICITUD DE CONSTANCIA DE TRABAJO</div>

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>	
	
<form method="post" action="<?php echo url_for('solicitud/solicitud')?>" name="form">
	<table border="0" width="500px" cellpadding="5px" class="crud_form select200 input200 textarea200">
		<tr>
			<th><span style="color:red;">*</span>Tipo de constancia:</th>
			<td><?php echo $form['tipo']->renderError(); ?><?php echo $form['tipo']?></td>
		</tr>
		
		<tr>
			<th>Fecha:</th>
			<td><?php echo date("d-m-Y")?></td>
		</tr>
		
		<tr>
			<th>Cédula:</th>
			<td><?php echo $sf_user->getGuardUser()->getProfile()->getCedula()?></td>
		</tr>
		
		<tr>
			<th>Nombres:</th>
			<td><?php echo strtoupper($sf_user->getGuardUser()->getProfile()->getNombre1().' '.$sf_user->getGuardUser()->getProfile()->getNombre2())?></td>
		</tr>
		
		<tr>
			<th>Apellidos:</th>
			<td><?php echo strtoupper($sf_user->getGuardUser()->getProfile()->getApellido1().' '.$sf_user->getGuardUser()->getProfile()->getApellido2())?></td>
		</tr>
		
		<tr>
			<th>Cargo:</th>
			<td><?php echo $cargo->getDescripcion()?></td>
		</tr>		

		<tr>
			<th>Dependencia:</th>
			<td><?php echo $dependencia->getDescripcion()?></td>
		</tr>	
		
		<tr>
			<th>Bono Alimentación:</th>
			<td><?php echo $form['bono']?></td>
		</tr>	
		
		<tr>
			<th><span style="color:red;">*</span>Dirigida:</th>
			<td><?php echo $form['tipo']->renderError(); ?><?php echo $form['dirigida']?></td>
		</tr>	
		
		<tr>
			<th>Motivo:</th>
			<td><?php echo $form['motivo']?></td>
		</tr>	
		
		<tr>
                    <td colspan="2" style="text-align: center;">
                        <input id="boton" type="button" value="Enviar" onclick="enviar_formulario('Enviar_Formulario')">
                        <input id="boton" type="button" value="Limpiar" onclick="limpiar('/Telesur/web/constancia.php/solicitud/solicitud')">
                    </td>
		</tr>	
  					
	</table>
	</form>
        <input type="hidden" name="accion" id="accion">
	<div style="color:red;">* Campos obligatorios</div>


<div class="iconos">
<a href="<?php echo url_for("solicitud/index")?>">Volver&nbsp;<?php echo image_tag("volver.jpg")?></a>
</div>