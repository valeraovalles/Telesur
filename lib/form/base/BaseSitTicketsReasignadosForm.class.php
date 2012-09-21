<?php

/**
 * SitTicketsReasignados form base class.
 *
 * @method SitTicketsReasignados getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseSitTicketsReasignadosForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_ticket' => new sfWidgetFormInputHidden(),
      'user_id'   => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id_ticket' => new sfValidatorPropelChoice(array('model' => 'SitTickets', 'column' => 'id_ticket', 'required' => false)),
      'user_id'   => new sfValidatorPropelChoice(array('model' => 'SfGuardUserProfile', 'column' => 'user_id')),
    ));

    $this->widgetSchema->setNameFormat('sit_tickets_reasignados[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SitTicketsReasignados';
  }


}
