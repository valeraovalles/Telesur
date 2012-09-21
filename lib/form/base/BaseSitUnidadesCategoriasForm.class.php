<?php

/**
 * SitUnidadesCategorias form base class.
 *
 * @method SitUnidadesCategorias getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseSitUnidadesCategoriasForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_categoria' => new sfWidgetFormInputHidden(),
      'id_unidad'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_categoria' => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdCategoria()), 'empty_value' => $this->getObject()->getIdCategoria(), 'required' => false)),
      'id_unidad'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
    ));

    $this->widgetSchema->setNameFormat('sit_unidades_categorias[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SitUnidadesCategorias';
  }


}
