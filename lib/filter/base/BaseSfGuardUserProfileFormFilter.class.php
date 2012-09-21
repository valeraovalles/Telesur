<?php

/**
 * SfGuardUserProfile filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseSfGuardUserProfileFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_dependencia'   => new sfWidgetFormPropelChoice(array('model' => 'TsurDependencias', 'add_empty' => true)),
      'id_cargo'         => new sfWidgetFormPropelChoice(array('model' => 'TsurCargos', 'add_empty' => true)),
      'nombre1'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombre2'          => new sfWidgetFormFilterInput(),
      'apellido1'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'apellido2'        => new sfWidgetFormFilterInput(),
      'cedula'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sexo'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nacionalidad'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha_nacimiento' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'extension'        => new sfWidgetFormFilterInput(),
      'fecha_ingreso'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'hora_entrada'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'hora_salida'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'id_dependencia'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'TsurDependencias', 'column' => 'id_dependencia')),
      'id_cargo'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'TsurCargos', 'column' => 'id_cargo')),
      'nombre1'          => new sfValidatorPass(array('required' => false)),
      'nombre2'          => new sfValidatorPass(array('required' => false)),
      'apellido1'        => new sfValidatorPass(array('required' => false)),
      'apellido2'        => new sfValidatorPass(array('required' => false)),
      'cedula'           => new sfValidatorPass(array('required' => false)),
      'sexo'             => new sfValidatorPass(array('required' => false)),
      'nacionalidad'     => new sfValidatorPass(array('required' => false)),
      'fecha_nacimiento' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'extension'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fecha_ingreso'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'hora_entrada'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'hora_salida'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SfGuardUserProfile';
  }

  public function getFields()
  {
    return array(
      'user_id'          => 'ForeignKey',
      'id_dependencia'   => 'ForeignKey',
      'id_cargo'         => 'ForeignKey',
      'nombre1'          => 'Text',
      'nombre2'          => 'Text',
      'apellido1'        => 'Text',
      'apellido2'        => 'Text',
      'cedula'           => 'Text',
      'sexo'             => 'Text',
      'nacionalidad'     => 'Text',
      'fecha_nacimiento' => 'Date',
      'extension'        => 'Number',
      'fecha_ingreso'    => 'Date',
      'hora_entrada'     => 'Date',
      'hora_salida'      => 'Date',
    );
  }
}
