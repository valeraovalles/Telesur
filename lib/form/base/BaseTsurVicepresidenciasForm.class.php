<?php

/**
 * TsurVicepresidencias form base class.
 *
 * @method TsurVicepresidencias getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTsurVicepresidenciasForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_vcepresidencia' => new sfWidgetFormInputHidden(),
      'descripcion'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_vcepresidencia' => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdVcepresidencia()), 'empty_value' => $this->getObject()->getIdVcepresidencia(), 'required' => false)),
      'descripcion'       => new sfValidatorString(array('max_length' => 100)),
    ));

    $this->widgetSchema->setNameFormat('tsur_vicepresidencias[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TsurVicepresidencias';
  }


}
