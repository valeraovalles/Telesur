<div class="titulo_modulo">ESTATUS DE CONSTANCIAS SOLICITADAS</div>

<?php $mas=$pagina+1; $menos=$pagina-1; if($menos<1) $menos=$cantidad_paginas; if($mas>$cantidad_paginas) $mas=1;?>

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>	

<form name="form" method="post" action="<?php echo url_for('solicitud/estatus')?>">
<table class="tabla_list">
    <tr>
        <th>Tipo de constancia</th>
	<th>Fecha solicitud</th>
	<th>Bono alimentación</th>
	<th>Dirigido a</th>
	<th>Estatus</th>
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
				
	if($cs->getEstatus()=='n')$estatus=image_tag("enviado.gif",array('size' => '20x20'));
	else if($cs->getEstatus()=='v')$estatus=image_tag("busca.png",array('size' => '20x20'));
	else if($cs->getEstatus()=='c ')$estatus=image_tag("cerrado.png");
				
    ?>

        <tr>
            <td><?php echo $tipoconstancia;?></td>
            <td><?php echo $cs->getFechaSolicitud();?></td>
            <td><?php echo $bono;?></td>
            <td><?php echo $cs->getDirigidoA();?></td>
            <td><?php echo $estatus;?></td>
        </tr>
	
    <?php $cont++;} ?>
        
</table>
	
<table class="crud_pagina" style="width: 800px;">
    <tr>
        <td colspan="2" align="left" width="50%"><?php echo $cont.' Resultados Página '.$pagina.'/'.$cantidad_paginas.')'; ?></td>
	<td colspan="3"  align="right">
		    	
            <a href="javascript:void(0)" onclick="paginar('/Telesur/web/constancia.php/solicitud/estatus',1)"><?php echo image_tag("first")?></a>
            <a href="javascript:void(0)" onclick="paginar('/Telesur/web/constancia.php/solicitud/estatus',<?php echo $menos?>)"><?php echo image_tag("previous.png")?></a>
            <a href="javascript:void(0)" onclick="paginar('/Telesur/web/constancia.php/solicitud/estatus',<?php echo $mas?>)"><?php echo image_tag("next.png")?></a>
            <a href="javascript:void(0)" onclick="paginar('/Telesur/web/constancia.php/solicitud/estatus',<?php echo $cantidad_paginas?>)"><?php echo image_tag("last")?></a>
	</td>
    </tr>
</table>
</form>

<?php if(isset($constancias[0])){?>
    <div class="leyenda">
        <table width="600px" border="0">
		<tr align="center">
			<td width="150px"><a title="Indica que la constancia se ha enviado para ser procesada"><?php echo image_tag("enviado.gif",array('size' => '20x20'))?>&nbsp;Enviada</a></td>
			<td width="160px"><a title="Indica que la constancia esta siendo evaluada"><?php echo image_tag("busca.png",array('size' => '20x20'))?>&nbsp;En proceso</a></td>
			<td width="150px"><a title="Indica que ya su constancia esta lista para ser retirada"><?php echo image_tag("cerrado.png")?>&nbsp;Culminada</a></td>
		</tr>
	</table>
    </div>
<?php }?>

<div class="iconos">
<a href="<?php echo url_for('solicitud/solicitud')?>"><?php echo image_tag('new.png')?>&nbsp;&nbsp;Solicitar</a>
&nbsp;&nbsp;&nbsp;
<a href="<?php echo url_for('solicitud/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>