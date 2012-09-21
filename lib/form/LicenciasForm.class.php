<?php

/**
 * Licencias form.
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
class LicenciasForm extends BaseLicenciasForm
{
  protected $datos = null;
  protected static $tipos= array('s'=>'Servicios','l'=>'Licencias');
	
  public function setDatos($c)
  {
	  	$this->datos = $c;
	   	$this->configure();
  }
	
  public function configure()
  {
 	
  	$a=new Criteria();
  	$a->add(SfGuardUserPeer::ID,$this->datos);

  	
  	$this->setWidgets(array(
      'id_licencia'       => new sfWidgetFormInputHidden(),
  	  'tipo'     => new sfWidgetFormSelect(array('choices' => self::$tipos)),
      'nombre_licencia'   => new sfWidgetFormInputText(),
      'numero'            => new sfWidgetFormInputText(),
      'fecha_compra'      => new sfWidgetFormInputText(array(),array("readonly"=>"readonly","class"=>"tcal")),
      'fecha_vencimiento' => new sfWidgetFormInputText(array(),array("readonly"=>"readonly","class"=>"tcal")),
      'descripcion'       => new sfWidgetFormTextarea(),
      'responsable'       => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false,'criteria'=>$a)),
    ));

    $this->setValidators(array(
      'id_licencia'       => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdLicencia()), 'empty_value' => $this->getObject()->getIdLicencia(), 'required' => false)),
      'nombre_licencia'   => new sfValidatorString(array('max_length' => 500)),
      'tipo'                       => new sfValidatorString(array('max_length' => 5)),
      'numero'            => new sfValidatorString(array('max_length' => 20)),
      'fecha_compra'      => new sfValidatorDate(),
      'fecha_vencimiento' => new sfValidatorDate(),
      'descripcion'       => new sfValidatorString(array('max_length' => 100)),
      'responsable'       => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
    ));


    $this->widgetSchema->setNameFormat('licencias[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}
