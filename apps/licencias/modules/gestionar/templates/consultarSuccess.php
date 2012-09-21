<h1>Consultar Licencia ó Servicio</h1>

<table width="400px"  class="crud_form" cellpadding="5">

<tr>
	<th width="150px">Tipo</th>
	<td width="250px"><?php if($licencias[0]->getTipo()=='s') echo "Servicio"; else if ($licencias[0]->getTipo()=='l') echo "Licencia"; else "No definido";?></td>
</tr>

<tr>
	<th width="150px">Nombre Licencia</th>
	<td width="250px"><?php echo $licencias[0]->getNombreLicencia()?></td>
</tr>
<tr>
	<th width="150px">Numero Licencia</th>
	<td width="250px"><?php echo $licencias[0]->getNumero()?></td>
</tr>

<tr>
	<th>Fecha Compra</th>
	<td><?php echo $licencias[0]->getFechaCompra("d-m-Y")?></td>
</tr>

<tr>
	<th>Fecha Vencimiento</th>
	<td><?php echo $licencias[0]->getFechaVencimiento("d-m-Y")?></td>
</tr>
<tr>
	<th>Descripcion</th>
	<td><?php echo $licencias[0]->getDescripcion()?></td>
</tr>
<tr>
	<th>Responsable</th>
	<td><?php echo strtoupper($perfil[0]->getNombre1()).' '.strtoupper($perfil[0]->getApellido1())?></td></tr>
<tr>
	<th>Departamento</th>
	<td><?php echo $departamento[0]->getDescripcion()?></td>
</tr>
<tr>
	<th>Cargo</th>
	<td><?php echo $cargo[0]->getDescripcion();?></td>
</tr>




</table>
<br>
<a href="<?php echo url_for('gestionar/index') ?>">Volver&nbsp;<?php echo image_tag("volver.jpg")?></a>

<br><br>