<?php use_helper('I18N', 'Date') ?>
<?php include_partial('externos/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('New Externos', array(), 'messages') ?></h1>

  <?php include_partial('externos/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('externos/form_header', array('TraDatosExternos' => $TraDatosExternos, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('externos/form', array('TraDatosExternos' => $TraDatosExternos, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('externos/form_footer', array('TraDatosExternos' => $TraDatosExternos, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
