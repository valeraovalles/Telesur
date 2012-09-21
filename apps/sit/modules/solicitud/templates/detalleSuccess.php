<div class="titulo_modulo">DETALLES DEL TICKET

    <?php
        if ($tickets[0]->getEstatus()=='n' || $tickets[0]->getEstatus()=='r'){
                
            echo "<h1 style='color:red;width:500px;'>Ticket enviado.</h1>";
                
        }
        
        else if ($tickets[0]->getEstatus()=='a'){
                
            echo "<h1 style='color:red;width:500px;'>Su ticket está siendo atendido por un técnico.</h1>";
                
        }
        
        else if ($tickets[0]->getEstatus()=='c'){
                
            echo "<h1 style='color:red;width:500px;'>El ticket ya fue cerrado.</h1>";
                
        }
    ?>
</div>

<table class="crud_form" style="width: 400px;" cellpadding="10px">
	<tr>
		<th>Fecha Solicitud:</th>
		<td><?php echo $tickets[0]->getFechaSolicitud("d-m-Y")?></td>
	</tr>


	<tr>
		<th>Hora Solicitud:</th>
		<td><?php echo $tickets[0]->getHoraSolicitud()?></td>
	</tr>
        
        <tr>
		<th>Unidad:</th>
		<td align="justify"><?php echo $unidad[0]->getDescripcion()?></td>
	</tr>
	
        <tr>
		<th>Solicitud:</th>
		<td align="justify"><?php echo $tickets[0]->getSolicitud()?></td>
	</tr>  
        
        <?php if($tickets[0]->getArchivos()!=''){
            
            $archivos=  explode(",", $tickets[0]->getArchivos());
            if(count($archivos)==2){
                $archivo1=  explode(".", $archivos[0]);
                $archivo2=  explode(".", $archivos[1]);

                if($archivo1[1]=='jpg' || $archivo1[1]=='png' || $archivo1[1]=='png' || $archivo1[1]=='jpeg'){
                    echo "<tr><th>Archivo 1</th><td><img height='70px' src='/Telesur/web/uploads/sit/".$archivo1[0].".".$archivo1[1]."'></td></tr>";
                } else echo "<tr><th>Archivo 1</th><td><a href='/Telesur/web/uploads/sit/".$archivo1[0].".".$archivo1[1]."'><img src='/Telesur/web/images/descarga.png' width='50px'></a></td></tr>";
                
                if($archivo2[1]=='jpg' || $archivo2[1]=='png' || $archivo2[1]=='png' || $archivo2[1]=='jpeg'){
                    echo "<tr><th>Archivo 2</th><td><img height='70px' src='/Telesur/web/uploads/sit/".$archivo2[0].".".$archivo2[1]."'></td></tr>";
                } else echo "<tr><th>Archivo 2</th><td><a href='/Telesur/web/uploads/sit/".$archivo2[0].".".$archivo2[1]."'><img src='/Telesur/web/images/descarga.png' width='50px'></a></td></tr>";

            } else{
                $archivo1=  explode(".", $archivos[0]);
                if($archivo1[1]=='jpg' || $archivo1[1]=='png' || $archivo1[1]=='png' || $archivo1[1]=='jpeg'){
                    echo "<tr><th>Archivo 1</th><td><img height='50px' src='/Telesur/web/uploads/sit/".$archivo1[0].".".$archivo1[1]."'></td></tr>";
                } else echo "<tr><th>Archivo 1</th><td><a href='/Telesur/web/uploads/sit/".$archivo1[0].".".$archivo1[1]."'><img src='/Telesur/web/images/descarga.png' width='50px'></a></td></tr>";
        
                
            }
        }
        ?>  
        
        <?php if ($tickets[0]->getEstatus()=='c'){?>
	<tr>
		<th>Fecha Solución:</th>
		<td><?php echo $tickets[0]->getFechaSolucion("d-m-Y")?></td>
	</tr>


	<tr>
		<th>Hora Solución:</th>
		<td><?php echo $tickets[0]->getHoraSolucion()?></td>
	</tr>    
        
	<tr>
		<th>Solución:</th>
		<td><?php echo $tickets[0]->getSolucion()?></td>
	</tr>
        </div>
        <?php }?>
</table>

<div class="iconos">
<a href="<?php echo url_for('solicitud/estatus')?>"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>


