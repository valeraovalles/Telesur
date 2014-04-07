<td colspan="6">
  <?php echo __('%%id_vehiculo%% - %%modelo%% - %%ano%% - %%placa%% - %%color%% - %%carro%%', array('%%id_vehiculo%%' => link_to($TraVehiculos->getIdVehiculo(), 'tra_vehiculos_edit', $TraVehiculos), '%%modelo%%' => $TraVehiculos->getModelo(), '%%ano%%' => $TraVehiculos->getAno(), '%%placa%%' => $TraVehiculos->getPlaca(), '%%color%%' => $TraVehiculos->getColor(), '%%carro%%' => get_partial('vehiculos/list_field_boolean', array('value' => $TraVehiculos->getCarro()))), 'messages') ?>
</td>
