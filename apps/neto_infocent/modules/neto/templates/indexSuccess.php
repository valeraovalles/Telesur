<script>
	function bloquea(){

		var dato=document.getElementById("proceso").value

		if(dato==52){
			document.getElementById("ver1").style.display="none"
			document.getElementById("ver2").style.display="none"
		}

		if(dato==1){
			document.getElementById("ver1").style.display=""
			document.getElementById("ver2").style.display=""
		}	
			
	}

</script>
 <br>
 
 <div class="titulo_modulo">SELECCIONE LOS PARÁMETROS</div>
 
 <div class="sms"><?php echo $sf_user->getFlash('notice')?></div>
 
 <form name="detalle" action="<?php echo url_for("neto/procesa")?>" method="POST">
     
     <table cellpadding="10" border="0" class="crud_form">
	     	<tr>
	     		<th width="100px">Proceso:</th>
	     		<td width="150px">
					<select name="datos[proceso]" id="proceso" onchange="bloquea()">
				 		 <option selected="selected" value="-1">Seleccionar...</option>
				 		 <option value="01">Nómina</option>
	             		 <option value="52">Aguinaldos</option>	 
			 		</select>
	     		</td>
	     	</tr>
	     	
	     	
	     	<tr id="ver1">
	     		<th>Período:</th>
	     		<td>
					<select name="datos[periodo]" id="periodo">
						  <option selected="selected" value="-1">Seleccionar...</option>
						  <option value="0">1era Quincena</option>
						  <option value="1">2da Quincena</option>
					</select>
	     		</td>
	     	</tr>
	     	
	     	<tr id="ver2">
	     		<th>Mes:</th>
	     		<td>
					<select name="datos[mes]" id="mes">
					  <option selected="selected" value="-1">Seleccionar...</option>
					  <option value="1">Enero</option>
					  <option value="3">Febrero</option>
					  <option value="5">Marzo</option>
					  <option value="7">Abril</option>
					  <option value="9">Mayo</option>
					  <option value="11">Junio</option>
					  <option value="13">Julio</option>
					  <option value="15">Agosto</option>
					  <option value="17">Septiembre</option>
					  <option value="19">Octubre</option>
					  <option value="21">Noviembre</option>
					  <option value="23">Diciembre</option>
					</select>
	     		</td>
	     </tr>
	
	     <tr>
	     	<th>Año:</th>
	     	<td>
	     	    <?php $fecha= date('Y'); ?>
	   	  
				<select name="datos[ano]" id="ano">
							  <option selected="selected" value="-1">Seleccione</option>
							   <?php
							  for ($i=2009; $i<=$fecha; $i++)
							  {
							  ?>
							  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							  <?php
				             /* <option value="2009">2009</option>
				              <option value="2010">2010</option>*/
							  }
							  ?>
				</select>
			  
	     	</td>
	     </tr>
	     <tr>
	     	<td colspan="2" style="text-align: center;">
	     	
	     		<input type="submit" value="Procesar">   
	 
	     	</td>
	     </tr>
     </table>
 </form>
  
  
<br><br>

<a href="/Telesur/web/index.php">Volver&nbsp;<?php echo image_tag("volver.jpg")?></a>

<br><br><br>
