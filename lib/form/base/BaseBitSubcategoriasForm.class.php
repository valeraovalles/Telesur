<?php

/**
 * BitSubcategorias form base class.
 *
 * @method BitSubcategorias getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseBitSubcategoriasForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_subcategoria' => new sfWidgetFormInputHidden(),
      'id_categoria'    => new sfWidgetFormPropelChoice(array('model' => 'BitCategorias', 'add_empty' => true)),
      'descripcion'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_subcategoria' => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdSubcategoria()), 'empty_value' => $this->getObject()->getIdSubcategoria(), 'required' => false)),
      'id_categoria'    => new sfValidatorPropelChoice(array('model' => 'BitCategorias', 'column' => 'id_categoria', 'required' => false)),
      'descripcion'     => new sfValidatorString(array('max_length' => 50)),
    ));

    $this->widgetSchema->setNameFormat('bit_subcategorias[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BitSubcategorias';
  }


}
