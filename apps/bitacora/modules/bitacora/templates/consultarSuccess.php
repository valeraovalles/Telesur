<h1>Consultar Bitácora</h1>

<table width="400px"  class="crud_form" cellpadding="5">

<tr>
	<th width="150px">Fecha</th>
	<td width="250px"><?php echo $bitacora[0]->getFecha("d-m-Y");?></td>
</tr>

<tr>
	<th width="150px">Hora</th>
	<td width="250px"><?php echo $bitacora[0]->getHora()?></td>
</tr>
<tr>
	<th width="150px">Descripción</th>
	<td width="250px"><?php echo $bitacora[0]->getDescripcion()?></td>
</tr>

<tr>
	<th>Usuario</th>
	<td><?php echo $usuario[0]->getNombre1().' '.$usuario[0]->getApellido1()?></td>
</tr>

<tr>
	<th>Categoria</th>
	<td><?php echo $categoria[0]->getDescripcion()?></td>
</tr>


<tr>
	<th>Subcategoria</th>
	<td><?php echo $subcategoria[0]->getDescripcion()?></td>
</tr>



</table>
<br>
<a href="<?php echo url_for('bitacora/listado') ?>">Volver&nbsp;<?php echo image_tag("volver.jpg")?></a>

<br><br>