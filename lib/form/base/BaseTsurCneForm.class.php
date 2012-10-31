<?php

/**
 * TsurCne form base class.
 *
 * @method TsurCne getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTsurCneForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'nacionalidad'     => new sfWidgetFormInputText(),
      'cedula'           => new sfWidgetFormInputText(),
      'primer_apellido'  => new sfWidgetFormInputText(),
      'segundo_apellido' => new sfWidgetFormInputText(),
      'primer_nombre'    => new sfWidgetFormInputText(),
      'segundo_nombre'   => new sfWidgetFormInputText(),
      'cod'              => new sfWidgetFormInputText(),
      'id'               => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'nacionalidad'     => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'cedula'           => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'primer_apellido'  => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'segundo_apellido' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'primer_nombre'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'segundo_nombre'   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'cod'              => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tsur_cne[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TsurCne';
  }


}
