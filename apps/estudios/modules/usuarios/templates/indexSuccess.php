<div class="titulo_modulo">PAUTAS DE ESTUDIOS</div>

<style>
    table{
        background-color: gray;
    }
    th{
        width: 100px;

        background-color: #E7EEF6;
    }
    td{
        width: 100px;
        height: 80px;
        vertical-align:top;
    }
    td{
        width: 100px;
        height: 80px;
        vertical-align:top;
    }
    tr{
        background-color: white;
    }
</style>
<?php
    function numerodiasdelmes($mes,$anio){
         
        $numero = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
        return $numero;
    }
    
    function numerodiadelasemana($dia,$mes,$anio){
        
        $fecha=$dia.'-'.$mes.'-'.$anio;
        $t = strtotime($fecha);
        return date('w',$t);
    }

    $dias_semana=array(0=>'Domingo',1=>'Lunes',2=>'Martes',3=>'Miercoles',4=>'Jueves',5=>'Viernes',6=>'Sabado');
    $meses=array(1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');

    $numerosdiasdelmes=numerodiasdelmes($mes,$anio);    
    $nro=numerodiadelasemana(1,$mes,$anio)+1;
    $nro=(7-$nro)+1;
    
    $cont=0;$a=0;
    for($dia=1;$dia<=$numerosdiasdelmes;$dia++){
       
        $numerodiadelasemana = numerodiadelasemana($dia,$mes,$anio);  

        for($i=0;$i<7;$i++){
               if($numerodiadelasemana==$i){$calendario[$dias_semana[$i]][$cont]=$dia;break;}
               else if(!isset($calendario[$dias_semana[$i]][$cont]))$calendario[$dias_semana[$i]][$cont]='';        
        }
        
        if($dia==$nro){
            
            $nro=$nro+7;
            $cont++;
            $a++;
        }
    }
?>

<form method="post" action="<?php echo url_for("usuarios/index")?>" name="form">
<div style="text-align: left; width: 700px;">
    Mes: 
    <select name="mes">
        <option value="<?php echo $mes?>"><?php echo $meses[$mes]?></option>
        <?php 
            foreach ($meses as $num=>$m) {    
                
            if($num!=$mes){?>
        <option value="<?php echo $num;?>"><?php echo $m;?></option>
        <?php }}?>
    </select>
    
    &nbsp;&nbsp;&nbsp;
    
    Año: 
    <select name="anio">
        <option value="<?php echo $anio?>"><?php echo $anio?></option>
        
        <?php 
            for($i=date("Y")-1;$i<=date("Y")+1;$i++) {       
            if($i!=$anio){?>
        <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php }}?>  
    </select>
    &nbsp;&nbsp;&nbsp;<input type="submit" value="Enviar">
</div>
    
</form>
<br><br>
<table border="0" width="700px" cellpadding="10px" cellspacing="1px;">
    <tr>
        <th>Domingo</th>
        <th>Lunes</th>
        <th>Martes</th>
        <th>Miercoles</th>
        <th>Jueves</th>
        <th>Viernes</th>
        <th>Sabado</th>        
    </tr>

    <?php for($i=0;$i<=$cont;$i++){?>
    <tr>
        
        <td <?php if($calendario['Domingo'][$i]=='')echo "style=background-color:#E8E8E8;"?>>
            <?php if(isset($calendario['Domingo'][$i]))echo $calendario['Domingo'][$i];?>
            <?php if(isset($calendario['Domingo'][$i]) && $calendario['Domingo'][$i]!=''){?><br><br><div style="text-align: center;"><a href="<?php echo url_for('usuarios/solicitud?fecha='.$calendario['Domingo'][$i].'-'.$mes.'-'.$anio)?>"><?php echo image_tag("aprobado.jpg",array('size' => '25x25'))?></a></div><?php }?>
        </td>
        
        
        
        <td <?php if($calendario['Lunes'][$i]=='')echo "style=background-color:#E8E8E8;"?>>
            <?php if(isset($calendario['Lunes'][$i]))echo $calendario['Lunes'][$i];?>
            <?php if(isset($calendario['Lunes'][$i]) && $calendario['Lunes'][$i]!=''){?><br><br><div style="text-align: center;"><a href="<?php echo url_for('usuarios/solicitud?fecha='.$calendario['Lunes'][$i].'-'.$mes.'-'.$anio)?>"><?php echo image_tag("aprobado.jpg",array('size' => '25x25'))?></a></div><?php }?>
        </td>
        
        
        <td <?php if($calendario['Martes'][$i]=='')echo "style=background-color:#E8E8E8;"?>>
            <?php if(isset($calendario['Martes'][$i]))echo $calendario['Martes'][$i];?>
            <?php if(isset($calendario['Martes'][$i]) && $calendario['Martes'][$i]!=''){?><br><br><div style="text-align: center;"><a href="<?php echo url_for('usuarios/solicitud?fecha='.$calendario['Martes'][$i].'-'.$mes.'-'.$anio)?>"><?php echo image_tag("aprobado.jpg",array('size' => '25x25'))?></a></div><?php }?>
        </td>
        
        <td <?php if($calendario['Miercoles'][$i]=='')echo "style=background-color:#E8E8E8;"?>>
            <?php if(isset($calendario['Miercoles'][$i]))echo $calendario['Miercoles'][$i];?>
            <?php if(isset($calendario['Miercoles'][$i]) && $calendario['Miercoles'][$i]!=''){?><br><br><div style="text-align: center;"><a href="<?php echo url_for('usuarios/solicitud?fecha='.$calendario['Miercoles'][$i].'-'.$mes.'-'.$anio)?>"><?php echo image_tag("aprobado.jpg",array('size' => '25x25'))?></a></div><?php }?>
        </td>
        
        <td <?php if($calendario['Jueves'][$i]=='')echo "style=background-color:#E8E8E8;"?>>
            <?php if(isset($calendario['Jueves'][$i]))echo $calendario['Jueves'][$i];?>
            <?php if(isset($calendario['Jueves'][$i]) && $calendario['Jueves'][$i]!=''){?><br><br><div style="text-align: center;"><a href="<?php echo url_for('usuarios/solicitud?fecha='.$calendario['Jueves'][$i].'-'.$mes.'-'.$anio)?>"><?php echo image_tag("aprobado.jpg",array('size' => '25x25'))?></a></div><?php }?>
        </td>
        
        <td <?php if($calendario['Viernes'][$i]=='')echo "style=background-color:#E8E8E8;"?>>
            <?php if(isset($calendario['Viernes'][$i]))echo $calendario['Viernes'][$i];?>
            <?php if(isset($calendario['Viernes'][$i]) && $calendario['Viernes'][$i]!=''){?><br><br><div style="text-align: center;"><a href="<?php echo url_for('usuarios/solicitud?fecha='.$calendario['Viernes'][$i].'-'.$mes.'-'.$anio)?>"><?php echo image_tag("aprobado.jpg",array('size' => '25x25'))?></a></div><?php }?>
        </td>
        
        <td <?php if($calendario['Sabado'][$i]=='')echo "style=background-color:#E8E8E8;"?>>
            <?php if(isset($calendario['Sabado'][$i]))echo $calendario['Sabado'][$i];?>
            <?php if(isset($calendario['Sabado'][$i]) && $calendario['Sabado'][$i]!=''){?><br><br><div style="text-align: center;"><a href="<?php echo url_for('usuarios/solicitud?fecha='.$calendario['Sabado'][$i].'-'.$mes.'-'.$anio)?>"><?php echo image_tag("aprobado.jpg",array('size' => '25x25'))?></a></div><?php }?>
        </td>

    </tr>   
    <?php }?>
    
</table>

<div class="leyenda">
    <table width="300px" border="0"  cellspacing="0">
        <tr align="center">
            <td width="150px"><?php echo image_tag("aprobado.jpg",array('size' => '35x35'))?>&nbsp;Disponible</td>
            <td width="150px"><?php echo image_tag("mal.jpeg",array('size' => '35x35'))?>&nbsp;No disponible</td>
        </tr>
    </table>
</div>




