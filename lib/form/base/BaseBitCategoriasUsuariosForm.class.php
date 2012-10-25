<?php

/**
 * BitCategoriasUsuarios form base class.
 *
 * @method BitCategoriasUsuarios getObject() Returns the current form's model object
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseBitCategoriasUsuariosForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_usuario'   => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => true)),
      'id_categoria' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id_usuario'   => new sfValidatorPropelChoice(array('model' => 'SfGuardUserProfile', 'column' => 'user_id', 'required' => false)),
      'id_categoria' => new sfValidatorPropelChoice(array('model' => 'BitCategorias', 'column' => 'id_categoria', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bit_categorias_usuarios[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BitCategoriasUsuarios';
  }


}
