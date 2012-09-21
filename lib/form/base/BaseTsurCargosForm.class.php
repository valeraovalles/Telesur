<?php

/**
 * TsurCargos form base class.
 *
 * @method TsurCargos getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTsurCargosForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_cargo'    => new sfWidgetFormInputHidden(),
      'descripcion' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_cargo'    => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdCargo()), 'empty_value' => $this->getObject()->getIdCargo(), 'required' => false)),
      'descripcion' => new sfValidatorString(array('max_length' => 100)),
    ));

    $this->widgetSchema->setNameFormat('tsur_cargos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TsurCargos';
  }


}
