<?php   
  function HoraDespues($hora)
  {

        $a=new Criteria();
        $a->addAscendingOrderByColumn("id_hora");
        $horas = EstHorasPeer::doSelect($a);
        
        $cont=0;
        foreach ($horas as $h) {
            if($cont==1)return $h->getHora();
            
            if($h->getHora()==$hora)
                $cont=1;
        }
        
        
  }

?>

<div class="titulo_modulo">SOLICITUD DE ESTUDIOS</div>

<?php if($sms!='' || $sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sms?><div class="sms"><?php echo $sf_user->getFlash('sms')?></div></div>
<?php }?>

<form action="<?php echo url_for('usuarios/solicitud?fecha='.$fecha)?>" method="post" name="form">
<table class="crud_form select200 textarea200" style="width:400px">
    <?php echo $form;?>
    

    <tr><td colspan="2" style="text-align: center;"><input id="boton" type="button" onclick="enviar_formulario('Solicitar')" value="Solicitar"></td></tr>
</table>
    <input type="hidden" name="accion" id="accion" value="">
    <input type="hidden" name="eliminar" id="eliminar" value="">
    
</form>
<br><br>

<table>
    <tr>
        <td style="width: 15px;height: 15px;background-color: #FFF838;"></td>
        <td>En espera&nbsp;&nbsp;</td>
        <td style="width: 15px;height: 15px;background-color: #44A1FF;"></td>
        <td>Aprobado&nbsp;&nbsp;</td>
        <td style="width: 15px;height: 15px;background-color: #E7EEF6;"></td>
        <td>Fijos</td>
        
        
    </tr>
</table>


<div class="iconos">
<a href="<?php echo url_for('usuarios/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>

<div style="font-weight: bold;width: 700px;text-align: left;"> FECHA: <?php $s=  strtotime($fecha); echo date("d-m-Y",$s);?></div>
<br>

<table class="tablaapartado" cellpadding="5px" cellspacing="2">
    
    
    <tr>
        <th width="200px">Hora</th>
        <th width="200px">Estudio A</th>
        <th width="200px">Estudio B</th>
        <th width="200px">Estudio C</th>        
    </tr>
    
    <?php foreach ($horas as $h) { if($h->getHora()!='23:59:59'){ $ca=0;$cb=0;$cc=0;?>
    
        <tr>
            <td align="center" style="font-weight: bold;"><?php $hd=HoraDespues($h->getHora()); echo $h->getHora().' - '.$hd;?></td>
          
            <?php                   
            //ESTUDIO A
            $ax=0;
            foreach ($solicitudes as $s) { $ca=1;
                if($h->getHora()>=$s->getHoraDesde() && $h->getHora()<=$s->getHoraHasta() && $s->getEstudio()=='A' && $s->getEstatus()!='r'){
                    
                    if($h->getHora()==$s->getHoraDesde() && $s->getEstudio()=='A'){
                        $ax=2;
                        
                        $a=new Criteria();
                        $a->add(EstHorasPeer::HORA,$s->getHoraDesde(),  Criteria::GREATER_EQUAL);
                        $a->addAnd(EstHorasPeer::HORA,$s->getHoraHasta(),  Criteria::LESS_EQUAL);
                        $row=EstHorasPeer::doCount($a);
                        
                        $solic=  SfGuardUserProfilePeer::retrieveByPK($s->getIdSolicitante());
                        $produ=  EstProductosPeer::retrieveByPK($s->getIdProducto());
                        $info=   "Solicitante: ".ucwords($solic->getNombre1().' '.$solic->getApellido1()).'<br>Producto: '.$produ->getDescripcion().'<br>'.$s->getObservaciones();
                        $info_fijos= $s->getObservaciones();
                      
                        if($s->getIdSolicitante()==$idus){$info .="<br><br><a style='font-size:10px;color:red;cursor:pointer;' onclick='elimina(".$s->getIdSolicitud().")'>ELIMINAR</a>";}
                        if($s->getEstatus()=='e'){
                              echo "<td style='text-align:center;background-color:#FFF838;' rowspan='".$row."'>".$info."</td>";
                        }
                        
                        else if($s->getEstatus()=='a')
                        echo "<td style='text-align:center;background-color:#44A1FF;' rowspan='".$row."'>".$info."</td>";
          
                        else if($s->getEstatus()=='f')
                        echo "<td style='text-align:center;background-color:#E7EEF6;' rowspan='".$row."'>".$info_fijos."</td>";
          
          
                         
                    } else $ax=2;
                } else if ($ax!=2)$ax=1;
            }
            if($ax==1) echo "<td></td>";
            
            //ESTUDIO B
            $bx=0;
            foreach ($solicitudes as $s) { $cb=1;
                if($h->getHora()>=$s->getHoraDesde() && $h->getHora()<=$s->getHoraHasta() && $s->getEstudio()=='B' && $s->getEstatus()!='r'){
                    
                    if($h->getHora()==$s->getHoraDesde() && $s->getEstudio()=='B'){
                        $bx=2;
                        
                        $a=new Criteria();
                        $a->add(EstHorasPeer::HORA,$s->getHoraDesde(),  Criteria::GREATER_EQUAL);
                        $a->addAnd(EstHorasPeer::HORA,$s->getHoraHasta(),  Criteria::LESS_EQUAL);
                        $row=EstHorasPeer::doCount($a);
                
                        $solic=  SfGuardUserProfilePeer::retrieveByPK($s->getIdSolicitante());
                        $produ=  EstProductosPeer::retrieveByPK($s->getIdProducto());
                        $info=   "Solicitante: ".ucwords($solic->getNombre1().' '.$solic->getApellido1()).'<br>Producto: '.$produ->getDescripcion().'<br>'.$s->getObservaciones();
                        $info_fijos= $s->getObservaciones();
                      
                        if($s->getIdSolicitante()==$idus){$info .="<br><br><a style='font-size:10px;color:red;cursor:pointer;' onclick='elimina(".$s->getIdSolicitud().")'>ELIMINAR</a>";}
                        
                        if($s->getEstatus()=='e')
                        echo "<td style='text-align:center;background-color:#FFF838;' rowspan='".$row."'>".$info."</td>";
                          
                        else if($s->getEstatus()=='a')
                        echo "<td style='text-align:center;background-color:#44A1FF;' rowspan='".$row."'>".$info."</td>";
                        
                        else if($s->getEstatus()=='f')
                        echo "<td style='text-align:center;background-color:#E7EEF6;' rowspan='".$row."'>".$info_fijos."</td>";
          
          
                         
                    } else $bx=2;
                } else if ($bx!=2)$bx=1;
            }
            if($bx==1) echo "<td></td>";
            
            //ESTUDIO C
            $cx=0;
            foreach ($solicitudes as $s) { $cc=1;
                if($h->getHora()>=$s->getHoraDesde() && $h->getHora()<=$s->getHoraHasta() && $s->getEstudio()=='C' && $s->getEstatus()!='r'){
                    
                    if($h->getHora()==$s->getHoraDesde() && $s->getEstudio()=='C'){
                        $cx=2;
                        
                        $a=new Criteria();
                        $a->add(EstHorasPeer::HORA,$s->getHoraDesde(),  Criteria::GREATER_EQUAL);
                        $a->addAnd(EstHorasPeer::HORA,$s->getHoraHasta(),  Criteria::LESS_EQUAL);
                        $row=EstHorasPeer::doCount($a);
                
                        $solic=  SfGuardUserProfilePeer::retrieveByPK($s->getIdSolicitante());
                        $produ=  EstProductosPeer::retrieveByPK($s->getIdProducto());
                        $info=   "Solicitante: ".ucwords($solic->getNombre1().' '.$solic->getApellido1()).'<br>Producto: '.$produ->getDescripcion().'<br>'.$s->getObservaciones();
                        $info_fijos= $s->getObservaciones();
                        
                        if($s->getIdSolicitante()==$idus){$info .="<br><br><a style='font-size:10px;color:red;cursor:pointer;' onclick='elimina(".$s->getIdSolicitud().")'>ELIMINAR</a>";}
                        
                        if($s->getEstatus()=='e')
                        echo "<td style='text-align:center;background-color:#FFF838;' rowspan='".$row."'>".$info."</td>";
                         
                        else if($s->getEstatus()=='a')
                        echo "<td style='text-align:center;background-color:#44A1FF;' rowspan='".$row."'>".$info."</td>";
                        
                        else if($s->getEstatus()=='f')
                        echo "<td style='text-align:center;background-color:#E7EEF6;' rowspan='".$row."'>".$info_fijos."</td>";
          
          
                         
                    } else $cx=2;
                } else if ($cx!=2)$cx=1;
            }
            if($cx==1) echo "<td></td>";
     
                //if($co==4)break;
            
                if($ca==0) echo "<td></td>";
                if($cb==0) echo "<td></td>";
                if($cc==0) echo "<td></td>";
            ?>
             
        </tr>
    <?php }}?>
        
</table>

<div class="iconos">
<a href="<?php echo url_for('usuarios/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>

<script>
    ajaxproducto();
</script>