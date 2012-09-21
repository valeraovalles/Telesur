<?php

/**
 * SitTicketsUsuarios filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseSitTicketsUsuariosFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_usuario' => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_usuario' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SfGuardUserProfile', 'column' => 'user_id')),
    ));

    $this->widgetSchema->setNameFormat('sit_tickets_usuarios_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SitTicketsUsuarios';
  }

  public function getFields()
  {
    return array(
      'id_ticket'  => 'ForeignKey',
      'id_usuario' => 'ForeignKey',
    );
  }
}
