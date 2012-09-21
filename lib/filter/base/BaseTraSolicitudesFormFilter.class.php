<?php

/**
 * TraSolicitudes filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseTraSolicitudesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_solicitante'        => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => true)),
      'asistentes'            => new sfWidgetFormFilterInput(),
      'fecha_solicitud'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fecha_salida'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'hora_salida'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'direccion_traslado'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion_equipos'   => new sfWidgetFormFilterInput(),
      'datos_interes_razon'   => new sfWidgetFormFilterInput(),
      'tipo_transporte'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipo_solicitud'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'estatus'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'justificacion_rechazo' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_solicitante'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SfGuardUserProfile', 'column' => 'user_id')),
      'asistentes'            => new sfValidatorPass(array('required' => false)),
      'fecha_solicitud'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'fecha_salida'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'hora_salida'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'direccion_traslado'    => new sfValidatorPass(array('required' => false)),
      'descripcion_equipos'   => new sfValidatorPass(array('required' => false)),
      'datos_interes_razon'   => new sfValidatorPass(array('required' => false)),
      'tipo_transporte'       => new sfValidatorPass(array('required' => false)),
      'tipo_solicitud'        => new sfValidatorPass(array('required' => false)),
      'estatus'               => new sfValidatorPass(array('required' => false)),
      'justificacion_rechazo' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tra_solicitudes_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TraSolicitudes';
  }

  public function getFields()
  {
    return array(
      'id_solicitud'          => 'Number',
      'id_solicitante'        => 'ForeignKey',
      'asistentes'            => 'Text',
      'fecha_solicitud'       => 'Date',
      'fecha_salida'          => 'Date',
      'hora_salida'           => 'Date',
      'direccion_traslado'    => 'Text',
      'descripcion_equipos'   => 'Text',
      'datos_interes_razon'   => 'Text',
      'tipo_transporte'       => 'Text',
      'tipo_solicitud'        => 'Text',
      'estatus'               => 'Text',
      'justificacion_rechazo' => 'Text',
    );
  }
}
