<?php

/**
 * EstHoras form base class.
 *
 * @method EstHoras getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseEstHorasForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'hora'    => new sfWidgetFormTime(),
      'id_hora' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'hora'    => new sfValidatorTime(),
      'id_hora' => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdHora()), 'empty_value' => $this->getObject()->getIdHora(), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('est_horas[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EstHoras';
  }


}
