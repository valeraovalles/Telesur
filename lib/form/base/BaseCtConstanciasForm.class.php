<?php

/**
 * CtConstancias form base class.
 *
 * @method CtConstancias getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseCtConstanciasForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_constancia'     => new sfWidgetFormInputHidden(),
      'id_solicitante'    => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => false)),
      'fecha_solicitud'   => new sfWidgetFormDate(),
      'tipo_constancia'   => new sfWidgetFormInputText(),
      'bono_alimentacion' => new sfWidgetFormInputCheckbox(),
      'motivo'            => new sfWidgetFormInputText(),
      'dirigido_a'        => new sfWidgetFormInputText(),
      'estatus'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_constancia'     => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdConstancia()), 'empty_value' => $this->getObject()->getIdConstancia(), 'required' => false)),
      'id_solicitante'    => new sfValidatorPropelChoice(array('model' => 'SfGuardUserProfile', 'column' => 'user_id')),
      'fecha_solicitud'   => new sfValidatorDate(),
      'tipo_constancia'   => new sfValidatorString(array('max_length' => 3)),
      'bono_alimentacion' => new sfValidatorBoolean(),
      'motivo'            => new sfValidatorString(array('max_length' => 500)),
      'dirigido_a'        => new sfValidatorString(array('max_length' => 100)),
      'estatus'           => new sfValidatorString(array('max_length' => 1)),
    ));

    $this->widgetSchema->setNameFormat('ct_constancias[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CtConstancias';
  }


}
