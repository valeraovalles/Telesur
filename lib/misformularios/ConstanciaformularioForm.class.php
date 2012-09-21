<?php
class ConstanciaformularioForm extends sfForm
{

  protected $datos = null;
  protected static $tipos= array(''=>'','sb'=>'Sueldo básico','sn'=>'Sueldo normal','si'=>'Sueldo integral','sba'=>'Sueldo básico anual','sna'=>'Sualdo normal anual','sia'=>'Sueldo integral anual');

  public function setDatos($c)
  {
	  	$this->datos = $c;
	   	$this->configure();
  }
  
  public function configure()
  {
      
    $this->setWidgets(array(
        'tipo'          => new sfWidgetFormSelect(array('choices' => self::$tipos)),
        'dirigida'      => new sfWidgetFormInputText(),
        'bono'          => new sfWidgetFormInputCheckbox(),
        'motivo'        => new sfWidgetFormTextarea(),
        '_csrf_token'   => new sfWidgetFormInputHidden(),
        
        
    ));

    $this->setValidators(array(
        'tipo'          => new sfValidatorString(),
        'dirigida'      => new sfValidatorString(),
        'bono'      => new sfValidatorString(array('required'=>false)),
        'motivo'        => new sfValidatorString(array('required'=>false)),
        '_csrf_token'   => new sfValidatorString(array('required'=>false)),
    ));


    $this->widgetSchema->setNameFormat('datos_form[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

   
    $this->setDefault('tipo', $this->datos['tipo']);
    $this->setDefault('dirigida', $this->datos['dirigida']);
    $this->setDefault('motivo', $this->datos['motivo']);

    
    
      
  }
}
?>
