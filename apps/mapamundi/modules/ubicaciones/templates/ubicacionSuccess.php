<div class="titulo_modulo">UBICACIONES</div>

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>

<form method="post" action="<?php echo url_for('ubicaciones/ubicacion')?>" name="form">
<table class="crud_form select200 textarea200 input200">
    <?php echo $form;?>
    
    <tr>
        <td colspan="2" style="text-align: center;"><input id="boton" type="button" value="Guardar" onclick="enviar_formulario('Guardar')"></td>
    </tr>
</table>
    <input type="hidden" name="accion" id="accion" value="">
</form>
        
<div class="iconos">
<a href="<?php echo url_for('ubicaciones/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;Volver</a>&nbsp;&nbsp;
</div>