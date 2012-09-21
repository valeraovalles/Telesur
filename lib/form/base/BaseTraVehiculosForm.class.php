<?php

/**
 * TraVehiculos form base class.
 *
 * @method TraVehiculos getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTraVehiculosForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_vehiculo' => new sfWidgetFormInputHidden(),
      'modelo'      => new sfWidgetFormInputText(),
      'ano'         => new sfWidgetFormInputText(),
      'placa'       => new sfWidgetFormInputText(),
      'color'       => new sfWidgetFormInputText(),
      'carro'       => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id_vehiculo' => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdVehiculo()), 'empty_value' => $this->getObject()->getIdVehiculo(), 'required' => false)),
      'modelo'      => new sfValidatorString(array('max_length' => 50)),
      'ano'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'placa'       => new sfValidatorString(array('max_length' => 20)),
      'color'       => new sfValidatorString(array('max_length' => 50)),
      'carro'       => new sfValidatorBoolean(),
    ));

    $this->widgetSchema->setNameFormat('tra_vehiculos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TraVehiculos';
  }


}
