<?php

/**
 * SitUnidades form base class.
 *
 * @method SitUnidades getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseSitUnidadesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_unidad'   => new sfWidgetFormInputHidden(),
      'descripcion' => new sfWidgetFormInputText(),
      'correo'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_unidad'   => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdUnidad()), 'empty_value' => $this->getObject()->getIdUnidad(), 'required' => false)),
      'descripcion' => new sfValidatorString(array('max_length' => 100)),
      'correo'      => new sfValidatorString(array('max_length' => 50)),
    ));

    $this->widgetSchema->setNameFormat('sit_unidades[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SitUnidades';
  }


}
