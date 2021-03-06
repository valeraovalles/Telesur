<div class="titulo_modulo">GESTIONAR SOLICITUDES DE CORRESPONDENCIA</div>

<?php $mas=$pagina+1; $menos=$pagina-1; if($menos<1) $menos=$cantidad_paginas; if($mas>$cantidad_paginas) $mas=1;?>

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>	

    <table cellpadding="5px" class="tabla_list">
        <tr>
            <th>Id</th>
            <th>Fecha Solicitud</th>
            <th>Solicitud/Razón</th>
            <th>Dirección</th>
            <th>Estatus</th>
            <th>Acción</th>

        </tr>  
        
        <?php $cont=0; foreach ($solicitudes as $s) {?>
        <tr>
            <td><?php echo $s->getIdSolicitud()?></td>
            <td><?php echo $s->getFechaSolicitud("d-m-Y")?></td>
            <td><?php echo substr($s->getDatosInteresRazon(),0,28)?></td>
            <td><?php echo substr($s->getDireccionTraslado(),0,28)."..."?></td>
            <td>
                <?php
                    if($s->getEstatus()=='n') echo image_tag("nuevo.gif");
                    else if ($s->getEstatus()=='a') echo image_tag("moto.jpeg",array('size' => '25x25'));
                    else if ($s->getEstatus()=='c') echo image_tag("cerrado.png");
                    else if ($s->getEstatus()=='r') echo image_tag("rechazo.png");
                    else if ($s->getEstatus()=='ap') echo image_tag("aprobado.jpg",array('size' => '20x20'));
                ?>                
            </td>
            <td><a href="<?php echo url_for('gestion/asignarcorrespondencia?ids='.$s->getIdSolicitud())?>"><?php echo image_tag("busca.png",array('size' => '20x20'))?></a></td>   
            
            
        </tr>
        <?php $cont++; }?>
        
    </table>

    <table class="crud_pagina" style="width:800px;">
        <tr>
            <td colspan="2" align="left" width="50%"><?php echo $cont.' Resultados Página '.$pagina.'/'.$cantidad_paginas.')'; ?></td>
            <td colspan="3"  align="right">		    	
                <a href="javascript:void(0)" onclick="paginar('/Telesur/web/transporte.php/gestion/transportetr',1)"><?php echo image_tag("first")?></a>
                <a href="javascript:void(0)" onclick="paginar('/Telesur/web/transporte.php/gestion/transportetr',<?php echo $menos?>)"><?php echo image_tag("previous.png")?></a>
                <a href="javascript:void(0)" onclick="paginar('/Telesur/web/transporte.php/gestion/transportetr',<?php echo $mas?>)"><?php echo image_tag("next.png")?></a>
                <a href="javascript:void(0)" onclick="paginar('/Telesur/web/transporte.php/gestion/transportetr',<?php echo $cantidad_paginas?>)"><?php echo image_tag("last")?></a>
            </td>
        </tr>
    </table>   
	
<div class="leyenda">
    <table width="700px" border="0">
        <tr align="center">
            <td width="140px"><?php echo image_tag("nuevo.gif")?>&nbsp;Nuevo</td>
            <td width="140px"><?php echo image_tag("aprobado.jpg",array('size' => '30x30'))?>&nbsp;Aprobado</td>
            <td width="140px"><?php echo image_tag("moto.jpeg",array('size' => '30x30'))?>&nbsp;Asignado</td>
            <td width="140px"><?php echo image_tag("rechazo.png")?>&nbsp;Rechazado</td>
            <td width="140px"><?php echo image_tag("cerrado.png")?>&nbsp;Finalizado</td>       
        </tr>
    </table>
</div>

<div class="iconos">
<a href="<?php echo url_for('solicitud/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;Volver</a>
</div>