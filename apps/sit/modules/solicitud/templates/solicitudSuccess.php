<div class="titulo_modulo">REALIZAR SOLICITUD</div>

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>

<div style="color:red;background-color:#E7EEF6;">EL SIT TE PERMITE SUBIR AL MENOS DOS ARCHIVOS DE 2MB COMO MÁXIMO</div>
<BR>
<!--<div class="sms">No crear Tickets mixtos, por favor enviar un ticket por cada tipo solicitud.</div>-->

<form method="post" action="<?php echo url_for('solicitud/solicitud')?>" name="form"  enctype="multipart/form-data">
    <table class="crud_form select200 input200 textarea200" width="450px" cellpadding="5px;">

        <tr>
            <th><span style="color:red;">*</span>Departamento:</th>
            <td>
                <?php echo $form['idunidad']->renderError(); ?>
                <?php echo $form['idunidad'];?>
            </td>
        </tr>	

        
        <tr>
            <th><span style="color:red;">*</span>Extension:</th>
            <td>
                <?php echo $form['extension']->renderError(); ?>
                <?php echo $form['extension'];?>
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
            <th>Archivo1:</th>
            <td>
                <?php echo $form['archivo1']->renderError(); ?>
                <?php echo $form['archivo1'];?>
            </td>
        </tr>	
        
        <tr>
            <th>Archivo2:</th>
            <td>
                <?php echo $form['archivo2']->renderError(); ?>
                <?php echo $form['archivo2'];?>
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
<a href="<?php echo url_for('solicitud/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>

<script language="javascript">
$( document ).ready( function() {

        //genera ventanita de noficacion
        $('#sol').gips({ 'theme': 'yellow', autoHide: false, placement: 'right', text: 'Ejemplo: Solicito reinicio de mi clave para la intranet... Evitar saludos y agradecimientos en la solicitud.',control: 'focus'});
});
</script>
