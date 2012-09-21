<?php

/**
 * EstSolicitudes filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseEstSolicitudesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_solicitante'  => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => true)),
      'hora_desde'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'hora_hasta'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'estudio'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha_solicitud' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_producto'     => new sfWidgetFormPropelChoice(array('model' => 'EstProductos', 'add_empty' => true)),
      'observaciones'   => new sfWidgetFormFilterInput(),
      'estatus'         => new sfWidgetFormFilterInput(),
      'dia_transmision' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_solicitante'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SfGuardUserProfile', 'column' => 'user_id')),
      'hora_desde'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'hora_hasta'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'estudio'         => new sfValidatorPass(array('required' => false)),
      'fecha_solicitud' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'id_producto'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'EstProductos', 'column' => 'id_producto')),
      'observaciones'   => new sfValidatorPass(array('required' => false)),
      'estatus'         => new sfValidatorPass(array('required' => false)),
      'dia_transmision' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('est_solicitudes_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EstSolicitudes';
  }

  public function getFields()
  {
    return array(
      'id_solicitud'    => 'Number',
      'id_solicitante'  => 'ForeignKey',
      'hora_desde'      => 'Date',
      'hora_hasta'      => 'Date',
      'estudio'         => 'Text',
      'fecha_solicitud' => 'Date',
      'id_producto'     => 'ForeignKey',
      'observaciones'   => 'Text',
      'estatus'         => 'Text',
      'dia_transmision' => 'Text',
    );
  }
}
