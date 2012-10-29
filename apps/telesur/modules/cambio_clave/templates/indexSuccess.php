<script type="text/javascript">
	function validar(){
		act=document.getElementById("actual").value
		nue=document.getElementById("nueva").value
		con=document.getElementById("conf").value


		var datos=new Array;
		datos[0]=act;
		datos[1]=nue;
		datos[2]=con;

		ajax("cambio_clave/valida","valida",datos,"cambio_clave")

	}

	
</script>

<div class="titulo_modulo">CAMBIO DE CLAVE</div>


<div id="valida"><?php echo $sf_user->getFlash('notice')?></div>

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
            <td colspan="2" style="text-align:center;"><input id="boton" type="button" value="Cambiar" onclick="validar();"></td>
	</tr>

</table>
</form>
<br><br>

