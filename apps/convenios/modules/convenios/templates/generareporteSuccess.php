<br><br>
<table border="0" width="850px" style="font-weight:bold;">
	<tr align="center">
		<td><?php echo $nombre_pais;?></td>
	</tr>
	
	<tr align="center">
		<td>Televisora Abierta <?php echo $total;?></td>
	</tr>

</table>

<br>

<?php 

	if($id_o!=''){
		$query="select * from operadores 
		where id_pais='".$id_pais."' and id_tipo_operador=3 and id_status=1 and id_operador='".$id_o."' order by (nombre_operador) ASC";	
		$rs=mysql_query($query);	
	}else{
		
		$query="select * from operadores 
		where id_pais='".$id_pais."' and id_tipo_operador=3 and id_status=1 order by (nombre_operador) ASC";	
		$rs=mysql_query($query);	
	}
	
	$cont=0;
	while ($row=mysql_fetch_array($rs)){	
?>
	<table border="1" width="850px">
		<tr align="center" bgcolor="#95B8E2" style="font-weight:bold;">
			<td width="200px">Operador</td>
			<td width="100px">Tipo</td>
			<td width="100px">Abonados</td>
			<td width="200px">Dirección</td>
			<td width="150px">Observaciones</td>
			<td width="100px">Estados</td>
			<td width="25px">Dial</td>
		</tr>
		
		<tr>
			<td><?php echo utf8_encode($row['nombre_operador']);?></td>
			<td>Televisora A.</td>
			<td><?php echo number_format ($row['cantidad_abonados'], 0, '.', '.');?></td>
			<td><?php echo utf8_encode($row['direccion_operador']);?></td>
			<td><?php echo utf8_encode($row['observaciones_operador']);?></td>
			
			<td>
				<?php 
					$query1="select * from estado 
					where id_pais='".$id_pais."'";	
					$rs1=mysql_query($query1);	
					
					while ($row1=mysql_fetch_array($rs1)){
						
						$id_ep=$row1['id_estado'];
						$est=$row1['estado'];
								
						$query2="select * from operadorestado 
						where id_estado='".$id_ep."' and id_operador='".$row['id_operador']."'";	
						$rs2=mysql_query($query2);	
						
						while ($row2=mysql_fetch_array($rs2)){
							if ($row2) echo $est.'<BR>';
						}
						
					}
	
				?>
			</td>
			
			<td>
			<?php 
				$query3="select * from convenio 
						where id_convenio='".$row['id_convenio']."'";	
				$rs3=mysql_query($query3);	
				
				$cont=0;
				while ($row3=mysql_fetch_array($rs3)){	echo $row3['dial'];}
			?>
			</td>
			
		</tr>
		
		<tr bgcolor="#E5EEF7">
			<td colspan=7 align="center" style="font-weight:bold;">Representantes</td>
		</tr>
		
		<?php 
		
			$query4="select * from representante 
					where id_operador='".$row['id_operador']."'";	
				$rs4=mysql_query($query4);	
				
				$cont=0;
				$row4=mysql_fetch_array($rs4);
		?>
		
		
		<tr>
			<td colspan=7><table width=100% border=0 ><tr>
					<td style="font-weight:bold;">Cargo:</td>
					<td align="left"><?php echo $row4['cargo_representante']?></td>
					<td style="font-weight:bold;">Telefono</td>
					<td align="left"><?php echo $row4['telefono_representante']?></td>
					<td style="font-weight:bold;">Fax</td>
					<td align="left"><?php echo $row4['fax_representante']?></td>
					<td style="font-weight:bold;">Celular</td>
					<td align="left"><?php echo $row4['celular_representante']?></td>
					<td style="font-weight:bold;">Email</td>
					<td align="left"><?php echo $row4['correo_representante']?></td>
			</tr></table></td>
		</tr>
		
		<tr bgcolor="#E5EEF7">
			<td colspan=8 align="center" style="font-weight:bold;">Objetos de Convenio</td>
		</tr>
		
		<?php 
			$query5="select * from objeto_convenio where id_convenio='".$row['id_convenio']."'";	
			$rs5=mysql_query($query5);	
									
			$a1=0;
			while ($row5=mysql_fetch_array($rs5)){
				
				if($row5['id_objeto']==13)$a1=1;
				if($row5['id_objeto']==1)$a2=1;
				if($row5['id_objeto']==9)$a3=1;
				if($row5['id_objeto']==5)$a4=1;
				if($row5['id_objeto']==14)$a5=1;
				if($row5['id_objeto']==11)$a5=1;
				if($row5['id_objeto']==6)$a7=1;
				if($row5['id_objeto']==10)$a8=1;
				if($row5['id_objeto']==8)$a9=1;
				if($row5['id_objeto']==12)$a10=1;
				if($row5['id_objeto']==2)$a11=1;
				if($row5['id_objeto']==3)$a12=1;
				if($row5['id_objeto']==4)$a13=1;
				if($row5['id_objeto']==7)$a14=1;
				if($row5['id_objeto']==15)$a15=1;
			
			}
			
		?>
		
		<tr bgcolor="#EAF1F9">
						<td colspan=7 align="center">
						<table width=100% border=0 >
							<tr>
								<td width="50%"><input type="checkbox" <?php if($a1==1) echo 'checked="checked"';?>> &nbsp; Acceso e intercambio de archivos audiovisuales</td>
								<td width="50%"><input type="checkbox"	<?php if($a2==1) echo 'checked="checked"';?>> &nbsp; Acceso y uso de material informativo</td>
							</tr>
							
							<tr>
								<td><input type="checkbox" <?php if($a3==1) echo 'checked="checked"';?>> &nbsp; Capacitación en educación superior</td>
								<td><input type="checkbox" <?php if($a4==1) echo 'checked="checked"';?>> &nbsp; Capacitación y colaboración en distribución, documentales, subtitulaje y operaciones en línea</td>
							</tr>
							<tr>
								<td><input type="checkbox" <?php if($a5==1) echo 'checked="checked"';?>> &nbsp; Coproducción de contenidos televisivos</td>
								<td><input type="checkbox" <?php if($a6==1) echo 'checked="checked"';?>> &nbsp; Doblaje subtitulaje</td>
							</tr>
							<tr>
								<td><input type="checkbox" <?php if($a7==1) echo 'checked="checked"';?>> &nbsp; Dotación de espacio físico, servicios técnicos, servicios de estudios, Up link</td>
								<td><input type="checkbox" <?php if($a8==1) echo 'checked="checked"';?>> &nbsp; Formación, investigación y estudio de TV públicas</td>
							</tr>
							<tr>
								<td><input type="checkbox" <?php if($a9==1) echo 'checked="checked"';?>> &nbsp; Interconexión satelital, centro de acopio de materiales producidos</td>
								<td><input type="checkbox" <?php if($a10==1) echo 'checked="checked"';?>> &nbsp; Promoción de programas</td>
							</tr>
							<tr>
								<td><input type="checkbox" <?php if($a11==1) echo 'checked="checked"';?>> &nbsp; Retransmisión de la señal</td>
								<td><input type="checkbox" <?php if($a12==1) echo 'checked="checked"';?>> &nbsp; Retransmisión de programación</td>
							</tr>
							<tr>
								<td><input type="checkbox" <?php if($a13==1) echo 'checked="checked"';?>> &nbsp; Spot publicitario</td>
								<td><input type="checkbox" <?php if($a14==1) echo 'checked="checked"';?>> &nbsp; Suministro de servicios de textos, fotografía e infografía y contenidos</td>
							</tr>
							<tr>
								<td colspan="2"><input type="checkbox" <?php if($a15==1) echo 'checked="checked"';?>> &nbsp; Receptor entregado</td>
							</tr>
						</table></td></tr>
	
	
	</table>
	<br>
<?php }?>
<br><br>


<a href="#" onclick="window.print()">IMPRIMIR</a>&nbsp;&nbsp;&nbsp;
<a href="#" onclick="window.close()">CERRAR</a>