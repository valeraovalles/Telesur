<div class="titulo_modulo">LISTADO DE APLICACIONES</div>

<br><br>

<div class="jquery" align="left">

	<div class="listado_aplicaciones">
            <a title="Permite consultar tus recibos de pago" href="/Telesur/web/neto_infocent.php">Neto Online<br><img src="<?php echo image_path("neto/bsf.jpeg")?>"></a><br>
	</div>
	
	
	<div class="listado_aplicaciones">
		<a title="Permite solicitar constancias de trabajo" href="/Telesur/web/constancia.php">Constancia de Trabajo<br><img src="<?php echo image_path("constancia/constancia.jpeg")?>"></a><br>
	</div>

	<div class="listado_aplicaciones">
		<a title="Permite enviar solicitudes a la direccion de sistemas informáticos" href="/Telesur/web/sit.php">SIT<br><img src="<?php echo image_path("sit/sit.jpg")?>"></a><br>
	</div>
    
        <?php if($sf_user->hasCredential('app_nomina')){?>
    	<div class="listado_aplicaciones">
		<a href="/Telesur/web/nomina.php">Nomina<br><img src="<?php echo image_path("nomina/nomina.jpeg")?>"></a><br>
	</div>
        <?php }?>
    
        <?php if($sf_user->hasCredential('app_transportexxx')){?>
	<div class="listado_aplicaciones">
		<a href="/Telesur/web/transporte.php">Transporte<br><img src="<?php echo image_path("transporte/transporte.jpg")?>"></a><br>
	</div>    
        <?php }?>
    
        <?php if($sf_user->hasCredential('app_transportexxx')){?>
	<div class="listado_aplicaciones">
		<a href="/Telesur/web/control_visitas.php">Control de Visitas<br><img src="<?php echo image_path("visitas/trabajador.png")?>"></a><br>
	</div>    
        <?php }?>
    
	
	<?php if($sf_user->hasCredential('app_licencias')){?>
	<div class="listado_aplicaciones">
		<a href="/Telesur/web/licencias.php">Licencias<br><img src="<?php echo image_path("licencias/vence.jpeg")?>"></a><br>
	</div>
	<?php }?>
	
		
	<?php if($sf_user->hasCredential('app_convenios')){?>
	<div class="listado_aplicaciones">
		<a href="/Telesur/web/convenios.php">Convenios<br><img src="<?php echo image_path("convenios/convenio.jpg")?>"></a><br>
	</div>
	<?php }?>
    
	<?php if($sf_user->hasCredential('app_creatv')){?>
	<div class="listado_aplicaciones">
		<a href="/Telesur/web/creatv.php">Creatv<br><img src="<?php echo image_path("creatv/creatv.jpg")?>"></a><br>
	</div>
	<?php }?>
    
	<div class="listado_aplicaciones">
		<a href="/Telesur/web/estudios.php">Pautas de estudios<br><img src="<?php echo image_path("estudios/estudio.jpg")?>"></a><br>
	</div>
    
    	<div class="listado_aplicaciones">
		<a href="/Telesur/web/mapamundi.php">MapaMundi<br><img src="<?php echo image_path("mapamundi/mapamundi.jpg")?>"></a><br>
	</div>
    
        <?php if($sf_user->hasCredential('app_bitacora')){?>
        <div class="listado_aplicaciones">
		<a title="Permite mantener un registro de actividades" href="/Telesur/web/bitacora.php">Bitacora<br><img src="<?php echo image_path("bitacora/bitacora.jpg")?>"></a><br>
	</div>
        <?php }?>
    
        <!--
        <?php //if($sf_user->hasCredential('app_personal')){?>
	<div class="listado_aplicaciones">
		<a href="/principal/web/personal.php">Entrada y Salida<br><img src="<?php //echo image_path("reloj.jpeg")?>"></a><br>
	</div>
        <?php //}?>
    
        <?php //if($sf_user->hasCredential('app_nominal')){?>
	<div class="listado_aplicaciones">
		<a href="/principal/web/nomina.php">Nómina<br><img src="<?php //echo image_path("nomina/nomina.jpeg")?>"></a><br>
	</div>
        <?php //}?>
	-->
    
	<?php if($sf_user->hasCredential('app_txt')){?>
	<div class="listado_aplicaciones">
		<a href="/principal/web/faov.php">Archivos FAOV<br><img src="<?php echo image_path("txt.jpg")?>"></a><br>
	</div>
	
	
	<div class="listado_aplicaciones">
		<a href="/principal/web/fju.php">Archivos FJU<br><img src="<?php echo image_path("txt.jpg")?>"></a><br>
	</div>
        
	<?php }?>

</div>

<br>

<div style="clear:both;float:none;"></div>


<script type="text/javascript">

$(document).ready(function (){

	$(".jquery").hide(1);

	$(".jquery").fadeIn(3000);
	
});
    
</script>