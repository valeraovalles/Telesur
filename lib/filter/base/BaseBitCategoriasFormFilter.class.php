<?php

/**
 * BitCategorias filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseBitCategoriasFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'descripcion'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'descripcion'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bit_categorias_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BitCategorias';
  }

  public function getFields()
  {
    return array(
      'id_categoria' => 'Number',
      'descripcion'  => 'Text',
    );
  }
}
