<div class="titulo_modulo">TICKETS ASIGNADOS A <?php echo strtoupper($nombre_user);?></div>

<?php if(!isset($tickets[0]))echo "<div class='sms'>No hay tickets asignados para este técnico</div>"; else {?>

	<table class="tabla_list" style="width: 850px;">
		<tr>
			<th width="110px">Fecha Solicitud</th>
			<th width="105px">Hora Solicitud</th>
			<th width="135px">Categoria</th>
			<th width="200px">Solicitud</th>
			<th width="150px">Solicitante</th>
			<th width="60px">Accion</th>		
		</tr>
		
		<?php $cont=0; foreach ($tickets as $tk) {?>
		<tr>
			<td><?php echo $tk->getFechaSolicitud("d-m-Y")?></td>
			<td><?php echo $tk->getHoraSolicitud()?></td>
			<td>
                        <?php
                                $dessub= SitSubcategoriasPeer::retrieveByPk($tk->getIdSubcategoria());
                                echo "<a href='tickets/ticketsubcategoria?id=".$tk->getIdTicket()."'>".$dessub->getDescripcion()."</a>";

                        ?>
                        
                        </td>
			<td><?php echo substr($tk->getSolicitud(),0,28)."..."?></td>
			<td><?php echo $perfiles[$cont]->getNombre1().' '.$perfiles[$cont]->getApellido1()?></td>
			<td><a href="<?php echo url_for('tickets_asignados/gestionarticket?id='.$tk->getIdTicket())?>"><?php echo image_tag('busca.png',array('size' => '20x20'))?></a></td>
		</tr>	
		
		<?php $cont++;}?>
	</table>
	
	<br><br>
	
	<div style="text-align: center;">
			<?php echo image_tag("busca.png",array('size' => '20x20'))?>&nbsp;Ver
	</div>
	

<?php }?>
<br><br>