<?php

/**
 * BitCategoriasUnidades filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseBitCategoriasUnidadesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_unidad'    => new sfWidgetFormPropelChoice(array('model' => 'SitUnidades', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_unidad'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SitUnidades', 'column' => 'id_unidad')),
    ));

    $this->widgetSchema->setNameFormat('bit_categorias_unidades_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BitCategoriasUnidades';
  }

  public function getFields()
  {
    return array(
      'id_unidad'    => 'ForeignKey',
      'id_categoria' => 'ForeignKey',
    );
  }
}
