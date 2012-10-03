<?php

/**
 * MmEquiposTransmision form base class.
 *
 * @method MmEquiposTransmision getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseMmEquiposTransmisionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_equipo_transmision'          => new sfWidgetFormInputHidden(),
      'descripcion_equipo_transmision' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_equipo_transmision'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdEquipoTransmision()), 'empty_value' => $this->getObject()->getIdEquipoTransmision(), 'required' => false)),
      'descripcion_equipo_transmision' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mm_equipos_transmision[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MmEquiposTransmision';
  }


}
