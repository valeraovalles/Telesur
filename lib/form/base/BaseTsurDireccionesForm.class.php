<?php

/**
 * TsurDirecciones form base class.
 *
 * @method TsurDirecciones getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTsurDireccionesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_direccion'      => new sfWidgetFormInputHidden(),
      'descripcion'       => new sfWidgetFormInputText(),
      'id_vcepresidencia' => new sfWidgetFormPropelChoice(array('model' => 'TsurVicepresidencias', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_direccion'      => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdDireccion()), 'empty_value' => $this->getObject()->getIdDireccion(), 'required' => false)),
      'descripcion'       => new sfValidatorString(array('max_length' => 100)),
      'id_vcepresidencia' => new sfValidatorPropelChoice(array('model' => 'TsurVicepresidencias', 'column' => 'id_vcepresidencia', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tsur_direcciones[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TsurDirecciones';
  }


}
