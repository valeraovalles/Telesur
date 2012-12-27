<?php

/**
 * BitBitacora form base class.
 *
 * @method BitBitacora getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseBitBitacoraForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_bitacora'     => new sfWidgetFormInputHidden(),
      'fecha'           => new sfWidgetFormDate(),
      'hora'            => new sfWidgetFormTime(),
      'descripcion'     => new sfWidgetFormInputText(),
      'id_subcategoria' => new sfWidgetFormPropelChoice(array('model' => 'BitSubcategorias', 'add_empty' => true)),
      'id_usuario'      => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => true)),
      'id_unidad'       => new sfWidgetFormInputText(),
      'id_categoria'    => new sfWidgetFormPropelChoice(array('model' => 'BitCategorias', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_bitacora'     => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdBitacora()), 'empty_value' => $this->getObject()->getIdBitacora(), 'required' => false)),
      'fecha'           => new sfValidatorDate(array('required' => false)),
      'hora'            => new sfValidatorTime(array('required' => false)),
      'descripcion'     => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'id_subcategoria' => new sfValidatorPropelChoice(array('model' => 'BitSubcategorias', 'column' => 'id_subcategoria', 'required' => false)),
      'id_usuario'      => new sfValidatorPropelChoice(array('model' => 'SfGuardUserProfile', 'column' => 'user_id', 'required' => false)),
      'id_unidad'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'id_categoria'    => new sfValidatorPropelChoice(array('model' => 'BitCategorias', 'column' => 'id_categoria', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bit_bitacora[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BitBitacora';
  }


}
