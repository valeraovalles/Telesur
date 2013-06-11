<?php

/**
 * CvVisitas form base class.
 *
 * @method CvVisitas getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseCvVisitasForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_usuario'    => new sfWidgetFormPropelChoice(array('model' => 'CvUsuarios', 'add_empty' => false)),
      'fecha_entrada' => new sfWidgetFormDate(),
      'hora_entrada'  => new sfWidgetFormTime(),
      'fecha_salida'  => new sfWidgetFormDate(),
      'hora_salida'   => new sfWidgetFormTime(),
      'contacto'      => new sfWidgetFormInputText(),
      'observaciones' => new sfWidgetFormInputText(),
      'num_carnet'    => new sfWidgetFormInputText(),
      'id_visita'     => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id_usuario'    => new sfValidatorPropelChoice(array('model' => 'CvUsuarios', 'column' => 'id_usuario')),
      'fecha_entrada' => new sfValidatorDate(),
      'hora_entrada'  => new sfValidatorTime(),
      'fecha_salida'  => new sfValidatorDate(array('required' => false)),
      'hora_salida'   => new sfValidatorTime(array('required' => false)),
      'contacto'      => new sfValidatorString(array('max_length' => 80, 'required' => false)),
      'observaciones' => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'num_carnet'    => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'id_visita'     => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdVisita()), 'empty_value' => $this->getObject()->getIdVisita(), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cv_visitas[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CvVisitas';
  }


}
