<?php if(isset($id_departamento) && $id_departamento!=null){?>
    <br>
    <script>
        var seconds = 1; 
        var divid = "contenido"; 
        var url = "/sit/web/index.php/ajax/sitCantidadTickets?id=0"; 
        window.onload = function(){
                refreshdiv(); // corremos inmediatamente la funcion
        }
    </script>

    <div id="contenido"></div>
<?php } ?>

<div class="jquery">

	<div class="titulo_modulo">ELIJA LA ACCIÓN QUE DESEA REALIZAR</div>
        
        <div style="color:red;background-color:#E7EEF6;">EL SIT YA TE PERMITE SUBIR AL MENOS DOS ARCHIVOS DE 2MB COMO MÁXIMO</div>
        <BR>
	
	<table border="0" width="300px" cellpadding="15px">
		<tr align="center">
			<td><a href="<?php echo url_for("solicitud/solicitud")?>"><img src="<?php echo image_path("soporte.jpg")?>" width="50px"><br>SOLICITAR SOPORTE TÉCNICO</a></td>
		</tr>
		
		<tr align="center">
			<td><a href="<?php echo url_for("solicitud/estatus")?>"><img src="<?php echo image_path("lupa.png")?>" width="50px"><br>VER EL ESTATUS DE MIS TICKETS</a></td>
		</tr>
	</table>


</div>

<a href="/principal/web/index.php">Volver&nbsp;<?php echo image_tag("volver.jpg")?></a>

<br><br><br>


<script type="text/javascript">

$(document).ready(function (){

	$(".jquery").hide(1);

	$(".jquery").fadeIn(3000);
	
    });
</script>

