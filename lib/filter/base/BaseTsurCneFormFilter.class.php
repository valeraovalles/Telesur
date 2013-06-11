<?php

/**
 * TsurCne filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseTsurCneFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'nacionalidad'     => new sfWidgetFormFilterInput(),
      'cedula'           => new sfWidgetFormFilterInput(),
      'primer_apellido'  => new sfWidgetFormFilterInput(),
      'segundo_apellido' => new sfWidgetFormFilterInput(),
      'primer_nombre'    => new sfWidgetFormFilterInput(),
      'segundo_nombre'   => new sfWidgetFormFilterInput(),
      'cod'              => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nacionalidad'     => new sfValidatorPass(array('required' => false)),
      'cedula'           => new sfValidatorPass(array('required' => false)),
      'primer_apellido'  => new sfValidatorPass(array('required' => false)),
      'segundo_apellido' => new sfValidatorPass(array('required' => false)),
      'primer_nombre'    => new sfValidatorPass(array('required' => false)),
      'segundo_nombre'   => new sfValidatorPass(array('required' => false)),
      'cod'              => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tsur_cne_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TsurCne';
  }

  public function getFields()
  {
    return array(
      'nacionalidad'     => 'Text',
      'cedula'           => 'Text',
      'primer_apellido'  => 'Text',
      'segundo_apellido' => 'Text',
      'primer_nombre'    => 'Text',
      'segundo_nombre'   => 'Text',
      'cod'              => 'Text',
      'id'               => 'Number',
    );
  }
}
