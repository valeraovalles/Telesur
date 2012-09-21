<div class="titulo_modulo">LISTA DE USUARIOS (TECNOLOGÍA)</div>

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>	

<table class="tabla_list" cellspacing="1px" cellpadding="5px">
    
    <tr>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Cedula</th>
        <th>Unidad</th>
        <th>Acciones</th>
    </tr>
    
    <?php foreach ($usuarios as $u) {?>
    
        <tr>
            <td><?php echo $u->getNombre1()?></td>
            <td><?php echo $u->getApellido1()?></td>
            <td><?php echo $u->getCedula()?></td>
            <td>
                
                <?php
                    $idunidad_pertenece =  SitUsuariosUnidadesPeer::retrieveByPK($u->getUserId());                   
                    
                    if(!empty($idunidad_pertenece)){
                        $unidad_pertenece =  SitUnidadesPeer::retrieveByPK($idunidad_pertenece->getIdUnidad());
                        echo $unidad_pertenece->getDescripcion();
                    }
                    else echo "No asociada";
                ?>
                
            </td>
            
            <td><a href="<?php echo url_for('UsuarioUnidad/asignar?id='.$u->getUserId())?>"><?php echo image_tag("edit.png")?></a></td>
            
        </tr>
    
    <?php }?>
    
</table>