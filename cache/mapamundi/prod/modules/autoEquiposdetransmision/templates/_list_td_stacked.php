<td colspan="2">
  <?php echo __('%%id_equipo_transmision%% - %%descripcion_equipo_transmision%%', array('%%id_equipo_transmision%%' => link_to($MmEquiposTransmision->getIdEquipoTransmision(), 'mm_equipos_transmision_edit', $MmEquiposTransmision), '%%descripcion_equipo_transmision%%' => $MmEquiposTransmision->getDescripcionEquipoTransmision()), 'messages') ?>
</td>
