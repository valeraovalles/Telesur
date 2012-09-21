<?php

/**
 * SitUsuariosTickets filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseSitUsuariosTicketsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('sit_usuarios_tickets_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SitUsuariosTickets';
  }

  public function getFields()
  {
    return array(
      'id_ticket'  => 'Number',
      'id_usuario' => 'Number',
    );
  }
}
