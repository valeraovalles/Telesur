<?php

/**
 * CpControldepersonal filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseCpControldepersonalFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_usuario'          => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => true)),
      'fecha_entrada'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'hora_entrada'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'observacion_entrada' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha_salida'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'hora_salida'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'observacion_salida'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_entrada'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ip_salida'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_usuario'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SfGuardUserProfile', 'column' => 'user_id')),
      'fecha_entrada'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'hora_entrada'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'observacion_entrada' => new sfValidatorPass(array('required' => false)),
      'fecha_salida'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'hora_salida'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'observacion_salida'  => new sfValidatorPass(array('required' => false)),
      'ip_entrada'          => new sfValidatorPass(array('required' => false)),
      'ip_salida'           => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cp_controldepersonal_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CpControldepersonal';
  }

  public function getFields()
  {
    return array(
      'id_control'          => 'Number',
      'id_usuario'          => 'ForeignKey',
      'fecha_entrada'       => 'Date',
      'hora_entrada'        => 'Date',
      'observacion_entrada' => 'Text',
      'fecha_salida'        => 'Date',
      'hora_salida'         => 'Date',
      'observacion_salida'  => 'Text',
      'ip_entrada'          => 'Text',
      'ip_salida'           => 'Text',
    );
  }
}
