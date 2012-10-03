<?php

/**
 * MmEquipoTransmision form base class.
 *
 * @method MmEquipoTransmision getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseMmEquipoTransmisionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_equipo_transmision'           => new sfWidgetFormInputHidden(),
      'descripcion_equipos_transmision' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_equipo_transmision'           => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdEquipoTransmision()), 'empty_value' => $this->getObject()->getIdEquipoTransmision(), 'required' => false)),
      'descripcion_equipos_transmision' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mm_equipo_transmision[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MmEquipoTransmision';
  }


}
