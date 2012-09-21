<?php

/**
 * SitSubcategorias filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseSitSubcategoriasFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_categoria'    => new sfWidgetFormPropelChoice(array('model' => 'SitCategorias', 'add_empty' => true)),
      'descripcion'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_categoria'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SitCategorias', 'column' => 'id_categoria')),
      'descripcion'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sit_subcategorias_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SitSubcategorias';
  }

  public function getFields()
  {
    return array(
      'id_subcategoria' => 'Number',
      'id_categoria'    => 'ForeignKey',
      'descripcion'     => 'Text',
    );
  }
}
