<?php

/**
 * Licencias filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseLicenciasFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_responsable'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombre_licencia'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'numero'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha_compra'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fecha_vencimiento' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'descripcion'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'bandera_correo'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipo'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_responsable'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nombre_licencia'   => new sfValidatorPass(array('required' => false)),
      'numero'            => new sfValidatorPass(array('required' => false)),
      'fecha_compra'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'fecha_vencimiento' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'descripcion'       => new sfValidatorPass(array('required' => false)),
      'bandera_correo'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tipo'              => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('licencias_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Licencias';
  }

  public function getFields()
  {
    return array(
      'id_licencia'       => 'Number',
      'id_responsable'    => 'Number',
      'nombre_licencia'   => 'Text',
      'numero'            => 'Text',
      'fecha_compra'      => 'Date',
      'fecha_vencimiento' => 'Date',
      'descripcion'       => 'Text',
      'bandera_correo'    => 'Number',
      'tipo'              => 'Text',
    );
  }
}
