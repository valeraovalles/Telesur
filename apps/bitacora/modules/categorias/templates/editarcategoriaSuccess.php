<div class="titulo_modulo">EDITAR LA CATEGORIA (<?php echo ucfirst($categoria->getDescripcion())?>)</div>
	
<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>

<form method="post" action="<?php echo url_for('categorias/editarcategoria?id='.$categoria->getIdCategoria())?>" name="form">
    <table cellpadding="5" class="crud_form">
        <tr>
            <th>Categoria</th>
	    <td><input type="text" name="categoria" value="<?php echo $categoria->getDescripcion()?>"></td>
	</tr>
		  
	<tr>
            <td colspan="2" style="text-align:center"><input type="button" id="boton" value="Actualizar" onclick="enviar_formulario('Actualizar categoria')"></td>
	</tr>
    </table>
    <input type="hidden" id="accion" name="accion" value="">
        
</form>

<div class="iconos">
<a href="<?php echo url_for('categorias/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>
