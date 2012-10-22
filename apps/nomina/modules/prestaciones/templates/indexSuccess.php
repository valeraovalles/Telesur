<div class="titulo_modulo">SELECCIONE LOS PARÁMETROS PARA GENERAR LOS TXT DE PRESTACIONES</div>

<form  name="form" method="post" action="<?php echo url_for('prestaciones/generartxt')?>">
    <table  class="crud_form input150 select150" style="width: 350px;" cellpadding="10px;">
        <tr>
            <th>Año</th>
            <td>
                <select name="anio">
                    <option value=""></option>
                    <?php for($i=2008;$i<=date('Y');$i++){?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Periodo</th>
            <td><input type="text" name="periodo"></td>
        </tr>
        <tr>
            <th>Tipo nomina</th>
            <td>
                <select name="nomina">
                    <option value=""></option>
                    <option value="CONT">Contratados</option>
                    <option value="OBR">Obreros</option>
                    <option value="EMP">Empleados</option>
                    <option value="ANI">Alto Nivel</option>
                    <option value="EXT">Convenios Internacionales</option>
                    <option value="COMS">Comision de servicios</option>
                </select>
                
            </td>
        </tr>
        
        <tr>
            <th>Periodos</th>
            <td><input type="text" name="nidesde"></td>
        </tr>
        
        <!--
        <tr>
            <th>N.I Desde</th>
            <td><input type="text" name="nidesde" class="tcal"></td>
        </tr>
        
        <tr>
            <th>N.I Hasta</th>
            <td><input type="text" name="nihasta" class="tcal"></td>
        </tr>
        -->
        <tr>
            <td style="text-align: center;" colspan="2">
                <input id="boton" type="button" value="Generar" onclick="enviar_formulario('Generar TXT')">
                <input id="boton" type="button" value="Limpiar" onclick="limpiar('<?php echo url_for('prestaciones/index')?>')">
            </td>
        </tr>
    </table>
    <input type="hidden" value="" name="accion" id="accion">
</form>

<div class="iconos">
<a href="<?php echo url_for('prestaciones/index')?>">Volver<?php echo image_tag("volver.jpg")?></a>
</div>