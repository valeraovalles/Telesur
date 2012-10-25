<?php

/**
 * BitBitacora filter form.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
class BitBitacoraFormFilter extends BaseBitBitacoraFormFilter
{
    
  protected $datos = null;
  
  public function setDatos($c)
  {
	  	$this->datos = $c;
	   	$this->configure();
  }
  
  public function configure()
  {
    $this->setWidgets(array(
      'fecha'           => new sfWidgetFormInputText(array(),array('class'=>'tcal')),
      'hora'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'descripcion'     => new sfWidgetFormFilterInput(),
      'id_subcategoria' => new sfWidgetFormPropelChoice(array('model' => 'BitSubcategorias', 'add_empty' => true)),
      'id_usuario'      => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'fecha'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'hora'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'descripcion'     => new sfValidatorPass(array('required' => false)),
      'id_subcategoria' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'BitSubcategorias', 'column' => 'id_subcategoria')),
      'id_usuario'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SfGuardUserProfile', 'column' => 'user_id')),
    ));

    $this->widgetSchema->setNameFormat('bit_bitacora_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    
    $this->setDefault('fecha', $this->datos['fecha']);
    $this->setDefault('id_subcategoria', $this->datos['id_subcategoria']);



  }
}
