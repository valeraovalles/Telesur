<?php

/**
 * MmUbicaciones filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseMmUbicacionesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_pais'       => new sfWidgetFormPropelChoice(array('model' => 'MmPaises', 'add_empty' => true)),
      'id_producto'   => new sfWidgetFormFilterInput(),
      'descripcion'   => new sfWidgetFormFilterInput(),
      'tipo_producto' => new sfWidgetFormFilterInput(),
      'cantidad'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_pais'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'MmPaises', 'column' => 'id_pais')),
      'id_producto'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'descripcion'   => new sfValidatorPass(array('required' => false)),
      'tipo_producto' => new sfValidatorPass(array('required' => false)),
      'cantidad'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('mm_ubicaciones_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MmUbicaciones';
  }

  public function getFields()
  {
    return array(
      'id_ubicacion'  => 'Number',
      'id_pais'       => 'ForeignKey',
      'id_producto'   => 'Number',
      'descripcion'   => 'Text',
      'tipo_producto' => 'Text',
      'cantidad'      => 'Number',
    );
  }
}
