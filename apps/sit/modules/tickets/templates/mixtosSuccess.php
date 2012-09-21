<div class="titulo_modulo">REALIZAR SOLICITUD MIXTOS</div>

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>

<form method="post" action="<?php echo url_for('tickets/mixtos')?>" name="form">
    <table class="crud_form select200 input200 textarea200" width="400px" cellpadding="5px;">

        <tr>
            <th><span style="color:red;">*</span>Solicitante:</th>
            <td>
                <?php echo $form['id_solicitante']->renderError(); ?>
                <?php echo $form['id_solicitante'];?>
            </td>
        </tr>	
        
        <tr>
            <th><span style="color:red;">*</span>Departamento:</th>
            <td>
                <?php echo $form['idunidad']->renderError(); ?>
                <?php echo $form['idunidad'];?>
            </td>
        </tr>	

        <tr>
            <th><span style="color:red;">*</span>Solicitud:</th>
            <td>
                <?php echo $form['solicitud']->renderError(); ?>
                <?php echo $form['solicitud'];?>
            </td>
        </tr>	

	<tr>
            <td colspan="2" style="text-align: center;"><input id="boton" type="button" value="Enviar" onclick="enviar_formulario('Enviar solicitud')"></td>
	</tr>
</table>


<input type="hidden" value="" name="accion" id="accion">

</form>

<div style="color: red;">* Campos requeridos</div>


<div class="iconos">
<a href="<?php echo url_for('tickets/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>

