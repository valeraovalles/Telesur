<div class="titulo_modulo">LISTA DE UBICACIONES</div>

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>

<form method="post" action="<?php echo url_for('ubicaciones/index')?>" name="form">
<table class="tabla_list">
    <tr>
        <th>ID</th>
        <th>PAIS</th>
        <th>PRODUCTO</th>
        <th width="10%">ACCIONES</th>
    </tr>
    
    <?php foreach ($ubicaciones as $ub) {?>
    <tr>
        <td><?php echo $ub->getIdUbicacion()?></td>
        <td><?php $pais=MmPaisesPeer::retrieveByPK($ub->getIdPais()); echo $pais->getPais()?></td>
        <td><?php $producto=  MmEquiposTransmisionPeer::retrieveByPK($ub->getIdProducto()); echo $producto->getDescripcionEquipoTransmision()?></td>
        <td>
            <a href="<?php echo url_for("ubicaciones/editar?id=".$ub->getIdUbicacion())?>"><?php echo image_tag("edit.png")?></a>
            <a href="javascript:void(0)" onclick="elimina(<?php echo $ub->getIdUbicacion();?>)"><?php echo image_tag("delete.png")?></a>
            
        </td>
    </tr>
    <?php }?>
    
    
</table>
    <input type="hidden" name="accion" id="accion" value="">
    <input type="hidden" name="eliminar" id="eliminar" value="">
</form> 
    
<div class="iconos">
    <a href="<?php echo url_for('ubicaciones/ubicacion')?>"><?php echo image_tag('new.png')?>&nbsp;Nueva</a>&nbsp;&nbsp;
    <a href="<?php echo url_for('mapa/inicio')?>"><?php echo image_tag('volver.jpg')?>&nbsp;Volver</a>&nbsp;&nbsp;
</div>