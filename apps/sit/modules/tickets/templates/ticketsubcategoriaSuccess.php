<div class="titulo_modulo">ASOCIAR TICKET A UNA SUBCATEGORIA</div>

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>

<?php  echo "<div style='text-align:justify;width:400px;'><b>Solicitud:</b> ".$tickets->getSolicitud()."</div>";?>
<br><br>

<form action="<?php echo url_for('tickets/ticketsubcategoria?id='.$idtk) ?>" method="post" name="form">

<?php
    foreach ($categorias as $c) {
      
        $a=new Criteria();
        $a->add(SitSubcategoriasPeer::ID_CATEGORIA,$c->getIdCategoria());
        $SitSubcategorias=SitSubcategoriasPeer::doSelect($a);
    
        if (isset($SitSubcategorias[0])){
           
            echo "<div align='left' style='font-weight:bold;padding: 0 0 10px 350px;'>".$c->getDescripcion()."</div>";

            foreach ($SitSubcategorias as $sc) {
                echo "<div align='left' style='padding:0 0 10px 370px;'><input type='radio' name='radio'  value='".$sc->getIdSubcategoria()."-".$c->getIdCategoria()."'>".ucfirst($sc->getDescripcion())."</div>";

            }               
        }    
        
        else{
            
            echo "<div align='left' style='font-weight:bold;padding:0 0 10px 350px;'>".ucfirst($c->getDescripcion())." (Debe agregar una subcategoria)</div>";
        }
        
        
        
}
?>
    <br><br>
    <div><input type="button" id="boton" value="Guardar" onclick="enviar_formulario('Asignar subcategoria')"></div>
    <input type="hidden" name="accion" id="accion">

</form>


<div class="iconos">
<a href="<?php echo url_for('tickets/index')?>"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>
