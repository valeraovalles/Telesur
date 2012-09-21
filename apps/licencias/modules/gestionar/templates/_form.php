<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('gestionar/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_licencia='.$form->getObject()->getIdLicencia() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<table class="crud_form select200 input200 textarea200">
    <tfoot>
      <tr>
          <td colspan="2" style="text-align: center;">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('gestionar/index') ?>">Volver <?php echo image_tag("volver.jpg")?></a>&nbsp;&nbsp;
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'gestionar/delete?id_licencia='.$form->getObject()->getIdLicencia(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
            <input id="boton" type="submit" value="Salvar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <!--<tr>
        <th><?php //echo $form['id_responsable']->renderLabel() ?></th>
        <td>
          <?php //echo $form['id_responsable']->renderError() ?>
          <?php //echo $form['id_responsable'] ?>
        </td>       
      </tr>-->
      <?php echo $form['id_responsable'] ?> 
      <tr>
        <th><?php echo $form['tipo']->renderLabel() ?></th>
        <td>
          <?php echo $form['tipo']->renderError() ?>
          <?php echo $form['tipo'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['nombre_licencia']->renderLabel() ?></th>
        <td>
          <?php echo $form['nombre_licencia']->renderError() ?>
          <?php echo $form['nombre_licencia'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['numero']->renderLabel() ?></th>
        <td>
          <?php echo $form['numero']->renderError() ?>
          <?php echo $form['numero'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['fecha_compra']->renderLabel() ?></th>
        <td>
          <?php echo $form['fecha_compra']->renderError() ?>
          <?php echo $form['fecha_compra'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['fecha_vencimiento']->renderLabel() ?></th>
        <td>
          <?php echo $form['fecha_vencimiento']->renderError() ?>
          <?php echo $form['fecha_vencimiento'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['descripcion']->renderLabel() ?></th>
        <td>
          <?php echo $form['descripcion']->renderError() ?>
          <?php echo $form['descripcion'] ?>
        </td>
      </tr>
      <!--<tr>
        <th><?php //echo $form['bandera_correo']->renderLabel() ?></th>
        <td>
          <?php //echo $form['bandera_correo']->renderError() ?>
          <?php //echo $form['bandera_correo'] ?>
        </td>
      </tr>-->

    </tbody>
  </table>
</form>
