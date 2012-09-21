<meta http-equiv="refresh" content="60">
<div class="titulo_modulo">LISTA DE TICKETS DE <?php echo strtoupper($unidadusuario)?></div>

<div style="color:red;background-color:#E7EEF6;">LOS TICKETS PUEDEN CONTENER ARCHIVOS ADJUNTOS COMO IMÁGENES O ARCHIVOS DESCARGABLES DE 2MB MÁXIMO</div>
<BR>
	

<?php $mas=$pagina+1; $menos=$pagina-1; if($menos<1) $menos=$cantidad_paginas; if($mas>$cantidad_paginas) $mas=1;?>

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>	


<form name="form" method="post" action="<?php echo url_for('tickets/index')?>">
    <table class="crud_form select200 input150" cellpadding="3px">
	
        <tr>
            <th>Fecha Desde</th>
            <td><?php echo $form_filter['fecha_desde']?></td>
	</tr>

	<tr>
            <th>Fecha Hasta</th>
            <td><?php echo $form_filter['fecha_hasta']?></td>
	</tr>
		
	<tr>
            <th>Categorias</th>
            <td><?php echo $form_filter['id_categoria']?></td>
        </tr>
		
	<tr>
            <th>Solicitantes</th>
            <td><?php echo $form_filter['id_solicitante']?></td>
	</tr>
		
        <tr>
            <th>Estatus</th>
            <td><?php echo $form_filter['estatus']?></td>
	</tr>
		
	<tr>
            <td colspan="2" style="text-align: center;"><input type="submit" id="boton" value="Filtrar">
                <input type="button" id="boton" onclick="location.href='tickets'" value="Limpiar" onclick="limpiar('/Telesur/web/sit.php/tickets')"></td></tr>
	
	</table>
</form>	

<br><br>

<table class="tabla_list" style="width: 850px;">
       
    <tr>
        <th style="text-align: center;">TICKETS NUEVOS</th>
        <th style="text-align: center;">TICKETS ASIGNADOS</th>
        <th style="text-align: center;">TICKETS CERRADOS</th>
    </tr>
    
    <tr style="text-align: center;">
        <td><?php echo $cantidadnuevos?></td>
        <td><?php echo $cantidadasignados?></td>
        <td><?php echo $cantidadcerrados?></td>
    </tr>

</table>

<br><br>

<?php if(!isset($tickets[0])) echo "<div class='sms'>NO EXISTEN SOLICITUDES</div>"; else{?>

	<table class="tabla_list" style="width: 890px;">
		<tr>
			<th>Fecha Solic</th>
			<th>Hora</th>
			<th>Categoria</th>
			<th>Solicitud</th>
			<th>Solicitante</th>
			<th>Est</th>
                        <th>Asignado</th>
			<th>Ac</th>		
		</tr>
		
		<?php $cont=0; foreach ($tickets as $tk) {?>
		<tr>
                	<td><?php echo $tk->getFechaSolicitud("d-m-Y")?></td>
			<td><?php echo $tk->getHoraSolicitud()?></td>
			<td>
                            
                        <?php if($tk->getIdCategoria()==0)echo "<div style='background-color:yellow;'>Ninguna</div>"; 
                        else{
                            
                                if($tk->getIdSubcategoria()!=null){
                                $dessub= SitSubcategoriasPeer::retrieveByPk($tk->getIdSubcategoria());
                                echo "<a href='tickets/ticketsubcategoria?id=".$tk->getIdTicket()."'>".$dessub->getDescripcion()."</a>";
                        }
                            
                        }?></td>
			<td><a style="color:black;font-weight: bold;cursor:pointer; " title="<?php echo $tk->getSolicitud()?>"><?php echo substr($tk->getSolicitud(),0,28)."..."?></a></td>
			<td><?php echo $perfiles[$cont]->getNombre1().' '.$perfiles[$cont]->getApellido1()?></td>
			<td>
                            <?php if($tk->getEstatus()=='n') echo image_tag("nuevo.gif"); 
                            else if ($tk->getEstatus()=='r'){ $reasignado=SitTicketsReasignadosPeer::retrieveByPK($tk->getIdTicket()); $reasigna=  SfGuardUserProfilePeer::retrieveByPK($reasignado->getUserId()); echo "<a title='".ucwords($reasigna->getNombre1().' '.$reasigna->getApellido1())."'>".image_tag("reasignado.png",array('size' => '20x20')).'</a>'; }
                            else if ($tk->getEstatus()=='a') echo image_tag("ojo.gif");else if ($tk->getEstatus()=='c') echo image_tag("cerrado.png");?>
                        </td>
                        <td><?php if($tk->getEstatus()=='a' || $tk->getEstatus()=='c'){$usutick=  SitTicketsUsuariosPeer::retrieveByPK($tk->getIdTicket());  $usu= SfGuardUserProfilePeer::retrieveByPK($usutick->getIdUsuario()); echo ucfirst($usu->getNombre1().' '.$usu->getApellido1());} else echo "No";?></td>
			<td><a href="<?php echo url_for('tickets/gestionarticket?id='.$tk->getIdTicket())?>">Ver</a></td>
		</tr>	
		
		<?php $cont++;}?>
		
	</table>

        <table class="crud_pagina" style="width: 850px;">
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
			<td width="125px"><?php echo image_tag("nuevo.gif")?>&nbsp;Nuevo</td>
                        <td width="125px"><?php echo image_tag("reasignado.png",array('size' => '20x20'))?>&nbsp;Reasignado</td>
			<td width="125px"><?php echo image_tag("ojo.gif")?>&nbsp;Asignado</td>
			<td width="125px"><?php echo image_tag("cerrado.png")?>&nbsp;Cerrado</td>
		</tr>
	</table>
</div>
<?php }?>

<div class="iconos">
<a href="<?php echo url_for('solicitud/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>