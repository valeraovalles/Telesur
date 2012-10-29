<div class="titulo_modulo">SUB-CATEGORIAS DE LA CATEGORIA <br> (<?php echo strtoupper($categoria[0]->getDescripcion())?>)</div>

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>

<?php if (!isset($subcategorias[0])) echo "<div class='sms'>No se han creado subcategorias</div>"; else {?>

    <form method="post" action="<?php echo url_for('categorias/consultarcategoria?id='.$idcat)?>" name="form">
        <table class="tabla_list" cellspacing="1" style="width:500px">
            <tr>
                <th>Sub-Categoria</th>
		<th>Acciones</th>
            </tr>
		
            <?php foreach ($subcategorias as $cat) {?>
            <tr>
                <td width="400px"><?php echo $cat->getDescripcion()?></td>
		<td>
                    <a  href="<?php echo url_for('categorias/editarsubcategoria?id='.$cat->getIdSubcategoria())?>"><?php echo image_tag("edit.png")?></a>
                    <a  href="javascript:void(0)" onclick="elimina(<?php echo $cat->getIdSubcategoria()?>)"><?php echo image_tag("delete.png")?></a>
    		</td>
            </tr>			
            <?php }?>
        </table>
            
		<input type="hidden" name="accion" id="accion">
                <input type="hidden" name="eliminar" id="eliminar">
	</form>
        
<?php }?>

<div class="iconos">
<a href="<?php echo url_for('categorias/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>