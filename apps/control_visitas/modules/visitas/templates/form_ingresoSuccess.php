<div class="titulo_modulo">REGISTRO DE USUARIOS</div>

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>     

<form action="<?php echo url_for('visitas/form_ingreso')?>" name="form" method="post">
    <table class="crud_form input200" style="width: 400px;">
        <tr>
            <th>Cédula</th>
            <td><input type="text" name="cedula" value="<?php if($cedula!='')echo $cedula;?>"></td>
            <td><input type="button" onclick="enviar_formulario('Buscar Usuario')" value="Buscar" id="boton"></td>
        </tr>
    </table>
    <br><br>
  
<?php
if(isset($exist) && $exist==0){?>
<table  class="crud_form input200 textarea200" border=1  style="width: 400px;">

<tr>    
    <th>numero de carnet:</th>
    <td><?php echo $form['num_carnet']->renderError(); ?><?php echo $form['num_carnet'];?></td>
</tr>    
<tr>    
    <th>nombre:</th>
    <td><?php echo $form['nombre']->renderError(); ?><?php echo $form['nombre'];?></td>
</tr>
<tr>    
    <th>apellido:</th>
    <td><?php echo $form['apellido']->renderError(); ?><?php echo $form['apellido'];?> </td>
</tr>
<tr>    
    <th>contacto:</th>
    <td><?php echo $form['contacto']->renderError(); ?><?php echo $form['contacto'];?> </td>
</tr>
<tr>    
    <th>observaciones:</th>
    <td><?php echo $form['observaciones']->renderError(); ?><?php echo $form['observaciones'];?></td>
</tr>    
<tr>
     
    <td colspan="2" style="text-align: center;"><input type="button" onclick="enviar_formulario('Registrar Visitante')" name="Registrar Visita" id="boton" value="registrar"></td>
    </tr> 

</table>

    
<?php } else if(isset($exist) && $exist==1){?>
<table  border=1  style="width: 100px;">
    <tr>    
        <td colspan='2'><img width='140;' src="<?php echo image_path('visitas/imagenes_usuarios/'.$datos[0]->getCedula().'.jpg')?>"></td>
    </tr>
    <tr>    
    <th>Cedula:</th>
    <td><?php echo $datos[0]->getCedula();?></td>
    </tr>
    <tr>
    <th>Nombre:</th>    
    <td><?php echo $datos[0]->getNombre();?></td>
    </tr>
    <tr>
    <th>Apellido:</th>   
    <td><?php echo $datos[0]->getApellido();?></td>
    </tr>
    <tr>    
    <th>numero de carnet:</th>
    <td><?php echo $form2['num_carnet']->renderError(); ?><?php echo $form2['num_carnet'];?></td>
    </tr>    
    <tr>    
    <th>contacto:</th>
    <td><?php echo $form2['contacto']->renderError(); ?><?php echo $form2['contacto'];?> </td>
    </tr>
    <tr>    
    <th>observaciones:</th>
    <td><?php echo $form2['observaciones']->renderError(); ?><?php echo $form2['observaciones'];?></td>
    </tr>    
    <tr>
    <th>Registrar Visita</th>    
<td><input type="button" onclick="enviar_formulario('Registrar Visita')" name="Registrar Visita" id="boton" value="registrar"></td>
    </tr> 
    
</table>
     
<?php }?>
    <input type="hidden" name="accion" id="accion" value="">
</form>

<div class="iconos">
    <a href="<?php echo url_for('usuarios/index')?>">Volver&nbsp;<?php echo image_tag("volver.jpg")?></a>
</div>