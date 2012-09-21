<?php

/**
 * EstProductos form base class.
 *
 * @method EstProductos getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseEstProductosForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_producto' => new sfWidgetFormInputHidden(),
      'descripcion' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_producto' => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdProducto()), 'empty_value' => $this->getObject()->getIdProducto(), 'required' => false)),
      'descripcion' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('est_productos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EstProductos';
  }


}
