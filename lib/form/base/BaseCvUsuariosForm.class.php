<?php

/**
 * CvUsuarios form base class.
 *
 * @method CvUsuarios getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseCvUsuariosForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_usuario' => new sfWidgetFormInputHidden(),
      'nombre'     => new sfWidgetFormInputText(),
      'apellido'   => new sfWidgetFormInputText(),
      'cedula'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_usuario' => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdUsuario()), 'empty_value' => $this->getObject()->getIdUsuario(), 'required' => false)),
      'nombre'     => new sfValidatorString(array('max_length' => 35, 'required' => false)),
      'apellido'   => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'cedula'     => new sfValidatorString(array('max_length' => 15, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cv_usuarios[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CvUsuarios';
  }


}
