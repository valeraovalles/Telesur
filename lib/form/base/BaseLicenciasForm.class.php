<?php

/**
 * Licencias form base class.
 *
 * @method Licencias getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseLicenciasForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_licencia'       => new sfWidgetFormInputHidden(),
      'id_responsable'    => new sfWidgetFormInputText(),
      'nombre_licencia'   => new sfWidgetFormInputText(),
      'numero'            => new sfWidgetFormInputText(),
      'fecha_compra'      => new sfWidgetFormDate(),
      'fecha_vencimiento' => new sfWidgetFormDate(),
      'descripcion'       => new sfWidgetFormInputText(),
      'bandera_correo'    => new sfWidgetFormInputText(),
      'tipo'              => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_licencia'       => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdLicencia()), 'empty_value' => $this->getObject()->getIdLicencia(), 'required' => false)),
      'id_responsable'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'nombre_licencia'   => new sfValidatorString(array('max_length' => 500)),
      'numero'            => new sfValidatorString(array('max_length' => 20)),
      'fecha_compra'      => new sfValidatorDate(),
      'fecha_vencimiento' => new sfValidatorDate(),
      'descripcion'       => new sfValidatorString(array('max_length' => 100)),
      'bandera_correo'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'tipo'              => new sfValidatorString(array('max_length' => 1)),
    ));

    $this->widgetSchema->setNameFormat('licencias[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Licencias';
  }


}
