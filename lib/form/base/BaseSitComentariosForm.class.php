<?php

/**
 * SitComentarios form base class.
 *
 * @method SitComentarios getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseSitComentariosForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_comentario' => new sfWidgetFormInputHidden(),
      'id_usuario'    => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => false)),
      'id_ticket'     => new sfWidgetFormPropelChoice(array('model' => 'SitTickets', 'add_empty' => false)),
      'comentario'    => new sfWidgetFormInputText(),
      'fecha'         => new sfWidgetFormDate(),
      'hora'          => new sfWidgetFormTime(),
    ));

    $this->setValidators(array(
      'id_comentario' => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdComentario()), 'empty_value' => $this->getObject()->getIdComentario(), 'required' => false)),
      'id_usuario'    => new sfValidatorPropelChoice(array('model' => 'SfGuardUserProfile', 'column' => 'user_id')),
      'id_ticket'     => new sfValidatorPropelChoice(array('model' => 'SitTickets', 'column' => 'id_ticket')),
      'comentario'    => new sfValidatorString(array('max_length' => 500)),
      'fecha'         => new sfValidatorDate(),
      'hora'          => new sfValidatorTime(),
    ));

    $this->widgetSchema->setNameFormat('sit_comentarios[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SitComentarios';
  }


}
