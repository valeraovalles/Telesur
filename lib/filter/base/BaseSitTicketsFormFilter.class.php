<?php

/**
 * SitTickets filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseSitTicketsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_unidad'       => new sfWidgetFormPropelChoice(array('model' => 'SitUnidades', 'add_empty' => true)),
      'id_solicitante'  => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => true)),
      'id_categoria'    => new sfWidgetFormPropelChoice(array('model' => 'SitCategorias', 'add_empty' => true)),
      'id_subcategoria' => new sfWidgetFormPropelChoice(array('model' => 'SitSubcategorias', 'add_empty' => true)),
      'fecha_solicitud' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'hora_solicitud'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fecha_solucion'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'hora_solucion'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'solicitud'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'solucion'        => new sfWidgetFormFilterInput(),
      'reasignado'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'estatus'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'archivos'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_unidad'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SitUnidades', 'column' => 'id_unidad')),
      'id_solicitante'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SfGuardUserProfile', 'column' => 'user_id')),
      'id_categoria'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SitCategorias', 'column' => 'id_categoria')),
      'id_subcategoria' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SitSubcategorias', 'column' => 'id_subcategoria')),
      'fecha_solicitud' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'hora_solicitud'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'fecha_solucion'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'hora_solucion'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'solicitud'       => new sfValidatorPass(array('required' => false)),
      'solucion'        => new sfValidatorPass(array('required' => false)),
      'reasignado'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'estatus'         => new sfValidatorPass(array('required' => false)),
      'archivos'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sit_tickets_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SitTickets';
  }

  public function getFields()
  {
    return array(
      'id_ticket'       => 'Number',
      'id_unidad'       => 'ForeignKey',
      'id_solicitante'  => 'ForeignKey',
      'id_categoria'    => 'ForeignKey',
      'id_subcategoria' => 'ForeignKey',
      'fecha_solicitud' => 'Date',
      'hora_solicitud'  => 'Date',
      'fecha_solucion'  => 'Date',
      'hora_solucion'   => 'Date',
      'solicitud'       => 'Text',
      'solucion'        => 'Text',
      'reasignado'      => 'Boolean',
      'estatus'         => 'Text',
      'archivos'        => 'Text',
    );
  }
}
