<?php
require_once("Connections/conexion.php");
require_once("principal.php");
include("Clases/class.BaseDatos.php");
include("Clases/class.Usuario.php");
include("Clases/class.Proyecto.php");
include("Clases/class.Glosario.php");
include("Clases/class.Comentario.php");
include("Clases/class.Conexion.php");
include("Clases/class.Tema.php");
include("Clases/class.Privilegios.php");
include("Clases/class.New_empleado.php");
include("Clases/class.Libro.php");
include("Clases/class.Foro.php");
include("Clases/class.Prestatario.php");
include("Clases/class.Reportes.php");
include("Clases/class.Prestamo.php");
include("Clases/class.Notificacion.php");
include("Clases/class.Solicitudes.php");
include("Clases/class.Actividad.php");



//************************** FUNCIONES DE CABINA *********************************

//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||



function nameDate($fecha='')//formato: 00/00/0000
{ 	
	$objResponse = new xajaxResponse("iso-8859-1");
	
	
	$fecha= empty($fecha) ? date('d/m/Y') : $fecha;
	$dias = array('domingo','lunes','martes','miércoles','jueves','viernes','sábado');
	$dd   = explode('/',$fecha);
	$ts   = mktime(0,0,0,$dd[1],$dd[0],$dd[2]);
	$algo = $dias[date('w',$ts)].'/'.date('m',$ts).'/'.date('Y',$ts);
	$algo2 = date('w',$ts);
	$algo3 = $algo." ".$algo2;
	
	
	$objResponse->addAssign("allll","innerHTML", $algo3);

	return $objResponse;
}

//-------------------------------------------------------

function cabinas_nombre()
{
	$objResponse = new xajaxResponse("iso-8859-1");
	
	//$objResponse->addAlert(" sub categoria ".$id);		
	
	$query_produtor = "SELECT * FROM est_modulo ORDER BY id_modulo ASC";
	$rs_produtor = mysql_query($query_produtor) or die (mysql_error ());
	
	$totalRows_produtor = mysql_num_rows($rs_produtor);
	
	//$objResponse->addAssign("disciplina","value", 1000);		
	
	$discip = "<select id=\"cabina\" name=\"cabina\">
				<option value=\"1000\">Estudio a pautar </option>";

	for($i=0; $i<$totalRows_produtor; $i++)
	{
		$row_produtor = mysql_fetch_assoc($rs_produtor);
		$discip .= "<option value=\"".$row_produtor['id_modulo']."\" onclick=\"colocar_nombre(this.value)\" >".$row_produtor['modulo']."</option>";
	}
	
	$discip .= "</select> ";
		
	$objResponse->addAssign("mod","innerHTML", $discip);

	return $objResponse;
}


//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

function dias_nombre()
{
	$objResponse = new xajaxResponse("iso-8859-1");
	
	//$objResponse->addAlert(" sub categoria ".$id);		
	
	$query_produtor = "SELECT * FROM est_dia_semana ORDER BY id_dia ASC";
	$rs_produtor = mysql_query($query_produtor) or die (mysql_error ());
	
	$totalRows_produtor = mysql_num_rows($rs_produtor);
	
	//$objResponse->addAssign("disciplina","value", 1000);		
	
	$discip = "<select id=\"diaxxx\" name=\"diaxxx\">
				<option value=\"1000\">Dias de pautas</option>";

	for($i=0; $i<$totalRows_produtor; $i++)
	{
		$row_produtor = mysql_fetch_assoc($rs_produtor);
		$discip .= "<option value=\"".$row_produtor['id_dia']."\" onclick=\"colocar_dia(this.value)\" >".$row_produtor['dia']."</option>";
	}
	
	$discip .= "</select> ";
		
	$objResponse->addAssign("dia","innerHTML", $discip);

	return $objResponse;
}

//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
function productores()
{
	$objResponse = new xajaxResponse("iso-8859-1");
	
	//$objResponse->addAlert(" sub categoria ".$id);		
	
	$query_produtor = "SELECT * FROM est_productor_asignado ORDER BY prod_asignado ASC";
	$rs_produtor = mysql_query($query_produtor) or die (mysql_error ());
	
	$totalRows_produtor = mysql_num_rows($rs_produtor);
	
	//$objResponse->addAssign("disciplina","value", 1000);		
	
	$discip = "<select id=\"produtor_asignado\" name=\"produtor_asignado\" onClick=\"xajax_productores($id);\">
				<option value=\"1000\">Seleccione Responsable</option>";

	for($i=0; $i<$totalRows_produtor; $i++)
	{
		$row_produtor = mysql_fetch_assoc($rs_produtor);
		$discip .= "<option value=\"".$row_produtor['id_productorasig']."\" >".$row_produtor['prod_asignado']."</option>";
	}
	
	$discip .= "</select> ";
		
	$objResponse->addAssign("prod_asig","innerHTML", $discip);

	return $objResponse;
}



//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
function productores_nombre()
{
	$objResponse = new xajaxResponse("iso-8859-1");
	
	//$objResponse->addAlert(" sub categoria ".$id);		
	
	$query_produtor = "SELECT * FROM est_productor ORDER BY productor ASC";
	$rs_produtor = mysql_query($query_produtor) or die (mysql_error ());
	
	$totalRows_produtor = mysql_num_rows($rs_produtor);
	
	//$objResponse->addAssign("disciplina","value", 1000);		
	
	$discip = "<select id=\"postprodutor\" name=\"postprodutor\" onClick=\"xajax_productores_nombre($id);\">
				<option value=\"1000\">Seleccione Post-Produtor</option>";

	for($i=0; $i<$totalRows_produtor; $i++)
	{
		$row_produtor = mysql_fetch_assoc($rs_produtor);
		$discip .= "<option value=\"".$row_produtor['id_productor']."\" >".$row_produtor['productor']."</option>";
	}
	
	$discip .= "</select> ";
		
	$objResponse->addAssign("prod","innerHTML", $discip);

	return $objResponse;
}

//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

function programa_nombre()
{
	$objResponse = new xajaxResponse("iso-8859-1");
	
	//$objResponse->addAlert(" sub categoria ".$id);		
	
	$query_programa = "SELECT * FROM est_programa ORDER BY programa ASC";
	$rs_programa = mysql_query($query_programa) or die (mysql_error ());
	
	$totalRows_programa = mysql_num_rows($rs_programa);
	
	//$objResponse->addAssign("disciplina","value", 1000);		
	
	$discip = "<select id=\"programa\" name=\"programa\" onClick=\"xajax_programa_nombre($id);\">
				<option value=\"1000\">Seleccione Producto</option>";

	for($i=0; $i<$totalRows_programa; $i++)
	{
		$row_programa = mysql_fetch_assoc($rs_programa);
		$discip .= "<option value=\"".$row_programa['id_programa']."\" >".$row_programa['programa']."</option>";
	}
	
	$discip .= "</select> ";
		
	$objResponse->addAssign("progr","innerHTML", $discip);

	return $objResponse;
}

//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

function turno_desde()
{
	$objResponse = new xajaxResponse("iso-8859-1");
	
	//$objResponse->addAlert(" sub categoria ".$id);		
	
	$query_desde = "SELECT * FROM est_turnos ORDER BY id_turno ASC";
	$rs_desde = mysql_query($query_desde) or die (mysql_error ());
	
	$totalRows_desde = mysql_num_rows($rs_desde);
	
	//$objResponse->addAssign("disciplina","value", 1000);		
	
	$discip = "<select id=\"desde\" name=\"desde\">
				<option value=\"1000\">Seleccione Turno</option>";

	for($i=0; $i<$totalRows_desde; $i++)
	{
		$row_desde = mysql_fetch_assoc($rs_desde);
		$discip .= "<option value=\"".$row_desde['id_turno']."\" >".$row_desde['turno']."</option>";
	}
	
	$discip .= "</select> ";
		
	$objResponse->addAssign("des","innerHTML", $discip);

	return $objResponse;
}

//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

function turno_hasta()
{
	$objResponse = new xajaxResponse("iso-8859-1");
	
	//$objResponse->addAlert(" sub categoria ".$id);		
	
	$query_hasta = "SELECT * FROM est_turnos ORDER BY id_turno ASC";
	$rs_hasta = mysql_query($query_hasta) or die (mysql_error ());
	
	$totalRows_hasta = mysql_num_rows($rs_hasta);
	
	//$objResponse->addAssign("disciplina","value", 1000);		
	
	$discip = "<select id=\"hasta\" name=\"hasta\">
				<option value=\"1000\">Seleccione Turno</option>";

	for($i=0; $i<$totalRows_hasta; $i++)
	{
		$row_hasta = mysql_fetch_assoc($rs_hasta);
		$discip .= "<option value=\"".$row_hasta['id_turno']."\" >".$row_hasta['turno']."</option>";
	}
	
	$discip .= "</select> ";
		
	$objResponse->addAssign("has","innerHTML", $discip);

	return $objResponse;
}


//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

function nombre_cabina_seleccionada($id)
{
	$objResponse = new xajaxResponse("iso-8859-1");
	
	//$objResponse->addAlert(" sub categoria ".$id);		
	
	$query_hasta = "SELECT * FROM est_modulo WHERE id_modulo = '$id'";
	$rs_hasta = mysql_query($query_hasta) or die (mysql_error ());
	$row_hasta = mysql_fetch_assoc($rs_hasta);
	$nom = $row_hasta['modulo'];
	$id_m = $row_hasta['id_modulo'];
	
	//$objResponse->addAlert(" id del modulo ".$id_m);		
		
	$objResponse->addAssign("nombre_cabina","innerHTML", $nom);
	$objResponse->addAssign("cabina_id","value", $id_m);

	return $objResponse;
}

//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

function nombre_dia_seleccionado($id)
{
	$objResponse = new xajaxResponse("iso-8859-1");
	
	//$objResponse->addAlert(" sub categoria ".$id);		
	
	$query_hasta = "SELECT * FROM est_dia_semana WHERE id_dia = '$id'";
	$rs_hasta = mysql_query($query_hasta) or die (mysql_error ());
	$row_hasta = mysql_fetch_assoc($rs_hasta);
	$nom = $row_hasta['dia'];
	$id = $row_hasta['id_dia'];
		
	$objResponse->addAssign("nombre_dia","innerHTML", $nom);
	$objResponse->addAssign("diaoculto","value", $id);

	return $objResponse;
}

//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

function agregar_fila_pautada_editar($cab, $dia, $edit, $idpauta)
{
    $obj = new xajaxResponse();		
	
	
	$query_pauta = "SELECT a.*, b.*, c.*, d.*, e.*, f.*
					FROM est_pauta a, est_dia_semana b, est_modulo c, est_productor d, est_programa e, est_turnos f
	 				WHERE a.id_pauta = '".$idpauta."' and
						  a.id_modulo = '".$cab."' and 
					      a.id_dia = '".$dia."' and 
						  a.id_modulo = c.id_modulo and
						  a.id_dia = b.id_dia  and
						  a.id_productor = d.id_productor and
						  a.id_programa = e.id_programa and
						  a.desde = f.id_turno ";
						  
	//$obj->addAlert(" entro cabina ".$query_pauta);			
		
						  
	$rs_pauta = mysql_query($query_pauta) or die (mysql_error ());
	$row_pauta = mysql_fetch_assoc($rs_pauta);
	$totalRows = mysql_num_rows($rs_pauta);
	
	$id_pauta = $row_pauta['id_pauta'];
	$prog_dia = $row_pauta['id_dia'];
	$prog_productor = $row_pauta['id_productor'];
	$progrrr = $row_pauta['id_programa'];
	$prog_des = $row_pauta['id_turno'];
	
	$query_pauta2 = "SELECT a.*, f.*
					FROM est_pauta a, est_turnos f
	 				WHERE a.id_pauta = '".$id_pauta."' and 
						  a.hasta = f.id_turno ";
						  
	//$obj->addAlert(" entro cabina ".$query_pauta);
	$rs_pauta2  = mysql_query($query_pauta2) or die (mysql_error ());
	$row_pauta2 = mysql_fetch_assoc($rs_pauta2);
	
	$prog_has = $row_pauta2['id_turno'];
	
	
	/*$obj->addAlert(" entro cabina ".$cab);
	$obj->addAlert(" entro diasss ".$dia);

	$obj->addAlert(" diasss ".$prog_dia);	
	$obj->addAlert(" productor ".$prog_productor);	
	$obj->addAlert(" programa ".$progrrr);	
	$obj->addAlert(" desde ".$prog_des);	
	$obj->addAlert(" hasta ".$prog_has);	*/						
		   	  		  									
    $obj->addAssign("produtor","value", $prog_productor);	
	$obj->addAssign("programa","value", $progrrr);	
	$obj->addAssign("desde",   "value", $prog_des);	
	$obj->addAssign("hasta",   "value", $prog_has);	
	$obj->addAssign("diaxxx",  "value", $dia);		
	$obj->addAssign("editaroculto",  "value", $edit);	
	$obj->addAssign("pautaoculto",  "value", $id_pauta);	

    return $obj;

}

//---------------------------------------------------------------------------------

function fila_pautada_editar_solicitud($cab, $dia, $edit, $idpauta, $tpauta)
{
    $obj = new xajaxResponse();		
	
	
	$query_pauta = "SELECT a.*, b.*, c.*, d.*, e.*, f.*
					FROM est_pauta a, est_dia_semana b, est_modulo c, est_productor d, est_programa e, est_turnos f
	 				WHERE a.id_pauta = '".$idpauta."' and
						  a.id_modulo = '".$cab."' and 
					      a.id_dia = '".$dia."' and 
						  a.id_modulo = c.id_modulo and
						  a.id_dia = b.id_dia  and
						  a.id_productor = d.id_productor and
						  a.id_programa = e.id_programa and
						  a.desde = f.id_turno ";
						  
	//$obj->addAlert(" entro cabina ".$query_pauta);			
		
						  
	$rs_pauta = mysql_query($query_pauta) or die (mysql_error ());
	$row_pauta = mysql_fetch_assoc($rs_pauta);
	$totalRows = mysql_num_rows($rs_pauta);
	
	$id_pauta = $row_pauta['id_pauta'];
	$prog_dia = $row_pauta['id_dia'];
	$prog_productor = $row_pauta['id_productor'];
	$progrrr = $row_pauta['id_programa'];
	$prog_des = $row_pauta['id_turno'];
	
	$query_pauta2 = "SELECT a.*, f.*
					FROM est_pauta a, est_turnos f
	 				WHERE a.id_pauta = '".$id_pauta."' and 
						  a.hasta = f.id_turno ";
						  
	//$obj->addAlert(" entro cabina ".$query_pauta);
	$rs_pauta2  = mysql_query($query_pauta2) or die (mysql_error ());
	$row_pauta2 = mysql_fetch_assoc($rs_pauta2);
	
	$prog_has = $row_pauta2['id_turno'];
	
	
	/*$obj->addAlert(" entro cabina ".$cab);
	$obj->addAlert(" entro diasss ".$dia);

	$obj->addAlert(" diasss ".$prog_dia);	
	$obj->addAlert(" productor ".$prog_productor);	
	$obj->addAlert(" programa ".$progrrr);	
	$obj->addAlert(" desde ".$prog_des);	
	$obj->addAlert(" hasta ".$prog_has);	*/						
		   	  		  									
    $obj->addAssign("produtor","value", $prog_productor);	
	$obj->addAssign("programa","value", $progrrr);	
	$obj->addAssign("desde",   "value", $prog_des);	
	$obj->addAssign("hasta",   "value", $prog_has);	
	$obj->addAssign("diaxxx",  "value", $dia);		
	$obj->addAssign("editaroculto",  "value", $edit);	
	$obj->addAssign("pautaoculto",  "value", $id_pauta);	

    return $obj;

}


// copia de la anterior que si funciona

/*

function agregar_fila_pautada_editar($cab, $dia)
{
    $obj = new xajaxResponse();		
	
	$dev = inicializar_tabla();		
	
	$query_pauta = "SELECT a.*, b.*, c.*, d.*, e.*, f.*
					FROM pauta a, dia_semana b, modulo c, productor d, programa e, turnos f
	 				WHERE a.id_modulo = '".$cab."' and 
					      a.id_dia = '".$dia."' and 
						  a.id_modulo = c.id_modulo and
						  a.id_dia = b.id_dia  and
						  a.id_productor = d.id_productor and
						  a.id_programa = e.id_programa and
						  a.desde = f.id_turno ";
						  
	//$obj->addAlert(" entro cabina ".$query_pauta);
						  
	$rs_pauta = mysql_query($query_pauta) or die (mysql_error ());
	$row_pauta = mysql_fetch_assoc($rs_pauta);
	$totalRows = mysql_num_rows($rs_pauta);
	
	//$obj->addAlert(" entro cabina ".$cab);
	//$obj->addAlert(" entro diasss ".$dia);
	//$obj->addAlert(" total consulta ".$totalRows);
	//$obj->addAlert(" diasss ".$prog_dia);	
	//$obj->addAlert(" productor ".$prog_productor);	
	//$obj->addAlert(" programa ".$progrrr);	
	//$obj->addAlert(" desde ".$prog_des);	
	//$obj->addAlert(" hasta ".$prog_has);	
	//return $obj;
	
	
//	$cant_filas = $form['campo_cant_filas']; 	
		$i=1;
	   do
	   {	

	    $id_pauta = $row_pauta['id_pauta'];
	   	$prog_dia = $row_pauta['dia'];
		$prog_productor = $row_pauta['productor'];
		$progrrr = $row_pauta['programa'];
		$prog_des = $row_pauta['turno'];
		
		$query_pauta2 = "SELECT a.*, f.*
					FROM pauta a, turnos f
	 				WHERE a.id_pauta = '".$id_pauta."' and 
						  a.hasta = f.id_turno ";
						  
		//$obj->addAlert(" entro cabina ".$query_pauta);
						  
		$rs_pauta2  = mysql_query($query_pauta2) or die (mysql_error ());
		$row_pauta2 = mysql_fetch_assoc($rs_pauta2);
		
		
		$prog_has = $row_pauta2['turno'];
		   	  		  							
  	      //$obj->addAlert($i." entro aqui cantidad i");
	      $dev .= "<tr id ='fila-".$i."' style='background:#FBFBFB' onMouseOver='prender_fila(this)' onMouseOut='apagar_fila(this)' onClick='js_editar_fila_pautada(this)'>	
		<td ><div align=\"center\">
		<input name='campo_dia".$i."' type='hidden' value='".$row_pauta['id_dia']."'> 
		<font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
		".$prog_dia." </font></div></td>	
		<td ><div align=\"center\">
		<input name='campo_prod".$i."' type='hidden' value='".$row_pauta['id_produtor']."'> 
		<font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
		".$prog_productor."</font></div></td>
		<td ><div align=\"center\">
		<input name='campo_prog".$i."' type='hidden' value='".$row_pauta['id_programa']."'> 
		<font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
		".$progrrr."</font></div></td>    
		<td ><div align=\"center\">
		<input name='campo_desde".$i."' type='hidden' value='".$row_pauta['desde']."'> 
		<font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
		".$prog_des."</font></div></td>         		
		<td ><div align=\"center\">
		<input name='campo_hasta".$i."' type='hidden' value='".$row_pauta['hasta']."'> 
		<font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
		".$prog_has." </font></div></td>
		</tr>";
		$i++;
 		//$obj->addAlert($form['campo_cont_responsables_fila'.$i]);
		}while($row_pauta = mysql_fetch_assoc($rs_pauta));
				
				
	$dev.="</table>";	
		
    $obj->addAssign("div_celdas","innerHTML",$dev);	
	
	$obj->addAssign("campo_cant_filas","value",$totalRows);
		
    $obj->addAssign("produtor","value", 1000);	
	$obj->addAssign("programa","value", 1000);	
	$obj->addAssign("desde","value", 1000);	
	$obj->addAssign("hasta","value", 1000);	
	
	if($cant_filas > 1)
	{
		$obj->addAssign("boton_registrar","style.visibility","visible");
	}
	else
	{
		$obj->addAssign("boton_registrar","style.visibility","hidden");
	}
	 
	$obj->addAssign("boton_guardar","style.visibility","visible");
	$obj->addAssign("boton_modificar","style.visibility","hidden");

	
    return $obj;

}




*/

//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

function inicializar_tabla()
{
  $dev = "<table width='600' border='0' align='center'>  			
			<tr  bgcolor='#DFF4F2'>  
			<td colspan=\"5\" ><div align='center' ><font color='#603913' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
			VISTA PREVIA DE LO PAUTADO
			</font></div></td>
	 		</tr>
			<tr  bgcolor='#DFF4F2'>  
			  <td width='100' ><div align='center' ><font color='#603913' style='font-family:Arial ; font-size:11px; font-weight:bold;'>DIA</font></div></td>
			  <td width='150' ><div align='center' ><font color='#603913' style='font-family:Arial ; font-size:11px; font-weight:bold;'>PRODUCTOR</font></div></td>
       		  <td width='150' ><div align='center' ><font color='#603913' style='font-family:Arial ; font-size:11px; font-weight:bold;'>PROGRAMA </font></div></td>
			  <td width='100' ><div align='center' ><font color='#603913' style='font-family:Arial ; font-size:11px; font-weight:bold;'>TURNO DESDE </font></div></td>
			  <td width='100' ><div align='center' ><font color='#603913' style='font-family:Arial ; font-size:11px; font-weight:bold;'>TURNO HASTA</font></div></td>
	        </tr>
			<tr></tr>
			
			";		
	/*
	<td width='150' ><div align='center' ><font color='#603913' style='font-family:Arial ; font-size:11px; font-weight:bold;'>CABINA</font></div></td>
    
	*/		
	return $dev;
}

//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

function validar_rangos($form)
{
    $objResponse = new xajaxResponse();	
	
	$cant = $form['campo_cant_filas']; 
	
	$objResponse->addAlert($cant." valor controlador");			
	$var = 0;	
	for($i=1; $i < $cant; $i++)
	{
	
	$objResponse->addAlert($form['campo_desde'.$i]." desde comparo ya tengo ");
	$objResponse->addAlert($form['campo_hasta'.$i]." hasta comparo ya tengo ");
	$objResponse->addAlert($form['desde']." desde actual");
	$objResponse->addAlert($form['desde']." desde actual");
	
	/*(($form['campo_desde'.$i] < $form['desde']) && ($form['desde'] < $form['campo_hasta'.$i])) ||  
		    (($form['campo_desde'.$i] < $form['hasta']) && ($form['hasta'] < $form['campo_hasta'.$i])) 
	
	*/
	
	 //return $objResponse;
	 
	
		if( (($form['campo_desde'.$i] < $form['desde']) && ($form['desde'] < $form['campo_hasta'.$i])) || 			 			 			  			 
		    (($form['campo_desde'.$i] < $form['hasta']) && ($form['hasta'] < $form['campo_hasta'.$i])) )
		{
			//$objResponse->addAlert(" aumento la probabilidad ");
			$var++;
		}
		else
		{			
		}
	}
	
	//$objResponse->addAlert(" var = ".$var);
						
	if($var > 0)
	{
		$objResponse->addAlert("No puede crear ese bloque de horas, conicide con uno existente");
	}
	else
	{	
		$objResponse->addScript("xajax_agregar_fila_pautada(xajax.getFormValues('form1'),true);");		
	}
				
							
    return $objResponse;

}

//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

function validar_rangos2($form)
{
    $objResponse = new xajaxResponse();	
	
	$cant = $form['campo_cant_filas']; 
	
	//$objResponse->addAlert($cant." valor controlador");		
	$var = 0;
	
	for($i=1; $i < $cant; $i++)
	{
	
	/*$objResponse->addAlert($form['campo_desde'.$i]." desde antes");
	$objResponse->addAlert($form['campo_hasta'.$i]." hasta antes");
	$objResponse->addAlert($form['desde']." desde actual");*/
	
	//return $objResponse;	 	 	 
	
		if(   (($form['campo_desde'.$i] < $form['desde']) && ($form['desde'] < $form['campo_hasta'.$i])) || 			 			 			  			 
		     (($form['campo_desde'.$i] < $form['hasta']) && ($form['hasta'] < $form['campo_hasta'.$i])) )
		{
			//$objResponse->addAlert(" aumento la probabilidad ");
			$var++;
		}
		else
		{			
		}
	}
	
	//$objResponse->addAlert(" var = ".$var);
						
	if($var > 0)
	{
		$objResponse->addAlert("No puede crear ese bloque de horas, conicide con uno existente");
	}
	else
	{	
		$objResponse->addScript("xajax_modificar_fila_pautada(xajax.getFormValues('form1'),true);");		
	}
				
							
    return $objResponse;

}


//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

function agregar_fila_pautada($form,$es_boton)
{
    $obj = new xajaxResponse();	
	$aux = "-";
    $dev = inicializar_tabla();	
	$fecha_real =  date("y/m/d");
	
	$cant_filas = $form['campo_cant_filas']; 	
	
	if($es_boton == 'true')
	{
	   for($i=1; $i < $cant_filas; $i++)
	   {
	   	  
		  $query_dia = "SELECT b.dia
						 FROM est_dia_semana b
						 WHERE b.id_dia = ".$form['campo_dia'.$i]."";
		  $Recornt_dia = mysql_query($query_dia) or die(mysql_error());
		  $row_dia = mysql_fetch_assoc($Recornt_dia);
		  $prog_dia = $row_dia['dia'];	
		  
		  $query_productor = "SELECT b.productor
						 FROM est_productor b
						 WHERE b.id_productor = ".$form['campo_prod'.$i]."";
		  $Recornt_productor = mysql_query($query_productor) or die(mysql_error());
		  $row_productor = mysql_fetch_assoc($Recornt_productor);
		  $prog_productor = $row_productor['productor'];	
		  
		  
		  $query_nt11 = "SELECT b.programa
						 FROM est_programa b
						 WHERE b.id_programa = ".$form['campo_prog'.$i]."";
		  $Recornt11 = mysql_query($query_nt11) or die(mysql_error());
		  $row_nt11 = mysql_fetch_assoc($Recornt11);
		  $progrrr = $row_nt11['programa'];
		  
		  $query_des = "SELECT b.turno
						 FROM est_turnos b
						 WHERE b.id_turno = ".$form['campo_desde'.$i]."";
		  $Recornt_des = mysql_query($query_des) or die(mysql_error());
		  $row_des = mysql_fetch_assoc($Recornt_des);
		  $prog_des = $row_des['turno'];
		  
		  $query_has = "SELECT b.turno
						 FROM est_turnos b
						 WHERE b.id_turno = ".$form['campo_hasta'.$i]."";
		  $Recornt_has = mysql_query($query_has) or die(mysql_error());
		  $row_has = mysql_fetch_assoc($Recornt_has);
		  $prog_has = $row_has['turno'];		  
		  
							
  	      //$obj->addAlert($i." entro aqui cantidad i");
	      $dev .="<tr id ='fila-".$i."' style='background:#FBFBFB' onMouseOver='prender_fila(this)' onMouseOut='apagar_fila(this)' onClick='js_editar_fila_pautada(this)'>
  <td ><div align=\"center\">
 <input name='campo_dia".$i."' type='hidden' value='".$form['campo_dia'.$i]."'>
 <font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
 ".$prog_dia."</font></div></td>
 <td ><div align=\"center\">
 <input name='campo_prod".$i."' type='hidden' value='".$form['campo_prod'.$i]."'>
 <font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
 ".$prog_productor."</font></div></td>
 <td ><div align=\"center\">
 <input name='campo_prog".$i."' type='hidden' value='".$form['campo_prog'.$i]."'> 
 <font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
 ".$progrrr."</font></div></td>
 <td ><div align=\"center\">
 <input name='campo_desde".$i."' type='hidden' value='".$form['campo_desde'.$i]."'>
 <font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
 ".$prog_des."</font></div></td>
 <td ><div align=\"center\">
 <input name='campo_hasta".$i."' type='hidden' value='".$form['campo_hasta'.$i]."'> 
 <font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
 ".$prog_has." </font></div></td>
       			</tr>";

 		//$obj->addAlert($form['campo_cont_responsables_fila'.$i]);
		}
	} 
	else
	{

	} 
	

	if($es_boton == 'true')
	{	
		  
		  $query_dia2 = "SELECT b.dia
						 FROM est_dia_semana b
						 WHERE b.id_dia = ".$form['diaoculto']."";
					//echo $query_nt;
		  $Recornt_dia2 = mysql_query($query_dia2) or die(mysql_error());
		  $row_dia2 = mysql_fetch_assoc($Recornt_dia2);
		  $prog_dia2 = $row_dia2['dia'];
		  
		  $query_productor2 = "SELECT b.productor
						 FROM est_productor b
						 WHERE b.id_productor = ".$form['produtor']."";
					//echo $query_nt;
		  $Recornt_productor2 = mysql_query($query_productor2) or die(mysql_error());
		  $row_productor2 = mysql_fetch_assoc($Recornt_productor2);
		  $prog_productor2 = $row_productor2['productor'];
		  		  
		  $query_nt22 = "SELECT b.programa
						 FROM est_programa b
						 WHERE b.id_programa = ".$form['programa']."";
					//echo $query_nt;
		  $Recornt22 = mysql_query($query_nt22) or die(mysql_error());
		  $row_nt22 = mysql_fetch_assoc($Recornt22);
		  $progr22 = $row_nt22['programa'];	
		  
		  $query_des2 = "SELECT b.turno
						 FROM est_turnos b
						 WHERE b.id_turno = ".$form['desde']."";
		  $Recornt_des2 = mysql_query($query_des2) or die(mysql_error());
		  $row_des2 = mysql_fetch_assoc($Recornt_des2);
		  $prog_des2 = $row_des2['turno'];
		  
		  $query_has2 = "SELECT b.turno
						 FROM est_turnos b
						 WHERE b.id_turno = ".$form['hasta']."";
		  $Recornt_has2 = mysql_query($query_has2) or die(mysql_error());
		  $row_has2 = mysql_fetch_assoc($Recornt_has2);
		  $prog_has2 = $row_has2['turno'];
		  
$dev .= "<tr id ='fila-".$cant_filas."' style='background:#FBFBFB' onMouseOver='prender_fila(this)' onMouseOut='apagar_fila(this)' onClick='js_editar_fila_pautada(this)'>	
<td ><div align=\"center\">
<input name='campo_dia".$cant_filas."' type='hidden' value='".$form['diaoculto']."'> 
<font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
".$prog_dia2." </font></div></td>	
<td ><div align=\"center\">
<input name='campo_prod".$cant_filas."' type='hidden' value='".$form['produtor']."'> 
<font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
".$prog_productor2."</font></div></td>
<td ><div align=\"center\">
<input name='campo_prog".$cant_filas."' type='hidden' value='".$form['programa']."'> 
<font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
".$progr22."</font></div></td>    
<td ><div align=\"center\">
<input name='campo_desde".$cant_filas."' type='hidden' value='".$form['desde']."'> 
<font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
".$prog_des2."</font></div></td>         		
<td ><div align=\"center\">
<input name='campo_hasta".$cant_filas."' type='hidden' value='".$form['hasta']."'> 
<font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
".$prog_has2." </font></div></td>
</tr>";
		//$obj->addAlert($cont_responsables);
	}			
	$dev.="</table>";	
		
    $obj->addAssign("div_celdas","innerHTML",$dev);	
	
	$cant_filas++;
    $obj->addAssign("campo_cant_filas","value",$cant_filas);
	
	
    $obj->addAssign("produtor","value", 1000);	
	$obj->addAssign("programa","value", 1000);	
	$obj->addAssign("desde","value", 1000);	
	$obj->addAssign("hasta","value", 1000);	
	
	if($cant_filas > 1)
	{
		$obj->addAssign("boton_registrar","style.visibility","visible");
	}
	else
	{
		$obj->addAssign("boton_registrar","style.visibility","hidden");
	}	
	 
	/*$obj->addAssign("boton_guardar","style.visibility","visible");
	$obj->addAssign("boton_modificar","style.visibility","hidden");*/

	
    return $obj;

}
/*
arriba
 <td ><div align=\"center\">
 <input name='campo_cabina".$i."' type='hidden' value='".$form['campo_cabina'.$i]."'>
 <font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
 ".$form['campo_cabina'.$i]."</font></div></td>

 
 
 abajo
<td ><div align=\"center\">
<input name='campo_cabina".$cant_filas."' type='hidden' value='".$form['cabina_id']."'> 
<font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
".$form['cabina_id']." </font></div></td>

 */
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||


function editar_fila_pautada($form,$id_fila)
{
	$obj = new xajaxResponse();		
	
	$vect = split("-",$id_fila);
	$id = $vect[1];
    
	$dev5.= "<input name='campo_id_fila'  type='hidden' value='".$id."'>";	
	/*$obj->addAlert($form['campo_prod'.$id]);
	return $obj;*/
		
    //---------------	  			 
	
	 $obj->addAssign("produtor","value", $form['campo_prod'.$id]);	
	 $obj->addAssign("programa","value", $form['campo_prog'.$id]);	
	 $obj->addAssign("desde","value", $form['campo_desde'.$id]);	
	 $obj->addAssign("hasta","value", $form['campo_hasta'.$id]);	
	 
	 $obj->addAssign("div_campos_ocultos","innerHTML",$dev5);
	 
	 $obj->addAssign("boton_guardar","style.visibility","hidden");
	 $obj->addAssign("boton_modificar","style.visibility","visible");
	 
	 
	 //$obj->addAssign("div_campos_ocultos","innerHTML",$dev5);
	 
 	 /*$obj->addAssign("boton_eliminar","style.visibility","visible");	
     	
	 	*/

	return $obj;
}

//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||


function modificar_fila_pautada($form)
{
	$obj = new xajaxResponse();	
	$fecha_real =  date("y/m/d");	
	$id = $form['campo_id_fila'];
    $aux = "-";	
	
    $dev = inicializar_tabla();			
	
	$cant_filas = $form['campo_cant_filas']; 		
	//$obj->addAlert($cant_filas);
	for($i=1; $i < $cant_filas; $i++)
	{		  
	   if($i != $id)
	   {	
	   	  
		  $query_dia = "SELECT b.dia
						 FROM est_dia_semana b
						 WHERE b.id_dia = ".$form['campo_dia'.$i]."";
					//echo $query_nt;
		  $Recornt_dia = mysql_query($query_dia) or die(mysql_error());
		  $row_dia = mysql_fetch_assoc($Recornt_dia);
		  $prog_dia = $row_dia['dia'];	
		  
		  $query_productor = "SELECT b.productor
						 FROM est_productor b
						 WHERE b.id_productor = ".$form['campo_prod'.$i]."";
					//echo $query_nt;
		  $Recornt_productor = mysql_query($query_productor) or die(mysql_error());
		  $row_productor = mysql_fetch_assoc($Recornt_productor);
		  $prog_productor = $row_productor['productor'];	
		  
		  
		  $query_nt11 = "SELECT b.programa
						 FROM est_programa b
						 WHERE b.id_programa = ".$form['campo_prog'.$i]."";
					//echo $query_nt;
		  $Recornt11 = mysql_query($query_nt11) or die(mysql_error());
		  $row_nt11 = mysql_fetch_assoc($Recornt11);
		  $progrrr = $row_nt11['programa'];	
		  
		  $query_des = "SELECT b.turno
						 FROM est_turnos b
						 WHERE b.id_turno = ".$form['campo_desde'.$i]."";
		  $Recornt_des = mysql_query($query_des) or die(mysql_error());
		  $row_des = mysql_fetch_assoc($Recornt_des);
		  $prog_des = $row_des['turno'];
		  
		  $query_has = "SELECT b.turno
						 FROM est_turnos b
						 WHERE b.id_turno = ".$form['campo_hasta'.$i]."";
		  $Recornt_has = mysql_query($query_has) or die(mysql_error());
		  $row_has = mysql_fetch_assoc($Recornt_has);
		  $prog_has = $row_has['turno'];	
	   
	   	//$obj->addAlert($i." != ".$id);
	      	$dev .="<tr id ='fila-".$i."' style='background:#FBFBFB' onMouseOver='prender_fila(this)' onMouseOut='apagar_fila(this)' onClick='js_editar_fila_pautada(this)'>    
 <td ><div align=\"center\">
 <input name='campo_dia".$i."' type='hidden' value='".$form['campo_dia'.$i]."'> 
 <font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
 ".$prog_dia." </font></div></td>
 <td ><div align=\"center\"> 
 <input name='campo_prod".$i."' type='hidden' value='".$form['campo_prod'.$i]."'>
 <font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
 ".$prog_productor."</font></div></td>
 <td ><div align=\"center\">
 <input name='campo_prog".$i."' type='hidden' value='".$form['campo_prog'.$i]."'> 
 <font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
 ".$progrrr."</font></div></td>
 <td ><div align=\"center\">
 <input name='campo_desde".$i."' type='hidden' value='".$form['campo_desde'.$i]."'>
 <font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
 ".$prog_des."</font></div></td>
 <td ><div align=\"center\">
 <input name='campo_hasta".$i."' type='hidden' value='".$form['campo_hasta'.$i]."'> 
 <font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
 ".$prog_has." </font></div></td>
</tr>";
	    }
		else
		{
		
		  $query_dia2 = "SELECT b.dia
						 FROM est_dia_semana b
						 WHERE b.id_dia = ".$form['diaoculto']."";
					//echo $query_nt;
		  $Recornt_dia2 = mysql_query($query_dia2) or die(mysql_error());
		  $row_dia2 = mysql_fetch_assoc($Recornt_dia2);
		  $prog_dia2 = $row_dia2['dia'];			  
		  
		  $query_productor2 = "SELECT b.productor
						 FROM est_productor b
						 WHERE b.id_productor = ".$form['produtor']."";
					//echo $query_nt;
		  $Recornt_productor2 = mysql_query($query_productor2) or die(mysql_error());
		  $row_productor2 = mysql_fetch_assoc($Recornt_productor2);
		  $prog_productor2 = $row_productor2['productor'];
		
		  $query_nt22 = "SELECT b.programa
						 FROM est_programa b
						 WHERE b.id_programa = ".$form['programa']."";
					//echo $query_nt;
		  $Recornt22 = mysql_query($query_nt22) or die(mysql_error());
		  $row_nt22 = mysql_fetch_assoc($Recornt22);
		  $progr22 = $row_nt22['programa'];	
		  
		  $query_des2 = "SELECT b.turno
						 FROM est_turnos b
						 WHERE b.id_turno = ".$form['desde']."";
		  $Recornt_des2 = mysql_query($query_des2) or die(mysql_error());
		  $row_des2 = mysql_fetch_assoc($Recornt_des2);
		  $prog_des2 = $row_des2['turno'];
		  
		  $query_has2 = "SELECT b.turno
						 FROM est_turnos b
						 WHERE b.id_turno = ".$form['hasta']."";
		  $Recornt_has2 = mysql_query($query_has2) or die(mysql_error());
		  $row_has2 = mysql_fetch_assoc($Recornt_has2);
		  $prog_has2 = $row_has2['turno'];
		  
		
		$dev .="<tr id ='fila-".$i."' style='background:#FBFBFB' onMouseOver='prender_fila(this)' onMouseOut='apagar_fila(this)' onClick='js_editar_fila_pautada(this)'>
<td ><div align=\"center\">
<input name='campo_dia".$i."' type='hidden' value='".$form['diaoculto']."'> 
<font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
".$prog_dia2." </font></div></td>		
<td ><div align=\"center\">
<input name='campo_prod".$i."' type='hidden' value='".$form['produtor']."'> 
<font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
".$prog_productor2."</font></div></td>
<td ><div align=\"center\">
<input name='campo_prog".$i."' type='hidden' value='".$form['programa']."'> 
<font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
".$progr22."</font></div></td>    
<td ><div align=\"center\">
<input name='campo_desde".$i."' type='hidden' value='".$form['desde']."'> 
<font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
".$prog_des2."</font></div></td>         		
<td ><div align=\"center\">
<input name='campo_hasta".$i."' type='hidden' value='".$form['hasta']."'> 
<font color='#808080' style='font-family:Arial ; font-size:11px; font-weight:bold;'>
".$prog_has2." </font></div></td>		
				          		  		           
       			</tr>";
		}		
	}
					
    $obj->addAssign("div_celdas","innerHTML",$dev);			
	
	$obj->addAssign("produtor","value", 1000);	
	$obj->addAssign("programa","value", 1000);	
	$obj->addAssign("desde","value", 1000);	
	$obj->addAssign("hasta","value", 1000);	
	 
	$obj->addAssign("boton_guardar","style.visibility","visible");
	$obj->addAssign("boton_modificar","style.visibility","hidden");	

    return $obj;
}


//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

function mostrar_cabina($fechano,$fechmes,$fechdia)
{
	$obj = new xajaxResponse();	
	

	$solic_pauta = $fechdia."-".$fechmes."-".$fechano;
	$sol_pau = $fechano."-".$fechmes."-".$fechdia;

	$id_k = 1;

	$dibujar ="<table width=\"1000\" border=\"1\" align=\"center\"  bordercolor=\"#367ea6\">
			<tr bgcolor=\"#FBFBFB\">
			  <td colspan=\"5\" bgcolor=\"#FBFBFB\" ><div align=\"center\">
			  <font color=\"#143266\" style=\"font-family:Arial ; font-size:12px; font-weight:bold;\">PAUTA PARA EL DIA &nbsp;&nbsp; 
			  <font color=\"#9B0000\" style=\"font-family:Arial ; font-size:14px; font-weight:bold;\">".$solic_pauta." </font>
			  &nbsp;&nbsp; EN TODOS LOS ESTUDIOS</font>
			  </div></td>
		  </tr>
			<tr bgcolor=\"#FBFBFB\">
			  <td colspan=\"13\" bgcolor=\"#FBFBFB\" >&nbsp;</td>
		  </tr>
			<tr bgcolor=\"#56C4C2\">
			  <td width=\"50\" bgcolor=\"#DFF4F2\" ><div align=\"center\">
			  <font color=\"#808080\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\"> DESDE </font>
			  </div></td>
			  
			  <td width=\"50\" bgcolor=\"#DFF4F2\" ><div align=\"center\">
			  <font color=\"#808080\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\"> HASTA </font>
			  </div></td>
		      
			  <td width=\"300\" bgcolor=\"#56C4C2\" >
			  <div align=\"center\">
			  <font color=\"#143266\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">ESTUDIO A</font>			  </div>			  </td>
		      
		      <td width=\"300\" bgcolor=\"#56C4C2\" >
			  <div align=\"center\">
			  <font color=\"#143266\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">ESTUDIO B</font>			  </div>			  </td>
		      
			  <td width=\"300\" bgcolor=\"#56C4C2\" >
			  <div align=\"center\">
			  <font color=\"#143266\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">ESTUDIO C</font>			  </div>			  </td>
			  
			  
		  </tr>					
			<tr bgcolor=\"#FF0000\">
			  
			  <td colspan=\"5\" bgcolor=\"#FFFFFF\" ><div align=\"left\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
	      </tr> ";
		  
		  
		  	 for($i=1; $i<49; $i++)	// TURNOS
			 {			 	
				
				$query_nt = "SELECT * FROM est_turnos WHERE id_turno = '$i'";												
				$Recornt = mysql_query($query_nt) or die (mysql_error ());
				$row_nt = mysql_fetch_assoc($Recornt);
				$des = $row_nt['turno'];
				
				
				
				$m = $i + 1;
				
				$query_ntxx = "SELECT * FROM est_turnos WHERE id_turno = '$m'";
				$Recorntxx = mysql_query($query_ntxx) or die (mysql_error ());
				$row_ntxx = mysql_fetch_assoc($Recorntxx);
				$has = $row_ntxx['turno'];

				$dibujar .= "
				<tr bgcolor=\"#FF0000\">
					<td width=\"55\" bgcolor=\"#F7F7F7\" ><div align=\"center\">
						<font color=\"#808080\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">".$des."</font></div></td>
					<td width=\"55\" bgcolor=\"#F7F7F7\" ><div align=\"center\">
						<font color=\"#808080\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">".$has."</font></div></td> ";
						
						
					
 
			 	for($j=1; $j<4; $j++)  // MODULOS - CABINAS
				{
				 	$query_nt1 = "SELECT a.*, b.programa, c.productor, d.prod_asignado
								 FROM est_pauta a, est_programa b, est_productor c, est_productor_asignado  d
								 WHERE a.fecha_pauta = '$sol_pau' AND a.id_modulo = '$j' AND a.desde = '$i' AND a.id_programa = b.id_programa 
								   AND a.id_productor_resp = d.id_productorasig AND a.id_postproduct = c.id_productor AND a.mostrar_pauta = 1";
					/*echo $query_nt1;
					exit(0);*/

		$obj->addAlert("ok= ".$query_nt1);
	
					$Recornt1 = mysql_query($query_nt1) or die(mysql_error());
					$row_nt1 = mysql_fetch_assoc($Recornt1);
					$numero=mysql_num_rows($Recornt1);
					$idpau = $row_nt1['id_pauta'];
					$idtec = $row_nt1['programa'];	
					$idpprod = $row_nt1['productor'];		
					$idprod = $row_nt1['prod_asignado'];							
					$id_de = $row_nt1['desde'];	
					$id_ha = $row_nt1['hasta'];	
					$color = $row_nt1['color'];
					$tip_pa = $row_nt1['tipo_pauta'];	
					$motpau = $row_nt1['motivo_cancelado'];
					$obspau = $row_nt1['observacion'];
					$difer = $id_ha - $id_de;
					
					//echo $difer;
					if(($j == 1) && ($numero != 0))
						$hasta_muno = $id_ha;
					if(($j == 2) && ($numero != 0))
						$hasta_mdos = $id_ha;
					if(($j == 3) && ($numero != 0))
						$hasta_mtres = $id_ha;
					if(($j == 4) && ($numero != 0))
						$hasta_mcuatro = $id_ha;
					if(($j == 5) && ($numero != 0))
						$hasta_mcinco = $id_ha;
					if(($j == 6) && ($numero != 0))
						$hasta_mseis = $id_ha;	
					if(($j == 7) && ($numero != 0))
						$hasta_msiete = $id_ha;
					if(($j == 8) && ($numero != 0))
						$hasta_mocho = $id_ha;
					if(($j == 9) && ($numero != 0))
						$hasta_mnueve = $id_ha;
					if(($j == 10) && ($numero != 0))
						$hasta_auno = $id_ha;	
					if(($j == 11) && ($numero != 0))
						$hasta_ados = $id_ha;																
					
					/*if($numero != 0)
					{												
						if($difer > 1)
						{
							//echo "cuadro";   onClick=\"editar_bloque($id_k, $j)\"
							if($color == 'FFEB86')
							{					
							$dibujar .= "<td width=\"140\" rowspan=\"".$difer."\"bgcolor=\"#".$color."\" onClick=\"editar_bloque($id_k, $j, $idpau, $tip_pa)\"  >
						    <div align=\"center\">
							<font color=\"#9B0000\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">".$idtec."</font><br>
							<font color=\"#444444\" style=\"font-family:Arial ; font-size:10px; font-weight:bold;\">".$idprod."
							<br><br>".$idpprod."</font>
							</div></td> ";
							}
							else
							{
							$dibujar .= "<td width=\"140\" rowspan=\"".$difer."\"bgcolor=\"#".$color."\" onClick=\"editar_bloque($id_k, $j, $idpau, $tip_pa)\"  >
						    <div align=\"center\">
							<font color=\"#FFEB86\" style=\"font-family:Arial ; font-size:10px; font-weight:bold;\">".$idtec."</font><br>
							<font color=\"#FFFFFF\" style=\"font-family:Arial ; font-size:10px; font-weight:bold;\">".$idprod."
							<br><br>".$idpprod."</font>
							</div></td> ";
							}
						} 	
						else
						{
							if($color == 'FFEB86')
							{					
							$dibujar .= "<td width=\"140\" bgcolor=\"#".$color."\" onClick=\"editar_bloque($id_k, $j, $idpau, $tip_pa)\"  >
						    <div align=\"center\">
							<font color=\"#9B0000\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">".$idtec."</font>
							<font color=\"#444444\" style=\"font-family:Arial ; font-size:10px; font-weight:bold;\">
							<br>".$idprod."<br><br>".$idpprod."</font>
							</div></td> ";
							}
							else
							{
							$dibujar .= "<td width=\"140\" bgcolor=\"#".$color."\" onClick=\"editar_bloque($id_k, $j, $idpau, $tip_pa)\"  >
						    <div align=\"center\">
							<font color=\"#FFEB86\" style=\"font-family:Arial ; font-size:10px; font-weight:bold;\">".$idtec."</font><br>
							<font color=\"#FFFFFF\" style=\"font-family:Arial ; font-size:10px; font-weight:bold;\">".$idprod."
							<br>".$idprod."<br><br>".$idpprod."</font>
							</div></td> ";
							}																					
						}	
					}*/
					if($numero != 0)
					{												
						if($difer > 1)
						{
							//echo "cuadro";   onClick=\"editar_bloque($id_k, $j)\"
							if($color == 'FFEB86')
							{					
							$dibujar .= "<td width=\"140\" rowspan=\"".$difer."\"bgcolor=\"#".$color."\" onClick=\"editar_bloque($j, $idpau, $tip_pa)\"  >
						    <div align=\"center\">
							<font color=\"#9B0000\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">".$idtec."</font><br>
							<font color=\"#444444\" style=\"font-family:Arial ; font-size:10px; font-weight:bold;\">".$idprod."
							<br><br>".$idpprod."<br><br>OBSERVACION:<br>".$obspau."</font>
							</div></td> ";
							}
							else
							{
								if($color == 'B4001B')
								{					
								$dibujar .= "<td width=\"140\" rowspan=\"".$difer."\"bgcolor=\"#".$color."\" onClick=\"editar_bloque($j, $idpau, $tip_pa)\"  >
								<div align=\"center\">
								<font color=\"#FFEB86\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">".$idtec."</font><br>
								<font color=\"#FFFFFF\" style=\"font-family:Arial ; font-size:10px; font-weight:bold;\">".$idprod."
								<br><br>".$idpprod."<br><br>CANCELADO POR:<br>".$motpau."</font>
								</div></td> ";
								}
								else
								{
								$dibujar .= "<td width=\"140\" rowspan=\"".$difer."\"bgcolor=\"#".$color."\" onClick=\"editar_bloque($j, $idpau, $tip_pa)\"  >
								<div align=\"center\">
								<font color=\"#FFEB86\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">".$idtec."</font><br>
								<font color=\"#FFFFFF\" style=\"font-family:Arial ; font-size:10px; font-weight:bold;\">".$idprod."
								<br><br>".$idpprod."<br><br>OBSERVACION:<br>".$obspau."</font>
								</div></td> ";
								}
							}
						} 	
						else
						{
							if($color == 'FFEB86')
							{					
							$dibujar .= "<td width=\"140\" bgcolor=\"#".$color."\" onClick=\"editar_bloque($j, $idpau, $tip_pa)\"  >
						    <div align=\"center\">
							<font color=\"#9B0000\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">".$idtec."</font>
							<font color=\"#444444\" style=\"font-family:Arial ; font-size:10px; font-weight:bold;\">
							<br>".$idprod."<br><br>".$idpprod."<br><br>OBSERVACION:<br>".$obspau."</font>
							</div></td> ";
							}
							else
							{					
								if($color == 'B4001B')
								{
									$dibujar .= "<td width=\"140\" bgcolor=\"#".$color."\" onClick=\"editar_bloque($j, $idpau, $tip_pa)\"  >
									<div align=\"center\">
									<font color=\"#FFEB86\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">".$idtec."</font>
									<font color=\"#FFFFFF\" style=\"font-family:Arial ; font-size:10px; font-weight:bold;\">
									<br>".$idprod."<br><br>".$idpprod."<br><br>CANCELADO POR:<br>".$motpau."</font>
									</div></td> ";		
								}						
								else
								{
									$dibujar .= "<td width=\"140\" bgcolor=\"#".$color."\" onClick=\"editar_bloque($j, $idpau, $tip_pa)\"  >
									<div align=\"center\">
									<font color=\"#FFEB86\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">".$idtec."</font>
									<font color=\"#FFFFFF\" style=\"font-family:Arial ; font-size:10px; font-weight:bold;\">
									<br>".$idprod."<br><br>".$idpprod."<br><br>OBSERVACION:<br>".$obspau."</font>
									</div></td> ";
								}
							}																						
						}	
					}
					else
					{
						if(($j == 1) && ($i < $hasta_muno))	
						{
						}
						else
						{
							if(($j == 2) && ($i < $hasta_mdos))	
							{
							}
							else
							{
								if(($j == 3) && ($i < $hasta_mtres))
								{
								}
								else
								{
									if(($j == 4) && ($i < $hasta_mcuatro))
									{
									}
									else
									{
										if(($j == 5) && ($i < $hasta_mcinco))
										{
										}
										else
										{
											if(($j == 6) && ($i < $hasta_mseis))
											{
											}
											else
											{
												if(($j == 7) && ($i < $hasta_msiete))
												{
												}
												else
												{	
													if(($j == 8) && ($i < $hasta_mocho))
													{
													}
													else
													{	
														if(($j == 9) && ($i < $hasta_mnueve))
														{
														}
														else
														{	
															if(($j == 10) && ($i < $hasta_auno))
															{
															}
															else
															{	
																if(($j == 11) && ($i < $hasta_ados))
																{
																}
																else
																{																												
																	$dibujar .= "<td width=\"140\" bgcolor=\"#DFF4F2\" >&nbsp;</td>";
																}																													
															}													
														}																																		
													}																								
												}		
																						
											}	// ultimo else											
										}
										
									}
									
								}
							}	
						}						
					}				 
				} ////////trdfffffffffffffffffffffffffffffffffffffffffffffffffffffffff
                                return $obj;
			$dibujar .="</tr>";
			 }			  		  
		$dibujar .="</table>";
		
		$obj->addAssign("pintar","innerHTML",$dibujar);	
	

		return $obj;


}







// copia que funciona perfectamente

/*

function mostrar_cabina($id_k)
{
	$obj = new xajaxResponse();	
	
	//$obj->addAlert($id_k);
	
	
	$dibujar .="<table width=\"950\" border=\"0\" align=\"center\">
			<tr bgcolor=\"#FBFBFB\">
			  <td colspan=\"8\" bgcolor=\"#FBFBFB\" ><div align=\"center\">
			  <font color=\"#143266\" style=\"font-family:Arial ; font-size:12px; font-weight:bold;\">HORARIO - CABINA ".$id_k."</font>
			  </div></td>
		  </tr>
			<tr bgcolor=\"#FBFBFB\">
			  <td colspan=\"8\" bgcolor=\"#FBFBFB\" >&nbsp;</td>
		  </tr>
			<tr bgcolor=\"#56C4C2\">
			  <td width=\"55\" bgcolor=\"#DFF4F2\" ><div align=\"center\">
			  <font color=\"#808080\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\"> DESDE </font>
			  </div></td>
			  <td width=\"55\" bgcolor=\"#DFF4F2\" >
		       <div align=\"center\"><font color=\"#808080\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\"> HASTA </font></div></td>
		      <td width=\"140\" bgcolor=\"#56C4C2\" >
			  <div align=\"center\">
			  <font color=\"#143266\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">LUNES</font>			  </div>			  </td>
		      <td width=\"140\" bgcolor=\"#56C4C2\" >
			  <div align=\"center\">
			  <font color=\"#143266\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">MARTES</font>			  </div>			  </td>
		      <td width=\"140\" bgcolor=\"#56C4C2\" >
			  <div align=\"center\">
			  <font color=\"#143266\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">MIERCOLES</font>			  </div>			  </td>
		      <td width=\"140\" bgcolor=\"#56C4C2\" >
			  <div align=\"center\">
			  <font color=\"#143266\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">JUEVES</font>			  </div>			  </td>
		      <td width=\"140\" bgcolor=\"#56C4C2\" >
			  <div align=\"center\">
			  <font color=\"#143266\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">VIERNES</font>			  </div>			  </td>
		      <td width=\"140\" bgcolor=\"#56C4C2\" >
			  <div align=\"center\">
			  <font color=\"#143266\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">SABADO</font>			  </div>			  </td>
		  </tr>			
			<tr bgcolor=\"#FF0000\">
			  
			  <td colspan=\"8\" bgcolor=\"#FFFFFF\" ><div align=\"left\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
	      </tr> ";
			
		  	 for($i=1; $i<18; $i++)	// TURNOS
			 {			 	
				
				$query_nt = "SELECT * FROM turnos WHERE id_turno = '$i'";												
				$Recornt = mysql_query($query_nt) or die (mysql_error ());
				$row_nt = mysql_fetch_assoc($Recornt);
				$des = $row_nt['turno'];
				
				
				
				$m = $i + 1;
				
				$query_ntxx = "SELECT * FROM turnos WHERE id_turno = '$m'";
				$Recorntxx = mysql_query($query_ntxx) or die (mysql_error ());
				$row_ntxx = mysql_fetch_assoc($Recorntxx);
				$has = $row_ntxx['turno'];

				$dibujar .= "
				<tr bgcolor=\"#FF0000\">
					<td width=\"55\" bgcolor=\"#F7F7F7\" ><div align=\"center\">
						<font color=\"#808080\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">".$des."</font></div></td>
					<td width=\"55\" bgcolor=\"#F7F7F7\" ><div align=\"center\">
						<font color=\"#808080\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">".$has."</font></div></td> ";
 
			 	for($j=1; $j<7; $j++)  // DIAS SEMANA
				{
				 	$query_nt1 = "SELECT a.*, b.programa, c.productor 
								 FROM pauta a, programa b, productor c
								 WHERE a.id_modulo = '$id_k' AND a.id_dia = '$j' AND a.desde = '$i' AND a.id_programa = b.id_programa 
								   AND a.id_productor = c.id_productor ";
					//echo $query_nt;
					$Recornt1 = mysql_query($query_nt1) or die(mysql_error());
					$row_nt1 = mysql_fetch_assoc($Recornt1);
					$numero=mysql_num_rows($Recornt1);
					$idtec = $row_nt1['programa'];	
					$idprod = $row_nt1['productor'];		
					$id_de = $row_nt1['desde'];	
					$id_ha = $row_nt1['hasta'];	
					$difer = $id_ha - $id_de;
					
					//echo $difer;
					if(($j == 1) && ($numero != 0))
						$hasta_lunes = $id_ha;
					if(($j == 2) && ($numero != 0))
						$hasta_martes = $id_ha;
					if(($j == 3) && ($numero != 0))
						$hasta_miercoles = $id_ha;
					if(($j == 4) && ($numero != 0))
						$hasta_jueves = $id_ha;
					if(($j == 5) && ($numero != 0))
						$hasta_viernes = $id_ha;
					if(($j == 6) && ($numero != 0))
						$hasta_sabado = $id_ha;														
					
					if($numero != 0)
					{												
						if($difer > 1)
						{
							//echo "cuadro";   onClick=\"editar_bloque($id_k, $j)\"
					
							$dibujar .= "<td width=\"140\" rowspan=\"".$difer."\"bgcolor=\"#B4001B\"  >
						    <div align=\"center\">
							<font color=\"#FFFFFF\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">".$idtec."<br>".$idprod."</font>
							</div></td> ";
						} 		
					}
					else
					{
						if(($j == 1) && ($i < $hasta_lunes))	
						{
						}
						else
						{
							if(($j == 2) && ($i < $hasta_martes))	
							{
							}
							else
							{
								if(($j == 3) && ($i < $hasta_miercoles))
								{
								}
								else
								{
									if(($j == 4) && ($i < $hasta_jueves))
									{
									}
									else
									{
										if(($j == 5) && ($i < $hasta_viernes))
										{
										}
										else
										{
											if(($j == 6) && ($i < $hasta_sabado))
											{
											}
											else
											{

												$dibujar .= "<td width=\"140\" bgcolor=\"#DFF4F2\" >&nbsp;</td>";

											}												
										}
										
									}
									
								}
							}	
						}						
					}				 
				} 
			$dibujar .="</tr>";
			 }			  		  
		$dibujar .="</table>";
		
		$obj->addAssign("pintar","innerHTML",$dibujar);	
	

		return $obj;


}


*/










//||||||||||||||||||||||||||||||||||||||||||||||||||||||||

function guardar_pauta($fechano,$fechmes,$fechdia, $forma, $id_cabinax, $dia_sel, $pauta_sel, $solicitud, $iddatosper, $observ)
{
	$objResponse = new xajaxResponse();
	
/*	$objResponse->addAlert("parametro llega acti: ".$forma['produtor']);
	$objResponse->addAlert("parametro llega proy: ".$forma['programa']);
*/		 
	/*$actual = $fechano."-".$fechmes."-".$fechdia;
	$objResponse->addAlert("dia: ".$solicitud);			
	$objResponse->addAlert("fecha: ".$actual);
	return $objResponse;*/
	
	//$objResponse->addAlert("editar: ".$editar_sel);
	//$objResponse->addAlert("pautar: ".$pauta_sel);	
	 
	$ban=0;
	$solic_pauta = $fechano."-".$fechmes."-".$fechdia;
	$solic_petic = date("Y-m-d");
	$hora_peticion = date("H:i:s");	
	
	//$nro_actividades = $forma['campo_cant_filas'];	
	
/*	if($editar_sel == 123)
	{
		$borrar="update est_pauta set 
				 id_modulo = '$id_cabinax', 
				 id_dia = '$dia_sel', 
				 desde = '".$forma['desde']."', 
				 hasta = '".$forma['hasta']."',
				 id_productor = '".$forma['produtor']."',
				 id_programa = '".$forma['programa']."'  where id_pauta = '$pauta_sel' and id_modulo = '$id_cabinax' and id_dia = '$dia_sel'";	
		$Recornt_borrar = mysql_query($borrar) or die(mysql_error());
		$ban=1;					
	}
	else
	{
	*/
		if($solicitud == 123456)
		{
		
				//$id_act=$actv_ob->get_id();  $fecha_jefe = date("Y-m-d");  	$hora_jefe = date("H:i:s");							
				
				
				
				$query_valida = "SELECT a.*, b.programa, c.productor, d.prod_asignado
								 FROM est_pauta a, est_programa b, est_productor c, est_productor_asignado  d
								 WHERE a.fecha_pauta = '$solic_pauta' AND a.id_modulo = '$id_cabinax' AND a.id_programa = b.id_programa AND
								       a.id_productor_resp = d.id_productorasig AND a.id_postproduct = c.id_productor AND a.mostrar_pauta!= 2 ";
				/*	echo $query_valida;
					exit(0);*/
				$Recornt_valida = mysql_query($query_valida) or die(mysql_error());
				$row_valida = mysql_fetch_assoc($Recornt_valida);
				$numero=mysql_num_rows($Recornt_valida);
					
				//$objResponse->addAlert($cant." valor controlador");		
				$var = 0;
				
				if($numero == 0)
				{
					$var = 0;
				}
				else
				{
					do
					{
						
						$A1 = $row_valida['desde'];
						$A2 = $row_valida['hasta'];
						$B1 = $forma['desde'];
						$B2 = $forma['hasta'];
						
						if(  ($B1 < $A1) && ($A1 < $B2)   )
						{
							$objResponse->addAlert(" entro en la primera ");
							$var++;							
						}
						if(  ($B1 < $A2) && ($A2 < $B2)  ) 
						{
							$objResponse->addAlert(" entro en la segunda ");
							$var++;		
						}
						if(  ($A1 == $B1) && ($A2 == $B2)  )
						{
							$objResponse->addAlert(" entro en la tercera ");
							$var++;		
						}					
						if((  ($B1 < $A1) && ($A1 < $A2)  ) && ($A2 < $B2) )
						{
							$objResponse->addAlert(" entro en la cuarta ");			
							$var++;																																				
						}
						if((  ($A1 < $B1) && ($B1 < $B2)  ) && ($B2 < $A2) )
						{
							$objResponse->addAlert(" entro en la quinta ");
							//$objResponse->addAlert(" aumento la probabilidad ");
							$var++;
						}	
												
						
					}while($row_valida = mysql_fetch_assoc($Recornt_valida));
				}	
				//$objResponse->addAlert(" var = ".$var);
				if($var > 0)
				{
					$objResponse->addAlert("\t\t\tNo puede crear esa pauta \n El bloque de horas seleccionado conicide con uno existente \n \t\t Modifique los campos DESDE o HASTA");
					return  $objResponse; 
				}
				else
				{	
					$Cad="insert into est_pauta (id_pauta, 
									 id_modulo,    
									 id_dia,
									 solicitante,
									 
									 fecha_pauta,
									 fecha_solicitud,
									 hora_solicitud,
									 desde,
									 hasta,
									 id_productor_resp,
									 id_postproduct,
									 id_programa,
									 color,
									 mostrar_pauta,
									 tipo_pauta,
									 observacion)
							values( NULL,
									 '$id_cabinax',
									 '$dia_sel',
									 '$iddatosper',
									
									 '$solic_pauta',
									 '$solic_petic',
									 '$hora_peticion',
									 '".$forma['desde']."',
									 '".$forma['hasta']."',
									 '".$forma['produtor_asignado']."',	
									 1,	
									 '".$forma['programa']."',
									 'FFEB86',  
									 '1', 
									 '2',
									 '$observ'
									)";	
						/*FFFF80*/		
						$Recornt_des2 = mysql_query($Cad) or die(mysql_error());			
						$ban=1;					
				}
	
		}
		else
		{
			for($i=1; $i<2/*$nro_actividades*/; $i++)
			{
		//$id_act=$actv_ob->get_id();
		$Cad="insert into est_pauta (id_pauta, 
								 id_modulo,    
								 id_dia,
								 desde,
								 hasta,
								 id_productor,
								 id_programa,
								 color,
								 mostrar_pauta,
								 tipo_pauta)
		 values( NULL,
		 		 '$id_cabinax',
		         '$dia_sel',
				 '".$forma['desde']."',
				 '".$forma['hasta']."',
				 '".$forma['produtor']."',		
				 '".$forma['programa']."',
				 'B4001B',
				 '1',
				 '1'
				)";	
								
		$Recornt_des2 = mysql_query($Cad) or die(mysql_error());			
		$ban=1;				
		}
		}
	
/*	}*/
							 

	if($ban==1)
	{
		$nuevo ="";
		$objResponse->addAssign("produtor","value", 1000);	
		$objResponse->addAssign("produtor_asignado","value", 1000);		
		$objResponse->addAssign("cabina","value", 1000);					
		$objResponse->addAssign("programa","value", 1000);	
		$objResponse->addAssign("desde","value", 1000);	
		$objResponse->addAssign("hasta","value", 1000);	
		$objResponse->addAssign("diaxxx","value", 1000);	
		$objResponse->addAssign("editaroculto","value", 1000);
		$objResponse->addAssign("pautaoculto","value", 0);	
		$objResponse->addAssign("observ_solict","value", $nuevo);	
		
		 
		//$objResponse->addAssign("boton_guardar","style.visibility","visible");
		//$objResponse->addAssign("boton_modificar","style.visibility","hidden");	
		
		//$objResponse->addScript("xajax_agregar_fila_pautada(xajax.getFormValues('form1'),false);");	
		$objResponse->addScript("xajax_mostrar_cabina($fechano,$fechmes,$fechdia);");		
		
		return  $objResponse; 
	}
	else
	{	
		return  $objResponse;			
	}

	 
	
}







/*

function guardar_pauta($forma, $id_cabinax, $dia_sel)
{
	$objResponse = new xajaxResponse();
	
	$objResponse->addAlert("parametro llega acti: ".$id_activ);
	$objResponse->addAlert("parametro llega proy: ".$id_proy);
	$objResponse->addAlert("parametro llega usua: ".$usuario);
		 
	 
	$ban=0;
	
	//$nro_actividades = $forma['campo_cant_filas'];	
	
	$borrar="delete from pauta where id_modulo = '$id_cabinax' and id_dia = '$dia_sel'";	
	$Recornt_borrar = mysql_query($borrar) or die(mysql_error());	
	

	for($i=1; $i<$nro_actividades; $i++)
	{
		//$id_act=$actv_ob->get_id();
		$Cad="insert into pauta (id_pauta, 
								 id_modulo,    
								 id_dia,
								 desde,
								 hasta,
								 id_productor,
								 id_programa)
		 values( NULL,
		 		 '$id_cabinax',
		         '$dia_sel',
				 '".$forma['campo_desde'.$i]."',
				 '".$forma['campo_hasta'.$i]."',
				 '".$forma['campo_prod'.$i]."',		
				 '".$forma['campo_prog'.$i]."'
				)";	
								
		$Recornt_des2 = mysql_query($Cad) or die(mysql_error());			
		$ban=1;				
	}
			 

	if($ban==1)
	{
		$objResponse->addAssign("produtor","value", 1000);	
		$objResponse->addAssign("programa","value", 1000);	
		$objResponse->addAssign("desde","value", 1000);	
		$objResponse->addAssign("hasta","value", 1000);	
		$objResponse->addAssign("campo_cant_filas","value", 0);	
		
		 
		$objResponse->addAssign("boton_guardar","style.visibility","visible");
		$objResponse->addAssign("boton_modificar","style.visibility","hidden");	
		
		$objResponse->addScript("xajax_agregar_fila_pautada(xajax.getFormValues('form1'),false);");	
		$objResponse->addScript("xajax_mostrar_cabina($id_cabinax);");		
		
		return  $objResponse; 
	}
	else
	{	
		return  $objResponse;			
	}

	 
	
}



*/




































//*************************************************************************************

function cerrar_sesion(){
	$Conex = new Conexion();
	$objResponse = new xajaxResponse();
	if($Conex->desconectar>0)
   {         
      $objResponse->addRedirect("centro.php");   
   } 

return $objResponse;
}

//-----------------------------------------------------------


function reset_no_registrado()
{
    $objResponse = new xajaxResponse();
    $dev = "";	
	$objResponse->addAssign("div_no_registrado","innerHTML",$dev);
	return $objResponse;
}


//***********************************   funciones de completacion para los nombres de los responsables asignados  ************************

function autosugerencia($pais)
{
	$objRespuesta = new xajaxResponse();
	$ConexA = new Actividad();
	
//	$objRespuesta->addAlert($num."  num de filas");
//	$objRespuesta->addAlert($pais."  entro letra");

	if(!$pais)
	{
	$paises = '';
	$pa = "";
	$objRespuesta->addAssign("div2","style.visibility", "hidden");
	$objRespuesta->addAssign("div3","innerHTML",  $pa);
	//$objRespuesta ->addAssign("paises","innerHTML", $paises);
	return $objRespuesta;
	exit();
	}
	if($pais == '')
	{
	$pa = "";
	$objRespuesta->addAssign("div3","innerHTML",  $pa);
	$objRespuesta->addAssign("div2","style.visibility", "hidden");	
	//$objRespuesta ->addAssign("paises","innerHTML", $paises);
	return $objRespuesta;
	exit();
	}


	$num = $ConexA->cantidad($pais);


	if($num == 0)
	{
	$pa = "No se encuentra ningun nombre que coincida con el solicitado...";
	$objRespuesta->addAssign("div3","innerHTML",  $pa);
	$objRespuesta->addAssign("div2","style.visibility", "hidden");
	$objRespuesta->addAssign("div_autosugerencia","style.visibility", "hidden");
	return $objRespuesta;
	exit();
	}
	else
	{
		$mostrar = $ConexA->cantidad2($pais);
		
		$titulos = "<table  border=\"0\">";
		
		foreach($mostrar as $sal)
	  {		
	    $aux_nombre =trim($sal['nombre']);
		$aux_apellido =	trim($sal['apellido']);
		$aux_apellido2 =trim($sal['id_datos']);
		$todo = $aux_nombre." ".$aux_apellido;

		$titulos.="<tr>
  		    <td id=\"$id \" onclick=\"xajax_seleccionar_entrega($aux_apellido2,'$todo');\" class=\"nombre_campos\">".trim($sal['nombre'])." &nbsp;&nbsp;  ".trim($sal['apellido'])."</td>
			</tr>";		
//		$objRespuesta->addAlert($aux_apellido2);
	  }		 
	  $titulos .= "</table>";  
	$pa="";
	$objRespuesta->addAssign("div2", "style.visibility", "visible");
	$objRespuesta->addAssign("div3","innerHTML",  $pa);
	$objRespuesta->addAssign("div_autosugerencia","innerHTML", $titulos);
	$objRespuesta->addAssign("div_autosugerencia", "style.visibility", "visible");
	return $objRespuesta;				
	}	
}

function seleccionar_entrega($id_responsable, $todo)
	{
	$objResponse = new xajaxResponse("iso-8859-1");
	
	//$objResponse->addAlert($id_responsable);

	$objResponse->addAssign("resp_asig","value", $id_responsable);
	$objResponse->addAssign("responsable","value", $todo);
	$objResponse->addAssign("div_autosugerencia","style.visibility", "hidden");
	$objResponse->addAssign("div_seleccion","size", "0");
	
	return $objResponse;
	}





function pintar_autosugerencia($nombre, $apellido, $id)
{
	$objRespuesta = new xajaxResponse();
    $unido=$nombre."  ".$apellido;

//	  $objRespuesta->addAlert($ddd);
    //$objRespuesta->addAlert($id);

	$objRespuesta->addAssign("responsable","value", $unido);
	$objRespuesta->addAssign("id_responsable","value", $id);
	$objRespuesta->addAssign("div2","style.visibility", "hidden");
	return $objRespuesta;			
	
}
//----------------------------------------------------------
function pais_seleccionado($valor)
{
$objRespuesta = new xajaxResponse();
$objRespuesta->addAssign("pais","value", $valor);
return $objRespuesta;
}

//----------------------------------------------------------
function ocultar_paises()
{
$objRespuesta = new xajaxResponse();
$objRespuesta->addAssign("div2","style.visibility", "hidden");
return $objRespuesta;
}

//******************************************   CREAR PROYECTO  *************************

function insertar_proyecto($nom_proyx, $select_edo_proyx, $inicio_proyx, $fin_proyx, $recur_asigx, $descrip_proyx, $observacion_proy, $id_usuarios, $ban)
{

	$Proy = new Proyecto();
    $objResponse = new xajaxResponse();
	
	if(($Proy->validar_nombre($nom_proyx)==1))
	{  
	   $mensaje="<div align=\"center\" class=\"alerta_error\" id=\"error\">$nom_proyx<br>Proyecto Ya registrado con ese mismo nombre!...<br>No puede tener el mismo nombre de uno existente</div>";
       $objResponse->addAssign("error","innerHTML",$mensaje);
	}
	else
	{
	    if($Proy->insert_proyecto($nom_proyx, $select_edo_proyx, $inicio_proyx, $fin_proyx, $recur_asigx, $descrip_proyx, $observacion_proy, $id_usuarios, $ban)==1)
		{  
    	  if($Proy->insert_proyecto2($nom_proyx, $id_usuarios)==1)
		  {
		    $objResponse->addRedirect("actividades.php");   
		  }		  
		  else
		  { 
		  $mensaje="<p align=\"center\" class=\"alerta_error\"></p>  Segunda Insercion fallida";        
          $objResponse->addAssign("error","innerHTML",$mensaje);
//		  $objResponse->addRedirect("centro_inicio.php");   
		  }
		}
		else
		{ 
		  $mensaje="<p align=\"center\" class=\"alerta_error\"></p>  Insercion fallida";        
          $objResponse->addAssign("error","innerHTML",$mensaje);
//		  $objResponse->addRedirect("centro_inicio.php");   
		}
	}
	return  $objResponse;

}

//***********************************************************************************


function validar_fecha($fecha_ini, $fecha_fin)
{
	$Proy_fecha = new Proyecto();
	$objResponse = new xajaxResponse();
	
	$mensaje="<div align=\"center\" class=\"alerta_error\" id=\"error\"> Entro aqui </div>";
    $objResponse->addAssign("error","innerHTML",$mensaje);
	

//	if(($Proy_fecha->validar_fecha2($fecha_ini, $fecha_fin)<0))
	if($dias < 0)
	{  
	$mensaje="<div align=\"center\" class=\"alerta_error\" id=\"error\">La fecha de inicio no puede ser mayor que la de Fin</div>";
    $objResponse->addAssign("error","innerHTML",$mensaje);
	}
	else
	{
	$mensaje="<div align=\"center\" class=\"alerta_error\" id=\"error\"> No pasa nada </div>";
    $objResponse->addAssign("error","innerHTML",$mensaje);
	}
	 
	return  $objResponse;
}




//************************************************************************************



function numero_recursos(){
   $objResponse = new xajaxResponse();
   $nuevo = "<select name=\"numero\" id=\"numero\" onChange='buscar();'>".
   			"<option value=\"0\">Seleccionar Recurso</option>".
            "<option value=\"1\">Humanos</option>".
			"<option value=\"2\">Materiales</option>".
			"<option value=\"3\">Financieros</option>
			</select>";
   	$objResponse->addAssign("recurso","innerHTML",$nuevo);

	return $objResponse;
}


//*******************************************************************************

function agregar_lista_recursos($cantidad){
   $objResponse = new xajaxResponse();
   $nuevo ="Inicial Recursos";
   
			switch ($cantidad) {
   			case 1:
    		$nuevo2 = " <tr bgcolor=\"#E6E6CC\">
              <td height=\"29\" bgcolor=\"#FFFFFF\">
			  <span class=\"Estilo21 Estilo12 Estilo13\" onkeyup=\"isNumber(this)\"><strong>Cantidad:</strong></span>		              </td>
              <td width=\"149\" bgcolor=\"#FFFFFF\">
			  <input name=\"inicio_proy\" type=\"text\" id=\"inicio_proy\" size=\"10\" maxlength=\"10\">
              <td width=\"67\" bgcolor=\"#FFFFFF\">
			  <span class=\"Estilo21 Estilo12 Estilo13\" onkeyup=\"isNumber(this)\"><strong>Monto</strong>:</span>
              <td width=\"244\" bgcolor=\"#FFFFFF\">
			  <input name=\"textfield\" type=\"text\" size=\"15\"><strong>    Bs. </strong>
			  </tr>
            <tr bgcolor=\"#E6E6CC\">
              <td align=\"center\" valign=\"middle\"bgcolor=\"#FFFFFF\">
			  <span class=\"Estilo21 Estilo12 Estilo13\"><strong>Descripcion Recurso: </strong></span></td>
              <td colspan=\"3\" bgcolor=\"#FFFFFF\"><span class=\"Estilo20\">
              <textarea name=\"descrip_proy\" cols=\"50\" rows=\"3\" id=\"descrip_proy\"></textarea></span></td>
            </tr> ";
			
			/*<td bgcolor="#FFFFFF"><span class="Estilo14">Descripcion Actividad: </span></td>*/
			$objResponse->addAssign("recurso1","innerHTML",$nuevo2);
			break;		

			case 2:			
			$nuevo3 = "  Autor 2  <select name=\"letra2\" id=\"letra2\" onChange='buscar3();'>";
			$objResponse->addAssign("recurso2","innerHTML",$nuevo3);
			break;
			
			case 3:
			$nuevo4 = "  Autor 3  <select name=\"letra3\" id=\"letra3\" onChange='buscar4();'>";
			$objResponse->addAssign("autor3","innerHTML",$nuevo4);
			break;
}
   	$objResponse->addAssign("texto","innerHTML",$nuevo);
	return $objResponse;
}


//********************************  notificaciones  ********************************

function insertar_notif($notifix, $error, $idp, $usua)
{

	$Notif = new Notificacion();
    $objResponse = new xajaxResponse();
    $fecha_actual= date ("Y/n/j");
	if($error==1)
	{  
	   $mensaje="<div align=\"center\" class=\"alerta_error\" id=\"error\">Debe colocar una notificacion para continuar.$fecha_actual</div>";
       $objResponse->addAssign("error","innerHTML",$mensaje);
	}
	else
	{
  	    $fecha_actual= date ("Y/n/j");
	    if($Notif->insert_notificacion($notifix, $fecha_actual, $idp, $usua)>=1)
		{  
		  $objResponse->addRedirect("actividades_asignado.php");   
		}
		else
		{ 
		  $mensaje="<p align=\"center\" class=\"alerta_error\"></p>  Insercion fallida";        
          $objResponse->addAssign("error","innerHTML",$mensaje);
//		  $objResponse->addRedirect("centro_inicio.php");   
		}
	}
	return  $objResponse;

} 


//************************************** Solicitudes ***************************


function insertar_solic($solicix, $error)
{

	$Solic = new Solicitudes();
    $objResponse = new xajaxResponse();
    $fecha_actual= date ("Y/n/j");
	if($error==1)
	{  
	   $mensaje="<div align=\"center\" class=\"alerta_error\" id=\"error\">Debe llenar la Solicitud para continuar.   $fecha_actual</div>";
       $objResponse->addAssign("error","innerHTML",$mensaje);
	}
	else
	{
  	    $fecha_actual= date ("Y/n/j");
	    if($Solic->insert_solicitud($solicix, $fecha_actual)>=1)
		{  
		  $objResponse->addRedirect("centro_inicio.php");   
		}
		else
		{ 
		  $mensaje="<p align=\"center\" class=\"alerta_error\"></p>  Insercion fallida";        
          $objResponse->addAssign("error","innerHTML",$mensaje);
		}
	}
	return  $objResponse;

} 


//***********************************  AGREGAR ACTIVIDADES DINAMICAMENTE en planificacion_actividades ***************************

function agregar_fila($form,$es_boton)
{
    $obj = new xajaxResponse();	
	$aux = "-";
    $dev = get_cabecera_de_tabla();	
	$fecha_real =  date("y/m/d");
	
	$cant_filas = $form['campo_cant_filas']; 	
	//$obj->addAlert($cant_filas."  cantidad filas");
	
	if($es_boton == 'true')
	{
	   for($i=1; $i < $cant_filas; $i++)
	   {		
  	      //$obj->addAlert($i." cantidad i");
	      $dev .="<tr id ='fila-".$i."' style='background:#F4ebf5' onMouseOver='prender_fila(this)' onMouseOut='apagar_fila(this)' onClick='js_tomar_datos_fila(this)'>
 <td class=\"nombre_tabla\"><div align=\"center\">".$i."</div></td>
 <td class=\"nombre_tabla\"><div align=\"justify\"><input name='campo_nom_actividad".$i."' type='hidden' value='".$form['campo_nom_actividad'.$i]."'>".$form['campo_nom_actividad'.$i]."</div></td>
 <td class=\"nombre_tabla\"><div align=\"justify\"><input name='campo_descrip_activ".$i."' type='hidden' value='".$form['campo_descrip_activ'.$i]."'>".$form['campo_descrip_activ'.$i]."</div></td>
 <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_porc".$i."' type='hidden' value='".$form['campo_porc'.$i]."'>".$form['campo_porc'.$i]."%</div></td>
 <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_inicio_activ".$i."' type='hidden' value='".$form['campo_inicio_activ'.$i]."'> ".$form['campo_inicio_activ'.$i]."</div></td>
 <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_fin_activ".$i."' type='hidden' value='".$form['campo_fin_activ'.$i]."'>".$form['campo_fin_activ'.$i]."</div></td>
 <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_predecesora".$i."' type='hidden' value='".$form['campo_predecesora'.$i]."'> ".$form['campo_predecesora'.$i]." </div></td>
 <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_resp".$i."' type='hidden' value='".$form['campo_resp'.$i]."'> ".$form['campo_resp'.$i]." </div></td>
       			</tr>";

 		//$obj->addAlert($form['campo_cont_responsables_fila'.$i]);
		}
	} 
	else
	{
	  // $obj_actividad = new Actividad();
	  // $id_proyecto = $form['id_proy'];
	   //$obj->addAlert($id_proyecto);
	   
	   //$obj->addAlert($obj_actividad->hay_actividades($id_proyecto));
	   /*if($obj_actividad->hay_actividades($id_proyecto) == true)
	   { 	   	   
	       $obj = listar_actividades2($id_proyecto);	// 2 es el id del proyecto
		   return $obj;
	   }*/
	} 
	

	if($es_boton == 'true')
	{	
$dev .= "<tr id ='fila-".$cant_filas."' style='background:#F4ebf5' onMouseOver='prender_fila(this)' onMouseOut='apagar_fila(this)' onClick='js_tomar_datos_fila(this)'>
<td class=\"nombre_tabla\"><div align=\"center\">".$cant_filas."</div></td>				  
<td class=\"nombre_tabla\"><div align=\"justify\"><input name='campo_nom_actividad".$cant_filas."' type='hidden' value='".$form['nom_act_esp']."'> ".$form['nom_act_esp']." </div></td>
<td class=\"nombre_tabla\"><div align=\"justify\"><input name='campo_descrip_activ".$cant_filas."' type='hidden' value='".$form['descrip_activ_esp']."'> ".$form['descrip_activ_esp']." </div></td>
<td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_porc".$cant_filas."' type='hidden' value='".$form['porcentaje']."'> ".$form['porcentaje']."% </div></td>
<td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_inicio_activ".$cant_filas."' type='hidden' value='".$form['inicio_activ']."'> ".$form['inicio_activ']."</div></td>    
<td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_fin_activ".$cant_filas."' type='hidden' value='".$form['fin_activ']."'> ".$form['fin_activ']."</div></td>         		
<td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_predecesora".$cant_filas."' type='hidden' value='".$form['predecesora']."'> ".$form['predecesora']." </div></td>  		
<td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_resp".$i."' type='hidden' value='".$form['resp_asig']."'> ".$form['resp_asig']." </div></td>
				          		  		           
       			</tr>";
		//$obj->addAlert($cont_responsables);
	}			
	$dev.="</table>";	
		
    $obj->addAssign("div_celdas","innerHTML",$dev);	
	
	$cant_filas++;
    $obj->addAssign("campo_cant_filas","value",$cant_filas);
	
	$obj->addAssign("campo_cont_recursos_asignados","value",0);
	$obj->addAssign("campo_cont_responsables_asignados","value",0);
	
    $obj->addAssign("nom_act_esp","value","");
    $obj->addAssign("descrip_activ_esp","value",""); 
	$obj->addAssign("porcentaje","value","");
    $obj->addAssign("inicio_activ","value",""); 
	$obj->addAssign("fin_activ","value","");
 	$obj->addAssign("predecesora","value","");

	
    return $obj;

}

//*****************

//******************


function get_cabecera_de_tabla()
{
  $dev = "<table width='600' border='0' align='center' bordercolor='#000000'>
	 		<tr> 
			  <td height=31 colspan='13' bgcolor='#FFFFFF'> 
			  <div align='center' class=\"Estilo5\" style='color:#367EA6; font-weight: bold;'>Actividades Generales del Proyecto </div>			  </td>
			</tr>
       		<tr  bgcolor='#367EA6'>
         	  <td width='25'  rowspan='2'  class=\"nombre_tabla3\"><div align='center' class= Estilo3 >No</div></td>
       		  <td width='150' rowspan='2'  class=\"nombre_tabla3\"><div align='center' class= Estilo3 >Actividad</div></td>
       		  <td width='150' rowspan='2'  class=\"nombre_tabla3\"><div align='center' class= Estilo3 >Descripcion</div></td>
       		  <td width='25'  rowspan='2'  class=\"nombre_tabla3\"><div align='center' class= Estilo3 >Porcentaje </div></td>
			  <td width='50'  rowspan='2'  class=\"nombre_tabla3\"><div align='center' class= Estilo3 > Inicio </div></td>   
			  <td width='50'  rowspan='2'  class=\"nombre_tabla3\"><div align='center' class= Estilo3 > Fin </div></td>
       		  <td width='50'  rowspan='2'  class=\"nombre_tabla3\"><div align='center' class= Estilo3 >Predec</div></td>
	        </tr>
			<tr></tr>
			
			";		
				
	return $dev;
}

//------------------------------------------------------------------------------------

function tomar_datos_fila($form,$id_fila)
{
	$obj = new xajaxResponse();
	$vect = split("-",$id_fila);
	$id = $vect[1];
    $aux = "-";
	
	$vect2 =  split("-",$form['campo_duracion'.$id]);
	$duracion = $vect2[0];
	$tipo_duracion = $vect2[1];	
	
	$dev5.= "<input name='campo_id_fila' type='hidden' value='".$id."'>";		
			 
    //---------------
	 
 	 $obj->addAssign("nom_act_esp","value", $form['campo_nom_actividad'.$id]);	
	 $obj->addAssign("descrip_activ_esp","value", $form['campo_descrip_activ'.$id]);	
	 $obj->addAssign("porcentaje","value", $form['campo_porc'.$id]);	
	 $obj->addAssign("inicio_activ","value", $form['campo_inicio_activ'.$id]);	
	 $obj->addAssign("fin_activ","value", $form['campo_fin_activ'.$id]);	
	 $obj->addAssign("predecesora","value", $form['campo_predecesora'.$id]);	
	
	 $obj->addAssign("div_campos_ocultos","innerHTML",$dev5);
	 
 	 $obj->addAssign("boton_eliminar","style.visibility","visible");	
     $obj->addAssign("boton_modificar","style.visibility","visible");	
	 $obj->addAssign("boton_guardar","style.visibility","hidden");	

	return $obj;
}

//---------------------------------------------------------------------------------------

function eliminar_fila($form)
{
	$obj = new xajaxResponse();	
	$fecha_real =  date("y/m/d");

	$id = $form['campo_id_fila'];
    $aux = "-";	
	
    $dev = get_cabecera_de_tabla();				
	
	$cant_filas = $form['campo_cant_filas']; 	
	$c=1;
	for($i=1; $i < $cant_filas; $i++)
	{		  
	   if($i != $id)
	   {	
	      	$dev .="<tr id ='fila-".$c."' style='background:#F4ebf5' onMouseOver='prender_fila(this)' onMouseOut='apagar_fila(this)' onClick='js_tomar_datos_fila(this)'>
  <td class=\"nombre_tabla\"><div align=\"center\">".$c."</div></td>
  <td class=\"nombre_tabla\"><div align=\"justify\"><input name='campo_nom_actividad".$c."' type='hidden' value='".$form['campo_nom_actividad'.$i]."'>".$form['campo_nom_actividad'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"justify\"><input name='campo_descrip_activ".$c."' type='hidden' value='".$form['campo_descrip_activ'.$i]."'>".$form['campo_descrip_activ'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_responsable".$c."' type='hidden' value='".$form['campo_responsable'.$i]."'> ".$form['campo_responsable'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_select_edo_activ".$c."' type='hidden' value='".$form['campo_select_edo_activ'.$i]."'> ".$form['campo_select_edo_activ'.$i]." </div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_inicio_activ".$c."' type='hidden' value='".$form['campo_inicio_activ'.$i]."'> ".$form['campo_inicio_activ'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_fin_activ".$c."' type='hidden' value='".$form['campo_fin_activ'.$i]."'>".$form['campo_fin_activ'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_predecesora".$c."' type='hidden' value='".$form['campo_predecesora'.$i]."'> ".$form['campo_predecesora'.$i]." </div></td>  	
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_resp".$i."' type='hidden' value='".$form['campo_resp'.$i]."'> ".$form['campo_resp'.$i]." </div></td>
  	
       			</tr>";
		   $c++;
		 }
	}
							  	
    $obj->addAssign("div_celdas","innerHTML",$dev);		
	$cant_filas--;
    $obj->addAssign("campo_cant_filas","value",$cant_filas);
	
	
    $obj->addAssign("nom_actividad","value","");
    $obj->addAssign("descrip_activ","value",""); 
	$obj->addAssign("responsable","value","");
    $obj->addAssign("select_edo_activ","value","");
    $obj->addAssign("inicio_activ","value",""); 
	$obj->addAssign("fin_activ","value","");
 	$obj->addAssign("predecesora","value","");
	
	
	$obj->addAssign("boton_eliminar","style.visibility","hidden");	
    $obj->addAssign("boton_modificar","style.visibility","hidden");	
    $obj->addAssign("boton_guardar","style.visibility","visible");	

    return $obj;
}

//-------------------------------------------------------------------------------------

function modificar_fila($form)
{
	$obj = new xajaxResponse();	
	$fecha_real =  date("y/m/d");	
	$id = $form['campo_id_fila'];
    $aux = "-";	
	
    $dev = get_cabecera_de_tabla();			
	
	$cant_filas = $form['campo_cant_filas']; 		
	//$obj->addAlert($cant_filas);
	for($i=1; $i < $cant_filas; $i++)
	{		  
	   if($i != $id)
	   {	
	   	//$obj->addAlert($i." != ".$id);
	      	$dev .="<tr id ='fila-".$i."' style='background:#F4ebf5' onMouseOver='prender_fila(this)' onMouseOut='apagar_fila(this)' onClick='js_tomar_datos_fila(this)'>
  <td class=\"nombre_tabla\"><div align=\"center\">".$i."</div></td>
  <td class=\"nombre_tabla\"><div align=\"justify\"><input name='campo_nom_actividad".$i."' type='hidden' value='".$form['campo_nom_actividad'.$i]."'>".$form['campo_nom_actividad'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"justify\"><input name='campo_descrip_activ".$i."' type='hidden' value='".$form['campo_descrip_activ'.$i]."'>".$form['campo_descrip_activ'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_porc".$i."' type='hidden' value='".$form['campo_porc'.$i]."'> ".$form['campo_porc'.$i]."%</div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_inicio_activ".$i."' type='hidden' value='".$form['campo_inicio_activ'.$i]."'> ".$form['campo_inicio_activ'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_fin_activ".$i."' type='hidden' value='".$form['campo_fin_activ'.$i]."'>".$form['campo_fin_activ'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_predecesora".$i."' type='hidden' value='".$form['campo_predecesora'.$i]."'> ".$form['campo_predecesora'.$i]." </div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_resp".$i."' type='hidden' value='".$form['campo_resp'.$i]."'> ".$form['campo_resp'.$i]." </div></td>  		
       			</tr>";
	    }
		else
		{
		$dev .="<tr id ='fila-".$i."' style='background:#F4ebf5' onMouseOver='prender_fila(this)' onMouseOut='apagar_fila(this)' onClick='js_tomar_datos_fila(this)'>
<td class=\"nombre_tabla\"><div align=\"center\">".$i."</div></td>				  
<td class=\"nombre_tabla\"><div align=\"justify\"><input name='campo_nom_actividad".$i."' type='hidden' value='".$form['nom_act_esp']."'> ".$form['nom_act_esp']." </div></td>
<td class=\"nombre_tabla\"><div align=\"justify\"><input name='campo_descrip_activ".$i."' type='hidden' value='".$form['descrip_activ_esp']."'> ".$form['descrip_activ_esp']." </div></td>
<td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_porc".$i."' type='hidden' value='".$form['porcentaje']."'> ".$form['porcentaje']."%</div></td>	
<td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_inicio_activ".$i."' type='hidden' value='".$form['inicio_activ']."'> ".$form['inicio_activ']."</div></td>    
<td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_fin_activ".$i."' type='hidden' value='".$form['fin_activ']."'> ".$form['fin_activ']."</div></td>         		
<td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_predecesora".$i."' type='hidden' value='".$form['predecesora']."'> ".$form['predecesora']." </div></td><td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_resp".$i."' type='hidden' value='".$form['resp_asig']."'> ".$form['resp_asig']." </div></td> 		
				          		  		           
       			</tr>";
		}
		
	}
		
	
		
    $obj->addAssign("div_celdas","innerHTML",$dev);			
	
	$obj->addAssign("campo_cont_recursos_asignados","value",0);	
	$obj->addAssign("campo_cont_responsables_asignados","value",0);	

	
    $obj->addAssign("nom_act_esp","value","");
    $obj->addAssign("descrip_activ_esp","value",""); 
    $obj->addAssign("porcentaje","value","");
    $obj->addAssign("inicio_activ","value",""); 
	$obj->addAssign("fin_activ","value","");
 	$obj->addAssign("predecesora","value","");
//	$obj->addAssign("text_cant_recursos","value","");
	
	
	$obj->addAssign("boton_eliminar","style.visibility","hidden");	
    $obj->addAssign("boton_modificar","style.visibility","hidden");	
    $obj->addAssign("boton_guardar","style.visibility","visible");	

    return $obj;
}




//************************************ FIN DE AGREGAR ACTIVIVDADES DINAMICAMENTE 1 ****************************
//**************************************************************************************************************************
//***********************************  AGREGAR ACTIVIDADES DINAMICAMENTE en actividades_proyecto ***************************

function agregar_fila2($form,$es_boton)
{
    $obj = new xajaxResponse();	
	$aux = "-";
    $dev = get_cabecera_de_tabla2();	
	$fecha_real =  date("y/m/d");
	
	$cant_filas = $form['campo_cant_filas']; 	
	//$obj->addAlert($cant_filas."cantidad filas");
	
	if($es_boton == 'true')
	{
	   for($i=1; $i < $cant_filas; $i++)
	   {		
  	      //$obj->addAlert($i." cantidad i");
	      $dev .="<tr id ='fila-".$i."' style='background:#F4ebf5' onMouseOver='prender_fila(this)' onMouseOut='apagar_fila(this)' onClick='js_tomar_datos_fila(this)'>
  <td class=\"nombre_tabla\"><div align=\"center\">".$i."</div></td>
  <td class=\"nombre_tabla\"><div align=\"justify\"><input name='campo_nom_actividad".$i."' type='hidden' value='".$form['campo_nom_actividad'.$i]."'>".$form['campo_nom_actividad'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"justify\"><input name='campo_descrip_activ".$i."' type='hidden' value='".$form['campo_descrip_activ'.$i]."'>".$form['campo_descrip_activ'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_responsable".$i."' type='hidden' value='".$form['campo_responsable'.$i]."'> ".$form['campo_responsable'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_select_edo_activ".$i."' type='hidden' value='".$form['campo_select_edo_activ'.$i]."'> ".$form['campo_select_edo_activ'.$i]." </div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_inicio_activ".$i."' type='hidden' value='".$form['campo_inicio_activ'.$i]."'> ".$form['campo_inicio_activ'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_fin_activ".$i."' type='hidden' value='".$form['campo_fin_activ'.$i]."'>".$form['campo_fin_activ'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_predecesora".$i."' type='hidden' value='".$form['campo_predecesora'.$i]."'> ".$form['campo_predecesora'.$i]." </div></td>  	
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_resp".$i."' type='hidden' value='".$form['campo_resp'.$i]."'> ".$form['campo_resp'.$i]." </div></td>  		
       			</tr>";

 		//$obj->addAlert($form['campo_cont_responsables_fila'.$i]);
		}
	} 
	else
	{
	  // $obj_actividad = new Actividad();
	  // $id_proyecto = $form['id_proy'];
	   //$obj->addAlert($id_proyecto);
	   
	   //$obj->addAlert($obj_actividad->hay_actividades($id_proyecto));
	   /*if($obj_actividad->hay_actividades($id_proyecto) == true)
	   { 	   	   
	       $obj = listar_actividades2($id_proyecto);	// 2 es el id del proyecto
		   return $obj;
	   }*/
	} 
	

	if($es_boton == 'true')
	{	
	 //$obj->addAlert(" entro al if ");
$dev .= "<tr id ='fila-".$cant_filas."' style='background:#F4ebf5' onMouseOver='prender_fila(this)' onMouseOut='apagar_fila(this)' onClick='js_tomar_datos_fila(this)'>
<td class=\"nombre_tabla\"><div align=\"center\">".$cant_filas."</div></td>				  
<td class=\"nombre_tabla\"><div align=\"justify\"><input name='campo_nom_actividad".$cant_filas."' type='hidden' value='".$form['nom_actividad']."'> ".$form['nom_actividad']." </div></td>
<td class=\"nombre_tabla\"><div align=\"justify\"><input name='campo_descrip_activ".$cant_filas."' type='hidden' value='".$form['descrip_activ']."'> ".$form['descrip_activ']." </div></td>
<td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_responsable".$cant_filas."' type='hidden' value='".$form['responsable']."'> ".$form['responsable']." </div></td>	      				
<td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_select_edo_activ".$cant_filas."' type='hidden' value='".$form['select_edo_activ']."'> ".$form['select_edo_activ']." </div></td>
<td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_inicio_activ".$cant_filas."' type='hidden' value='".$form['inicio_activ']."'> ".$form['inicio_activ']."</div></td>    
<td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_fin_activ".$cant_filas."' type='hidden' value='".$form['fin_activ']."'> ".$form['fin_activ']."</div></td>         		
<td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_predecesora".$cant_filas."' type='hidden' value='".$form['predecesora']."'> ".$form['predecesora']." </div></td>
<td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_resp".$cant_filas."' type='hidden' value='".$form['resp_asig']."'> ".$form['resp_asig']." </div></td>  		
				          		  		           
       			</tr>";
		//$obj->addAlert($cont_responsables);
	}			
	$dev.="</table>";	
		
    $obj->addAssign("div_celdas","innerHTML",$dev);	
	
	$cant_filas++;
	
    $obj->addAssign("campo_cant_filas","value",$cant_filas);

	
	$obj->addAssign("campo_cont_recursos_asignados","value",0);
	$obj->addAssign("campo_cont_responsables_asignados","value",0);
	
    $obj->addAssign("nom_actividad","value","");
    $obj->addAssign("descrip_activ","value",""); 
	$obj->addAssign("responsable","value","");
    $obj->addAssign("select_edo_activ","value","");
    $obj->addAssign("inicio_activ","value",""); 
	$obj->addAssign("fin_activ","value","");
 	$obj->addAssign("predecesora","value","");

	
    return $obj;

}

//******************

function tomar_datos_fila2($form,$id_fila)
{
	$obj = new xajaxResponse();
	$vect = split("-",$id_fila);
	$id = $vect[1];
    $aux = "-";
	
	$vect2 =  split("-",$form['campo_duracion'.$id]);
	$duracion = $vect2[0];
	$tipo_duracion = $vect2[1];	
	
	$dev5.= "<input name='campo_id_fila' type='hidden' value='".$id."'>";		
			 
    //---------------
	 
 	 $obj->addAssign("nom_actividad","value", $form['campo_nom_actividad'.$id]);	
	 $obj->addAssign("descrip_activ","value", $form['campo_descrip_activ'.$id]);	
	 $obj->addAssign("responsable","value", $form['campo_responsable'.$id]);	
	 $obj->addAssign("select_edo_activ","value", $form['campo_select_edo_activ'.$id]);	
	 $obj->addAssign("inicio_activ","value", $form['campo_inicio_activ'.$id]);	
	 $obj->addAssign("fin_activ","value", $form['campo_fin_activ'.$id]);	
	 $obj->addAssign("predecesora","value", $form['campo_predecesora'.$id]);	

	
	
	
	 $obj->addAssign("div_campos_ocultos","innerHTML",$dev5);
	 
 	 $obj->addAssign("boton_eliminar","style.visibility","visible");	
     $obj->addAssign("boton_modificar","style.visibility","visible");	
	 $obj->addAssign("boton_guardar","style.visibility","hidden");	

	return $obj;
}

//---------------------------------------------------------------------------------------

function eliminar_fila2($form)
{
	$obj = new xajaxResponse();	
	$fecha_real =  date("y/m/d");

	$id = $form['campo_id_fila'];
    $aux = "-";	
	
    $dev = get_cabecera_de_tabla2();				
	
	$cant_filas = $form['campo_cant_filas']; 	
	$c=1;
	for($i=1; $i < $cant_filas; $i++)
	{		  
	   if($i != $id)
	   {	
	      	$dev .="<tr id ='fila-".$c."' style='background:#F4ebf5' onMouseOver='prender_fila(this)' onMouseOut='apagar_fila(this)' onClick='js_tomar_datos_fila(this)'>
  <td class=\"nombre_tabla\"><div align=\"center\">".$c."</div></td>
  <td class=\"nombre_tabla\"><div align=\"justify\"><input name='campo_nom_actividad".$c."' type='hidden' value='".$form['campo_nom_actividad'.$i]."'>".$form['campo_nom_actividad'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"justify\"><input name='campo_descrip_activ".$c."' type='hidden' value='".$form['campo_descrip_activ'.$i]."'>".$form['campo_descrip_activ'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_responsable".$c."' type='hidden' value='".$form['campo_responsable'.$i]."'> ".$form['campo_responsable'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_select_edo_activ".$c."' type='hidden' value='".$form['campo_select_edo_activ'.$i]."'> ".$form['campo_select_edo_activ'.$i]." </div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_inicio_activ".$c."' type='hidden' value='".$form['campo_inicio_activ'.$i]."'> ".$form['campo_inicio_activ'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_fin_activ".$c."' type='hidden' value='".$form['campo_fin_activ'.$i]."'>".$form['campo_fin_activ'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_predecesora".$c."' type='hidden' value='".$form['campo_predecesora'.$i]."'> ".$form['campo_predecesora'.$i]." </div></td> 
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_resp".$c."' type='hidden' value='".$form['campo_resp'.$i]."'> ".$form['campo_resp'.$i]." </div></td>
       			</tr>";
		   $c++;
		 }
	}
		
	
				  	
    $obj->addAssign("div_celdas","innerHTML",$dev);		
	$cant_filas--;
    $obj->addAssign("campo_cant_filas","value",$cant_filas);
	
	
    $obj->addAssign("nom_actividad","value","");
    $obj->addAssign("descrip_activ","value",""); 
	$obj->addAssign("responsable","value","");
    $obj->addAssign("select_edo_activ","value","");
    $obj->addAssign("inicio_activ","value",""); 
	$obj->addAssign("fin_activ","value","");
 	$obj->addAssign("predecesora","value","");
	
	
	$obj->addAssign("boton_eliminar","style.visibility","hidden");	
    $obj->addAssign("boton_modificar","style.visibility","hidden");	
    $obj->addAssign("boton_guardar","style.visibility","visible");	

    return $obj;
}

//-------------------------------------------------------------------------------------

function modificar_fila2($form)
{
	$obj = new xajaxResponse();	
	$fecha_real =  date("y/m/d");	
	$id = $form['campo_id_fila'];
    $aux = "-";	
	
    $dev = get_cabecera_de_tabla2();			
	
	$cant_filas = $form['campo_cant_filas']; 		
	//$obj->addAlert($cant_filas);
	for($i=1; $i < $cant_filas; $i++)
	{		  
	   if($i != $id)
	   {	
	   	//$obj->addAlert($i." != ".$id);
	      	$dev .="<tr id ='fila-".$i."' style='background:#F4ebf5' onMouseOver='prender_fila(this)' onMouseOut='apagar_fila(this)' onClick='js_tomar_datos_fila(this)'>
  <td class=\"nombre_tabla\"><div align=\"center\">".$i."</div></td>
  <td class=\"nombre_tabla\"><div align=\"justify\"><input name='campo_nom_actividad".$i."' type='hidden' value='".$form['campo_nom_actividad'.$i]."'>".$form['campo_nom_actividad'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"justify\"><input name='campo_descrip_activ".$i."' type='hidden' value='".$form['campo_descrip_activ'.$i]."'>".$form['campo_descrip_activ'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_responsable".$i."' type='hidden' value='".$form['campo_responsable'.$i]."'> ".$form['campo_responsable'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_select_edo_activ".$i."' type='hidden' value='".$form['campo_select_edo_activ'.$i]."'> ".$form['campo_select_edo_activ'.$i]." </div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_inicio_activ".$i."' type='hidden' value='".$form['campo_inicio_activ'.$i]."'> ".$form['campo_inicio_activ'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_fin_activ".$i."' type='hidden' value='".$form['campo_fin_activ'.$i]."'>".$form['campo_fin_activ'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_predecesora".$i."' type='hidden' value='".$form['campo_predecesora'.$i]."'> ".$form['campo_predecesora'.$i]." </div></td>
  <td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_resp".$i."' type='hidden' value='".$form['campo_resp'.$i]."'> ".$form['campo_resp'.$i]." </div></td>  
       			</tr>";
	    }
		else
		{
		$dev .="<tr id ='fila-".$i."' style='background:#F4ebf5' onMouseOver='prender_fila(this)' onMouseOut='apagar_fila(this)' onClick='js_tomar_datos_fila(this)'>
<td class=\"nombre_tabla\"><div align=\"center\">".$i."</div></td>				  
<td class=\"nombre_tabla\"><div align=\"justify\"><input name='campo_nom_actividad".$i."' type='hidden' value='".$form['nom_actividad']."'> ".$form['nom_actividad']." </div></td>
<td class=\"nombre_tabla\"><div align=\"justify\"><input name='campo_descrip_activ".$i."' type='hidden' value='".$form['descrip_activ']."'> ".$form['descrip_activ']." </div></td>
<td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_responsable".$i."' type='hidden' value='".$form['responsable']."'> ".$form['responsable']." </div></td>	      				
<td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_select_edo_activ".$i."' type='hidden' value='".$form['select_edo_activ']."'> ".$form['select_edo_activ']." </div></td>
<td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_inicio_activ".$i."' type='hidden' value='".$form['inicio_activ']."'> ".$form['inicio_activ']."</div></td>    
<td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_fin_activ".$i."' type='hidden' value='".$form['fin_activ']."'> ".$form['fin_activ']."</div></td>         		
<td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_predecesora".$i."' type='hidden' value='".$form['predecesora']."'> ".$form['predecesora']." </div></td>
<td class=\"nombre_tabla\"><div align=\"center\"><input name='campo_resp".$i."' type='hidden' value='".$form['resp_asig']."'> ".$form['resp_asig']." </div></td>
				          		  		           
       			</tr>";
		}
		
	}
		
	
		
    $obj->addAssign("div_celdas","innerHTML",$dev);			
	
	$obj->addAssign("campo_cont_recursos_asignados","value",0);	
	$obj->addAssign("campo_cont_responsables_asignados","value",0);	
	
	
    $obj->addAssign("nom_actividad","value","");
    $obj->addAssign("descrip_activ","value",""); 
	$obj->addAssign("responsable","value","");
    $obj->addAssign("select_edo_activ","value","");
    $obj->addAssign("inicio_activ","value",""); 
	$obj->addAssign("fin_activ","value","");
 	$obj->addAssign("predecesora","value","");
//	$obj->addAssign("text_cant_recursos","value","");
	
	
	$obj->addAssign("boton_eliminar","style.visibility","hidden");	
    $obj->addAssign("boton_modificar","style.visibility","hidden");	
    $obj->addAssign("boton_guardar","style.visibility","visible");	

    return $obj;
}



//******************
//******************
function get_cabecera_de_tabla2()
{

   $dev = "<table width='620' border='0' align='center' bordercolor='#000000'>
	 		<tr> 
			  <td height=31 colspan='13' bgcolor='#FFFFFF'> 
			  <div align='center' class=\"nombre_tabla2\" style='color:#367EA6; font-weight: bold;'>Actividades Generales del Proyecto </div>			  </td>
			</tr>
       		<tr  bgcolor='#367EA6'>
         	  <td width='20'  rowspan='2'  class=\"nombre_tabla3\"><div align='center' ><em><strong>No</strong></em></div></td>
       		  <td width='130' rowspan='2'  class=\"nombre_tabla3\"><div align='center' ><em><strong>Actividad</strong></em></div></td>
       		  <td width='130' rowspan='2'  class=\"nombre_tabla3\"><div align='center' ><em><strong>Descripcion</strong></em></div></td>
       		  <td width='130' rowspan='2'  class=\"nombre_tabla3\"><div align='center' ><em><strong>Responsable</strong></em></div></td>
       		  <td width='50' rowspan='2'  class=\"nombre_tabla3\"><div align='center' ><em><strong>Estado</strong></em></div></td>
			  <td width='70' rowspan='2'  class=\"nombre_tabla3\"><div align='center' ><em><strong> Inicio </strong></em></div></td>   
			  <td width='70' rowspan='2'  class=\"nombre_tabla3\"><div align='center' ><em><strong> Fin </strong></em></div></td>
       		  <td width='20'  rowspan='2'  class=\"nombre_tabla3\"><div align='center' ><em><strong>Predc</strong></em></div></td>
	        </tr>
			<tr></tr>
			
			";		
				
	return $dev;
}


//---------------------  para guardar la info de las actividades  --------------------------
//------------------------------------------------------------------------------------------

function guardar_1($forma, $id_activ, $id_proy, $usuario)
{
	$objResponse = new xajaxResponse();
	
	/*$objResponse->addAlert("parametro llega acti: ".$id_activ);
	$objResponse->addAlert("parametro llega proy: ".$id_proy);
	$objResponse->addAlert("parametro llega usua: ".$usuario);*/
		 
	 
	$ban=0;
	//$Conex = new Proyecto();
	if($forma['actv']==0)
	{
	 
	$obj_actividades = new Actividad();	
	$actv_ob = new Actividad();	
	$obj_proy= new Proyecto();
	$BD = new BaseDatos();

	$id_proyect = $forma['id_proyectooo'];
	$nro_actividades = $forma['campo_cant_filas'];	

   /* $objResponse->addAlert("Campo oculto proy".$id_proyect);
	$objResponse->addAlert("Nun Actividades: ".$nro_actividades);*/
	
	$i=1;
	
	/*$objResponse->addAlert("Nun Actividades: ".$forma['campo_nom_actividad'.$i]);
	$objResponse->addAlert("Nun Actividades: ".$forma['campo_porc'.$i]);
	$objResponse->addAlert("Nun Actividades: ".$forma['campo_inicio_activ'.$i]);
	$objResponse->addAlert("Nun Actividades: ".$forma['campo_fin_activ'.$i]);
	$objResponse->addAlert("Nun Actividades: ".$forma['campo_descrip_activ'.$i]);	*/
	

	for($i=1; $i<$nro_actividades; $i++)
	{
		//$id_act=$actv_ob->get_id();
		$fecha_ini=$BD->converFecha($forma['campo_inicio_activ'.$i]);
		$fecha_fin=$BD->converFecha($forma['campo_fin_activ'.$i]);

		$Cad="insert into planificacion_actividad (id_planificacion_actividad, 
											aceptacion_actividad_id_aceptacion_actividad,    
											actividad_proyecto_id_actividad_proyecto,        
											num_planificacion, 
											nom_actividad,
											descripcion_planificacion, 
											fecha_inicio_planif, 
											fecha_culmi_planif, 
											porcentaje, 
											id_proyecto)
		 values( NULL,
		 		 NULL,
		         '$id_activ',
				 '$i',
				 '".$forma['campo_nom_actividad'.$i]."',
				 '".$forma['campo_descrip_activ'.$i]."',
				 '$fecha_ini',
				 '$fecha_fin',
				 '".$forma['campo_porc'.$i]."',		
				 '$id_proyect'
				)";	
				

				
		$actv_ob->insertar($Cad);
		
	/*	$respon = $forma['campo_resp'.$i];
				
		$id_act = $actv_ob->insertar_actividad2($respon);	
		$objResponse->addAlert("El id del responsable es: ".$respon);*/
		

		$Cadena_plan="update actividad_proyecto set bandera_planif_activ='1' where id_actividad_proyecto=' $id_activ'";
		$actv_ob->insertar($Cadena_plan);
		
		$ban=1;				
	}
			 
	}// fin del if de form[actv]

	if($ban==1)
	{
		$mensaje='El Proyecto se Guardo';
		$objResponse->addRedirect("actividades_asignado.php");   
	}
	else
	{	
		$objResponse->addAlert("Ocurrio un problema en la insercion <br> Vuelva a Intentar");
		$objResponse->addRedirect("actividades_asignado.php");			
	}
		


	 //$objResponse->addAssign("id_actividad_proyecto","value",$id);
	 $objResponse->addAssign("si_gua","innerHTML",$mensaje);
	 
	 return  $objResponse;
}

//-----------------------------------------------------------------------------------------------------

function mostrar_usuario($id_usua)
{
 $obj = new xajaxResponse();   
//   $Conex = new Tema();
   $ConexA = new Actividad();
   
   $salida_resp = $ConexA->buscar_usuario($id_usua);    
   
	foreach($salida_resp as $sal)
	{
		$dev2=" Sesion iniciada por:  ".$sal['nombre']." ".$sal['apellido']."";	  	
	
	}

    //$obj->addAlert($dev2);

	$obj->addAssign("usua_sesion","innerHTML",$dev2);		
	
	return $obj;
}


//-----------------------------------------------------------------------------------------------------

function actividades_proyectos($id_usua)  // lista todos los proyectos  FALTA QUE SEA CON EL USUARIO QUE ESTA LOGUEADO
{
   $obj = new xajaxResponse();   
   $ConexA = new Actividad();
   $salida = $ConexA->buscar_proyectos($id_usua);    

   //$obj->addAlert("Usuario: ".$id_usua);
   
   if($ConexA->list_proy($id_usua)>0)
	{
   
   $dev = "<table width='570' border='0' align='center' cellpadding='0' cellspacing='2'>
			<tr>
      			<td width='570' colspan='4' align='center'>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</td>
  			</tr>
   			<tr>
      			<td width='570' colspan='4' align='center'>
				<font color=\"#367EA6\" class='nombre_tabla2'><strong> Escoja el Proyecto a Planificar </strong></font> <br>
				 <div class=\"nombre_tabla\">( * Luego de escoger el proyecto haga CLICK en la pesta&ntilde;a Actividades del Proyecto para comenzar a Planificar )</div>
				</td>
  			</tr>
          	<tr>
            	<td width='216' class='Titulo' colspan='0' align='center'>&nbsp;</td>
			</tr>															   
          	<tr>
  			<tr bgcolor='#367EA6'> 			   		  
    			<td width=\"216\"align=\"center\">
					<font color=\"#FFFFFF\" class='nombre_tabla'><strong>Proyecto</strong></font>
				</td>
    			<td width=\"286\"align=\"center\">
					<font color=\"#FFFFFF\" class='nombre_tabla'><strong>Actividad Asignada</strong></font>		
				</td>    						   
				<td width=\"60\" align=\"center\">
					<font color=\"#FFFFFF\" class='nombre_tabla'><strong> Planificar </strong></font>		
				</td>			   
 			</tr>";
			
/*
  <td width='80' align='center' class='texto'>
				  <div align='center'>".$Usuario_tema->bus_dato($sal['creador'])."</div>
  </td>
*/
		  foreach($salida as $sal)
		  {
  			$dev=$dev."<tr  bgcolor='#f4ebf5'>
    			<td  class='nombre_tabla'>&nbsp;&nbsp;".$sal['proyecto_name']."&nbsp;&nbsp;</td>
    			<td  class='nombre_tabla'>&nbsp;&nbsp;".$sal['titulo']."&nbsp;&nbsp;</td>
				<td  align='center' class='nombre_tabla'><div align='center'>
				  <input name='seleccionar' id='seleccionar' type='radio' value=".$sal['id']."  onclick=\"validar_tablas($id_usua)\">
				</div></td>
  			</tr>";		
  		  }		  
		  $dev=$dev."</table>
		  			<table align='center'>
						<tr>
							<td>
							  &nbsp;	
							</td>
						</tr>
						
					</table>";;
					/* 
					<tr><td><input type='button' name='ver' value='Planificar Proyecto' onClick='validar_foro()'></td></tr>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 		
							  <input type='button' name='crear' value='Crear Tema' onClick='crear_foro()'> 	*/
	$obj->addAssign("div_temas","innerHTML",$dev);		
	}
	else
	{
	$mensaje=" &nbsp;  &nbsp; &nbsp; 
	              <p>&nbsp;</p>
	              <table align='center'>
					<tr align='center' valign='middle'>
                    <td width='350' bgcolor='#367EA6'><div align='center' class='Estilo1'>No hay Actividades Asignadas </div></td>
                  </tr>
</table>";


	$obj->addAssign("div_temas","innerHTML",$mensaje);
	}
	return $obj;
}

//----------  habilita el div de planificar las actividades  ----------------------

function habilitar2($id_act, $id_usua)  
{
   $obj = new xajaxResponse();   
//   $Conex = new Tema();
   $ConexA = new Actividad();
   
   $salida_resp = $ConexA->buscar_proyectos2($id_act, $id_usua);    

	
	foreach($salida_resp as $sal)
	{
		$dev="  ".$sal['titulo']."";				
		$dev2="  ".$sal['nombre']." ".$sal['apellido']."";	  	
		$dev3="  ".$sal['proy_name']."";	
		$dev4="  ".$sal['fechai']."";	
		$dev5="  ".$sal['fechaf']."";	
		$dev6=$sal['id_pro'];								
	}

   /* $obj->addAlert("Titulo: ".$dev);
	$obj->addAlert("Nombre: ".$dev2);
	$obj->addAlert("Proy name: ".$dev3);
	$obj->addAlert("inicio: ".$dev4);
	$obj->addAlert("Fin: ".$dev5);
	$obj->addAlert("Id proy: ".$dev6); */
	
	

	$obj->addAssign("nom_act_gral","innerHTML",$dev);	
	$obj->addAssign("nom_respo","innerHTML",$dev2);	
	$obj->addAssign("nom_proyecto","innerHTML",$dev3);
	$obj->addAssign("fecha_inicio","innerHTML",$dev4);
	$obj->addAssign("fecha_fin","innerHTML",$dev5);	
	$obj->addAssign("id_proyectooo","value",$dev6);	
	$obj->addAssign("id_actividad","value",$id_act);
	$obj->addAssign("ocultar","style.visibility","visible");
	
	
	
//	$obj->addAssign("id_proy_act","value",$id_proy);	
	
	return $obj;
}

//----------------------  nombre del usuario del proyecto -----------------------

function mostrar_nombre($idusua)  
{
   $obj = new xajaxResponse();   
//   $Conex = new Tema();
   $ConexA = new Actividad();
   
   $salida = $ConexA->buscar_nombre_resp($idusua);    
  
	foreach($salida as $sal)
		  {
  			$dev="    ".$sal['nombre']." ".$sal['apellido']."";		
  		  }		  	

	$obj->addAssign("nom_lider","innerHTML",$dev);	
	
	return $obj;
}

//-------------------------------------------  para escoger el proyecto a planificar  ---------------------------

function notificacion_proyectos($id_usua)  // lista todos los proyectos  FALTA QUE SEA CON EL USUARIO QUE ESTA LOGUEADO
{
   $obj = new xajaxResponse();   
//   $Conex = new Tema();
   $ConexP = new Proyecto();
   $salida = $ConexP->buscar_proyectos($id_usua);    
//   $Usuario_tema = new Usuario();
   
   
   /*<td width=\"80\" align=\"center\"><font color=\"#000000\" class='texto'><strong>Creador<strong></font></td>*/
   
   if($ConexP->list_proy($id_usua)>0)
	{
   
   $dev = "<table width='570' border='0' align=\"center\" cellpadding='0' cellspacing='2'>
			<tr>
      			<td width='570' colspan='4' align=\"center\">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</td>
  			</tr>
   			<tr>
      			<td width='570' colspan='4' align=\"center\">
				<font color=\"#367EA6\" class='nombre_tabla2'><strong> Escoja el Proyecto para Generar la Notificacion </strong></font> <br>
				 <div class=\"nombre_tabla\">( * Luego de escoger el proyecto haga CLICK en la pesta&ntilde;a siguiente )</div>
				</td>
  			</tr>
          	<tr>
            	<td width='216' class='Titulo' colspan='0' align=\"center\">&nbsp;</td>
			</tr>															   
          	<tr>
  			<tr bgcolor='#367EA6'> 			   		  
    			<td width=\"216\"align=\"center\">
					<font color=\"#FFFFFF\" class='nombre_tabla'><strong>Proyecto</strong></font>
				</td>
    			<td width=\"286\"align=\"center\">
					<font color=\"#FFFFFF\" class='nombre_tabla'><strong>Descripci&oacute;n</strong></font>		
				</td>
    						   
				<td width=\"60\" align=\"center\">
					<font color=\"#FFFFFF\" class='nombre_tabla'><strong> Planificar </strong></font>		</td>			   
 			</tr>";
			
/*
  <td width='80' align='center' class='texto'>
				  <div align='center'>".$Usuario_tema->bus_dato($sal['creador'])."</div>
  </td>
*/
		  foreach($salida as $sal)
		  {
  			$dev=$dev."<tr  bgcolor='#f4ebf5'>
    			<td  class='nombre_tabla'>&nbsp;&nbsp;".$sal['titulo']."&nbsp;&nbsp;</td>
    			<td  class='nombre_tabla'>&nbsp;&nbsp;".$sal['descripcion']."&nbsp;&nbsp;</td>
				<td  class='nombre_tabla'><div align='center'>
				  <input name='seleccionar' id='seleccionar' type='radio' value=".$sal['id']."  onclick=\"javascript:validar_tablasxxx()\">
				</div></td>
  			</tr>";		
  		  }		  
		  $dev=$dev."</table>
		  			<table align=\"center\">
						<tr>
							<td>
							  &nbsp;	
							</td>
						</tr>
						
					</table>";;
					/* 
					<tr><td><input type='button' name='ver' value='Planificar Proyecto' onClick='validar_foro()'></td></tr>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 		
							  <input type='button' name='crear' value='Crear Tema' onClick='crear_foro()'> 	*/
	$obj->addAssign("div_temas","innerHTML",$dev);		
	}
	else
	{
	$mensaje="&nbsp;&nbsp;&nbsp;
	              <p>&nbsp;</p>
				  <table align=\"center\">
					<tr align=\"center\" valign='middle'>
                    <td width='350' bgcolor='#367EA6'><div align='center' class='Estilo1'>No hay Proyectos creados </div></td>
                  </tr>
</table>";


	$obj->addAssign("div_temas","innerHTML",$mensaje);
	}
	return $obj;
}

//-----------------------------------------------------------------------------


function proyectos_foro($id_usua)  // lista todos los proyectos  FALTA QUE SEA CON EL USUARIO QUE ESTA LOGUEADO
{
   $obj = new xajaxResponse();   
//   $Conex = new Tema();
   $ConexP = new Proyecto();
   $salida = $ConexP->buscar_proyectos($id_usua);    
//   $Usuario_tema = new Usuario();
   
   
   /*<td width=\"80\" align=\"center\"><font color=\"#000000\" class='texto'><strong>Creador<strong></font></td>*/
   
   if($ConexP->list_proy($id_usua)>0)
	{
   
   $dev = "<table width='570' border='0' align='center' cellpadding='0' cellspacing='2'>
			<tr>
      			<td width='570' colspan='4' align='center'>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</td>
  			</tr>
   			<tr>
      			<td width='570' colspan='4' align='center'>
				<font color=\"#367EA6\" class='nombre_tabla2'><strong> Escoja el Proyecto </strong></font> <br>
				 <div class=\"nombre_tabla\">( * Luego de escoger el proyecto haga CLICK en la pesta&ntilde;a Crear Nuevo Foro )</div>
				</td>
  			</tr>
          	<tr>
            	<td width='216' class='Titulo' colspan='0' align='center'>&nbsp;</td>
			</tr>															   
          	<tr>
  			<tr bgcolor='#367EA6'> 			   		  
    			<td width=\"216\"align=\"center\">
					<font color=\"#FFFFFF\" class='nombre_tabla'><strong>Proyecto</strong></font>
				</td>
    			<td width=\"286\"align=\"center\">
					<font color=\"#FFFFFF\" class='nombre_tabla'><strong>Descripci&oacute;n</strong></font>		
				</td>
    						   
				<td width=\"60\" align=\"center\">
					<font color=\"#FFFFFF\" class='nombre_tabla'><strong> Planificar </strong></font>		</td>			   
 			</tr>";
			
/*
  <td width='80' align='center' class='texto'>
				  <div align='center'>".$Usuario_tema->bus_dato($sal['creador'])."</div>
  </td>
*/
		  foreach($salida as $sal)
		  {
  			$dev=$dev."<tr  bgcolor='#f4ebf5'>
    			<td  class='nombre_tabla'>&nbsp;&nbsp;".$sal['titulo']."&nbsp;&nbsp;</td>
    			<td  class='nombre_tabla'>&nbsp;&nbsp;".$sal['descripcion']."&nbsp;&nbsp;</td>
				<td  align='center' class='nombre_tabla'><div align='center'>
				  <input name='seleccionar' id='seleccionar' type='radio' value=".$sal['id']."  onclick='validar_tablas()'>
				</div></td>
  			</tr>";		
  		  }		  
		  $dev=$dev."</table>
		  			<table align='center'>
						<tr>
							<td>
							  &nbsp;	
							</td>
						</tr>
						
					</table>";;
					/* 
					<tr><td><input type='button' name='ver' value='Planificar Proyecto' onClick='validar_foro()'></td></tr>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 		
							  <input type='button' name='crear' value='Crear Tema' onClick='crear_foro()'> 	*/
	$obj->addAssign("div_temas","innerHTML",$dev);		
	}
	else
	{
	$mensaje="&nbsp;&nbsp;&nbsp;
	              <p>&nbsp;</p>
				  <table align='center'>
					<tr align='center' valign='middle'>
                    <td width='350' bgcolor='#367EA6'><div align='center' class='Estilo1'>No hay Proyectos creados </div></td>
                  </tr>
</table>";


	$obj->addAssign("div_temas","innerHTML",$mensaje);
	}
	return $obj;
}


//---------------------------------------------------------------------------------
function proyectos_actividades3($id_usua)  // lista todos los proyectos  FALTA QUE SEA CON EL USUARIO QUE ESTA LOGUEADO
{
   $obj = new xajaxResponse();   
//   $Conex = new Tema();
   $ConexP = new Proyecto();
   $salida = $ConexP->buscar_proyectos_actividad($id_usua);    
//   $Usuario_tema = new Usuario();
   
   
   /*<td width=\"80\" align=\"center\"><font color=\"#000000\" class='texto'><strong>Creador<strong></font></td>*/
   
   if($ConexP->list_proy($id_usua)>0)
	{
   
   $dev = "<div aling=\"center\">
   			<table width='570' border='0' align='center' cellpadding='0' cellspacing='2'>
			<tr>
      			<td width='570' colspan='4' align='center'>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</td>
  			</tr>
   			<tr>
      			<td width='570' colspan='4' align='center'>
				<font color=\"#367EA6\" class='nombre_tabla2'><strong> Escoja el Proyecto a Planificar </strong></font> <br>
				<div class=\"nombre_tabla\">( * Luego de escoger el proyecto haga CLICK en la pesta&ntilde;a Actividades del Proyecto para comenzar a Planificar)</div>
				</td>
  			</tr>
          	<tr>
            	<td width='216' class='Titulo' colspan='0' align='center'>&nbsp;</td>
			</tr>															   
          	<tr>
  			<tr bgcolor='#367EA6'> 			   		  
    			<td width=\"216\"align=\"center\">
					<font color=\"#FFFFFF\" class='nombre_tabla'><strong>Proyecto</strong></font>
				</td>
    			<td width=\"286\"align=\"center\">
					<font color=\"#FFFFFF\" class='nombre_tabla'><strong>Descripci&oacute;n</strong></font>		
				</td>
    						   
				<td width=\"60\" align=\"center\">
					<font color=\"#FFFFFF\" class='nombre_tabla'><strong> Planificar </strong></font>		</td>			   
 			</tr>";
			
/*
  <td width='80' align='center' class='texto'>
				  <div align='center'>".$Usuario_tema->bus_dato($sal['creador'])."</div>
  </td>
*/
		  foreach($salida as $sal)
		  {
  			$dev=$dev."<tr  bgcolor='#f4ebf5'>
    			<td  class='nombre_tabla'>&nbsp;&nbsp;".$sal['titulo']."&nbsp;&nbsp;</td>
    			<td  class='nombre_tabla'>&nbsp;&nbsp;".$sal['descripcion']."&nbsp;&nbsp;</td>
				<td  align='center' class='nombre_tabla'><div align='center'>
				  <input name='seleccionar' id='seleccionar' type='radio' value=".$sal['id']."  onclick='validar_tablas()'>
				</div></td>
  			</tr>";		
  		  }		  
		  $dev=$dev."</table>
		  			<table align='center'>
						<tr>
							<td>
							  &nbsp;	
							</td>
						</tr>
						
					</table>
					</div>";;
					/* 
					<tr><td><input type='button' name='ver' value='Planificar Proyecto' onClick='validar_foro()'></td></tr>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 		
							  <input type='button' name='crear' value='Crear Tema' onClick='crear_foro()'> 	*/
	$obj->addAssign("div_temas","innerHTML",$dev);		
	}
	else
	{
	$mensaje="&nbsp;&nbsp;&nbsp;
	              <p>&nbsp;</p>
				  <table align='center'>
					<tr align='center' valign='middle'>
                    <td width='350' bgcolor='#367EA6'><div align='center' class='Estilo1'>No hay Proyectos para Planificar </div></td>
                  </tr>
</table>";


	$obj->addAssign("div_temas","innerHTML",$mensaje);
	}
	return $obj;
}

//------------------------------------------------------------------------

function habilitar_acti($id_proy)  
{
   $obj = new xajaxResponse();   
//   $Conex = new Tema();
   $ConexP = new Proyecto();
   $ConexN = new Notificacion();
   
   $salida = $ConexP->buscar_proyectos2($id_proy);   

	foreach($salida as $sal)
		  {
  			$dev="".$sal['titulo']."";		
			$dev2="".$sal['nombre']." ".$sal['apellido']."";
  		  }		  	
		  	

   /* $obj->addAlert($dev);
	$obj->addAlert($dev2);
	$obj->addAlert(" el id asignado es: ".$id_proy);  */
	
	$obj->addAssign("id_proy_act","value",$id_proy);
	$obj->addAssign("nom_proyecto","innerHTML",$dev);	
	$obj->addAssign("nom_persona","innerHTML",$dev2);	
	$obj->addAssign("ocultar","style.visibility","visible");
	
	
	return $obj;
}



//----------  habilita el div de planificar las actividades  ----------------------

function habilitar($id_proy, $id_usua)  
{
   $obj = new xajaxResponse();   
//   $Conex = new Tema();
   $ConexP = new Proyecto();
   $ConexN = new Notificacion();
   $ConexA = new Actividad();
   
   $salida = $ConexP->buscar_proyectos2($id_proy);   

	foreach($salida as $sal)
		  {
  			$dev=" ".$sal['titulo']."";		
			$dev2222="".$sal['nombre']." ".$sal['apellido']."";
  		  }		  			  			
   
   $salida_resp = $ConexA->buscar_usuario($id_usua);    
   
	foreach($salida_resp as $sal)
	{
		$dev2=" ".$sal['nombre']." ".$sal['apellido']."";	  	
	
	}

    /*$obj->addAlert($dev);
	$obj->addAlert($dev2);
	$obj->addAlert(" el id asignado es: ".$id_proy);*/
	
	$obj->addAssign("id_proyecto_notif","value",$id_proy);
	$obj->addAssign("nom_proyecto","innerHTML",$dev);	
	$obj->addAssign("nom_persona","innerHTML",$dev2);	
	$obj->addAssign("ocultar","style.visibility","visible");
	
	
	return $obj;
}

//------------------------------------------------------------------------------------

function mostrar($id_proy)  
{
   $obj = new xajaxResponse();   
   $ConexN = new Notificacion();
   $salida=$ConexN->buscar_notificacion($id_proy);   

     if($ConexN->list_notif($id_proy)>0)	
	 {	    
    	$i=1;
		foreach($salida as $sal)
		{  			
		$dev=$dev."<table width=\"500\" bordercolor=\"#999999\" align=\"center\" >
        <tr >
        	<td valign=\"middle\" width=\"160\" >
			  <div width=\"160\" align=\"center\" class=\"nombre_tabla2\" ><strong>Notificaci&oacute;n: ".$i."</strong></div>
			</td>
			<td valign=\"middle\" width=\"340\">
			</td>
		</tr>
		</table>
		<table width=\"500\" bordercolor=\"#999999\" align=\"center\">
		<tr bgcolor=\"#FFFFFF\"> 
			<td align=\"left\" valign=\"middle\" width=\"100\">
			  <div align=\"left\" class=\"titulo\">Responsable: </div>
		    </td>
		    <td valign=\"middle\" width=\"200\">
				<div align=\"center\" class=\"nombre_tabla\" id=\"nom_persona_creadora\">&nbsp;&nbsp;&nbsp;".$sal['nombre']." ".$sal['apellido']."</div>
			</td>
			<td valign=\"middle\" width=\"100\" >
			  <div align=\"left\" class=\"titulo\">Fecha de la Notificacion:</div>
		    </td>
			<td align=\"center\" valign=\"middle\" width=\"100\">
			  <div align=\"center\" class=\"nombre_tabla\" id=\"fecha_notif\">&nbsp;&nbsp;&nbsp;".$sal['fecha']." </div>
		  </td>
        </tr>
		</table>
		<table width=\"500\" bordercolor=\"#999999\" align=\"center\">				
        <tr bgcolor=\"#FFFFFF\" >
			<td align=\"center\" valign=\"middle\" width=\"160\" >
				<div align=\"left\" class=\"titulo\" >Notificaci&oacute;n: </div>
			</td>
			<td colspan=\"3\" align=\"center\" valign=\"top\" width=\"340\" >
				<div align=\"left\" class=\"nombre_tabla\" id=\"notif\"> ".$sal['descripcion']." </div>
			</td>
		</tr>
		</table>
		<br>
		<br>";		
		$i++;			
  		  }		  	

		$obj->addAssign("not","innerHTML",$dev);
		$obj->addAssign("ocultar","style.visibility","visible");
	}
	else
	{
	$mensaje="<p>&nbsp;</p>
		   <table align='center'>
		   <tr align='center' valign='middle'>
           <td width='350' bgcolor='#367EA6'><div align='center' class='Estilo3'>No hay Notificacaiones creadas para este proyecto </div></td>
           </tr>
</table>";


	$obj->addAssign("not","innerHTML",$mensaje);
	}
	
	
	return $obj;
}


//-----------------------------------------

function habilitar3($id_proy)  
{
   $obj = new xajaxResponse();   
//   $Conex = new Tema();
   $ConexP = new Proyecto();
   
   $salida = $ConexP->buscar_proyectos2($id_proy);    
  

	foreach($salida as $sal)
		  {
  			$dev="".$sal['titulo']."";		
			$dev2="".$sal['nombre']." ".$sal['apellido']."";
  		  }		  	

    /*$obj->addAlert($dev);
	$obj->addAlert($id_proy); */
	
	$obj->addAssign("id_foro","value",$id_proy);
	$obj->addAssign("nom_proyecto","innerHTML",$dev);	
	$obj->addAssign("nom_persona","innerHTML",$dev2);	
	$obj->addAssign("ocultar","style.visibility","visible");
	
	
	return $obj;
}



//------------------------  proyectos asignados  ----------------------------------

function proyectos_asignados($usu)  // lista todos los proyectos
{
   $obj = new xajaxResponse();   
   $ConexP = new Proyecto();
   $salida = $ConexP->buscar_proyectos3($usu);    
   
   //$obj->addAlert($salida);
   
   /*<td width=\"80\" align=\"center\"><font color=\"#000000\" class='texto'><strong>Creador<strong></font></td>*/
   //FALTA EL ESTADO DEL PROYECTO
   
   if($ConexP->list_proy($usu)>0)
	{
   
   $dev = "<table width='600' border='0' align='center' cellpadding='0' cellspacing='2'>
			<tr>
      			<td width='900' colspan='4' align='center'>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</td>
  			</tr>
          	        
					
			<tr bgcolor=\"#367EA6\">
              <td width=\"200\" bordercolor=\"#367EA6\" bgcolor=\"#367EA6\" class=\"nombre_tabla3\"><div align=\"center\"> Proyecto </div></td>
              <td width=\"200\" bordercolor=\"#367EA6\" bgcolor=\"#367EA6\" class=\"nombre_tabla3\"><div align=\"center\"> Actividad Asignada </div></td>
              <td width=\"100\" bordercolor=\"#367EA6\" bgcolor=\"#367EA6\" class=\"nombre_tabla3\"><div align=\"center\"> Inicio </div></td>
			  <td width=\"100\" bordercolor=\"#367EA6\" bgcolor=\"#367EA6\" class=\"nombre_tabla3\"><div align=\"center\"> Fin </div></td>
            </tr>	";
			
		  foreach($salida as $sal)
		  {     

  			$dev=$dev."<tr id ='".$sal['id']."' style='background:#F4ebf5' onMouseOver='prender_fila(this)' onMouseOut='apagar_fila(this)' onClick='js_tomar_datos_fila(this)'>
    			<td  class=\"nombre_tabla\">&nbsp;&nbsp;".$sal['proyecto_name']."&nbsp;&nbsp;</td>
				<td  class=\"nombre_tabla\">&nbsp;&nbsp;".$sal['titulo']."&nbsp;&nbsp;</td>
				<td  class=\"nombre_tabla\">&nbsp;&nbsp;".$sal['fecha_i']."&nbsp;&nbsp;</td>
				<td  class=\"nombre_tabla\">&nbsp;&nbsp;".$sal['fecha_f']."&nbsp;&nbsp;</td>				
  			</tr>
			<tr >
			  <td colspan=\"4\"  class='Estilo15'>
			  	<div align=\"left\" id=\"mostrar_act".$sal['id']."\">
				</div>
			  </td>
			</tr>";	
			
			$dev2 = "".$sal['nombre']." ".$sal['apellido']."";
  		  }		  
		  $dev=$dev."</table>
		  			<table align='center'>
						<tr>
							<td>
							  &nbsp;	
							</td>
						</tr>						
					</table>";;
					/* 
					<tr><td><input type='button' name='ver' value='Planificar Proyecto' onClick='validar_foro()'></td></tr>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 		
							  <input type='button' name='crear' value='Crear Tema' onClick='crear_foro()'> 	*/
	$obj->addAssign("proy_asignados","innerHTML",$dev);		
	$obj->addAssign("nom_persona","innerHTML",$dev2);
	}
	else
	{		
    $ConexP = new Proyecto();
    $salida = $ConexP->buscar_proyectos_aux($usu);    
    
	//$obj->addAlert($salida);
		
	$dev2 = "".$salida['nombre']." ".$salida['apellido']."";
    //$obj->addAlert($dev2);
	
	$mensaje="<table align='center'>
					<tr align='center' valign='middle'>
                    <td width='350' bgcolor='#367EA6'><div align='center' class='textonegrita'>No hay Proyectos creados </div></td>
                  </tr>
				</table>";


	$obj->addAssign("proy_asignados","innerHTML",$mensaje);
	$obj->addAssign("nom_persona","innerHTML",$dev2);
	}
	return $obj;
}


//-----------------------------


function mostrar_actividades($form,$id_fila,$usua)
{
	$obj = new xajaxResponse();
	$obj_proy = new Actividad();
	
	//$obj->addAlert($id_fila);
//	$salidas = $ConexP->buscar_proyectos3($usu); 		
	$salida= $obj_proy->buscar_actividades($id_fila);
		

/*<td width='191' rowspan='2'  class=\"Estilo16\"><div align='center' class= Estilo1 ><em><strong>Responsable</strong></em></div></td>*/	

 if($obj_proy->buscar_actividades_lista($id_fila)>0)
	{

	 $dev = "<table width='580' border='0' align=\"center\" bordercolor='#000000'>
	 		<tr> 
		  <td height=31 colspan='13' bgcolor='#FFFFFF'> 
		  <div align='center' style='color:#367EA6; font-weight: bold; font-size: 13px;'>Actividades Generales del Proyecto </div>			  </td>
  		    </tr>
       		<tr  bgcolor='#73AED6'>
         	  <td width='30'  rowspan='2' bgcolor=\"#73AED6\"  class=\"nombre_tabla3\"><div align='center' ><em><strong>No</strong></em></div></td>
       		  <td width='190' rowspan='2' bgcolor=\"#73AED6\"  class=\"nombre_tabla3\"><div align='center' >Actividad</div></td>
       		  <td width='190' rowspan='2' bgcolor=\"#73AED6\"  class=\"nombre_tabla3\"><div align='center' >Descripcion</div></td>
			  <td width='85' rowspan='2' bgcolor=\"#73AED6\"  class=\"nombre_tabla3\"><div align='center' >Inicio </div></td>   
			  <td width='85' rowspan='2' bgcolor=\"#73AED6\"  class=\"nombre_tabla3\"><div align='center' >Fin </div></td>
	        </tr>
			<tr></tr>";		

/*  <td class=\"Estilo15\"><div align=\"center\">".$sal['campo_responsable'.$i]."</div></td>*/
			
		  foreach($salida as $sal)
		  {     
  			$dev=$dev."<tr id ='".$sal['id']."' style='background:#ffffff'>    		 
   <td class=\"nombre_tabla\"><div align=\"center\" >".$sal['numero']."</div></td>
  <td class=\"nombre_tabla\"><div align=\"justify\" >".$sal['nombre']."</div></td>
  <td class=\"nombre_tabla\"><div align=\"justify\" >".$sal['descripcion']."</div></td>
  <td class=\"nombre_tabla\"><div align=\"center\" >".$sal['fechai'.$i]."</div></td>
  <td class=\"nombre_tabla\"><div align=\"center\" >".$sal['fechaf'.$i]."</div></td>
  </tr>";
  		  }		  
		  $dev=$dev."</table>
		  			<table align='center'>
						<tr>
							<td>
							  &nbsp;	
							</td>
						</tr>
						
					</table>";;				
		
	$dev5.= "hola mundo";		
			 
    //---------------
 	$obj->addAssign("mostrar_act".$id_fila,"innerHTML",$dev);	

}
else
{
		$mensaje="<table align=\"center\">
					<tr align='center' valign='middle'>
                    	<td width='350'  align=\"center\">
						<div align=\"center\" style='color:#367EA6; font-weight: bold; font-size: 13px;'>No hay actividades creadas </div>
						</td>
	                </tr>
				 </table>";


	$obj->addAssign("mostrar_act".$id_fila,"innerHTML",$mensaje);
}
	return $obj;
}


//----------------------------------------------------------------------------------------

function mostrar_actividades_grafica($id_fila)
{	
	$objResponse = new xajaxResponse();

	//$objResponse->addAlert($id_fila);
	
	$objResponse->addScript("var menu=window.open('mi_gand.php?idx=".$id_fila."','Sizewindow','scrollbars=yes,toolbar=no,status=yes')");
	$objResponse->addScript("menu.focus()");
	return $objResponse;
}




//------------------------------------  actividades asignadas  ------------------------------------

//************************************  fin de la actividades_proyecto  ****************************

//************************************        Foro      *********************************************
//**********************************  Agregar Comentario  *******************************************

function foro_mensajes_foro($id_usua, $valor)  // lista todos los foros
{
   $obj = new xajaxResponse();   
   $Conex = new Foro();
   $salida = $Conex->buscar_foros($valor);    

   if($Conex->list_foros($valor)>0)
	{
   
   $dev = "
   		<br>
		<br>
   		<table width='550' border='0' align='center' cellpadding='0' cellspacing='2'>
   			<tr>
      			<td width='550' colspan='4' align='center'>
				<font color=\"#367EA6\" class='titulo'> Foros creados para el Proyecto seleccionado  </font> 
				</td>
  			</tr>
          	<tr>
            	<td width='216' class='titulo' colspan='0' align='center'>&nbsp;</td>
			</tr>															   
          	<tr>
  			<tr bgcolor='#367EA6'> 			   		  
    			<td width=\"216\"align=\"center\">
					<font color=\"#FFFFFF\" class='nombre_tabla'><strong>Foros Creados</strong></font>
				</td>
    			<td width=\"286\"align=\"center\">
					<font color=\"#FFFFFF\" class='nombre_tabla'><strong>Descripci&oacute;n del Foro</strong></font>		
				</td>
    						   
				<td width=\"40\" align=\"center\">
					<font color=\"#FFFFFF\" class='nombre_tabla'><strong> Ir </strong></font>		</td>			   
 			</tr>";
			
		  foreach($salida as $sal)
		  {
  			$dev=$dev."<tr  bgcolor='#f4ebf5'>
    			<td  class='nombre_tabla'>&nbsp;&nbsp;&nbsp;".$sal['titulo']."</td>
    			<td  class='nombre_tabla'>&nbsp;&nbsp;&nbsp;".$sal['descripcion']."</td>
				<td  align='center' class='nombre_tabla'><div align='center'>
				  <input name='seleccionar' id='seleccionar' type='radio' value=".$sal['id'].">
				</div></td>
  			</tr>";		
  		  }		  
		  $dev=$dev."</table>
		  			<table align='center'>
						<tr>
							<td>
							  &nbsp;	
							</td>
						</tr>
						<tr>
							<td>

							  <input type='button' name='ver' value='Ingresar al Foro' onClick='validar_foro()' class='nombre_tabla'>
							  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 		
							  <input type='button' name='crear' value='Crear Tema' onClick='crear_foro($id_usua)' class='nombre_tabla'> 		

							</td>
						</tr>
					</table>";;
	$obj->addAssign("div_temas","innerHTML",$dev);		
	}
	else
	{
	$mensaje="<table align='center'>
					<tr align='center' valign='middle'>
                    <td width='350' bgcolor='#ffd988'><div align='center' class='textonegrita'>No hay Foros creados </div></td>
                  </tr>
				</table>";


	$obj->addAssign("div_temas","innerHTML",$mensaje);
	}
	return $obj;
}

//------------------------------------------------------------------------------

function temas_mensajes_foro($id_foro, $id)  // lista todos los temas
{

   $obj = new xajaxResponse();   
   $ConexF = new Foro();
   $Foro = $ConexF->titu_foro($id_foro);   // traer el nombre para mostrarlos
   $ConexT = new Tema();
   $Tema = $ConexF->titu_foro($id_foro);  

   $salida = $ConexT->buscar_mensajes($id_foro);
   $Row=$ConexF->BD->ExtraerRow();

   
   $dev = " <br> 
   			<br>
   			<table width='550' border='0' align='center' cellpadding='0' cellspacing='2'>
   			<tr>
      			<td width='550' colspan='4' align='center'>
				<font color=\"#367EA6\" class='titulo'><strong> Temas del Foro: </strong> <br>
				<font color=\"#367EA6\" class='titulo' style=\"font-size:16px\"> $Row[0]  </font> </font> 
				</td>
  			</tr>
			<tr>
            	<td width='216' class='Titulo' colspan='0' align='center'>&nbsp;</td>
			</tr>	
          	<tr>
            	<td width='216' class='Titulo' colspan='0' align='center'></td>
			</tr>															   
          	<tr>
  			<tr bgcolor='#367EA6'> 			   		  
    			<td width=\"216\"align=\"center\">
					<font color=\"#FFFFFF\" class='nombre_tabla'><strong>Temas del Foro</strong></font>
				</td>
    			<td width=\"285\"align=\"center\">
					<font color=\"#FFFFFF\" class='nombre_tabla'><strong>Descripci&oacute;n del Tema</strong></font>		
				</td>
    					   
				<td width=\"40\" align=\"center\">
					<font color=\"#FFFFFF\" class='nombre_tabla'><strong>IR</strong></font>		
				</td>			   
 			</tr>";
			

/*
<td width='80' align='center' class='texto'>
				  <div align='center'>".$Usuario_tema->bus_dato($sal['creador'])."</div>
				</td>

*/

		  foreach($salida as $sal)
		  {
  			$dev=$dev."<tr  bgcolor='#f4ebf5'>
    			<td width='180' class='nombre_tabla'>&nbsp;&nbsp;&nbsp;".$sal['titulo']."</td>
    			<td width='250' class='nombre_tabla'>&nbsp;&nbsp;&nbsp;".$sal['descripcion']."</td>    			
				<td width='40' align='center' class='texto'><div align='center'>
				  <input name='seleccionar' id='seleccionar' type='radio' value=".$sal['id'].">
				</div></td>
  			</tr>";		
  		  }		  
		  $dev=$dev."</table>
		  			<table align='center'>
						<tr>
							<td>
							  &nbsp;	
							</td>
						</tr>
						<tr>
							<td>
							<input type='submit' value='Volver a Foros' class='nombre_tabla'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
						    <input type='button' name='ver' value='Ingresar' onClick='validar_tema()' class='nombre_tabla'> 		
							</td>
						</tr>
					</table>";;
	$obj->addAssign("div_temas","innerHTML",$dev);	
	return $obj;
}

//-------------------------------------------------------------------------------------------------------------------------------

function crear_tema($id_foro, $id_usu)  // lista todos los temas
{

    $obj = new xajaxResponse();   
	$ConexF = new Foro();
    $Foro = $ConexF->titu_foro_nombre($id_foro);   // traer el nombre para mostrarlos
	
	//$obj->addAlert($id_usu);
		
    $dev=" 
	<br>
	<table width=\"505\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\">
	<tr>
      			<td width='550' colspan='2' align='center'>
				<font color=\"#367EA6\" class='titulo'>  Foro al cual se le va a crear un tema: <br> 
				<font color=\"#367EA6\" class='titulo' style=\"font-size:16px\"> $Foro[0] </font> </font> 
				</td>
  			</tr>
          	<tr>
            	<td width='550' class='Titulo' colspan='2' align='center'>&nbsp;</td>
			</tr>
	<tr  bgcolor=\"#FFD988\">
		<td width=\"503\" height=\"25\" bgcolor=\"#367EA6\" >
			<div align='center' class=\"Estilo19\">
			<font color=\"#FFFFFF\" class='nombre_tabla'> <strong>Tema del Foro</strong></font>     
			</div>		
			</td>
	</tr>
	<tr>
		<td height=\"125\" bgcolor=\"#FFFFFF\">
			<table width=\"450\" border=\"0\" align=\"center\" cellpadding='0' cellspacing='0' bgcolor=\"#FFFFFF\" >
				<tr valign=\"top\" bgcolor=\"#FFFFFF\">
                     <td width='111' height=\"40\" valign=\"middle\" class='nombre_tabla'>
					 <div align=\"left\" >
					 <strong>Titulo:</strong>
					 </div>
					 </td>
                     <td width='339' align='left' valign=\"middle\">
                       <div align=\"left\">
                         &nbsp;&nbsp;&nbsp;&nbsp;
						 <input name='tema' type='text' id='tema' value='' size='40' class='nombre_tabla'>                     
                       </div>
					  </td>
              </tr>
                   <tr>
                     <td width='111' valign=\"top\" bgcolor='#FFFFFF' class='nombre_tabla'>
					 <div align=\"left\" >
					 <strong>Descripci&oacute;n:</strong>
					 </div>
					 </td>
                     <td width='339' valign=\"top\" bgcolor='#FFFFFF'>
                        <div align=\"left\">
                          &nbsp;&nbsp;&nbsp;&nbsp;
						  <textarea name='descripcion' id='descripcion'  cols='40' rows='2' class='nombre_tabla'></textarea>
                        </div></td>
                   </tr>
		  </table>		</td>
	</tr>
	<tr  bgcolor=\"#FFD988\">
    	<td height=\"25\" bgcolor=\"#367EA6\" >
			<div align='center' class=\"Estilo19\"> 
			<font color=\"#FFFFFF\" class='nombre_tabla'>  <strong>Ingrese un primer Comentario</strong></font> 
			</div>		
		</td>
    </tr>
	<tr>
		<td height=\"171\" bgcolor=\"#FFFFFF\">
			<table width=\"450\" border=\"0\" align=\"center\" cellpadding='0' cellspacing='0' bgcolor=\"#FFFFFF\" >
  				<tr>
                     <td width='111' height=\"40\" align='left' valign=\"middle\" bgcolor='#FFFFFF' >
					 <div align=\"left\" class=\"nombre_tabla\">
					 <strong>Titulo:</strong>
					 </div>
					 </td>
                     <td width='339' align='left' valign=\"middle\" bgcolor='#FFFFFF'>                       
                     <div align=\"left\">
                     &nbsp;&nbsp;&nbsp;&nbsp;
					 <input name='titulo' type='text' id='titulo' value='' size='40' class='nombre_tabla'>                     
                     </div>
					 </td>
              </tr>
                   <tr>
                     <td width='111' height=\"102\" align='left' valign=\"top\" bgcolor='#FFFFFF' >
					 <div align=\"left\" class=\"nombre_tabla\">
					 <strong>Comentario: </strong>
					 </div>
					 </td>
                     <td width='339' align='left' valign=\"top\" bgcolor='#FFFFFF'>
                     <div align=\"left\">
                     &nbsp;&nbsp;&nbsp;&nbsp;
					 <textarea name='comentario' id='comentario'  cols='40' rows='3' class='nombre_tabla'></textarea>
                     </div>
					 </td>
                   </tr>
		  </table>		</td>
	</tr>
  	<tr bgcolor=\"#F0F0F0\">
   		<td bgcolor=\"#FFFFFF\">
			<div align=\"center\">
 			    <input type='submit' value='Volver a Foros' class='nombre_tabla'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
	    		<input name=\"Bot&oacute;n\" type='button' value='Guardar' onClick=\"xajax_guardar_tema('$id_foro',tema.value, descripcion.value, titulo.value,comentario.value, '$id_usu')\" class='nombre_tabla'>
			</div>	
			<br>
			<br>	
		</td>
  	</tr>
</table>
	
	
	";
	
	$obj->addAssign("div_temas","innerHTML",$dev);
    return $obj;
}


//-------------------------------------------------------------------------------------------------------------------------------
function buscar_comentarios($id_tema, $id)
{
   $obj = new xajaxResponse();   
   $ConexT = new Tema();
   $Tema = $ConexT->titu_tema($id_tema);
   $ConexC = new Comentario();

   $salida = $ConexC->buscar_mensajes($id_tema);
   $Row=$ConexT->BD->ExtraerRow();
   $dev = " <br>
   			<br> 
   			
			<table width=\"550\" border=\"0\" align = \"center\">
   			<tr>
      			<td width='550' colspan='2' align='center'>
				<font color=\"#367EA6\" class='titulo'> Comentarios del tema seleccionado: <br>
				<font color=\"#367EA6\" class='titulo' style=\"font-size:16px\">  $Row[0] </font>
				</font> 
				</td>
  			</tr>
          	<tr><td width='550' class='Titulo' colspan='2' align='center'>&nbsp;</td></tr>
  			<tr bgcolor=\"#367EA6\" >
			<td width=\"130\" align=\"center\">
			<font color=\"#FFFFFF\" class='nombre_tabla'> <strong> Usuario</strong></font>		
			</td>   
			<td width=\"322\"align=\"center\">
			<font color=\"#FFFFFF\" class='nombre_tabla'><strong>  Comentario</strong></font>		
			</td>			   
 			</tr>";
			
			/*
			 <tr bgcolor='#F0F0F0'>    			
    				<td width='470' align='center' class='texto'>".$sal['fecha']."</td>
				  </tr>
				  
				  ".$Usuario_tema->bus_dato($sal['autor'])."
			*/
		  foreach($salida as $sal)
		  {
  			$dev.="<tr bgcolor='#f4ebf5'>
				<table width='550' border='0' align='center'>
				<tr bgcolor='#f4ebf5'>
				<td rowspan='3' width='130' align='center' class='nombre_tabla'><strong>".$sal['nombre']." "." ".$sal['apellido']."</strong></td>
				<td rowspan='1' width='227' class='nombre_tabla'>&nbsp;&nbsp;&nbsp;".$sal['titulo']."</td>
    			<td rowspan='1' width='95' class='nombre_tabla'>&nbsp;&nbsp;&nbsp;".$sal['fecha']."	</td>
				  </tr>
				  <tr bgcolor='#f4ebf5'>
					<td colspan='2' align='justify' class='nombre_tabla'>".$sal['descripcion']."</td>
  				  </tr>
				</table>
			</tr>";		
  		  }
		  $dev=$dev."
		    <table width=\"550\" border=\"0\">
			<tr>
            	<td width='550' class='Titulo' colspan='2' align='center'>&nbsp;</td>
			</tr>
		     <tr bgcolor=\"#FFFFFF\">
			   <td>
		        <div align=\"center\">  		
     				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
    			    <input type='submit' value='Volver a Foros' class='nombre_tabla'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
					<input name=\"Bot&oacute;n\" type='button' value='Nuevo Comentario' onClick=\"xajax_nuevo_comentario('$id_tema','$Row[0]', $id)\" class='nombre_tabla'>   					 			    
				</div>	
			   </td>	
			  </tr>	
			 </table> 
    			";
		  $dev=$dev."</table>";
	$obj->addAssign("div_temas","innerHTML",$dev);	
	return $obj;
}
//--------------------------------------------------------------------------------------------------------------------------------
function nuevo_comentario($id_tema, $tema, $id)
{
	$obj = new xajaxResponse();   
    $dev=" 
			<br>
			<br>
			<table width='550' border='0' align=\"center\" cellpadding='0' cellspacing='1' >
			<tr>
      			<td width='550' colspan='2' align='center'>
				<font color=\"#367EA6\" class='titulo'> Nuevo Comentario para <br> 
				<font color=\"#367EA6\" class='titulo' style=\"font-size:16px\"> <strong> $tema </strong></font>
				</font> 
				</td>
  			</tr>
          	<tr>
            	<td width='550' class='Titulo' colspan='2' align='center'>&nbsp;</td>
			</tr>
			<tr  bgcolor='#FFD988'>
    			<td bgcolor='367EA6'>
					<div align='center'>
					<font color=\"#FFFFFF\" class='nombre_tabla'> <strong>Inserte nuevo Comentario</strong></font> 
					</div>
			    </td>
    		</tr>
			<tr>
				<td bgcolor='#FFFFFF'>
				<div align=\"center\">
					<table width=\"420\" align=\"center\"  bgcolor=\"#FFFFFF\" >
  						<tr>
                     		<td width='120' height=\"53\" bgcolor='#FFFFFF' class='nombre_tabla' align=\"center\">Titulo:</td>
                     		<td width='380' bgcolor='#FFFFFF' align=\"center\">                       			
							  <div align=\"center\">
							    <input name='titulo' type='text' id='titulo' value='' size='45' class='nombre_tabla' >                     
					          </div>
							</td>
              			</tr>
                   		<tr>
                     		<td width='120' bgcolor='#FFFFFF' class='nombre_tabla' align=\"center\">Comentario:</td>
                     		<td width='380' bgcolor='#FFFFFF' align=\"center\">
                     		  <div align=\"center\">
                     		    <textarea name='comentario' id='comentario'  cols='30' rows='5' class='nombre_tabla'></textarea>
                   		       </div>
							</td>
						</tr>
						<tr>
    						<td colspan='2' bgcolor='#FFFFFF'>&nbsp;</td>
 		 				</tr>
		  			</table>
				</div>	
			  </td>
			</tr>
  			<tr bgcolor=\"#FFFFFF\">
    			<td>  		  
    			  <div align=\"center\">
    			    <input type='submit' value='Volver' class='nombre_tabla'>
    			    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name=\"Bot&oacute;n\" type='button' value='Guardar' onClick=\"xajax_guardar_comentario(titulo.value,comentario.value,'$id_tema', $id)\" class='nombre_tabla'>
  			        </div>
				</td></tr>
	</table>
					</p>";  
   
   $obj->addAssign("div_temas","innerHTML",$dev);
   return $obj;
}
//*************************************************************   Crear Foro   ***********************************************
function guardar_tema($id_foro,$tema,$descripcion,$titulo,$comentario, $id) 
{
   $obj = new xajaxResponse();   
   $ConexT = new Tema();
   $ConexC = new Comentario();
//   $usuario = 1;
   $fecha_actual= date ("Y/n/j");

   $ConexT->insertar_tema($id_foro,$tema,$fecha_actual,$descripcion);
   $id_tema=$ConexT->id;
   $ConexC->insertar_comentario($id_tema,$comentario,$fecha_actual,$titulo,$id);
   
   $nuevo="<table width='200' border='0' align='center'>
  <tr>
    <td>
    <p>&nbsp;</p>
    <p>&nbsp;</p>    
	<p align=\"center\"><img src='imagenes/confirmacion.bmp' width='541' height='139'></p>
    <p align=\"center\" class='Estilo7'>Si desea volver a agregar un tema haga click <a href='consultar_foro.php'>Aqu&iacute;</a></p>
    <p align=\"center\" class='Estilo7'>Para realizar otra operaci&oacute;n selecccione una opci&oacute;n del men&uacute;. </p>    
	<p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
</table>";
   

   $obj->addAssign("div_temas","innerHTML",$nuevo);
   
   
   return $obj;
}

//*******************************************

function guardar_foro($titulo,$descripcion,$valor,$usua)
{
   $Proy = new Proyecto();
   $obj = new xajaxResponse();   
   $Conex = new Foro();
   $ConexT = new Tema();
   $ConexC = new Comentario();
  // $usuario = 1;  // lider = 1 
   $fecha_actual= date ("Y/n/j");
   
//   $obj->addAlert(" entro a funcion");

	if(($Proy->validar_nombre2($titulo)==1))
	{  
	   $sw=1;
	   $mensaje="<div align=\"center\" class=\"alerta_error\" id=\"error\">Foro Ya registrado con ese mismo nombre!...<br>No puede tener el mismo nombre de uno existente</div>";
	   $obj->addAssign("error","innerHTML",$mensaje);
      
	}
	else
	{
		if(($Conex->valida_un_foro()==0))
		{
		
//			 $obj->addAlert(" entro a guardar 1 ");
		
			 $sw=2;
			 $Conex->insertar_foro($titulo,$fecha_actual,$descripcion,$usua);
			 $Conex->insertar_foro2($valor);
			 
			 $id_foro=$Conex->id;
		 	 $primer_id=1;
			 $tituloX="Bienvenida al Foro";
			 $descripcionX="Su Foro ya fue creado... Ya puede crear temas relacionados con este foro";
			 $fecha_actualX= date ("Y/n/j");
			 			 			 
			 if(($ConexT->valida_un_tema()==0))
			 {
			 $ConexT->insertar_primer_tema($primer_id,$id_foro,$tituloX,$fecha_actualX,$descripcionX);
			 
			 $id_tema=1;
		 	 $primerC_id=1;
			 $tituloXX="Bienvenido al Foro";
			 $descripcionXX="Su Foro ya fue creado... Ya puede hacer comentarios relacionados con este tema";
			 $fecha_actualXX= date ("Y/n/j");
			 
			 $ConexC->insertar_primer_comentario($primerC_id, $id_tema,$descripcionXX,$fecha_actualXX,$tituloXX,$usua);
   
			 $nuevo="<table width='200' border='0' align='center'>
			  <tr>
			    <td> 
				<p align=\"center\"><img src='imagenes/confirmacion.bmp' width='541' height='139'></p>
			    <p align=\"center\" class='nombre_tabla'>Si desea volver a agregar un tema haga click <a href='crear_foro.php'>Aqu&iacute;</a></p>
			    <p align=\"center\" class='nombre_tabla'>Para realizar otra operaci&oacute;n selecccione una opci&oacute;n del men&uacute;. </p>
				</td>
			  </tr>
			</table>";
			 $obj->addAssign("div_temas2","innerHTML",$nuevo);
			 }
		}
		else
		{
		
		 //$obj->addAlert(" entro a guardar 2 ");
		
		 $sw=2; 
		 $Conex->insertar_foro($titulo,$fecha_actual,$descripcion,$usua);
		 $Conex->insertar_foro2($valor);
		 
		 $id_foro=$Conex->id;
 		 $tituloX="Bienvenido al Foro";
		 $descripcionX="Su Foro ya fue creado... Ya puede crear temas relacionados con este foro";
		 $fecha_actualX= date ("Y/n/j");
		 
		 $ConexT->insertar_tema($id_foro,$tituloX,$fecha_actualX,$descripcionX);
		 
		 $id_tema=$ConexT->id;
		 $tituloXX="Bienvenido al Foro";
		 $descripcionXX="Su Foro ya fue creado... Ya puede crear temas relacionados con este foro";
		 $fecha_actualXX= date ("Y/n/j");
			 
		 $ConexC->insertar_comentario($id_tema,$descripcionXX,$fecha_actualXX,$tituloXX,$usua);
	 
	 	 $nuevo="<table width='200' border='0' align='center'>
		  <tr>
		    <td> 
			<p align=\"center\"><img src='imagenes/confirmacion.bmp' width='541' height='139'></p>
		    <p align=\"center\" class='nombre_tabla'>Si desea volver a agregar un Foro haga click <a href='crear_foro.php'>Aqu&iacute;</a></p>
		    <p align=\"center\" class='nombre_tabla'>Para realizar otra operaci&oacute;n selecccione una opci&oacute;n del men&uacute;. </p>
			</td>
		  </tr>
		</table>";
		 $obj->addAssign("div_temas2","innerHTML",$nuevo);
		}

	}

    if(sw==1)
	{
	return  $obj;
	}
	else
	{
	 return $obj;
	}
  
}

//--------------------------------------------------------------------------------------------------------------------------------
function guardar_comentario($titulo,$comentario,$id_tema, $id)
{
   $obj = new xajaxResponse();   
   $Conex = new Comentario();
   $fecha_actual= date ("Y/n/j");
     
//   $Conex->insertar_comentario($titulo, $comentario,$id_tema,$usuario);
   $Conex->insertar_comentario($id_tema, $comentario, $fecha_actual, $titulo, $id);
   
   $nuevo="<table width='200' border='0' align='center'>
  <tr>
    <td>
	<p>&nbsp;</p>
    <p>&nbsp;</p>    
	<p align=\"center\"><img src='imagenes/confirmacion.bmp' width='541' height='139'></p>
    <p align=\"center\" class='Estilo7'>Si desea volver a Consultar Foro haga click <a href='consultar_foro.php'>Aqu&iacute;</a></p>
    <p align=\"center\" class='Estilo7'>Para realizar otra operaci&oacute;n selecccione una opci&oacute;n del men&uacute;. </p>    
	<p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
	</td>
  </tr>
</table>";
   

   $obj->addAssign("div_temas","innerHTML",$nuevo);
   $obj->addAssign("comentario","value","");
   $obj->addAssign("titulo","value","");
   
   
   return $obj;
}
//****************************************************   Eliminar Foro   ******************************************************
//*****************************************************************************************************************************
function listar_temas()
{
	$objResponse = new xajaxResponse();;
	$ConexF = new Foro();
	
	if($ConexF->list_foros()>0)
	{
   		$mensaje="<table width='450' align='center' cellspacing='0' >
				  <tr>
    				<td width='450' bgcolor='f0f0f0' class='subtitulo' colspan='2' align='center'>Seleccione tema a eliminar </td>
  				  </tr>
                  <tr align='center' valign='middle' bgcolor='#FFFFEA'>
                    <td width='350' bgcolor='#ffd988'><div align='center' class='textonegrita'>Tema</div></td>
                    <td width='100' bgcolor='#ffd988'><div align='center' class='textonegrita'>Seleccionar</div></td>
                  </tr>";
				  $num=1;
			while ($Row=$ConexF->BD->ExtraerRow())
			{
				$mensaje.="<tr bgcolor='f0f0f0'>
             		<td align='left' class='estilo'>  $Row[1]</td>
					<td align='center'><div align='center'><input  name='seleccionar' type='radio' value='$Row[0]'></div></td>
             		</tr>";
					$num+=1;
			}//while
			$mensaje.="</table>";
            $mensaje.="<table align='center'>
					<tr>
						<td> <input type='button' name='eliminar' value='Eliminar' onClick='verificar_eliminar()'> </td>
					</tr>
				</table>";
	}//if
	else
		$mensaje="<table align='center'>
					<tr align='center' valign='middle' bgcolor='#FFFFEA'>
                    <td width='350' bgcolor='#ffd988'><div align='center' class='textonegrita'>No hay Foros para Eliminar</div></td>
                  </tr>
				</table>";
	$objResponse->addAssign("div_temas","innerHTML",$mensaje);
	return $objResponse;
}
//--------------------------------------------------------------------------------------------------------------------------------
function buscar_tema($idtem)
{
	$objResponse = new xajaxResponse();;
	$ConexF = new Foro();
	
	if($ConexF->busc_foro($idtem)>0)
	{
			$Row=$ConexF->BD->ExtraerRow();
			$mensaje="<table width='450' border='0' align='center' cellpadding='0' cellspacing='1'>
        			<tr>
          				<td width='450' class='subtitulo' align='left'>  Foro: $Row[1]</td>
    				</tr>
					</table>
					<p>&nbsp;</p>
					<table width='450' border='0' align='center' cellpadding='0' cellspacing='1'>
					<tr>
						<td width='200' bgcolor='#ffd988' class='textonegrita'>Fecha de Creaci&oacute;n</td>
          				<td width='250' bgcolor='f0f0f0' class='estilo'>$Row[3]</td>
    				</tr>
        			<tr>
          				<td width='200' bgcolor='#ffd988' class='textonegrita'>Descripci&oacute;n </td>
          				<td width='250' bgcolor='f0f0f0' class='estilo'>$Row[2]</td>
    				</tr>
        			<tr>
         				<td width='200' bgcolor='#ffd988' class='textonegrita'>Creado por  </td>
          				<td width='250' bgcolor='f0f0f0' class='estilo'>$Row[5]</td>
    				</tr>
					</table>
					<p>&nbsp;</p>
					<table width='450' border='0' align='center' cellpadding='0' cellspacing='1'>
					<tr>
						<td width='225' align='center'><input type='button' width='35' name='atras' value=' Atr&aacute;s  ' onClick='listar_temas()'></td>
						<td width='225' align='center'><input type='button' width='23' name='eliminar' value='Eliminar' onClick='eliminar_tema($idtem)'></td>
					</tr>
				</table>";
	}//if
	else
		$mensaje="<table align='center'>
					<tr align='center' valign='middle'>
                    <td width='350' bgcolor='#ffd988'><div align='center' class='textonegrita'>No se encontr&oacute; ning&uacute;n tema</div></td>
                  </tr>
				</table>";
	$objResponse->addAssign("div_temas","innerHTML",$mensaje);
	return $objResponse;
}
//--------------------------------------------------------------------------------------------------------------------------------
function elim_foro($idtem)
{
	$objResponse = new xajaxResponse();

	$ConexC = new Comentario();
	$ConexT = new Tema();
	$ConexF = new Foro();
	
	$ConexF->elim_foro($idtem);
	$ConexT->elim_tema($idtem);
	while($ConexT->id_tema($idtem))
	{
		$tema = $ConexT->id_tema($idtem);
		$id = $tema[0];
		$ConexC->elim_comentarios_tema($id);
	}

	
	
	if($ConexF->busc_foro($idtem)==0)
	{
		$mensaje="<table width='200' border='0' align='center'>
  <tr>
    <p>&nbsp;</p>    
	<p><img src='imagenes/confirmacion.bmp' width='541' height='139'></p>
    <p class='texto'>Si desea eliminar otro Foro haga click <a href='eliminar_foro.php'>Aqu&iacute;</a></p>
    <p class='texto'>Para realizar otra operaci&oacute;n selecccione una opci&oacute;n del men&uacute;. </p>    
	<p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
</table>";
	}
	$objResponse->addAssign("div_temas","innerHTML",$mensaje);
	return $objResponse;
}


//------------------------------------------------------------------
/*

<table width=\"1010\" border=\"0\" align=\"center\">
			<tr bgcolor=\"#FBFBFB\">
			  <td colspan=\"9\" bgcolor=\"#FBFBFB\" ><div align=\"center\">
			  <font color=\"#143266\" style=\"font-family:Arial ; font-size:12px; font-weight:bold;\">HORARIO - CABINA ".$id_k."</font>
			  </div></td>
		  </tr>
			<tr bgcolor=\"#FBFBFB\">
			  <td colspan=\"8\" bgcolor=\"#FBFBFB\" >&nbsp;</td>
		  </tr>
			<tr bgcolor=\"#56C4C2\">
			  <td width=\"50\" bgcolor=\"#DFF4F2\" ><div align=\"center\">
			  <font color=\"#808080\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\"> DESDE </font>
			  </div></td>
			  <td width=\"50\" bgcolor=\"#DFF4F2\" >
		       <div align=\"center\"><font color=\"#808080\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\"> HASTA </font></div></td>
		      <td width=\"130\" bgcolor=\"#56C4C2\" >
			  <div align=\"center\">
			  <font color=\"#143266\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">LUNES</font>			  </div>			  </td>
		      <td width=\"130\" bgcolor=\"#56C4C2\" >
			  <div align=\"center\">
			  <font color=\"#143266\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">MARTES</font>			  </div>			  </td>
		      <td width=\"130\" bgcolor=\"#56C4C2\" >
			  <div align=\"center\">
			  <font color=\"#143266\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">MIERCOLES</font>			  </div>			  </td>
		      <td width=\"130\" bgcolor=\"#56C4C2\" >
			  <div align=\"center\">
			  <font color=\"#143266\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">JUEVES</font>			  </div>			  </td>
		      <td width=\"130\" bgcolor=\"#56C4C2\" >
			  <div align=\"center\">
			  <font color=\"#143266\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">VIERNES</font>			  </div>			  </td>
		      <td width=\"130\" bgcolor=\"#56C4C2\" >
			  <div align=\"center\">
			  <font color=\"#143266\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">SABADO</font>			  </div>			  </td>
			  <td width=\"130\" bgcolor=\"#56C4C2\" >
			  <div align=\"center\">
			  <font color=\"#143266\" style=\"font-family:Arial ; font-size:11px; font-weight:bold;\">DOMINGO</font>			  </div>			  </td>
		  </tr>			
//------------------------------------------------------------------


*/


//*******************************************************
$xajax->processRequests();
?>



<?php

	$ora=new ConexionDirecta();
	$db=$ora->oracle();
        
        $query="
            select nactra , cedula, nombr1, nombr2, apell1, apell2 from nmm001 where fecret is null and tnom_tipnom<>'Z999' and tnom_tipnom<>'EXT'
        ";
        
        $rs = oci_parse($db,$query);
	oci_execute($rs);
        
        $txt='';        
        while ( $row = oci_fetch_array($rs, OCI_ASSOC) ){ 

            
            //nacionalidad
            if($row['NACTRA']==1)$nacionalidad='V'; else $nacionalidad='E';
            
            //cedula
            $cedula=trim($row['CEDULA']);
            $ceros='';
            $largo = strlen(trim($row['CEDULA']));
            for($i=$largo;$i<9;$i++){$ceros .='0';}
           
            //nombre
            $nombr1=trim($row['NOMBR1']);
            $largo = strlen(trim($row['NOMBR1']));
            for($i=$largo;$i<=15;$i++){$nombr1 .='&nbsp;';}
            
                        //nombre 2
            $nombr2=trim($row['NOMBR2']);
            $largo = strlen(trim($row['NOMBR2']));
            for($i=$largo;$i<=15;$i++){$nombr2 .='&nbsp;';}
            
                        //apellido 1
            $apell1=trim($row['APELL1']);
            $largo = strlen(trim($row['APELL1']));
            for($i=$largo;$i<=15;$i++){$apell1 .='&nbsp;';}
            
                        //apellido 2
            $apell2=trim($row['APELL2']);
            $largo = strlen(trim($row['APELL2']));
            for($i=$largo;$i<15;$i++){$apell2 .='&nbsp;';}
            
            
            $txt .=trim($nacionalidad).''.$ceros.$cedula.' '.$nombr1.' '.$nombr2.' '.$apell1.' '.$apell2.'                      186 001<br>';
            
            
        }
        
        echo $txt;
        exit(0);
	
	/*
	$query="
	
		select nmm001.cedula, nmm001.fictra, nmm001.nombr1, nmm001.apell1, 
			   nmm001.sueld1, nmm001.fecing, nmm024.tnom_tipnom, nmm024.cto_codcto, 
			   nmm024.moncto, nmm024.functo, nmm024.cancto, nmm024.suecal,
			   nmt027.descto, nmt004.descar, nmt019.desdep
		
		from nmm001, nmm023, nmm024, nmt004, nmt019, nmt027
		
		where
		
		nmm001.fictra like '%17312612%' and
		nmm001.fictra = nmm023.trab_fictra and
		nmm001.fictra = nmm024.trab_fictra and
		
		nmm023.fpro_numper = 22 and
		nmm024.fpro_numper = nmm023.fpro_numper and
		
		nmm023.fpro_anocal = 2011 and
		nmm024.fpro_anocal = nmm023.fpro_anocal and
		
		nmt027.tnom_tipnom = nmm023.tnom_tipnom and
		nmt027.codcto = nmm024.cto_codcto and
		
		nmm024.functo<>3 and
		
		nmm001.cgo_carocu = nmt004.codcar and
		nmm001.dpto_coddep = nmt019.coddep and
		
		nmm023.proc_tippro = 1 and
		nmm023.proc_tippro = nmm024.proc_tippro
		
		
		order by nmm024.cto_codcto
		
	";
	*/
	
	$query="
	select nmm001.nactra, nmm001.cedula, nmm024.moncto  from nm m001, nmm023, nmm024 

		where
		nmm001.fictra = nmm023.trab_fictra and
		nmm001.fictra = nmm024.trab_fictra and
		
		nmm023.proc_tippro = 02 and
		nmm024.proc_tippro=nmm023.proc_tippro and
		
		nmm023.fpro_anocal = 2011 and
		nmm024.fpro_anocal = nmm023.fpro_anocal and
		
		nmm023.tnom_tipnom = 'CONT' and
		nmm024.tnom_tipnom = nmm023.tnom_tipnom and
		 
		nmm023.fpro_numper = 13 and 
		nmm023.fpro_numper = nmm024.fpro_numper
	";
	
	$rs = oci_parse($db,$query);
	oci_execute($rs);
	
	?>
	
	
	<?php 
	$cadena='';
	$cant=0;
		while ( $row = oci_fetch_array($rs, OCI_ASSOC) ){ 
		$ceros='';
		$monto_x='';
			
			$nac= trim($row['NACTRA']);
			$ced= trim($row['CEDULA']);
			$mon= trim($row['MONCTO']);
			
		// nacionalidad
		if($nac==1) $nac='V';
		else if($nac==2) $nac='E';
		
		
		// agrego ceros faltantes a las cedulas
				$l=strlen($ced);
					
				$cant= 9 - $l;
				
				if($cant!=0){
					for($i=0;$i<$cant;$i++){
						
						$ceros .= '0';
						
					}
					
					$cedula = $ceros.$ced;
				}
				else $cedula = $ced;
		
		// agrego ceros faltantes al monto
		$ceros='';				
		$monto = str_replace(",", "", $mon);

		
				$l=strlen($monto);
				
				$cant= 13 - $l;
								
				if($cant!=0){
					for($i=0;$i<$cant;$i++){
						
						$ceros .= '0';
						
					}

					$monto_x = $ceros.$monto;
				}
				
				else $monto_x = $monto;
		
				
				$ceros17=0;
				$cantidad=0;
				while($cantidad<16){
					$ceros17 .='0';
					$cantidad++;
				}
						
	?>
		
				<?php $cadena .= "23193".$nac.$cedula."100A".$monto_x."N".$ceros17." ".$ceros17."00\r\n"?>
					
	<?php }
	
	//echo "<div align=left>".$cadena.'<br>'.'23193V002153006100A0000000043467N00000000000000000 0000000000000000000</div>';
	
	?>
	
	
	<?php 


	$archivo = fopen ("contratados.txt", "w+");
	
	fwrite($archivo, $cadena);
	fclose($archivo);

	?>
	


  