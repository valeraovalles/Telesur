<div class="titulo_modulo">SELECCIONE EL TIPO DE PRODUCTO</div>
<h3 style="color:red;">INTERNET EXPLORER NO MUESTRA LAS UBICACIONES, SE RECOMIENDA FIREFOX</h3>


<div style="width:400px;">
    
  <h3>EQUIPOS DE TRANSMISIÓN</h3>
  
  <ul style="text-align: left;">  
  <?php foreach ($equipos_transmision as $et) {?>
   
    <li><a href="<?php echo url_for('mapa/muestramapa?tp=et-'.$et->getIdEquipoTransmision())?>"><?php echo $et->getDescripcionEquipoTransmision()?></a></li>  

  
  <?php }?>
  </ul>  
</div>
  
