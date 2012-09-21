<?php

/**
 * TsurUnidades filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseTsurUnidadesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'descripcion'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_direccion' => new sfWidgetFormPropelChoice(array('model' => 'TsurDirecciones', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'descripcion'  => new sfValidatorPass(array('required' => false)),
      'id_direccion' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'TsurDirecciones', 'column' => 'id_direccion')),
    ));

    $this->widgetSchema->setNameFormat('tsur_unidades_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TsurUnidades';
  }

  public function getFields()
  {
    return array(
      'id_unidad'    => 'Number',
      'descripcion'  => 'Text',
      'id_direccion' => 'ForeignKey',
    );
  }
}
