<?php

/**
 * SfGuardUserProfile form base class.
 *
 * @method SfGuardUserProfile getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseSfGuardUserProfileForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'          => new sfWidgetFormInputHidden(),
      'id_dependencia'   => new sfWidgetFormPropelChoice(array('model' => 'TsurDependencias', 'add_empty' => false)),
      'id_cargo'         => new sfWidgetFormPropelChoice(array('model' => 'TsurCargos', 'add_empty' => false)),
      'nombre1'          => new sfWidgetFormInputText(),
      'nombre2'          => new sfWidgetFormInputText(),
      'apellido1'        => new sfWidgetFormInputText(),
      'apellido2'        => new sfWidgetFormInputText(),
      'cedula'           => new sfWidgetFormInputText(),
      'sexo'             => new sfWidgetFormInputText(),
      'nacionalidad'     => new sfWidgetFormInputText(),
      'fecha_nacimiento' => new sfWidgetFormDate(),
      'extension'        => new sfWidgetFormInputText(),
      'fecha_ingreso'    => new sfWidgetFormDate(),
      'hora_entrada'     => new sfWidgetFormTime(),
      'hora_salida'      => new sfWidgetFormTime(),
    ));

    $this->setValidators(array(
      'user_id'          => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'id_dependencia'   => new sfValidatorPropelChoice(array('model' => 'TsurDependencias', 'column' => 'id_dependencia')),
      'id_cargo'         => new sfValidatorPropelChoice(array('model' => 'TsurCargos', 'column' => 'id_cargo')),
      'nombre1'          => new sfValidatorString(array('max_length' => 100)),
      'nombre2'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'apellido1'        => new sfValidatorString(array('max_length' => 100)),
      'apellido2'        => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'cedula'           => new sfValidatorString(array('max_length' => 15)),
      'sexo'             => new sfValidatorString(array('max_length' => 1)),
      'nacionalidad'     => new sfValidatorString(array('max_length' => 5)),
      'fecha_nacimiento' => new sfValidatorDate(array('required' => false)),
      'extension'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'fecha_ingreso'    => new sfValidatorDate(array('required' => false)),
      'hora_entrada'     => new sfValidatorTime(array('required' => false)),
      'hora_salida'      => new sfValidatorTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'SfGuardUserProfile', 'column' => array('user_id')))
    );

    $this->widgetSchema->setNameFormat('sf_guard_user_profile[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SfGuardUserProfile';
  }


}
