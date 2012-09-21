<?php

/**
 * TsurUnidades form base class.
 *
 * @method TsurUnidades getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTsurUnidadesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_unidad'    => new sfWidgetFormInputHidden(),
      'descripcion'  => new sfWidgetFormInputText(),
      'id_direccion' => new sfWidgetFormPropelChoice(array('model' => 'TsurDirecciones', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id_unidad'    => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdUnidad()), 'empty_value' => $this->getObject()->getIdUnidad(), 'required' => false)),
      'descripcion'  => new sfValidatorString(array('max_length' => 100)),
      'id_direccion' => new sfValidatorPropelChoice(array('model' => 'TsurDirecciones', 'column' => 'id_direccion')),
    ));

    $this->widgetSchema->setNameFormat('tsur_unidades[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TsurUnidades';
  }


}
