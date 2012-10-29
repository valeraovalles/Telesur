<div class="titulo_modulo">REGISTRO</div>

<?php if($sf_user->getFlash('sms')){?>
    <div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>
    
<form name="form" method="post" action="<?php echo url_for('bitacora/registro')?>">
<table class="crud_form select200 input150 textarea200">
    <?php echo $form?>
    <tr>
        <td colspan="2" style="text-align: center;"><input id="boton" type="button" value="Guardar" onclick="enviar_formulario('Guardar')"></td>
    </tr>
</table>
    <input type="hidden" name="accion" id="accion">
</form>


<div class="iconos">
    <a href="<?php echo url_for('bitacora/listado')?>">Volver&nbsp;<?php echo image_tag("volver.jpg")?></a>
</div>