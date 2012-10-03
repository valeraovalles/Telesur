<div class="titulo_modulo">REGISTRO DE USUARIOS</div>

<form action="<?php echo url_for('usuarios/formulario_ingreso')?>" name="form" method="post">
    <table class="crud_form input200" style="width: 400px;">
        <tr>
            <th>Cédula</th>
            <td><input type="text" name="cedula"></td>
            <td><input type="button" onclick="enviar_formulario('Buscar Usuario')" value="Buscar" id="boton"></td>
        </tr>
    </table>
    <input type="hidden" name="accion" id="accion" value="">
</form>
<br><br>