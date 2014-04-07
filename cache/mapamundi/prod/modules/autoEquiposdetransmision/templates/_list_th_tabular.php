<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_id_equipo_transmision">
  <?php if ('id_equipo_transmision' == $sort[0]): ?>
    <?php echo link_to(__('Id equipo transmision', array(), 'messages'), '@mm_equipos_transmision', array('query_string' => 'sort=id_equipo_transmision&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Id equipo transmision', array(), 'messages'), '@mm_equipos_transmision', array('query_string' => 'sort=id_equipo_transmision&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_descripcion_equipo_transmision">
  <?php if ('descripcion_equipo_transmision' == $sort[0]): ?>
    <?php echo link_to(__('Descripcion equipo transmision', array(), 'messages'), '@mm_equipos_transmision', array('query_string' => 'sort=descripcion_equipo_transmision&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Descripcion equipo transmision', array(), 'messages'), '@mm_equipos_transmision', array('query_string' => 'sort=descripcion_equipo_transmision&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>