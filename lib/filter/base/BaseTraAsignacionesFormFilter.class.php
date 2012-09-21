<?php

/**
 * TraAsignaciones filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseTraAsignacionesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_vehiculo'  => new sfWidgetFormPropelChoice(array('model' => 'TraVehiculos', 'add_empty' => true)),
      'id_conductor' => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_vehiculo'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'TraVehiculos', 'column' => 'id_vehiculo')),
      'id_conductor' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SfGuardUserProfile', 'column' => 'user_id')),
    ));

    $this->widgetSchema->setNameFormat('tra_asignaciones_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TraAsignaciones';
  }

  public function getFields()
  {
    return array(
      'id_solicitud' => 'ForeignKey',
      'id_vehiculo'  => 'ForeignKey',
      'id_conductor' => 'ForeignKey',
    );
  }
}
