
<div class="titulo_modulo"> DETALLE VISITANTE</div>

<table border=1 class="Detalle Visitante "style="width: 100px;">
<tr>    
<td><img width='140;' src="<?php echo image_path('visitas/imagenes_usuarios/'.$datos[0]->getCedula().'.jpg')?>"></td>
</tr>
<tr>    
<td><?php echo $datos[0]->getCedula();?></td>
</tr>
<tr>
<td><?php echo $datos[0]->getNombre();?></td>
</tr>
<tr>
<td><?php echo $datos[0]->getApellido();?></td>
</tr>
</table>
<div class="iconos">
    <a href="<?php echo url_for('usuarios_admin/index')?>">Volver&nbsp;<?php echo image_tag("volver.jpg")?></a>
</div>