<meta http-equiv="refresh" content="60">

<?php $mas=$pagina+1; $menos=$pagina-1; if($menos<1) $menos=$cantidad_paginas; if($mas>$cantidad_paginas) $mas=1;?>


<?php if(!isset($tickets[0])) echo "<div class='sms'>NO EXISTEN SOLICITUDES</div>"; else{?>

	<table class="tabla_list" style="width: 890px;">
		<tr>
			<th>Fecha Solic</th>
			<th>Hora</th>			
			<th>Solicitud</th>
			<th>Solicitante</th>
                        <th>Unidad</th>
			<th>Est</th>                        
                        <th>Asignado</th>
			<th>Ac</th>		
		</tr>
		
		<?php $cont=0; foreach ($tickets as $tk) {?>
		<tr>
			<td><?php echo $tk->getFechaSolicitud("d-m-Y")?></td>
			<td><?php echo $tk->getHoraSolicitud()?></td>
                        <td><a style="color:black;font-weight: bold;cursor:pointer; " title="<?php echo $tk->getSolicitud()?>"><?php echo substr($tk->getSolicitud(),0,28)."..."?></a></td>
			<td><?php echo $perfiles[$cont]->getNombre1().' '.$perfiles[$cont]->getApellido1()?></td>
                        <td><?php $unidad= SitUnidadesPeer::retrieveByPK($tk->getIdUnidad()); echo ucfirst($unidad->getDescripcion()); ?></td>
                        <td><?php if($tk->getEstatus()=='n') echo image_tag("nuevo.gif"); else if($tk->getEstatus()=='r') { $reasignado=SitTicketsReasignadosPeer::retrieveByPK($tk->getIdTicket()); $reasigna=  SfGuardUserProfilePeer::retrieveByPK($reasignado->getUserId()); echo "<a title='".ucwords($reasigna->getNombre1().' '.$reasigna->getApellido1())."'>".image_tag("reasignado.png",array('size' => '20x20')).'</a>'; } else if ($tk->getEstatus()=='a') echo image_tag("ojo.gif");else if ($tk->getEstatus()=='c') echo image_tag("cerrado.png");?></td>
                        <td><?php if($tk->getEstatus()=='a' || $tk->getEstatus()=='c'){$usutick=  SitTicketsUsuariosPeer::retrieveByPK($tk->getIdTicket());  $usu= SfGuardUserProfilePeer::retrieveByPK($usutick->getIdUsuario()); echo ucfirst($usu->getNombre1().' '.$usu->getApellido1());} else echo "No";?></td>
			<td><a href="<?php echo url_for('tickets/detallegeneral?id='.$tk->getIdTicket())?>">Ver</a></td>
		</tr>	
		
		<?php $cont++;}?>
		
	</table>

        <table class="crud_pagina" style="width: 890px;">
            <tr>
                <td colspan="2" align="left" width="50%"><?php echo $cont.' Resultados Página '.$pagina.'/'.$cantidad_paginas.')'; ?></td>
                <td colspan="3"  align="right">		    	
                    <a href="javascript:void(0)" onclick="paginar('/Telesur/web/sit.php/tickets',1)"><?php echo image_tag("first")?></a>
                    <a href="javascript:void(0)" onclick="paginar('/Telesur/web/sit.php/tickets',<?php echo $menos?>)"><?php echo image_tag("previous.png")?></a>
                    <a href="javascript:void(0)" onclick="paginar('/Telesur/web/sit.php/tickets',<?php echo $mas?>)"><?php echo image_tag("next.png")?></a>
                    <a href="javascript:void(0)" onclick="paginar('/Telesur/web/sit.php/tickets',<?php echo $cantidad_paginas?>)"><?php echo image_tag("last")?></a>
                </td>
            </tr>
        </table> 

<div class="leyenda">	
	<table width="500px" border="0">
		<tr align="center">
			<td width="150px"><?php echo image_tag("nuevo.gif")?>&nbsp;Nuevo</td>
                        <td width="150px"><?php echo image_tag("reasignado.png",array('size' => '20x18'))?>&nbsp;Reasignado</td>
			<td width="140px"><?php echo image_tag("ojo.gif")?>&nbsp;Asignado</td>
		</tr>
	</table>
</div>
<?php }?>


<div class="iconos">
<a href="<?php echo url_for('solicitud/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>