<script>
function enviar(accion){

	if(accion=='filtra'){
		document.getElementById('accion').value='filtrar'
		document.form.action="/principal/web/convenios.php/convenios/reporte"
	}


	if(accion=='genera'){

		if(document.getElementById("pais").value==''){
			alert("Debe Seleccionar al menos el pais");return;}
		
		//document.form.action="/convenios/web/index.php/inicio/generareporte"
		document.getElementById('accion').value='generar'
	}
	
	document.form.submit()
}
</script>

<div style="padding:100px 0 150px 0;">

<form action="<?php echo url_for('convenios/reporte')?>" method="post" name="form">
	<table>
	<tr>
		<td>Pais</td>
		<td>
			<select name="pais" id="pais" onchange="enviar('filtra')" style="width:200px;">
				<?php 
					
					if($id_pais!=''){
						
							$query="select * from operadores,pais 
									where operadores.id_status='1' 
									and operadores.id_tipo_operador='3' 
									and operadores.id_pais=pais.id_pais  and pais.id_pais='".$id_pais."'
									group by operadores.id_pais order by pais ASC";	
							
							$rs=mysql_query($query);		
							while ($row=mysql_fetch_array($rs)){?> 
								<option value="<?php echo $row['id_pais']?>"><?php echo utf8_encode($row['pais'])?></option>
				<?php 
							}
				
								$query="select * from operadores,pais 
									where operadores.id_status='1' 
									and operadores.id_tipo_operador='3' 
									and operadores.id_pais=pais.id_pais  and pais.id_pais!='".$id_pais."'
									group by operadores.id_pais order by pais ASC";	
								
							$rs=mysql_query($query);		
							while ($row=mysql_fetch_array($rs)){?> 
					
								<option value="<?php echo $row['id_pais']?>"><?php echo utf8_encode($row['pais'])?></option>
				<?php }} else {?>
				
							<option value="">Seleccionar</option>
							<?php 
								$query="select * from operadores,pais 
									where operadores.id_status='1' 
									and operadores.id_tipo_operador='3' 
									and operadores.id_pais=pais.id_pais
									group by operadores.id_pais order by pais ASC";		
								
							$rs=mysql_query($query);		
							while ($row=mysql_fetch_array($rs)){?> 
							
								<option value="<?php echo $row['id_pais']?>"><?php echo utf8_encode($row['pais'])?></option>
				<?php }
				
				
			 }?>
			</select>
		</td>
	</tr>
	
	<tr>
		<td>Operador</td>
		<td>
			<select name="operador" id="operador" style="width:200px;">
				
				
				<?php 
				
					if($id_pais!=''){
						
						if($id_operador==''){
							echo '<option value="">Seleccionar</option>';
							
							$query="select * from operadores where id_pais='".$id_pais."' and id_tipo_operador=3 and id_status=1 order by (nombre_operador) ASC";	
							$rs=mysql_query($query);		
							while ($row=mysql_fetch_array($rs)){?> 
							
								<option value="<?php echo $row['id_operador']?>"><?php echo utf8_encode($row['nombre_operador'])?></option>
					<?php }} else{
						
							$query="select * from operadores where id_pais='".$id_pais."' and id_tipo_operador=3 and id_status=1 and id_operador='".$id_operador."' order by (nombre_operador) ASC";	
							$rs=mysql_query($query);		
							while ($row=mysql_fetch_array($rs)){?> 
						
							<option value="<?php echo $row['id_operador']?>"><?php echo utf8_encode($row['nombre_operador'])?></option>
					
						
						
					<?php }
					
						$query="select * from operadores where id_pais='".$id_pais."' and id_tipo_operador=3 and id_status=1 and id_operador!='".$id_operador."' order by (nombre_operador) ASC";	
							$rs=mysql_query($query);		
							while ($row=mysql_fetch_array($rs)){?> 
						
							<option value="<?php echo $row['id_operador']?>"><?php echo utf8_encode($row['nombre_operador'])?></option>
					
					
					<?php }}} else echo '<option value="">Seleccionar</option>';?>
			</select>
		</td>
	</tr>
	
	<tr>
		<td colspan=2 align="center"><input value="Generar Reporte" type="button" onclick="enviar('genera')"></td>
	</tr>
	</table>
	<input type="hidden" name="accion" id="accion" value="">
</form>


</div >

<?php if($accion=='generar'){?>
<script>

	abrirReporte('/principal/web/convenios.php/convenios/generareporte?p=<?php echo $id_pais?>&o=<?php echo $id_operador?>');

</script>
<?php }?>