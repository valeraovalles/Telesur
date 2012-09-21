<?php

/**
 * SitUsuarioTicket filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseSitUsuarioTicketFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('sit_usuario_ticket_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SitUsuarioTicket';
  }

  public function getFields()
  {
    return array(
      'id_ticket'  => 'Number',
      'id_usuario' => 'Number',
    );
  }
}
