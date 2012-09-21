<?php

/**
 * MmPaises filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseMmPaisesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'pais'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'pais'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mm_paises_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MmPaises';
  }

  public function getFields()
  {
    return array(
      'id_pais' => 'Number',
      'pais'    => 'Text',
    );
  }
}
