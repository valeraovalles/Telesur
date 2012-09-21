<div class="titulo_modulo">ELIJA LA ACCIÓN QUE DESEA REALIZAR</div>
	
	<table border="0" width="600px" cellpadding="15px">
		<tr align="center">
			<td><a href="<?php echo url_for("solicitud/formulariotransporte")?>"><img src="<?php echo image_path("transporte/transporte.jpg")?>" width="70px"><br>SOLICITAR TRANSPORTE</a></td>
                        <td><a href="<?php echo url_for("solicitud/formulariocorrespondencia")?>"><img src="<?php echo image_path("transporte/correspondencia.jpeg")?>" width="50px"><br>CORRESPONDENCIA</a></td>
                        
		</tr>
                
                
                <tr align="center">
			
                    <td colspan="2"><a href="<?php echo url_for("solicitud/estatus")?>"><img src="<?php echo image_path("transporte/lupa.png")?>" width="50px"><br>VER MIS SOLICITUDES</a></td>
		</tr>           

	</table>

<div class="iconos">
    <a href="/principal/web"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>