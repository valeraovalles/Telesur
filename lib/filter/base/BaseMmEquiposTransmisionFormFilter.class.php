<?php

/**
 * MmEquiposTransmision filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseMmEquiposTransmisionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'descripcion_equipo_transmision' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'descripcion_equipo_transmision' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mm_equipos_transmision_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MmEquiposTransmision';
  }

  public function getFields()
  {
    return array(
      'id_equipo_transmision'          => 'Number',
      'descripcion_equipo_transmision' => 'Text',
    );
  }
}
