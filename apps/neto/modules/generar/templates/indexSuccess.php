<div class="titulo_modulo">SELECCIONE LOS PARAMETROS PARA GENERAR EL NETO</div>

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>

<form action="<?php echo url_for("generar/index")?>" method="post" name="form">
    <table class="crud_form select150" cellpadding="5px;">

        <?php echo $form;?>

        <tr>
            <td colspan="2" style="text-align: center;">
                <input class="boton" type="button" value="Enviar" onclick="enviar_formulario('Enviar_Formulario')">
                <input class="boton" type="button" value="Limpiar" onclick="limpiar('/Telesur/web/neto.php/generar/index')">
            </td>
        </tr>

    </table>
    <input type="hidden" name="accion" id="accion">
</form>
<div style="color:red;">* Campos obligatorios</div>

<div class="iconos">
    <a href="/Telesur/web/"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>

