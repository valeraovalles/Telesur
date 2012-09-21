<?php

/**
 * TsurDependencias form base class.
 *
 * @method TsurDependencias getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTsurDependenciasForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_dependencia' => new sfWidgetFormInputHidden(),
      'descripcion'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_dependencia' => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdDependencia()), 'empty_value' => $this->getObject()->getIdDependencia(), 'required' => false)),
      'descripcion'    => new sfValidatorString(array('max_length' => 100)),
    ));

    $this->widgetSchema->setNameFormat('tsur_dependencias[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TsurDependencias';
  }


}
