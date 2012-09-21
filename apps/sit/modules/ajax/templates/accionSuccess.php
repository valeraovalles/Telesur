


<table class="crud_form select200" cellpadding="10px">
    <?php if($datos==1){ ?>
        <tr>
            <th>Asignar ticket</th>
            <td>
                <select name="asignar">
                    <option value="">Seleccione un usuario</option>
                    <?php foreach ($tecnico_unidad as $tu){?>
                        <option value="<?php echo $tu->getUserId()?>"><?php echo $tu->getNombre1().' '.$tu->getApellido1()?></option>
                    <?php }?>
		</select>
            </td>
	</tr>  	
        <tr><td colspan="2" style="text-align: center;"><input type="button" onclick="enviar_formulario('Asignar ticket')" id="boton" value="Asignar"></td></tr>
    <?php }?> 

    <?php if($datos==2){?>
        <tr>
            <th>Reasignar</th>
            <td>
                <select name="reasignar">
                    <option value="">Seleccione una opcion</option>
                    <?php foreach ($unidades as $u){?>
                    <option value="<?php echo $u->getIdUnidad()?>"><?php echo $u->getDescripcion()?></option>
                    <?php }?>
		</select>
            </td>
	</tr>
        <tr><td colspan="2" style="text-align: center;"><input type="button" onclick="enviar_formulario('Reasignar ticket')" id="boton" value="Enviar"></td></tr>
<?php }?>                    
</table>
