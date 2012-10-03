<?php

/**
 * EstSolicitudes form base class.
 *
 * @method EstSolicitudes getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseEstSolicitudesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_solicitud'    => new sfWidgetFormInputHidden(),
      'id_solicitante'  => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => false)),
      'hora_desde'      => new sfWidgetFormTime(),
      'hora_hasta'      => new sfWidgetFormTime(),
      'estudio'         => new sfWidgetFormInputText(),
      'fecha_solicitud' => new sfWidgetFormDate(),
      'id_producto'     => new sfWidgetFormPropelChoice(array('model' => 'EstProductos', 'add_empty' => true)),
      'observaciones'   => new sfWidgetFormInputText(),
      'estatus'         => new sfWidgetFormInputText(),
      'dia_transmision' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_solicitud'    => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdSolicitud()), 'empty_value' => $this->getObject()->getIdSolicitud(), 'required' => false)),
      'id_solicitante'  => new sfValidatorPropelChoice(array('model' => 'SfGuardUserProfile', 'column' => 'user_id')),
      'hora_desde'      => new sfValidatorTime(),
      'hora_hasta'      => new sfValidatorTime(),
      'estudio'         => new sfValidatorString(array('max_length' => 5)),
      'fecha_solicitud' => new sfValidatorDate(array('required' => false)),
      'id_producto'     => new sfValidatorPropelChoice(array('model' => 'EstProductos', 'column' => 'id_producto', 'required' => false)),
      'observaciones'   => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'estatus'         => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'dia_transmision' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('est_solicitudes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EstSolicitudes';
  }


}
