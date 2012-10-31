<div class="titulo_modulo">CAMBIO DE CLAVE</div>


<div id="valida"><?php echo "<div class='sms'>".$sf_user->getFlash('notice'); echo $sms."</div>"?></div>

<br>
<form action="<?php echo url_for("cambio_clave/index")?>" method="post" name="form">
    <table class="crud_form input200" width="400px">
	<tr>
		<th>Clave Actual</th>
		<td><input type="password" name="datos[actual]" id="actual"></td>
	</tr>
	
	<tr>
		<th>Clave Nueva</th>
		<td><input type="password" name="datos[nueva]" id="nueva"></td>
	</tr>
	
	<tr>
		<th>Confirmar</th>
		<td><input type="password" name="datos[confirmar]" id="conf"></td>
	</tr>
	
	<tr>
            <td colspan="2" style="text-align:center;"><input id="boton" type="submit" value="Cambiar" ></td>
	</tr>

</table>
</form>
<br><br>

