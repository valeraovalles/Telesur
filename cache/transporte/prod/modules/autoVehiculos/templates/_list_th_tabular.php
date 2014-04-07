<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_id_vehiculo">
  <?php if ('id_vehiculo' == $sort[0]): ?>
    <?php echo link_to(__('Id vehiculo', array(), 'messages'), '@tra_vehiculos', array('query_string' => 'sort=id_vehiculo&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Id vehiculo', array(), 'messages'), '@tra_vehiculos', array('query_string' => 'sort=id_vehiculo&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_modelo">
  <?php if ('modelo' == $sort[0]): ?>
    <?php echo link_to(__('Modelo', array(), 'messages'), '@tra_vehiculos', array('query_string' => 'sort=modelo&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Modelo', array(), 'messages'), '@tra_vehiculos', array('query_string' => 'sort=modelo&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_ano">
  <?php if ('ano' == $sort[0]): ?>
    <?php echo link_to(__('Ano', array(), 'messages'), '@tra_vehiculos', array('query_string' => 'sort=ano&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Ano', array(), 'messages'), '@tra_vehiculos', array('query_string' => 'sort=ano&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_placa">
  <?php if ('placa' == $sort[0]): ?>
    <?php echo link_to(__('Placa', array(), 'messages'), '@tra_vehiculos', array('query_string' => 'sort=placa&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Placa', array(), 'messages'), '@tra_vehiculos', array('query_string' => 'sort=placa&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_color">
  <?php if ('color' == $sort[0]): ?>
    <?php echo link_to(__('Color', array(), 'messages'), '@tra_vehiculos', array('query_string' => 'sort=color&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Color', array(), 'messages'), '@tra_vehiculos', array('query_string' => 'sort=color&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_boolean sf_admin_list_th_carro">
  <?php if ('carro' == $sort[0]): ?>
    <?php echo link_to(__('Carro', array(), 'messages'), '@tra_vehiculos', array('query_string' => 'sort=carro&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Carro', array(), 'messages'), '@tra_vehiculos', array('query_string' => 'sort=carro&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>