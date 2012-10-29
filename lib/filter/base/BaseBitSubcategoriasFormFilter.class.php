<?php

/**
 * BitSubcategorias filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseBitSubcategoriasFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_categoria'    => new sfWidgetFormPropelChoice(array('model' => 'BitCategorias', 'add_empty' => true)),
      'descripcion'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_categoria'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'BitCategorias', 'column' => 'id_categoria')),
      'descripcion'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bit_subcategorias_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BitSubcategorias';
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
