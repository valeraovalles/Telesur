<?php

/**
 * CvUsuarios filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseCvUsuariosFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'     => new sfWidgetFormFilterInput(),
      'apellido'   => new sfWidgetFormFilterInput(),
      'cedula'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nombre'     => new sfValidatorPass(array('required' => false)),
      'apellido'   => new sfValidatorPass(array('required' => false)),
      'cedula'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cv_usuarios_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CvUsuarios';
  }

  public function getFields()
  {
    return array(
      'id_usuario' => 'Number',
      'nombre'     => 'Text',
      'apellido'   => 'Text',
      'cedula'     => 'Text',
    );
  }
}
