<div class="titulo_modulo">SOLICITUD DE TRANSPORTE</div>

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>	

<form action="<?php echo url_for("solicitud/formulariotransporte")?>" method="post" name="form">

<table class="crud_form" cellpadding="5px" style="width: 450px;">

    <tr>
        <th style="width: 45%;">Fecha de solicitud:</th>
        <td><?php echo date("d-m-Y");?></td>
    </tr>
    
    <tr>
        <th><span style="color:red;">*</span>Fecha de búsqueda:</th>
        <td>
            <?php echo $form['asistentes']?> 
            <?php echo $form['fecha_salida']->renderError(); ?>
            <?php echo $form['fecha_salida']?>     
        </td>
    </tr>

    <tr>
        <th><span style="color:red;">*</span>Hora de búsqueda:</th>
        <td>
                <?php echo $form['hora_salida']->renderError(); ?>
                <?php echo $form['hora_salida']?>
        </td>
    </tr>

    <tr>
        <th><span style="color:red;">*</span>Personal</th>
        <td><?php echo $form['asistentes']->renderError(); ?><input autocomplete="off" type="text" id="cpi" onkeyup="ajax('/Telesur/web/transporte.php/ajax/muestrapersonal','contenido',document.getElementById('cpi').value)"></td>
    </tr>
    
</table>

<div id="contenido"></div>

<br>

<h1>LISTA DE USUARIOS</h1>

<br>

<div id="listado">No hay personas agregadas</div>


<br>

<table class="crud_form" cellpadding="5px" style="width: 450px;">
    
    <tr>
        <th style="width: 45%;"><span style="color:red;">*</span>Dirección Desde/Hasta:</th>
        <td>
            <?php echo $form['direccion_traslado']->renderError(); ?>
            <?php echo $form['direccion_traslado']?>
        </td>
    </tr>
    
    <tr>
        <th><span style="color:red;">*</span>Razón/Otros datos:</th>
        <td>
            <?php echo $form['datos_interes_razon']->renderError(); ?>
            <?php echo $form['datos_interes_razon']?>             
        </td>
    </tr>
    
    <tr>
        <th><span style="color:red;">*</span>Tipo de transporte:</th>
        <td>
            <?php echo $form['tipo_transporte']->renderError(); ?>
            <?php echo $form['tipo_transporte']?>             
        </td>
    </tr>    
    
    <tr>
        <th>Equipos a trasladar:</th>
        <td>
            <?php echo $form['descripcion_equipos']->renderError(); ?>
            <?php echo $form['descripcion_equipos']?>
        </td>
    </tr>
    

</table>

<div style="color: red;">* Campos requeridos</div>

<br>

<input type="button" onclick="enviar_formulario('Enviar_Formulario')" value="Solicitar" id="boton">
<input type="hidden" name="accion" id="accion" value="">
</form>


<script>
    ajax('/Telesur/web/transporte.php/ajax/agregapersonalista','listado','<?php echo $lista?>','cpi')
</script>

<div class="iconos">
    <a href="<?php echo url_for('solicitud/index')?>">Volver&nbsp;<?php echo image_tag("volver.jpg")?></a>
</div>
