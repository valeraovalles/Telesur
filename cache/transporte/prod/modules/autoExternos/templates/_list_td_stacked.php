<td colspan="4">
  <?php echo __('%%id_externo%% - %%cedula%% - %%nombre%% - %%apellido%%', array('%%id_externo%%' => link_to($TraDatosExternos->getIdExterno(), 'tra_datos_externos_edit', $TraDatosExternos), '%%cedula%%' => $TraDatosExternos->getCedula(), '%%nombre%%' => $TraDatosExternos->getNombre(), '%%apellido%%' => $TraDatosExternos->getApellido()), 'messages') ?>
</td>
