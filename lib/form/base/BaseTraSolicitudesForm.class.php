<?php

/**
 * TraSolicitudes form base class.
 *
 * @method TraSolicitudes getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTraSolicitudesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_solicitud'          => new sfWidgetFormInputHidden(),
      'id_solicitante'        => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => false)),
      'asistentes'            => new sfWidgetFormInputText(),
      'fecha_solicitud'       => new sfWidgetFormDate(),
      'fecha_salida'          => new sfWidgetFormDate(),
      'hora_salida'           => new sfWidgetFormTime(),
      'direccion_traslado'    => new sfWidgetFormInputText(),
      'descripcion_equipos'   => new sfWidgetFormInputText(),
      'datos_interes_razon'   => new sfWidgetFormInputText(),
      'tipo_transporte'       => new sfWidgetFormInputText(),
      'tipo_solicitud'        => new sfWidgetFormInputText(),
      'estatus'               => new sfWidgetFormInputText(),
      'justificacion_rechazo' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_solicitud'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdSolicitud()), 'empty_value' => $this->getObject()->getIdSolicitud(), 'required' => false)),
      'id_solicitante'        => new sfValidatorPropelChoice(array('model' => 'SfGuardUserProfile', 'column' => 'user_id')),
      'asistentes'            => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'fecha_solicitud'       => new sfValidatorDate(array('required' => false)),
      'fecha_salida'          => new sfValidatorDate(array('required' => false)),
      'hora_salida'           => new sfValidatorTime(array('required' => false)),
      'direccion_traslado'    => new sfValidatorString(array('max_length' => 500)),
      'descripcion_equipos'   => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'datos_interes_razon'   => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'tipo_transporte'       => new sfValidatorString(array('max_length' => 1)),
      'tipo_solicitud'        => new sfValidatorString(array('max_length' => 1)),
      'estatus'               => new sfValidatorString(array('max_length' => 2)),
      'justificacion_rechazo' => new sfValidatorString(array('max_length' => 500, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tra_solicitudes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TraSolicitudes';
  }


}
