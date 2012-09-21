<?php

/**
 * CpControldepersonal form base class.
 *
 * @method CpControldepersonal getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseCpControldepersonalForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_control'          => new sfWidgetFormInputHidden(),
      'id_usuario'          => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => false)),
      'fecha_entrada'       => new sfWidgetFormDate(),
      'hora_entrada'        => new sfWidgetFormTime(),
      'observacion_entrada' => new sfWidgetFormInputText(),
      'fecha_salida'        => new sfWidgetFormDate(),
      'hora_salida'         => new sfWidgetFormTime(),
      'observacion_salida'  => new sfWidgetFormInputText(),
      'ip_entrada'          => new sfWidgetFormInputText(),
      'ip_salida'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_control'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdControl()), 'empty_value' => $this->getObject()->getIdControl(), 'required' => false)),
      'id_usuario'          => new sfValidatorPropelChoice(array('model' => 'SfGuardUserProfile', 'column' => 'user_id')),
      'fecha_entrada'       => new sfValidatorDate(),
      'hora_entrada'        => new sfValidatorTime(),
      'observacion_entrada' => new sfValidatorString(array('max_length' => 300)),
      'fecha_salida'        => new sfValidatorDate(),
      'hora_salida'         => new sfValidatorTime(),
      'observacion_salida'  => new sfValidatorString(array('max_length' => 300)),
      'ip_entrada'          => new sfValidatorString(array('max_length' => 15)),
      'ip_salida'           => new sfValidatorString(array('max_length' => 15)),
    ));

    $this->widgetSchema->setNameFormat('cp_controldepersonal[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CpControldepersonal';
  }


}
