<?php

/**
 * BitCategoriasUsuarios filter form base class.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseBitCategoriasUsuariosFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_usuario'   => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_usuario'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SfGuardUserProfile', 'column' => 'user_id')),
    ));

    $this->widgetSchema->setNameFormat('bit_categorias_usuarios_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BitCategoriasUsuarios';
  }

  public function getFields()
  {
    return array(
      'id_usuario'   => 'ForeignKey',
      'id_categoria' => 'ForeignKey',
    );
  }
}
