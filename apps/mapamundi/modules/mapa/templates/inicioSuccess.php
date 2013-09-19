<div class="jquery">

	<div class="titulo_modulo">ELIJA LA ACCIÓN QUE DESEA REALIZAR</div>
        
	<table border="0" width="300px" cellpadding="15px">
		<tr align="center">
			<td><a href="<?php echo url_for("mapa/index")?>"><img src="<?php echo image_path("mapamundi/mapamundi2.jpg")?>" width="150px"><br>VISUALZAR MAPAMUNDI</a></td>
		</tr>

	</table>


</div>


<br>


<script type="text/javascript">

$(document).ready(function (){

	$(".jquery").hide(1);

	$(".jquery").fadeIn(3000);
	
    });
</script>


