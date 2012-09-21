<?php

/**
 * TsurDirecciones filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseTsurDireccionesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'descripcion'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_vcepresidencia' => new sfWidgetFormPropelChoice(array('model' => 'TsurVicepresidencias', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'descripcion'       => new sfValidatorPass(array('required' => false)),
      'id_vcepresidencia' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'TsurVicepresidencias', 'column' => 'id_vcepresidencia')),
    ));

    $this->widgetSchema->setNameFormat('tsur_direcciones_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TsurDirecciones';
  }

  public function getFields()
  {
    return array(
      'id_direccion'      => 'Number',
      'descripcion'       => 'Text',
      'id_vcepresidencia' => 'ForeignKey',
    );
  }
}
