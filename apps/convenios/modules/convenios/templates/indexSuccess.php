<br><br>
<table border="0" width="60%" bgcolor="#4282D4" cellpadding="2" cellspacing="0.5" style="border:1px solid #4282D4">
	<tr>
		<td colspan="3" style="color:white;">Distribución de la señal de TeleSur en el mundo <?php echo date("m-y")?></td>
	</tr>

	<tr>
		<td colspan="3" style="color:white;">OPERADORES</td>
	</tr>
	
	<tr align="left" bgcolor="white" style="font-weight:bold;">
		<td>País</td>
		<td>Tv Abierta</td>
		<td>Televidentes</td>
	</tr>
	

	<?php $col=0; foreach ($datos as $d) { if($col%2==0)$color="white"; else $color="#E5EEF7";?>
		<tr bgcolor="<?php echo $color?>">
			<td><a href="<?php echo url_for("convenios/operadorespais?idp=".$d['id_pais'])?>" style="font-weight:bold;"><?php echo $d['pais']?></a></td>
			
			<td>			
				<?php 				
				
					$query="select count(*) as suma from operadores,pais,tipooperador 
							where operadores.id_status='1' 
							and operadores.id_tipo_operador='3' 
							and operadores.id_pais='".$d['id_pais']."'
							and operadores.id_pais=pais.id_pais 
							and operadores.id_tipo_operador=tipooperador.id_tipo_operador
							group by operadores.id_pais order by pais ASC";
					
					$rs=mysql_query($query);	
					
					while ($row=mysql_fetch_array($rs)){
						$dat=$row['suma'];
						echo $dat;
					}				
				?>			
			</td>
			<td>
				<?php 				
				
					if($d['marca_refer']==0){
						$query="select * from operadores,pais,tipooperador 
								where operadores.id_status='1' 
								and operadores.id_tipo_operador='3' 
								and operadores.id_pais='".$d['id_pais']."'
								and operadores.id_pais=pais.id_pais 
								and operadores.id_tipo_operador=tipooperador.id_tipo_operador
								order by pais ASC";
						
						$rs=mysql_query($query);	
						
						$cant=0;
						while ($row=mysql_fetch_array($rs)){
							$cant=$cant+$row['cantidad_abonados'];
						}		
	
						echo number_format ($cant, 0, '.', '.') ;
					}
					else{
						$query="select * from operadores,pais,tipooperador 
								where operadores.id_status='1' 
								and operadores.id_tipo_operador='3' 
								and operadores.id_pais='".$d['id_pais']."'
								and operadores.id_pais=pais.id_pais 
								and operadores.referencia=1
								and operadores.id_tipo_operador=tipooperador.id_tipo_operador
								order by pais ASC";
						
						$rs=mysql_query($query);	
						
						$cant=0;
						while ($row=mysql_fetch_array($rs)){
							$cant=$cant+$row['cantidad_abonados'];
						}		
	
						echo number_format ($cant, 0, '.', '.') ;
						
					}
				?>			
			</td>
		<tr>
		<?php $col++;}?>
</table>
<br><br>