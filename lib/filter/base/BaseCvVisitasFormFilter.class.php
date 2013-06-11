<?php

/**
 * CvVisitas filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseCvVisitasFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_usuario'    => new sfWidgetFormPropelChoice(array('model' => 'CvUsuarios', 'add_empty' => true)),
      'fecha_entrada' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'hora_entrada'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fecha_salida'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'hora_salida'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'contacto'      => new sfWidgetFormFilterInput(),
      'observaciones' => new sfWidgetFormFilterInput(),
      'num_carnet'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_usuario'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'CvUsuarios', 'column' => 'id_usuario')),
      'fecha_entrada' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'hora_entrada'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'fecha_salida'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'hora_salida'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'contacto'      => new sfValidatorPass(array('required' => false)),
      'observaciones' => new sfValidatorPass(array('required' => false)),
      'num_carnet'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cv_visitas_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CvVisitas';
  }

  public function getFields()
  {
    return array(
      'id_usuario'    => 'ForeignKey',
      'fecha_entrada' => 'Date',
      'hora_entrada'  => 'Date',
      'fecha_salida'  => 'Date',
      'hora_salida'   => 'Date',
      'contacto'      => 'Text',
      'observaciones' => 'Text',
      'num_carnet'    => 'Text',
      'id_visita'     => 'Number',
    );
  }
}
