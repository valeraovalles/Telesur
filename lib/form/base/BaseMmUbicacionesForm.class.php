<?php

/**
 * MmUbicaciones form base class.
 *
 * @method MmUbicaciones getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseMmUbicacionesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_ubicacion'  => new sfWidgetFormInputHidden(),
      'id_pais'       => new sfWidgetFormPropelChoice(array('model' => 'MmPaises', 'add_empty' => true)),
      'id_producto'   => new sfWidgetFormInputText(),
      'descripcion'   => new sfWidgetFormInputText(),
      'tipo_producto' => new sfWidgetFormInputText(),
      'cantidad'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_ubicacion'  => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdUbicacion()), 'empty_value' => $this->getObject()->getIdUbicacion(), 'required' => false)),
      'id_pais'       => new sfValidatorPropelChoice(array('model' => 'MmPaises', 'column' => 'id_pais', 'required' => false)),
      'id_producto'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'descripcion'   => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'tipo_producto' => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'cantidad'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mm_ubicaciones[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MmUbicaciones';
  }


}
