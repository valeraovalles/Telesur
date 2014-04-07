<td class="sf_admin_text sf_admin_list_td_id_vehiculo">
  <?php echo link_to($TraVehiculos->getIdVehiculo(), 'tra_vehiculos_edit', $TraVehiculos) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_modelo">
  <?php echo $TraVehiculos->getModelo() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_ano">
  <?php echo $TraVehiculos->getAno() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_placa">
  <?php echo $TraVehiculos->getPlaca() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_color">
  <?php echo $TraVehiculos->getColor() ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_carro">
  <?php echo get_partial('vehiculos/list_field_boolean', array('value' => $TraVehiculos->getCarro())) ?>
</td>
