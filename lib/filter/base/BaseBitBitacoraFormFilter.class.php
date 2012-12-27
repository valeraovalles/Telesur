<?php

/**
 * BitBitacora filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseBitBitacoraFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'fecha'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'hora'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'descripcion'     => new sfWidgetFormFilterInput(),
      'id_subcategoria' => new sfWidgetFormPropelChoice(array('model' => 'BitSubcategorias', 'add_empty' => true)),
      'id_usuario'      => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => true)),
      'id_unidad'       => new sfWidgetFormFilterInput(),
      'id_categoria'    => new sfWidgetFormPropelChoice(array('model' => 'BitCategorias', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'fecha'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'hora'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'descripcion'     => new sfValidatorPass(array('required' => false)),
      'id_subcategoria' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'BitSubcategorias', 'column' => 'id_subcategoria')),
      'id_usuario'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SfGuardUserProfile', 'column' => 'user_id')),
      'id_unidad'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_categoria'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'BitCategorias', 'column' => 'id_categoria')),
    ));

    $this->widgetSchema->setNameFormat('bit_bitacora_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BitBitacora';
  }

  public function getFields()
  {
    return array(
      'id_bitacora'     => 'Number',
      'fecha'           => 'Date',
      'hora'            => 'Date',
      'descripcion'     => 'Text',
      'id_subcategoria' => 'ForeignKey',
      'id_usuario'      => 'ForeignKey',
      'id_unidad'       => 'Number',
      'id_categoria'    => 'ForeignKey',
    );
  }
}
