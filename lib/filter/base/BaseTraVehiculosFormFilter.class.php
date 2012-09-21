<?php

/**
 * TraVehiculos filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseTraVehiculosFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'modelo'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ano'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'placa'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'color'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'carro'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'modelo'      => new sfValidatorPass(array('required' => false)),
      'ano'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'placa'       => new sfValidatorPass(array('required' => false)),
      'color'       => new sfValidatorPass(array('required' => false)),
      'carro'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('tra_vehiculos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TraVehiculos';
  }

  public function getFields()
  {
    return array(
      'id_vehiculo' => 'Number',
      'modelo'      => 'Text',
      'ano'         => 'Number',
      'placa'       => 'Text',
      'color'       => 'Text',
      'carro'       => 'Boolean',
    );
  }
}
