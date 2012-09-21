<?php

/**
 * SitTickets form base class.
 *
 * @method SitTickets getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseSitTicketsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_ticket'       => new sfWidgetFormInputHidden(),
      'id_unidad'       => new sfWidgetFormPropelChoice(array('model' => 'SitUnidades', 'add_empty' => false)),
      'id_solicitante'  => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => false)),
      'id_categoria'    => new sfWidgetFormPropelChoice(array('model' => 'SitCategorias', 'add_empty' => true)),
      'id_subcategoria' => new sfWidgetFormPropelChoice(array('model' => 'SitSubcategorias', 'add_empty' => true)),
      'fecha_solicitud' => new sfWidgetFormDate(),
      'hora_solicitud'  => new sfWidgetFormTime(),
      'fecha_solucion'  => new sfWidgetFormDate(),
      'hora_solucion'   => new sfWidgetFormTime(),
      'solicitud'       => new sfWidgetFormInputText(),
      'solucion'        => new sfWidgetFormInputText(),
      'reasignado'      => new sfWidgetFormInputCheckbox(),
      'estatus'         => new sfWidgetFormInputText(),
      'archivos'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_ticket'       => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdTicket()), 'empty_value' => $this->getObject()->getIdTicket(), 'required' => false)),
      'id_unidad'       => new sfValidatorPropelChoice(array('model' => 'SitUnidades', 'column' => 'id_unidad')),
      'id_solicitante'  => new sfValidatorPropelChoice(array('model' => 'SfGuardUserProfile', 'column' => 'user_id')),
      'id_categoria'    => new sfValidatorPropelChoice(array('model' => 'SitCategorias', 'column' => 'id_categoria', 'required' => false)),
      'id_subcategoria' => new sfValidatorPropelChoice(array('model' => 'SitSubcategorias', 'column' => 'id_subcategoria', 'required' => false)),
      'fecha_solicitud' => new sfValidatorDate(),
      'hora_solicitud'  => new sfValidatorTime(),
      'fecha_solucion'  => new sfValidatorDate(array('required' => false)),
      'hora_solucion'   => new sfValidatorTime(array('required' => false)),
      'solicitud'       => new sfValidatorString(array('max_length' => 1000)),
      'solucion'        => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'reasignado'      => new sfValidatorBoolean(),
      'estatus'         => new sfValidatorString(array('max_length' => 2)),
      'archivos'        => new sfValidatorString(array('max_length' => 500, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sit_tickets[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SitTickets';
  }


}
