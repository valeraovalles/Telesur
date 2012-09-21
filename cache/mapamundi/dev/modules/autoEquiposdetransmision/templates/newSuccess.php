<?php use_helper('I18N', 'Date') ?>
<?php include_partial('equiposdetransmision/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('New Equiposdetransmision', array(), 'messages') ?></h1>

  <?php include_partial('equiposdetransmision/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('equiposdetransmision/form_header', array('MmEquiposTransmision' => $MmEquiposTransmision, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('equiposdetransmision/form', array('MmEquiposTransmision' => $MmEquiposTransmision, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('equiposdetransmision/form_footer', array('MmEquiposTransmision' => $MmEquiposTransmision, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
