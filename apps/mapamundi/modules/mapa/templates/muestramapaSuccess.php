<div class="titulo_modulo"><?php echo $tipo.' ('.strtoupper($producto->getDescripcionEquipoTransmision()).')';?></div>


<?php

function latlon($pais){
    //direccion a buscar
    $direccion= urlencode($pais);

    //Buscamos la direccion en el servicio de google
    $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$direccion.'&sensor=false');

    //decodificamos lo que devuelve google, que esta en formato json
    $output= json_decode($geocode);

    //Extraemos la informacion que nos interesa
    $lat = $output->results[0]->geometry->location->lat;
    $long = $output->results[0]->geometry->location->lng;

    //la retornamos
    return $lat.', '.$long;    
}

?>




<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
    html { height: 100% }
    body { height: 100%; margin: 0px; padding: 0px }
    #map_canvas { height: 100% }
    </style>
    
    <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?sensor=false&language=es">
    </script>
    
<script type="text/javascript">
  function initialize() {

    //CENTRO DEL MAPA
    var latlng = new google.maps.LatLng(19.311143,-3.515625);
    var myOptions = {
      zoom: 2,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    <?php 
    
        foreach ($ubicaciones as $ub) {
            $pais=MmPaisesPeer::retrieveByPK($ub->getIdPais());
            $producto=  MmEquiposTransmisionPeer::retrieveByPK($ub->getIdProducto());

    ?>
            
        
            
            
        //CONTENIDO DEL MARCADOR
        var contentString<?php echo $pais->getIdPais();?> = '<div style="color:red;width:250px;font-size:11px;text-align:justify;"><?php echo 'CANTIDAD: '.$ub->getCantidad().'<br><br>'.'DESCRIPCION: '.$ub->getDescripcion()?></div>';

        var infowindow<?php echo $pais->getIdPais();?> = new google.maps.InfoWindow({
            content: contentString<?php echo $pais->getIdPais();?>
        });
        
        var marker<?php echo $pais->getIdPais();?> = new google.maps.Marker({
            position: new google.maps.LatLng(<?php echo latlon($pais->getIdPais())?>),
                map: map,
                title:"<?php echo $pais->getIdPais();?>",
                icon: 'http://imageshack.us/a/img18/5693/telesur.png'
        });

        google.maps.event.addListener(marker<?php echo $pais->getIdPais();?>,'click', function() {
                infowindow<?php echo $pais->getIdPais();?>.open(map,marker<?php echo $pais->getIdPais();?>);
        });

    <?php }?>



    //FIN MARCADORES

  }




</script>

</head>
<body onload="initialize()">
  <div id="map_canvas" style="width:900px; height:400px"></div>
</body>
</html>


<div class="iconos">
<a href="<?php echo url_for('mapa/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;Volver</a>&nbsp;&nbsp;
</div>