<div class="titulo_modulo">LISTA DE CATEGORIAS (<?php echo strtoupper($unidadusuario)?>)</div>

<?php if (isset($categorias[0])){ ?>

    <?php if($sf_user->getFlash('sms')){?>
    <div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
    <?php }?>
	
    <form method="post" action="<?php echo url_for('categorias/index')?>" name="form">
        <table class="tabla_list" cellspacing="1" style="width:500px">
            <tr>
                <th>Categoria</th>
		<th>Acciones</th>
            </tr>
		
            <?php foreach ($categorias as $cat) {?>
                <tr>
                    <td width="400px"><?php echo ucfirst($cat->getDescripcion())?></td>
                    <td>
                        <a  href="<?php echo url_for('categorias/crearsubcategoria?id='.$cat->getIdCategoria())?>"><?php echo image_tag("add.png")?></a>
                        <a  href="<?php echo url_for('categorias/editarcategoria?id='.$cat->getIdCategoria())?>"><?php echo image_tag("edit.png")?></a>
			<a  href="javascript:void(0);" onclick="elimina(<?php echo $cat->getIdCategoria()?>)"><?php echo image_tag("delete.png")?></a>
                        <a  href="<?php echo url_for('categorias/consultarcategoria?id='.$cat->getIdCategoria())?>"><?php echo image_tag("list.png")?></a>
                    </td>
		</tr>
			
            <?php }?>
	</table>
        <input type="hidden" name="accion" id="accion">
	<input type="hidden" name="eliminar" id="eliminar">
    </form>
        
    <div class="leyenda">
	<table width="600px" border="0">
		<tr align="center">
			<td width="200px"><?php echo image_tag("add.png")?>&nbsp;Agregar Sub-Categoria</td>
			<td width="140px"><?php echo image_tag("edit.png")?>&nbsp;Editar categoria</td>
			<td width="160px"><?php echo image_tag("delete.png",array('size' => '20x20'))?>&nbsp;Eliminar categoria</td>
			<td width="150px"><?php echo image_tag("list.png")?>&nbsp;Detalles</td>
		</tr>
	</table>  
    </div>
        
<?php } else{?>

	<div class="sms">No hay categorias asociadas a este departamento</div>

<?php }?>

<div class="iconos">
<a href="<?php echo url_for('categorias/crearcategoria')?>"><?php echo image_tag("new.png")?>Nueva Categoria</a>
</div>