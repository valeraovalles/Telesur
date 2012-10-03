<?php

/**
 * MmEquipoTransmision filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseMmEquipoTransmisionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'descripcion_equipos_transmision' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'descripcion_equipos_transmision' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mm_equipo_transmision_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MmEquipoTransmision';
  }

  public function getFields()
  {
    return array(
      'id_equipo_transmision'           => 'Number',
      'descripcion_equipos_transmision' => 'Text',
    );
  }
}
