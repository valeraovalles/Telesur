<?php

/**
 * BitCategoriasUnidades form base class.
 *
 * @method BitCategoriasUnidades getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseBitCategoriasUnidadesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_unidad'    => new sfWidgetFormPropelChoice(array('model' => 'SitUnidades', 'add_empty' => true)),
      'id_categoria' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id_unidad'    => new sfValidatorPropelChoice(array('model' => 'SitUnidades', 'column' => 'id_unidad', 'required' => false)),
      'id_categoria' => new sfValidatorPropelChoice(array('model' => 'BitCategorias', 'column' => 'id_categoria', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bit_categorias_unidades[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BitCategoriasUnidades';
  }


}
