<?php

/**
 * SitTicketsUsuarios form base class.
 *
 * @method SitTicketsUsuarios getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseSitTicketsUsuariosForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_ticket'  => new sfWidgetFormInputHidden(),
      'id_usuario' => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id_ticket'  => new sfValidatorPropelChoice(array('model' => 'SitTickets', 'column' => 'id_ticket', 'required' => false)),
      'id_usuario' => new sfValidatorPropelChoice(array('model' => 'SfGuardUserProfile', 'column' => 'user_id')),
    ));

    $this->widgetSchema->setNameFormat('sit_tickets_usuarios[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SitTicketsUsuarios';
  }


}
