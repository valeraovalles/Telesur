<div class="titulo_modulo">ASIGNAR UNIDAD</div>


<form action="<?php echo url_for('UsuarioUnidad/asignar?id='.$idu)?>" method="post">
<div>
    
    <select name="unidad">
        
        <?php foreach ($unidades as $u) {?>
        <option value="<?php echo $u->getIdUnidad()?>"><?php echo $u->getDescripcion()?></option>
        <?php }?>
    </select>
    
</div>

<br>

<div><input type="submit" value="Asociar"></div>
</form>

<div class="iconos">
    <a href="<?php echo url_for('UsuarioUnidad/index')?>">Volver&nbsp;<?php echo image_tag("volver.jpg")?></a>
</div>
