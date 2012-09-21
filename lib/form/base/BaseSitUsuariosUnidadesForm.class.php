<?php

/**
 * SitUsuariosUnidades form base class.
 *
 * @method SitUsuariosUnidades getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseSitUsuariosUnidadesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_usuario' => new sfWidgetFormInputHidden(),
      'id_unidad'  => new sfWidgetFormPropelChoice(array('model' => 'SitUnidades', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id_usuario' => new sfValidatorPropelChoice(array('model' => 'SfGuardUserProfile', 'column' => 'user_id', 'required' => false)),
      'id_unidad'  => new sfValidatorPropelChoice(array('model' => 'SitUnidades', 'column' => 'id_unidad')),
    ));

    $this->widgetSchema->setNameFormat('sit_usuarios_unidades[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SitUsuariosUnidades';
  }


}
