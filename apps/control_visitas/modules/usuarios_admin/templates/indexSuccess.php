<div class="titulo_principal">LISTADO DE VISITANTES</div>

<table class="tabla_list">
  <thead>
    <tr>
      <th>Editar</th>      
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Cedula</th>
      <th>consultar</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($CvUsuarioss as $CvUsuarios): ?>
    <tr>
      <td><a href="<?php echo url_for('usuarios_admin/edit?id_usuario='.$CvUsuarios->getIdUsuario()) ?>"><?php echo $CvUsuarios->getIdUsuario() ?></a></td>   
      <td><?php echo $CvUsuarios->getNombre() ?></td>
      <td><?php echo $CvUsuarios->getApellido() ?></td>
      <td><?php echo $CvUsuarios->getCedula() ?></td>
      <td><a href="<?php echo url_for('usuarios_admin/detalle?id_usuario='.$CvUsuarios->getIdUsuario()) ?>"><?php echo image_tag("busca.png",array('size' => '20x20'))?></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="iconos">
    <a href="<?php echo url_for('usuarios/index')?>">Volver&nbsp;<?php echo image_tag("volver.jpg")?></a>
</div>