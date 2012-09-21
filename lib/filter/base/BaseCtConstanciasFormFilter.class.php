<?php

/**
 * CtConstancias filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseCtConstanciasFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_solicitante'    => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => true)),
      'fecha_solicitud'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'tipo_constancia'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'bono_alimentacion' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'motivo'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dirigido_a'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'estatus'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_solicitante'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SfGuardUserProfile', 'column' => 'user_id')),
      'fecha_solicitud'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'tipo_constancia'   => new sfValidatorPass(array('required' => false)),
      'bono_alimentacion' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'motivo'            => new sfValidatorPass(array('required' => false)),
      'dirigido_a'        => new sfValidatorPass(array('required' => false)),
      'estatus'           => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ct_constancias_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CtConstancias';
  }

  public function getFields()
  {
    return array(
      'id_constancia'     => 'Number',
      'id_solicitante'    => 'ForeignKey',
      'fecha_solicitud'   => 'Date',
      'tipo_constancia'   => 'Text',
      'bono_alimentacion' => 'Boolean',
      'motivo'            => 'Text',
      'dirigido_a'        => 'Text',
      'estatus'           => 'Text',
    );
  }
}
