<?php

/**
 * SitCategorias form base class.
 *
 * @method SitCategorias getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseSitCategoriasForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_categoria' => new sfWidgetFormInputHidden(),
      'descripcion'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_categoria' => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdCategoria()), 'empty_value' => $this->getObject()->getIdCategoria(), 'required' => false)),
      'descripcion'  => new sfValidatorString(array('max_length' => 100)),
    ));

    $this->widgetSchema->setNameFormat('sit_categorias[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SitCategorias';
  }


}
