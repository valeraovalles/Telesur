<div class="titulo_modulo">REGISTRAR SALIDA</div>

<?php $mas=$pagina+1; $menos=$pagina-1; if($menos<1) $menos=$cantidad_paginas; if($mas>$cantidad_paginas) $mas=1;?>




<form name="form" method="post" action="<?php echo url_for('visitas/registrarsalida')?>">
	<table class="crud_form select200" cellpadding="3px" style="width: 500px">

		<tr>
			<th>VISITANTE</th>
			<td><?php echo $form_filter['cedula']?></td>
		</tr>

		<tr>
			<th>NUMERO DE CARNET</th>
			<td><?php echo $form_filter['num_carnet']?></td>
		</tr>
		
		<tr>
		<th>Estatus</th>
			<td><?php echo $form_filter['estatus']?></td>
		</tr>
	
		
		<tr>
                    <td colspan="2" style="text-align: center;">
                        <input id="boton" type="button" onclick="limpiar('/Telesur/web/control_visitas.php/visitas')" value="Limpiar">
                    </td>
                </tr>
	
	</table>
</form>	

<br>



<br>

<table class="tabla_list" style="width: 850px;">
    <tr>
        <th>Cédula</th>
	<th>Nombre</th>
	<th>Apellido</th>
	<th>Numero de Carnet</th>
	<th>Contacto</th>
	<th>Observaciones</th>	
    </tr>
				
    
		
    <tr>
        <td><?php echo $datos[$cont]->getCedula()?></td>
        <td><?php echo ucwords($datos[$cont]->getNombre())?></td>
	<td><?php echo ucwords($datos[$cont]->getApellido())?></td>
        <td><?php echo ucwords($datos[$cont]->getnum_carnet())?></td>
        <td><?php echo ucwords($datos[$cont]->getcontacto())?></td>
        <td><?php echo ucwords($datos[$cont]->getobservaciones())?></td>
	<td><?php echo $cs->getFechaSolicitud("d-m-Y");?></td>
	<td><?php echo $estatus;?></td>
	<td><a href="<?php echo url_for('usuarios_admin/editar?idc='.$cs->getID_usuario())?>"><?php echo image_tag("edit.png",array('size' => '20x20'))?></a>&nbsp;<a href="<?php echo url_for('administracion/pdfconstancia?idc='.$cs->getIdConstancia())?>"><?php echo image_tag("pdf.gif",array('size' => '20x20'))?></a></td>
    </tr>
	
    <?php $cont++; }?>
    
</table>

<table class="crud_pagina" style="width: 850px;">
    <tr>
        <td colspan="2" align="left" width="50%"><?php echo $cont.' Resultados Página '.$pagina.'/'.$cantidad_paginas.')'; ?></td>
	<td colspan="3"  align="right">
		    	
            <a href="javascript:void(0)" onclick="paginar('/Telesur/web/control_visitas.php/usuarios/index',1)"><?php echo image_tag("first")?></a>
            <a href="javascript:void(0)" onclick="paginar('/Telesur/web/control_visitas.php/usuarios/index',<?php echo $menos?>)"><?php echo image_tag("previous.png")?></a>
            <a href="javascript:void(0)" onclick="paginar('/Telesur/web/control_visitas.php/usuarios/index',<?php echo $mas?>)"><?php echo image_tag("next.png")?></a>
            <a href="javascript:void(0)" onclick="paginar('/Telesur/web/control_visitas.php/usuarios/index',<?php echo $cantidad_paginas?>)"><?php echo image_tag("last")?></a>
	</td>
    </tr>
</table>

<?php if(isset($constancias[0])){?>
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
<a href="<?php echo url_for('solicitud/solicitud')?>"><?php echo image_tag('new.png')?>&nbsp;&nbsp;Solicitar</a>
&nbsp;&nbsp;&nbsp;
<a href="<?php echo url_for('usuarios/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>
<th>Registrar Visita</th>    
<td><input type="button" onclick="enviar_formulario('Registrar salida')" name="Registrar Visita" id="boton" value="registrar"></td>
    </tr> 