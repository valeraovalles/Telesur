<h1>LISTA DE LICENCIAS Y SERVICIOS</h1>

<br>

<table class="tabla_list">
  <thead>
    <tr>
      <th>Nombre licencia/Servicio</th>
      <th>Fecha compra</th>
      <th>Fecha vencimiento</th>
      <th>Días Restantes</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($LcLicenciass as $LcLicencias): ?>
    <tr>
      
      <?php
        $f=new funciones;
        $fecha=$LcLicencias->getFechaVencimiento("d-m-Y");
        $dias = $f->dias_fechas(explode("-",$fecha));
      ?>  
        
      <td <?php if($dias<60)echo "style='color:red;'"?>><?php echo $LcLicencias->getNombreLicencia() ?></td>
      <td><?php echo $LcLicencias->getFechaCompra("d-m-Y") ?></td>
      <td><?php echo $LcLicencias->getFechaVencimiento("d-m-Y") ?></td>
      <td><?php echo $dias?></td>
        <td>
            <a href="<?php echo url_for('gestionar/edit?id_licencia='.$LcLicencias->getIdLicencia()) ?>"><?php echo image_tag("edit.png")?></a>
            <a href="<?php echo url_for('gestionar/consultar?idl='.$LcLicencias->getIdLicencia()) ?>"><?php echo image_tag("list.png")?></a>
            <?php echo link_to(image_tag("delete.png"), 'gestionar/delete?id_licencia='.$LcLicencias->getIdLicencia(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>

        </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="iconos">
  <a href="<?php echo url_for('gestionar/new') ?>"><?php echo image_tag("new.png")?>Nueva Licencia ó Servicio</a>
</div>