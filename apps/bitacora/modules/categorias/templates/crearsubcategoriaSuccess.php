<div class="titulo_modulo">CREAR SUB-CATEGORIAS PARA LA CATEGORIA <br> (<?php echo strtoupper($categoria[0]->getDescripcion())?>)</div>

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>

<form method="post" name="form" action="<?php echo url_for('categorias/crearsubcategoria?id='.$idcat)?>">
    <table cellpadding="5" class="crud_form">
        <tr>
            <th>Sub-Categoria</th>
            <td><input type="text" name="subcategoria"></td>
        </tr>

        <tr>
            <td colspan="2" style="text-align:center"><input type="button" id="boton" value="Guardar" onclick="enviar_formulario('Crear subcategoria')"></td>
        </tr>
        
        <input type="hidden" name="accion" id="accion"> 
    </table>
</form>

<div class="iconos">
<a href="<?php echo url_for('categorias/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>&nbsp;&nbsp;&nbsp;
<a href="<?php echo url_for('categorias/consultarcategoria?id='.$idcat)?>"><?php echo image_tag('list.png')?>&nbsp;&nbsp;Consultar Subcategorias</a>
</div>
