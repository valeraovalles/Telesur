<?php use_helper('I18N', 'Date') ?>
<?php include_partial('vehiculos/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Edit Vehiculos', array(), 'messages') ?></h1>

  <?php include_partial('vehiculos/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('vehiculos/form_header', array('TraVehiculos' => $TraVehiculos, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('vehiculos/form', array('TraVehiculos' => $TraVehiculos, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('vehiculos/form_footer', array('TraVehiculos' => $TraVehiculos, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
