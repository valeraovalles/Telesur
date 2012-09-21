<?php

/**
 * TraAsignaciones form base class.
 *
 * @method TraAsignaciones getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTraAsignacionesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_solicitud' => new sfWidgetFormInputHidden(),
      'id_vehiculo'  => new sfWidgetFormPropelChoice(array('model' => 'TraVehiculos', 'add_empty' => false)),
      'id_conductor' => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id_solicitud' => new sfValidatorPropelChoice(array('model' => 'TraSolicitudes', 'column' => 'id_solicitud', 'required' => false)),
      'id_vehiculo'  => new sfValidatorPropelChoice(array('model' => 'TraVehiculos', 'column' => 'id_vehiculo')),
      'id_conductor' => new sfValidatorPropelChoice(array('model' => 'SfGuardUserProfile', 'column' => 'user_id')),
    ));

    $this->widgetSchema->setNameFormat('tra_asignaciones[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TraAsignaciones';
  }


}
