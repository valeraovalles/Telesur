<?php

/**
 * MmPaises form base class.
 *
 * @method MmPaises getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseMmPaisesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_pais' => new sfWidgetFormInputHidden(),
      'pais'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_pais' => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdPais()), 'empty_value' => $this->getObject()->getIdPais(), 'required' => false)),
      'pais'    => new sfValidatorString(array('max_length' => 100, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mm_paises[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MmPaises';
  }


}
