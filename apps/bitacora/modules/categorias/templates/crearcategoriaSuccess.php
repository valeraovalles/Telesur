<div class="titulo_modulo">CREAR CATEGORIAS PARA EL DEPARTAMENTO <br> (<?php echo strtoupper($unidadusuario)?>)</div>

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>

<form method="post" action="<?php echo url_for('categorias/crearcategoria')?>" name="form">
    <table cellpadding="5" class="crud_form">
        <tr>
            <th><span style="color:red;">*</span>Categoria:</th>
            <td><input type="text" name="categoria"></td>
        </tr>

        <tr>
            <td colspan="2" style="text-align:center"><input type="button" id="boton" value="Guardar" onclick="enviar_formulario('Crear categoria')"  autocomplete="off"></td>
        </tr>

    </table>
    
    <input type="hidden" value="" id="accion" name="accion">    
</form>
<div style="color: red;">* Campos requeridos</div>

<div class="iconos">
<a href="<?php echo url_for('categorias/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>



