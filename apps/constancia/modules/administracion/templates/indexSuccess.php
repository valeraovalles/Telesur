<div class="titulo_modulo">GESTIONAR CONSTANCIAS</div>

<?php $mas=$pagina+1; $menos=$pagina-1; if($menos<1) $menos=$cantidad_paginas; if($mas>$cantidad_paginas) $mas=1;?>




<form name="form" method="post" action="<?php echo url_for('administracion/index')?>">
	<table class="crud_form select200" cellpadding="3px" style="width: 500px">

		<tr>
			<th>Solicitante</th>
			<td><?php echo $form_filter['id_solicitante']?></td>
		</tr>

		<tr>
			<th>Tipo Constancia</th>
			<td><?php echo $form_filter['tipo_constancia']?></td>
		</tr>
		
		<tr>
		<th>Estatus</th>
			<td><?php echo $form_filter['estatus']?></td>
		</tr>
	
		
		<tr>
                    <td colspan="2" style="text-align: center;">
                        <input id="boton" type="submit" value="Filtrar">
                        <input id="boton" type="button" onclick="limpiar('/Telesur/web/constancia.php/administracion')" value="Limpiar">
                    </td>
                </tr>
	
	</table>
</form>	

<br>

<table class="tabla_list" style="width: 500px">
    <tr>        
        <th>CANTIDAD NUEVA</th>
        <th>CANTIDAD VISTA</th>
        <th>CANTIDAD CERRADA</th>
    </tr>
    <tr>
        <td><?php echo $cantidad_nueva;?></td>
        <td><?php echo $cantidad_vista;?></td>
        <td><?php echo $cantidad_cerrada;?></td>
    </tr>
</table>

<br>

<div class="sms">YASMIN RECUERDA MARCAR LAS CONTANCIAS :)</div>

<table class="tabla_list" style="width: 850px;">
    <tr>
        <th>Cédula</th>
	<th>Nombre</th>
	<th>Apellido</th>
	<th>Tipo de constancia</th>
	<th>Fecha solicitud</th>
	<th>Estatus</th>
	<th>Accion</th>
    </tr>
    <?php $cont=0; foreach ($constancias as $cs) {
	
        $tc=$cs->getTipoConstancia();  
                
             if($tc=='sb') $tipoconstancia="Sueldo Básico";
        else if($tc=='sn') $tipoconstancia="Sueldo Normal";
	else if($tc=='si') $tipoconstancia="Sueldo Integral";
        else if($tc=='sba') $tipoconstancia="Sueldo Básico Anual";
        else if($tc=='sna') $tipoconstancia="Sueldo Normal Anual";
	else if($tc=='sia') $tipoconstancia="Sueldo Integral Anual";
        
	if($cs->getBonoAlimentacion()==true)$bono="Si"; else $bono="No";
				
	if($cs->getEstatus()=='n')$estatus=image_tag("nuevo.gif");
	else if($cs->getEstatus()=='v')$estatus=image_tag("busca.png",array('size' => '20x20'));
	else if($cs->getEstatus()=='c')$estatus=image_tag("cerrado.png");
				
    ?>
		
    <tr>
        <td><?php echo $perfiles[$cont]->getCedula()?></td>
        <td><?php echo ucwords($perfiles[$cont]->getNombre1()).' '.ucwords($perfiles[$cont]->getNombre2())?></td>
	<td><?php echo ucwords($perfiles[$cont]->getApellido1()).' '.ucwords($perfiles[$cont]->getApellido2())?></td>
	<td><?php echo $tipoconstancia;?></td>
	<td><?php echo $cs->getFechaSolicitud("d-m-Y");?></td>
	<td><?php echo $estatus;?></td>
	<td><a href="<?php echo url_for('administracion/editar?idc='.$cs->getIdConstancia())?>"><?php echo image_tag("edit.png",array('size' => '20x20'))?></a>&nbsp;<a href="<?php echo url_for('administracion/pdfconstancia?idc='.$cs->getIdConstancia())?>"><?php echo image_tag("pdf.gif",array('size' => '20x20'))?></a></td>
    </tr>
	
    <?php $cont++; }?>
    
</table>

<table class="crud_pagina" style="width: 850px;">
    <tr>
        <td colspan="2" align="left" width="50%"><?php echo $cont.' Resultados Página '.$pagina.'/'.$cantidad_paginas.')'; ?></td>
	<td colspan="3"  align="right">
		    	
            <a href="javascript:void(0)" onclick="paginar('/Telesur/web/constancia.php/administracion/index',1)"><?php echo image_tag("first")?></a>
            <a href="javascript:void(0)" onclick="paginar('/Telesur/web/constancia.php/administracion/index',<?php echo $menos?>)"><?php echo image_tag("previous.png")?></a>
            <a href="javascript:void(0)" onclick="paginar('/Telesur/web/constancia.php/administracion/index',<?php echo $mas?>)"><?php echo image_tag("next.png")?></a>
            <a href="javascript:void(0)" onclick="paginar('/Telesur/web/constancia.php/administracion/index',<?php echo $cantidad_paginas?>)"><?php echo image_tag("last")?></a>
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
<a href="<?php echo url_for('solicitud/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>
