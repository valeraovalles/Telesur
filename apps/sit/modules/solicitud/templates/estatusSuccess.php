<div class="titulo_modulo">ESTATUS DE MIS TICKETS ENVIADOS</div>

<?php $mas=$pagina+1; $menos=$pagina-1; if($menos<1) $menos=$cantidad_paginas; if($mas>$cantidad_paginas) $mas=1;?>

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>

<?php if(isset($tickets[0])){?>
<form name="form" method="post" action="<?php echo url_for('solicitud/estatus')?>">
    <table class="tabla_list">
            <tr>
                    <th>Id</th>
                    <th width="150px">Fecha Solicitud</th>
                    <th width="150px">Hora Solicitud</th>
                    <th width="350px">Solicitud</th>
                    <th width="75px">Estatus</th>
                    <th width="75px">Accion</th>
            </tr>

            <?php $cont=0; foreach ($tickets as $tk) {?>

                    <tr>
                            <td><?php echo $tk->getIdTicket();?></td>
                            <td><?php echo $tk->getFechaSolicitud("d-m-Y");?></td>
                            <td><?php echo $tk->getHoraSolicitud("H:i:s");?></td>
                            <td><?php echo substr($tk->getSolicitud(),0,50)."...";?></td>
                            <td>
                                <?php if($tk->getEstatus()=='n' || $tk->getEstatus()=='r') echo image_tag("enviado.gif",array('size' => '20x20')); 
                                    else if ($tk->getEstatus()=='a') echo image_tag("ojo.gif"); 
                                    else if ($tk->getEstatus()=='c') echo image_tag("cerrado.png")?></td>
                            <td><a href="<?php echo url_for('solicitud/detalle?id='.$tk->getIdTicket())?>"><?php echo image_tag('busca.png',array('size' => '20x20'))?></a></td>
                    </tr>

            <?php $cont++;}?>

    </table>
</form>
        <table class="crud_pagina" style="width: 800px;">
            <tr>
                <td colspan="2" align="left" width="50%"><?php echo $cont.' Resultados Página '.$pagina.'/'.$cantidad_paginas.')'; ?></td>
                <td colspan="3"  align="right">		    	
                    <a href="javascript:void(0)" onclick="paginar('/Telesur/web/sit.php/solicitud/estatus',1)"><?php echo image_tag("first")?></a>
                    <a href="javascript:void(0)" onclick="paginar('/Telesur/web/sit.php/solicitud/estatus',<?php echo $menos?>)"><?php echo image_tag("previous.png")?></a>
                    <a href="javascript:void(0)" onclick="paginar('/Telesur/web/sit.php/solicitud/estatus',<?php echo $mas?>)"><?php echo image_tag("next.png")?></a>
                    <a href="javascript:void(0)" onclick="paginar('/Telesur/web/sit.php/solicitud/estatus',<?php echo $cantidad_paginas?>)"><?php echo image_tag("last")?></a>
                </td>
            </tr>
        </table> 

<?php } else echo "<div class='sms'>No ha solicitado ningún ticket</div>";?>

<div class="leyenda">
    <table width="600px" border="0">
        <tr align="center">
            <td width="150px"><a title="Indica que se a enviado el ticket a la unidad correspondiente"><?php echo image_tag("enviado.gif",array('size' => '25x25'))?>&nbsp;Enviado</a></td>
            <td width="140px"><a title="Indica que ya su ticket fue asignado a un técnicco"><?php echo image_tag("ojo.gif")?>&nbsp;Asignado</a></td>
            <td width="150px"><a title="Indica que el ticket se ha cerrado"><?php echo image_tag("cerrado.png")?>&nbsp;Cerrado</a></td>
	</tr>
    </table>
</div>

<div class="iconos">
<a href="<?php echo url_for('solicitud/solicitud')?>"><?php echo image_tag('new.png')?>&nbsp;&nbsp;Solicitar</a>
&nbsp;&nbsp;&nbsp;
<a href="<?php echo url_for('solicitud/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>
