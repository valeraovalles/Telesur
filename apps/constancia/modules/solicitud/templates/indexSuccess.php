<div class="titulo_modulo">ELIJA LA ACCIÓN QUE DESEA REALIZAR</div>
	
<table cellpadding="15px">
		
    <?php if($bloquea==1){?>
        <tr align="center">
            <td><a href="<?php echo url_for("solicitud/solicitud")?>"><img src="<?php echo image_path("constancia/constancia.jpeg")?>" width="50px"><br>SOLICITAR CONSTANCIA DE TRABAJO</a></td>
        </tr>
    <?php }else{?>
        <tr align="center">
            <td style="color:red;font-size: 14px;">LAS SOLICITUDES SON LOS DÍAS <br> LUNES Y MARTES</td>
        </tr>
    <?php }?>
		
	<tr align="center">
            <td><a href="<?php echo url_for("solicitud/estatus")?>"><img src="<?php echo image_path("constancia/lupa.png")?>" width="50px"><br>VER EL ESTATUS DE MIS CONSTANCIAS</a></td>
	</tr>
</table>

<div class="iconos">
<a href="/Telesur/web/">Volver&nbsp;<?php echo image_tag("volver.jpg")?></a>
</div>
