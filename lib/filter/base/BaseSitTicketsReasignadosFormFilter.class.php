<?php

/**
 * SitTicketsReasignados filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseSitTicketsReasignadosFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'   => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'user_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SfGuardUserProfile', 'column' => 'user_id')),
    ));

    $this->widgetSchema->setNameFormat('sit_tickets_reasignados_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SitTicketsReasignados';
  }

  public function getFields()
  {
    return array(
      'id_ticket' => 'ForeignKey',
      'user_id'   => 'ForeignKey',
    );
  }
}
