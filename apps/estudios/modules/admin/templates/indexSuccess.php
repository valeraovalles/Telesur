<div class="titulo_modulo">GESTIONAR SOLICITUDES</div>

<?php $mas=$pagina+1; $menos=$pagina-1; if($menos<1) $menos=$cantidad_paginas; if($mas>$cantidad_paginas) $mas=1;?>

<form action="<?php echo url_for("admin/index")?>" method="post" name="form">
<table class="crud_form select200">
    
    <?php echo $filtro;?>
    
    <tr>
        <td style="text-align: center;" colspan="2">
            <input id="boton" type="submit" value="Filtrar">
            <input id="boton" type="button" value="Limpiar" onclick="limpiar('')">
        </td>
    </tr>
    
</table>
</form>


<br>

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>	

    <table cellpadding="5px" class="tabla_list">
        <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Hora Desde</th>
            <th>Hora Hasta</th>            
            <th>Estudio</th>
            <th>Solicitante</th>
            <th>Estatus</th>
            <th>Acciones</th>
       

        </tr>  
        
        <?php $cont=0; foreach ($solicitudes as $s) {?>
        <tr>
            <td><?php echo $s->getIdSolicitud()?></td>
            <td><?php echo $s->getFechaSolicitud("d-m-Y")?></td>
            <td><?php echo $s->getHoraDesde()?></td>
            <td><?php echo $s->getHoraHasta()?></td>
            <td><?php echo $s->getEstudio()?></td>
            
            <td><?php $solicitante=SfGuardUserProfilePeer::retrieveByPK($s->getIdSolicitante()); echo ucwords($solicitante->getNombre1().' '.$solicitante->getApellido1())?></td>
             <td>
                <?php
                    if($s->getEstatus()=='a') echo image_tag("aprobado.jpg",array('size' => '20x20'));
                    else if ($s->getEstatus()=='r') echo image_tag("rechazo.png",array('size' => '20x20'));
                    else if ($s->getEstatus()=='e') echo image_tag("nuevo.gif");
                  
                ?>                
            </td>
            <td><a href="<?php echo url_for('admin/detalle?ids='.$s->getIdSolicitud())?>"><?php echo image_tag("busca.png",array('size' => '20x20'))?></a></td>   
            
            
        </tr>
        <?php $cont++; }?>
        
    </table>

    <table class="crud_pagina" style="width: 800px;">
        <tr>
            <td colspan="2" align="left" width="50%"><?php echo $cont.' Resultados Página '.$pagina.'/'.$cantidad_paginas.')'; ?></td>
            <td colspan="3"  align="right">		    	
                <a href="javascript:void(0)" onclick="paginar('/Telesur/web/estudios.php/admin/index',1)"><?php echo image_tag("first")?></a>
                <a href="javascript:void(0)" onclick="paginar('/Telesur/web/estudios.php/admin/index',<?php echo $menos?>)"><?php echo image_tag("previous.png")?></a>
                <a href="javascript:void(0)" onclick="paginar('/Telesur/web/estudios.php/admin/index',<?php echo $mas?>)"><?php echo image_tag("next.png")?></a>
                <a href="javascript:void(0)" onclick="paginar('/Telesur/web/estudios.php/admin/index',<?php echo $cantidad_paginas?>)"><?php echo image_tag("last")?></a>
            </td>
        </tr>
    </table>   
	
<div class="leyenda">
    <table width="450px" border="0">
        <tr align="center">
            <td width="150px"><?php echo image_tag("nuevo.gif")?>&nbsp;Nuevo</td>
            <td width="150px"><?php echo image_tag("aprobado.jpg",array('size' => '30x30'))?>&nbsp;Aprobado</td>
            <td width="150px"><?php echo image_tag("rechazo.png")?>&nbsp;Rechazado</td>
        
        </tr>
    </table>
</div>

<div class="iconos">
<a href="<?php echo url_for('admin/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;Volver</a>
</div>