<div class="titulo_modulo">BITACORA</div>

<?php $mas=$pagina+1; $menos=$pagina-1; if($menos<1) $menos=$cantidad_paginas; if($mas>$cantidad_paginas) $mas=1;?>

<?php if($sf_user->getFlash('sms')){?>
    <div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>
    
<form name="form" method="post" action="<?php echo url_for('bitacora/listado')?>">
	<table class="crud_form select200 input150" cellpadding="3px" style="width: 500px">

		<tr>
			<th>Fecha</th>
			<td><?php echo $form_filter['fecha']?></td>
		</tr>

		<tr>
			<th>Subcategoria</th>
			<td><?php echo $form_filter['id_subcategoria']?></td>
		</tr>
		
		<tr>
                    <td colspan="2" style="text-align: center;">
                        <input id="boton" type="submit" value="Filtrar">
                        <input id="boton" type="button" onclick="limpiar('/Telesur/web/bitacora.php/bitacora/listado')" value="Limpiar">
                    </td>
                </tr>
	
	</table>
</form>	

<br>

<table class="tabla_list" style="width: 850px;">
    <tr>
        <th>Fecha</th>
	<th>Hora</th>
	<th>Subcategoria</th>
	<th>Descripción</th>
	<th>Usuario</th>
	<th>Accion</th>
    </tr>
    <?php $cont=0; foreach ($bitacora as $cs) {?>
		
    <tr>
        <td><?php echo $cs->getFecha("d-m-Y");?></td>
        <td><?php echo $cs->getHora();?></td>
	<td><?php echo ucwords($subcategoria[$cont]->getDescripcion())?></td>
        <td><?php echo "<a style='color:black;font-weight: bold;cursor:pointer;' title='".ucfirst($cs->getDescripcion())."' cursor='hand'>".substr($cs->getDescripcion(),0,28).'...</a>';?></td>
        <td><?php echo ucwords($perfiles[$cont]->getNombre1().' '.$perfiles[$cont]->getNombre2())?></td>
	<td><a href="<?php echo url_for('administracion/editar?idc='.$cs->getIdBitacora())?>"><?php echo image_tag("edit.png",array('size' => '20x20'))?></a>&nbsp;<a href="<?php echo url_for('administracion/pdfconstancia?idc='.$cs->getIdBitacora())?>"><?php echo image_tag("pdf.gif",array('size' => '20x20'))?></a></td>
    </tr>
	
    <?php $cont++; }?>
    
</table>

<table class="crud_pagina" style="width: 850px;">
    <tr>
        <td colspan="2" align="left" width="50%"><?php echo $cont.' Resultados Página '.$pagina.'/'.$cantidad_paginas.')'; ?></td>
	<td colspan="3"  align="right">
		    	
            <a href="javascript:void(0)" onclick="paginar('/Telesur/web/bitacora.php/bitacora/listado',1)"><?php echo image_tag("first")?></a>
            <a href="javascript:void(0)" onclick="paginar('/Telesur/web/bitacora.php/bitacora/listado',<?php echo $menos?>)"><?php echo image_tag("previous.png")?></a>
            <a href="javascript:void(0)" onclick="paginar('/Telesur/web/bitacora.php/bitacora/listado',<?php echo $mas?>)"><?php echo image_tag("next.png")?></a>
            <a href="javascript:void(0)" onclick="paginar('/Telesur/web/bitacora.php/bitacora/listado',<?php echo $cantidad_paginas?>)"><?php echo image_tag("last")?></a>
	</td>
    </tr>
</table>

<?php if(isset($bitacora[0])){?>
    <div class="leyenda">
        <table width="600px" border="0">
		<tr align="center">
			<td width="150px"><a title="Indica que la constancia esta nueva"><?php echo image_tag("nuevo.gif")?>&nbsp;Nueva</a></td>
			<td width="160px"><a title="Indica que la constancia fue revisada"><?php echo image_tag("busca.png",array('size' => '20x20'))?>&nbsp;En proceso</a></td>
                        <td width="150px"><a title="Editar la constancia"><?php echo image_tag("edit.png",array('size' => '20x20'))?>&nbsp;Editar</a></td>
                        <td width="150px"><a title="Generar pdf de la constancia"><?php echo image_tag("pdf.gif",array('size' => '20x20'))?>&nbsp;Pdf</a></td>
			<td width="150px"><a title="La constancia ya fue generada"><?php echo image_tag("cerrado.png")?>&nbsp;Culminada</a></td>
		</tr>
	</table>
    </div>
<?php }?>

<div class="iconos">
<a href="<?php echo url_for('bitacora/registro')?>"><?php echo image_tag('new.png')?>&nbsp;&nbsp;Registrar</a>
&nbsp;&nbsp;&nbsp;
<a href="<?php echo url_for('bitacora/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>
