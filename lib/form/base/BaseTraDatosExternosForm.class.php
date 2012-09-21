<?php

/**
 * TraDatosExternos form base class.
 *
 * @method TraDatosExternos getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTraDatosExternosForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_externo' => new sfWidgetFormInputHidden(),
      'cedula'     => new sfWidgetFormInputText(),
      'nombre'     => new sfWidgetFormInputText(),
      'apellido'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_externo' => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdExterno()), 'empty_value' => $this->getObject()->getIdExterno(), 'required' => false)),
      'cedula'     => new sfValidatorString(array('max_length' => 15)),
      'nombre'     => new sfValidatorString(array('max_length' => 50)),
      'apellido'   => new sfValidatorString(array('max_length' => 50)),
    ));

    $this->widgetSchema->setNameFormat('tra_datos_externos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TraDatosExternos';
  }


}
