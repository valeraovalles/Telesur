<div class="titulo_modulo">SERVICIO DE CORRESPONDENCIA</div>

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>

<form action="<?php echo url_for("solicitud/formulariocorrespondencia")?>" method="post" name="form">

    <table class="crud_form" cellpadding="5px" style="width: 450px;">

        <tr>
            <th>Fecha de solicitud:</th>
            <td><?php echo date("d-m-Y")?></td>
        </tr>
        
        <tr>
            <th><span style="color:red;">*</span>Extensión/Solicitante:</th>
            <td>
                <?php echo $form['extension']->renderError(); ?>
                <?php echo $form['extension']?>                         
            </td>
        </tr>
        
        <tr>
            <th><span style="color:red;">*</span>Solicitud/Razón:</th>
            <td>
                <?php echo $form['datos_interes_razon']->renderError(); ?>
                <?php echo $form['datos_interes_razon']?>                         
            </td>
        </tr>

        <tr>
            <th><span style="color:red;">*</span>Dirección:</th>
            <td>
                <?php echo $form['direccion_traslado']->renderError(); ?>
                <?php echo $form['direccion_traslado']?>            
            </td>
        </tr>


    </table>

    <div style="color: red;">* Campos requeridos</div>

    <br>

    <input type="button" id="boton" value="Solicitar" onclick="enviar_formulario('Enviar_Formulario')">
    <input type="hidden" id="accion" name="accion" value="">
</form>

<div class="iconos">
<a href="<?php echo url_for('solicitud/index')?>">Volver<?php echo image_tag("volver.jpg")?></a>
</div>