<div class="titulo_modulo">PARAMETROS PARA EL INFORME DE GESTION</div>

<?php if($sf_user->getFlash('sms')){?>
    <div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>

<form action="<?php echo url_for("reportes/index")?>" method="post" name="form">
<table class="crud_form select200 input200" cellpadding="5px" cellspacing="1px">
    <tr>
        <th>Unidad:</th>
        <td><?php echo $form['id_unidad']->renderError();?><?php echo $form['id_unidad']?></td>
    </tr>
    
    <tr>
        <th>Personal:</th>
        <td><?php echo $form['id_usuario']?><br><?php echo $form['id_usuario']->renderError();?></td>
    </tr>
    
    <tr>
        <th>Fecha Desde:</th>
        <td><?php echo $form['desde']->renderError();?><?php echo $form['desde']?></td>
    </tr>
    
    <tr>
        <th>Fecha Hasta:</th>
        <td><?php echo $form['hasta']->renderError();?><?php echo $form['hasta']?></td>
    </tr>
    
    <tr>
        <th>Tipo Archivo:</th>
        <td>PDF<input type="radio" name="ta" value="p">&nbsp;&nbsp;RTF<input type="radio" name="ta" value="r" checked="checked"></td>
    </tr>
    
    <tr>
        <td colspan="2" style="text-align: center;"><input type="button" id="boton" onclick="enviar_formulario('reenvia')" value="Generar"><input type="button" id="boton" onclick="limpiar('/Telesur/web/sit.php/reportes')" value="Limpiar"></td>
    </tr>
</table>
    
    <input type="hidden" name="accion" id="accion" value="">
</form>
<br><br>
