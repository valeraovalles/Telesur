<?php

/**
 * SitComentarios filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseSitComentariosFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_usuario'    => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => true)),
      'id_ticket'     => new sfWidgetFormPropelChoice(array('model' => 'SitTickets', 'add_empty' => true)),
      'comentario'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'hora'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_usuario'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SfGuardUserProfile', 'column' => 'user_id')),
      'id_ticket'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SitTickets', 'column' => 'id_ticket')),
      'comentario'    => new sfValidatorPass(array('required' => false)),
      'fecha'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'hora'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('sit_comentarios_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SitComentarios';
  }

  public function getFields()
  {
    return array(
      'id_comentario' => 'Number',
      'id_usuario'    => 'ForeignKey',
      'id_ticket'     => 'ForeignKey',
      'comentario'    => 'Text',
      'fecha'         => 'Date',
      'hora'          => 'Date',
    );
  }
}
