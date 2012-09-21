<div class="titulo_modulo">EDITAR UBICACIÓN</div>

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>	

<form method="post" action="<?php echo url_for('ubicaciones/editar?id='.$id)?>" name="form">
    <table class="crud_form select200 input200 textarea200">
        <?php echo $form;?>
    
        <tr>
            <td colspan="2" style="text-align: center;"><input type="button" value="Actualizar" onclick="enviar_formulario('Actualizar')"></td>
        </tr>
        
    </table>
    <input type="hidden" name="accion" id="accion" value="">
</form>

<div class="iconos">
<a href="<?php echo url_for('ubicaciones/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;Volver</a>&nbsp;&nbsp;
</div>